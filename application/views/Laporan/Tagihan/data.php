<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-12">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Data Pembayaran</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<section class="boxs ">
						<div class="boxs-header">
							<h3 class="custom-font hb-cyan">
								<strong>Daftar Data Pembayaran</strong></h3>
							</div>
							<a href="<?=base_url().'home';?>" class="btn btn-raised btn-primary">Kembali
							</a>
							<a title="Cetak" href="<?=base_url().'data/Laporan/CetakTagihan?date1='.$date1.'&date2='.$date2.'';?>" class="btn btn-raised btn-success "> <i class="fa fa-print"></i></a>
							<div class="boxs-body">
								<div class="table-responsive">
									<table id="datatable" class="display" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Nomor Tagihan</th>
												<th>Nama Pelanggan</th>
												<th>Harga Bayar</th>
												<th>Jumlah Bayar</th>
												<th>Status</th>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nomor Tagihan</th>
													<th>Nama Pelanggan</th>
													<th>Harga Bayar</th>
													<th>Jumlah Bayar</th>
													<th>Status</th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$no = 1;
												foreach ($paket->result_array() as $key ) {
													$JumlahBayar = $this->db->select('sum(jumlah) AS Total')->get_where('tb_detail_tagihan',array('id_detail_tagihan'=>$key['nomor_tagihan']))->row_array();
													$PelanggnaPembeli = $this->db->join('tb_pelanggan','tb_pelanggan.id=tb_pemasanan_paket.id_pelanggan')->get_where('tb_pemasanan_paket',array('id_pemesanan'=>$key['kode_pemesanan']))->row_array();

													echo "
													<tr>
													<td>".$no++."</td>
													<td>
													".($key['nomor_tagihan'] != '' ? ''.$key['nomor_tagihan'].'' : 'Tidak Diketahu')."</td>
													<td>".($PelanggnaPembeli['id'] != '' ? ''.$PelanggnaPembeli['nama_lengkap'].'' : 'Tidak Diketahu')."</td>
													<td>Rp. ".number_format($key['nominal'],2,',','.')."</td>
													<td>Rp. ".number_format($JumlahBayar['Total'],2,',','.')."</td>
													<td>".($JumlahBayar['Total'] == $key['nominal'] ? 'selesai' : 'Belum')."</td>
													</tr>";
												}

												?>
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$('#datatable').DataTable();
	
</script>