<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransaksiKamarController extends Controller
{
	public function view() 
	{
		return view('pages.transaksikamar');
	}

	public function getTKamar(Request $req)
	{		
		$now = date("Y-m-d", strtotime($req->get('dari_tanggal')));
		$to = date("Y-m-d", strtotime($req->get('sampai_tanggal')));

		$data = DB::table('transaksi_kamar')
		->whereBetween('tanggal', [$now, $to])
		->get();

		$total=DB::table('transaksi_kamar')
		->whereBetween('tanggal', [$now, $to])
		->get()
		->sum('total_biaya_kamar');

		echo "
		<table id='datatables' class='table table-hover table-bordered table-striped'>
		<thead>
		<tr>
		<th>#</th>
		<th>Tanggal Transaksi</th>
		<th>Nomor Invoice</th>
		<th>Total Biaya</th>
		</tr>
		</thead>
		<tbody>
		";
		$no = 1;
		foreach ($data as $k) {
			echo "
			<tr>
			<td>".$no++."</td>
			<td>".$k->tanggal."</td>
			<td>".$k->nomor_invoice."</td>
			<td>Rp. ".number_format($k->total_biaya_kamar, 2, ',', '.') ."</td>
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
