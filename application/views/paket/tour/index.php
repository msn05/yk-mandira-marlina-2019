  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Paket Tour</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="row">
  					<div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Paket Tour</strong></h3>
  								</div>
  								<a href="<?=base_url().'data/paket/formTour';?>">
  									<button class="btn btn-raised btn-primary">Tambah Paket</button>
  								</a>
  								<div class="boxs-body">
  									<div class="table-responsive">
  										<table id="datatable" class="display" style="width:100%">
  											<thead>
  												<tr>
  													<th>No</th>
  													<th>Kode Paket</th>
  													<th>Nama Paket</th>
  													<th>Dari / Tujuan</th>
  													<th>Harga</th>
  													<th>Tanggal Dibuat</th>
  													<th>Nama Karyawan</th>
  													<th>Action</th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr>
  													<th>No</th>
  													<th>Kode Paket</th>
  													<th>Nama Paket</th>
  													<th>Dari / Tujuan</th>
  													<th>Harga</th>
  													<th>Tanggal Dibuat</th>
  													<th>Nama Karyawan</th>
  													<th>Action</th>
  												</tr>
  											</tfoot>
  										</table>
  									</div>
  								</div>
  							</section>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>

  	<script>

  		$(document).ready(function() {
  			var base_url = "<?php echo base_url();?>";
  			$('#datatable').DataTable({
  				"serverSide": true,
  				"cache"  : false,
  				"ajax":{
  					url :  base_url + 'data/Paket/DataTour',
  					type : 'POST',
  				},
  				"columnDefs": [{ 
  					"targets": [0],
  					"orderable": false
  				}]
  			});
  			$('#datatable').on('click','.Hapus',function(){
  				var id      = $(this).attr('id');
  				var nama    = $(this).attr('nama');
  				swal({
  					title: "Anda Yakin ingin Menonaktifkan Paket ini.. ?",
  					text: "Ada memilih data Paket "+nama,
  					type: "warning",
  					showCancelButton: true,
  					confirmButtonClass: "btn-danger",
  					confirmButtonText: "Ya",
  					closeOnConfirm: false,
  					closeOnCancel: false
  				},
  				function (Komfirmasi) {
  					if (Komfirmasi) {
  						$.ajax({
  							url: 'deleteTravel?id='+id,
  							type: 'POST',
  							dataType: 'json',
  							cache: 'false',
  							success: function(respone) {
  								if (respone.status == 'success') {
  									swal({
  										type: 'success',
  										title: respone.status,
  										text: respone.message,
  										timer: 1200,
  									},function(){
  										location.reload(true);
  									});
  								}else{
  									swal({
  										type: 'error',
  										title: respone.status,
  										text: respone.message,
  										timer: 1200,
  									});
  								}
  							}
  						});
  					} else {
  						swal("Batal", "Batal :)", "error");
  					}
  				});
  			});
  			$('#datatable').on('click','.Aktifkan',function(){
  				var id    	= $(this).attr('id');
  				var nama  	= $(this).attr('nama');
  				swal({
  					title: "Anda Yakin ingin Aktifkan Paket ini.. ?",
  					text: "Ada memilih data Paket "+nama,
  					type: "warning",
  					showCancelButton: true,
  					confirmButtonClass: "btn-danger",
  					confirmButtonText: "Ya",
  					closeOnConfirm: false,
  					closeOnCancel: false
  				},
  				function (Komfirmasi) {
  					if (Komfirmasi) {
  						$.ajax({
  							url: 'AktifkanPaket?id='+id,
  							type: 'POST',
  							dataType: 'json',
  							cache: 'false',
  							success: function(respone) {
  								if (respone.status == 'success') {
  									swal({
  										type: 'success',
  										title: respone.status,
  										text: respone.message,
  										timer: 1200,
  									},function(){
  										location.reload(true);
  									});
  								}else{
  									swal({
  										type: 'error',
  										title: respone.status,
  										text: respone.message,
  										timer: 1200,
  									});
  								}
  							}
  						});
  					} else {
  						swal("Batal", "Batal :)", "error");
  					}
  				});
  			});
  		});
  	</script>