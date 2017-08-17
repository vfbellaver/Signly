<?php namespace App\Http\Controllers;

use App\Http\Requests\BillboardFormRequest;
use App\Http\Requests\BillboardFaceFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\BillboardBookingFormRequest;
use App\Http\Requests\ProposalSettingsFormRequest;
use App\Http\Requests\SearchBillboardRequest;
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

    public function logo (ProposalSettingsFormRequest $request) {
        $file = $request->file('file');
        return $file->move(storage_path('app/public'),$file->getFilename().'.'.$file->getClientOriginalExtension());
    }
}
