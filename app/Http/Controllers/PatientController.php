<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Patient;
use App\Models\User;
use App\Models\Province;
use App\Models\Amphur;
use App\Models\District;
use App\Logs;

use Input;
use Request;
use Session;
use View;
use Redirect;
use Validator;
use Hash;
use DB;
use Response;
use Crypt;

class PatientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		if(  Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){  
        	
            $user = User::find(Session::get('uid'));

            $chwpart = $user->chwpart;
            $amppart = $user->amppart;
            $tmbpart = $user->tmbpart;

            $type_w = Session::get('workat');

           if( Session::get('status') == 3 ){
                //ผูใช้ทั่วไป
                if( $type_w == '0' ){
                    //โรงพยาบาลส่งเสริมสุขภาพตำบล
                    $patient = DB::table('patient')->where('chwpart', '=', $chwpart)->where('amppart', '=', $amppart)->where('tmbpart', '=', $tmbpart)->get();
                }else if( $type_w == '1' ){
                    //โรงพยาบาลชุมชน
                    $patient = DB::table('patient')->where('chwpart', '=', $chwpart)->where('amppart', '=', $amppart)->get();
                }else if( $type_w == '2' ){
                    //โรงพยาบาลทั่วไป
                    $patient = DB::table('patient')->where('chwpart', '=', $chwpart)->where('amppart', '=', $amppart)->get();
                }else{
                    //โรงพยาบาลศูนย์
                    $patient = DB::table('patient')->where('chwpart', '=', $chwpart)->get();
                }
           }
           else{
               //admin & ผู้วิจัย
                $patient = DB::table('patient')->where('chwpart', '=', $chwpart)->get();
           }
                        
            return View::make( 'patient.index', array('patient' => $patient) );
        }
        else{
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){   
            $id = Crypt::decrypt($id);

            $patient  = Patient::find( e($id) );   
            
            //ดึงจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            }
            
            if( $patient->chwpart != '' ){
                //ดึงชื่อจังหวัด
                $nProvince = Province::where('PROVINCE_ID', '=', $patient->chwpart)->first();
                //ดึงชื่ออำเภอ
                $nAmphur   = Amphur::where('PROVINCE_ID', '=', $patient->chwpart)->where('AMPHUR_ID', '=', $patient->amppart)->first();
                //ดึงชื่อตำบล
                $nDistrict = District::where('PROVINCE_ID', '=', $patient->chwpart)->where('AMPHUR_ID', '=', $patient->amppart)->where('DISTRICT_ID', '=', $patient->tmbpart)->first();                 
            }else{
                $nProvince = '';
                $nAmphur = '';
                $nDistrict = '';
            }

            return View::make( 'patient.edit', array( 'patient' => $patient, 'province' => $province_name, 'nProvince' => $nProvince, 'nAmphur' => $nAmphur, 'nDistrict' => $nDistrict ) );
        }
        else{
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
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){           
            $postData = Input::All();
                    
            $messages = [
                'fullname.required'         => 'กรุณากรอก:'
            ];

             $rules = [
                'fullname'             => 'required' 
             ];

            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()) {               
                return Redirect::route('patient.edit', Crypt::encrypt($id) )->withInput()->withErrors($validator);
            }
            else{
                $data = Request::all();
                                   
                $patient = Patient::find( e($id) );
                $patient->fullname      = $data['fullname'];         
                $patient->address      	= $data['address'];
                
                if( isset($data['chwpart']) && isset($data['amppart']) && isset($data['tmbpart']) ){
                    $patient->chwpart      = $data['chwpart'];
                    $patient->amppart      = $data['amppart'];
                    $patient->tmbpart      = $data['tmbpart'];
                }
                
                $patient->mobile      		= $data['mobile'];

                if( isset($data['discharge']) ){
                	$patient->discharge      = $data['discharge'];
                }
                
                DB::transaction(function() use ($patient) {
                    $patient->save();  
                }); 

                return Redirect::to('patient');
            }
        }
        else{
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
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){   
            $id = Crypt::decrypt($id);

            $patient = Patient::find( e($id) );
            Logs::createlog(Session::get('username'), 'delete patient name = '.$patient->fullname );

            $cid = $patient->cid;

            DB::transaction(function() use ($id) {  
                DB::table('patient')
                        ->where( 'id', '=', $id )
                        ->delete();
            });

             DB::transaction(function() use ($cid) {  
                DB::table('screen')
                        ->where( 'cid', '=', $cid )
                        ->delete();
            }); 
            
            return ['success' => true]; 
        }
        else{
            return Redirect::to('login');
        }
	}






	/**
	 * Display page treatment
	 *
	 * @return Response
	 */
	public function treatment($id)
	{
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){   
            $id = Crypt::decrypt($id);

            $patient = Patient::find( $id );
            $treatment = DB::table('treatment')->where('patient_id', $id)->orderby('vstdate', 'desc')->get();

            return View::make( 'patient.list_treatment', array('treatment' => $treatment, 'patient' => $patient) );       
        }
        else{
            return Redirect::to('login');
        }
	}




	/**
	 * Display page listscreen
	 *
	 * @return Response
	 */
	public function listscreen($cid, $id)
	{
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){   
            $cid = Crypt::decrypt($cid);
            $id = Crypt::decrypt($id);

            $patient = Patient::find( $id );
            $screen = DB::table('screen')->where('cid', $cid)->orderby('regdate', 'desc')->get();

            return View::make( 'patient.list_screen', array('screen' => $screen, 'patient' => $patient) );
        }
        else{
            return Redirect::to('login');
        }
	}



}
