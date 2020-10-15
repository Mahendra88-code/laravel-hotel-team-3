<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class pesanlayananController extends Controller
{
    public function view()
    {
    	$pesan = DB::table('kamar')
    	->where('status_kamar', 'TERPAKAI')
    	->orderBy('nomor_kamar', 'asc')
    	->get();

        $kategori = DB::table('layanan_kategori')
        ->get();

        $transaksi = DB::table('transaksi_kamar')
        ->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
        //->where('status_kamar', 'TERPAKAI')
        ->where('status', 'CHECK IN')
        ->orderBy('nomor_kamar', 'asc')
        ->get();

        return view('pages.pesanlayanan', [
          'pesan' => $pesan,
          'transaksi' => $transaksi,
          'kategori' => $kategori
      ]);
    }

    public function readKamar(Request $req)
    {
        $id = $req->get('id');
        $data = DB::table('transaksi_kamar')
        ->where('transaksi_kamar.id_kamar', $id)
        ->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
        ->join('tamu', 'tamu.id_tamu', '=', 'transaksi_kamar.id_tamu')
        ->get();

        return $data;
    }

    public function listPesanan(Request $req)
    {
        $id = $req->get('id');
        $data = DB::table('layanan')
        ->where('id_layanan_kategori', $id)
        ->get();

        echo "
        <table class='table table-bordered table-hover table-striped w-100' id='datatables'>
        <thead>
        <tr>
        <th hidden></th>
        <th> Nama Produk / Layanan </th>
        <th> Harga </th>
        <th> Jumlah Pesanan </th>
        </tr>
        </thead>
        <tbody>
        ";

        foreach ($data as $d) {
            echo "
            <tr>
            <td hidden></td>
            <td>" . $d->nama_layanan . "</td>
            <td>Rp. " . number_format($d->harga_layanan, 2, ',', '.') . " / " . $d->satuan . "</td>
            <td>
            <input type='text' name='id_layanan' id='id_layanan' value='" . $d->id_layanan . "' hidden>
            <input type='text' name='harga_layanan' id='harga_layanan' value='" . $d->harga_layanan . "' hidden>
            <input type='number' name='jumlah_pesanan' id='jumlah_pesanan' class='w-25'> &nbsp; Porsi
            <button class='btn btn-success btn-sm float-right' onclick='pesan()'>
            Pesan
            </button>
            </td>
            </tr>
            ";
        }

        echo "
        </tbody>
        </table>
        ";
    }

    public function savePesan(Request $req)
    {
        $id_user = $req->session()->get('id');
        $id_layanan = $req->get('id_layanan');
        $id_transaksi_kamar = $req->get('id_transaksi_kamar');
        $jumlah = $req->get('jumlah');
        $harga_layanan = $req->get('harga');
        $total_pesanan = $harga_layanan * $jumlah;

        $create = DB::table('transaksi_layanan')
        ->insert([
            'id_user'               => $id_user,
            'id_transaksi_kamar'    => $id_transaksi_kamar,
            'tanggal'               => date('Y-m-d'),
            'waktu'                 => date('H:i'),
            'id_layanan'            => $id_layanan,
            'jumlah'                => $jumlah,
            'total'                 => $total_pesanan
        ]);

        if ($create) {
            return 'sukses';
        } else {
            return 'error';
        }
    }
}
