<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class DashboardController extends Controller
{
    public function view() 
    {
    	$hotel = new Hotel();
    	$data = array();
    	$data['tersedia'] = $hotel->getTersedia();
    	$data['terpakai'] = $hotel->getTerpakai();
    	$data['kotor'] = $hotel->getKotor();
    	$data['inhouse'] = $hotel->getInHouse();
    	$data['outnow'] = $hotel->getOutNow();

    	return view('pages.dashboard', $data);
    }
}
