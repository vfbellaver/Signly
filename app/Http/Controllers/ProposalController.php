<?php namespace App\Http\Controllers;

use App\Http\Requests\ProposalFormRequest;
use App\Http\Requests\ProposalBillboardRequest;
use App\Http\Requests\ProposalSendRequest;
use App\Http\Requests\ProposalPdfRequest;
use App\Http\Requests\ProposalFaceBillboardRequest;
use App\Http\Requests\CommentFormRequest;
use App\Http\Requests\ContractFormRequest;
use App\Http\Requests\ProposalSettingsFormRequest;
use App\ProposalSettings;
use Illuminate\Support\Facades\Auth;
use Response;
use View;
use DB;
use Redirect;
use Mail;
use PDF;
use File;
use Storage;

class ProposalController extends Controller {

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

	private $user;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = \Auth::user();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */


	public function index()
	{
		$proposals = DB::table('proposal')
					->where('user_id',$this->user->id)
					->paginate(10);
		$clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
		return view('proposal.proposals',array('proposals' => $proposals, 'clients' => $clients ) );
	}


	public function add(){
		$clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
		return view('proposal.add',array('clients' => $clients));	
	}

	public function edit($id)
	{
		$proposal = DB::table('proposal')->where('id',$id)->get();
		$proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$id)->get();

		$result = DB::table('active_proposal')->where('user_id',$this->user->id)->delete();
		$result = DB::table('active_proposal_billboards')->where('user_id',$this->user->id)->delete();

		$active_proposal_id = DB::table('active_proposal')->insertGetId(
			    array(
					    'proposal_id' => $proposal[0]->id,
					    'user_id'  => $this->user->id
			    	 )
			);

		foreach ($proposal_billboards as $proposal_billboard) {

			$active_proposal_billboard_id = DB::table('active_proposal_billboards')->insertGetId(
			    	array(
					    'active_proposal_id' => $active_proposal_id,
			            'proposal_id' => $proposal_billboard->proposal_id,
			            'billboard_id' => $proposal_billboard->billboard_id,
					    'user_id'  => $this->user->id,
					    'proposal_price' => $proposal_billboard->proposal_price,
					    'billboard_face_id' => $proposal_billboard->billboard_face_id

			    	  )
				);
		}
		
		return Redirect::to('/');
	}

	public function removebillboard($id){
		$clients = DB::table('active_proposal_billboards')
				->where('id',$id)
				->delete();
		return redirect('/');		
	}

	public function addbillboard(ProposalFaceBillboardRequest $request){

		$active_proposal = DB::table('active_proposal')
						->where('user_id',$this->user->id)
						->first();

		if (isset($active_proposal->id)){
		
			$test_exitence = DB::table('active_proposal_billboards')
						->where('active_proposal_id', $active_proposal->id)
						->where('proposal_id', $active_proposal->proposal_id)
						->where('billboard_id', $request->input('pb_billboard_id'))
						->where('billboard_face_id', $request->input('pb_face_id'))
						->first();
			
			if (!isset($test_exitence->id)){
			    // -- Search last order record to set the next order_proposal_billboards -- //
                $active_proposal_billboards = DB::table('active_proposal_billboards')
                    ->where('active_proposal_billboards.user_id', $user->id)
                    ->orderBy('order_proposal_billboards', 'ASC')->get();

                $ultimo = end($active_proposal_billboards);
                $order = $ultimo->order_proposal_billboards + 1;

				$proposal_id = DB::table('active_proposal_billboards')->insertGetId(
			    	array(
					    'active_proposal_id' => $active_proposal->id,
			            'proposal_id' => $active_proposal->proposal_id,
			            'billboard_id' => $request->input('pb_billboard_id'),
			            'billboard_face_id' => $request->input('pb_face_id'),
			            'user_id' => $this->user->id,
			            'proposal_price' => $request->input('pb_price_per_month'),
                        'order_proposal_billboards' => $order
			    	  )
				);
			}
		}

		return redirect('/');		
	}
	

	public function store(ProposalFormRequest $request){
		
		$proposal_id = DB::table('proposal')->insertGetId(
		    array(
				    'name' => $request->input('name'),
		            'budget' => $request->input('budget'),
		            'budget_validity' => $request->input('budget_validity'),
		            'client_id' => $request->input('client_id'),
		            'start_date' => $request->input('start_date'),
		            'end_date' => $request->input('end_date'),
		            'hash' => md5($request->input('name').time()),
		            'user_id' => $this->user->id
		    	  )
		);

		if ($request->input('setasactive') == '1'){
			DB::table('active_proposal')->where('user_id',$this->user->id)->delete();
			DB::table('active_proposal_billboards')->where('user_id',$this->user->id)->delete();
			$id = DB::table('active_proposal')->insertGetId(
			    array(
					    'proposal_id' => $proposal_id ,
					    'user_id' => $this->user->id
			    	 )
			);
		}

		if ($id > 0){
			return redirect('/');
		} else {
			$request::flash('Error encountered');
		}
		
	}	

	function saveProposalBillbaord(ProposalBillboardRequest $request){

		$active_proposal_billboards = DB::table('active_proposal_billboards')
									->where('proposal_id',$request->input('proposal_id'))
									->get();
		DB::table('proposal_billboard')->where('proposal_id',$request->input('proposal_id'))->delete();

		foreach ($active_proposal_billboards as $active_proposal_billboard) {
			$proposal_billboard_id = DB::table('proposal_billboard')->insertGetId(
			    	array(
			            'proposal_id' => $request->input('proposal_id'),
			            'billboard_id' => $active_proposal_billboard->billboard_id,
			            'billboard_face_id' => $active_proposal_billboard->billboard_face_id,
			            'user_id' => $this->user->id,
			            'proposal_price' => $active_proposal_billboard->proposal_price
			    	  )
				);
		}

		echo true;
		
	}

	function copyLink(ProposalSendRequest $request){
		$hash = md5($request->input('proposal_id').time());		

		$proposal = DB::table('proposal')->where('id',$request->input('proposal_id'))->first();

		if($proposal->hash == '' ||  $proposal->hash == NULL){
			$result = DB::table('proposal')
					->where('id',$request->input('proposal_id'))
					->update(['hash' => $hash]);	
			echo $hash;
		} else {
			echo $proposal->hash;
		}


	}

	function sendProposal(ProposalSendRequest $request){

		$hash = md5($request->input('proposal_id').time());		

		$proposal = DB::table('proposal')->where('id',$request->input('proposal_id'))->first();
		$client = DB::table('clients')->where('id',$proposal->client_id)->first();

		if($proposal->hash == '' ||  $proposal->hash == NULL){
			$result = DB::table('proposal')
					->where('id',$request->input('proposal_id'))
					->update(['hash' => $hash]);	
		}
		

		$data['agentname'] = 'Smith';
		$data['hash'] = $hash;
		$template = 'emails/proposal';
		$subject = 'Signly';
		$email = $client->email;
		$data['clientname'] = $client->first_name;

		Mail::send($template, $data, function($message) use ($email, $subject)
			{
				$message->from('noreply@signly.com', 'Signly.com');
				$message->to($email)->subject($subject);
			});	

		return 1;
	}

	function pdfProposal(ProposalPdfRequest $request){
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
	            	'billboard_faces.photo as photo',
	            	'billboard_faces.sign_type as sign_type'
	            	)
	            ->where('proposal_id',$request->input('proposal_id'))
	            ->get();


	    $pdf = PDF::loadView('pdfexport_kennedy', array('proposal' => $proposal,
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

	function addComment(CommentFormRequest $request){

		$proposal = DB::table('proposal_comments')->insertGetId(
		    array(
				    'proposal_id' => $request->input('proposal_id'),
		            'client_id' => $request->input('client_id'),
		            'message' => $request->input('proposalComment'),
		            'created_at' => date('m-d-Y'),
		            'message_from' => 'admin',
		            'user_id' => $this->user->id,
		            'created_at' => date('Y-m-d h:i:s')
		    	  )
		);

		$comments = DB::table('proposal_comments')
						->where('proposal_id',$request->input('proposal_id'))
						->where('client_id',$request->input('client_id'))
						->where('user_id',$this->user->id)
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

	function printProposal(ProposalPdfRequest $request){
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
	            ->get();


		return view('print',array('proposal' => $proposal,
		   								  'proposal_billboards' => $proposal_billboards,
		   								  'client' => $client
		   								)
		);


	}

	function destroy($id){
		$delete_id = DB::table('proposal')->where('id',$id)->delete();
		$delete_id = DB::table('proposal_billboard')->where('proposal_id',$id)->delete();
		return redirect('/proposals');
	}

	function bookProposal($proposal_id){

		$proposal_billboards = DB::table('proposal_billboard')
				            ->join('billboard', 'proposal_billboard.billboard_id', '=', 'billboard.id')
				            ->join('billboard_faces', 'proposal_billboard.billboard_face_id', '=', 'billboard_faces.id')
				            ->join('proposal', 'proposal_billboard.proposal_id', '=', 'proposal.id')
				            ->select(
				            	'proposal_billboard.id as pbid',
				            	'billboard.id as billboard_id',
				            	'proposal_billboard.billboard_face_id',
				            	'billboard.name',
				            	'billboard_faces.label as label',
				            	'billboard_faces.photo as photo',
				            	'proposal.start_date',
				            	'proposal.end_date',
				            	'proposal_billboard.proposal_price',
				            	'proposal_billboard.user_id'
				            	)
				            	->where('proposal_id',$proposal_id)
								->get();

		foreach ($proposal_billboards as $proposal_billboard) {
			$proposal = DB::table('client_booking')->insertGetId(
			    array(
					    'billboard_id' => $proposal_billboard->billboard_id,
			            'billboard_face_id' => $proposal_billboard->billboard_face_id,
			            'vendor_id' => $proposal_billboard->user_id,
			            'client_id' => $proposal_billboard->user_id,
			            'proposal_id' => $proposal_id,
			            'description' => $proposal_billboard->name.' ('.$proposal_billboard->label.')',
			            'book_start_date' => $proposal_billboard->start_date,
			            'book_end_date' => $proposal_billboard->end_date,
			            'set_price' => $proposal_billboard->proposal_price,
			            'photo' => $proposal_billboard->photo,
			            'created_at' => date('Y-m-d')
			    	  )
			);
		}

		$result = DB::table('proposal')
					->where('id',$proposal_id)
					->update(array('booked' => 1));

		return redirect('/proposals');

		
	}

	public function proposalForm(){
		$proposal = DB::table('proposal')
					->where('user_id',$this->user->id)
					->first();
		$clients = DB::table('clients')->get();
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
	            ->where('proposal_id',$proposal->id)
	            ->get();

		return view('proposal.contract',array('proposal' => $proposal, 'proposal_billboards' => $proposal_billboards,  'clients' => $clients ) );
	}

	public function proposalSignature($proposal_id)
	{
		$proposal = DB::table('proposal')
					->where('user_id',$this->user->id)
					->where('id',$proposal_id)
					->first();
		$clients = DB::table('clients')->get();
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
	            ->where('proposal_id',$proposal->id)
	            ->get();

		return view('proposal.contract',array('proposal' => $proposal, 'proposal_billboards' => $proposal_billboards,  'clients' => $clients ) );
	}


	private function getSignNowAccessToken(){
		$CREATE_TOKEN_URL = "https://api-eval.signnow.com/oauth2/token";
		$CLIENT_ID = "0fccdbc73581ca0f9bf8c379e6a96813";
		$CLIENT_SECRET = "3719a124bcfc03c534d4f5c05b5a196b";
		// Can be found in email sent after requesting an API key at https://university.signnow.com/api/[1] 
		$encoded_credentials = "MGZjY2RiYzczNTgxY2EwZjliZjhjMzc5ZTZhOTY4MTM6MzcxOWExMjRiY2ZjMDNjNTM0ZDRmNWMwNWI1YTE5NmI=";
		// If you are on production using your own client_id and client_secret. 
		// $encoded_credentials = base64_encode(CLIENT_ID.":".CLIENT_SECRET); 
		//print_r(rawurlencode($encoded_credentials)); 
		$headers = array('Accept:application/json','Authorization: Basic ' . $encoded_credentials); 
		// Will need to change username and password and maybe scope 
		$username = "mike@signly.com"; 
		$password = "climber83"; 
		$grant_type = "password"; 
		$scope = "*"; 
		$param = array('username'=> $username,'password' => $password, 'grant_type'=> $grant_type,'scope'=> $scope); 
		$handle = curl_init(); 
		curl_setopt($handle, CURLOPT_URL, $CREATE_TOKEN_URL); 
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($handle, CURLOPT_POST, true); 
		curl_setopt($handle, CURLOPT_POSTFIELDS, $param); 
		$response = curl_exec($handle); 

		$response_arr = json_decode($response); 
		//print_r($response_arr);
		if(property_exists($response_arr, 'access_token')){
			return $response_arr->access_token;
		}
		return false;
	}

	public function signContract(){


		// Client ID: 0fccdbc73581ca0f9bf8c379e6a96813
		// Client Secret: 3719a124bcfc03c534d4f5c05b5a196b
		// ENCODED_CLIENT_CREDENTIALS:
		// MGZjY2RiYzczNTgxY2EwZjliZjhjMzc5ZTZhOTY4MTM6MzcxOWExMjRiY2ZjMDNjNTM0ZDRmNWMwNWI1YTE5NmI=


		if($this->getSignNowAccessToken() == false){
			return;
		}
		


		// -----------------------------------------------------------------------------------
			
			$UPLOAD_DOCUMENT_URL = 'https://api-eval.signnow.com/document';

			// You would have to change this to a token for your account 
			$access_token = $this->getSignNowAccessToken(); 
			$headers = array('Accept: application/json','Authorization: Bearer ' . $access_token);

			// You will need to change the path to a file on your machine 
			$postdata['file'] = new \CurlFile(storage_path('proposal/proposal_mammoth.pdf'),'application/pdf'); 

			$handle = curl_init(); 
			curl_setopt($handle, CURLOPT_URL, $UPLOAD_DOCUMENT_URL); 
			curl_setopt($handle, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
			curl_setopt($handle, CURLOPT_POST, true); 

			curl_setopt($handle, CURLOPT_POSTFIELDS, $postdata); 
			$response = curl_exec($handle); 

			print_r($response); 
			exit();
		// -----------------------------------------------------------------------------------

		File::requireOnce(app_path('Includes/tcpdf/tcpdf.php'));

		// create new PDF document
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Michael Spencer');
		$pdf->SetTitle('SIGNLY');
		$pdf->SetSubject('SIGNLY PROPOSAL CONTRACT');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		//$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		/*
		NOTES:
		 - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
		 - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
		 - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
		*/

		 
		  // echo 'file://'.realpath('../Includes/tcpdf/certificate/tcpdf.crt');

		  // exit();

		// set certificate file
		//$certificate = 'file://../config/cert/tcpdf.crt';
		$certificate =  File::get(app_path('Includes/tcpdf/certificate/tcpdf.crt')); //'file:/'.app_path('Includes/tcpdf/certificate/tcpdf.crt');

		// set additional information
		$info = array(
		    'Name' => 'TCPDF',
		    'Location' => 'Office',
		    'Reason' => 'Testing TCPDF',
		    'ContactInfo' => 'Signly',
		    );

		// set document signature
		$pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);

		// set font
		$pdf->SetFont('helvetica', '', 12);

		// add a page
		$pdf->AddPage();

		// print a line of text
		$text = 'PAYMENT	The Advertiser agrees to pay to MOA the total amount due as specified in the agreement at execution of the agreement and each month thereafter for each display the Monthly Charge specified on the first day of each month until the stop date of the contract. As a Convenience to the Advertiser MOA will send a reminder invoice each month but the Advertiser’s obligation will not be dependent upon the receipt of such invoices. In the event any Monthly Charge is unpaid by the 10th of the month a $25 late fee will be assessed. The Advertiser agrees to pay all reasonable collection expenses, attorney fees and court costs incurred by MOA for the collection of any amounts becoming past due hereunder, and also agrees to pay 1% per month interest or the maxim lawful rate whichever is lesser on all amounts outstanding until paid. In the event that Advertiser fails to make payments pursuant to the terms set forth herein, NOA may at its option: <br/>
1.	Terminate this agreement in which event, Advertiser agrees to pay MOA because of the uncertainty of ascertaining NOA’s damages arising from the Advertisers previous preemption of space, three-fourths of the payments remaining to be paid from the date of the breach to the end of the contract period, as set forth in the terminated contract: or <br/>
2.	Declare the entire remaining balance immediately due and payable, together with interest at the rate of 12% per annum on the unpaid balance: or <br/>
3.	Proceed to collect individual unpaid installment due and owing, together with interest at the rate of 12% per annum on such installments. <br/>
4.	Remove the advertising display from the sigh location and withhold it from display until the unpaid balance is brought current and/or while MOA seeks any of the above remedies. <br/>
Use of any of the foregoing remedies by MOA shall not constitute a waiver of MOA’s right to prosecute collection pursuant to one of the other remedies or through other legal remedies. This contract sets for the full agreement of the parties and there are no other understandings or agreements not set forth herein. <br/>
This contract is binding and shall inure to the benefit of the respective heirs, personal representatives, successors or assigns of the parties hereto. <br/>
RENEWAL	If the Advertiser renews the agreement for an additional time period the last month’s Monthly Charge shall be continued to be held on deposit and the Advertiser shall continue to make monthly payments without interruption. <br/>
COPY CHANGE	Advertiser shall give MOA forty five days written notice of the desired date of a copy Change by email. MOA shall agree to the copy change date by email. If the before requirement is meet by Advertiser and printed vinyl is delivered to NOA at least 20 days before the installation date and MOA fails to make copy change within thirty days of the copy change date Advertiser shall be given a credit of extended service equal to the period to of the time lost. Proration of the credit shall be based on a 30 day month. The cost of production and installation for each copy change shall be the responsibility of the Advertiser. NOA shall have no obligation to change copy if the Advertising is delinquent in any payments. MOA is under no obligation to store or retain removed copy from the display and any removed copy shall become the property of MOA. <br/>
AGREEMENT ASSIGNABLE	If the Advertiser’s business is sold or transferred during the term hereof the Advertiser shall require its successors in the interest to agree to discharge the Advertiser’s obligation to MOA, but the advertiser shall nevertheless continue to be directly liable to NOA hereunder. This agreement may not be reassigned without the written consent of MOA. <br/>
OUT OF SERVICE	If location specified in this agreement becomes unavailable during the term of the contract, it may be replaced by a location of approximately equal advertising value if available, and such new location shall be subject to the approval of the Advertiser. To compensate the Advertiser for any loss in advertising service, this contract shall be extended beyond the termination date for a period of time sufficient to equal the loss of advertising service, but at the option of MOA an out-of-service credit may be allowed to the Advertiser in lieu of such term extension. All prorated credits and charges are to be computed on a basis of a thirty day month. If any portion of the service included in this contract is not performed by MOA, MOA reserves the right to eliminate it from this contract or to issue credit to the Advertiser. If any space which is to be illuminated under the terms of this contract should be without illumination a credit shall rendered to the Advertiser for the period of non-illumination at the rate of 10% of the Monthly Charge for the loss of service for the said period. <br/>
ADVERTISING AGENCY	If this contract is signed by an Advertising Agency the term Advertiser as used herein shall include both the actual advertiser and the advertising agency where applicable, and all obligations of the Advertiser shall be the joint and several obligations of both the actual advertiser and the advertising agency. <br/>
ACTS OF GOD	MOA shall not be responsible for any failure of delays in the performance of its undertakings hereunder when due to fire, governmental restrictions, strikes, lockouts, acts of God, or any other act beyond its reasonable control. <br/>
UNAUTHORIZED REPRESENTATIONS	Neither party hereto shall be bound by any agreement or representation express or implied, not contained herein. The Advertiser hereby acknowledges that no representations agreements, or promises whatsoever have been made to the Advertiser other than those specifically stated herein. This contract is the final and complete agreement between the parties hereto, and may not be modified supplemented, explained or waived by parol evidence for by a course of dealing, nor in any other way except by modification or change reduced to writing and signed by authorized representatives of the Advertiser and MOA. Each person signing this contract, on behalf of the respective party represented warrants that they have full authority to do so. <br/>
';
		$pdf->writeHTML($text, true, 0, true, 0);

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// *** set signature appearance ***

		// create content for signature (image and/or text)
		//$pdf->Image('../images/tcpdf_signature.png', 180, 60, 1, 1, 'PNG');

		// define active area for signature appearance
		$pdf->setSignatureAppearance(180, 60, 15, 15);

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// *** set an empty signature appearance ***
		$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('signly_contract.pdf', 'I');

	}

	public function settings () {

	    $settings = ProposalSettings::where('user_id',$this->user->id)->first();
	    return view('proposal.settings',compact('settings'));
    }

}
