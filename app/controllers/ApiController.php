<?php

	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	use Illuminate\Http\Response;

class ApiController extends \BaseController
{

	public function search()
	{
		$keyword = Request::query('keyword');
		$method = Request::method();
		if (Request::isMethod('post')) {
			$validator = Validator::make(Input::all(), APi::$searchrules);

			if ($validator->passes()) {
				$Api = new Api();
				$output = $Api->globalSearch();
				$result = json_encode($output);
			} else {
				return "Still working on it";
			}

			return $result;
		}

		return "Coming shortly";

	}
}
