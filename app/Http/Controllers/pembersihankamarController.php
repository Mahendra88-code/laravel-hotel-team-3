<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class pembersihankamarController extends Controller
{
	public function view()
	{
		$kotor = DB::table('kamar')
		->where('status_kamar', 'KOTOR')
		->get();

		$tipe = DB::table('kamar_tipe')
		->get();

		return view('pages.pembersihankamar', [
			'kotor' => $kotor,
			'tipe' => $tipe
		]);
	}
}
