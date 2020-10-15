<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class UserController extends Controller
{
	public function view() 
	{
		$hotel = new Hotel();
		$data = array();
		$data['user'] = $hotel->getUser();
		$data['role'] = $hotel->getRole();

		return view('pages.usermanagement', $data);
	}

	public function readUser(Request $req)
	{
		$id = $req->get('id');
		$read = DB::table('user')
		->where('id_user', $id)
		->get();

		return $read;
	}

	public function createUser(Request $req)
	{
		$password_hash = md5($req->input('password'));
		$insert = DB::table('user')
		->insert([
			'username'		=> $req->input('username'),
			'password'		=> $password_hash,
			'nama'			=> $req->input('nama_pengguna'),
			'id_user_role'	=> $req->input('select_role'),
			'jabatan'		=> $req->input('jabatan'),
			'nomor_telp'	=> $req->input('nomor_telep')
		]);

		if ($insert) {
			return 'sukses';
		} else {
			return 'error';
		}
	}

	public function updateUser(Request $req)
	{
		$id = $req->input('id_edit');
		$password_hash = md5($req->input('password_edit'));
		$update = DB::table('user')
		->where('id_user', $id)
		->update([
			'username'		=> $req->input('username_edit'),
			'password'		=> $password_hash,
			'nama'			=> $req->input('nama_pengguna_edit'),
			'id_user_role'	=> $req->input('select_role_edit'),
			'jabatan'		=> $req->input('jabatan_edit'),
			'nomor_telp'	=> $req->input('nomor_telep_edit')
		]);

		if ($update) {
			return 'sukses';
		} else  {
			return 'error';
		}
	}

	public function deleteUser(Request $req)
	{
		$id = $req->get('id');
		$delete = DB::table('user')
		->where('id_user', $id)
		->delete();

		if ($delete < 0) {
			return "gagal";
		} else {
			return "sukses";
		}
	}
}
