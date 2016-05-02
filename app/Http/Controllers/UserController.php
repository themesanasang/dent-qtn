<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Input;
use Image;
use Request;
use Session;
use View;
use Redirect;
use Validator;
use Hash;
use DB;
use Crypt;
use App\Models\Province;
use App\Models\Amphur;
use App\Models\District;

class UserController extends Controller {

    
    
    
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(  Session::get('status') == '1'  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {                    
            $user = User::all();
                        
            return View::make( 'user.index', array('user' => $user) );
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    
    
    
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if( Session::get('status') == '1'  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            //ดึงข้อมูลจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            } 

            return View::make( 'user.create', array( 'province' => $province_name ) );
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    
    
    
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if( Session::get('status') == '1'  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {           
            $postData = Input::All();
                    
            $messages = [
                'name.required'         => 'กรุณากรอก:',
                'username.required'     => 'กรุณากรอก:',
                'password.required'     => 'กรุณากรอก:', 
            ];

             $rules = [
                'name'             => 'required', 
                'username'         => 'required', 
                'password'         => 'required', 
             ];

            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()) {               
                return Redirect::route('user.create')->withInput()->withErrors($validator);
            }
            else
            {
                $data = Request::all();
                $count = User::where('username', '=', $data['username'])->count();
                
                if( $count == 0 )
                {
                    $hash = $this->hashSSHA($data['password']);
                    $encrypted_password = $hash["encrypted"]; // encrypted password
                    $salt = $hash["salt"]; // salt

                    $user = new User;
                    $user->name         = $data['name'];
                    $user->username     = $data['username'];
                    $user->password     = $encrypted_password;
                    $user->salt         = $salt;
                    $user->address      = $data['address'];
                    $user->chwpart      = $data['chwpart'];
                    $user->amppart      = $data['amppart'];
                    $user->tmbpart      = $data['tmbpart'];
                    $user->workat       = $data['workat'];
                    $user->activated    = $data['activated'];
                    $user->status       = $data['status'];
                    $user->create_by    = Session::get('username');
                    
                    DB::transaction(function() use ($user) {
                        $user->save();  
                    }); 

                    Session::flash( 'savedata', save_data );  
                }
                else
                {
                    Session::flash('error_username_no', 'มีชื่อผู้ใช้งานนี้แล้ว');
                }
                
                return Redirect::to('user');
            }
        }
        else
        {
            return Redirect::to('login');
        }
	}



    
    
    
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

    
    
    
    
    
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if( Session::get('status') == '1'  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $id = Crypt::decrypt($id);        
            $user  = User::find( e($id) );

            //ดึงข้อมูลจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            } 

            //ดึงชื่อจังหวัด
            $nProvince = Province::where('PROVINCE_ID', '=', $user->chwpart)->first();
            //ดึงชื่ออำเภอ
            $nAmphur   = Amphur::where('PROVINCE_ID', '=', $user->chwpart)->where('AMPHUR_ID', '=', $user->amppart)->first();
            //ดึงชื่อตำบล
            $nDistrict = District::where('PROVINCE_ID', '=', $user->chwpart)->where('AMPHUR_ID', '=', $user->amppart)->where('DISTRICT_ID', '=', $user->tmbpart)->first();

            return View::make( 'user.edit', array('user' => $user, 'province' => $province_name, 'nProvince' => $nProvince, 'nAmphur' => $nAmphur, 'nDistrict' => $nDistrict ) );
        }
        else
        {
            return Redirect::to('login');
        }
	}
    
    
    
    
    
    
    /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editprofile($id)
	{
        $id = Crypt::decrypt($id);

		if( Session::get('uid') == $id  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $user  = User::find( e($id) );

            //ดึงข้อมูลจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            } 
            
            //ดึงชื่อจังหวัด
            $nProvince = Province::where('PROVINCE_ID', '=', $user->chwpart)->first();
            //ดึงชื่ออำเภอ
            $nAmphur   = Amphur::where('PROVINCE_ID', '=', $user->chwpart)->where('AMPHUR_ID', '=', $user->amppart)->first();
            //ดึงชื่อตำบล
            $nDistrict = District::where('PROVINCE_ID', '=', $user->chwpart)->where('AMPHUR_ID', '=', $user->amppart)->where('DISTRICT_ID', '=', $user->tmbpart)->first();

            return View::make( 'user.edit', array( 'user' => $user, 'province' => $province_name, 'nProvince' => $nProvince, 'nAmphur' => $nAmphur, 'nDistrict' => $nDistrict) );
        }
        else
        {
            return Redirect::to('login');
        }
	}
    

    
    
    
    
    
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {           
            $postData = Input::All();
                    
            $messages = [
                'name.required'         => 'กรุณากรอก:',
            ];

             $rules = [
                'name'             => 'required', 
             ];

            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()) {               
                return Redirect::route('user.edit', e($id) )->withInput()->withErrors($validator);
            }
            else
            {
                $data = Request::all();
                                   
                $user = User::find( e($id) );
                $user->name         = $data['name'];
                
                if( $data['password'] != '' ){
                    
                    $hash = $this->hashSSHA($data['password']);
                    $encrypted_password = $hash["encrypted"]; // encrypted password
                    $salt = $hash["salt"]; // salt

                    $user->password     = $encrypted_password;
                    $user->salt         = $salt;
                }

                $user->address      = $data['address'];
                
                if( isset($data['chwpart']) && isset($data['amppart']) && isset($data['tmbpart']) ){
                    $user->chwpart      = $data['chwpart'];
                    $user->amppart      = $data['amppart'];
                    $user->tmbpart      = $data['tmbpart'];
                }
                
                if( isset($data['workat']) ) { $user->workat = $data['workat']; }
                
                if( Session::get('status') == '1' ){
                    $user->activated    = $data['activated'];
                    $user->status       = $data['status'];
                }
                
                DB::transaction(function() use ($user) {
                    $user->save();  
                }); 

                if( Session::get('status') == '1' ){
                    Session::flash( 'savedata', save_data );       
                    return Redirect::to('user');
                }else{
                    return Redirect::to('/');
                }
            }
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    
    
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if( Session::get('status') == '1'  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $id = Crypt::decrypt($id);

            DB::transaction(function() use ($id) {  
                DB::table('users')
                        ->where( 'id', '=', $id )
                        ->delete();
            }); 
            
            return ['success' => true]; 
        }
        else
        {
            return Redirect::to('login');
        }
	}







    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }


}
