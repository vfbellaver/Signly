<?php namespace App\Http\Controllers;
use App\BillboardImage;
use App\Http\Requests\BillboardFormRequest;
use App\Http\Requests\BillboardFaceFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\BillboardBookingFormRequest;
use App\Http\Requests\SearchBillboardRequest;
use App\Http\Requests\BillboardUploadRequest;
use Illuminate\Support\Facades\Request;
use Response;
use View;
use DB;
use Storage;
use URL;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
class BillboardController extends Controller {
    private $user;
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
        $this->user = \Auth::user();
    }
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();
        return view('billboard.billboards',array('billboards' => $billboards ) );
    }
    public function billboardlist()
    {
        $clients = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
        $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();
        $billboard_bookings = DB::table('client_booking')
            ->join('clients', 'client_booking.client_id', '=', 'clients.id')
            ->select('client_booking.*', 'clients.first_name', 'clients.last_name')
            ->get();
        return view('billboard.billboards-list',array('billboards' => $billboards, 'billboard_bookings' => $billboard_bookings, 'clients' => $clients ) );
    }
    public function billboardlistbyvendor()
    {
        $billboards = DB::table('clients')->where('instance_id',$this->user->instance_id)->get();
        $billboard_bookings = DB::table('client_booking')
            ->join('clients', 'client_booking.client_id', '=', 'clients.id')
            ->select('client_booking.*', 'clients.first_name', 'clients.last_name')
            ->get();
        return view('billboard.billboards-list-vendor',array('billboards' => $billboards, 'billboard_bookings' => $billboard_bookings ) );
    }
    public function json()
    {
        if(Session::get('start_date') != ''){
            $start_date_converted = strtotime(Session::get('start_date'));
            $end_date_converted = strtotime(Session::get('end_date'));
            $start_date_new = date('Y-m-d',$start_date_converted);
            $end_date_new = date('Y-m-d',$end_date_converted);
            $filteredBillboards = DB::table('client_booking')
                ->select('billboard_id')
                ->whereNotBetween('book_start_date',array($start_date_new,$end_date_new))
                ->whereNotBetween('book_end_date',array($start_date_new,$end_date_new))
                ->get();
            $billboard_ids = array();

            foreach ($filteredBillboards as $filteredBillboard) {
                $billboard_ids[] = $filteredBillboard->billboard_id;
            }
            if(count($billboard_ids)){
                $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->whereNotIn('id',$billboard_ids)->get();
            } else {
                $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();
            }
        } else {
            $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->get();
        }
        $billboard_data = array();
        $billboard_included = 0;
        foreach ($billboards as $billboard) {
            $billboard_included = 0;
            $where_statement = 'billboard_id = '.$billboard->id;
            if (Session::get('show_all') != '1'){

                if (Session::get('left_read') == '1' || Session::get('right_read') == '1'){
                    $where_statement .= " AND (";
                    if (Session::get('left_read') == '1'){
                        $where_statement .= " billboard_faces.reads LIKE '%left%' OR billboard_faces.reads LIKE '%cross%'" ;
                    }
                    if (Session::get('right_read') == '1' && Session::get('left_read') == '1'){
                        $where_statement .= " OR billboard_faces.reads LIKE '%right%'";
                    } else if (Session::get('right_read') == '1' && Session::get('left_read') == '0'){
                        $where_statement .= " billboard_faces.reads LIKE '%right%'";
                    }
                    $where_statement .= " )";
                }
                if (Session::get('north_facing') == '1' ||
                    Session::get('south_facing') == '1' ||
                    Session::get('east_facing') == '1' ||
                    Session::get('west_facing') == '1'){
                    $where_statement .= " AND (";
                    if (Session::get('north_facing') == '1'){
                        $where_statement .= " label LIKE '%NORTH%'";
                    }
                    if (Session::get('south_facing') == '1' &&
                        Session::get('north_facing') == '1'){
                        $where_statement .= " OR label LIKE '%SOUTH%' ";
                    } else if (Session::get('south_facing') == '1') {
                        $where_statement .= " label LIKE '%SOUTH%'";
                    }
                    if (Session::get('east_facing') == '1' AND
                        (Session::get('south_facing') == '1' ||
                            Session::get('north_facing') == '1')){
                        $where_statement .= " OR label LIKE '%EAST%' ";
                    } else if (Session::get('east_facing') == '1') {
                        $where_statement .= " label LIKE '%EAST%' ";
                    }
                    if (Session::get('west_facing') == '1' AND
                        (Session::get('east_facing') == '1' ||
                            Session::get('south_facing') == '1' ||
                            Session::get('north_facing') == '1')){
                        $where_statement .= " OR label LIKE '%WEST%' ";
                    } else if (Session::get('west_facing') == '1') {
                        $where_statement .= " label LIKE '%WEST%' ";
                    }
                    $where_statement .= " )";
                }
                if (Session::get('digital') == '1' ||
                    Session::get('static') == '1'){
                    $where_statement .= " AND (";
                    if (Session::get('digital') == '1'){
                        $where_statement .= " sign_type = 1 ";
                    }
                    if (Session::get('static') == '1' AND Session::get('digital') == '1'){
                        $where_statement .= " OR sign_type = 0 ";
                    } else {
                        $where_statement .= " sign_type = 0 ";
                    }
                    $where_statement .= " )";
                }

            } else {
                Session::put('show_all', '1');
                Session::put('left_read', '0');
                Session::put('right_read', '0');
                Session::put('north_facing', '0');
                Session::put('south_facing', '0');
                Session::put('east_facing', '0');
                Session::put('west_facing', '0');
                Session::put('digital', '0');
                Session::put('static', '0');
            }
            $billboard_faces = DB::table('billboard_faces')->whereRaw($where_statement)->get();
            foreach ($billboard_faces as $billboard_face ) {
                if($billboard->id == $billboard_face->billboard_id){
                    $billboard_included = 1;
                }
            }
            if ($billboard_included == 1){
                $billboard_data[] = array('billboard'=>$billboard,'faces'=>$billboard_faces);
            }

        }
        return response()->json($billboard_data);
    }
    public function jsonHash($hash)
    {
        $proposal = DB::table('proposal')->where('hash',$hash)->first();
        $proposal_billboards = DB::table('proposal_billboard')->where('proposal_id',$proposal->id)->get();
        $billboard_ids = array();
        foreach ($proposal_billboards as $proposal_billboard) {
            $billboard_ids[] = $proposal_billboard->billboard_id;
        }

        $billboards = DB::table('billboard')->where('instance_id',$this->user->instance_id)->whereIn('id',$billboard_ids)->get();
        $billboard_data = array();
        foreach ($billboards as $billboard) {
            $billboard_faces = DB::table('billboard_faces')->where('billboard_id',$billboard->id)->get();
            $billboard_data[] = array('billboard'=>$billboard,'faces'=>$billboard_faces);
        }
        return response()->json($billboard_data);
    }
    public function jsonDaypilot()
    {
        $billboards = DB::table('billboard')->select('id','name','billboard_id','address','monthly_impressions')->where('instance_id',$this->user->instance_id)->get();
        $billboard_data = array();
        foreach ($billboards as $billboard) {
            //$billboard_faces = DB::table('billboard_faces')->select(DB::raw('CONCAT(id,label) as id'),'label as name')->where('billboard_id',$billboard->id)->get();
            //$billboard->children = $billboard_faces;
            //$billboard_data[] = $billboard; //array('billboard'=>$billboard,'children'=>$billboard_faces);
            $billboard_faces = DB::table('billboard_faces')->select(DB::raw('CONCAT(id) as id'),DB::raw("'".$billboard->name."' as name"),'reads','label','height','width','hard_cost' )->where('billboard_id',$billboard->id)->get();
            foreach ($billboard_faces as $billboard_face) {
                $billboard_data[] = array(
                    'id' => $billboard_face->id,
                    'name'=>$billboard_face->id,
                    'columns'=>array(
                        array('html'=>$billboard->address),
                        array('html'=> $this->facingConverter($billboard_face->label)),
                        array('html'=>$billboard_face->reads),
                        array('html'=>$billboard_face->height.'X'.$billboard_face->width),
                        array('html'=> '$'.number_format($billboard_face->hard_cost,2)),
                        array('html'=>$billboard->monthly_impressions)
                    )
                );
            }

        }
        return response()->json($billboard_data);
    }
    private function facingConverter($billboard_label){
        switch (strtolower($billboard_label) ) {
            case 'north':
                return 'NF';
                break;
            case 'south':
                return 'SF';
                break;
            case 'east':
                return 'EW';
                break;
            case 'west':
                return 'WF';
                break;

        }
    }
    public function jsonDaypilotEvents(EventFormRequest $request)
    {
        $image_url = URL::to('/images/billboard/');
        $noimage_url = URL::to('/images/');
        // $events = DB::select("SELECT
        // 						client_booking.id as id,
        // 						CONCAT(billboard_faces.id,billboard_faces.label) as resource,
        // 						client_booking.description as text,
        // 						client_booking.book_start_date as start,
        // 						client_booking.book_end_date as end,
        // 						IF(billboard_faces.photo IS NULL or billboard_faces.photo !='',
        // 						CONCAT('<img id=\"bi_face', billboard_faces.id,'\" class=\"billboard_images\" src=\"$image_url','/',billboard_faces.photo,'\" width=\"20%\" />') ,
        // 						CONCAT('<img id=\"bi_face', billboard_faces.id,'\" class=\"billboard_images\" src=\"$noimage_url/no-preview.jpg','\" width=\"100%\" />')
        // 						) as bubbleHtml
        // 					  FROM client_booking INNER join
        // 					  billboard_faces ON client_booking.billboard_face_id = billboard_faces.id
        // 					  WHERE NOT ((book_end_date <= ?) OR (book_start_date >= ?))",
        // 					  array($request->input('start'),$request->input('end') )
        // 					  );
        $events = DB::select("SELECT 
								CONCAT(client_booking.id) as id,
								CONCAT(billboard_faces.id) as resource,
								client_booking.description as text,
								client_booking.book_start_date as start,
								client_booking.book_end_date as end,
								IF(billboard_faces.photo IS NULL or billboard_faces.photo !='',
								CONCAT('<img id=\"bi_face', billboard_faces.id,'\" class=\"billboard_images\" src=\"$image_url','/',billboard_faces.photo,'\" width=\"20%\" />') ,
								CONCAT('<img id=\"bi_face', billboard_faces.id,'\" class=\"billboard_images\" src=\"$noimage_url/no-preview.jpg','\" width=\"100%\" />') 
								) as bubbleHtml
							  FROM client_booking INNER join
							  billboard_faces ON client_booking.billboard_face_id = billboard_faces.id
							  WHERE NOT ((book_end_date <= ?) OR (book_start_date >= ?))",
            array($request->input('start'),$request->input('end') )
        );

        return response()->json($events);
    }
    public function facesJson($id)
    {
        $billboard_faces = DB::table('billboard_faces')->where('billboard_id',$id)->get();
        return response()->json($billboard_faces);
    }
    public function faceJson($id)
    {
        $billboard_face = DB::table('billboard_faces')->where('id',$id)->first();
        return response()->json($billboard_face);
    }
    public function tooltip($id)
    {
        $billboard = DB::table('billboard')->where('id',$id)->first();
        $data_text = '<img id="bi_6" class="billboard_images" src="http://www.signly.com/app/images/billboard.jpg" width="100%">'.
            '<strong>'.$billboard->name.'</strong>'.
            '<p>'.$billboard->description.'</p>';
        return $data_text;
    }
    public function get($id)
    {
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $billboard = DB::table('billboard')->where('id',$id )->first();
        $billboard_faces = DB::table('billboard_faces')->where('billboard_id',$id )->get();
        return view('billboard.get',array('billboard' => $billboard , 'billboard_faces' => $billboard_faces, 'storage_path' => $storagePath) );
    }
    public function add(){
        $owners = DB::table('owners')->where('instance_id',$this->user->instance_id)->get();
        return view('billboard.add', array('owners' => $owners));
    }

    public function store(BillboardFormRequest $request)
    {

        $file = $request->file('image');
        dd($file);

        if($file){
            $image = new BillboardImage();
            $image->image_name = $picture->getClientOriginalName();
            $image->location = "Default";
            $image->save();
        }


            //DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        $id = DB::table('billboard')->insertGetId(
            array(
                'owner_id' => $request->input('billboard_owner'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'digital_driveby' => $request->input('digital_driveby'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('long'),
                'hard_cost' => $request->input('hard_cost'),
                'monthly_impressions' => $request->input('monthly_impressions'),
                'instance_id' => $this->user->instance_id,
                'created_at' => date('Y-m-d')
            )
        );
        if ($id > 0){
            return redirect('/billboards/'.$id);
        } else {
            $request::flash('Error encountered');
        }

    }
    public function addbillboardface(BillboardFaceFormRequest $request,$id){
        $destinationPath = '';
        $extension = '';
        $fileName = '';
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // checking file is valid.
        if ($request->file('image')->isValid()) {
            $destinationPath = $storagePath.'/images'; // upload path
            $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = md5(time()).'.'.$extension; // renameing image
            $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
        }
        $sign_type = 0;
        if($request->has('sign_type')){
            if($request->input('sign_type') == 'static'){
                $sign_type = 0;
            }else{
                $sign_type = 1;
            }
        }
        $id = DB::table('billboard_faces')->insertGetId(
            array(
                'billboard_id' => $request->input('billboard_id'),
                'unique_id' => $request->input('unique_id'),
                'height' => $request->input('height'),
                'width' => $request->input('width'),
                'reads' => $request->input('reads'),
                'label' => strtoupper($request->input('label')),
                'hard_cost' => $request->input('hard_cost'),
                'monthly_impressions' => $request->input('monthly_impressions'),
                'digital_driveby' => $request->input('digital_driveby'),
                'sign_type' => $sign_type,
                'notes' => $request->input('notes'),
                'max_ads' => $request->input('max_ads'),
                'duration' => $request->input('duration'),
                'photo' => $fileName
            )
        );
        if ($id > 0){
            return redirect('/billboards/'.$request->input('billboard_id'));
        } else {
            $request::flash('Error encountered');
        }
    }
    public function updatebillboardface(BillboardFaceFormRequest $request,$id){
        $destinationPath = '';
        $extension = '';
        $fileName = '';
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // checking file is valid.
        if($request->has('image')){
            if ($request->file('image')->isValid()) {
                $destinationPath = $storagePath.'/images'; // upload path
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = md5(time()).'.'.$extension; // renameing image
                $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
            }
        }

        $sign_type = 0;
        if($request->has('sign_type')){
            if($request->input('sign_type') == 'static'){
                $sign_type = 0;
            }else{
                $sign_type = 1;
            }
        }
        if($fileName != ''){
            $id = DB::table('billboard_faces')
                ->where('id',$request->input('billboard_face_id'))
                ->update(
                    [
                        'billboard_id' => $request->input('billboard_id'),
                        'unique_id' => $request->input('unique_id'),
                        'height' => $request->input('height'),
                        'width' => $request->input('width'),
                        'reads' => $request->input('reads'),
                        'label' => strtoupper($request->input('label')),
                        'hard_cost' => $request->input('hard_cost'),
                        'monthly_impressions' => $request->input('monthly_impressions'),
                        'digital_driveby' => $request->input('digital_driveby'),
                        'sign_type' => $sign_type,
                        'notes' => $request->input('notes'),
                        'max_ads' => $request->input('max_ads'),
                        'duration' => $request->input('duration'),
                        'photo' => $fileName
                    ]
                );
        } else {
            $id = DB::table('billboard_faces')
                ->where('id',$request->input('billboard_face_id'))
                ->update(
                    [
                        'billboard_id' => $request->input('billboard_id'),
                        'unique_id' => $request->input('unique_id'),
                        'height' => $request->input('height'),
                        'width' => $request->input('width'),
                        'reads' => $request->input('reads'),
                        'label' => strtoupper($request->input('label')),
                        'hard_cost' => $request->input('hard_cost'),
                        'monthly_impressions' => $request->input('monthly_impressions'),
                        'digital_driveby' => $request->input('digital_driveby'),
                        'sign_type' => $sign_type,
                        'notes' => $request->input('notes'),
                        'max_ads' => $request->input('max_ads'),
                        'duration' => $request->input('duration')
                    ]
                );
        }

        if ($id > 0){
            return redirect('/billboards/'.$request->input('billboard_id'));
        } else {
            $request::flash('Error encountered');
        }
    }
    public function book(BillboardBookingFormRequest $request){
        $booking_exists = 0;
        $destinationPath = '';
        $extension = '';
        $fileName = '';
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // checking file is valid.
        // if ($request->file('image')->isValid()) {
        //  $destinationPath = $storagePath.'/booking_images'; // upload path
        //  $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
        //  $fileName = md5(time()).'.'.$extension; // renameing image
        //  $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
        // }
        //Check client booking overlap
        $booking_id = 0;
        $billboard_face = DB::table('billboard_faces')->select('id','billboard_id')->where('id',$request->input('billboard_face_id'))->first();
        $existing_booking_1 = DB::table('client_booking')
            ->select('id','billboard_id')
            ->where('book_start_date','<=',date('Y-m-d h:i:s',strtotime($request->input('bend_date'))))
            ->where('book_end_date','>=',date('Y-m-d h:i:s',strtotime($request->input('bstart_date'))))
            ->where('billboard_face_id',$billboard_face->id)
            ->first();
        // $existing_booking_2 = DB::table('client_booking')
        // 					->select('billboard_id')
        // 					->where('book_start_date','>=',date('Y-m-d h:i:s',strtotime($request->input('bend_date'))))
        // 					->where('book_end_date','<=',date('Y-m-d h:i:s',strtotime($request->input('bend_date'))))
        // 					->where('billboard_id',$billboard_face->billboard_id)
        // 					->first();
        if($existing_booking_1 != null){
            if ( property_exists($existing_booking_1, 'billboard_id')){
                $booking_exists = 1;
            }
        }

        if ($booking_exists == 0){
            $booking_id = DB::table('client_booking')->insertGetId(
                array(
                    'billboard_id' => $billboard_face->billboard_id,
                    'billboard_face_id' => $request->input('billboard_face_id'),
                    'client_id' => $request->input('client_id'),
                    'book_start_date' => date('Y-m-d h:i:s',strtotime($request->input('bstart_date'))),
                    'book_end_date' => date('Y-m-d h:i:s',strtotime($request->input('bend_date'))),
                    'description' => $request->input('description')
                )
            );
            if ($booking_id > 0){
                return redirect(URL::to('/').'/billboard-booking');
            } else {
                $request::flash('Error encountered');
            }
        } else{
            return redirect(URL::to('/').'/billboard-booking')->withErrors(array('msg'=>'Booking date cannot overlap'));
        }
        // $booking_id = DB::table('client_booking')->insertGetId(
        //     array(
        // 		    'billboard_id' => $billboard_face->billboard_id,
        //             'billboard_face_id' => $request->input('billboard_face_id'),
        //             'client_id' => $request->input('client_id'),
        //             'book_start_date' => date('Y-m-d h:i:s',strtotime($request->input('bstart_date'))),
        //             'book_end_date' => date('Y-m-d h:i:s',strtotime($request->input('bend_date'))),
        //             'description' => $request->input('description'),
        //             'set_price' => $request->input('set_price'),
        //             'photo' => $fileName
        //     	  )
        // );


    }
    public function searchBillboard(SearchBillboardRequest $request)
    {
        // $billboards = DB::select("SELECT billboard.name as value,
        // 								 billboard.id as id,
        // 								 billboard.lat as lat,
        // 								 billboard.lng as lng
        // 						  FROM billboard
        // 						  WHERE CONCAT(
        // 						  				billboard.name,
        // 						  				billboard.description,
        // 						  				billboard.address,
        // 						  				billboard.city,
        // 						  				billboard.state,
        // 						  				billboard.zipcode,
        // 						  				billboard.lat,
        // 						  				billboard.lng,
        // 						  				billboard.hard_cost
        // 						  				) LIKE '%?%' ",
        // 						  array($request->input('q'))
        // 					    );
        $billboards = DB::table('billboard')->select('billboard.name as value',
            'billboard.id as id',
            'billboard.lat as lat',
            'billboard.lng as lng')
            ->whereRaw("LOWER(CONCAT( 
								  				billboard.name,
								  				billboard.description,
								  				billboard.address,
								  				billboard.city,
								  				billboard.state,
								  				billboard.zipcode,
								  				billboard.lat,
								  				billboard.lng,
								  				billboard.hard_cost
								  				)) LIKE LOWER(?) AND billboard.instance_id = ?",array('%'.$request->input('q').'%',$this->user->instance_id))->get();
        $billboard_faces = DB::table('billboard_faces')->select( DB::raw("CONCAT(billboard.name, '(',billboard_faces.unique_id,')') as value"),
            'billboard.id as id',
            'billboard.lat as lat',
            'billboard.lng as lng')
            ->join('billboard', 'billboard.id', '=', 'billboard_faces.billboard_id')
            ->whereRaw("LOWER(CONCAT( 
								   				billboard_faces.unique_id,
								  				billboard_faces.height,
								  				billboard_faces.width,
								  				billboard_faces.reads,
								  				billboard_faces.label,
								  				billboard_faces.sign_type,
								  				billboard_faces.hard_cost,
								  				billboard_faces.monthly_impressions,
								  				billboard_faces.notes,
								  				billboard_faces.max_ads,
								  				billboard_faces.duration,
								  				billboard_faces.notes
								  				)) LIKE LOWER(?) AND billboard_faces.instance_id = ?", array('%'.$request->input('q').'%',$this->user->instance_id))->get();

        return response()->json(array_merge($billboards,$billboard_faces));
    }
    function getUploadBillboard(){
        return view('billboard.upload');
    }
    function saveUploadBillbaord(BillboardUploadRequest $request){
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        // checking file is valid.
        if ($request->file('billboard_file')->isValid() && $request->file('billboard_face_file')->isValid()) {

            //  $destinationPath = $storagePath.'/excels'; // upload path
            //  $extension = $request->file('billboard_file')->getClientOriginalExtension(); // getting image extension
            //  $fileName = md5(time()).'.'.$extension; // renaming image
            //  $request->file('billboard_file')->move($destinationPath, $fileName); // uploading file to given path

            //  Excel::load($storagePath.'/excels/'.$fileName, function ($reader) {
            //         foreach ($reader->toArray() as $row) {
            //             $address = urlencode(trim($row['address']).' '.trim($row['city']).' '.trim($row['state']));
            // $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=US";
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // $response = curl_exec($ch);
            // curl_close($ch);
            // $response_a = json_decode($response);
            // if (count($response_a->results)){
            // 	$geocode_lat = $response_a->results[0]->geometry->location->lat;
            // 	$geocode_long = $response_a->results[0]->geometry->location->lng;
            // } else {
            // 	$geocode_lat = 0;
            // 	$geocode_long = 0;
            // }

            //  			 $id = DB::table('billboard')->insertGetId(
            // 	    array(
            // 			    'billboard_id' => $row['billboard_id'],
            // 	            'name' => $row['billboard_id'],
            // 	            'address' => $row['address'],
            // 	            'city' => $row['city'],
            // 	            'state' => $row['state'],
            // 	            'zipcode' => $row['zip'],
            // 	            'digital_driveby' => $row['driveby_url'],
            // 	            'lat' => $geocode_lat,
            // 	            'lng' => $geocode_long,
            // 	            'rate' => '10000',
            // 	            'hard_cost' => '12000'
            // 	    	  )
            // 	);
            //         }
            //  });
            //billboard face file
            $destinationPath = $storagePath.'/excels'; // upload path
            $extension = $request->file('billboard_face_file')->getClientOriginalExtension(); // getting image extension
            $fileName = md5(time()).'.'.$extension; // renaming image
            $request->file('billboard_face_file')->move($destinationPath, $fileName); // uploading file to given path

            Excel::load($storagePath.'/excels/'.$fileName, function ($reader) {
                foreach ($reader->toArray() as $row) {
                    print_r($row);
                    $billboard_data = DB::table('billboard')->select('id')->where('billboard_id',$row['billboard_id'])->first();

                    $id = DB::table('billboard_faces')->insertGetId(
                        array(
                            'billboard_id' => $billboard_data->id,
                            'label' => $row['label'],
                            'unique_id' => $row['unique_id'],
                            'height' => $row['height'],
                            'width' => $row['width'],
                            'reads' => $row['reads'],
                            'hard_cost' => $row['face_hard_cost'],
                            'monthly_impressions' => $row['face_monthly_impressions'],
                            'digital_driveby' => $row['face_driveby_url'],
                            'sign_type' => $row['type'],
                            'notes' => $row['notes'],
                            'max_ads' => $row['max_ads'],
                            'duration' => $row['duration'],
                            'photo' => $row['face_image_url']
                        )
                    );
                }
            });
        }
    }
    function destroy($id){
        $delete_id = DB::table('billboard')->where('id',$id)->delete();
        $delete_id = DB::table('billboard_faces')->where('billboard_id',$id)->delete();
        return redirect('/billboards');
    }
    function deleteBooking($id){
        $delete_id = DB::table('client_booking')->where('id',$id)->delete();
        return redirect('/billboard-booking');
    }

}