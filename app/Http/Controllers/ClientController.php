<?php namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $clients = DB::table('clients')->where('instance_id',$user->instance_id)->where('deleted',0)->paginate(10);

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

            $path = storage_path('app/public/clients_logo/').$id;
            File::makeDirectory($path);
            $img1 = Image::canvas(600, 400, '#ffffff');
            $file = $request->file('logo');
            $array = explode('.',$file->getClientOriginalName());
            $fileName = $array[0].'.jpg';
            $img = Image::make($file)->resize(350, 240);
            $img1->insert($img,'center');
            $img1->save('storage/clients_logo/'.$id.'/'.$fileName);
            DB::table('clients')->where('id',$id)->update(['logo' => $fileName]);

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
