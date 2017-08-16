<?php namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use Illuminate\Support\Facades\Storage;
use Response;
use View;
use DB;

class ClientController extends Controller {

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
		$clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->paginate(10);
		return view('client.clients',array('clients' => $clients ) );
	}

	public function get($id)
	{
		$client = DB::table('clients')->where('id',$id)->where('deleted',0)->first();
		return view('client.get',array('client' => $client ) );
	}

	public function add(){
		return view('client.add');	
	}

	public function store(ClientFormRequest $request){
		
		//DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);

        $file = $request->file('logo');

        $id = DB::table('clients')->insertGetId(
		    array(
		    		'company' => $request->input('company'),
		    	  	'first_name' => $request->input('first_name'),
		    	  	'last_name' => $request->input('last_name'),
		    	  	'email' => $request->input('email'),
		    	  	'phone1' => $request->input('phone1'),
		    	  	'phone2' => $request->input('phone2'),
		    	  	'fax' => $request->input('fax'),
		    	  	'billing_address' => $request->input('billing_address'),
		    	  	'billing_city' => $request->input('billing_city'),
		    	  	'billing_state' => $request->input('billing_state'),
		    	  	'billing_zipcode' => $request->input('billing_zipcode'),
		    	  	'instance_id' => $this->user->instance_id
		    	  )
		);


		if ($id > 0){
            $path = storage_path('app/public/storage/clients_logo/').$id;
            $fileName = $file->getClientOriginalName();
            $url = $path.'/'.$fileName;
            $file->move($path,$fileName);

            DB::table('clients')->where('id',$id)->update(['logo' => $url]);

			return redirect('/clients');
		} else {
			$request::flash('Error encountered');
		}
		
	}	

	public function deleteClient($id){
		$delete_id = DB::table('clients')
            ->where('id', $id)
            ->update(['deleted' => 1, 'deleted_at' => date('Y-m-d')]);
		return redirect('/clients');
	}


}
