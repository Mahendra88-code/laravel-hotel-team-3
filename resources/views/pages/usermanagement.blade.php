@extends('master')
@section('active-user','active')
@section('title-navbar','User Management')
@section('title','MASTER USER')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">face</i>
					</div>
					<h4 class="card-title">Master User</h4>
					<button class="btn btn-success float-right"  data-toggle="modal" data-target="#addUser"> 
						<i class="material-icons">add</i> Tambah User 
					</button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th hidden></th>
								<th>Nama User</th>
								<th>Role</th>
								<th>Jabatan</th>
								<th>Nomor Telp / Handphone</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user as $val)
							<tr>
								<td hidden></td>
								<td>{{ $val->nama }}</td>
								<td>{{ $val->role_name }}</td>
								<td>{{ $val->jabatan }}</td>
								<td>{{ $val->nomor_telp }}</td>
								<td>
									<button onclick="get_user({{ $val->id_user }})" class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update User" data-toggle="modal" data-target="#editUser">
										<i class='material-icons'>edit</i>
									</button>
									<button onclick="delete_user({{ $val->id_user }})" class='btn btn-danger btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Delete User">
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

<div class="modal fade" id="addUser" tabindex="-1" role="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Tambah User</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="save_user">
						<div class="card-body">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">people</i></div>
									</div>
									<input name="nama_pengguna" id="nama_pengguna" type="text" class="form-control" autocomplete="off" placeholder="Nama Pengguna..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">vpn_key</i></div>
									</div>
									<select name="select_role" id="select_role" class="selectpicker w-75" data-live-search="true" data-style="btn btn-success" title="Batasan Akses">
										@foreach($role as $r)
										<option value="{{ $r->id_user_role }}">{{ $r->role_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">work</i></div>
									</div>
									<input name="jabatan" id="jabatan" type="text" class="form-control" autocomplete="off" placeholder="Jabatan..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">phone</i></div>
									</div>
									<input name="nomor_telep" id="nomor_telep" type="text" class="form-control" autocomplete="off" placeholder="Nomor Telp / Handphone..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">face</i></div>
									</div>
									<input name="username" id="username" type="text" class="form-control" autocomplete="off" placeholder="Username..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">lock</i></div>
									</div>
									<input name="password" id="password" type="password" class="form-control" autocomplete="off" placeholder="Password..." required="">
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="save_user()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editUser" tabindex="-1" role="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-info text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Edit User</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_user">
						{{csrf_field()}}  
						<div class="card-body">
							<input type="text" hidden="hidden" name="id_edit" id="id_edit">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">people</i></div>
									</div>
									<input name="nama_pengguna_edit" id="nama_pengguna_edit" type="text" class="form-control" autocomplete="off" placeholder="Nama Pengguna..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">vpn_key</i></div>
									</div>
									<select name="select_role_edit" id="select_role_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-info" title="Batasan Akses">
										@foreach($role as $r)
										<option value="{{ $r->id_user_role }}">{{ $r->role_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">work</i></div>
									</div>
									<input name="jabatan_edit" id="jabatan_edit" type="text" class="form-control" autocomplete="off" placeholder="Jabatan..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">phone</i></div>
									</div>
									<input name="nomor_telep_edit" id="nomor_telep_edit" type="text" class="form-control" autocomplete="off" placeholder="Nomor Telp / Handphone..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">face</i></div>
									</div>
									<input name="username_edit" id="username_edit" type="text" class="form-control" autocomplete="off" placeholder="Username..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">lock</i></div>
									</div>
									<input name="password_edit" id="password_edit" type="password" class="form-control" autocomplete="off" placeholder="Password..." required="">
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_user()" class="btn btn-info btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function save_user() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('create_user')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_user')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#addUser').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Menambahkan User Baru"

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
					$('#addUser').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Menambahkan User Baru"

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
				$('#addUser').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function delete_user(id) {
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
					url: "{{route('delete_user')}}",
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

	function get_user(id){
		console.log(id);
		$.ajax({
			url : "{{route('read_user')}}",
			method : "GET",
			data : {
				id : id
			} ,
			success : function(data){
				$('#id_edit').val(data[0].id_user),
				$('#nama_pengguna_edit').val(data[0].nama),
				$('#select_role_edit').selectpicker('val', data[0].id_user_role),
				$('#jabatan_edit').val(data[0].jabatan),
				$('#nomor_telep_edit').val(data[0].nomor_telp),
				$('#username_edit').val(data[0].username)
			}
		});
	}

	function edit_user() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('update_user')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_user')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#editUser').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit User"

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
						message: "Gagal Edit User"

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
</script>
@endsection