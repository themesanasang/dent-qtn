<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Screen;
use Session;
use View;
use Redirect;
use DB;
use Response;
use Crypt;
use Input;
use PHPExcel;
use PHPExcel_Style_NumberFormat;
use PHPExcel_Cell;
use PHPExcel_IOFactory;

use Illuminate\Http\Request;

class ReportController extends Controller {

    
    
    
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {       
            return View::make( 'report.index' );
        }
        else
        {
            return Redirect::to('login');
        }
	}

    


	/**
	 * Home PMD Report
	 *
	 */
    public function report_pmd()
    {
    	if( Session::get('fingerprint') == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']) )
        {          	    
            return View::make( 'report.report_pmd' );
        }
        else
        {
            return Redirect::to('login');
        }
    }




    /**
	 * Export Excel PMD Report
	 *
	 */
    public function export_pmd()
    {
    	//$dateStart  =  date("Y-m-d", strtotime( Input::get( 'date_start_pmd' ) ));
	    //$dateEnd 	= date("Y-m-d", strtotime( Input::get( 'date_end_pmd' ) ));	

	    //return $this->get_screen_mouth_no_1();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); 
	    $objPHPExcel->getActiveSheet()->setTitle('PMD');
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงาน ผลการตรวจคัดกรองรอยโรค PMD');
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'ลำดับ');	
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);		
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'รายการ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);	
		$objPHPExcel->getActiveSheet()->setCellValue('C2', '');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);	
		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'หน่วยนับ');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);	
		$objPHPExcel->getActiveSheet()->getStyle("D")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'จำนวน');	
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);	
		$objPHPExcel->getActiveSheet()->getStyle("E")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 		

		//  ==>1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 3,  '1');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 3,  'จำนวนผู้ป่วยทั้งหมด');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 3,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 3,  $this->get_screen_all());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 4,  'ชาย');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 4,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 4,  $this->get_screen_men());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 5,  'หญิง');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 5,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 5,  $this->get_screen_girl());

		//  ==>2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 6,  '2');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 6,  'จำนวนผู้ป่วยอายุ 40 ปีขึ้นไป');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 6,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 6,  $this->get_screen_all_40());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 7,  'ชาย');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 7,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 7,  $this->get_screen_men_40());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 8,  'หญิง');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 8,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 8,  $this->get_screen_girl_40());

		//  ==>3
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 9,  '3');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 9,  'ผลการตรวจช่องปาก');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 10,  'ปกติ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 10,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 10,  $this->get_screen_mouth_ok());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 11,  'ผิดปกติรวม');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 11,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 11,  $this->get_screen_mouth_no());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 12,  'ผิดปกติ 1 รายการ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 12,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 12,  $this->get_screen_mouth_no_1());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 13,  '3.1 รอยโรคสีแดงหรือขาวขูดไม่ออก');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 13,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 13,  $this->get_screen_mouth_no_1_1());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 14,  '3.2 แผล (ulceration)');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 14,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 14,  $this->get_screen_mouth_no_1_2());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 15,  '3.3 ก้อนหรือติ่งเนื้อ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 15,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 15,  $this->get_screen_mouth_no_1_3());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 16,  '3.4 submucous fibrosis');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 16,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 16,  $this->get_screen_mouth_no_1_4());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 17,  '3.5 รอยโรคอื่นๆ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 17,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 17,  $this->get_screen_mouth_no_1_5());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 18,  'ผิดปกติ 2 รายการ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 18,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 18,  $this->get_screen_mouth_no_2());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 19,  'ผิดปกติ 3 รายการ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 19,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 19,  $this->get_screen_mouth_no_3());
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 20,  'ผิดปกติ 4 รายการขึ้นไป');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 20,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 20,  $this->get_screen_mouth_no_4());

		//  ==>4
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 21,  '4');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 21,  'ผลการตรวจชิ้นเนื้อ');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 22,  'ปกติ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 22,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 22,  $this->get_screen_meat_ok());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 23,  'Inflamation');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 23,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 23,  $this->get_screen_meat_inflammation());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 24,  'Mild dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 24,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 24,  $this->get_screen_meat_mild());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 25,  'Moderate dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 25,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 25,  $this->get_screen_meat_moderate());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 26,  'Severe dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 26,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 26,  $this->get_screen_meat_severe());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 27,  'Cacinoma in situ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 27,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 27,  $this->get_screen_meat_carcinoma());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 28,  'Oral cancer stage1');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 28,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 28,  $this->get_screen_meat_stage1());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 29,  'Oral cancer stage2');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 29,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 29,  $this->get_screen_meat_stage2());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 30,  'Oral cancer stage3');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 30,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 30,  $this->get_screen_meat_stage3());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 31,  'Oral cancer stage4');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 31,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 31,  $this->get_screen_meat_stage4());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 32,  'อื่น ๆ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 32,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 32,  $this->get_screen_meat_other());

		// ==>5
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 33,  '5');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 33,  'การจัดกลุ่มรอยโรค');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 34,  'Potentially malignant disorder');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 34,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 34,  $this->get_screen_potentially());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 35,  'Oral cancer');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 35,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 35,  $this->get_screen_cancer());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 36,  'Other');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 36,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 36,  $this->get_screen_other());

		// ==>6
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 37,  '6');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 37,  'การให้การรักษา');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 38,  'Medication');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 38,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 38,  $this->get_screen_medication());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 39,  'Surgery');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 39,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 39,  $this->get_screen_surgery());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 40,  'Follow up');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 40,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 40,  $this->get_screen_follow());

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 41,  'Refer');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 41,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 41,  $this->get_screen_refer());


		//End Detail	

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Set excel version 2007	  		
	    $objWriter->save(storage_path()."/excel/reportPMD".Session::get('uid').".xls");

	    return Response::download( storage_path()."/excel/reportPMD".Session::get('uid').".xls", "reportPMD".Session::get('uid').".xls");

    }
    




    /**
    * function name : get_screen_all
    * จำนวนผู้ป่วยทั้งหมด
    *  1
    */
    private function get_screen_all()
    {
    	return DB::table('screen')->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_men
    * จำนวนผู้ป่วย ชาย
    *  1
    */
    private function get_screen_men()
    {
		return DB::table('screen')->where('sex', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_girl
    * จำนวนผู้ป่วย หญิง
    *  1
    */
    private function get_screen_girl()
    {
    	return DB::table('screen')->where('sex', 2)->count(DB::raw('DISTINCT cid'));
    }






    /**
    * function name : get_screen_all_40
    * จำนวนผู้ป่วยทั้งหมด 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_all_40()
    {
    	return DB::table('screen')->where('age','>', 40)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_men_40
    * จำนวนผู้ป่วย ชาย 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_men_40()
    {
    	return DB::table('screen')->where('sex', 1)->where('age','>', 40)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_girl_40
    * จำนวนผู้ป่วย หญิง 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_girl_40()
    {
    	return DB::table('screen')->where('sex', 2)->where('age','>', 40)->count(DB::raw('DISTINCT cid'));
    }





    /**
    * function name : get_screen_mouth_ok
    * ผลการตรวจช่องปาก ปกติ
    *  3
    */
    private function get_screen_mouth_ok()
    {
    	return DB::table('screen')->where('part3_5', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no
    * ผลการตรวจช่องปาก ผิดปกติ
    *  3
    */
    private function get_screen_mouth_no()
    {
    	return DB::table('screen')->where('part3_5', 2)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_1
    * ผลการตรวจช่องปาก ผิดปกติ 1 รายการ
    *  3
    */
    private function get_screen_mouth_no_1()
    {
    	$data = DB::table('screen')->where('part3_5', 2)->select('part3_61','part3_62','part3_63','part3_64','part3_65')->get();

    	$sum=0;

    	foreach ($data as $key => $value) {
    		$k=0;

    		if( $value->part3_61 == 1 ){
    			$k++;
    		}

    		if( $value->part3_62 == 1 ){
    			$k++;
    		}

    		if( $value->part3_63 == 1 ){
    			$k++;
    		}

    		if( $value->part3_64 == 1 ){
    			$k++;
    		}

    		if( $value->part3_65 == 1 ){
    			$k++;
    		}

    		if( $k == 1 ){
    			$sum++;
    		}

    	}

    	return $sum;
    }

    /**
    * function name : get_screen_mouth_no_1_1
    * รอยโรคสีแดงหรือขาวขูดไม่ออก
    *  3.1
    */
    private function get_screen_mouth_no_1_1()
    {
    	return DB::table('screen')->where('part3_5', 2)->where('part3_61', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_1_2
    * แผล
    *  3.2
    */
    private function get_screen_mouth_no_1_2()
    {
    	return DB::table('screen')->where('part3_5', 2)->where('part3_62', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_1_3
    * ก้อนหรือติ่งเนื้อ
    *  3.3
    */
    private function get_screen_mouth_no_1_3()
    {
    	return DB::table('screen')->where('part3_5', 2)->where('part3_63', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_1_4
    * submucous fibrosis
    *  3.4
    */
    private function get_screen_mouth_no_1_4()
    {
    	return DB::table('screen')->where('part3_5', 2)->where('part3_64', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_1_5
    * รอยโรคอื่น ๆ
    *  3.5
    */
    private function get_screen_mouth_no_1_5()
    {
    	return DB::table('screen')->where('part3_5', 2)->where('part3_65', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_mouth_no_2
    * ผลการตรวจช่องปาก ผิดปกติ 2 รายการ
    *  3
    */
    private function get_screen_mouth_no_2()
    {
    	$data = DB::table('screen')->where('part3_5', 2)->select('part3_61','part3_62','part3_63','part3_64','part3_65')->get();

    	$sum=0;

    	foreach ($data as $key => $value) {
    		$k=0;

    		if( $value->part3_61 == 1 ){
    			$k++;
    		}

    		if( $value->part3_62 == 1 ){
    			$k++;
    		}

    		if( $value->part3_63 == 1 ){
    			$k++;
    		}

    		if( $value->part3_64 == 1 ){
    			$k++;
    		}

    		if( $value->part3_65 == 1 ){
    			$k++;
    		}

    		if( $k == 2 ){
    			$sum++;
    		}

    	}

    	return $sum;
    }

    /**
    * function name : get_screen_mouth_no_3
    * ผลการตรวจช่องปาก ผิดปกติ 3 รายการ
    *  3
    */
    private function get_screen_mouth_no_3()
    {
    	$data = DB::table('screen')->where('part3_5', 2)->select('part3_61','part3_62','part3_63','part3_64','part3_65')->get();

    	$sum=0;

    	foreach ($data as $key => $value) {
    		$k=0;

    		if( $value->part3_61 == 1 ){
    			$k++;
    		}

    		if( $value->part3_62 == 1 ){
    			$k++;
    		}

    		if( $value->part3_63 == 1 ){
    			$k++;
    		}

    		if( $value->part3_64 == 1 ){
    			$k++;
    		}

    		if( $value->part3_65 == 1 ){
    			$k++;
    		}

    		if( $k == 3 ){
    			$sum++;
    		}

    	}

    	return $sum;
    }

    /**
    * function name : get_screen_mouth_no_4
    * ผลการตรวจช่องปาก ผิดปกติ 4 รายการ ขึ้นไป
    *  3
    */
    private function get_screen_mouth_no_4()
    {
    	$data = DB::table('screen')->where('part3_5', 2)->select('part3_61','part3_62','part3_63','part3_64','part3_65')->get();

    	$sum=0;

    	foreach ($data as $key => $value) {
    		$k=0;

    		if( $value->part3_61 == 1 ){
    			$k++;
    		}

    		if( $value->part3_62 == 1 ){
    			$k++;
    		}

    		if( $value->part3_63 == 1 ){
    			$k++;
    		}

    		if( $value->part3_64 == 1 ){
    			$k++;
    		}

    		if( $value->part3_65 == 1 ){
    			$k++;
    		}

    		if( $k >= 4 ){
    			$sum++;
    		}

    	}

    	return $sum;
    }





    /**
    * function name : get_screen_meat_ok
    * ผลการตรวจชิ้นเนื้อ ปกติ
    *  4
    */
    private function get_screen_meat_ok()
    {
    	return DB::table('screen')->where('part4_1', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_inflammation
    * inflammation
    *  4
    */
    private function get_screen_meat_inflammation()
    {
    	return DB::table('screen')->where('part4_1', 2)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_mild
    * Dysplasia Mild
    *  4
    */
    private function get_screen_meat_mild()
    {
    	return DB::table('screen')->where('part4_1', 3)->where('part4_2', 1 )->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_moderate
    * Dysplasia Moderate
    *  4
    */
    private function get_screen_meat_moderate()
    {
    	return DB::table('screen')->where('part4_1', 3)->where('part4_2', 2 )->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_severe
    * Dysplasia Severe
    *  4
    */
    private function get_screen_meat_severe()
    {
    	return DB::table('screen')->where('part4_1', 3)->where('part4_2', 3 )->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_carcinoma
    * Carcinoma
    *  4
    */
    private function get_screen_meat_carcinoma()
    {
    	return DB::table('screen')->where('part4_1', 4)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_stage1
    * Oral cancer stage1
    *  4
    */
    private function get_screen_meat_stage1()
    {
    	return DB::table('screen')->where('part4_1', 5)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_stage2
    * Oral cancer stage2
    *  4
    */
    private function get_screen_meat_stage2()
    {
    	return DB::table('screen')->where('part4_1', 6)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_stage3
    * Oral cancer stage3
    *  4
    */
    private function get_screen_meat_stage3()
    {
    	return DB::table('screen')->where('part4_1', 7)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_stage4
    * Oral cancer stage4
    *  4
    */
    private function get_screen_meat_stage4()
    {
    	return DB::table('screen')->where('part4_1', 8)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_meat_other
    * Other
    *  4
    */
    private function get_screen_meat_other()
    {
    	return DB::table('screen')->where('part4_1', 9)->count(DB::raw('DISTINCT cid'));
    }





    /**
    * function name : get_screen_potentially
    * การจัดกลุ่มรอยโรค Potentially
    *  5
    */
    private function get_screen_potentially()
    {
    	return DB::table('screen')->where('part4_3', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_cancer
    * การจัดกลุ่มรอยโรค Oral cancer
    *  5
    */
    private function get_screen_cancer()
    {
    	return DB::table('screen')->where('part4_3', 2)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_other
    * การจัดกลุ่มรอยโรค Other
    *  5
    */
    private function get_screen_other()
    {
    	return DB::table('screen')->where('part4_3', 3)->count(DB::raw('DISTINCT cid'));
    }





    /**
    * function name : get_screen_medication
    * การให้การรักษา Medication
    *  6
    */
    private function get_screen_medication()
    {
    	return DB::table('screen')->where('part4_4', 1)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_surgery
    * การให้การรักษา Surgery
    *  6
    */
    private function get_screen_surgery()
    {
    	return DB::table('screen')->where('part4_4', 2)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_follow
    * การให้การรักษา Follow
    *  6
    */
    private function get_screen_follow()
    {
    	return DB::table('screen')->where('part4_4', 3)->count(DB::raw('DISTINCT cid'));
    }

    /**
    * function name : get_screen_refer
    * การให้การรักษา Refer
    *  6
    */
    private function get_screen_refer()
    {
    	return DB::table('screen')->where('part4_4', 4)->count(DB::raw('DISTINCT cid'));
    }





    
    /**
    * function name : monthyearThai
    * get data แสดง เดือน ปี ไทย
    * 
    */
	private function monthyearThai()
	{
		$thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");

     	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","      มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

     	//echo $thaiweek[date("w")] ,"ที่",date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543;
     	// ผลลัพธ์จะได้ดังนี้ครับ วันเสาร์ที่ 26 กันยายน พ.ศ. 2552
     	return $thaimonth[date(" m ")-1].' '.( date(" Y ")+543 );
	}

	private function get_monthyearThai( $m, $y )
	{
		$thaiweek=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์");

     	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","      มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

     	//echo $thaiweek[date("w")] ,"ที่",date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543;
     	// ผลลัพธ์จะได้ดังนี้ครับ วันเสาร์ที่ 26 กันยายน พ.ศ. 2552
     	return $thaimonth[$m-1].' '.( $y+543 );
	}
  

}
