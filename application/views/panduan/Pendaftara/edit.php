<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Panduan Pendaftaran</h1>
					<small class="text-muted">Welcome to </small>
				</div>
			</div>
		</div>
		<section class="boxs">
			<div class="boxs-header bg-green">
				<h3 class="custom-font">
					<strong>Form Edit Panduan</strong></h3>
				</div>
				<form method="POST" id="DataNya" action="<?=base_url().'data/panduan/simpaneditpendaftaran';?>" enctype="multipart/form-data" class="form-horizontal">
					<div class="boxs-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="hidden" name="id" id="id" value="<?=$dataNya;?>">
										<select name="pilih" id="pilih" class="form-control">
											<option value="0"> Pilih</option>
											<option value="TU"<?=$idKete == 'TU' ? 'selected' : '';?>>Travel Umroh</option>
											<option value="TH"<?=$idKete == 'TH' ? 'selected' : '';?>>Travel Haji</option>
											<option value="U"<?=$idKete == 'U' ? 'selected' : '';?>>Pariwisata</option>
											<option value="T"<?=$idKete == 'T' ? 'selected' : '';?>>Tiket</option>
										</select>
										<small class="text-danger">* Harap Pilih...!</small>
									</div>
								</div>

								<div class="form-group col-sm-12">
									<div class="col-sm-12">
										<textarea class="form-control" name="catatan"  id="catatan" > <?=$keterangan;?></textarea>
										<small class="text-danger ">Tuliskan informasi pendaftaranya</small>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-10">
								<?php if($keteranganData == 'Ubah'){?>
									<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
								<?php }?>
								<a href="<?=base_url().'data/panduan/pendaftaran';?>">
									<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
								</a>
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
	</section>
	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
	<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'catatan',{
			height: 200
		});
	</script>