<?php namespace App\Http\Controllers;

use App\Http\Requests\ProposalPdfRequest;
use App\Http\Requests\CommentFormRequest;
use Response;
use View;
use DB;
use Session;
use Redirect;
use PDF;
use Mail;

class ClientviewController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function clientView($hash)
	{
		Session::put('start_date', date('m/d/Y'));
		Session::put('end_date', date('m/d/Y',strtotime('05/01/2015')));

		$proposal = DB::table('proposal')->where('hash',$hash)->first();

		// alter before $proposal->id
		$proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$proposal->id)->get();

		$billboard_ids = array();

		foreach ($proposal_billboards as $proposal_billboard) {
			$billboard_ids[] = $proposal_billboard->billboard_id;
		}

		// alter before client_id
		$clients = DB::table('clients')->where('id',$proposal->client_id)->get();
		
		$billboards = DB::table('billboard')->whereIn('id',$billboard_ids)->get();

		$proposals = array();
		
		$proposals = DB::table('active_proposal')
            ->join('proposal', 'active_proposal.proposal_id', '=', 'proposal.id')
            ->select('active_proposal.id as apid','proposal.*')
            ->where('proposal.id',$proposal->id)
            ->first();
        
        $active_proposal_billboards = array();

        if(isset($proposal)){
	        	$active_proposal_billboards = DB::table('proposal_billboard')
	            ->join('billboard', 'proposal_billboard.billboard_id', '=', 'billboard.id')
	            ->join('billboard_faces', 'proposal_billboard.billboard_face_id','=', 'billboard_faces.id')
	            ->select('proposal_billboard.billboard_id as apbid',
	            	'proposal_billboard.proposal_price as monthly_price',
	            	'proposal_billboard.proposal_id as proposal_id',
	            	'proposal_billboard.client_accepted as client_accepted',
	            	'proposal_billboard.client_rejected as client_rejected',
	            	'billboard.*',
	            	'billboard_faces.id as billboard_face_id', 
	            	'billboard_faces.label')
	            ->where('proposal_id',$proposal->id)
	            ->get();	
        }

        $comments = DB::table('proposal_comments')
            ->where('proposal_id',$proposal->id)
            ->orderBy('id','asc')
            ->get();

        $user = array();

		return view('clientview',array('clients' => $clients, 
								'active_proposal' => $proposal, 
								'active_proposal_billboards' => $active_proposal_billboards, 
								'billboards' => $billboards,
								'comments' => $comments,
								'user' => $user,
								'hash' => $hash ));
	}

	function addComment(CommentFormRequest $request){

		$proposal = DB::table('proposal_comments')->insertGetId(
		    array(
				    'proposal_id' => $request->input('proposal_id'),
		            'client_id' => $request->input('client_id'),
		            'message' => $request->input('proposalComment'),
		            'created_at' => date('m-d-Y'),
		            'message_from' => 'client',
		            'user_id' => $request->input('user_id'),
		            'created_at' => date('Y-m-d h:i:s')
		    	  )
		);

		$comments = DB::table('proposal_comments')
						->where('proposal_id',$request->input('proposal_id'))
						->where('client_id',$request->input('client_id'))
						->where('user_id',$request->input('user_id'))
						->get();

		$comment_text = '';

		if(count($comments)){
              foreach($comments as $comment){

                if($comment->message_from == 'client'){
                	$comment_text .= '<div class="sidr-class-client_message">'.$comment->message.
                			'</div>';
                }
                if($comment->message_from == 'admin'){
                	$comment_text .= '<div class="sidr-class-admin_message">'.$comment->message.
			                '</div>';
                }
              }
        }

        return $comment_text;

	}

	public function jsonHash($hash)
	{
		$proposal = DB::table('proposal')->where('hash',$hash)->first();

		$proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$proposal->id)->get();	

		$billboard_ids = array();
		$billboard_face_ids = array();

		foreach ($proposal_billboards as $proposal_billboard) {
			$billboard_ids[] = $proposal_billboard->billboard_id;
			$billboard_face_ids[] = $proposal_billboard->billboard_face_id;
		}
	
		$billboards = DB::table('billboard')->whereIn('id',$billboard_ids)->get();

		$billboard_data = array();

		foreach ($billboards as $billboard) {

			// $proposal_billboards = DB::table('proposal_billboard')
			// ->where('proposal_id',$proposal->id)
			// ->where('billboard_id',$billboard->id)
			// ->whereIn('billboard_face_id',$billboard_face_ids)
			// ->get();

			//foreach ($proposal_billboards as $proposal_billboard) {
				$billboard_faces = DB::table('proposal_billboard')
		            ->join('billboard_faces', 'proposal_billboard.billboard_face_id', '=', 'billboard_faces.id')
		            ->select('billboard_faces.*','proposal_billboard.proposal_price as proposal_price')
		            ->where('proposal_billboard.proposal_id',$proposal->id)
		            ->where('proposal_billboard.billboard_id',$billboard->id)
		            ->whereIn('proposal_billboard.billboard_face_id',$billboard_face_ids)
		            ->get();	
				// $billboard_faces =DB::table('billboard_faces')
				// 				->where('billboard_id',$billboard->id)
				// 				->where('id',$proposal_billboard->billboard_face_id)->get();
		        $billboard_data[] = array('billboard'=>$billboard,'faces'=>$billboard_faces);
	        //}
			

			
		}

		return response()->json($billboard_data);
	}


	public function clientAccepted($proposal_id,$billboard_id){
		if($billboard_id){
			$proposals = DB::table('proposal_billboard')
                    ->where('billboard_id',$billboard_id)
            		->update(array('client_accepted'=>1,'client_rejected'=>0));
            return Redirect::back()->with('message','Operation Successful !');
		}
	}

	public function clientRejected($proposal_id,$billboard_id){
		if($billboard_id){
			$proposals = DB::table('proposal_billboard')
                    ->where('billboard_id',$billboard_id)
            		->update(array('client_accepted'=>0,'client_rejected'=>1));
            return Redirect::back()->with('message','Operation Successful !');
		}
	}

	public function clientAcceptProposal($proposal_id){
		if($proposal_id){
			$proposals = DB::table('proposal')
                    ->where('id',$proposal_id)
            		->update(array('accepted'=>1));

            $proposal = DB::table('proposal')
                    ->where('id',$proposal_id)
            		->first();

            $agent = DB::table('users')
                    ->where('id',$proposal->user_id)
            		->first();

            $client = DB::table('clients')
                    ->where('id',$proposal->client_id)
            		->first();

            $data['agentname'] = $agent->first_name;
			$data['hash'] = $proposal->hash;
			$data['proposal_name'] = $proposal->name;
			$template = 'emails/proposal_accepted_user';
			$subject = 'Signly - Proposal Accepted';
			$email = $agent->email;
			$data['clientname'] = $client->first_name;

			Mail::send($template, $data, function($message) use ($email, $subject)
				{
					$message->from('noreply@signly.com', 'Signly.com');
					$message->to($email)->subject($subject);
				});	
            return Redirect::back()->with('message','Operation Successful !');
		}
	}

	

	public function pdfProposal(ProposalPdfRequest $request){
		$proposal = DB::table('proposal')->where('id',$request->input('proposal_id'))->first();
		//$proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$request->input('proposal_id'))->get();
		$client = DB::table('clients')->where('id',$proposal->client_id)->first();

		$proposal_billboards = DB::table('proposal_billboard')
	            ->join('billboard', 'proposal_billboard.billboard_id', '=', 'billboard.id')
	            ->join('billboard_faces', 'proposal_billboard.billboard_face_id', '=', 'billboard_faces.id')
	            ->select(
	            	'proposal_billboard.id as pbid',
	            	'billboard.name',
	            	'billboard.description',
	            	'billboard.address',
	            	'billboard.city',
	            	'billboard.state',
	            	'billboard.zipcode',
	            	'billboard.rate',
	            	'billboard.lat',
	            	'billboard.lng',
	            	'billboard_faces.unique_id as unique_id',
	            	'billboard_faces.height as height',
	            	'billboard_faces.width as width',
	            	'billboard_faces.reads as reads',
	            	'billboard_faces.label as label',
	            	'billboard_faces.hard_cost as hard_cost',
	            	'billboard_faces.monthly_impressions as monthly_impressions',
	            	'billboard_faces.notes as notes',
	            	'billboard_faces.photo as photo'
	            	)
	            ->where('proposal_id',$request->input('proposal_id'))
	            ->where('proposal_billboard.client_accepted',1)
	            ->get();

	    $pdf = PDF::loadView('pdfexport_reagan', array('proposal' => $proposal,
	    								  'proposal_billboards' => $proposal_billboards,
	    								  'client' => $client
	    								)
	    					);
		return $pdf->download('proposal.pdf');
		// return view('pdf',array('proposal' => $proposal,
	 //    								  'proposal_billboards' => $proposal_billboards,
	 //    								  'client' => $client
	 //    								)
		// );


	}


}
