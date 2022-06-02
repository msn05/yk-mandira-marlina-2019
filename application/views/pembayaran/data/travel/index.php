<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-12">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Data Pembayaran</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
				<div class="row">
					<div class="col-md-12">
						<section class="boxs ">
							<div class="boxs-header">
								<h3 class="custom-font hb-cyan">
									<strong>Daftar Data Pembayaran</strong></h3>

								</div>
								<div class="boxs-body">
									<div class="table-responsive">
										<table id="datatable" class="display" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Nomor Tagihan</th>
													<th>Harga Bayar</th>
													<th>Jumlah Bayar</th>
													<th>Status</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nomor Tagihan</th>
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
													echo "
													<tr>
													<td>".$no++."</td>
													<td>
													".$key['nomor_tagihan']."</td>
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