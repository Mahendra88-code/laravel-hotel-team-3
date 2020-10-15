<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LihatLayananController extends Controller
{
	public function view() 
	{
		$layanan = DB::table('layanan')
		->join('layanan_kategori', 'layanan_kategori.id_layanan_kategori', '=', 'layanan.id_layanan_kategori')
		->get();

		$kategori = DB::table('layanan_kategori')
		->get();

		return view('pages.lihatlayanan', [
			'layanan' => $layanan,
			'kategori' => $kategori
		]);
	}

	public function insertLayanan(Request $req)
	{
		$insert = DB::table('layanan')
		->insert([
			'nama_layanan' 			=> $req->input('nama_produk'),
			'id_layanan_kategori'	=> $req->input('select_kategori'),
			'satuan'				=> $req->input('satuan'),
			'harga_layanan'			=> $req->input('harga')
		]);

		if($insert) {
			return 'sukses';
		} else {
			return 'error';
		}
	}

	public function deleteLayanan(Request $req)
	{
		$id=$req->get('id');
		$delete=DB::table('layanan')
		->where('id_layanan',$id)
		->delete();

		if($delete < 0){
			return "gagal";
		}else{
			return "sukses";
		}
	}

	public function getLayanan(Request $req)
	{
		$id = $req->get('id');
		$data=DB::table('layanan')
		->join('layanan_kategori', 'layanan_kategori.id_layanan_kategori', '=', 'layanan.id_layanan_kategori')
		->where('id_layanan', $id)
		->get();

		return $data;	
	}

	public function updateLayanan(Request $req)
	{	
		$id = $req->input('id_edit');
		$update = DB::table('layanan')
		->where('id_layanan', $id)
		->update([
			'nama_layanan' 			=> $req->input('nama_produk_edit'),
			'id_layanan_kategori'	=> $req->input('select_kategori_edit'),
			'satuan'				=> $req->input('satuan_edit'),
			'harga_layanan'			=> $req->input('harga_edit')
		]);

		if($update) {
			return 'sukses';
		} else {
			return 'error';
		}	
	}
}
