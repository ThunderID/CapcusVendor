<?php

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
	function form()
	{
		$this->layout = view('default.templates.html_blank');
		$this->layout->login = view('default.login');

		return $this->layout;
	}

	function post_login()
	{
		$input = request()->input();

		///////////////////////
		// Validate remotely //
		///////////////////////
		$data['email'] 		= $input['email'];
		$data['password'] 	= $input['password'];
		$data['auth']		= 'dashboard';

		$api_response = json_decode($this->api->post($this->api_url . '/users/authenticate', ['form_params' => $data])->getBody());

		//////////////
		// redirect //
		//////////////
		if (str_is('success', $api_response->status))
		{
			return redirect()->route('dashboard');
		}
		else
		{
			return redirect()->back()->withErrors(new MessageBag(['auth' => "Unauthorized Access"]));
		}
	}

	function logout()
	{
		session()->flush();
		return redirect()->route('login');
	}
}
