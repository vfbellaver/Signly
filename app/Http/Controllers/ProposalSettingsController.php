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
    

    public function updateSettings(ProposalSettingsFormRequest $request) {

        $saveOrUpdate = $request->input('proposal_settings_id');
        if(isset($saveOrUpdate))
        {
            $data = $request->only(
                'user_street',
                'user_state',
                'user_phone',
                'user_city',
                'user_zipcode',
                'website'
            );
            $file = $request->file('path_image');
            $proposalSettings = ProposalSettings::find($saveOrUpdate);

            if($file!=null)
            {
                $destinationPath = storage_path('app/public/proposal_settings/').Auth::user()->id;
                File::delete($destinationPath . DIRECTORY_SEPARATOR . $proposalSettings->path_image);
                $file->move($destinationPath,$file->getClientOriginalName());
                $data['path_image'] = $file->getClientOriginalName();
                $proposalSettings->update($data);
            }
            else
            {
                $proposalSettings = ProposalSettings::find($saveOrUpdate);
                $proposalSettings->update($data);
            }

        }
        else
        {
            $data = $request->only(
                'user_street',
                'user_state',
                'user_phone',
                'user_city',
                'user_zipcode',
                'website'
            );

            $file = $request->file('path_image');
            $proposalSettings = new ProposalSettings();
            $destinationPath = storage_path('app/public/proposal_settings/').\Auth::user()->id;
            $file->move($destinationPath,$file->getClientOriginalName());
            $data['path_image'] = $file->getClientOriginalName();
            $proposalSettings->fill($data);
            $proposalSettings->user_id = Auth::user()->id;
            $proposalSettings->save();
        }


        return redirect('/home');
    }

}
