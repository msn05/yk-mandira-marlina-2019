  <section id="content">
  	<div class="page page-ui-portlets">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Perlengkapan Lanjutan Layanan</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<form method="POST" id="SimpanData" class="form-horizontal">
  			<div class="row">
  				<div class="col-sm-12">
  					<section class="boxs">
  						<div class="boxs-header bg-blush">
  							<h3 class="custom-font">
  								<strong>Perlengkapan Lanjutan Layanan</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="boxs-body">
  									<div class="row">
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="id_akses">Kode Perlengkapan</label>
  												<input type="hidden" class="form-control" value="<?=$Id;?>"  id="id"  name="id"/>
  												<input type="text" class="form-control" value="<?=$Kode;?>"  id="kode"  name="kode" readonly/>
  												<small class="text-danger ">Kode Perlengkapan..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Nama Barang</label>
  												<input type="text" value="<?=$NamaBarang;?>" class="form-control" id="NamaBarang" name="NamaBarang"/>
  												<small class="text-danger ">Nama Barang..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Tanggal Posting</label>
  												<input type="date" value="<?=$Tanggal;?>" class="form-control" id="tanggalPost" name="tanggalPost"/>
  												<small class="text-danger ">Tanggal - bulan - tahun..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Jumlah</label>
  												<input type="number" value="<?=$jumlah;?>" class="form-control" id="Jumlah" name="Jumlah"/>
  												<small class="text-danger ">Jumlah Barang..!</small>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  							<hr class="line-dashed full-witdh-line" />
  							<div class="form-group">
  								<div class="col-sm-offset-4 col-sm-10">
  									<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
  									<a href="<?=base_url().'data/Perlengkapan';?>">
  										<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  									</a>
  								</div>
  							</div>
  						</section>
  					</div>
  				</div>
  			</form>
  		</div>
  	</section>
  	<script>
  		$(document).ready(function() {
  			$('#SimpanData').on('submit', function (e) {
  				e.preventDefault();
  				var base_url = "<?php echo base_url();?>";
  				var SimpanData = $(this);
  				$.ajax({
  					type: "POST",
  					url: base_url + 'data/perlengkapan/UbahData',
  					data: SimpanData.serialize(),
  					dataType: "JSON",
  					cache : "false",
  					success: function (respone) {
  						if (respone.status == 'success') {
  							swal({
  								type: 'success',
  								title: respone.status,
  								text: respone.message,
  								timer: 1200,
  							},function(){
  								window.location.href = base_url + 'data/Perlengkapan';
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
  			});
  		});
  	</script>





