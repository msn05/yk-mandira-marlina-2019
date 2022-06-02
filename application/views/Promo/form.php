<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Promo Paket</h1>
					<small class="text-muted">Welcome to </small>
				</div>
			</div>
		</div>
		<section class="boxs">
			<div class="boxs-header bg-green">
				<h3 class="custom-font">
					<strong>Form Tambah Promo Paket</strong></h3>
				</div>
				<form method="POST" id="DataNya" class="form-horizontal">
					<div class="boxs-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<select name="pilih" id="pilih" class="form-control">
											<option value="0"> Pilih Paket</option>
											<?php foreach ($Panduan->result_array() as $key) {?>
												<option value="<?=$key['id_paket'];?>"><?=$key['nama_layanan'].'-'.$key['kode_paket_data'].'-'.$key['id_paket'];?></option>
											<?php }?>
										</select>
										<small class="text-danger">* Harap Pilih...!</small>
									</div>
								</div>
								<div id="Change"></div>
								<div class="form-group col-sm-5">
									<div class="col-sm-12">
										<input type="number" name="hargaPromo" id="hargaPromo" autocomplete="off" class="form-control">
										<small class="text-danger">* Masukkan Harga Lebih Dari Harga Paket</small>
									</div>
								</div>

							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-10">
								<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
								<a href="<?=base_url().'data/promo';?>">
									<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
								</a>
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
	</section>

	<script>
		$('#pilih').change(function(){
			var pilih 	= $(this).val();
			var base_url = "<?php echo base_url();?>";
			$.ajax({
				url: base_url + 'data/promo/cariHarga',
				type: 'POST',
				data: 'pilih='+pilih,
				cache:'false',
				success:function(msg){
					$("#Change").html(msg);
					$('#Data').hide();                  
				}
			});
		});

		$('#DataNya').on('submit',function(e){
			e.preventDefault();
			var base_url = "<?php echo base_url();?>";
			var DataNya = $(this);
			swal({
				title: "Anda Yakin ingin Membuat Promo Paket Ini ?",
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
						url: base_url+'data/promo/postPromo',
						data : DataNya.serialize(),
						type: 'POST',
						dataType: "JSON",
						success: function(respone) {
							if (respone.status == 'success') {
								swal({
									type: 'success',
									text: respone.message,
									title: respone.status,
								},
								function () {
									window.location.href = base_url + 'data/promo/Image?idData='+respone.kode+'&Keterangan=Post'
								});
							}else{
								swal({
									type: 'error',
									text: respone.message,
									title: respone.status,
								},
								function () {
									location.reload(true);
								});
							}
						}
					});

				} else {
					swal("Batal", "Anda Telah Membatal ", "error");
				}
			});
		});


	</script>