<section id="hero_2">
	<div class="intro_title">
		<h1>Halaman Upload Dokumen </h1>
	</div>
</section>
<main>
	
	<div class="container margin_60">
		<div class="row">
			<div class="col-lg-8">
				<form id="SimpanData" method="post">
					<div class="box_style_1">
						<h3 class="inner">- Update Dokumen -</h3>
						<div class="col-lg-12 add_bottom_15">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>KTP</label>
										<input type="hidden" class="form-control" id="id" name="id" value="<?=$dataPeka;?>" autocomplete="off" readonly/>
										<input type="hidden" class="form-control" id="idfile" name="idfile" value="<?=$dataPek;?>" autocomplete="off" >
										<input type="hidden" class="form-control" id="idP" name="idP" value="<?=$idNya;?>" autocomplete="off" >
										<input type="hidden" class="form-control" id="idJ" name="idJ" value="<?=$idJasa;?>" autocomplete="off" >
										<label>KTP</label>
										<input type="file" class="form-control" id="ktp" name="ktp" autocomplete="off" >
										<small class="text-danger">* Wajib Format PDF max 1mb</small>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>KK</label>
										<input type="file" class="form-control" id="kk" name="kk" autocomplete="off" >
										<small class="text-danger">* Wajib Format PDF max 1mb</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Passport</label>
										<input type="file" class="form-control" id="Pasport" name="Pasport" autocomplete="off" >
										<small class="text-danger">* Wajib Format PDF max 1mb</small>
									</div>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-lg-12">
									<button type="submit" class="btn_1 green medium">UPDLOAD</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<aside class="col-lg-4">
				<div class="box_style_1">
					<h3 class="inner">- Upload Dokumen Anda  -</h3>
					<div class="col-lg-12 add_bottom_15">
						<div class="form-group">
							<h3 class="text-danger"> Note</h3>
							<hr>
							<p>Halaman ini harus anda isi ya jika ingin memesan layanan ini karena dokumen tersebut dibutuhkan </p>								
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>
</main>
<script type="text/javascript">
	$('#SimpanData').submit(function(e){
		e.preventDefault(); 
		var base_url 	= "<?php echo base_url();?>";
		$.ajax({
			url: base_url + 'data/PelangganPesan/UploadDokumenProsesTiket',
			type:"post",
			data:new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			dataType: "JSON",
			success: function (respone) {
				if (respone.status == 'success') {
					swal({
						type: 'success',
						title: respone.status,
						text: respone.message,
					},
					function () {
						window.location.href = base_url + 'data/PelangganPesan/InformasiPemesananTiket?idData='+respone.kode+'&idDataNya='+respone.idData+'&idJasa='+respone.idJasa;
					});
				}else{
					swal({
						type: 'error',
						title: respone.status,
						text: respone.message,
					});
				}
			}
		});
	});
</script>
