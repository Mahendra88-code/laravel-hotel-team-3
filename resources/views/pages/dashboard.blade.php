@extends('master')
@section('active-dashboard','active')
@section('title-navbar','Dashboard')
@section('title','DASHBOARD')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="fa fa-bed"></i>
					</div>
					<p class="card-category">Kamar Tersedia</p>
					<h3 class="card-title">
						@foreach($tersedia as $key => $val)
						{{$val->jumlah}}
						@endforeach
					</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-info">info</i>
						<a href="{{ route('lkamar') }}">Lihat Selengkapnya</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-danger card-header-icon">
					<div class="card-icon">
						<i class="fa fa-bed"></i>
					</div>
					<p class="card-category">Kamar Terpakai</p>
					<h3 class="card-title">
						@foreach($terpakai as $key => $val)
						{{$val->jumlah}}
						@endforeach
					</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-info">info</i>
						<a href="{{ route('lkamar') }}">Lihat Selengkapnya</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-warning card-header-icon">
					<div class="card-icon">
						<i class="fa fa-bed"></i>
					</div>
					<p class="card-category">Kamar Kotor</p>
					<h3 class="card-title">
						@foreach($kotor as $key => $val)
						{{$val->jumlah}}
						@endforeach
					</h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-info">info</i>
						<a href="{{ route('lkamar') }}">Lihat Selengkapnya</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-primary">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<span class="nav-tabs-title"> <h4 class="mt-auto mb-auto"> Tamu yang sedang menginap </h4></span>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-hover table-striped table-bordered" id="datatables">
						<thead>
							<tr>
								<th hidden></th>
								<th> Nama Tamu </th>
								<th> # Kamar </th>
								<th> Tanggal / Waktu Check In </th>
							</tr>
						</thead>
						<tbody>
							@foreach($inhouse as $t)
							<tr>
								<td hidden></td>
								<td> {{ $t->prefix.'. '.$t->nama_depan.' '.$t->nama_belakang }} </td>
								<td> {{ $t->nomor_kamar }} </td>
								<td> {{ $t->tanggal_checkin.' / '.$t->waktu_checkin }} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-rose">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<span class="nav-tabs-title"> <h4 class="mt-auto mb-auto"> Tamu yang akan Check Out hari ini </h4></span>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-hover table-striped table-bordered" id="datatables_1">
						<thead>
							<tr>
								<th hidden></th>
								<th> Nama Tamu </th>
								<th> # Kamar </th>
								<th> Tanggal / Waktu Check In </th>
							</tr>
						</thead>
						<tbody>
							@foreach($outnow as $t)
							<tr>
								<td hidden></td>
								<td> {{ $t->prefix.'. '.$t->nama_depan.' '.$t->nama_belakang }} </td>
								<td> {{ $t->nomor_kamar }} </td>
								<td> {{ $t->tanggal_checkout.' / '.$t->waktu_checkout }} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
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