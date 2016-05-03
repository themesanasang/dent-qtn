<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

    	$dateStart  = Input::get( 'date_start_pmd' );
	    $dateEnd 	= Input::get( 'date_end_pmd' );

		/*$sql  = ' select s.cid, s.bank_acc, concat(n.pname,"",n.fname," ",n.lname) as name, s.salary';	
		$sql .= ' ,s.salary_other, s.salary_sso, s.salary_cpk, s.save, s.shop ';
		$sql .= ' ,s.rice, s.water, s.elec, s.other';
		$sql .= ' from s_salary_detail s';
		$sql .= ' left join n_datageneral n on n.cid=s.cid';
		$sql .= ' where  month(s.order_date)='.$m.' and year(s.order_date)='.$y;
		$sql .= ' order by n.datainfoID asc';

		$result = DB::select( $sql );	*/				

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
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'จำนวน');	
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);	
		$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 		

		//  ==>1
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 3,  '1');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 3,  'จำนวนผู้ป่วยทั้งหมด');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 3,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 3,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 4,  'ชาย');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 4,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 4,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 5,  'หญิง');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 5,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 5,  '-');

		//  ==>2
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 6,  '2');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 6,  'จำนวนผู้ป่วยอายุ 40 ปีขึ้นไป');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 6,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 6,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 7,  'ชาย');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 7,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 7,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 8,  'หญิง');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 8,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 8,  '-');

		//  ==>3
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 9,  '3');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 9,  'ผลการตรวจช่องปาก');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 10,  'ปกติ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 10,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 10,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 11,  'ผิดปกติรวม');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 11,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 11,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 12,  '3.1 รอยโรคสีแดงหรือขาวขูดไม่ออก');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 12,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 12,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 13,  '3.2 แผล (ulceration)');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 13,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 13,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 14,  '3.3 ก้อนหรือติ่งเนื้อ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 14,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 14,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 15,  '3.4 submucous fibrosis');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 15,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 15,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (2, 16,  '3.5 รอยโรคอื่นๆ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 16,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 16,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 17,  'ผิดปกติ 2 รายการ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 17,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 17,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 18,  'ผิดปกติ 3 รายการ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 18,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 18,  '-');
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 19,  'ผิดปกติ 4 รายการขึ้นไป');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 19,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 19,  '-');

		//  ==>4
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 20,  '4');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 20,  'ผลการตรวจชิ้นเนื้อ');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 21,  'ปกติ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 21,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 21,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 22,  'Inflamation');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 22,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 22,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 23,  'Mild dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 23,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 23,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 24,  'Moderate dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 24,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 24,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 25,  'Severe dysplasia');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 25,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 25,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 26,  'Cacinoma in situ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 26,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 26,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 27,  'Oral cancer stage1');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 27,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 27,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 28,  'Oral cancer stage2');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 28,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 28,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 29,  'Oral cancer stage3');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 29,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 29,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 30,  'Oral cancer stage4');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 30,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 30,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 31,  'อื่น ๆ');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 31,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 31,  '-');

		// ==>5
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 32,  '5');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 32,  'การจัดกลุ่มรอยโรค');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 33,  'Potentially malignant disorder');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 33,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 33,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 34,  'Oral cancer');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 34,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 34,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 35,  'Other');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 35,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 35,  '-');

		// ==>6
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0, 36,  '6');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 36,  'การให้การรักษา');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 37,  'Medication');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 37,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 37,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 38,  'Surgery');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 38,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 38,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 39,  'Follow up');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 39,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 39,  '-');

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (1, 40,  'Refer');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (3, 40,  'คน');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (4, 40,  '-');


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

    }


    /**
    * function name : get_screen_men
    * จำนวนผู้ป่วย ชาย
    *  1
    */
    private function get_screen_men()
    {

    }

    /**
    * function name : get_screen_girl
    * จำนวนผู้ป่วย หญิง
    *  1
    */
    private function get_screen_girl()
    {
    	
    }


    /**
    * function name : get_screen_all_40
    * จำนวนผู้ป่วยทั้งหมด 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_all_40()
    {
    	
    }


    /**
    * function name : get_screen_men_40
    * จำนวนผู้ป่วย ชาย 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_men_40()
    {
    	
    }


    /**
    * function name : get_screen_girl_40
    * จำนวนผู้ป่วย หญิง 40 ปีขึ้นไป
    *  2
    */
    private function get_screen_girl_40()
    {
    	
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
