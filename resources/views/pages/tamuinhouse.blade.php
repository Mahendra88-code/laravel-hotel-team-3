@extends('master')
@section('active-check', 'active')
@section('show-check', 'active')
@section('active-tamuinhouse','active')
@section('title-navbar','Check In / Out')
@section('title','TAMU IN HOUSE')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-key"></i>
					</div>
					<h4 class="card-title">Tamu In House</h4>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th hidden></th>
								<th> # Kamar </th>
								<th> Nama Tamu </th>
								<th> Tanggal Check In </th>
								<th> Tanggal Check Out </th>
								<th> Jumlah Deposit </th>
								<th width="10%"> Action </th>
							</tr>
						</thead>
						<tbody>
							@foreach($tamuih as $t)
							<tr>
								<td hidden> </td>
								<td> {{ $t->nomor_kamar }} </td>
								<td> {{ $t->prefix . '. ' . $t->nama_depan . ' ' . $t->nama_belakang }} </td>
								<td> {{ $t->tanggal_checkin }} </td>
								<td> {{ $t->tanggal_checkout }} </td>
								<td>Rp. {{ number_format($t->deposit, 2, ',', '.') }} </td>
								<td>
									<button type="button" class="btn btn-sm btn-info btn-round" data-toggle="modal" data-target="#checkIn" onclick="get_checkin({{ $t->id_transaksi_kamar }})">
										<i class="material-icons">create</i> &nbsp; Update
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="checkIn" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Check In</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_checkin">
						<div class="card-body">
							<input type="text" name="id_user" id="id_user" hidden="hidden" value="{{ session('id') }}">
							<input type="text" name="id_kamar" id="id_kamar" hidden="hidden">
							<input type="text" name="id_transaksi" id="id_transaksi" hidden="hidden">
							<div class="row">
								<div class="col-lg-12 text-center">
									<h3> Nomor Kamar : 
										<strong id="nomork" class="font-weight-bold">  </strong> 
									</h3>
								</div>	
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">book</i></div>
											</div>
											<input name="invoice" id="invoice" type="text" class="form-control" placeholder="Invoice..." required="" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">assignment</i></div>
											</div>
											<select name="select_tamu" id="select_tamu" class="selectpicker w-75" data-live-search="true" data-style="btn btn-success" title="Tamu">
												@foreach($tamu as $t)
												<option value="{{ $t->id_tamu }}">{{ $t->prefix .'. '. $t->nama_depan .' '. $t->nama_belakang  }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="card bg-info">
										<div class="card-body text-white">
											<h4 class="mt-2 ml-2"> <strong id="tipe_kamar" class="font-weight-bold">  </strong> </h4>
											<p>
												<h5 class="ml-2"> 
													Harga / Malam : <strong class="text-white font-weight-bold" id="harga">  </strong> <br>
													Maximal Orang Dewasa : <strong class="text-white font-weight-bold" id="max_dewasa">  </strong> <br>
													Maximal Anak-Anak : <strong class="text-white font-weight-bold" id="max_anak">  </strong> <br> 
												</h5>
											</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="card bg-dark">
										<div class="card-body">
											<p class="ml-2 mt-2">
												<a href="{{ route('tamu') }}" class="text-white"> <u> Klik Disini</u> </a> Jika nama tamu yang dimaksud tidak ditemukan untuk ditambah pada daftar buku tamu. 
											</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">people</i></div>
											</div>
											<select name="select_dewasa" id="select_dewasa" class="selectpicker w-75" data-style="btn btn-success" title="Jumlah Dewasa">
												<option value="1">1 Orang</option>
												<option value="2">2 Orang</option>
												<option value="3">3 Orang</option>
												<option value="4">4 Orang</option>
												<option value="5">5 Orang</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">people</i></div>
											</div>
											<select name="select_anak" id="select_anak" class="selectpicker w-75" data-style="btn btn-success" title="Jumlah Anak-Anak">
												<option value="1">1 Orang</option>
												<option value="2">2 Orang</option>
												<option value="3">3 Orang</option>
												<option value="4">4 Orang</option>
												<option value="5">5 Orang</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">date_range</i></div>
											</div>
											<input class="form-control datepicker" name="tanggal_checkin" id="tanggal_checkin" placeholder="Tangggal Check In..." />
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">date_range</i></div>
											</div>
											<input class="form-control timepicker" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Check In..." />
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">date_range</i></div>
											</div>
											<input class="form-control datepicker" name="tanggal_checkout" id="tanggal_checkout" placeholder="Tanggal Check Out..." />
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">date_range</i></div>
											</div>
											<input class="form-control timepicker" name="waktu_checkout" id="waktu_checkout" placeholder="Waktu Check Out..." />
										</div>
									</div>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">money</i></div>
									</div>
									<input class="form-control" type="number" name="jumlah_deposit" id="jumlah_deposit" placeholder="Jumlah Deposit (Rp)..." />
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="update_checkin()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function get_checkin(id) {
		$.ajax({
			url : "{{route('read_tamuinhouse')}}",
			method : "GET",
			data : {
				id : id
			} ,
			success : function(data){
				var bilangan = data[0].harga_malam;
				var	reverse = bilangan.toString().split('').reverse().join('');
				var ribuan 	= reverse.match(/\d{1,3}/g);
				var ribuan	= ribuan.join('.').split('').reverse().join('');
				$('#id_kamar').val(data[0].id_kamar),
				$('#id_transaksi').val(data[0].id_transaksi_kamar),
				$('#invoice').val(data[0].nomor_invoice),
				$('#select_tamu').selectpicker('val', data[0].id_tamu),
				$('#select_anak').selectpicker('val', data[0].jumlah_anak),
				$('#select_dewasa').selectpicker('val', data[0].jumlah_dewasa),
				$('#tanggal_checkin').val(data[0].tanggal_checkin),
				$('#tanggal_checkout').val(data[0].tanggal_checkout),
				$('#waktu_checkin').val(data[0].waktu_checkin),
				$('#waktu_checkout').val(data[0].waktu_checkout),
				$('#jumlah_deposit').val(data[0].deposit),
				$('#nomork').text(data[0].nomor_kamar),
				$('#tipe_kamar').text(data[0].nama_kamar_tipe),
				$('#harga').text("Rp. " + ribuan),
				$('#max_dewasa').text(data[0].max_dewasa + " Orang"),
				$('#max_anak').text(data[0].max_anak + " Orang")
			}
		});	
	}

	function update_checkin(id) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('update_tamuinhouse')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_checkin')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#checkIn').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit Tramsaksi Kamar"

					}, {
						type: "success",
						timer: 3000,
						placement: {
							from: "top",
							align: "center"
						}
					});
					location.reload();
				}else{
					$('#checkIn').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Edit Transaksi Kamar"

					}, {
						type: "danger",
						timer: 3000,
						placement: {
							from: "top",
							align: "center"
						}
					});
				}
			},
			error : function (data) {
				$('#checkIn').modal('hide');
				$.notify(data, "error");
			}
		})
	}

</script>
@endsection