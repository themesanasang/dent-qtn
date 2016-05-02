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

class LoginController extends Controller {

    
    
    
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('auth.login');
	}
    
    
    

    
    
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    
    
    
    
    
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();  	 
		$username = $data['username'];
		$password = $data['password'];
        
        $rules = array(
		'username' => 'required',
		'password' => 'required',
	     );

		//เช็คค่าว่าง
	    $validator = Validator::make($data, $rules);
	    if ($validator->fails())
	    {	
	    	Session::flash('error', error_login); 	
	    	return Redirect::to('login');    	      	     
	    }
        else
        {
            $model = User::where( 'username', '=', e( $username) )->where('activated', '=', '1')->first();	
           
			if( !empty($model) )
			{
				$salt = $model->salt;
	            $encrypted_password = $model->password;
	            $hash = $this->checkhashSSHA($salt, $password);
	            // check for password
                if ( $encrypted_password == $hash )
                {
                    Session::regenerate();
                    Session::put( 'username', $model->username );
                    Session::put( 'name', $model->username );
                    Session::put( 'uid', $model->id );

                    //0=โรงพยาบาลส่งเสริมสุขภาพตำบล , 1=โรงพยาบาลชุมชน , 2=โรงพยาบาลทั่วไป , 3=โรงพยาบาลศูนย์
                    Session::put( 'workat', $model->workat );

                    //1=admin, 2=ผู้วิจัย, 3=ทั่วไป 
                    Session::put( 'status', $model->status );
                    Session::put( 'fingerprint', md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) );					

                    return Redirect::intended('screen');		
                }
                else
                {
                     Session::flash('error', error_login); 	
                     return Redirect::to('login');   
                }
            }
            else
            {
                Session::flash('error', error_login); 	
                return Redirect::to('login');   
            }
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
    
    
    
    
    
     /**
     * logout system
     */
    public function logout()
    {     
    	Session::flush(); //delete the session
		return Redirect::to( '/' ); // redirect the user to the login screen
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
		//
	}

    
    
    
    
    
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

    
    
    
    
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
