  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Hotel Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
         <div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Hotel Travel</strong></h3>
  								</div>
  								<a href="<?=base_url().'data/hotel/form';?>">
  									<button class="btn btn-raised btn-primary">Tambah Data Hotel Travel</button>
  								</a>
  								<div class="boxs-body">
  									<?= $this->session->flashdata('message');?>
  									<div class="table-responsive">
  										<table id="datatable" class="display" style="width:100%">
  											<thead>
  												<tr>
  													<th>No</th>
  													<th>Kode Hotel</th>
  													<th>Nama Hotel</th>
  													<th>Lokasi</th>
  													<th>Kontak</th>
  													<th>Action</th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr>
  													<th>No</th>
  													<th>Kode Hotel</th>
  													<th>Nama Hotel</th>
  													<th>Lokasi</th>
  													<th>Kontak</th>
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
  	</section>

  	<script>

  		$(document).ready(function() {
  			var base_url = "<?php echo base_url();?>";
  			$('#datatable').DataTable({
  				"serverSide": true,
  				"cache"  : true,
  				"ajax":{
  					url :  base_url + 'data/Hotel/datatravel',
  					type : 'POST',
  				},
  				"columnDefs": [{ 
  					"targets": [0],
  					"orderable": false
  				}]
  			});
  			$('#datatable').on('click','.remove',function(){
  				var id    = $(this).attr('id');
  				var nama  = $(this).attr('nama');
  				swal({
  					title: "Anda Yakin ingin Menghapus Hotel Ini... ?",
  					text: "Ada memilih data "+nama,
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
  							url: 'HapusData/'+id,
  							type: 'POST',
  							dataType: "JSON",
  							success: function(respone) {
  								if (respone.status == 'success') {
  									swal({
  										type: 'success',
  										title: respone.status,
  										text: respone.message,
  										timer: 1200,
  									},function(){
  										window.location.href = base_url + 'data/Hotel/travel';
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