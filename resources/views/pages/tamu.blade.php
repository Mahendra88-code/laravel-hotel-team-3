@extends('master')
@section('active-tamu','active')
@section('title-navbar','Buku Tamu')
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
					<button class="btn btn-success float-right"> <i class="material-icons">add</i> Tambah User </button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-bordered table-hover">
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
						@foreach($tamu as $val)
						<tbody>
							<td hidden></td>
							<td>{{ $val->prefix }} {{ $val->nama_depan }} {{ $val->nama_belakang }}</td>
							<td>{{ $val->warga_negara }}</td>
							<td>{{ $val->nomor_telp }}</td>
							<td>{{ $val->email }}</td>
							<td>
								<button class='btn btn-info btn-sm btn-just-icon btn-round' rel="tooltip" data-original-title="Update Kamar">
									<i class='material-icons'>edit</i>
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
</div>	
@endsection
@section('js')
<script>
	
</script>
@endsection