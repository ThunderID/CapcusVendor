<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	function __construct() 
	{
		////////
		// Me //
		////////
		$this->me = null;

		///////////////////
		// Init Template //
		///////////////////
		$this->version = env('WEB_VERSION', 'default');
		$this->layout = view($this->version . '.templates.html'); 

		//////////////
		// Init API //
		//////////////
		$this->api_url = $this->layout->api_url = env('API_URL', 'http://api.capcus.id');
		$this->api = new \GuzzleHttp\Client(['base_url' => $this->api_url]);

		////////////////
		// Init Alert //
		////////////////
		foreach (Session::all() as $k => $v)
		{
			if (str_is('_alert_*', $k))
			{
				$this->layout->$k = $v;
			}
		}
	}
}
