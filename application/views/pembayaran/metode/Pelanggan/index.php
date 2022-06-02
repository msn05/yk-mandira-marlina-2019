<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-12">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Metode Pembayaran</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<section class="boxs ">
						<div class="boxs-header">
							<h3 class="custom-font hb-cyan">
								<strong>Daftar Metode Pembayaran</strong></h3>
							</div>
							<div class="boxs-body">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<?php 
									$no = 1;
									$Pembayaran = $this->db->join('tb_keterangan_metode_pembayaran','tb_keterangan_metode_pembayaran.id_metode_pembayaran=db_metode_pembayaran.id_metode_pembayaran')->get_where('db_metode_pembayaran');
									foreach ($Pembayaran->result() as $key =>$val ) {
										?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingOne">
												<h4 class="panel-title">
													<a data-toggle="collapse"  aria-expanded="true"
													aria-controls="collapseOne"><?=$val->metode;?></a>
												</h4>
											</div>
											<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<p><?=$val->keterangan;?></p>
												</div>
											</div>
										</div>
									<?php }?>
								</div>
							</div>

						</section>
					</div>


					<div class="col-md-8">
						<section class="boxs ">
							<div class="boxs-header">
								<h3 class="custom-font hb-cyan">
									<strong>Daftar Support Bank</strong></h3>
								</div>
								<div class="boxs-body">
									<a class="show-image">
										<img class="d-block w-150" src="http://localhost/Ykmandira/image/logo/bri-logo.png" alt="" class="img-responsive">
									</a>
									<a class="show-image">
										<img class="d-block w-150" src="http://localhost/Ykmandira/image/logo/Bank-BCA-Vector-Logo-720x340.png" alt="" class="img-responsive">
									</a>
									<a class="show-image">
										<img class="d-block w-150" src="http://localhost/Ykmandira/image/logo/bni-logo.png" alt="" class="img-responsive">
									</a>

								</div>
								<hr>
								<div class="boxs-header">
									<h3 class="custom-font hb-cyan">
										<strong>Cara Pembayaran Tour and Travel Via Bank</strong></h3>
									</div>
									<div class="boxs-body">
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Step</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Datang Ke Banking Pilih anda,</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Lakukan Pembayaran Layanan yang dilakukan dengan mengisi kode keterangan pembayaran dengan layanan yang hendak dibayar</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Setelah pembayaran, maka dapat melakukan konfirmasi pemesanan melalui fitur chat anda. Tujuan nya untuk menginformasi terhadapat layanan yang di lakukan pemesanan segera di proses </td>
													</tr>
													<tr>
														<td>4</td>
														<td>Histori Pembayaran dapat dilihat dari keterangan pembayaran yang anda lakukan dengan mengklik nomor pembayaran</td>
													</tr>
												</tbody>
											</table>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
