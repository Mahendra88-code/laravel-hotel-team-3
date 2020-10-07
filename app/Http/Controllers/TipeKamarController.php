<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class TipeKamarController extends Controller
{
	public function view() 
	{
		$hotel = new Hotel();
		$data = array();
		$data['tkamar'] = $hotel->getTKamar();

		return view('pages.tipekamar', $data);
	}

	public function insertTipe(Request $req)
	{	
		$insert = DB::table('kamar_tipe')
		->insert([
			'nama_kamar_tipe' => $req->input('nama_tipe_kamar'),
			'harga_malam' => $req->input('hargapermalam'),
			'harga_orang' => $req->input('hargaperorang'),
			'keterangan' => $req->input('keterangan')
		]);

		if($insert){
			return 'sukses';
		}else{
			return 'error';
		}
	}	

	public function deleteTipe(Request $req)
	{
		$id=$req->get('uid');
		$delete=DB::table('kamar_tipe')
		->where('id_kamar_tipe',$id)
		->delete();

		if($delete < 0){
			return "gagal";
		}else{
			return "sukses";
		}
	}

	public function getTipe(Request $req)
	{
		$id = $req->get('uid');
		$data=DB::table('kamar_tipe')
		->where('id_kamar_tipe',$id)
		->get();
		return $data;
	}

	public function updateTipe(Request $req)
	{
		$id=$req->input('id_edit');
		$update=DB::table('kamar_tipe')
		->where('id_kamar_tipe',$id)
		->update([
			'nama_kamar_tipe' => $req->input('nama_tipe_kamar_edit'),
			'harga_malam' => $req->input('hargapermalam_edit'),
			'harga_orang' => $req->input('hargaperorang_edit'),
			'keterangan' => $req->input('keterangan_edit')
		]);

		if($update){
			return "sukses";
		}else{
			return "error";
		}
	}
}
