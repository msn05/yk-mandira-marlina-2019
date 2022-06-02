<section id="content">
	<div class="page profile-page">
		<!-- page content -->
		<div class="pagecontent">
			<!-- row -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="row">
						<div class="col-md-12">
							<div class="kosong alert alert-danger alert-dismissable">
								Halaman Ini Berikan Tentang perusahaan Anda...!
							</div>
							<div class="col-md-12">
								<?= $this->session->flashdata('message');?>
							</div>
						</div>
					</div>
					<section class="boxs boxs-simple">
						<div class="boxs-body p-0">
							<div role="tabpanel">
								<ul class="nav nav-tabs tabs-dark-t" role="tablist">
									<li role="presentation">
										<a href="#setting" role="tab" data-toggle="tab">Tetang Perusahan</a>
									</li>
									<li role="presentation">
										<a href="#tentang" role="tab" data-toggle="tab">Visi dan Misi</a>
									</li>
									<li role="presentation">
										<a href="#sp" role="tab" data-toggle="tab">Sejarah</a>
									</li>
									<li role="pres">
										<a href="#ten" role="tab" data-toggle="tab">Struktur Organisasi</a>
									</li>
									<li role="press">
										<a href="#tens" role="tab" data-toggle="tab">Ubah Data Perusahaan</a>
									</li>
									<li role="presss">
										<a href="#tenss" role="tab" data-toggle="tab">Ubah Struktur Perusahaan</a>
									</li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane" id="setting">
										<div class="wrap-reset">
											<form class="profile-settings">
												<div class="row">
													<div class="form-group col-md-12 legend">
														<h4>
															<strong>Login</strong> Sistem</h4>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-4">
															<label for="username">Id Perusahaan</label>
															<input type="text" class="form-control" id="username" value="<?=$Perusahaan->id_perusahaan;?>" name="username" readonly>
														</div>
														<div class="form-group col-sm-4">
															<label for="password">Nama Perusahaan</label>
															<input type="text" class="form-control" id="level" name="level" value="<?=$Perusahaan->nama_perusahaan;?>" readonly>
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password">Alamat</label>
															<textarea class="form-control"><?=$Perusahaan->alamat;?></textarea>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Nomor Telephone</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Perusahaan->no_telphone;?>">
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Nomor Fax</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Perusahaan->no_fax;?>">
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Emails</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Perusahaan->email;?>">
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Nomor Registrasi</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Perusahaan->nomor_registrasi;?>">
														</div>
													</div>
												</form>
											</div>
										</div>

										<div role="tabpanel" class="tab-pane" id="tentang">
											<div class="wrap-reset">
												<form class="profile-tentang">
													<div class="row">
														<div class="form-group col-md-12 legend">
															<h4>
																<strong>Visi dan</strong> Misi</h4>
															</div>
														</div>
														<div class="row">
															<div class="form-group col-sm-12">
																<label for="username">Visi</label>
																<textarea class="form-control" name="visi" id="visi1"><?=$Perusahaan->visi;?></textarea>
															</div>
															<div class="form-group col-sm-12">
																<label for="username">Misi</label>
																<textarea class="form-control" name="misi" id="misi1"><?=$Perusahaan->misi;?></textarea>
															</div>
														</div>
													</form>
												</div>
											</div>



											<div role="tabpanel" class="tab-pane" id="sp">
												<div class="wrap-reset">
													<form class="profile-tentang" method="post" action="<?=base_url().'data/YekaMandira/SimpanSejarah';?>">
														<div class="row">
															<div class="form-group col-sm-12">
																<label for="username">Sejarah</label>
																<input type="hidden" class="form-control" id="username" value="<?=$Perusahaan->id_perusahaan;?>" name="username" readonly>
																<textarea class="form-control" name="sp1" id="sp1"><?=$Perusahaan->serajarah_perusahaan;?></textarea>
															</div>

														</div>
														<div class="row">
															<div class="form-group col-sm-12">
																<button type="submit" class="btn btn-raised btn-primary text-center pull-right">Save</button>
															</div>
														</div>
													</form>
												</div>
											</div>


											<div role="tabpanel" class="tab-pane" id="ten">
												<div class="wrap-reset">
													<form class="profile-tentang">
														<div class="row">
															<hr>
															<img width="100%;" height="400px;" src="<?=base_url().'image/struktur/'.$Perusahaan->struktur_organisasi.'';?>">
															<hr>
															<p class="text-center">Sumber : Yeka Madira Palembang</p>
														</div>
													</form>
												</div>
											</div>


											<div role="tabpanel" class="tab-pane" id="tens">
												<div class="wrap-reset">
													<form class="profile-settings" method="post"  action="<?=base_url().'data/YekaMandira/simpanperubahan';?>">
														<div class="row">
															<div class="form-group col-md-12 legend">
																<h4>
																	<strong>Form Ubah</strong> Tentang Perusahaan</h4>
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-4">
																	<label for="username">Id Perusahaan</label>
																	<input type="text" class="form-control" id="username" value="<?=$Perusahaan->id_perusahaan;?>" name="username" readonly>
																</div>
																<div class="form-group col-sm-4">
																	<label for="password">Nama Perusahaan</label>
																	<input type="text" class="form-control" id="level" name="level" value="<?=$Perusahaan->nama_perusahaan;?>">
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password">Alamat</label>
																	<textarea class="form-control" name="alamat"><?=$Perusahaan->alamat;?></textarea>
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Nomor Telephone</label>
																	<input type="text" class="form-control" id="notel" name="notel" value="<?=$Perusahaan->no_telphone;?>" >
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Nomor Fax</label>
																	<input type="text" class="form-control" id="nofac" name="nofac" value="<?=$Perusahaan->no_fax;?>">
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Emails</label>
																	<input type="text" class="form-control" id="email" name="email" value="<?=$Perusahaan->email;?>">
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Nomor Registrasi</label>
																	<input type="text" class="form-control" id="noreg" name="noreg" value="<?=$Perusahaan->nomor_registrasi;?>">
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-6">
																	<label for="new-password-repeat">Visi</label>
																	<textarea name="visi" id="visi" class="form-control"><?=$Perusahaan->visi;?></textarea>
																</div>
																<div class="form-group col-sm-6">
																	<label for="new-password-repeat">Misi</label>
																	<textarea name="misi" id="misi" class="form-control"><?=$Perusahaan->misi;?></textarea>
																</div>
															</div>
															<hr>
															<div class="row">
																<div class="form-group col-sm-12">
																	<button type="submit" class="btn btn-raised btn-primary text-center pull-right">Save Changes</button>
																</div>
															</div>

														</form>
													</div>
												</div>


												<div role="tabpanel" class="tab-pane" id="tenss">
													<div class="wrap-reset">
														<form class="profile-settings" method="post" id="SimpanData">
															<div class="row">
																<div class="form-group col-md-12 legend">
																	<h4>
																		<strong>Form Ubah</strong> Struktur Oraganisasi Perusahaan</h4>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group col-sm-12">
																		<input type="text" class="form-control" id="username" value="<?=$Perusahaan->id_perusahaan;?>" name="username">
																		<label for="password">File</label>


																		<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="" id="foto" name="foto">
																		<small class="text-danger ">Harap Diisi.  Format PNG max size 1mb..!</small>
																	</div>
																</div>
																<hr>
																<div class="row">
																	<div class="form-group col-sm-12">
																		<button type="submit" class="btn btn-raised btn-primary text-center pull-right">Save Changes</button>
																	</div>
																</div>

															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</section>


				<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
				<script>
					CKEDITOR.replace( 'misi1',{
						height: 200
					});
					CKEDITOR.replace( 'visi1',{
						height: 200
					});

					CKEDITOR.replace( 'misi',{
						height: 200
					});
					CKEDITOR.replace( 'visi',{
						height: 200
					});

					CKEDITOR.replace( 'sp1',{
						height: 400
					});
				</script>


				<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
				<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 

				<script>

					$('#PostSejarah').on('submit',function(e){
						e.preventDefault();
						var PostSejarah = $(this);
						var base_url = "<?php echo base_url();?>";
						$.ajax({
							url: base_url + 'data/YekaMandira/SimpanSejarah',
							type: "POST",
							data: SimpanData.serialize(),
							dataType: "JSON",
							cache : "false",
							success: function (respone) {
								if (respone.status == 'success') {
									swal({
										type: 'success',
										title: respone.status,
										text: respone.message,
									},
									function(){
										location.reload(true);
									});
								}else{
									swal({
										type: 'error',
										title: respone.status,
										text: respone.message,
									},
									function(){
										location.reload(true);
									});
								}
							}
						});
					});

					$('#SimpanData').submit(function(e){
						e.preventDefault(); 
						var base_url 	= "<?php echo base_url();?>";
						$.ajax({
							url: base_url + 'data/YekaMandira/Uploadstruktur',
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
					});
				</script>