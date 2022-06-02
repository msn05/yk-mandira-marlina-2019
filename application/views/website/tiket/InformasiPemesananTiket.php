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

						<div class="form_title">
							<h3><strong><i class="icon-users"></i></strong>Akun Login</h3>
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
											Kode Pemesanan <?=$id_pesan_tiket_data;?>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<strong>Nama Maksapai</strong>
										</td>
										<td>
											<?=$nama_maskapai.'-'.$kode_penerbangan;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Tanggal Berangkat</strong>
										</td>
										<td>
											<?=$hari.','.date('d-F-Y',strtotime($waktu_berangkat)).' '.$waktu_berangkat;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Dari / Bandara </strong>
										</td>
										<td>
											<?=$form.' / '.$bandara2;?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Tujuan / Bandara </strong>
										</td>
										<td>
											<?=$to.' / '.$bandara1;?>
										</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<table class="table table-striped" >
								<thead>
									<tr>
										<th colspan="3">
											Informasi Pemesanan 
										</th>
									</tr>
								</thead>
								<thead>
									<tr>
										<th>
											<strong>Tipe Data </strong>
										</th>
										<th>
											<strong>Jumlah </strong>
										</th>
										<th>
											<strong>Harga </strong>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<?=$level == 1 ? 'Anak-anak' : 'Dewasa';?>
										</td>
										<td>
											<?=$jumlah. ' Tiket';?>
										</td>
										<td>
											Rp. <?=number_format($harga);?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="form_title">
							<h3><strong><i class="icon-money"></i></strong>Pembayaran</h3>
						</div>
						<div class="step">
							<table class="table table-striped">
								<thead>
									<th colspan="2"> Metode Pembayaran</th>
								</thead>
								<tbody>
									<thead>
										<tr>
											<th>NO</th>
											<th>
												<strong>Cara Pembayaran</strong>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										$Pembayaran = $this->db->join('tb_keterangan_metode_pembayaran','tb_keterangan_metode_pembayaran.id_metode_pembayaran=db_metode_pembayaran.id_metode_pembayaran')->get_where('db_metode_pembayaran',array('db_metode_pembayaran.metode'=>'cash'));
										foreach ($Pembayaran->result() as $key =>$val ) {
											?>
											<tr>
												<td>
													<strong><?=$no++;?></strong>
												</td>
												<td>
													<?=$val->keterangan;?>
												</td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div>

				<!--End col -->
				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">- Note  -</h3>
						<div class="col-lg-12 add_bottom_15">
							<label>Silakan Lakukan Pembayaran Untuk Mendapatkan Tiket Ke nomor rekening pada step pembayaran yang tersedia </label>
							<hr>
						</div>
						<a href="<?=base_url().'welcome/tiket';?>" id="fa fa-back" class='btn btn-warning'>Kembali</a>
						<a href="<?=base_url().'login';?>" id="fa fa-back" class='btn btn-success'>Login</a>
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