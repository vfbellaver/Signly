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
            Storage::delete($proposalSettings->path_image);
            $file->move(storage_path('app/public'),$file->getClientOriginalName());
            $data['path_image'] = $file->getClientOriginalName();
            $proposalSettings->update($data);

        } else
            {
                $proposalSettings = new ProposalSettings();
                $file->move(storage_path('app/public'),$file->getClientOriginalName());
                $data['path_image'] = $file->getClientOriginalName();
                $proposalSettings->fill($data);
                $proposalSettings->user_id = Auth::user()->id;
                $proposalSettings->save();
            }

        return redirect('/home');
    }
}
