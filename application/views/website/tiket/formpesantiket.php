<section id="hero_2">
	<div class="intro_title">
		<h1>Halaman Order </h1>
	</div>
</section>
<main>
	
	<div class="container margin_60">
		<div class="row">
			<form id="PesanWithRegis" method="post">
				<div class="box_style_1">
					<h3 class="inner">- Regis dan Daftar -</h3>
					<div class="col-lg-12 add_bottom_15">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="hidden" class="form-control" id="id" name="id" value="<?=$dataPek;?>" autocomplete="off" >
									<input type="hidden" class="form-control" id="jasa" name="jasa" value="<?=$X;?>" autocomplete="off" >
									<input type="text" class="form-control" id="namaLengkap" name="namaLengkap" autocomplete="off" placeholder="ex : Nama Saya">
									<small class="text-danger">* Wajib</small>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nomor KTP</label>
									<input type="number" class="form-control" id="no_ktp" name="no_ktp" placeholder="Nomor KTP  ex:1234567890123456">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nomor KK</label>
									<input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor KK  ex:1234567890123456">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select class="form-control" name="jks" id="jks">
										<option value="0" selected>Pilih</option>
										<option value="1">Laki laki</option>
										<option value="2">Perempuan</option>
									</select>
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label>Nomor Telphone</label>
									<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telphone  ex:12345678901234">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Nomor WA</label>
									<input type="number" class="form-control" id="nowat" name="nowat" placeholder="Nomor WA  ex:12345678901234">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Email</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Email anda  ex:saya@gmail.com">
									<small class="text-danger">* Wajib Format Emails </small>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Tempat Lahir  ex:palembang">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir  ex:12-12-2020">
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Alamat</label>
									<textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Anda"></textarea>
									<small class="text-danger">* Wajib</small>

								</div>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col-lg-12">
								<button type="submit" class="btn_1 green medium">Registrasi dan Pesan</button>
								<a href="<?=base_url().'welcome/urmoh';?>" class='btn_1 yellow medium'> Kembali</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			<aside class="col-lg-4">
				<div class="box_style_1">
					<h3 class="inner">- Pesan dengan Akun  -</h3>
					<form id="PesanNotRegis" method="post">
						<div class="col-lg-12 add_bottom_15">
							<div class="form-group">
								<label>Kode Login</label>
								<input type="hidden" class="form-control" id="id" name="id" value="<?=$dataPek;?>" autocomplete="off" >
								<input type="hidden" class="form-control" id="jasa" name="jasa" value="<?=$X;?>" autocomplete="off" >
								<input type="number" class="form-control" id="id_akses" name="id_akses" autocomplete="off" >
								<small class="text-danger">* Wajib</small>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="number" class="form-control" id="password" name="password" autocomplete="off" >
								<small class="text-danger">* Wajib</small>
							</div>

							<hr>
							<button type="submit" class="btn_1 green medium">Pesan</button>
						</form>
					</div>

				</aside>
			</main>
			<script type="text/javascript">
				$('#PesanWithRegis').on('submit', function (e) {
					e.preventDefault();
					var base_url = "<?php echo base_url();?>";
					var PesanWithRegis = $(this);
					$.ajax({
						url: base_url + 'data/PelangganPesan/simpanPesananTiket',
						type:"POST",
						data: PesanWithRegis.serialize(),
						dataType: "JSON",
						cache : "false",
						success: function (respone) {
							if (respone.status == 'success') {
								swal({
									type: 'success',
									title: respone.status,
									text: respone.message,
								},
								function () {
									window.location.href = base_url + 'data/PelangganPesan/UploadDokumenTiket?idData='+respone.kode+'&DataId='+respone.idDataNya+'&idJasa='+respone.idJasa;
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

				$('#PesanNotRegis').on('submit', function (e) {
					e.preventDefault();
					var base_url = "<?php echo base_url();?>";
					var PesanNotRegis  = $(this);
					$.ajax({
						type: "POST",
						url: base_url + 'data/PelangganPesan/ProsesPesanTanpaRegisTiket',
						data: PesanNotRegis.serialize(),
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
								})
							}
						}
					});
				});

			</script>
