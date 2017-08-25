<?php namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $user = Auth::user();
        $clients = DB::table('clients')->where('instance_id',$user->instance_id)->paginate(10);
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


        $user = Auth::user();
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
                'instance_id' => $user->instance_id
            )
        );


        if ($id > 0){
//            if(Image::make($request->file('logo'))->height() < 300
//                ||  Image::make($request->file('logo'))->width() < 250){
//                dd(Image::make($request->file('logo'))->height(), '-' , Image::make($request->file('logo'))->width());
//            }
//            dd('erro');

//            $file = $request->file('logo');
//            $fileName = $file->getClientOriginalName();
//            $path = storage_path('app/public/clients_logo/').$id;

//            $file->move($path,$fileName);
//            DB::table('clients')->where('id',$id)->update(['logo' => $fileName]);

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
