<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\MessageBag;
use Session;

class VoucherController extends Controller
{
	function index()
	{
		/////////////////
		// Pagination  //
		/////////////////
		$page = max(1, request()->input('page'));
		$per_page = 50;
		$skip = ($page - 1) * $per_page;

		//////////////
		// Get Data //
		//////////////
		$query['skip']		= $skip;
		$query['take']		= $per_page;
		$query['with_count']= true;
		if (str_is('latest-validated', strtolower(request()->input('sort'))))
		{
			$query['sort']		= 'latest-validated';
			$query['status']	= 'validated';
		}

			// echo $this->api_url . '/vouchers/issued?' . http_build_query($query);exit;
		$api_result = $this->api->get($this->api_url . '/vouchers/issued?' . http_build_query($query));
		$data = json_decode($api_result->getBody());

		////////////////
		// Pagination //
		////////////////
		$pagination['total_page'] 			= ceil($data->data->count / $per_page);
		$pagination['current_page']			= $page;
		$pagination['total_data']			= $data->data->count;
		$pagination['from']					= $skip + 1;
		$pagination['to']					= min($skip + $per_page, $data->data->count);
		$pagination['paginator']			= new LengthAwarePaginator($data->data->data, $pagination['total_data'], $per_page, $page, ['path'  => request()->url(), 'query' => request()->query()]);

		//////////
		// VIEW //
		//////////
		$this->layout->active_menu 		= 'voucher';
		$this->layout->page 			= view($this->version . '.vouchers.index');
		$this->layout->page->pagination = $pagination;
		$this->layout->page->data 		= $data->data->data;
		$this->layout->page->is_validated_mode 	= ($query['status'] == 'validated' ? true : false);
		return $this->layout;
	}

	function validate()
	{
		////////////////
		// Check Code //
		////////////////
		$query['code'] 				= request()->input('kode');

		if (!$query['code'])
		{
			return redirect()->back()->withErrors(new MessageBag(['404' => 'Masukkan kode voucher yang akan divalidasi']));
		}
		// $query['travel_agent_id'] 	= Session::get('me')->travel_agent->_id;
		$query['travel_agent_id'] 	= "570fbf30b292c9660a8b45c5";

		/////////////////////////////
		// VALIDATE ISSUED VOUCHER //
		/////////////////////////////
		$api_result = json_decode($this->api->get($this->api_url . '/vouchers/validate/' . $query['code'] . '/' . $query['travel_agent_id'])->getBody());

		if (str_is('fail', $api_result->status ))
		{
			$errors = new MessageBag();

			foreach ($api_result->data as $k => $error)
			{
				switch ($k) {
					case 'VoucherNotFound':
						$errors->add($k, 'Voucher dengan kode "' . $query['code'] . '" belum diissue di system');
						break;
					case 'VoucherAlreadyValidated':
						$errors->add($k, $error);
						break;
				}
			}
			return redirect()->back()->withInput()->withErrors($errors);
		}
		else
		{
			Session::flash('_alert_success', 'Voucher dengan kode "' .strtoupper($query['code']). '" berhasil divalidasi');
			return redirect()->route('voucher.detail', ['voucher_code' => $query['code']]);
		}
	}

	function detail($code)
	{
		////////////////
		// Check Code //
		////////////////
		if (!$code)
		{
			return app()->abort(404);
		}
		// $query['travel_agent_id'] 	= Session::get('me')->travel_agent->_id;
		$query['travel_agent_id'] 	= "570fbf30b292c9660a8b45c5";

		////////////////////////
		// GET ISSUED VOUCHER //
		////////////////////////
		$api_result = json_decode($this->api->get($this->api_url . '/vouchers/issued/' . $query['code'])->getBody());
		$issued_voucher = $api_result->data->data[0];

		if (!$issued_voucher)
		{
			return app()->abort(404);
		}

		//////////
		// VIEW //
		//////////
		$this->layout->active_menu 		= 'voucher';
		$this->layout->page 			= view($this->version . '.vouchers.detail');
		$this->layout->page->issued_voucher		= $issued_voucher;
		return $this->layout;
	}
}
