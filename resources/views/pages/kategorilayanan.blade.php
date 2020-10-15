@extends('master')
@section('active-layanan', 'active')
@section('show-layanan', 'active')
@section('active-klayanan','active')
@section('title-navbar','Layanan')
@section('title','KATEGORI LAYANAN')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-cutlery"></i>
					</div>
					<h4 class="card-title">Kategori Layanan</h4>
					<button class="btn btn-success float-right"> <i class="material-icons">add</i> Tambah Kategori </button>
				</div>
				<div class="card-body ">
					<table id="datatables" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th hidden></th>
								<th>Nama Kategori Layanan</th>
								<th>Keterangan</th>
								<th>Action</th>
							</tr>
						</thead>
						@foreach($klayanan as $val)
						<tbody>
							<td hidden></td>
							<td>{{ $val->nama_layanan_kategori }}</td>
							<td>{{ $val->keterangan }}</td>
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