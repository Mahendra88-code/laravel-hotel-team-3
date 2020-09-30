<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class LihatLayananController extends Controller
{
    public function view() 
    {
    	$hotel = new Hotel();
    	$data = array();
    	$data['layanan'] = $hotel->getLayanan();

    	return view('pages.lihatlayanan', $data);
    }
}
