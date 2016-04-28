<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Crypt;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Str;

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
		return $response->setContentDisposition($disposition, $filename, Str::ascii($filename));
	}

}
