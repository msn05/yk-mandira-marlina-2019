  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Penerbangan Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
         <div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Penerbangan Travel</strong></h3>
  								</div>
  								<a href="<?=base_url().'data/Penerbangan/formTravel';?>">
  									<button class="btn btn-raised btn-primary">Tambah Penerbangan</button>
  								</a>
  								<div class="boxs-body">
  									<div class="table-responsive">
  										<table id="datatable" class="display" style="width:100%">
  											<thead>
  												<tr>
  													<th>No</th>
  													<th>Kode Penerbangan</th>
  													<th>Nama Maskapai</th>
  													<th>Tanggal Pesan</th>
  													<th>Jumlah Kursi</th>
  													<th>Action</th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr>
  													<th>No</th>
  													<th>Kode Penerbangan</th>
  													<th>Nama Maskapai</th>
  													<th>Tanggal Pesan</th>
  													<th>Jumlah Kursi</th>
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
  				"cache"  : false,
  				"ajax":{
  					url :  base_url + 'data/Penerbangan/datapenerbangantravel',
  					type : 'POST',
  				},
  				"columnDefs": [{ 
  					"targets": [0],
  					"orderable": false
  				}]
  			});
  			$('#datatable').on('click','.remove',function(){
  				var id    	= $(this).attr('id');
  				var nama  	= $(this).attr('nama');
  				var jumlah  = $(this).attr('jumlah');
  				swal({
  					title: "Anda Yakin ingin Menghapus Penerbangan ini.. ?",
  					text: "Ada memilih data maskapai "+nama+ " Dengan jumlah Kursi Sebanyak "+jumlah+ " Orang",
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
  							url: 'deleteTravel/'+id,
  							type: 'POST',
  							success: function(respone) {
                 if (respone.status == 'success') {
                  swal({
                   type: 'success',
                   text: respone.message,
                   title: respone.status,
                   timer: 1200,
                 },
                 function () {
                   window.location.href = base_url + 'data/Penerbangan/Travel';
                 });
                }else{
                  swal({
                   type: 'error',
                   text: respone.message,
                   title: respone.status,
                   timer: 1200,
                 })
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