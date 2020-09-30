<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class TipeKamarController extends Controller
{
    public function view() 
    {
    	$hotel = new Hotel();
    	$data = array();
    	$data['tkamar'] = $hotel->getTKamar();

    	return view('pages.tipekamar', $data);
    }
}
