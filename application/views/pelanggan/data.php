			<div class="col-md-8">
				<div class="row">
					<div class="col-sm-12">
						<section class="boxs">
							<div class="boxs-header bg-blush">
								<h3 class="custom-font">
									<strong>Informasi Pelanggan yang dipilih</strong></h3>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<table  class="table col-sm-12" >
											<tr>
												<th>Nomor KTP</th>
												<td><?=$pelangganNya['no_ktp'];?></td>
											</tr>
											<tr>
												<th>Nomor KK</th>
												<td><?=$pelangganNya['no_kk'];?></td>
											</tr>
											<tr>
												<th>Nomor Telephone</th>
												<td><?=$pelangganNya['nomor_telphone'];?></td>
											</tr>
											<tr>
												<th>Jenis Kelamin</th>
												<td><?=$pelangganNya['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan';?></td>
											</tr>
											<tr>
												<th>Pekerjaan</th>
												<td><?=$pelangganNya['pekerjaan'] == 1 ? 'PNS' : ($pelangganNya['pekerjaan'] == 2 ? 'SWASTA' : ($pelangganNya['pekerjaan'] == 3 ? 'BUMN' : ($pelangganNya['pekerjaan'] == 4 ? 'BURUH' : 'Tidak Bekerja')));?></td>
											</tr>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
