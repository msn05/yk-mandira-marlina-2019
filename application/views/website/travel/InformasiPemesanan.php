<section id="hero_2">
	<div class="intro_title">
		<h1>Thank You </h1>
	</div>
</section>
<main>
	<div class="container margin_60">
		<div class="row">
			<div class="col-lg-8">
				<div class="box_style_1">
					<div class="col-lg-12 add_bottom_15">
						<div class="form_title">
							<h3><strong><i class="icon-ok"></i></strong>Thank you! </h3>
						</div>
						<div class="step">
							<p>
								Terima Kasih Bapak / Ibu atas nama <b><?=$nama_lengkap;?></b> dengan nomor KTP </b><?=$no_ktp;?></b>
							</p>
						</div>
						<!--End step -->

						<div class="form_title">
							<h3><strong><i class="icon-tag-1"></i></strong>Akun Login</h3>
						</div>
						<div class="step">
							<table class="table table-striped confirm">
								<thead>
								</thead>
								<tbody>
									<tr>
										<td>
											<strong>Kode Login</strong>
										</td>
										<td>
											<?=$id_akses_data;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Password</strong>
										</td>
										<td>
											123456
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="form_title">
							<h3><strong><i class="icon-tag-1"></i></strong>Booking</h3>
						</div>
						<div class="step">
							<table class="table table-striped confirm">
								<thead>
									<tr>
										<th colspan="2">
											Kode Pemesanan <?=$KodePesan;?>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<strong>Nama Layanan Paket</strong>
										</td>
										<td>
											<?=$namaLayanan.'-'.$kodePaket.'-'.$id_paket;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Tanggal Pesan</strong>
										</td>
										<td>
											<?=$tanggal_pesan;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Harga Layanan</strong>
										</td>
										<td>
											Rp. <?=number_format($harga);?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--End step -->
			</div>

			<!--End col -->
			<aside class="col-lg-4">
				<div class="box_style_1">
					<h3 class="inner">- Login  -</h3>
					<form id="DataNya" method="post">
						<div class="col-lg-12 add_bottom_15">
							<div class="form-group">
								<label>Kode Login</label>
								<input type="number" class="form-control" id="id_akses" name="id_akses" autocomplete="off" >
								<small class="text-danger">* Wajib</small>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="number" class="form-control" id="password" name="password" autocomplete="off" >
								<small class="text-danger">* Wajib</small>
							</div>
							<hr>
							<button type="submit" class="btn_1 green medium">Login</button>
						</form>
					</div>

				</aside>

			</div>
			<!--End row -->
		</div>

	</main>
	<script type="text/javascript">
		
		$('#DataNya').on('submit', function (e) {
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var DataNya  = $(this);
			$.ajax({
				type: "POST",
				url: base_url + 'login/ProsesMasuk',
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
							window.location.href = base_url + 'home';
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