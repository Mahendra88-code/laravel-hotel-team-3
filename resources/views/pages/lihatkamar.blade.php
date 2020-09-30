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
					<button class="btn btn-success float-right"> <i class="material-icons">add</i> Tambah Kamar </button>
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