<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Tikceting</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<section class="boxs">
						<div class="boxs-header bg-green">
							<h3 class="custom-font">
								<strong>Form Ubah Tiket</strong></h3>
							</div>
							<form method="POST" id="DataNya" method="post" >
								<div class="boxs-body">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Nama Maskapai</label>
												<input type="hidden" name="id" id="id" value="<?=$id_tiket_YKM;?>">
												<select class="form-control select2" name="maskapai" id="maskapai">
													<option value="0">Pilih Maskapai</option>
													<?php 
													foreach ($variable1->result_array() as $key ) {?>
														<option value="<?=$key['id'];?>"<?=$id_penerbangan == $key['id'] ? 'selected' : '';?>><?=$key['nama_maskapai'];?></option>
													<?php }?>
												</select>
											</div>
											<small class="text-danger ">Harap isi Nama Maskapai.!</small>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Tanggal Berangkat</label>
												<input type='date' value="<?=$tanggal;?>" name="tanggalPesan"  id='tanggalPesan' class="form-control" autocomplete="off" />
											</div>
											<small class="text-danger ">Tanggal Berangkat!</small>
										</div>						
										
										<div class="col-md-3">
											<div class="form-group">
												<label>Waktu Berangkat</label>
												<input type='time' value="<?=$waktu_berangkat;?>" name="waktuPesan"  id='waktuPesan' class="form-control" />
											</div>
											<small class="text-danger ">Tanggal Berangkat!</small>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Kode Pesawat</label>
												<input type='text' value="<?=$kode_pesawat;?>" name="kodePenerbanganPesawat"  id='kodePenerbanganPesawat' class="form-control" autocomplete="off" placeholder="ex: JKT-A-001" />
											</div>
											<small class="text-danger ">Kode Pesawat..!</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>From</label>
												<input type='text' value="<?=$form;?>"  name="from"  id='from' class="form-control" autocomplete="off" placeholder="ex: Jakarta" />
											</div>
											<small class="text-danger ">From flay airplane..!</small>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Where Plane</label>
												<input type='text' value="<?=$bandara1;?>"  name="bandara"  id='bandara' class="form-control" autocomplete="off" placeholder="ex: SMB-II" />
											</div>
											<small class="text-danger ">Plane play airplane..!</small>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>To</label>
												<input type='text' value="<?=$to;?>"  name="to"  id='to' class="form-control" autocomplete="off" placeholder="ex: Palembang" />
											</div>
											<small class="text-danger ">To flay airplane..!</small>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Transiting Plane</label>
												<input type='text' value="<?=$bandara2;?>" name="transit"  id='transit' class="form-control" autocomplete="off" placeholder="ex: SMB-II" />
											</div>
											<small class="text-danger ">Plane transit airplane..!</small>
										</div>
									</div>
									<hr class="line-dashed full-witdh-line" />
									<div class="row"> 
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-10">
												<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
												<a href="<?=base_url().'data/Ticketing';?>">
													<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
												</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</section>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		// $('#datatable').DataTable();
		$('#DataNya').on('submit', function (e) {
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var DataNya = $(this);
			$.ajax({
				url: base_url + 'data/Ticketing/simpanUbahTiket',
				type:"POST",
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
							window.location.href = base_url + 'data/Ticketing';
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