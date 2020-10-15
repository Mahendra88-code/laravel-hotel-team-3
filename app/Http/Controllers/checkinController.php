<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class checkinController extends Controller
{
	public function view()
	{
		$kamar = DB::table('kamar')
		->where('status_kamar', 'TERSEDIA')
		->orderBy('nomor_kamar', 'asc')
		->get();

		$tamu = DB::table('tamu')
		->get();

		return view('pages.checkin', [
			'kamar' => $kamar,
			'tamu' => $tamu
		]);
	}

	public function readCheckin(Request $req)
	{
		$id = $req->get('id');
		$read = DB::table('kamar')
		->join('kamar_tipe', 'kamar_tipe.id_kamar_tipe', '=', 'kamar.id_kamar_tipe')
		->where('id_kamar', $id)
		->get();

		return $read;

	}

	public function createCheckin(Request $req)
	{
		$checkin = date("Y-m-d", strtotime( $req->input( 'tanggal_checkin' ) ) );
		$checkout = date("Y-m-d", strtotime( $req->input( 'tanggal_checkout' ) ) );

		$tanggal_checkin = date_create( $checkin );
		$tanggal_checkout = date_create( $checkout );

		$durasi = date_diff( $tanggal_checkin, $tanggal_checkout )->format( '%a' );
		$total_biaya_kamar = $durasi * $req->input('hargaper');

		$id_kamar = $req->input('id_kamar');

		$insert = DB::table('transaksi_kamar')
		->insert([
			'id_user'			=> $req->input('id_user'),
			'nomor_invoice'		=> $req->input('invoice'),
			'tanggal'			=> date('Y-m-d'),
			'id_tamu'			=> $req->input('select_tamu'),
			'id_kamar'			=> $id_kamar,
			'jumlah_dewasa'		=> $req->input('select_dewasa'),
			'jumlah_anak'		=> $req->input('select_anak'),
			'tanggal_checkin'	=> $checkin,
			'waktu_checkin'		=> $req->input('waktu_checkin'),
			'tanggal_checkout'	=> $checkout,
			'waktu_checkout'	=> $req->input('waktu_checkout'),
			'deposit'			=> $req->input('jumlah_deposit'),
			'total_biaya_kamar'	=> $total_biaya_kamar,
			'status'			=> 'CHECK IN'
		]);

		$update = DB::table('kamar')
		->where('id_kamar', $id_kamar)
		->update([
			'status_kamar' => 'TERPAKAI'
		]);

		if ($insert) {
			return 'sukses';
		} else {
			return 'error';
		}
	}
}
