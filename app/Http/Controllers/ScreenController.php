<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\Amphur;
use App\Models\District;
use App\Models\Screen;
use App\Logs;
use Input;
use Image;
use Request;
use Session;
use View;
use Redirect;
use Validator;
use Hash;
use DB;
use Response;
use Crypt;

class ScreenController extends Controller {
    
    
    
    

	/**
	 * Display หน้าคัดกรอง
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {       
            //ดึงข้อมูลจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            }   
                        
            return View::make( 'screen.index', array( 'province' => $province_name ) );
        }
        else
        {
            return Redirect::to('login');
        }
	}
    
    
    
    
    
    
    /**
	 * Display รายการคัดกรอง
	 *
	 * @return Response
	 */
    public function screenlist()
    {
       if(  Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $user = User::find(Session::get('uid'));

            $chwpart = $user->chwpart;
            $amppart = $user->amppart;
            $tmbpart = $user->tmbpart;

            $type_w = Session::get('workat');

           if( Session::get('status') == 3 )
           {
               //ผูใช้ทั่วไป
                //$screen = Screen::where('create_by', '=', Session::get('username'))->get();

                if( $type_w == '0' ){
                    //โรงพยาบาลส่งเสริมสุขภาพตำบล
                    $sql = 'select * from screen where create_by='."'".Session::get('username')."'";
                }else if( $type_w == '1' ){
                    //โรงพยาบาลชุมชน
                    $alluser = DB::table('users')->where('chwpart', '=', $chwpart)->where('amppart', '=', $amppart)->select('username')->get();
                    $idkey = '(';
                    foreach($alluser as $key => $value){
                        $idkey .= "'".$value->username."'".',';
                    }
                    $idkey .= '"0")';

                    $sql = 'select * from screen where create_by in '.$idkey;
                }else if( $type_w == '2' ){
                    //โรงพยาบาลทั่วไป
                    $alluser = DB::table('users')->where('chwpart', '=', $chwpart)->where('amppart', '=', $amppart)->select('username')->get();
                    $idkey = '(';
                    foreach($alluser as $key => $value){
                        $idkey .= "'".$value->username."'".',';
                    }
                    $idkey .= '"0")';

                    $sql = 'select * from screen where create_by in '.$idkey;
                }else{
                    //โรงพยาบาลศูนย์
                    $alluser = DB::table('users')->where('chwpart', '=', $chwpart)->select('username')->get();
                    $idkey = '(';
                    foreach($alluser as $key => $value){
                        $idkey .= "'".$value->username."'".',';
                    }
                    $idkey .= '"0")';

                    $sql = 'select * from screen where create_by in '.$idkey;
                }
           }
           else
           {
               //admin & ผู้วิจัย
                $sql = 'select * from screen';
           }

           $screen = DB::select($sql);
                        
            return View::make( 'screen.list', array('screen' => $screen) );
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
		
	}

    
    
    
    
    
    
	/**
	 * เพิ่มคัดกรองเข้าฐาน
	 *
	 * @return Response
	 */
	public function store()
	{
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $postData = Input::All();
            
            $messages = [
                'fullname.required'     => 'กรุณากรอก:',
                'cid.required'          => 'กรุณากรอก:',
                'chwpart.required'      => 'กรุณาเลือก:',
                'amppart.required'      => 'กรุณาเลือก:',
                'tmbpart.required'      => 'กรุณาเลือก:',
            ];

             $rules = [
                'fullname'    => 'required', 
                'cid'         => 'required', 
                'chwpart'     => 'required',
                'amppart'     => 'required',
                'tmbpart'     => 'required',
             ];

            //เช็คค่าว่างแจ้งเตือน
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()) {               
                return Response::json(['error' => $validator->messages()]);
            }
            else
            {
                //insert data
                $data = Request::all();
                                                                     
                $screen = new Screen;
                $screen->fullname           = $data['fullname'];
                $screen->cid                = $data['cid'];
                $screen->age                = $data['age'];
                if( isset($data['sex']) ){ $screen->sex = $data['sex']; }
                if( isset($data['status']) ){ $screen->status = $data['status']; }
                if( isset($data['school']) ){ $screen->school = $data['school']; }
                $screen->textschool         = $data['textschool'];
                if( isset($data['work']) ){ $screen->work = $data['work']; } 
                $screen->textwork           = $data['textwork'];
                $screen->address            = $data['address'];
                $screen->chwpart            = $data['chwpart'];
                $screen->amppart            = $data['amppart'];
                $screen->tmbpart            = $data['tmbpart'];
                $screen->tel                = $data['tel'];
                $screen->mobile             = $data['mobile'];


                if( isset($data['smoking']) ) { $screen->smoking = $data['smoking']; }
                $screen->smokingday         = ((isset( $data['smokingday'] ))?$data['smokingday']:'');
                $screen->smokinglong        = ((isset( $data['smokinglong'] ))?$data['smokinglong']:'');
                $screen->smokingstop        = ((isset( $data['smokingstop'] ))?$data['smokingstop']:'');
                if( isset($data['hassmoking']) ) { $screen->hassmoking = $data['hassmoking']; }
                if( isset($data['hasnus']) ) { $screen->hasnus = $data['hasnus']; }
                $screen->nuslong            = ((isset( $data['nuslong'] ))?$data['nuslong']:'');
                $screen->nusstop            = ((isset( $data['nusstop'] ))?$data['nusstop']:'');
                if( isset($data['hasareca']) ) { $screen->hasareca = $data['hasareca']; }
                $screen->arecalong          = ((isset( $data['arecalong'] ))?$data['arecalong']:'');
                $screen->arecastop          = ((isset( $data['arecastop'] ))?$data['arecastop']:'');
                if( isset($data['alcohol']) ) { $screen->alcohol = $data['alcohol']; }
                $screen->drinktype          = ((isset( $data['drinktype'] ))?$data['drinktype']:'');
                $screen->drinktypetext      = ((isset( $data['drinktypetext'] ))?$data['drinktypetext']:'');
                $screen->drinkunittext      = ((isset( $data['drinkunittext'] ))?$data['drinkunittext']:'');
                $screen->drinkunit          = ((isset( $data['drinkunit'] ))?$data['drinkunit']:'');
                $screen->alcohollong        = ((isset( $data['alcohollong'] ))?$data['alcohollong']:'');
                $screen->alcoholstop        = ((isset( $data['alcoholstop'] ))?$data['alcoholstop']:'');
                if( isset($data['hascancer']) ) { $screen->hascancer = $data['hascancer']; }
                if( isset($data['cancer']) ) { $screen->cancer = $data['cancer']; } 
                $screen->textcancer         = ((isset( $data['textcancer'] ))?$data['textcancer']:'');
                if( isset($data['sun']) ) { $screen->sun = $data['sun']; }
                $screen->worksun            = ((isset( $data['worksun'] ))?$data['worksun']:'');


                if( isset($data['part3_1']) ) { $screen->part3_1 = $data['part3_1']; }
                if( isset($data['part3_2']) ) { $screen->part3_2 = $data['part3_2']; }
                if( isset($data['part3_3']) ) { $screen->part3_3 = $data['part3_3']; }
                if( isset($data['part3_4']) ) { $screen->part3_4 = $data['part3_4']; }
                if( isset($data['part3_5']) ) { $screen->part3_5 = $data['part3_5']; }

                if( isset($data['part3_61']) ) { $screen->part3_61 = $data['part3_61']; }
                if( isset($data['part3_62']) ) { $screen->part3_62 = $data['part3_62']; }
                if( isset($data['part3_63']) ) { $screen->part3_63 = $data['part3_63']; }
                if( isset($data['part3_64']) ) { $screen->part3_64 = $data['part3_64']; }
                if( isset($data['part3_65']) ) { $screen->part3_65 = $data['part3_65']; }
                $screen->textpart3_6        = ((isset( $data['textpart3_6'] ))?$data['textpart3_6']:'');

                if( isset($data['part3_7']) ) { $screen->part3_7 = $data['part3_7']; }
                

                $screen->date_part4         = ((isset( $data['date_part4'] ))?date("Y-m-d", strtotime($data['date_part4'])):'');
                $screen->user_part4         = ((isset( $data['user_part4'] ))?$data['user_part4']:'');
                if( isset($data['part4_1']) ) { $screen->part4_1 = $data['part4_1']; }
                $screen->part4_1text        = ((isset( $data['part4_1text'] ))?$data['part4_1text']:'');
                if( isset($data['part4_2']) ) { $screen->part4_2 = $data['part4_2']; }
                $screen->definitive_diag    = ((isset( $data['definitive_diag'] ))?$data['definitive_diag']:'');
                $screen->part4_3            = ((isset( $data['part4_3'] ))?$data['part4_3']:'');
                if( isset($data['part4_4']) ) { $screen->part4_4 = $data['part4_4']; }
                $screen->part4_41_text      = ((isset( $data['part4_41_text'] ))?$data['part4_41_text']:'');
                $screen->part4_42_text      = ((isset( $data['part4_42_text'] ))?$data['part4_42_text']:'');
                $screen->part4_43_text      = ((isset( $data['part4_43_text'] ))?$data['part4_43_text']:'');
                $screen->part4_44_text      = ((isset( $data['part4_44_text'] ))?$data['part4_44_text']:'');


                $regdate = date('Y-m-d H:i:s');
                list($y, $m, $d, $h, $i, $s) = $this->multiexplode(array("-"," ",":"), trim($regdate)); 
                $nameFolder = $data['cid'].'_'.$y.$m.$d.$h.$i.$s;

                if( !is_dir( storage_path()."/uploads/".$nameFolder ) ) {
                    mkdir(storage_path()."/uploads/".$nameFolder);
                }               

                if(Input::file('file1')) {
                    $nameFile1 = Input::file('file1')->getClientOriginalName();
                    $pathFile1 = storage_path().'/uploads/'.$nameFolder;
                    Input::file('file1')->move($pathFile1, $nameFile1);

                    $screen->name_file1         =  $nameFile1;
                    $screen->file1              =  $pathFile1.'/'.$nameFile1;
                }

                if(Input::file('file2')) {
                    $nameFile2 = Input::file('file2')->getClientOriginalName();
                    $pathFile2 = storage_path().'/uploads/'.$nameFolder;
                    Input::file('file2')->move($pathFile2, $nameFile2);

                    $screen->name_file2         =  $nameFile2;
                    $screen->file2              =  $pathFile2.'/'.$nameFile2;
                }

                if(Input::file('file3')) {
                    $nameFile3 = Input::file('file3')->getClientOriginalName();
                    $pathFile3 = storage_path().'/uploads/'.$nameFolder;
                    Input::file('file3')->move($pathFile3, $nameFile3);

                    $screen->name_file3         =  $nameFile3;
                    $screen->file3              =  $pathFile3.'/'.$nameFile3;
                }

                if(Input::file('file4')) {
                    $nameFile4 = Input::file('file4')->getClientOriginalName();
                    $pathFile4 = storage_path().'/uploads/'.$nameFolder;
                    Input::file('file4')->move($pathFile4, $nameFile4);

                    $screen->name_file4         =  $nameFile4;
                    $screen->file4              =  $pathFile4.'/'.$nameFile4;
                }

                if(Input::file('file5')) {
                    $nameFile5 = Input::file('file5')->getClientOriginalName();
                    $pathFile5 = storage_path().'/uploads/'.$nameFolder;
                    Input::file('file5')->move($pathFile5, $nameFile5);

                    $screen->name_file5         =  $nameFile5;
                    $screen->file5              =  $pathFile5.'/'.$nameFile5;
                }

                $screen->regdate            = $regdate;
                $screen->create_by          = Session::get('username');
                $screen->user_type_workat   = Session::get('workat');
                                 
                DB::transaction(function() use ($screen) {
                    $screen->save();  
                }); 

                Logs::createlog(Session::get('username'), 'create screen patient name = '.$data['fullname'] );
                
                return Response::json(['success' => 'ok']);
                
            }//else           
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    public function multiexplode ($delimiters,$string) {
       
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
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
	 * แสดงหน้าแก้ไข
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $id = Crypt::decrypt($id);

            $screen  = Screen::find( e($id) );          
            
            //ดึงจังหวัด
            $province = DB::table( 'province' )->select( DB::raw('PROVINCE_ID, PROVINCE_NAME') )->get();
            $province_name=[];
            foreach ($province as $key => $value) {                    
               $province_name[$value->PROVINCE_ID] = $value->PROVINCE_NAME;
            }
            
            if( $screen->chwpart != '' ){
                //ดึงชื่อจังหวัด
                $nProvince = Province::where('PROVINCE_ID', '=', $screen->chwpart)->first();
                //ดึงชื่ออำเภอ
                $nAmphur   = Amphur::where('PROVINCE_ID', '=', $screen->chwpart)->where('AMPHUR_ID', '=', $screen->amppart)->first();
                //ดึงชื่อตำบล
                $nDistrict = District::where('PROVINCE_ID', '=', $screen->chwpart)->where('AMPHUR_ID', '=', $screen->amppart)->where('DISTRICT_ID', '=', $screen->tmbpart)->first();                 
            }else{
                $nProvince = '';
                $nAmphur = '';
                $nDistrict = '';
            }

            return View::make( 'screen.edit', array( 'screen' => $screen, 'province' => $province_name, 'nProvince' => $nProvince, 'nAmphur' => $nAmphur, 'nDistrict' => $nDistrict ) );
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    
    
    
	/**
	 * แก้ไขข้อมูลลงฐาน
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {           
            //update ข้อมูลลงฐาน 
            $data = Request::all();               

            $screen = Screen::find( e($id) );              
            $screen->age                = $data['age'];

            if( isset($data['sex']) ){ $screen->sex = $data['sex']; }
            if( isset($data['status']) ){ $screen->status = $data['status']; }
            if( isset($data['school']) ){ $screen->school = $data['school']; }
            $screen->textschool         = $data['textschool'];
            if( isset($data['work']) ){ $screen->work = $data['work']; }  
            $screen->textwork           = $data['textwork'];
            $screen->address            = $data['address'];
            //เช็คจังหวัด อำเภอ ตำบล ก่อน update
            if( isset($data['chwpart']) && isset($data['amppart']) && isset($data['tmbpart']) ){
                $screen->chwpart            = $data['chwpart'];
                $screen->amppart            = $data['amppart'];
                $screen->tmbpart            = $data['tmbpart'];
            }
            $screen->tel                = $data['tel'];
            $screen->mobile             = $data['mobile'];
            

            if( isset($data['smoking']) ) { $screen->smoking = $data['smoking']; }
            $screen->smokingday         = ((isset( $data['smokingday'] ))?$data['smokingday']:'');
            $screen->smokinglong        = ((isset( $data['smokinglong'] ))?$data['smokinglong']:'');
            $screen->smokingstop        = ((isset( $data['smokingstop'] ))?$data['smokingstop']:'');
            if( isset($data['hassmoking']) ) { $screen->hassmoking = $data['hassmoking']; }
            if( isset($data['hasnus']) ) { $screen->hasnus = $data['hasnus']; }
            $screen->nuslong            = ((isset( $data['nuslong'] ))?$data['nuslong']:'');
            $screen->nusstop            = ((isset( $data['nusstop'] ))?$data['nusstop']:'');
            if( isset($data['hasareca']) ) { $screen->hasareca = $data['hasareca']; }
            $screen->arecalong          = ((isset( $data['arecalong'] ))?$data['arecalong']:'');
            $screen->arecastop          = ((isset( $data['arecastop'] ))?$data['arecastop']:'');
            if( isset($data['alcohol']) ) { $screen->alcohol = $data['alcohol']; }
            $screen->drinktype          = ((isset( $data['drinktype'] ))?$data['drinktype']:'');
            $screen->drinktypetext      = ((isset( $data['drinktypetext'] ))?$data['drinktypetext']:'');
            $screen->drinkunittext      = ((isset( $data['drinkunittext'] ))?$data['drinkunittext']:'');
            $screen->drinkunit          = ((isset( $data['drinkunit'] ))?$data['drinkunit']:'');
            $screen->alcohollong        = ((isset( $data['alcohollong'] ))?$data['alcohollong']:'');
            $screen->alcoholstop        = ((isset( $data['alcoholstop'] ))?$data['alcoholstop']:'');
            if( isset($data['hascancer']) ) { $screen->hascancer = $data['hascancer']; }
            if( isset($data['cancer']) ) { $screen->cancer = $data['cancer']; } 
            $screen->textcancer         = ((isset( $data['textcancer'] ))?$data['textcancer']:'');
            if( isset($data['sun']) ) { $screen->sun = $data['sun']; }
            $screen->worksun            = ((isset( $data['worksun'] ))?$data['worksun']:'');
            

            if( isset($data['part3_1']) ) { $screen->part3_1 = $data['part3_1']; }
            if( isset($data['part3_2']) ) { $screen->part3_2 = $data['part3_2']; }
            if( isset($data['part3_3']) ) { $screen->part3_3 = $data['part3_3']; }
            if( isset($data['part3_4']) ) { $screen->part3_4 = $data['part3_4']; }
            if( isset($data['part3_5']) ) { $screen->part3_5 = $data['part3_5']; }

            if( isset($data['part3_61']) ) { $screen->part3_61 = $data['part3_61']; } else{ $screen->part3_61 = 9; }
            if( isset($data['part3_62']) ) { $screen->part3_62 = $data['part3_62']; } else{ $screen->part3_62 = 9; }
            if( isset($data['part3_63']) ) { $screen->part3_63 = $data['part3_63']; } else{ $screen->part3_63 = 9; }
            if( isset($data['part3_64']) ) { $screen->part3_64 = $data['part3_64']; } else{ $screen->part3_64 = 9; }
            if( isset($data['part3_65']) ) { $screen->part3_65 = $data['part3_65']; } else{ $screen->part3_65 = 9; }
            $screen->textpart3_6        = ((isset( $data['textpart3_6'] ))?$data['textpart3_6']:'');

            if( isset($data['part3_7']) ) { $screen->part3_7 = $data['part3_7']; }
            

            $screen->date_part4         = ((isset( $data['date_part4'] ))?date("Y-m-d", strtotime($data['date_part4'])):'');
            $screen->user_part4         = ((isset( $data['user_part4'] ))?$data['user_part4']:'');
            if( isset($data['part4_1']) ) { $screen->part4_1 = $data['part4_1']; }
            $screen->part4_1text        = ((isset( $data['part4_1text'] ))?$data['part4_1text']:'');
            if( isset($data['part4_2']) ) { $screen->part4_2 = $data['part4_2']; }
            $screen->definitive_diag    = ((isset( $data['definitive_diag'] ))?$data['definitive_diag']:'');
            $screen->part4_3            = ((isset( $data['part4_3'] ))?$data['part4_3']:'');
            if( isset($data['part4_4']) ) { $screen->part4_4 = $data['part4_4']; }
            $screen->part4_41_text      = ((isset( $data['part4_41_text'] ))?$data['part4_41_text']:'');
            $screen->part4_42_text      = ((isset( $data['part4_42_text'] ))?$data['part4_42_text']:'');
            $screen->part4_43_text      = ((isset( $data['part4_43_text'] ))?$data['part4_43_text']:'');
            $screen->part4_44_text      = ((isset( $data['part4_44_text'] ))?$data['part4_44_text']:'');


            $cid = $screen->cid;
            $regdate = date('Y-m-d H:i:s');
            list($y, $m, $d, $h, $i, $s) = $this->multiexplode(array("-"," ",":"), trim($regdate)); 
            $nameFolder = $cid.'_'.$y.$m.$d.$h.$i.$s;

            if( !is_dir( storage_path()."/uploads/".$nameFolder ) ) {
                mkdir(storage_path()."/uploads/".$nameFolder);
            }               

            if(Input::file('file1')) {
                $nameFile1 = Input::file('file1')->getClientOriginalName();
                $pathFile1 = storage_path().'/uploads/'.$nameFolder;
                Input::file('file1')->move($pathFile1, $nameFile1);

                $screen->name_file1         =  $nameFile1;
                $screen->file1              =  $pathFile1.'/'.$nameFile1;
            }

            if(Input::file('file2')) {
                $nameFile2 = Input::file('file2')->getClientOriginalName();
                $pathFile2 = storage_path().'/uploads/'.$nameFolder;
                Input::file('file2')->move($pathFile2, $nameFile2);

                $screen->name_file2         =  $nameFile2;
                $screen->file2              =  $pathFile2.'/'.$nameFile2;
            }

            if(Input::file('file3')) {
                $nameFile3 = Input::file('file3')->getClientOriginalName();
                $pathFile3 = storage_path().'/uploads/'.$nameFolder;
                Input::file('file3')->move($pathFile3, $nameFile3);

                $screen->name_file3         =  $nameFile3;
                $screen->file3              =  $pathFile3.'/'.$nameFile3;
            }

            if(Input::file('file4')) {
                $nameFile4 = Input::file('file4')->getClientOriginalName();
                $pathFile4 = storage_path().'/uploads/'.$nameFolder;
                Input::file('file4')->move($pathFile4, $nameFile4);

                $screen->name_file4         =  $nameFile4;
                $screen->file4              =  $pathFile4.'/'.$nameFile4;
            }

            if(Input::file('file5')) {
                $nameFile5 = Input::file('file5')->getClientOriginalName();
                $pathFile5 = storage_path().'/uploads/'.$nameFolder;
                Input::file('file5')->move($pathFile5, $nameFile5);

                $screen->name_file5         =  $nameFile5;
                $screen->file5              =  $pathFile5.'/'.$nameFile5;
            }          

            DB::transaction(function() use ($screen) {
                $screen->save();  
            }); 

            Logs::createlog(Session::get('username'), 'update screen patient name = '.$screen->fullname );

            return Redirect::to('screen.list');
        }
        else
        {
            return Redirect::to('login');
        }
	}

    
    
    
    
    
	/**
	 * ลบคัดกรอง
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if( Session::get('status') != '' && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {   
            $id = Crypt::decrypt($id);

            $screen = Screen::find($id);
            Logs::createlog(Session::get('username'), 'delete screen patient name = '.$screen->fullname );

            DB::transaction(function() use ($id) {  
                DB::table('screen')
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
	 * ค้นหารายการคัดกรอง
	 *
	 * @param  post
	 * @return Response
	 */
    public function search()
    {              
        if( Session::get('status') != ''  && Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {           
            $d = Request::all(); 
            $s = $d['s'];
                             
            if( Session::get('status') == 1 || Session::get('status') == 2 )
            {
                //admin &้ ผู้วิจัย
                $result = DB::table('screen')
                             ->where(function($query) use ( $s )
                            {
                                $query->where( 'fullname', 'like', "%$s%" )
                                      ->orWhere( 'cid', 'like', "%$s%" );
                            })
                            ->select('screen.*')
                            ->orderby('regdate','desc')
                            ->get();
            }
            else
            {
                //ทั่วไป

                $user = User::find(Session::get('uid'));

                $chwpart = $user->chwpart;
                $amppart = $user->amppart;
                $tmbpart = $user->tmbpart;

                $type_w = Session::get('workat');

                if( $type_w == '0' ){
                    //โรงพยาบาลส่งเสริมสุขภาพตำบล
                    
                   $result = DB::table('screen')
                             ->where('create_by', Session::get('username'))
                             ->where(function($query) use ( $s )
                            {
                                $query->where( 'fullname', 'like', "%$s%" )
                                      ->orWhere( 'cid', 'like', "%$s%" );
                            })
                            ->select('screen.*')
                            ->orderby('regdate','desc')
                            ->get();

                }else if( $type_w == '1' ){
                    //โรงพยาบาลชุมชน
                    $result = DB::table('screen')
                             ->whereIn('create_by', function($query) use ($chwpart, $amppart)
                            {
                                $query->select('username')
                                      ->from('users')
                                      ->where('chwpart', '=', $chwpart)
                                      ->where('amppart', '=', $amppart);
                            })
                             ->where(function($query) use ( $s )
                            {
                                $query->where( 'fullname', 'like', "%$s%" )
                                      ->orWhere( 'cid', 'like', "%$s%" );
                            })
                            ->select('screen.*')
                            ->orderby('regdate','desc')
                            ->get();
                }else if( $type_w == '2' ){
                    //โรงพยาบาลทั่วไป
                    $result = DB::table('screen')
                             ->whereIn('create_by', function($query) use ($chwpart, $amppart)
                            {
                                $query->select('username')
                                      ->from('users')
                                      ->where('chwpart', '=', $chwpart)
                                      ->where('amppart', '=', $amppart);
                            })
                             ->where(function($query) use ( $s )
                            {
                                $query->where( 'fullname', 'like', "%$s%" )
                                      ->orWhere( 'cid', 'like', "%$s%" );
                            })
                            ->select('screen.*')
                            ->orderby('regdate','desc')
                            ->get();
                }else{
                    //โรงพยาบาลศูนย์
                    $result = DB::table('screen')
                             ->whereIn('create_by', function($query) use ($chwpart)
                            {
                                $query->select('username')
                                      ->from('users')
                                      ->where('chwpart', '=', $chwpart);
                            })
                             ->where(function($query) use ( $s )
                            {
                                $query->where( 'fullname', 'like', "%$s%" )
                                      ->orWhere( 'cid', 'like', "%$s%" );
                            })
                            ->select('screen.*')
                            ->orderby('regdate','desc')
                            ->get();
                }
                
            }

            //return $result;
                       
            return View::make( 'screen.search', array( 'result' => $result ) ); 
        }
        else
        {
            return Redirect::to('login');
        }       
    }
    
    
    
    
    
    
    /**
	 * ดึงอำเภอ
	 *
	 * @return html
	 */
    public function getAmphur($id)
    {
        $amppart = DB::table( 'amphur' )
                        ->where('PROVINCE_ID', '=', e($id) )
                        ->select( DB::raw('AMPHUR_ID, AMPHUR_NAME') )->get();
           
        return View::make( 'location.amphur', array( 'amppart' => $amppart ) );       
    }
    
    
    
    
    
    
     /**
	 * ดึงตำบล
	 *
	 * @return html
	 */
    public function getDistrict($id_pro, $id_amp)
    {
        $tmppart = DB::table( 'district' )
                        ->where('PROVINCE_ID', '=', e($id_pro) )
                        ->where('AMPHUR_ID', '=', e($id_amp) )
                        ->select( DB::raw('DISTRICT_ID, DISTRICT_NAME') )->get();
           
        return View::make( 'location.district', array( 'tmppart' => $tmppart ) );       
    }
    

}
