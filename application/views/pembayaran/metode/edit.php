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
		</div>
		<div class="row">
			<div class="col-md-4">
				<form method="POST" id="UpdateDatanya" class="form-horizontal" >
					<section class="boxs">
						<div class="boxs-header bg-blush">
							<h3 class="custom-font">
								<strong>Form Data</strong></h3>
							</div>
							<div class="boxs-body">
								<div class="boxs-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group">
													<input type="hidden" name="id" class="form-control" id="id" value="<?=$idPerubahan;?>" placeholder="Nama Metode" >
													<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Metode" value="<?=$namaDataNya;?>" >
													<span class="input-group-addon">
														<span class="fa fa-keyboard-o"></span>
													</span>
												</div>
												<small class="text-danger">* Harap Diisi dengan huruf.....!</small>
											</div>
										</div>
										<button type="submit" class="btn btn-raised btn-success btn-round">Simpan</button>
										<a href="<?=base_url('');?>/data/metode_pembayaran" class="btn btn-raised btn-warning btn-round"> Kembali</a>
									</div>
								</div>
							</div>
						</section>
					</form>
				</div>
				<div class="col-md-8">
					<section class="boxs">
						<div class="boxs-header">
							<h3 class="custom-font hb-blush">
								<strong>Keterangan Data </strong><?=$namaDataNya;?></h3>
							</div>
							<a href="javascript:void(0)" class="Tambah btn btn-primary btn-raised btn-simple"></i>Tambah Data</a>
							<div class="boxs-body">
								<div class="table-responsive">
									<table id="datatable1" class="display" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Keterangan</th>
												<th>Tanggal Dibuat</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Keterangan</th>
												<th>Tanggal Dibuat</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$no = 1;
											foreach ($KeteranganPembayaran as $key => $value) {?>
												<tr>
													<td><?=$no;?></td>
													<td><?=$value->bank_name;?></td>
													<td><?=$value->keterangan;?></td>
													<td><?=$value->tanggal_dibuat;?></td>
													<td>
														<!-- 	<a href="javascript:void(0);" type="button" title="Edit Data" class=" Edit btn btn-warning q-raised btn-simple btn-xs"><i class="fa fa-edit" ></i></a> -->

														<a type="button" id="<?=$value->id;?>" keterangan='<?=$value->keterangan;?>' title="Hapus Data" class=" Hapus btn btn-danger btn-raised btn-simple btn-xs"><i class="fa fa-trash-o" ></i></button></a></td>
													</tr>		
													<?php 
													$no++;
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
			</section>
			<form method="POST" id="TambahKeteranganPembayaran">
				<div class="modal fade" id="myModal"" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Form Tambah Metode</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="input-group">
										<input class="form-control" id="nama_bank" name="nama_bank"  placeholder="Nama Bank">
										<span class="input-group-addon">
											<span class="fa fa-bank"></span>
										</span>
									</div>
									<small class="text-danger">* Boleh kosong.....!</small>
								</div>
								<div class="form-group">
									<div class="input-group">
										<textarea class="form-control" id="keterangan" name="keterangan"  placeholder="Keterangan Metode"></textarea>
										<input type="hidden" value="<?=$idPerubahan;?>" name="id" id='id'>
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

			<script>
				$(document).ready(function() {
					$('.Tambah').on('click', function () {
						$('#myModal').modal('show');
					});

					$('#datatable1').DataTable();
					$('#UpdateDatanya').on('submit', function (e) {
						e.preventDefault();
						var base_url = "<?php echo base_url();?>";
						var UpdateDatanya = $(this);
						$.ajax({
							type: "POST",
							url: base_url + 'index.php/data/Metode_pembayaran/UpdateDataMetode',
							data: UpdateDatanya.serialize(),
							dataType: "JSON",
							cache : "false",
							success: function (respone) {
								if (respone.status == 'success') {
									swal({
										type: 'success',
										title: respone.status,
										text: respone.message,
										timer: 1200,
									},
									function () {
										window.location.href = base_url + 'data/metode_pembayaran';
									});
								}else{
									swal({
										type: 'error',
										title: respone.status,
										text: respone.message,
										timer: 1200,
									},
									function () {
										location.reload(true);
									});
								}
							}
						});
					});

					$('#TambahKeteranganPembayaran').on('submit', function (e) {
						e.preventDefault();
						var base_url = "<?php echo base_url();?>";
						var TambahKeteranganPembayaran = $(this);
						$.ajax({
							type: "POST",
							url: base_url + 'index.php/data/Metode_pembayaran/simpanKeterangan',
							data: TambahKeteranganPembayaran.serialize(),
							dataType: "JSON",
							cache : "false",
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
									},
									function () {
										location.reload(true);
									});
								}
							}
						});
					});
					$('#datatable1').on('click','.Hapus',function(){
						var id      = $(this).attr('id');
						var nama    = $(this).attr('keterangan');
						swal({
							title: "Anda Yakin ingin Menghapus ?",
							text: "Ada memilih data "+nama ,
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
									url: 'HapusKeterangan',
									type: 'POST',
									data : {id:id},
									dataType : "JSON",
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
						});
					});


				});
			</script>


		});

	</script>