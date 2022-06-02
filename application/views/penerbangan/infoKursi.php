<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Penerbangan Travel</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<section class="boxs ">
						<div class="boxs-header">
							<h3 class="custom-font hb-cyan">
								<strong>Daftar Kursi Penerbangan Travel</strong></h3>
							</div>

							<div class="boxs-body example">
								<div class="row">
									<div class="from-group">
										<div class="col-md-12">
											<label class="text-danger">Total Kursi Saat Ini yang diberikan maskapai <b><?=$namaMaskapai;?></b> dengan kode penerbangan <b><?=$kodepenerbangan;?></b> sebanyak <b><?=$TotalKursi;?></b> Kursi</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="table-responsive">
										<table id="datatable" class="table table-striped" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Nomor Kursi</th>
													<th>Status Kursi</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												foreach ($Kursi->result_array() as $value) {
													echo '
													<tr>
													<td>'.$no.'</td>
													<td>'.$value['nomor_kursi'].'</td>
													<td>'.($value['status_kursi'] == 1 ? "Digunakan" : "Belum digunakan").'</td>
													<td>
													'.($value['status_kursi'] == 0 ? '
														<button class="remove btn btn-raised btn-sm btn-warning" title="Delete Data" id='.$value['id'].' nomor='.$value['nomor_kursi'].' per='.$value['id_penerbangan_kursi'].'">Delete</button>
														':'').'
													</td>
													</tr>
													';
													$no++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</section>
					</div>


					<div class="col-sm-4">
						<form method="POST" id="SimpanData" class="form-horizontal">
							<div class="row">
								<div class="col-sm-12">
									<section class="boxs">
										<div class="boxs-header bg-blush">
											<h3 class="custom-font">
												<strong>Form Tambah Kursi</strong></h3>
											</div>
											<div class="boxs-body">
												<p class="text-danger">Jika Anda Menambahkan Kursi kembali pada Penerbangan ini maka jumlah kursi akan ikut bertambah..!</p>
												<hr>
												<div class="row">
													<div class="form-group col-sm-12">
														<div class="col-sm-12">
															<input type="hidden" class="form-control" placeholder="" id="id" value="<?=$idData;?>"  name="id"/>
															<input type="text" class="form-control" placeholder="ex :Aaa001" id="nama"  name="nama" autocomplete="off" />
															<small class="text-danger ">Harap isi Nomor Kursi.!</small>
														</div>
													</div>
												</div>
												<hr class="line-dashed full-witdh-line" />
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
														<a href="<?=base_url().'data/penerbangan/travel';?>">
															<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
														</a>
													</div>
												</div>
											</section>
										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>

		<script>
			$('#datatable').DataTable();
			$(document).ready(function() {
				$('#SimpanData').on('submit', function (e) {
					e.preventDefault();
					var SimpanData = $(this);
					var base_url = "<?php echo base_url();?>";
					$.ajax({
						type: "POST",
						url: base_url + 'data/Penerbangan/TambahKursiTravelLagi',
						data: SimpanData.serialize(),
						dataType: "JSON",
						cache : "true",
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


				$('#datatable').on('click','.remove',function(){
					var id    = $(this).attr('id');
					var nomor  = $(this).attr('nomor');
					var per  = $(this).attr('per');
					swal({
						title: "Anda Yakin ingin Menghapus Nomor Kursi ini ?",
						text: "Ada memilih data "+nomor,
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
								url: './../../penerbangan/deleteKursi',
								data : {id:id,per:per},
								type: 'POST',
								dataType: "JSON",
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
										})
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

