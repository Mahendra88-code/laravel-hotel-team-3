@extends('master')
@section('active-room', 'active')
@section('show-room', 'active')
@section('active-pesanlayanan','active')
@section('title-navbar','Room Services')
@section('title','PESAN LAYANAN / PRODUK')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">book</i>
					</div>
					<h4 class="card-title">Pesan Layanan / Produk</h4>
				</div>
				<div class="card-body ">
					<div class="row">
						@foreach($transaksi as $a)
						<div class="col-md-3">
							<div class="card card-chart">
								<div class="card-header card-header-info" data-header-animation="true">
									<div class="ct-chart text-center"> No Kamar<h1> <strong> {{ $a->nomor_kamar }} </strong> </h1> </div>
								</div>
								<div class="card-body">
									<div class="card-actions">
										<input type='text' name='id_transaksi_kamar' id='id_transaksi_kamar' value='{{ $a->id_transaksi_kamar }}' hidden>
										<button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Pesan Layanan" data-toggle="modal" data-target="#pesanLayanan" onclick="get_kamar({{ $a->id_kamar }})">
											<i class="material-icons">add</i>
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

<div class="modal fade" id="pesanLayanan" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-info text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Pesan Layanan</h4>
					</div>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 text-center">
								<h4>
									Pesanan Kamar : 
									<strong class="font-weight-bold" id="nomorkamar">  </strong>
									<strong class="font-weight-bold" id="namatamu">  </strong>
								</h4>
							</div>
							@foreach($kategori as  $k)
							<div class="col-md-4">
								<button class="btn btn-info w-100 btn-lg" data-toggle="modal" data-target="#pesanLayanann" onclick="list_pesan({{ $k->id_layanan_kategori }})">
									{{ $k->nama_layanan_kategori }}
								</button>
							</div> 
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="pesanLayanann" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-info text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Pesan Layanan</h4>
					</div>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div id="datass">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function get_kamar(id) {
		$.ajax({
			url : "{{route('get_pesanlayanan')}}",
			method : "GET",
			data : {
				id : id
			} ,
			success : function(data){
				$('#nomorkamar').text(data[0].nomor_kamar + ' - '),
				$('#namatamu').text(data[0].prefix + '. ' + data[0].nama_depan + ' ' + data[0].nama_belakang)
			}
		});
	}

	function list_pesan(id) {
		$.ajax({
			url : "{{route('list_pesanan')}}",
			method : 'get',
			dataType :'html',
			data: {
				id : id
			},
			success:function(data) {
				$('#datatables').DataTable();
				$('#datass').html(data);
				$('#datatables').DataTable('refresh');
			}
		})
	}

	function pesan() {
		$layanan = $('#id_layanan').val();
		$transaksi = $('#id_transaksi_kamar').val();
		$jumlah = $('#jumlah_pesanan').val();
		$harga = $('#harga_layanan').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('pesan')}}",
			//processData: false,
			//contentType : false,
			data: {
				id_layanan : $layanan,
				jumlah :  $jumlah,
				harga : $harga,
				id_transaksi_kamar : $transaksi
			},
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$.notify({
						icon: "notification_important",
						message: "Berhasil Memesan Layanan / Produk"

					}, {
						type: "success",
						timer: 3000,
						placement: {
							from: "top",
							align: "center"
						}
					});
					$('#jumlah_pesanan').val("");
				}else {
					$.notify({
						icon: "notification_important",
						message: "Gagal Memesan Layanan / Produk"

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
				$.notify(data, "error");
			}
		})
	}
</script>
@endsection