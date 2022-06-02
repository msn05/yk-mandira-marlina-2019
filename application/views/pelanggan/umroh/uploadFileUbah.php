<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0"><?=$headerMenu;?></h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if($Notes == 'JPEG'){?>
					<form method="POST" id="SimpanData"  >
						<div class="row">
							<div class="col-sm-6">
								<section class="boxs">
									<div class="boxs-header bg-blush">
										<h3 class="custom-font">
											<strong>Form Upload <?=$headerMenu;?></strong></h3>
										</div>
										<div class="row">
											<input type="hidden" id="id" class="id" value="<?=$idFile;?>" name="id"/>
											<input type="hidden" id="idd" class="idd" value="<?=$File;?>" name="idd"/>
											<div class="col-md-12">
												<div class="form-group col-sm-12">
													<label for="username">Foto</label>
													<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
													<input type="hidden" name="dds" id="dds" value="foto">
													<small class="text-danger ">Harap Diisi.  Format PNG max size 100kb..!</small>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-raised btn-success pull-right">Simpan</button>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</form>
					<?php }else{?>
						<form method="POST" id="SimpanData1"  >
							<div class="row">
								<div class="col-sm-6">
									<section class="boxs">
										<div class="boxs-header bg-blush">
											<h3 class="custom-font">
												<strong>Form Upload <?=$headerMenu;?></strong></h3>
											</div>
											<div class="row">
												<input type="hidden" id="id" class="id" value="<?=$idFile;?>" name="id"/>
												<input type="hidden" id="idd" class="idd" value="<?=$File;?>" name="idd"/>
												<div class="col-md-12">
													<div class="form-group col-sm-12">
														<?php if($Note == 'ktp'){?>
															<label for="username">KTP</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
															<input type="hidden" name="dds" id="dds" value="ktp">
														<?php }elseif($Note == 'kk'){?>
															<label for="username">KK</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
															<input type="hidden" name="dds" id="dds" value="kk">
														<?php }elseif($Note == 'pasport'){?>
															<label for="username">Pasport</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
															<input type="hidden" name="dds" id="dds" value="pasport">
														<?php }else{?>
															<label for="username">Buku nikah</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
															<input type="hidden" name="dds" id="dds" value="buku_nikah">
														<?php }?>
														<small class="text-danger ">Harap Diisi.  Format PDF max size 1mb..!</small>

													</div>
												</div>
												<div class="form-group col-sm-12">
													<div class="col-sm-12">
														<button type="submit" class="btn btn-raised btn-success pull-right">Simpan</button>
													</div>
												</div>
											</div>
										</section>
									</div>
								</div>
							</form>
						<?php }?>
					</div>
				</div>
			</section>

			<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
			<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 

			<script>

				$('#SimpanData').submit(function(e){
					e.preventDefault(); 
					var base_url 	= "<?php echo base_url();?>";
					$.ajax({
						url: base_url + 'data/pelanggan/UploadDokumenJPG',
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
									timer: 1200,
								},
								function () {
									window.location.href = base_url + 'data/pelanggan/FileDokumen?idData='+respone.kode;
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

				$('#SimpanData1').submit(function(e){
					e.preventDefault(); 
					var base_url 	= "<?php echo base_url();?>";
					$.ajax({
						url: base_url + 'data/pelanggan/UploadDokumenPDF',
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
									timer: 1200,
								},
								function () {
									window.location.href = base_url + 'data/pelanggan/FileDokumen?idData='+respone.kode;
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
			</script>