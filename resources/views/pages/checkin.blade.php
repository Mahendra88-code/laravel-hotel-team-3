@extends('master')
@section('active-check', 'active')
@section('show-check', 'active')
@section('active-checkin','active')
@section('title-navbar','Check In / Out')
@section('title','CHECK IN')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-key"></i>
					</div>
					<h4 class="card-title">Check In</h4>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($kamar as $a)
						<div class="col-md-3">
							<div class="card card-chart">
								<div class="card-header card-header-success" data-header-animation="true">
									<div class="ct-chart text-center"> No Kamar<h1> <strong> {{ $a->nomor_kamar }} </strong> </h1> </div>
								</div>
								<div class="card-body">
									<div class="card-actions">
										<button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Check In" data-toggle="modal" data-target="#checkIn" onclick="get_id_kamar({{ $a->id_kamar }})">
											<i class="material-icons">login</i>
										</button>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
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
					<form class="form" method="post" id="save_checkin">
						<div class="card-body">
							<input type="text" name="id_user" id="id_user" hidden="hidden" value="{{ session('id') }}">
							<input type="text" name="id_kamar" id="id_kamar" hidden="hidden">
							<input type="text" name="hargaper" id="hargaper" hidden="hidden">
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
											<?php  
											$nomor_invoice='INV-'.date('Ymd').'-'.(rand(10,100));
											?>
											<input name="invoice" id="invoice" type="text" class="form-control" placeholder="Invoice..." required="" autocomplete="off" value="<?php echo $nomor_invoice; ?>">
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
											<select name="select_dewasa" id="select_dewasa" class="selectpicker w-75" data-style="btn btn-success" title="Max Dewasa">
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
											<select name="select_anak" id="select_anak" class="selectpicker w-75" data-style="btn btn-success" title="Max Anak-Anak">
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
											<input class="form-control" name="tanggal_checkin" value="<?php echo date('Y-m-d'); ?>" readonly />
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">date_range</i></div>
											</div>
											<input class="form-control" name="waktu_checkin" value="<?php echo date('H:i'); ?>" readonly />
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
									<input class="form-control datepicer" type="number" name="jumlah_deposit" id="jumlah_deposit" placeholder="Jumlah Deposit (Rp)..." />
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="checkin()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection
@section('js')
<script>
	function get_id_kamar(id) {
		$.ajax({
			url : "{{route('read_checkin')}}",
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
				$('#hargaper').val(data[0].harga_malam),
				$('#nomork').text(data[0].nomor_kamar),
				$('#tipe_kamar').text(data[0].nama_kamar_tipe),
				$('#harga').text("Rp. " + ribuan),
				$('#max_dewasa').text(data[0].max_dewasa + " Orang"),
				$('#max_anak').text(data[0].max_anak + " Orang")
			}
		});	
	}

	function checkin() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('create_checkin')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_checkin')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#checkIn').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Check In"

					}, {
						type: "success",
						timer: 3000,
						placement: {
							from: "top",
							align: "center"
						}
					});
					location.reload();
				}else {
					$('#checkIn').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Check In"

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
		});
	}
</script>
@endsection