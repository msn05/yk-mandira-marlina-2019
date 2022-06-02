<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Metode Pembayaran</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<section class="boxs ">
					<div class="boxs-header">
						<h3 class="custom-font hb-cyan">
							<strong>Daftar Metode Pembayaran <?=$nama_metode;?></strong>
						</h3>
						<div class="pull-right">
							<strong>Tanggal Dibuat : <?=date('d-m-Y',strtotime($tanggal));?></strong>
						</div>
					</div>
					<button data-toggle="modal" data-target="#myModal" class="btn btn-raised btn-primary">Tambah Keterangan</button>
					<a href="<?=base_url().'data/Metode_pembayaran';?>">
						<button class="btn btn-raised btn-info btn-round">Kembali</button>
					</a>
					<div class="boxs-body">
						<div class="table-responsive">
							<table id="datatable" class="table display" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Cara Pembayaran</th>
										<th>Keterangan</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Cara Pembayaran</th>
										<th>Keterangan</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									$no = 1;
									foreach ($DataNyaPembayaran->result() as $key) { 
										?>
										<tr>
											<td><?=$no++;?></td>
											<td><?=$key->nama_pembayaran;?></td>
											<td><?=$key->keterangan;?></td>
											<td>
												<button type="submit" id="Hapus" name="<?=$key->id;?>" class="btn btn-danger btn-raised btn-simple btn-xs"><i class="fa fa-trash-o" title="Hapus Data"></i></button>
												<a href="javascript:void(0)" keterangan="<?=$key->nama_pembayaran;?>" id="<?=$key->id;?>" class="Edit btn btn-warning btn-raised btn-simple btn-xs"><i class="fa fa-edit" title="Edit Data"></i>
												</a>
											</td>
										</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
			<div class="modal fade" id="myModal"" role="dialog">
				<div class="modal-dialog">
					<form method="POST" action="" id="DataNya">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Form Tambah Keterangan</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="caraPembayaran" class="form-control" id="caraPembayaran" placeholder="Cara Pembayaran" autocomplete="off">
										<span class="input-group-addon">
											<span class="fa fa-reorder"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi dengan huruf.....!</small>
								</div>
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" value="<?=$Kode;?>" name="kode" id="kode">
										<textarea rows="5" name="nama" class="form-control" id="nama" placeholder="Keterangan"></textarea>
										<span class="input-group-addon">
											<span class="fa fa-keyboard-o"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi.....!</small>
								</div>
							</div>	
							<div class="modal-footer">
								<button type="submit" class="btn btn-raised btn-success btn-round">Simpan</button>
								<button type="button" class="btn btn-raised btn-danger btn-round" data-dismiss="modal">Close</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			<form method="POST" id="DataNyaUbah">
				<div class="modal fade" id="myModalEdit" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Form Ubah Keterangan</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" name="id" class="form-control" id="id"  autocomplete="off">
										<input type="hidden" name="id_metode_pembayaran" class="form-control" id="id_metode_pembayaran"  autocomplete="off">
										<input type="text" name="Cara" class="form-control" id="Cara" placeholder="Cara Pembayaran" autocomplete="off">
										<span class="input-group-addon">
											<span class="fa fa-reorder"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi dengan huruf.....!</small>
								</div>
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" class="form-control" name="id" id="id">
										<textarea rows="5" class="form-control" name="keterangan" id="keterangan" ></textarea>
										<span class="input-group-addon">
											<span class="fa fa-keyboard-o"></span>
										</span>
									</div>
									<small class="text-danger">* Harap Diisi.....!</small>
								</div>
							</div>	
							<div class="modal-footer">
								<button type="submit" class="btn btn-raised btn-success btn-round">Simpan</button>
								<button type="button" class="btn btn-raised btn-danger btn-round" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
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


