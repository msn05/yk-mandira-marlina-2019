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
				<form method="POST" id="DataNya" class="form-horizontal" >
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
													<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Metode" >
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
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function() {
			$('#DataNya').on('submit', function (e) {
				e.preventDefault();
				var base_url = "<?php echo base_url();?>";
				var DataNya = $(this);
				$.ajax({
					type: "POST",
					url: base_url + 'index.php/data/Metode_pembayaran/SimpanBaru',
					data: DataNya.serialize(),
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
							});
						}
					}
				});
			});
		});

	</script>