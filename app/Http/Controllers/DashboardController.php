<?php

namespace App\Http\Controllers;
use Session;

class DashboardController extends Controller
{
	function overview()
	{
		///////////////////////////////////
		// GET ISSUED VOUCHER STATISTICS //
		///////////////////////////////////
		$start_date 				= \Carbon\Carbon::now()->subDay(30); 
		$end_date 					= \Carbon\Carbon::now()->now();

		$query['travel_agent_id']	= Session::get('me')->travel_agent_id;
		$query['start_date']		= $start_date->format('Y-m-d');
		$query['end_date']			= $end_date->format('Y-m-d');
		$api_result = json_decode($this->api->get($this->api_url . '/stats/issued_vouchers?' . http_build_query($query))->getBody());
		if (str_is('success', $api_result->status))
		{
			while ($start_date->lt($end_date))
			{
				$stats['issued_vouchers'][$start_date->format('d-m-Y')] = 0;
				$start_date->addDay(1);
			}

			// dd($api_result->data->data);
			foreach ($api_result->data->data as $stat)
			{
				$stats['issued_vouchers'][\Carbon\Carbon::parse($stat->_id->year . '-' . $stat->_id->month . '-' . $stat->_id->day)->format('d-m-Y')]	= $stat->count;
			}
		}

		///////////////////////////////////
		// GET ISSUED VOUCHER STATISTICS //
		///////////////////////////////////
		$start_date 				= \Carbon\Carbon::now()->subDay(30); 
		$end_date 					= \Carbon\Carbon::now()->now();

		unset($query);
		$query['travel_agent_id']	= Session::get('me')->travel_agent_id;
		$query['start_date']		= $start_date->format('Y-m-d');
		$query['end_date']			= $end_date->format('Y-m-d');
		$api_result = json_decode($this->api->get($this->api_url . '/stats/validated_vouchers?' . http_build_query($query))->getBody());
		if (str_is('success', $api_result->status))
		{
			while ($start_date->lt($end_date))
			{
				$stats['validated_vouchers'][$start_date->format('d-m-Y')] = 0;
				$start_date->addDay(1);
			}

			// dd($api_result->data->data);
			foreach ($api_result->data->data as $stat)
			{
				$stats['validated_vouchers'][\Carbon\Carbon::parse($stat->_id->year . '-' . $stat->_id->month . '-' . $stat->_id->day)->format('d-m-Y')]	= $stat->count;
			}
		}

		////////////////////////////////////
		// GET CLAIMED VOUCHER STATISTICS //
		////////////////////////////////////
		$this->layout->active_menu 		= 'dashboard';
		$this->layout->page 			= view($this->version . '.dashboard.overview');
		$this->layout->page->stats 		= $stats;
		return $this->layout;
	}
}
