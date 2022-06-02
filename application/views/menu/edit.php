  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Akses Menu</h1>
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
  										<label for="inputEmail3" class="col-sm-2 control-label">Nama Menu</label>
  										<div class="col-sm-10">
  											<input type="hidden" name="id_menu" value="<?=$id_menu;?>" id="id_menu">
  											<input type="text" name="menu" value="<?=$nama_menu;?>" class="form-control" id="menu" placeholder="Nama Menu">
  											<small class="text-danger ">Harap isi Dengan Huruf..!</small>
  										</div>
  									</div>
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">URL</label>
  										<div class="col-sm-10">
  											<input type="text" name="urlNya" value="<?=$url;?>" class="form-control" id="urlNya" placeholder="alamat menu">
  											<small class="text-danger">Harap isi Dengan Huruf dan diakhiri dengan /..!</small>
  										</div>
  									</div>
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">Akses Menu</label>
  										<div class="col-sm-10">
  											<select tabindex="3" name="am" id="am" class="chosen-select form-control" style="width: 100%;">
  												<option value="0"> Pilih Akses Menu</option>
  												<?php 
  												foreach ($Akses as $key => $value):?>
  													<option value="<?= $value->id_level;?>"<?=$value->id_level ==  $id_akses ? 'selected' : null;?>><?php echo $value->nama_level;?></option>
  												<?php endforeach;?>
  											</select>
  											<small class="text-danger ">Harap Memilih..!</small>
  										</div>
  									</div>
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">Kategori Menu</label>
  										<div class="col-sm-10">
  											<select tabindex="3" name="ak" id="ak" class="chosen-select form-control" style="width: 100%;">
  												<option value="0"> Pilih Kategori Menu</option>
  												<?php 
  												foreach ($KategoriMenu as $key =>$value):?>
  													<option value="<?=$value->id_kategori_menu;?>"<?=$value->id_kategori_menu ==  $menuKategori ? 'selected' : null;?>><?php echo $value->nama_kategori;?></option>
  												<?php endforeach;?>
  											</select>
  											<small class="text-danger ">Harap Memilih..!</small>
  										</div>
  									</div>
  									<div class="form-group">
  										<div class="col-sm-offset-2 col-sm-10">
  											<button type="submit" id="SimpanData" class="btn btn-raised btn-primary">Simpan</button>
  											<a href="<?=base_url().'menu';?>">
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
  					url: base_url + 'menu/simpanPerubahan',
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
  								window.location.href = base_url + 'menu/';
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


