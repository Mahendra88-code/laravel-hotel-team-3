<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class LihatKamarController extends Controller
{	
	public function view() 
	{
		$kamar = DB::table('kamar')
		->join('kamar_tipe', 'kamar_tipe.id_kamar_tipe', '=', 'kamar.id_kamar_tipe')
		->get();

		$tipe = DB::table('kamar_tipe')
		->get();

		return view('pages.lihatkamar', [
			'kamar' => $kamar,
			'tipe' => $tipe
		]);
	}

	public function insertKamar(Request $req)
	{	
		$insert = DB::table('kamar')
		->insert([
			'nomor_kamar' 	=> $req->input('nomor_kamar'),
			'id_kamar_tipe' => $req->input('select_tipe'),
			'max_dewasa' 	=> $req->input('select_dewasa'),
			'max_anak' 		=> $req->input('select_anak'),
			'status_kamar' 	=> "TERSEDIA"
		]);

		if($insert){
			return 'sukses';
		}else{
			return 'error';
		}
	}	

	public function deleteKamar(Request $req)
	{
		$id=$req->get('uid');
		$delete=DB::table('kamar')
		->where('id_kamar',$id)
		->delete();

		if($delete < 0){
			return "gagal";
		}else{
			return "sukses";
		}
	}

	public function getKamar(Request $req)
	{
		$id = $req->get('uid');
		$data=DB::table('kamar')
		->where('id_kamar',$id)
		->get();
		return $data;
	}

	public function updateKamar(Request $req)
	{
		$id=$req->input('id_edit');
		$update=DB::table('kamar')
		->where('id_kamar',$id)
		->update([
			'nomor_kamar' 	=> $req->input('nomor_kamar_edit'),
			'id_kamar_tipe' => $req->input('select_tipe_edit'),
			'max_dewasa' 	=> $req->input('select_dewasa_edit'),
			'max_anak' 		=> $req->input('select_anak_edit'),
			'status_kamar' 	=> $req->input('select_status_edit')
		]);

		if($update){
			return "sukses";
		}else{
			return "error";
		}
	}
}
