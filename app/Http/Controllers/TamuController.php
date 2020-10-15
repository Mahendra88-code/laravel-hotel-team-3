<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class TamuController extends Controller
{
	public function view() 
	{
		$hotel = new Hotel();
		$data = array();
		$data['tamu'] = $hotel->getTamu();

		return view('pages.tamu', $data);
	}

	public function createTamu(Request $req)
	{
		$insert = DB::table('tamu')
		->insert([
			'prefix' 			=> $req->input('select_prefix'),
			'nama_depan' 		=> $req->input('nama_depan'),
			'nama_belakang' 	=> $req->input('nama_belakang'),
			'tipe_identitas' 	=> $req->input('select_identitas'),
			'nomor_identitas' 	=> $req->input('nomor_identitas'),
			'warga_negara' 		=> $req->input('warga_negara'),
			'alamat_jalan' 		=> $req->input('alamat'),
			'alamat_kabupaten' 	=> $req->input('kab_kota'),
			'alamat_provinsi' 	=> $req->input('provinsi'),
			'nomor_telp' 		=> $req->input('no_telep'),
			'email' 			=> $req->input('email')
		]);

		if ($insert) {
			return 'sukses';
		} else {
			return 'error';
		}
	}

	public function readTamu(Request $req)
	{
		$id = $req->get('id');
		$read = DB::table('tamu')
		->where('id_tamu', $id)
		->get();

		return $read;
	}

	public function updateTamu(Request $req)
	{
		$id = $req->input('id_edit');
		$update = DB::table('tamu')
		->where('id_tamu', $id)
		->update([
			'prefix' 			=> $req->input('select_prefix_edit'),
			'nama_depan' 		=> $req->input('nama_depan_edit'),
			'nama_belakang' 	=> $req->input('nama_belakang_edit'),
			'tipe_identitas' 	=> $req->input('select_identitas_edit'),
			'nomor_identitas' 	=> $req->input('nomor_identitas_edit'),
			'warga_negara' 		=> $req->input('warga_negara_edit'),
			'alamat_jalan' 		=> $req->input('alamat_edit'),
			'alamat_kabupaten' 	=> $req->input('kab_kota_edit'),
			'alamat_provinsi' 	=> $req->input('provinsi_edit'),
			'nomor_telp' 		=> $req->input('no_telep_edit'),
			'email' 			=> $req->input('email_edit')
		]);

		if($update) {
			return 'sukses';
		} else {
			return 'error';
		}	
	}

	public function deleteTamu(Request $req)
	{
		$id = $req->get('id');
		$delete = DB::table('tamu')
		->where('id_tamu', $id)
		->delete();

		if($delete < 0) {
			return "gagal";
		} else {
			return "sukses";
		}
	}

}
