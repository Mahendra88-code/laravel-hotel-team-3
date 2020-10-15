@extends('master')
@section('active-tamu','active')
@section('title-navbar','Buku Tamu')
@section('title','BUKU TAMU')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">work</i>
					</div>
					<h4 class="card-title">Buku Tamu</h4>
					<button class="btn btn-success float-right" data-toggle="modal" data-target="#addTamu"> 
						<i class="material-icons">add</i> Tambah Tamu 
					</button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th hidden></th>
								<th>Nama Tamu</th>
								<th>Warga Negara</th>
								<th>Nomor Telp / Handphone</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tamu as $val)
							<tr>
								<td hidden></td>
								<td>{{ $val->prefix .'. '. $val->nama_depan .' '. $val->nama_belakang }}</td>
								<td>{{ $val->warga_negara }}</td>
								<td>{{ $val->nomor_telp }}</td>
								<td>{{ $val->email }}</td>
								<td>
									<button onclick="get_tamu({{ $val->id_tamu }})" class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update Tamu" data-toggle="modal" data-target="#editTamu">
										<i class='material-icons'>edit</i>
									</button>
									<button onclick="delete_tamu({{ $val->id_tamu }})" class='btn btn-danger btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Delete Tamu">
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

<div class="modal fade" id="addTamu" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Tambah Tamu</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="save_tamu">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">face</i></div>
											</div>
											<select name="select_prefix" id="select_prefix" class="selectpicker w-75" data-live-search="true" data-style="btn btn-success" title="Prefix">
												<option value="Mr">Mr</option>
												<option value="Mrs">Mrs</option>
												<option value="Miss">Miss</option>
												<option value="Ms">Ms</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nama_depan" id="nama_depan" type="text" class="form-control" autocomplete="off" placeholder="Nama Depan..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nama_belakang" id="nama_belakang" type="text" class="form-control" autocomplete="off" placeholder="Nama Belakang..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">credit_card</i></div>
											</div>
											<select name="select_identitas" id="select_identitas" class="selectpicker w-75" data-live-search="true" data-style="btn btn-success" title="Identitas">
												<option value="KTP">KTP</option>
												<option value="SIM">SIM</option>
												<option value="PASPORT">PASPORT</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nomor_identitas" id="nomor_identitas" type="text" class="form-control" autocomplete="off" placeholder="Nomor Identitas..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">flag</i></div>
											</div>
											<input name="warga_negara" id="warga_negara" type="text" class="form-control" autocomplete="off" placeholder="Warga Negara..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">home</i></div>
											</div>
											<textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat..." rows="3"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">map</i></div>
											</div>
											<input name="kab_kota" id="kab_kota" type="text" class="form-control" autocomplete="off" placeholder="Kabupaten / Kota..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">map</i></div>
											</div>
											<input name="provinsi" id="provinsi" type="text" class="form-control" autocomplete="off" placeholder="Provinsi..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">phone</i></div>
											</div>
											<input name="no_telep" id="no_telep" type="text" class="form-control" autocomplete="off" placeholder="Nomor Telp / Handphone..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">email</i></div>
											</div>
											<input name="email" id="email" type="email" class="form-control" autocomplete="off" placeholder="Email..." required="">
										</div>
									</div>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="save_tamu()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editTamu" tabindex="-1" role="">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-info text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Edit Tamu</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_tamu">
						{{csrf_field()}}  
						<div class="card-body">
							<input type="text" hidden="hidden" name="id_edit" id="id_edit">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">face</i></div>
											</div>
											<select name="select_prefix_edit" id="select_prefix_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-info" title="Prefix">
												<option value="Mr">Mr</option>
												<option value="Mrs">Mrs</option>
												<option value="Miss">Miss</option>
												<option value="Ms">Ms</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nama_depan_edit" id="nama_depan_edit" type="text" class="form-control" autocomplete="off" placeholder="Nama Depan..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nama_belakang_edit" id="nama_belakang_edit" type="text" class="form-control" autocomplete="off" placeholder="Nama Belakang..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">credit_card</i></div>
											</div>
											<select name="select_identitas_edit" id="select_identitas_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-info" title="Identitas">
												<option value="KTP">KTP</option>
												<option value="SIM">SIM</option>
												<option value="PASPORT">PASPORT</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<input name="nomor_identitas_edit" id="nomor_identitas_edit" type="text" class="form-control" autocomplete="off" placeholder="Nomor Identitas..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">flag</i></div>
											</div>
											<input name="warga_negara_edit" id="warga_negara_edit" type="text" class="form-control" autocomplete="off" placeholder="Warga Negara..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">home</i></div>
											</div>
											<textarea class="form-control" name="alamat_edit" id="alamat_edit" placeholder="Alamat..." rows="3"></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">map</i></div>
											</div>
											<input name="kab_kota_edit" id="kab_kota_edit" type="text" class="form-control" autocomplete="off" placeholder="Kabupaten / Kota..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">map</i></div>
											</div>
											<input name="provinsi_edit" id="provinsi_edit" type="text" class="form-control" autocomplete="off" placeholder="Provinsi..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">phone</i></div>
											</div>
											<input name="no_telep_edit" id="no_telep_edit" type="text" class="form-control" autocomplete="off" placeholder="Nomor Telp / Handphone..." required="">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">email</i></div>
											</div>
											<input name="email_edit" id="email_edit" type="email" class="form-control" autocomplete="off" placeholder="Email..." required="">
										</div>
									</div>
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_tamu()" class="btn btn-info btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function save_tamu() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('create_tamu')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_tamu')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#addTamu').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Menambahkan Tamu Baru"

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
					$('#addTamu').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Menambahkan Tamu Baru"

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
				$('#addTamu').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function delete_tamu(id) {
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
					url: "{{route('delete_tamu')}}",
					dataType: 'text',
					data: {
						id: id,
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

	function get_tamu(id){
		console.log(id);
		$.ajax({
			url : "{{route('read_tamu')}}",
			method : "GET",
			data : {
				id : id
			} ,
			success : function(data){
				$('#id_edit').val(data[0].id_tamu),
				$('#select_prefix_edit').selectpicker('val', data[0].prefix),
				$('#nama_depan_edit').val(data[0].nama_depan),
				$('#nama_belakang_edit').val(data[0].nama_belakang),
				$('#select_identitas_edit').selectpicker('val', data[0].tipe_identitas),
				$('#nomor_identitas_edit').val(data[0].nomor_identitas),
				$('#warga_negara_edit').val(data[0].warga_negara),
				$('#alamat_edit').val(data[0].alamat_jalan),
				$('#kab_kota_edit').val(data[0].alamat_kabupaten),
				$('#provinsi_edit').val(data[0].alamat_provinsi),
				$('#no_telep_edit').val(data[0].nomor_telp),
				$('#email_edit').val(data[0].email)
			}
		});
	}

	function edit_tamu() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('update_tamu')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_tamu')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#editTamu').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit Tamu"

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
					$('#editTamu').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Edit Tamu"

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
				$('#editTamu').modal('hide');
				$.notify(data, "error");
			}
		})
	}
</script>
@endsection