<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class LihatKamarController extends Controller
{
    public function view() 
    {
    	$hotel = new Hotel();
    	$data = array();
    	$data['kamar'] = $hotel->getKamar();

    	return view('pages.lihatkamar', $data);
    }
}
