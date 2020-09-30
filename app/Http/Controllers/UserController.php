<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class UserController extends Controller
{
    public function view() 
    {
    	$hotel = new Hotel();
    	$data = array();
    	$data['user'] = $hotel->getUser();

    	return view('pages.usermanagement', $data);
    }
}
