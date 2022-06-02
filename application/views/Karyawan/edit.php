  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Karyawan Yeka Madira</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-6">
  				<section class="boxs">
  					<div class="boxs-header">
  						<h3 class="custom-font hb-green">
  							<strong><?=$headerMenu;?></h3>
  							</div>
  							<form method="POST" action="" id="DataNya" class="form-horizontal">
  								<div class="boxs-body">
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
  										<div class="col-sm-10">
  											<input type="hidden" class="form-control" name="id_akses" value="<?=$id;?>" id="id_akses" readonly/>
  											<input type="text" class="form-control" name="nama" value="<?=$nama;?>" id="nama" readonly/>
  										</div>
  									</div>
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">Level Users</label>
  										<div class="col-sm-10">
  											<select tabindex="3" name="level" id="level" class="chosen-select form-control" style="width: 100%;">
  												<option value="0"> Pilih Akses Sistem</option>
  												<option value="1"<?=$LevelNya == 1 ? 'selected' : '';?>>Aktif</option>
  												<option value="2"<?=$LevelNya == 2 ? 'selected' : '';?>>Tidak Aktif</option>
  											</select>
  											<small class="text-danger ">Harap Diisi..!</small>
  										</div>
  									</div>
  									<div class="form-group">
  										<div class="col-sm-offset-2 col-sm-10">
  											<button type="submit" id="SimpanData" class="btn btn-raised btn-primary">Simpan</button>
  											<a href="<?=base_url().'data/karyawan';?>">
  												<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  											</a>
  										</div>
  									</div>
  								</div>
  							</form>
  						</section>
  					</div>
  				</div>
  			</div>
  		</section>
  		<script>
  			$('#DataNya').on('submit', function (e) {
  				e.preventDefault();
  				var base_url = "<?php echo base_url();?>";
  				var DataNya = $(this);
  				$.ajax({
  					type: "POST",
  					url: base_url + 'data/karyawan/simpanPerubahanAkses',
  					data: DataNya.serialize(),
  					dataType: "JSON",
  					success: function (respone) {
  						if (respone.status == 'success') {
  							swal({
  								type: 'success',
  								title: respone.status,
  								text: respone.message,
  								timer: 1200,
  							},
  							function () {
  								window.location.href = base_url + 'data/karyawan';
  							});
  						}else{
  							swal({
  								type: 'error',
  								title: respone.status,
  								text: respone.message,
  								timer: 1200,
  							})
  						}
  					}
  				});
  			});
  		</script>


