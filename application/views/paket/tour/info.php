<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Info Paket Tour </h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<section class="boxs ">
					<div class="boxs-body">
						<div class="row">
							<div class="col-md-12">
								<div class="boxs-header">
									<h3 class="custom-font hb-cyan">
										<strong>Daftar Informasi Paket Tour <?=$namaLayanan;?> <?=$namaPaket;?></strong>
										<p>
											Jumlah Pelanggan Sebanyak <i class="text-danger"><?=$JumlahPelanggan;?></i> Orang
											<br>
											<p>
												
											</p>
											<strong>Tujuan</strong>><?=$Tujuan;?>
											<br>
											<strong>Dari</strong>><?=$Dari;?>
										</p>
									</h3>
									<div class="pull-right">
										<table border="0" class="table">
											<tr >
												<td>Tanggal Dibuat</td> 	
												<td>:</td> 
												<td><?=$tanggalAwal;?></td>
											</tr>
											<tr>
												<td>Tanggal Berakhir Paket</td>
												<td> : </td>
												<td><?=$tanggalAkhir;?></td>
											</tr>
											<tr>
												<td>Tanggal Berangkat Paket</td>
												<td> : </td>
												<td><b>
													<?php if ($TanggalBerangkat != '0000-00-00 00:00:00' ) {?>
														<?=format_indo($TanggalBerangkat);?>
													<?php }else{?> Belum Ada <?php }?>
												</b></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="b-b mb-10">
							<div class="row">
								<h4 class="h3 m-0 text-center text-danger">Informasi Paket </h4>
							</div>
						</div>
						<div class="row ">
							<div class="col-sm-12">
								<div class="form-group col-sm-6">
									<div class="pull-left">
										<i class="fa fa-plane fa-5x"></i>
									</div>
									<div class="pull-left ml-10 ">
										<?php if ($nomor != NULL) {?>
											<?php if($nomor != $idPS){?>
												<?=$NULL;?>
											<?php }else{?>
												<address>
													<?=$KodePenerbangan;?>
													<br>
													<strong><?=$NamaMaskapai;?></strong>
												</address>
											<?php }?>
										<?php }else{?>
											<?=$alert;?>
										<?php }?>
									</div>
								</div>
								<div class="form-group col-sm-6">
									<div class="pull-left">
										<i class="fa fa-bus fa-5x"></i>
									</div>
									<div class="pull-left ml-10 ">
										<?php if ($KodeBus == NULL) {?>
											<?=$alert;?>
										<?php }else{?>
											<?php if ($KodeBus != $Tpd) {
												echo "".$NULL."";
											}else{ ?>
												<address>
													<?=$KodeBus;?>
													<br>
													<strong><?=$NamaBus;?></strong>
												</address>
											<?php }?>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="mt-40"></div>
						<div class="b-b mb-10">
							<div class="row">
								<h4 class="h3 m-0 text-center text-danger">Informasi Hotel </h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table mt-20">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Hotel</th>
												<th>Alamat</th>
												<th>Keterangan</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama Hotel</th>
												<th>Alamat</th>
												<th>Keterangan</th>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$i = 1;
											foreach ($DataHotel as $value ) {
												$C = $value->kode_hotel;
												$F = $value->nama_hotel;
												$A = $value->alamat;
												$D = $value->negara;
												$n = $value->provinsi;
												$k = $value->kota;

												$Pecah		= explode(',', $idHotel);
												$CH 					= $Pecah;
												?>
												<tr>
													<?php
													if(in_array($C, $CH)){	
														echo "
														<td>".$i++."</td>
														<td>".$F."</td>
														<td>".$A."</td>
														<td>".$D. ' / ' .$n. ' / '. $k."</td>
														";
													}?>
												</tr>
												<?php 
											}?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="form-group col-md-12">
								<div class="col-md-6">
									<div class="b-b mb-10">
										<div class="row">
											<h4 class="h3 m-0 text-center text-danger">Informasi Pembayaran </h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table mt-20">
													<thead>
														<tr>
															<th>#</th>
															<th>Cara Pembayaran</th>
															<th>Keterangan</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>#</th>
															<th>Cara Pembayaran</th>
															<th>Keterangan</th>
														</tr>
													</tfoot>
													<tbody>
														<?php $no=1;
														foreach ($DataPembayaran as $key) {?>
															<tr>
																<td><?=$no++;?></td>
																<td><?=$key->nama_pembayaran;?></td>
																<td><?=$key->keterangan;?></td>
															</tr>
														<?php }?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="b-b mb-10">
										<div class="row">
											<h4 class="h3 m-0 text-center text-danger">Informasi Perlengkapan </h4>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table mt-20">
													<thead>
														<tr>
															<th>#</th>
															<th>Nama Barang</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>#</th>
															<th>Nama Barang</th>
														</tr>
													</tfoot>
													<tbody>
														<?php 
														if ($KodeBarang == NULL) {?>
															<tr class="text-center">
																<td colspan="4"><?=$alert;?></td>
															</tr>
														<?php }else{
															$no = 1;
															foreach ($Perlengkapan as $key ) {
																$idL 			= $key->id;
																$Status = $key->status;

																$Pecah		= explode(',', $KodeBarang);
																$C 					= $Pecah;
																?>
																<tr>
																	<?php
																	if(in_array($idL, $C)){	
																		echo "
																		<td>".$no++."</td>
																		<td>".$key->nama_barang."</td>
																		";
																	}?>
																</tr>
																<?php 
															}
														}?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="text-muted"> Berdasarakan informasi paket ini diberitahukan bahwa biaya keberangkatan paket ini sebesar <b><?=$Jumlah;?></b> <i>( <?=$Penyu;?> ribu rupiah ) / Orang</i></label>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="hidden-print">
									<div class="pull-right">
										<a href="javascript:window.print()" class="btn btn-raised btn-primary">
											<i class="fa fa-print"></i>
										</a>
										<a  href="travel" class="btn btn-raised btn-default">Kembali</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#datatable').DataTable();

		$('#DataNya').on('submit', function (e) {
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var DataNya = $(this);
			$.ajax({
				type: "POST",
				url: base_url + 'data/Metode_pembayaran/simpanKeterangan',
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
							location.reload(true);
						});
					}else{
						swal({
							type: 'error',
							title: respone.status,
							text: respone.message,
							timer: 1200,
						});
					}
				}
			});
		});

		$('#DataNyaUbah').on('submit', function (e) {
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var DataNyaUbah = $(this);
			$.ajax({
				type: "POST",
				url: base_url + 'data/Metode_pembayaran/simpanKeteranganEdit',
				data: DataNyaUbah.serialize(),
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
							location.reload(true);
						});
					}else{
						swal({
							type: 'error',
							title: respone.status,
							text: respone.message,
							timer: 1200,
						});
					}
				}
			});
		});

		$('#datatable').on('click','.Edit', function () {
			var id  		 = $(this).attr('id');
			var base_url = "<?php echo base_url();?>";
			$.ajax({
				url : 'AmbilKeterangan/'+id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('[name="id"]').val(data.id);
					$('[name="id_metode_pembayaran"]').val(data.id_metode_pembayaran);
					$('[name="Cara"]').val(data.nama_pembayaran);
					$('[name="keterangan"]').val(data.keterangan);
					$('#myModalEdit').modal('show');
				}
			});
		});

		$('#datatable').on('click','#Hapus', function () {
			var base_url = "<?php echo base_url();?>";
			var id  		 = $(this).attr('name');
			var namaNya  	 = $(this).attr('keterangan');
			swal({
				title: "Anda Yakin ingin Mengaktifkan ?",
				text: "Ada memilih data "+namaNya,
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Ya",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function (Komfirmasi) {
				if (Komfirmasi) {
					$.ajax({
						type: 'POST',
						url: 'HapusKeterangan?id='+id+'',
						dataType: "JSON",
						cache : false,
						success: function(respone) {
							if (respone.status == 'success') {
								swal({
									type: 'success',
									text: respone.message,
									title: respone.status,
									timer: 1200,
								},
								function () {
									location.reload(true);
								});
							}else{
								swal({
									type: 'error',
									text: respone.message,
									title: respone.status,
									timer: 1200,
								},
								function () {
									location.reload(true);
								});
							}
						}
					});
				} else {
					swal("Batal", "Batal :)", "error");
				}
			}
			);
		});
	});

</script>


