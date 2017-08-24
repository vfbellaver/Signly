<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;
use Response;
use View;
use Session;
use URL;
use App\Http\Requests\BillboardFilterDashboardRequest;
use App\Http\Requests\BugReportFormRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

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
		$this->middleware('auth');

		if(!Session::has('show_all')){
			Session::put('show_all', '1');
		}
		if(!Session::has('left_read')){
			Session::put('left_read', '0');
		}
		if(!Session::has('right_read')){
			Session::put('right_read', '0');
		}
		if(!Session::has('north_facing')){
			Session::put('north_facing', '0');
		}
		if(!Session::has('south_facing')){
			Session::put('south_facing', '0');
		}
		if(!Session::has('east_facing')){
			Session::put('east_facing', '0');
		}
		if(!Session::has('west_facing')){
			Session::put('west_facing', '0');
		}
		if(!Session::has('digital')){
			Session::put('digital', '0');
		}
		if(!Session::has('static')){
			Session::put('static', '0');
		}

		$this->user = \Auth::user();
		
		
	}

	public function account()
	{
		$user = Auth::user();
		return view('auth.account',array('user' => $user));
	}

	/**
	* Update the account of the current active user.
	* 
	*/
	public function updateUser(UserUpdateRequest $request)
	{
		$hasher = new BcryptHasher;
		$user = Auth::user();
		$user->first_name = Request::input('first_name');
		$user->last_name = Request::input('last_name');
		$user->email = Request::input('email');
		$user->password = $hasher->make(Request::input('password'));
		$user->save();

		return Redirect::to('/account');

	}

	public function clientView($hash)
	{
		Session::put('start_date', date('m/d/Y'));
		Session::put('end_date', date('m/d/Y',strtotime('05/01/2015')));

		$proposal = DB::table('proposal')->where('hash',$hash)->first();

		$proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$proposal->id)->get();		

		$billboard_ids = array();

		foreach ($proposal_billboards as $proposal_billboard) {
			$billboard_ids[] = $proposal_billboard->billboard_id;
		}
		
		$clients = DB::table('clients')->where('id',$proposal->client_id)->where('instance_id',$this->user->instance_id)->get();
		
		$billboards = DB::table('billboard')->whereIn('id',$billboard_ids)->get();

		$proposals = array();
		
		$proposals = DB::table('active_proposal')
            ->join('proposal', 'active_proposal.proposal_id', '=', 'proposal.id')
            ->select('active_proposal.id as apid','proposal.*')
            ->where('proposal.id',$proposal->id)
            ->first();
        
        $active_proposal_billboards = array();

        if(isset($proposals)){
	        if($proposals->apid > 0){
	        	$active_proposal_billboards = DB::table('active_proposal_billboards')
	            ->join('billboard', 'active_proposal_billboards.billboard_id', '=', 'billboard.id')
	            ->select('active_proposal_billboards.id as apbid','active_proposal_billboards.proposal_price as monthly_price','billboard.*')
	            ->where('active_proposal_id',$proposals->apid)
	            ->get();	
	        }
        }


        $user = array();



		return view('clientview',array('clients' => $clients, 
								'active_proposal' => $proposals, 
								'active_proposal_billboards' => $active_proposal_billboards, 
								'billboards' => $billboards,
								'user' => $user,
								'hash' => $hash ));
	}

	public function redirectToDashbaord(){
		return redirect('/dashboard');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		Session::put('start_date', '');
		Session::put('end_date', '');
		
		if($request->input('show_all') == 1){
			Session::put('show_all', '1');
			Session::put('left_read', '0');
			Session::put('right_read', '0');
			Session::put('north_facing', '0');
			Session::put('south_facing', '0');
			Session::put('east_facing', '0');
			Session::put('west_facing', '0');
			Session::put('digital', '0');
			Session::put('static', '0');
		} else {


			if($request->input('left_read') == 1){
				Session::put('left_read', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('left_read', '0');
			}

			if($request->input('right_read') == 1){
				Session::put('right_read', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('right_read', '0');
			}

			if($request->input('north_facing') == 1){
				Session::put('north_facing', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('north_facing', '0');
			}

			if($request->input('south_facing') == 1){
				Session::put('south_facing', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('south_facing', '0');
			}

			if($request->input('east_facing') == 1){
				Session::put('east_facing', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('east_facing', '0');
			}

			if($request->input('west_facing') == 1){
				Session::put('west_facing', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('west_facing', '0');
			}

			if($request->input('digital') == 1){
				Session::put('digital', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('digital', '0');
			}

			if($request->input('static') == 1){
				Session::put('static', '1');
				Session::put('show_all', '0');
			} else {
				Session::put('static', '0');
			}

		}
		
		$user = \Auth::user();

		$clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
		
		$billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();

		$proposals = array();
		$comments = array();

		$proposals = DB::table('active_proposal')
            ->join('proposal', 'active_proposal.proposal_id', '=', 'proposal.id')
            ->select('active_proposal.id as apid','proposal.*')
            ->where('active_proposal.user_id',$user->id)
            ->first();
        
        $active_proposal_billboards = array();


        if(isset($proposals)){
	        if($proposals->apid > 0){
	        	$active_proposal_billboards = DB::table('active_proposal_billboards')
	            ->join('billboard', 'active_proposal_billboards.billboard_id', '=', 'billboard.id')
	            ->join('billboard_faces', 'active_proposal_billboards.billboard_face_id','=', 'billboard_faces.id')
	            ->select('active_proposal_billboards.id as apbid',
	            	'active_proposal_billboards.proposal_price as monthly_price',
                    'active_proposal_billboards.order_proposal_billboards as order',
	            	'billboard.*',
	            	'billboard_faces.id as billboard_face_id', 
	            	'billboard_faces.label')
	            ->where('active_proposal_id',$proposals->apid)
	            ->where('active_proposal_billboards.user_id',$user->id)
                ->orderBy('order_proposal_billboards','ASC')
	            ->get();	
	        }

	        $comments = DB::table('proposal_comments')
	            ->where('proposal_id',$proposals->id)
	            ->orderBy('id','asc')
	            ->get();
 		}

		return view('home',array('clients' => $clients, 
								'active_proposal' => $proposals, 
								'active_proposal_billboards' => $active_proposal_billboards, 
								'billboards' => $billboards,
								'comments' => $comments,
								'user' => $user ));
	}

	public function indexFilter(BillboardFilterDashboardRequest $request)
	{
		Session::put('start_date', $request->input('start_date'));
		Session::put('end_date', $request->input('end_date'));

		$user = \Auth::user();

		$clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
		
		$billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();

		$proposals = array();
		
		$proposals = DB::table('active_proposal')
            ->join('proposal', 'active_proposal.proposal_id', '=', 'proposal.id')
            ->select('active_proposal.id as apid','proposal.*')
            ->where('active_proposal.user_id',$user->id)
            ->first();
        
        $active_proposal_billboards = array();

        if(isset($proposals)){
	        if($proposals->apid > 0){
	        	$active_proposal_billboards = DB::table('active_proposal_billboards')
	            ->join('billboard', 'active_proposal_billboards.billboard_id', '=', 'billboard.id')
	            ->join('billboard_faces', 'active_proposal_billboards.billboard_face_id','=', 'billboard_faces.id')
	            ->select('active_proposal_billboards.id as apbid',
	            	'active_proposal_billboards.proposal_price as monthly_price',
	            	'billboard.*',
	            	'billboard_faces.id as billboard_face_id', 
	            	'billboard_faces.label')
	            ->where('active_proposal_id',$proposals->apid)
	            ->where('active_proposal_billboards.user_id',$user->id)
	            ->get();
	        }
        }
        
        $comments = DB::table('proposal_comments')
            ->where('proposal_id',$proposals->apid)
            ->orderBy('created_at','asc')
            ->get();

		return view('home',array('clients' => $clients, 
								'active_proposal' => $proposals, 
								'active_proposal_billboards' => $active_proposal_billboards, 
								'billboards' => $billboards,
								'user' => $user,
								'comments' => $comments,
								'start_date' => $request->input('start_date'),
								'end_date' => $request->input('end_date')
								 ));
	}

	public function sendBugReport(BugReportFormRequest $request){
		

		$data['bugdescription'] = $request->bugdescription;
		$template = 'emails/bugreport';
		$subject = 'Signly Bug Report';
		$email = "mike@signly.com";

		Mail::send($template, $data, function($message) use ($email, $subject)
			{
				$message->from('noreply@signly.com', 'Signly.com');
				$message->to($email)->subject($subject);
			});	

		return redirect(URL::to('/'));
	}

	public function instanceView(Request $request)
	{
		
		
		$user = \Auth::user();

	
		$instances = array();
	

		$instances = DB::table('instance')->get();

        
		return view('instance.instances',array('instances' => $instances, 
								'user' => $user ));
	}

	public function instanceUsers($instance_id)
	{
		
		$user = \Auth::user();
		$instance_users = array();
		$instance_users = DB::table('users')->where('instance_id',$instance_id)->get();
        
		return view('instance.users',array('instance_users' => $instance_users, 
								'user' => $user,'instance_id' => $instance_id  ));
	}

	public function addInstance(){
		$user = \Auth::user();
        
		return view('instance.add',array('user' => $user ));
	}

	public function storeInstance(Request $request){

		$id = DB::table('instance')->insertGetId(
									    array(
									    		
									    	  	'instance' => $request['instance'],
									    	  	'notes' => $request['notes']

									    	  )
									);

		return redirect(URL::to('/instances'));

	}

	public function addInstanceUser($id){
		$user = \Auth::user();
        
		return view('instance.register',array('user' => $user, 'instance_id' => $id ));
	}

	public function storeInstanceUser(Request $request){
		$hasher = new BcryptHasher;

		//$request->merge(['password' => $hasher->make($request->password)]);
        
		// print_r($request->all());
		// exit();

        //$user = User::create($request->all());

		$id = DB::table('users')->insertGetId(
									    array(
									    		
									    	  	'first_name' => $request->first_name,
									    	  	'last_name' => $request->last_name,
									    	  	'email' => $request->email,
									    	  	'password' => $hasher->make($request->password),
									    	  	'instance_id' => $request->instance_id,
									    	  	'updated_at' => date('Y-m-d'),
									    	  	'created_at' => date('Y-m-d')

									    	  )
									);


		return redirect(URL::to('/instance-users/'.$request->instance_id));
	}

	public function deleteInstanceUser($id){
		$delete_id = DB::table('users')
            ->where('id', $id)
            ->update(['deleted' => 1, 'deleted_at' => date('Y-m-d')]);
		return redirect(URL::back());
	}

	public function getComments($proposal_id){
		$comments = DB::table('proposal_comments')
	            ->where('proposal_id',$proposal_id)
	            ->orderBy('id','asc')
	            ->get();

	    return view('comments',array('comments' => $comments));
	}

	public function getCommentsClient($proposal_id)
    {
        $comments = DB::table('proposal_comments')
            ->where('proposal_id', $proposal_id)
            ->orderBy('id', 'asc')
            ->get();

        return view('comments_client', array('comments' => $comments));

    }
	public function sortable()
        {
            $user = \Auth::user();
            $active_proposal_billboards = DB::table('active_proposal_billboards')
                ->where('active_proposal_billboards.user_id', $user->id)
                ->orderBy('order_proposal_billboards', 'ASC')->get();


            $ac_proposalIndex = explode('-',Input::get('ac_proposalIndex'));
            $ac_proposalId = explode('-',Input::get('ac_proposalId'));
            $id = end($ac_proposalId);
            $order = end($ac_proposalIndex);


            foreach ($active_proposal_billboards as $item) {
               return DB::table('active_proposal_billboards')->where('id', $id)
                    ->update(['order_proposal_billboards' => $order]);
            }
        }
    }


