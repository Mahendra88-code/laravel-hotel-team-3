@extends('master')
@section('active-check', 'active')
@section('show-check', 'active')
@section('active-checkout','active')
@section('title-navbar','Check In / Out')
@section('title','CHECK OUT')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-danger card-header-icon">
					<div class="card-icon">
						<i class="fa fa-key"></i>
					</div>
					<h4 class="card-title">Check Out</h4>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach($kamar as $a)
						<div class="col-md-3">
							<div class="card card-chart">
								<div class="card-header card-header-danger" data-header-animation="true">
									<div class="ct-chart text-center"> No Kamar <h1> <strong> {{ $a->nomor_kamar }} </strong> </h1> </div>
								</div>
								<div class="card-body">
									<div class="card-actions">
										<button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Check Out" data-toggle="modal" data-target="#checkOut" onclick="get_checkout({{ $a->id_kamar }})">
											<i class="material-icons">logout</i>
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

<div class="modal fade" id="checkOut" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-danger text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Check Out</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="checkout">
						<div id="datass">
							
						</div>
					</div>
					<div class="modal-footer justify-content-center">
						<a  onclick="update()" class="btn btn-danger btn-link btn-wd btn-lg">Check out</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function get_checkout(id) {
		$.ajax({
			url : "{{route('read_checkout')}}",
			method : 'get',
			dataType :'html',
			data: {
				id : id
			},
			success:function(data) {
				console.log(data);
				$('#datatables').DataTable();
				$('.selectpicker').selectpicker();
				$('#datass').html(data);
				$('.selectpicker').selectpicker('refresh');
				$('#datatables').DataTable('refresh');
			}
		})
	}

	function update() {
		$kamar = $('#id_kamar').val();
		$transaksi = $('#id_transaksi_kamar').val();
		console.log($kamar);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('update_checkout')}}",
			//processData: false,
			//contentType : false,
			data: {
				kamar : $kamar,
				transaksi : $transaksi
			},
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#checkOut').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil untuk Check Out"

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
					$('#checkOut').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal untuk Check Out"

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
				$('#checkOut').modal('hide');
				$.notify(data, "error");
			}
		})
	}
</script>
@endsection