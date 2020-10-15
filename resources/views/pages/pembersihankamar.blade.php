@extends('master')
@section('active-room', 'active')
@section('show-room', 'active')
@section('active-pembersihankamar','active')
@section('title-navbar','Room Services')
@section('title','PEMBERSIHAN KAMAR')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-warning card-header-icon">
					<div class="card-icon">
						<i class="material-icons">book</i>
					</div>
					<h4 class="card-title">Pembersihan Kamar</h4>
				</div>
				<div class="card-body ">
					<div class="row">
						@foreach($kotor as $a)
						<div class="col-md-3">
							<div class="card card-chart">
								<div class="card-header card-header-warning" data-header-animation="true">
									<div class="ct-chart text-center"> No Kamar <h1> <strong> {{ $a->nomor_kamar }} </strong> </h1> </div>
								</div>
								<div class="card-body">
									<div class="card-actions">
										<button  onclick="get_kamar({{ $a->id_kamar }})" type="button" class="btn btn-warning btn-link" rel="tooltip" data-placement="bottom" title="Pembersihan Kamar"  data-toggle="modal" data-target="#editKamar">
											<i class="material-icons">create</i>
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

<div class="modal fade" id="editKamar" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-warning text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Pembersihan Kamar</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_kamar">
						{{csrf_field()}}  
						<div class="card-body">
							<input type="text" hidden="hidden" name="id_edit" id="id_edit">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">face</i></div>
									</div>
									<input name="nomor_kamar_edit" id="nomor_kamar_edit" type="number" class="form-control" placeholder="Nomor Kamar..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-bed"></i></div>
									</div>
									<select name="select_tipe_edit" id="select_tipe_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-warning" title="Tipe Kamar">
										@foreach($tipe as $has)
										<option value="{{ $has->id_kamar_tipe }}">{{ $has->nama_kamar_tipe }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">people</i></div>
									</div>
									<select name="select_dewasa_edit" id="select_dewasa_edit" class="selectpicker w-75" data-style="btn btn-warning" title="Max Dewasa">
										<option value="1">1 Orang</option>
										<option value="2">2 Orang</option>
										<option value="3">3 Orang</option>
										<option value="4">4 Orang</option>
										<option value="5">5 Orang</option>
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">people</i></div>
									</div>
									<select name="select_anak_edit" id="select_anak_edit" class="selectpicker w-75" data-style="btn btn-warning" title="Max Anak-Anak">
										<option value="1">1 Orang</option>
										<option value="2">2 Orang</option>
										<option value="3">3 Orang</option>
										<option value="4">4 Orang</option>
										<option value="5">5 Orang</option>
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-bed"></i></div>
									</div>
									<select name="select_status_edit" id="select_status_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-warning" title="Status kamar">
										<option value="TERSEDIA">TERSEDIA</option>
										<option value="TERPAKAI">TERPAKAI</option>
										<option value="KOTOR">KOTOR</option>
									</select>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_kamar()" class="btn btn-warning btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function get_kamar(id){
		console.log(id);
		$.ajax({
			url : "{{route('get_kamar')}}",
			method : "GET",
			data : {
				uid : id
			} ,
			success : function(data){
				$('#id_edit').val(data[0].id_kamar),
				$('#nomor_kamar_edit').val(data[0].nomor_kamar),
				$('#select_tipe_edit').selectpicker('val', data[0].id_kamar_tipe),
				$('#select_dewasa_edit').selectpicker('val', data[0].max_dewasa),
				$('#select_status_edit').selectpicker('val', data[0].status_kamar),
				$('#select_anak_edit').selectpicker('val', data[0].max_anak)
			}
		});
	}

	function edit_kamar() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('edit_kamar')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_kamar')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#editKamar').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit Kamar"

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
					$('#editKamar').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Edit Kamar"

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
				$('#editKamar').modal('hide');
				$.notify(data, "error");
			}
		})
	}
</script>
@endsection