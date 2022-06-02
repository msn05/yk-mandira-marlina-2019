<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Pemesanan Paket Pariwisata</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<form method="POST" id="SimpanData" >
					<div class="row">
						<div class="col-sm-12">
							<section class="boxs">
								<div class="boxs-header bg-blush">
									<h3 class="custom-font">
										<strong><?=$headerMenu;?></strong></h3>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<div class="col-sm-12">
												<select  name="pelanggan" id="pelanggan" class="chosen-select form-control" style="width: 100%;">
													<option value="0"> Pilih Pelanggan</option>
													<?php foreach ($pelanggan->result_array() as $value) {?>
														<option value="<?=$value['id'];?>"><?=$value['nama_lengkap'];?></option>
													<?php }?>
												</select>
												<small class="text-danger ">* Pilih Pelanggan</small>
											</div>
										</div>
										<div class="form-group col-sm-12">
											<div class="col-sm-12">
												<select  name="id_paket" id="id_paket" class="chosen-select form-control" style="width: 100%;">
													<option value="0"> Pilih Paket</option>
													<?php foreach ($paket->result_array() as $value) {?>
														<option value="<?=$value['id_paket'];?>"><?=$value['nama_layanan'].'-'.$value['kode_paket_data'];?></option>
													<?php }?>
												</select>
												<small class="text-danger ">* Pilih Paket</small>
											</div>
										</div>
										<div class="form-group col-sm-12">
											<div class="col-sm-12">
												<button type="submit" class="btn btn-raised btn-success">Simpan</button>
												<a href="<?=base_url().'data/Pemesanan/travel';?>" class='btn btn-warning btn-raised'>Kembali</a>
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
					</form>
				</div>
				<div id="drop"></div>
			</div>
		</section>


		<script>
			$('#datatable').DataTable();
			$('#pelanggan').change(function(){
				var pelanggan 	= $(this).val();
				var base_url = "<?php echo base_url();?>";
				$.ajax({
					url: base_url + 'data/pelanggan/cariPelanggan',
					type: 'POST',
					data: 'pelanggan='+pelanggan,
					cache:'false',
					success:function(msg){
						$("#drop").html(msg);
						$('#Data').hide();                  
					}
				});
			});

			$('#SimpanData').on('submit',function(e){
				e.preventDefault();
				var SimpanData = $(this);
				var base_url = "<?php echo base_url();?>";
				$.ajax({
					url: base_url + 'data/pemesanan/simpanPaketPemesanan',
					type: "POST",
					data: SimpanData.serialize(),
					dataType: "JSON",
					cache : "false",
					success: function (respone) {
						if (respone.status == 'success') {
							swal({
								type: 'success',
								title: respone.status,
								text: respone.message,
							},
							function(){
								location.reload(true);
							});
						}else{
							swal({
								type: 'error',
								title: respone.status,
								text: respone.message,
							},
							function(){
								location.reload(true);
							});
						}
					}
				});
			});


		</script>