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

    private function details($id)
    {
       $details = DB::table('proposal')
           //clients
           ->join('clients'
               ,'clients.id','=','proposal.client_id')
           //proposal_billboard
           ->join('proposal_billboard'
               ,'proposal_billboard.proposal_id','=','proposal.id')
           //billboard
           ->join('billboard',
               'billboard.id','=','proposal_billboard.id')
           //billboard_faces
           ->join('billboard_faces',
               'billboard_faces.id','=','proposal_billboard.billboard_face_id')
           //billboard_image
           ->where('clients.id','=',$id)->get();

       return $details;
    }

    public function index()
    {
         $details = $this->details(1);
         $footer = ProposalSettings::where('user_id',Auth::user()->id)->first();
         $pdf = PDF::loadView('pdf.pdf_index',compact('details','footer'));
         $pdf->setPaper('A4','landscape');
         return $pdf->stream("file.pdf",array("Attachment" => 0));
    }

}