<?php namespace App\Http\Controllers;

use App\Http\Requests\BillboardFormRequest;
use App\Http\Requests\BillboardFaceFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\BillboardBookingFormRequest;
use App\Http\Requests\ProposalSettingsFormRequest;
use App\Http\Requests\SearchBillboardRequest;
use App\ProposalSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;
use View;
use DB;
use URL;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;
use Auth;

class ProposalSettingsController extends Controller {

    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }


    public function client (Request $request) {
        $clients = DB::table('clients')
            ->select('first_name','last_name','id')->get();
        $client = DB::table('clients')->where('id','=',$request->input('client_id'))->first();
        return view('proposal.settings',array('customer' => $client,'clients'  => $clients));
    }

    public function settings (ProposalSettingsFormRequest $request) {

        $saveOrUpdate = $request->input('proposal_settings_id');

        $data = $request->only(
            'path_image',
            'user_street',
            'user_state',
            'user_city',
            'user_zipcode',
            'website'
        );


        $file = $request->file('path_image');


        if ($saveOrUpdate) {
            $proposalSettings = ProposalSettings::find($saveOrUpdate);
            File::delete($proposalSettings->path_image);
            $file->move(storage_path('app/public'),$file->getClientOriginalName().'.'.$file->getClientOriginalExtension());
            $data['path_image'] = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $proposalSettings->update($data);

        } else
            {
                $proposalSettings = new ProposalSettings();
                $file->move(storage_path('app/public'),$file->getClientOriginalName().'.'.$file->getClientOriginalExtension());
                $data['path_image'] = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
                $proposalSettings->fill($data);
                $proposalSettings->user_id = Auth::user()->id;
                $proposalSettings->save();
            }

        return redirect('/home');
    }
}
