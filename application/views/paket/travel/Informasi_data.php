<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="pull-right">
				<a href="travel" title="kembali" class="btn btn-success btn-raised">Kembali</a>
			</div>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Informasi Paket </h1>
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
										<strong>Daftar Informasi Paket <?=$nama_layanan;?> <?=$namaPaket;?></strong>
										<p>
											Jumlah Pelanggan Sebanyak <i class="text-danger"><?=$JumlahPelanggan;?></i> Orang
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
												<td>Tanggal Berakhir</td>
												<td> : </td>
												<td><?=$tanggalAkhir;?></td>
											</tr>
											<tr>
												<td>Tanggal Berangkat</td>
												<td> : </td>
												<td><b>
													<?php if ($TanggalBerangkat != '') {?>
														<?=format_indo($TanggalBerangkat);?>
													<?php }else{ echo "<td> Belum Ada </td>";}?>
												</b></td>
											</tr>
										</table>
									</div>
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
		</div>
	</section>
	<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'catatan',{
			height: 200,
			toolbar:[
			],
		});
	</script>
<!-- <script>
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
-->

