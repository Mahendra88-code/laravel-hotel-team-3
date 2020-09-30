<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class TamuController extends Controller
{
	public function view() 
	{
		$hotel = new Hotel();
		$data = array();
		$data['tamu'] = $hotel->getTamu();

		return view('pages.tamu', $data);
	}

}
