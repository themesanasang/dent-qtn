<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logs;
use App\Models\Treatment;

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

class TreatmentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){  
			$id = Crypt::decrypt($id);

            return View::make( 'treatment.create', array('patient_id' => $id) );
        }
        else{
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
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){           
            
            $data = Request::all();

            $nextdate = '';
            if( isset($data['nextdate']) ){
            	if( $data['nextdate'] == '' ){
            		$nextdate = '';
            	}else{
            		$nextdate = date("Y-m-d", strtotime($data['nextdate']));
            	}
            }else{
            	$nextdate = '';
            }

            $treatment = new Treatment;
            $treatment->patient_id  = $data['patient_id'];
            $treatment->vstdate     = ((isset( $data['vstdate'] ))?date("Y-m-d", strtotime($data['vstdate'])):'');
            $treatment->finding     = $data['finding'];
            $treatment->treatment   = $data['treatment'];
            $treatment->remark      = $data['remark'];
            $treatment->nextdate    = $nextdate;
            $treatment->nexttime    = ((isset( $data['nexttime'] ))?$data['nexttime']:'');
            $treatment->create_by   = Session::get('username');
            
            DB::transaction(function() use ($treatment) {
                $treatment->save();  
            }); 

            Logs::createlog(Session::get('username'), 'create treatment patient id = '.$data['patient_id'] ); 
           
            return Redirect::to('patient');     
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
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){  
			$id = Crypt::decrypt($id);

			$treatment = Treatment::find($id);

            return View::make( 'treatment.edit', array('treatment' => $treatment) );
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
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){           
            
            $data = Request::all();

            $nextdate = '';
            if( isset($data['nextdate']) ){
            	if( $data['nextdate'] == '' ){
            		$nextdate = '';
            	}else{
            		$nextdate = date("Y-m-d", strtotime($data['nextdate']));
            	}
            }else{
            	$nextdate = '';
            }

            $treatment = Treatment::find($id);
            $treatment->vstdate     = ((isset( $data['vstdate'] ))?date("Y-m-d", strtotime($data['vstdate'])):'');
            $treatment->finding     = $data['finding'];
            $treatment->treatment   = $data['treatment'];
            $treatment->remark      = $data['remark'];
            $treatment->nextdate    = $nextdate;
            $treatment->nexttime    = ((isset( $data['nexttime'] ))?$data['nexttime']:'');
            
            DB::transaction(function() use ($treatment) {
                $treatment->save();  
            }); 

            Logs::createlog(Session::get('username'), 'update treatment id = '.$id ); 
           
            return Redirect::to('patient');     
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
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) ){   
            $id = Crypt::decrypt($id);

            $treatment = Treatment::find( e($id) );
            Logs::createlog(Session::get('username'), 'delete patient treatment patient_id = '.$treatment->patient_id );

            DB::transaction(function() use ($id) {  
                DB::table('treatment')
                        ->where( 'id', '=', $id )
                        ->delete();
            });
            
            return ['success' => true]; 
        }
        else{
            return Redirect::to('login');
        }
	}

}
