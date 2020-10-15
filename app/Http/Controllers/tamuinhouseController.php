<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class tamuinhouseController extends Controller
{
    public function view()
    {
    	$tamuih = DB::table('transaksi_kamar')
    	->join('tamu', 'tamu.id_tamu', '=', 'transaksi_kamar.id_tamu')
    	->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
    	->where('status', 'CHECK IN')
    	->get(); 

        $tamu = DB::table('tamu')
        ->get();

        return view('pages.tamuinhouse', [
          'tamuih' => $tamuih,
          'tamu' => $tamu
      ]);
    }

    public function readTransaksi(Request $req)
    {
        $id = $req->get('id');
        $read = DB::table('transaksi_kamar')
        ->where('id_transaksi_kamar', $id)
        ->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
        ->join('tamu', 'tamu.id_tamu', '=', 'transaksi_kamar.id_tamu')
        ->join('kamar_tipe' , 'kamar_tipe.id_kamar_tipe', '=', 'kamar.id_kamar_tipe')
        ->get();

        return $read;
    }

    public function updateTransaksi(Request $req)
    {
        $checkin = date("Y-m-d", strtotime( $req->input( 'tanggal_checkin' ) ) );
        $checkout = date("Y-m-d", strtotime( $req->input( 'tanggal_checkout' ) ) );

        $tanggal_checkin = date_create( $checkin );
        $tanggal_checkout = date_create( $checkout );

        $durasi = date_diff( $tanggal_checkin, $tanggal_checkout )->format( '%a' );
        $total_biaya_kamar = $durasi * $req->input('hargaper');

        $id = $req->input('id_transaksi');

        $update = DB::table('transaksi_kamar')
        ->where('id_transaksi_kamar', $id)
        ->update([
            'id_user'           => $req->input('id_user'),
            'nomor_invoice'     => $req->input('invoice'),
            'tanggal'           => date('Y-m-d'),
            'id_tamu'           => $req->input('select_tamu'),
            'id_kamar'          => $req->input('id_kamar'),
            'jumlah_dewasa'     => $req->input('select_dewasa'),
            'jumlah_anak'       => $req->input('select_anak'),
            'tanggal_checkin'   => $checkin,
            'waktu_checkin'     => $req->input('waktu_checkin'),
            'tanggal_checkout'  => $checkout,
            'waktu_checkout'    => $req->input('waktu_checkout'),
            'deposit'           => $req->input('jumlah_deposit'),
            'total_biaya_kamar' => $total_biaya_kamar,
            'status'            => 'CHECK IN'
        ]);

        if ($update) {
            return 'sukses';
        } else  {
            return 'error';
        }
    }
}
