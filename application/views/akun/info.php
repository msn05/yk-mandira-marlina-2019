<section id="content">
	<div class="page profile-page">
		<!-- page content -->
		<div class="pagecontent">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<section class="boxs">
						<div class="profile-header">
							<div class="profile_info">
								<div class="profile-image">
									<img src="<?=base_url().'image/dokumen/'.$foto.'';?>" alt="">
								</div>
								<h4 class="mb-0"><strong><?=$NamaLengkap;?></strong></h4>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-12 col-sm-12">
					<div class="row">
						<div class="col-md-9">
							<div class="kosong alert alert-danger alert-dismissable">
								Halaman Ini Berikan Tentang Data Anda...!
							</div>
						</div>
						<div class="col-md-3">
							<?php if ($Level != 1) {?>
								<a type="submit" href="<?=base_url('');?>/home">
									<div class="alert alert-warning alert-dismissable">
										Kembali
									</div>
								</a>
							<?php }else{?>
								<a type="submit" href="<?=base_url('');?>/data/Karyawan">
									<div class="alert alert-warning alert-dismissable">
										Kembali
									</div>
								</a>

							<?php }?>
						</div>
					</div>
					<section class="boxs boxs-simple">
						<div class="boxs-body p-0">
							<div role="tabpanel">
								<ul class="nav nav-tabs tabs-dark-t" role="tablist">
									<li role="presentation">
										<a href="#setting" role="tab" data-toggle="tab">Akun</a>
									</li>
									<li role="presentation">
										<a href="#tentang" role="tab" data-toggle="tab">Data Akun</a>
									</li>
									<li role="presentation">
										<a href="#dokumennya" role="tab" data-toggle="tab">Dokumen</a>
									</li>
									<?php if ($Level == 1) {?>
										<li role="presentation">
											<a href="#change" role="tab" data-toggle="tab">Setting</a>
										</li>
									<?php }?>
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
															<label for="username">Username</label>
															<input type="text" class="form-control" id="username" value="<?=$nama;?>" name="username" readonly>
														</div>
														<div class="form-group col-sm-4">
															<label for="password">Level</label>
															<input type="text" class="form-control" id="level" name="level" value="<?=$NamaLevelNya;?>" readonly>
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password">Login Terakhir</label>
															<input type="text" value="<?=$Login;?>" class="form-control" id="log" name="log" readonly/>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Logout Terakhir</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Out;?>">
														</div>
														<div class="form-group col-sm-4">
															<label for="new-password-repeat">Status Akun</label>
															<input type="text" class="form-control" id="new-password-repeat" value="<?=$Status == 1 ? 'Aktif' : 'Tidak Aktif';?>">
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
																<strong>Data</strong> Akun</h4>
															</div>
														</div>
														<?php if($DataID != $idNya){?>
															<div class="row">
																<?=$alert;?>
															</div>
														<?php }else{?>
															<div class="row">
																<div class="form-group col-sm-4">
																	<label for="username">Nama Lengkap</label>
																	<input type="text" class="form-control" id="username" value="<?=$NamaLengkap;?>" name="username"/>
																</div>
																<div class="form-group col-sm-4">
																	<label for="password">Nomor Telphone</label>
																	<input type="number" class="form-control" id="nomor" name="nomor" value="<?=$Nomor;?>"/>
																</div>
																<div class="form-group col-sm-4">
																	<label for="password">Nomor WA</label>
																	<input type="number" class="form-control" id="nomorWA" name="nomorWA" value="<?=$nomorDarurat;?>"/>
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-4">
																	<label for="new-password">Email</label>
																	<input type="text" value="<?=$Email;?>" class="form-control" id="email" name="email" readonly/>
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Alamat</label>
																	<input type="text" class="form-control" id="alamat" name="alamat" value="<?=$Alamat;?>"readonly/>
																</div>
																<div class="form-group col-sm-4">
																	<label for="new-password-repeat">Tanggal Lahir</label>
																	<input type="date" class="form-control" id="Tgl" name="Tgl" value="<?=$TanggalLahir;?>" readonly/>
																</div>
															</div>
														<?php }?>
													</form>
												</div>
											</div>

											<div role="tabpanel" class="tab-pane" id="dokumennya">
												<div class="wrap-reset">
													<form class="profile-dokumennya">
														<div class="row">
															<div class="form-group col-md-12 legend">
																<h4>
																	<strong>Dokumen</strong> Anda Bapak/Ibu <strong><?=$nama;?></strong></h4>
																	<p class="text-warning">Jika Ingin Melihat file, Anda dapat klik pada file yang ingin dilihat</p>
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-12">
																	<?php if($DataID != $idNya){?>
																		<div class="row">
																			<?=$alertDokumen;?>
																		</div>
																	<?php }else{?>
																		<div class="row">
																			<div class="form-group col-sm-4">
																				<label for="new-password">File KTP</label>
																				<?php if ($ktp != '') {?>
																					<a target="_blank" href="<?=base_url().'image/dokumen/'.$ktp;?>"><span class="form-control"><?=$ktp;?></span></a>
																				<?php }else{ echo"<label class='text-danger form-control'>File Tidak Ada</a>";}?>
																			</div>
																			<div class="form-group col-sm-4">
																				<label for="new-password">File KK</label>
																				<?php if ($kk != '') {?>
																					<a target="_blank" href="<?=base_url().'image/dokumen/'.$kk;?>"><span class="form-control"><?=$kk;?></span></a>
																				<?php }else{ echo"<label class='text-danger form-control'>File Tidak Ada</a>";}?>
																			</div>
																			<div class="form-group col-sm-4">
																				<label for="new-password">File Pasport</label>
																				<?php if ($pasport != '') {?>
																					<a target="_blank" href="<?=base_url().'image/dokumen/'.$pasport;?>"><span class="form-control"><?=$pasport;?></span></a>
																				<?php }else{ echo"<label class='text-danger form-control'>File Tidak Ada</a>";}?>
																			</div>
																			<div class="form-group col-sm-4">
																				<label for="new-password">File Buku Nikah</label>
																				<?php if($buku_nikah != ''){?>
																					<a target="_blank" href="<?=base_url().'image/dokumen/'.$buku_nikah;?>"><span class="form-control"><?=$buku_nikah;?></span></a>
																				<?php }else{ echo"<label class='text-danger form-control'>File Tidak Ada</a>";}?>

																			</div>
																			<div class="form-group col-sm-4">
																				<label for="new-password">File Foto Anda</label>
																				<?php if($foto != ''){?>
																					<a target="_blank" href="<?=base_url().'image/dokumen/'.$foto;?>"><span class="form-control"><?=$foto;?></span></a>
																				<?php }else{ echo"<label class='text-danger form-control'>File Tidak Ada</a>";}?>
																			</div>
																		</div>
																	<?php }?>
																</div>
															</div>
														</form>
													</div>
												</div>

												<div role="tabpanel" class="tab-pane" id="change">
													<div class="wrap-reset">
														<div class="row">
															<div class="form-group col-md-12 legend">
																<h4>
																	<strong>Form</strong> Ubah Data </h4>
																</div>
															</div>
															<div class="row">
																<div class="form-group col-sm-12">
																	<button class="btn btn-raised btn-default" data-toggle="modal" data-target="#DataAkun">Ubah Data Akun</button>
																	<button class="btn btn-raised btn-default" data-toggle="modal" data-target="#DataAkunLanjut">Ubah Data Akun Lanjutan</button>
																	<button class="btn btn-raised btn-default" data-toggle="modal" data-target="#DataAkunDokumen">Ubah Data Dokumen</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</section>
								<form action="" method="post" id="UbahDataSistem">
									<div class="modal fade" id="DataAkun" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Form Ubah</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-sm-6">
															<label for="username">Username</label>
															<input type="hidden" id="id" class="IDNy" value="<?=$idNya;?>" name="id"/>
															<input type="text" class="form-control" id="username" value="<?=$nama;?>" name="username"/>
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Password Lama</label>
															<input type="password" class="form-control" id="PL" name="PL" />
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Password Baru</label>
															<input type="password" class="form-control" id="PB" name="PB"/>
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Konfirmasi Password Baru</label>
															<input type="password" class="form-control" id="KPB" name="KPB"/>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" id="SimpanUbahDataSistem" class="btn btn-success">Simpan</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- DataAkunLanjut -->
								<form action="" method="post" id="UbahDataSistemLanjutan">
									<div class="modal fade" id="DataAkunLanjut" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Form Ubah Data Akun Lanjutan</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-sm-6">
															<label for="username">Nama Lengkap</label>
															<input type="hidden" id="idNya"  value="<?=$idNya;?>" name="idNya"/>
															<input type="hidden" id="id" class="id" value="<?=$DataAkses;?>" name="id"/>
															<input type="text" class="form-control" id="namaLengkap" value="<?=$NamaLengkap;?>" name="namaLengkap"/>
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Nomor Telephone</label>
															<input type="number" class="form-control" id="nomor" name="nomor" value="<?=$Nomor;?>" />
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Nomor WA</label>
															<input type="number" value="<?=$nomorWA;?>" class="form-control" id="nomorWA" name="nomorWA"/>
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Nomor Darurat</label>
															<input type="number" value="<?=$nomorDarurat;?>" class="form-control" id="nomorDarurat" name="nomorDarurat"/>
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Emails</label>
															<input type="text" value="<?=$email;?>" class="form-control" id="email" name="email" value="Email Anda..!"/>
														</div>

														<div class="form-group col-sm-6">
															<label for="password">Alamat</label>
															<input type="text" class="form-control" id="alamat" name="alamat" value="<?=$Alamat;?>" />
														</div>
														<div class="form-group col-sm-6">
															<label for="password">Tanggal Lahir</label>
															<input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir" value="<?=$TanggalLahir;?>" />
														</div>
														<div class="form-group col-sm-12">
															<label for="password">Tempat Lahir</label>
															<input type="text" class="form-control" id="TempatLahir" name="TempatLahir" value="<?=$TempatLahir;?>" />
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" id="SimpanUbahData" class="btn btn-success">Ubah Data</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- akhir DataAkunLanjut -->

								<!-- File -->
								<form action="" method="post" id="UbahDataSistemDokumen">
									<div class="modal fade" id="DataAkunDokumen" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Form Ubah Data Dokumen</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="form-group col-sm-12">
															<label for="username">Foto</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="<?=$foto;?>" id="foto" name="foto">
															<input type="hidden" id="id" class="id" value="<?=$IdFile;?>" name="id"/>
															<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
														</div>
														<div class="form-group col-sm-12">
															<label for="username">KTP</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="<?=$ktp;?>" id="ktp" name="ktp">
															<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
														</div>
														<div class="form-group col-sm-12">
															<label for="username">KK</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="<?=$kk;?>" id="kk" name="kk">
															<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
														</div>
														<div class="form-group col-sm-12">
															<label for="username">Pasport</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="<?=$pasport;?>" id="Pasport" name="Pasport">
															<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
														</div>
														<div class="form-group col-sm-12">
															<label for="username">Buku Nikah</label>
															<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" value="<?=$buku_nikah;?>" id="buku_nikah" name="buku_nikah">
															<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
														</div>

													</div>
													<hr class="line-dashed full-witdh-line" />
													<div class="modal-footer">
														<button type="submit" id="SimpanUbahData" class="btn btn-success">Ubah Data</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
				<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
				<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
				<script>
					$('#UbahDataSistem').on('submit', function (e) {
						e.preventDefault();
						var base_url 	= "<?php echo base_url();?>";
						var UbahDataSistem = $(this);
						$.ajax({
							type: "POST",
							url: base_url + 'data/profile/simpanPerubahanDataAkun',
							data: UbahDataSistem.serialize(),
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
										window.location.href = base_url + 'data/profile/info/'+<?=$idNya;?>;
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

					$('#UbahDataSistemLanjutan').on('submit', function (e) {
						e.preventDefault();
						var base_url 	= "<?php echo base_url();?>";
						var UbahDataSistemLanjutan = $(this);
						$.ajax({
							type: "POST",
							url: base_url + 'data/profile/simpanPerubahanDataAkunLanjnutan',
							data: UbahDataSistemLanjutan.serialize(),
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
										window.location.href = base_url + 'data/profile/info/'+<?=$idNya;?>;
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

					$('#UbahDataSistemDokumen').submit(function(e){
						e.preventDefault(); 
						var base_url 	= "<?php echo base_url();?>";
						$.ajax({
							url: base_url + 'data/profile/UploadDokumen',
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
										window.location.href = base_url + 'data/profile/info/'+<?=$idNya;?>;
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




