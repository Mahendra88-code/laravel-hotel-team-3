@extends('master')
@section('active-transaksi', 'active')
@section('show-transaksi', 'active')
@section('active-translayanan','active')
@section('title-navbar','Laporan')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card ">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">assignment</i>
					</div>
					<h4 class="card-title">Transaksi Layanan</h4>
				</div>
				<div class="card-body ">
					<form>	
						<div class="row">
							<div class="col-md-3">
								<input class="form-control datepicker" type="text" placeholder="Dari Tanggal" name="first" id="first">
							</div>
							<div class="col-md-3">
								<input class="form-control datepicker" type="text" placeholder="Sampai Tanggal" name="second" id="second">
							</div>
							<div class="col-md-3">
								<button class="btn btn-success float-right"> Lihat Laporan </button>
							</div>
						</div>
					</form>
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