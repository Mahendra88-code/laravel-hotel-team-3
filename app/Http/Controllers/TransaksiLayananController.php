<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransaksiLayananController extends Controller
{
	public function view() 
	{
		return view('pages.transaksilayanan');
	}

	public function getTLayanan(Request $req)
	{		
		$now = date("Y-m-d", strtotime($req->get('dari_tanggal')));
		$to = date("Y-m-d", strtotime($req->get('sampai_tanggal')));

		$data = DB::table('transaksi_layanan')
		->join('user', 'user.id_user', '=', 'transaksi_layanan.id_user')
		->join('layanan', 'layanan.id_layanan', '=', 'transaksi_layanan.id_layanan')
		->join('transaksi_kamar', 'transaksi_kamar.id_transaksi_kamar', '=', 'transaksi_layanan.id_transaksi_kamar')
		->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
		->whereBetween('transaksi_layanan.tanggal', [$now, $to])
		->get();

		$total=DB::table('transaksi_layanan')
		->whereBetween('tanggal', [$now, $to])
		->get()
		->sum('total');

		echo "
		<table id='datatables' class='table table-hover table-bordered'>
		<thead>
		<tr>
		<th>#</th>
		<th>Tanggal / Waktu</th>
		<th>Operator</th>
		<th>Nomor Kamar</th>
		<th>Produk / Layanan</th>
		<th>Harga Satuan</th>
		<th>Jumlah</th>
		<th>Total</th>
		</tr>
		</thead>
		<tbody>
		";
		$no = 1;
		foreach ($data as $k) {
			echo "
			<tr>
			<td>".$no++."</td>
			<td>".$k->tanggal." - ".$k->waktu."</td>
			<td>".$k->nama."</td>
			<td>".$k->nomor_kamar."</td>
			<td>".$k->nama_layanan."</td>
			<td>Rp. ".number_format($k->harga_layanan, 2, ',', '.')."</td>
			<td>".$k->jumlah." ".$k->satuan."</td>
			<td>Rp. ".number_format($k->total, 2, ',', '.')."</td>
			</tr>
			";
		}

		echo "
		</tbody>
		</table>

		<h2>Total Pendapatan : <strong> Rp. ".number_format($total, 2, ',', '.')." </strong></h2>
		";
	}
}
