<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class loginController extends Controller
{
	public function view()
	{
		return view('auth.login');
	}    

	public function postLogin(Request $request)
	{
		$condition = false;
		$user = $this->find_user($request->get('username'));

		//dd($user);

		if ($user != null) {                
			if ($user->username == $request->get('username') && $user->password == md5($request->get('password'))) {
				$condition = true;
			}
		}     

		if ($condition) {
			Session::put('is_login', true);
			Session::put('id', $user->id_user);         
			Session::put('name',$user->nama);
			Session::put('images',$user->images);

			//dd($user->images);

			return [
				"status" => "success",
				"redirect_route" => "dashboard" 
			];
		} else  {
			return [
				"status" => "error",
				"message" => "User is not valid"
			];
		}

	}

	public function find_user($username)
	{
		return DB::table('user')
		->where('username', $username)        
		->first();
	}

	public function logout(){
		Session::flush();
		return redirect('login')->with('status','Logout Successfully');
	}
}