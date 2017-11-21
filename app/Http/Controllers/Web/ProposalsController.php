<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Exception;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;

class ProposalsController extends Controller
{
    public function index()
    {
        return view('proposal.index');
    }

    public function show($id)
    {
        $user = auth()->user();
        $proposal = Proposal::query()
            ->where('id', $id)
            ->where('team_id', $user->team_id)
            ->firstOrFail();

        return view('proposal.show', ['proposal' => $proposal]);
    }

    public function pdf(Proposal $proposal)
    {
        ini_set('max_execution_time', 5000);

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        //612 × 792 points
        $gen = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                base_path() . '/resources/fonts/Roboto',
            ]),
            'fontdata' => $fontData + [
                    'Roboto' => [
                        'R' => 'Roboto-Regular.ttf',
                        'I' => 'Roboto-Italic.ttf',
                        'B' => 'Roboto-Bold.ttf',
                        'BI' => 'Roboto-BoldItalic.ttf',
                    ]
                ],
            'default_font' => 'Roboto',
            'mode' => 'c',
            'format' => 'Letter',
            'margin_left' => 12,
            'margin_right' => 12,
            'margin_top' => 20,
            'margin_bottom' => 20,
        ]);

        $gen->SetTitle($proposal->name);

        $client = $proposal->client->toArray();
        $team = $proposal->team->toArray();

        $content = view('proposal.pdf', [
            'proposalObj' => $proposal,
            'proposal' => $proposal->toArray(),
            'client' => $client,
            'team' => $team,
            'user' => $proposal->user ? $proposal->user->toArray() : null,
        ]);

        $gen->WriteHTML($content);
        $pdf = $gen->Output('proposal.pdf', 'S');

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Length', strlen($pdf))
            ->header('Content-Disposition', "attachment; filename=\"proposal.pdf\"");
    }

    public function share($proposalEncryptedId)
    {
        try {
            $id = (int)decrypt($proposalEncryptedId);
            $proposal = Proposal::query()->findOrFail($id);

            return view('proposal.share', ['proposal' => $proposal, 'id' => $proposalEncryptedId]);
        } catch (Exception $e) {
            return abort(404);
        }
    }

    public function publicPdf($proposalEncryptedId)
    {
        try {
            $id = (int)decrypt($proposalEncryptedId);
            /** @var Proposal $proposal */
            $proposal = Proposal::query()->findOrFail($id);
            return $this->pdf($proposal);
        } catch (Exception $e) {
            return abort(404);
        }
    }
}
