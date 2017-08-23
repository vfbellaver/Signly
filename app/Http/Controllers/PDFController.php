<?php namespace App\Http\Controllers;
use App\Http\Requests\BillboardFormRequest;
use App\Http\Requests\BillboardFaceFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\BillboardBookingFormRequest;
use App\Http\Requests\SearchBillboardRequest;
use App\Http\Requests\BillboardUploadRequest;
use App\ProposalSettings;
use PDF;
use Response;
use View;
use DB;
use Storage;
use URL;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class PDFController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    private function details()
    {
       $details = DB::table('proposal_billboard')->join('');
    }

    private function first_page($proposalId,$clientId)
    {
        $proposal = DB::table('proposal')->where('id',$proposalId)->where('client_id',$clientId)->first();
        $client = DB::table('clients')->where('id',$clientId)->first();
        return compact('proposal','client');
    }

    private function footer()
    {
        return $proposalSettings = ProposalSettings::where('user_id',Auth::user()->id)->first();
    }


    public function index()
    {
         $footer = $this->footer();
         $first_page = $this->first_page();
         $pdf = PDF::loadView('pdf.pdf_index',compact('footer','first_page'));
         $pdf->setPaper('A4','landscape');
         //$pdf->setOptions(array("isHtml5ParserEnabled" => true));
         return $pdf->stream("file.pdf",array("Attachment" => 0));
        //return view('pdf.pdf_index',compact('footer','first_page'));
    }

}