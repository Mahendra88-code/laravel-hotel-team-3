@extends('master')
@section('active-kamar', 'active')
@section('show-kamar', 'active')
@section('active-tkamar','active')
@section('title-navbar','Kamar')
@section('title','TIPE KAMAR')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-bed"></i>
					</div>
					<h4 class="card-title">Tipe Kamar</h4>
					<button class="btn btn-success float-right" data-toggle="modal" data-target="#addTipe"> <i class="material-icons">add</i> Tambah Tipe </button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-hover table-bordered table-striped">
						<thead>
							<tr>
								<th hidden></th>
								<th>Tipe Kamar</th>
								<th>Harga Per-Malam</th>
								<th>Harga Per-Orang</th>
								<th>Keterangan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tkamar as $val)
							<tr>
								<td hidden></td>
								<td>{{ $val->nama_kamar_tipe }}</td>
								<td>Rp. {{ number_format($val->harga_malam, 2, ',', '.') }}</td>
								<td>Rp. {{ number_format($val->harga_orang, 2, ',', '.') }}</td>
								<td>{{ $val->keterangan }}</td>
								<td>
									<button onclick="get_tipe({{ $val->id_kamar_tipe }})" class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update Tipe Kamar" data-toggle="modal" data-target="#editTipe">
										<i class='material-icons'>edit</i>
									</button>
									<button onclick="delete_tipe({{ $val->id_kamar_tipe }})" class='btn btn-danger btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Delete Tipe Kamar">
										<i class='material-icons'>delete</i>
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

<div class="modal fade" id="addTipe" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Tambah Tipe Kamar</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="save_tipe">
						<div class="card-body">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">bookmark</i></div>
									</div>
									<input name="nama_tipe_kamar" id="nama_tipe_kamar" type="text" class="form-control" placeholder="Nama Tipe Kamar..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">attach_money</i></div>
									</div>
									<input name="hargapermalam" id="hargapermalam" type="number" class="form-control" placeholder="Harga / Malam..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">attach_money</i></div>
									</div>
									<input name="hargaperorang" id="hargaperorang" type="number" class="form-control" placeholder="Harga / Orang..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">assignment</i></div>
									</div>
									<textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan..." rows="3"></textarea>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="save_tipe()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editTipe" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Edit Tipe Kamar</h4>                    
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
										<div class="input-group-text"><i class="material-icons">bookmark</i></div>
									</div>
									<input name="nama_tipe_kamar_edit" id="nama_tipe_kamar_edit" type="text" class="form-control" placeholder="Nama Tipe Kamar..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">attach_money</i></div>
									</div>
									<input name="hargapermalam_edit" id="hargapermalam_edit" type="number" class="form-control" placeholder="Harga / Malam..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">attach_money</i></div>
									</div>
									<input name="hargaperorang_edit" id="hargaperorang_edit" type="number" class="form-control" placeholder="Harga / Orang..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">assignment</i></div>
									</div>
									<textarea id="keterangan_edit" name="keterangan_edit" class="form-control" placeholder="Keterangan..." rows="3"></textarea>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_tipe()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	function save_tipe() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('save_tipe')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_tipe')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#addTipe').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Tambah Tipe Kamar Baru"

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
					$('#addTipe').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Tambah Tipe Kamar Baru"

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
				$('#addTipe').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function get_tipe(id){
		console.log(id);
		$.ajax({
			url : "{{route('get_tipe')}}",
			method : "GET",
			data : {
				uid : id
			} ,
			success : function(data){
				$('#id_edit').val(data[0].id_kamar_tipe),
				$('#nama_tipe_kamar_edit').val(data[0].nama_kamar_tipe),
				$('#hargapermalam_edit').val(data[0].harga_malam),
				$('#hargaperorang_edit').val(data[0].harga_orang),
				$('#keterangan_edit').val(data[0].keterangan)
			}
		});
	}

	function edit_tipe() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('edit_tipe')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_kamar')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#editTipe').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit Tipe Kamar"

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
					$('#editTipe').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Edit Tipe Kamar"

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
				$('#editTipe').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function delete_tipe(id) {
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
					url: "{{route('delete_tipe')}}",
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