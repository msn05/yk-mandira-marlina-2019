<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Penerbangan Travel</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
				<div class="pull-right">
					<a href="<?=base_url().'data/Penerbangan/Travel';?>">
						<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
					</a>
				</div>
				<div class="row">
					<div class="col-md-5">
						<section class="boxs ">
							<div class="boxs-header">
								<h3 class="custom-font hb-cyan">
									<strong>Form Input Kursi Penerbangan Travel</strong></h3>
								</div>
								<div class="boxs-body example">
									<div class="row">
										<div class="from-group">
											<div class="col-md-12">
												<label class="text-danger">Total Kursi Saat Ini yang diberikan maskapai sebanyak <b><?=$TotalKursi;?></b> Kursi. Silakan Masukkan Nomor Kursinya Dibawah ini..</label>
											</div>
										</div>
									</div>
									<div class="row">
										<form id="PostKursi" method="post" >
											<div class="table-responsive">
												<table id="datatable" class="table table-striped" style="width:100%">
													<thead>
														<tr>
															<th>No</th>
															<th>Nomor Kursi</th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$no = 1;
														for ($i=0; $i < $TotalKursi; $i++) {?>
															<tr>
																<td><input type='hidden' value='<?=$idKursi;?>' name='id[]' name='id[]'><?=$no++;?></td>
																<td><input type='text' name='nomor[<?=$i;?>]' id='nomor[<?=$i;?>]' placeholder='ex : A00<?=$no;?>' ></td>
															</tr>
														<?php }?>
													</tbody>
												</table>
											</div>
											<button type="submit" class="btn btn-raised btn-primary pull-right">Simpan</button>
										</form> 
									</div>
								</div>

							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		// $('#datatable').DataTable();
		$('#PostKursi').on('submit', function (e) {
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var PostKursi = $(this);
			$.ajax({
				url: base_url + 'data/Penerbangan/simpanKursi',
				type:"POST",
				data: PostKursi.serialize(),
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
							window.location.href = base_url + 'data/Penerbangan/formTravel';
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
	</script>