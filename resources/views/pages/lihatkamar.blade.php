@extends('master')
@section('active-kamar', 'active')
@section('show-kamar', 'active')
@section('active-lkamar','active')
@section('title-navbar','Kamar')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-bed"></i>
					</div>
					<h4 class="card-title">Master Kamar</h4>
					<button class="btn btn-success float-right" data-toggle="modal" data-target="#addKamar"> 
						<i class="material-icons">add</i> Tambah Kamar 
					</button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th hidden></th>
								<th>NO. Kamar</th>
								<th>Tipe Kamar</th>
								<th>Harga Per-Malam</th>
								<th>Max. Dewasa</th>
								<th>Max. Anak-Anak</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						@foreach($kamar as $val)
						<tbody>
							<td hidden></td>
							<td>{{ $val->nomor_kamar }}</td>
							<td>{{ $val->nama_kamar_tipe }}</td>
							<td>Rp. {{ number_format($val->harga_malam, 2, ',', '.') }}</td>
							<td>{{ $val->max_dewasa }} Orang</td>
							<td>{{ $val->max_anak }} Orang</td>
							<td>{{ $val->status_kamar }}</td>
							<td>
								<button onclick="get_kamar({{ $val->id_kamar }})" class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update Kamar" data-toggle="modal" data-target="#editKamar">
									<i class='material-icons'>edit</i>
								</button>
								<button onclick="delete_kamar({{ $val->id_kamar }})" class='btn btn-danger btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Delete Kamar">
									<i class='material-icons'>delete</i>
								</button>
							</td>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addKamar" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Tambah Kamar</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="save_kamar">
						<div class="card-body">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">face</i></div>
									</div>
									<input name="nomor_kamar" id="nomor_kamar" type="number" class="form-control" placeholder="Nomor Kamar..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-bed"></i></div>
									</div>
									<select name="select_tipe" id="select_tipe" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Tipe Kamar">
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
									<select name="select_dewasa" id="select_dewasa" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Max Dewasa">
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
									<select name="select_anak" id="select_anak" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Max Anak-Anak">
										<option value="1">1 Orang</option>
										<option value="2">2 Orang</option>
										<option value="3">3 Orang</option>
										<option value="4">4 Orang</option>
										<option value="5">5 Orang</option>
									</select>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="save_kamar()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editKamar" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Edit Kamar</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_kamar">
						{{csrf_field()}}  
						<div class="card-body">
							<input type="hidden" name="id_edit" id="id_edit">
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
									<select name="select_tipe_edit" id="select_tipe_edit" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Tipe Kamar">
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
									<select name="select_dewasa_edit" id="select_dewasa_edit" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Max Dewasa">
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
									<select name="select_anak_edit" id="select_anak_edit" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Max Anak-Anak">
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
									<select name="select_status_edit" id="select_status_edit" class="selectpicker" data-live-search="true" data-style="btn btn-info" title="Status kamar">
										<option value="TERSEDIA">TERSEDIA</option>
										<option value="TERPAKAI">TERPAKAI</option>
										<option value="KOTOR">KOTOR</option>
									</select>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_kamar()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	function save_kamar() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('save_kamar')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_kamar')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#addKamar').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Tambah Kamar Baru"

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
					$('#addKamar').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Tambah Kamar Baru"

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
				$('#addKamar').modal('hide');
				$.notify(data, "error");
			}
		})
	}

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
					$('#editUser').modal('hide');
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
					$('#editUser').modal('hide');
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
				$('#editUser').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function delete_kamar(id) {
		Swal.fire({
			title: 'Are you sure?',
			text: 'You will Deleted!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, keep it',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-danger",
			buttonsStyling: false
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'get',
					url: "{{route('delete_kamar')}}",
					dataType: 'text',
					data: {
						uid: id,
					},
					success: function (data) {

						console.log(data);

						if (data == "sukses") {
							Swal.fire(
								'Deleted!',
								'Your imaginary file has been deleted.',
								'success'
								).then((result) => {
									if (result.value) {
										location.reload();
									}
								})
							}else{
								Swal.fire(
									'Cancelled',
									'Your imaginary file is safe :)',
									'error'
									)
							}

						}
					})
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal.fire(
					'Cancelled',
					'Your imaginary file is safe :)',
					'error'
					)
			}
		})
	} 
</script>
@endsection