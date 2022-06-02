<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Input Pembayaran Tiket</h1>
					<small class="text-muted">Welcome to</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<form method="POST" id="SimpanData" >
					<div class="row">
						<div class="col-sm-12">
							<section class="boxs">
								<div class="boxs-header bg-blush">
									<h3 class="custom-font">
										<strong><?=$headerMenu;?> Sebesar <?=$no;?></strong></h3>
									</div>
									<div class="row">
										<div class="form-group col-sm-6">
											<div class="col-sm-12">
												<input type="hidden" name="id" id="id" value="<?=$idData;?>">
												<input type="number" name="nomimal" id="nomimal" class="form-control" value="<?=$no;?>" readonly>
												<small class="text-danger ">* Nominal Uang</small>
											</div>
										</div>
										<div class="form-group col-sm-6">
											<div class="col-sm-12">
												<input type="date" name="tglterima" id="tglterima" class="form-control">
												<small class="text-danger ">* Tanggal Terima Uang</small>
											</div>
										</div>
										<div class="form-group col-sm-12">
											<div class="col-sm-12">
												<textarea class="form-control" name="keterangan" id="keterangan"></textarea>
												<small class="text-danger ">* Keterangan</small>
											</div>
										</div>
										<div class="form-group col-sm-12">
											<div class="col-sm-12">
												<button type="submit" class="btn btn-raised btn-success">Terima</button>
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			$('#SimpanData').on('submit', function (e) {
				e.preventDefault();
				var base_url = "<?php echo base_url();?>";
				var SimpanData = $(this);
				$.ajax({
					type: "POST",
					url: base_url + 'data/PesanTiket/terimauang',
					data: SimpanData.serialize(),
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
								window.location.href = base_url + 'data/PesanTiket';
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
		</script>

