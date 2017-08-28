<?php namespace App\Http\Controllers;

use App\Http\Requests\BillboardFormRequest;
use App\Http\Requests\BillboardFaceFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\BillboardBookingFormRequest;
use App\Http\Requests\SearchBillboardRequest;
use App\Http\Requests\BillboardUploadRequest;
use App\ProposalSettings;
use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\stream_for;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Request;
use mPDF;
use PDF;
use Response;
use View;
use DB;
use Storage;
use URL;
use Session;
use Auth;

class PDFController extends Controller
{

    private $points;
    private $client;
    private $myIcon = 'https://goo.gl/usznMp';

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    private function details($id)
    {
        $details = DB::table('proposal')
            //clients
            ->join('clients'
                , 'clients.id', '=', 'proposal.client_id')
            //proposal_billboard
            ->join('proposal_billboard'
                , 'proposal_billboard.proposal_id', '=', 'proposal.id')
            //billboard
            ->join('billboard',
                'billboard.id', '=', 'proposal_billboard.id')
            //billboard_faces
            ->join('billboard_faces',
                'billboard_faces.id', '=', 'proposal_billboard.billboard_face_id')
            //billboard_image
            ->where('clients.id', '=', $id)->get();

        return $details;
    }

    public function getDetailMap()
    {
        $img = 1;

        foreach ($this->points as $point) {
            $link =
                'https://maps.googleapis.com/maps/api/staticmap?'
                . 'center=' . $point->lat . ',' . $point->lng
                . '&zoom=17'
                . '&format=jpg'
                . '&maptype=roadmap'
                . '&markers=icon:' . $this->myIcon . '%7C' . $point->lat . ',' . $point->lng
                . '&size=300x250'
                . '&key=AIzaSyAECe-JaASIc4HpIae-cFuFDtyX3K2GI_Q';

            $client = new Client();

            $resource = fopen(storage_path('app/public/map' . Auth::user()->id . 'img' . $img . '.jpg'), 'w');
            $stream = stream_for($resource);
            $client->request('GET', $link, ['save_to' => $stream]);
            $img++;
        }

    }

    public function getMap()
    {
        $img = 1;

        foreach ($this->points as $point) {
            $link = 'https://maps.googleapis.com/maps/api/staticmap?';
            $link .= 'center=' . $point->map_area_lat . ',' . $point->map_area_long;
            $link .= '&zoom=9&format=jpg';

            foreach ($this->points as $p) {
                $link .= '&markers=color:yellow%7Clabel:S:S%%7C' . $p->lat . ',' . $p->lng;
            }
                $link .= '&size=500x350&key=AIzaSyAECe-JaASIc4HpIae-cFuFDtyX3K2GI_Q';

                $this->client = new Client();

                $resource = fopen(storage_path('app/public/'.$img.'map.jpg'), 'w');
                $stream = stream_for($resource);
                $this->client->request('GET', $link, ['sink' => storage_path('app/public/'.$img.'map.jpg')]);

            $img++;
        }
    }

    public function index()
    {
        $id = Request::input('id');
        $this->points = $details = $this->details($id);
        $this->getMap();
        $this->getDetailMap();
        $footer = ProposalSettings::where('user_id', Auth::user()->id)->first();
        $pdf = PDF::loadView('pdf.pdf_index', compact('details', 'footer'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("file.pdf", array("Attachment" => 0));
        //return view('pdf.pdf_index',compact('details','footer','img'));
    }


}