<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class KategoriLayananController extends Controller
{
	public function view() 
	{
		$hotel = new Hotel();
    	$data = array();
    	$data['klayanan'] = $hotel->getKLayanan();

		return view('pages.kategorilayanan', $data);
	}
}
