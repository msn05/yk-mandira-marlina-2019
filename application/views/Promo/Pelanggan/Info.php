<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="h3 m-0">Promo Paket</h1>
					<small class="text-muted">Welcome to </small>
					<div class="pull-right">
						<a href="<?=base_url().'data/promo/InfoPelanggan';?>">
							<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
						</a>
					</div>
				</div>
			</div>
			<section class="boxs">
				<div class="boxs-header bg-green">
					<h3 class="custom-font">
						<strong>Informasi Promo Paket</strong></h3>
					</div>
					<div class="boxs-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group col-sm-4">
									<label>Kode Promo</label>
									<input type="text" name="hargaPromo" id="hargaPromo" value="<?=$idFileData;?>" autocomplete="off" class="form-control" readonly="">
								</div>
								<div class="form-group col-sm-4">
									<label>Nama Layanan</label>
									<input type="text" name="hargaPromo" value="<?=$nama_layanan;?>" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
								<div class="form-group col-sm-4">
									<label>Kode Paket</label>
									<input type="text" name="hargaPromo" value="<?=$kode_paket_data;?>" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group col-sm-3">
									<label>Max  Pelanggan</label>
									<input type="text" name="hargaPromo" value="<?=$maxPelanggan;?>" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
								<div class="form-group col-sm-3">
									<label>Tanggal Berakhir</label>
									<input type="text" name="hargaPromo" value="<?=$tanggal_Berakhir;?>" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
								<div class="form-group col-sm-3">
									<label>Tanggal Berangkat</label>
									<input type="text" name="hargaPromo" value="<?=$tanggal_berangkat;?>" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
								<div class="form-group col-sm-3">
									<label>Lama Perjalanan</label>
									<input type="text" name="hargaPromo" value="<?=$lama_perjalanan;?> Hari" id="hargaPromo" autocomplete="off" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="boxs-body">
						<div class="b-b mb-10">
							<div class="row">
								<h4 class="h3 m-0 text-center text-danger">Informasi Paket </h4>
							</div>
						</div>
						<div class="row ">
							<div class="col-sm-12 ml-10">
								<div class="form-group col-sm-3">
									<div class="pull-left">
										<i class="fa fa-plane fa-3x"></i>
									</div>
									<div class="pull-left ml-10 ">
										<?php if ($idPenerbangan != NULL) {?>
											<address>
												<?=$kode_penerbangan;?>
												<br>
												<strong><?=$nama_maskapai;?></strong>
											</address>
										<?php }?>
									</div>
								</div>
								<div class="form-group col-sm-3">
									<div class="pull-left">
										<i class="fa fa-bus fa-3x"></i>
									</div>
									<div class="pull-left ml-10 ">
										<?php if ($id_transportasi_paket != NULL) {?>
											<address>
												<?=$kode_bus;?>
												<br>
												<strong><?=$nama_bus;?></strong>
											</address>
										<?php }?>
									</div>
								</div>
								<?php foreach ($namaHotel->result_array() as $key ) {?>
									<div class="form-group col-sm-3">
										<div class="pull-left">
											<i class="fa fa-home fa-3x"></i>
										</div>
										<div class="pull-left ml-10 ">
											<?php if ($key['id'] != NULL) {?>
												<address>
													<?=$key['kode_hotel'];?>
													<br>
													<strong><?=$key['nama_hotel'];?></strong>
												</address>
											<?php }?>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
						<hr>
						<div class="b-b mb-10">
							<div class="row">
								<h4 class="h3 m-0 text-center text-danger">Informasi Lainnya </h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table mt-20">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Barang</th>
												<th>Jumlah Barang yang didapatkan</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Barang</th>
												<th>Jumlah Barang yang didapatkan</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											if ($PaketKode != NULL) {
												$no = 1;
												foreach ($PerlengkapanPaket->result_array() as $key ) {
													echo "
													<tr>
													<td>".$no++."</td>
													<td>".$key['nama_barang']."</td>
													<td class='text-center'>".$key['JumlahBarangPelanggan']." Unit</td>
													</tr>
													";
												}
											}else{
												echo "<tr>
												<td colspan='3'>Kosong</td>
												</tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table mt-20">
										<thead>
											<tr>
												<th>#</th>
												<th>Metode</th>
												<th>Keterangan</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Metode</th>
												<th>Keterangan</th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$no = 1;
											foreach ($metodePembayaran->result_array() as $key ) {
												echo "
												<tr>
												<td>".$no++."</td>
												<td>".$key['metode']."</td>
												<td class='text-center'>".$key['keterangan']."</td>
												</tr>
												";
											}
											?>
										</tbody>
									</table>
								</div>


							</div>
						</div>
						<hr>
						<div class="b-b mb-10">
							<div class="row">
								<h4 class="h3 m-0 text-center text-danger">Catatan Paket </h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<textarea class="form-control" name="catatan"  id="catatan" ><?=$catatan;?></textarea>
							</div>
						</div>

					</div>
				</section>
			</div>
		</section>
