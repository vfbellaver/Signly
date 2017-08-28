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

    public function getDetailMap () {
     $img = 1;

     foreach ($this->points as $point) {
         //$myIcon = 'http://i.imgur.com/T7Q1dCN.png';
         $myIcon = 'goo.gl/bAaFjF';
         $myIcon = 'https://goo.gl/cGZpyq';
         $link =
             'https://maps.googleapis.com/maps/api/staticmap?'
             . 'center='.$point->lat.','.$point->lng
             . '&zoom=13'
             .'&maptype=roadmap'
             .'&markers=icon:'.$myIcon.'%7C'.$point->lat.','.$point->lng
             . '&size=400x300'
             .'&key=AIzaSyAECe-JaASIc4HpIae-cFuFDtyX3K2GI_Q';

         $client = new Client();

         $resource = fopen(storage_path('app/public/map'.Auth::user()->id.'img'.$img.'.png'), 'w');
         $stream = stream_for($resource);
         $client->request('GET', $link, ['save_to' => $stream]);
             $img ++;
     }

    }

    public function getMap () {

        $link = 'https://maps.googleapis.com/maps/api/staticmap?'
        .'center=40.69984970000001,-111.8809402'
        .'&zoom=13'
        .'&size=400x400&key=AIzaSyAECe-JaASIc4HpIae-cFuFDtyX3K2GI_Q';

        $client = new Client();

        $resource = fopen(storage_path('app/public/map.png'), 'w');
        $stream = stream_for($resource);
        $client->request('GET', $link, ['save_to' => $stream]);


    }

    public function index()
    {
         $this->points = $details = $this->details(1);
         $this->getMap();
         $this->getDetailMap();
         $footer = ProposalSettings::where('user_id',Auth::user()->id)->first();
         $pdf = PDF::loadView('pdf.pdf_index',compact('details','footer'));
         $pdf->setPaper('A4','landscape');
         return $pdf->stream("file.pdf",array("Attachment" => 0));
         //return view('pdf.pdf_index',compact('details','footer','img'));
    }

}