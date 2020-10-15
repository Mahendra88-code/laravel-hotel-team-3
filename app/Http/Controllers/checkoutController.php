<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class checkoutController extends Controller
{
    public function view()
    {
        $kamar = DB::table('kamar')
        ->orderBy('nomor_kamar', 'asc')
        ->where('status_kamar', 'TERPAKAI')
        ->get();

        return view('pages.checkout', [
            'kamar' => $kamar
        ]);
    }

    public function readCheckout(Request $req)
    {
        $id = $req->get('id');

        $sub = DB::table('transaksi_kamar')
        ->join('transaksi_layanan', 'transaksi_layanan.id_transaksi_kamar', 'transaksi_kamar.id_transaksi_kamar')
        ->where('id_kamar', $id)
        ->where('status', 'CHECK IN')
        ->get()
        ->sum('total');

        //dd($sub);

        if ($sub == 0) {
            $data = DB::table('transaksi_kamar')
            ->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
            ->join('tamu', 'tamu.id_tamu', '=', 'transaksi_kamar.id_tamu')
            ->join('kamar_tipe', 'kamar_tipe.id_kamar_tipe', '=', 'kamar.id_kamar_tipe')
            ->where('transaksi_kamar.id_kamar', $id)
            ->where('status', 'CHECK IN')
            ->get();
            $checkin = date_create($data[0]->tanggal_checkin);
            $checkout = date_create($data[0]->tanggal_checkout);
            $durasi = date_diff($checkin,$checkout)->format('%a');
            $subtotal_kamar = $durasi * $data[0]->harga_malam;
            $ppnn = $subtotal_kamar * 0.10;
            $grand_totall = $subtotal_kamar + $ppnn - $data[0]->deposit;
            echo "
            <input type='text' name='id_kamar' id='id_kamar' hidden='hidden' value='". $data[0]->id_kamar ."'>
            <input type='text' name='id_transaksi_kamar' id='id_transaksi_kamar' hidden='hidden' value='". $data[0]->id_transaksi_kamar ."'>
            <div class='card-body'>
            <div class='row'>
            <div class='col-lg-12'>
            <h4 class='text-center'>
            Kamar Nomor : <strong class='font-weight-bold'> ". $data[0]->nomor_kamar ." </strong>
            </h4>
            </div>
            <div class='col-lg-6'>
            <div class='card bg-info'>
            <div class='card-body text-white'>
            <h4 class='mt-2 ml-2'> <strong class='font-weight-bold'> ". $data[0]->nama_kamar_tipe ." </strong> </h4>
            <p>
            <h5 class='ml-2'> 
            Harga / Malam : <label class='text-white font-weight-bold'> ". number_format($data[0]->harga_malam, 2, ',', '.') ." </label> <br>
            Maximal Orang Dewasa : <label class='text-white font-weight-bold'> ". $data[0]->max_dewasa ." </label> <br>
            Maximal Anak-Anak : <label class='text-white font-weight-bold'> ". $data[0]->max_anak ." </label> <br> 
            </h5>
            </p>
            </div>
            </div>
            </div>
            <div class='col-lg-6 mt-4'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>book</i></div>
            </div>
            <input name='invoice' id='invoice' type='text' class='form-control' placeholder='Invoice...' required=' autocomplete='off' readonly value='". $data[0]->nomor_invoice ."'>
            </div>
            </div>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>assignment</i></div>
            </div>
            <select name='select_tamu' id='select_tamu' class='selectpicker w-75' data-live-search='true' data-style='btn btn-danger' title='Tamu' disabled>
            <option value='". $data[0]->id_tamu ."' selected >". $data[0]->prefix.'. '.$data[0]->nama_depan.' '.$data[0]->nama_belakang ."</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>people</i></div>
            </div>
            <select name='select_dewasa' id='select_dewasa' class='selectpicker w-75' data-style='btn btn-danger' title='Max Dewasa' disabled>
            <option value='". $data[0]->max_dewasa ."' selected>". $data[0]->max_dewasa ." Orang</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>people</i></div>
            </div>
            <select name='select_anak' id='select_anak' class='selectpicker w-75' data-style='btn btn-danger' title='Max Anak' disabled>
            <option value='". $data[0]->max_anak ."' selected>". $data[0]->max_anak ." Orang</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control' name='tanggal_checkin' value='". $data[0]->tanggal_checkin ."' readonly />
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control' name='waktu_checkin' value='". $data[0]->waktu_checkin ."' readonly />
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control datepicker' name='tanggal_checkout' id='tanggal_checkout' placeholder='Tanggal Check Out...' value='". $data[0]->tanggal_checkout ."'/>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control timepicker' name='waktu_checkout' id='waktu_checkout' placeholder='Waktu Check Out...' value='". $data[0]->waktu_checkout ."'/>
            </div>
            </div>
            </div>
            <div class='col-lg-12'>
            <h4 class='text-center mt-3'> Rincian Tagihan </h4>
            </div>
            <div class='col-lg-12'>
            <table class='table table-striped table-hovered table-bordered' id='datatables'>
            <thead>
            <tr>
            <th> Ketentuan Layanan / Produk </th>
            <th> Harga </th>
            <th> Qty </th>
            <th> Total </th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td> Room reserved type : ". $data[0]->nama_kamar_tipe ." ROOM </td>
            <td> Rp. ". number_format($data[0]->harga_malam, 2, ',', '.') ." </td>
            <td> ". $durasi ." malam </td>
            <td>Rp. ". number_format($subtotal_kamar, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td rowspan='4'>  </td>
            <td colspan='2'> <strong> Sub-Total </strong> </td>
            <td>Rp. ". number_format($subtotal_kamar, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> PPn-10% </td>
            <td>Rp. ". number_format($ppnn, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> Jumlah Deposit </td>
            <td>Rp. ". number_format($data[0]->deposit, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> <strong> Grand Total </strong> </td>
            <td> Rp. ". number_format($grand_totall, 2, ',', '.') ." </td>
            </tr>
            ";
            echo "
            </tbody>
            </table>
            </div>
            </div>
            </div>
            ";
        } else {
            $data = DB::table('transaksi_kamar')
            ->join('kamar', 'kamar.id_kamar', '=', 'transaksi_kamar.id_kamar')
            ->join('tamu', 'tamu.id_tamu', '=', 'transaksi_kamar.id_tamu')
            ->join('transaksi_layanan', 'transaksi_layanan.id_transaksi_kamar', 'transaksi_kamar.id_transaksi_kamar')
            ->join('layanan', 'layanan.id_layanan', '=', 'transaksi_layanan.id_layanan')
            ->join('kamar_tipe', 'kamar_tipe.id_kamar_tipe', '=', 'kamar.id_kamar_tipe')
            ->where('transaksi_kamar.id_kamar', $id)
            ->where('status', 'CHECK IN')
            ->get();
            $checkin = date_create($data[0]->tanggal_checkin);
            $checkout = date_create($data[0]->tanggal_checkout);
            $durasi = date_diff($checkin,$checkout)->format('%a');
            $subtotal_kamar = $durasi * $data[0]->harga_malam;
            $subtotal = $subtotal_kamar + $sub;
            $ppn = $subtotal * 0.10;
            $grand_total = $subtotal + $ppn - $data[0]->deposit;
            echo "
            <input type='text' name='id_kamar' id='id_kamar' hidden='hidden' value='". $data[0]->id_kamar ."'>
            <input type='text' name='id_transaksi_kamar' id='id_transaksi_kamar' hidden='hidden' value='". $data[0]->id_transaksi_kamar ."'>
            <div class='card-body'>
            <div class='row'>
            <div class='col-lg-12'>
            <h4 class='text-center'>
            Kamar Nomor : <strong class='font-weight-bold'> ". $data[0]->nomor_kamar ." </strong>
            </h4>
            </div>
            <div class='col-lg-6'>
            <div class='card bg-info'>
            <div class='card-body text-white'>
            <h4 class='mt-2 ml-2'> <strong class='font-weight-bold'> ". $data[0]->nama_kamar_tipe ." </strong> </h4>
            <p>
            <h5 class='ml-2'> 
            Harga / Malam : <label class='text-white font-weight-bold'> ". number_format($data[0]->harga_malam, 2, ',', '.') ." </label> <br>
            Maximal Orang Dewasa : <label class='text-white font-weight-bold'> ". $data[0]->max_dewasa ." </label> <br>
            Maximal Anak-Anak : <label class='text-white font-weight-bold'> ". $data[0]->max_anak ." </label> <br> 
            </h5>
            </p>
            </div>
            </div>
            </div>
            <div class='col-lg-6 mt-4'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>book</i></div>
            </div>
            <input name='invoice' id='invoice' type='text' class='form-control' placeholder='Invoice...' required=' autocomplete='off' readonly value='". $data[0]->nomor_invoice ."'>
            </div>
            </div>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>assignment</i></div>
            </div>
            <select name='select_tamu' id='select_tamu' class='selectpicker w-75' data-live-search='true' data-style='btn btn-danger' title='Tamu' disabled>
            <option value='". $data[0]->id_tamu ."' selected >". $data[0]->prefix.'. '.$data[0]->nama_depan.' '.$data[0]->nama_belakang ."</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>people</i></div>
            </div>
            <select name='select_dewasa' id='select_dewasa' class='selectpicker w-75' data-style='btn btn-danger' title='Max Dewasa' disabled>
            <option value='". $data[0]->max_dewasa ."' selected>". $data[0]->max_dewasa ." Orang</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>people</i></div>
            </div>
            <select name='select_anak' id='select_anak' class='selectpicker w-75' data-style='btn btn-danger' title='Max Anak' disabled>
            <option value='". $data[0]->max_anak ."' selected>". $data[0]->max_anak ." Orang</option>
            </select>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control' name='tanggal_checkin' value='". $data[0]->tanggal_checkin ."' readonly />
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control' name='waktu_checkin' value='". $data[0]->waktu_checkin ."' readonly />
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control datepicker' name='tanggal_checkout' id='tanggal_checkout' placeholder='Tanggal Check Out...' value='". $data[0]->tanggal_checkout ."'/>
            </div>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class='form-group bmd-form-group'>
            <div class='input-group'>
            <div class='input-group-prepend'>
            <div class='input-group-text'><i class='material-icons'>date_range</i></div>
            </div>
            <input class='form-control timepicker' name='waktu_checkout' id='waktu_checkout' placeholder='Waktu Check Out...' value='". $data[0]->waktu_checkout ."'/>
            </div>
            </div>
            </div>
            <div class='col-lg-12'>
            <h4 class='text-center mt-3'> Rincian Tagihan </h4>
            </div>
            <div class='col-lg-12'>
            <table class='table table-striped table-hovered table-bordered' id='datatables'>
            <thead>
            <tr>
            <th> Ketentuan Layanan / Produk </th>
            <th> Harga </th>
            <th> Qty </th>
            <th> Total </th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td> Room reserved type : ". $data[0]->nama_kamar_tipe ." ROOM </td>
            <td> Rp. ". number_format($data[0]->harga_malam, 2, ',', '.') ." </td>
            <td> ". $durasi ." malam </td>
            <td>Rp. ". number_format($subtotal_kamar, 2, ',', '.') ." </td>
            </tr>
            ";

            foreach ($data as $d) {
                echo "
                <tr>
                <td> ". $d->nama_layanan ." </td>
                <td> ". number_format($d->harga_layanan, 2, ',', '.') ." </td>
                <td> ". $d->jumlah.' '.$d->satuan ." </td>
                <td>Rp. ". number_format($d->total, 2, ',', '.') ." </td>
                </tr>
                ";
            }
            echo "
            <tr>
            <td rowspan='4'>  </td>
            <td colspan='2'> <strong> Sub-Total </strong> </td>
            <td>Rp. ". number_format($subtotal, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> PPn-10% </td>
            <td>Rp. ". number_format($ppn, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> Jumlah Deposit </td>
            <td>Rp. ". number_format($data[0]->deposit, 2, ',', '.') ." </td>
            </tr>
            <tr>
            <td colspan='2'> <strong> Grand Total </strong> </td>
            <td> Rp. ". number_format($grand_total, 2, ',', '.') ." </td>
            </tr>
            ";
            echo "
            </tbody>
            </table>
            </div>
            </div>
            </div>
            ";
        }
    }

    public function updateCheckout(Request $req)
    {
        $id_kamar = $req->get('kamar');
        $id_transaksi = $req->get('transaksi');
        
        $update = DB::table('transaksi_kamar')
        ->where('id_transaksi_kamar', $id_transaksi)
        ->update([
            'status' => 'CHECK OUT'
        ]);

        $updates = DB::table('kamar')
        ->where('id_kamar', $id_kamar)
        ->update([
            'status_kamar' => 'KOTOR'
        ]);

        if ($update && $updates) {
            return 'sukses';
        } else  {
            return 'error';
        }
    }
}
