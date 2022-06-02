<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Hotel Travel</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<section class="boxs">
			<div class="boxs-header bg-green">
				<h3 class="custom-font">
					<strong>Form Tambah Hotel Travel</strong></h3>
				</div>
				<form method="POST" id="DataNya"  >
					<div class="boxs-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="text" name="kode" value="<?=$kode_hotel;?>" class="form-control" id="kode"  readonly="">
										<span class="input-group-addon">
											<span class="fa fa-code"></span>
										</span>
									</div>
									<span class="text-danger text-center">Harap isi Dengan Angka..!</span>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="text" name="nama" class="form-control" value="<?=$nama_hotel;?>" id="nama" placeholder="Nama Hotel" autocomplete="off">
										<span class="input-group-addon">
											<span class="fa fa-home"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi Nama Hotel nya...!</small>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="number" name="harga" value="<?=$harga;?>" class="form-control" id="harga" autocomplete="off">
										<span class="input-group-addon">
											<span class="fa fa-home"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Harga nya...!</small>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="text" name="negara"  value="<?=$negara;?>" class="form-control" id="negara" autocomplete="off" placeholder="Nama Negara">
										<span class="input-group-addon">
											<span class="fa fa-globe"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi Nama Negara...!</small>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="text" name="prov" value="<?=$provinsi;?>" class="form-control" id="prov" autocomplete="off" placeholder="Nama Provinsi">
										<span class="input-group-addon">
											<span class="fa fa-globe"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi Nama Provinsi...!</small>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<input type="text" name="kota" value="<?=$kota;?>" class="form-control" id="kota" autocomplete="off" placeholder="Nama Kota">
										<span class="input-group-addon">
											<span class="fa fa-globe"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi Nama Kota...!</small>
								</div>
								<div class="form-group col-sm-4">
									<div class="input-group">
										<textarea  rows="5" name="alamat" class="form-control" id="alamat" autocomplete="off" placeholder="Alamat Kota">
											<?=$alamat;?></textarea>
											<span class="input-group-addon">
												<span class="fa fa-map-marker"></span>
											</span>
										</div>
										<small class="text-danger">* Harap Diisi Lokasi Hotel...!</small>
									</div>
									<div class="form-group col-sm-4">
										<div class="input-group">
											<input type="number" name="nomor_telp" value="<?=$nomor_telphone;?>" class="form-control" id="nomor_telp" autocomplete="off" placeholder="Nomor Telephone">
											<span class="input-group-addon">
												<span class="fa fa-phone"></span>
											</span>
										</div>
										<small class="text-danger">* Harap Diisi Nomor Telphone Hotel...!</small>
									</div>
									<div class="form-group col-sm-4">
										<div class="input-group">
											<input type="text" name="email" value="<?=$email;?>" class="form-control" id="email" autocomplete="off" placeholder="Email Hotels">
											<span class="input-group-addon">
												<span class="fa fa-envelope"></span>
											</span>
										</div>
										<small class="text-danger">* Harap Diisi Email Hotel...!</small>
									</div>
								</div>
								<hr class="line-dashed full-witdh-line" />
								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-10">
										<a href="<?=base_url().'data/hotel/travel';?>">
											<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
										</a>
									</div>
								</div>
							</div>
						</form>
					</section>
				</div>
			</section>
			<script>

				$('#DataNya').on('submit', function (e) {
					e.preventDefault();
					var base_url = "<?php echo base_url();?>";
					var DataNya = $(this);
					$.ajax({
						type: "POST",
						url: base_url + 'data/hotel/simpanLagi',
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
									window.location.href = base_url + 'data/hotel/travel';
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