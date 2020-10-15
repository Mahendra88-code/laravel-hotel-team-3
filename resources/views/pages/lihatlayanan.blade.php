@extends('master')
@section('active-layanan', 'active')
@section('show-layanan', 'active')
@section('active-llayanan','active')
@section('title-navbar','Layanan')
@section('title','MASTER LAYANAN')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-cutlery"></i>
					</div>
					<h4 class="card-title">Master Layanan</h4>
					<button class="btn btn-success float-right" data-toggle="modal" data-target="#addLayanan">
						<i class="material-icons">add</i> Tambah Layanan 
					</button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th hidden></th>
								<th>Nama Layanan</th>
								<th>Kategori</th>
								<th>Harga</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($layanan as $val)
							<tr>
								<td hidden></td>
								<td>{{ $val->nama_layanan }}</td>
								<td>{{ $val->nama_layanan_kategori }}</td>
								<td>Rp. {{ number_format($val->harga_layanan, 2, ',', '.') }} / {{ $val->satuan }}</td>
								<td>
									<button onclick="get_layanan({{ $val->id_layanan }})" class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update Layanan" data-toggle="modal" data-target="#editLayanan">
										<i class='material-icons'>edit</i>
									</button>
									<button onclick="delete_layanan({{ $val->id_layanan }})" class='btn btn-danger btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Delete Layanan">
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

<div class="modal fade" id="addLayanan" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Tambah Layanan</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="save_layanan">
						<div class="card-body">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">extension</i></div>
									</div>
									<input name="nama_produk" id="nama_produk" type="text" class="form-control" autocomplete="off" placeholder="Nama Layanan / Produk..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">class</i></div>
									</div>
									<select name="select_kategori" id="select_kategori" class="selectpicker w-75" data-live-search="true" data-style="btn btn-success" title="Kategori Layanan / Produk">
										@foreach($kategori as $k)
										<option value="{{ $k->id_layanan_kategori }}">{{ $k->nama_layanan_kategori }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">filter_1</i></div>
									</div>
									<input name="satuan" id="satuan" type="text" class="form-control" autocomplete="off" placeholder="Satuan..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">money</i></div>
									</div>
									<input name="harga" id="harga" type="number" class="form-control" placeholder="Harga..." required="">
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="save_layanan()" class="btn btn-success btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editLayanan" tabindex="-1" role="">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-info text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="card-title">Edit Layanan</h4>                    
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="edit_layanan">
						{{csrf_field()}}  
						<div class="card-body">
							<input type="text" hidden="hidden" name="id_edit" id="id_edit">
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">extension</i></div>
									</div>
									<input name="nama_produk_edit" id="nama_produk_edit" type="text" class="form-control" autocomplete="off" placeholder="Nama Layanan / Produk..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">class</i></div>
									</div>
									<select name="select_kategori_edit" id="select_kategori_edit" class="selectpicker w-75" data-live-search="true" data-style="btn btn-info" title="Kategori Layanan / Produk">
										@foreach($kategori as $k)
										<option value="{{ $k->id_layanan_kategori }}">{{ $k->nama_layanan_kategori }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">filter_1</i></div>
									</div>
									<input name="satuan_edit" id="satuan_edit" type="text" class="form-control" autocomplete="off" placeholder="Satuan..." required="">
								</div>
							</div>
							<div class="form-group bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="material-icons">money</i></div>
									</div>
									<input name="harga_edit" id="harga_edit" type="number" class="form-control" placeholder="Harga..." required="">
								</div>
							</div>
						</div>                          
					</div>
					<div class="modal-footer justify-content-center">
						<a onclick="edit_layanan()" class="btn btn-info btn-link btn-wd btn-lg">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	function save_layanan() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('save_layanan')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#save_layanan')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#addLayanan').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Menambahkan Layanan Baru"

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
					$('#addLayanan').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Menambahkan Layanan Baru"

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
				$('#addLayanan').modal('hide');
				$.notify(data, "error");
			}
		})
	}

	function delete_layanan(id) {
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
					url: "{{route('delete_layanan')}}",
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

	function get_layanan(id){
		console.log(id);
		$.ajax({
			url : "{{route('get_layanan')}}",
			method : "GET",
			data : {
				id : id
			} ,
			success : function(data){
				$('#id_edit').val(data[0].id_layanan),
				$('#nama_produk_edit').val(data[0].nama_layanan),
				$('#select_kategori_edit').selectpicker('val', data[0].id_layanan_kategori),
				$('#satuan_edit').val(data[0].satuan),
				$('#harga_edit').val(data[0].harga_layanan)
			}
		});
	}

	function edit_layanan() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{route('update_layanan')}}",
			processData: false,
			contentType : false,
			data: new FormData($('#edit_layanan')[0]),
			type: 'post',
			success: function (result) {    
				if (result == 'sukses') {
					$('#editLayanan').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Berhasil Edit Layanan"

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
					$('#editLayanan').modal('hide');
					$.notify({
						icon: "notification_important",
						message: "Gagal Edit Layanan"

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
				$('#editLayanan').modal('hide');
				$.notify(data, "error");
			}
		})
	}
</script>
@endsection