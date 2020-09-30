@extends('master')
@section('active-dashboard','active')
@section('title-navbar','Dashboard')
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
						<a href="#pablo">Lihat Selengkapnya</a>
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
						<a href="#pablo">Lihat Selengkapnya</a>
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
						<a href="#pablo">Lihat Selengkapnya</a>
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