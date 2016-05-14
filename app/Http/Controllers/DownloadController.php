<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Crypt;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Str;
use App\Models\Screen;
use DB;
use App\Logs;
use Session;
use Illuminate\Http\Request;

class DownloadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($path, $filename)
	{
		$headers = array();
		$disposition = 'attachment';
		$response = new BinaryFileResponse(Crypt::decrypt($path), 200, $headers, true);

		Logs::createlog(Session::get('username'), 'load file '.$filename );

		return $response->setContentDisposition($disposition, $filename, Str::ascii($filename));
	}


	public function deleteFile($path, $filename, $screenid, $fileid)
	{
		$flgDelete = unlink(Crypt::decrypt($path));
		$screen = Screen::find(Crypt::decrypt($screenid));

		if(Crypt::decrypt($fileid) == 1){
			$screen->name_file1         = '';
            $screen->file1              = '';

            Logs::createlog(Session::get('username'), 'delete file list 1');
		}

		if(Crypt::decrypt($fileid) == 2){
			$screen->name_file2         = '';
            $screen->file2              = '';

            Logs::createlog(Session::get('username'), 'delete file list 2');
		}

		if(Crypt::decrypt($fileid) == 3){
			$screen->name_file3         = '';
            $screen->file3              = '';

            Logs::createlog(Session::get('username'), 'delete file list 3');
		}

		if(Crypt::decrypt($fileid) == 4){
			$screen->name_file4         = '';
            $screen->file4              = '';

            Logs::createlog(Session::get('username'), 'delete file list 4');
		}

		if(Crypt::decrypt($fileid) == 5){
			$screen->name_file5         = '';
            $screen->file5             = '';

            Logs::createlog(Session::get('username'), 'delete file list 5');
		}

		DB::transaction(function() use ($screen) {
                $screen->save();  
            }); 

		return redirect()->action('ScreenController@edit', [$screenid]);
	}

}
