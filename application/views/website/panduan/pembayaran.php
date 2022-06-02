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
							<h3><strong><i class="icon-ok"></i></strong>Tata Cara Pendaftaran</h3>
						</div>
						<div class="step">
							<?=$variable['keterangan'];?>
						</div>
						
						<div class="form_title">
							<h3><strong><i class="icon-ok"></i></strong>Tata Cara Pendaftaran </h3>
						</div>
						<div class="step">
							<?=$variable1['keterangan'];?>
						</div>
						<div class="form_title">
							<?php 
							$Metodes= $this->db->select('id_metode_pembayaran,metode')->get('db_metode_pembayaran');
							?>
							<h3><strong><i class="icon-ok"></i></strong>Metode Pembayaran dapat dilakukan dengan 2 Cara</h3>
						</div>
						<div class="step">
							<?php 
							foreach ($Metodes->result_array() as $keys) {
								?>
								<table class="table table-striped confirm">
									<thead>
										<tr>
											<th colspan="2">
												Metode Pembayaran <?=$keys['metode'];?>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$MetodeNya = $this->db->get_where('tb_keterangan_metode_pembayaran',array('id_metode_pembayaran'=>$keys['id_metode_pembayaran']));
										foreach ($MetodeNya->result() as $key => $value) {?>
											<tr>
												<td>
													<strong>Keterangan</strong>
												</td>
												<td>
													<?=$value->keterangan;?>
												</td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							<?php }?>
						</div>



					</div>
				</div>
				<!--End step -->
			</div>

			<!--End col -->
			<aside class="col-lg-4">
				<div class="box_style_1">
					<h3 class="inner">- Informasi  -</h3>
					<div class="col-lg-12 add_bottom_15">
						<h3 class="text-danger"> * NOTE </h3>
						<hr>
						<p>Halaman ini berisikan informasi tata cara pendafatarn layanan umroh dan haji</p>
					</div>
				</aside>

			</div>
			<!--End row -->
		</div>

	</main>
