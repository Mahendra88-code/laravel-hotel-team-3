@extends('master')
@section('active-transaksi', 'active')
@section('show-transaksi', 'active')
@section('active-translayanan','active')
@section('title-navbar','Laporan')
@section('title','TRANSAKSI LAYANAN')
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
					<div class="row">
						<div class="col-md-3">
							<input class="form-control datepicker" type="text" placeholder="Dari Tanggal" name="dari_tanggal" id="dari_tanggal">
						</div>
						<div class="col-md-3">
							<input class="form-control datepicker" type="text" placeholder="Sampai Tanggal" name="sampai_tanggal" id="sampai_tanggal">
						</div>
						<div class="col-md-3">
							<button class="btn btn-success" onclick="getTanggal()" > Lihat Laporan </button>
						</div>
					</div>
					<div id="datass">
						
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
	function getTanggal() {
		event.preventDefault();
		$a = $('#dari_tanggal').val();
		$b = $('#sampai_tanggal').val();

		$.ajax({
			url : "{{route('getTLayanan')}}",
			method : 'get',
			dataType :'html',
			data: {
				dari_tanggal: $a,
				sampai_tanggal: $b
			},
			success:function(data) {
				console.log(data);
				$('#datatables').DataTable();
				$('#datass').html(data);
				$('#datatables').DataTable('refresh');
			}
		})
	}
</script>
@endsection