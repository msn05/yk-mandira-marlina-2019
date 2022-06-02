 <section id="content">
 	<div class="page page-forms-common">
 		<!-- bradcome -->
 		<div class="b-b mb-10">
 			<div class="row">
 				<div class="col-sm-6 col-xs-12">
 					<h1 class="h3 m-0">Galeri</h1>
 					<small class="text-muted">Welcome to Falcon application</small>
 				</div>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-6 col-sm-12">
 				<section class="boxs">
 					<div class="boxs-header">
 						<h3 class="custom-font hb-blue">
 							<strong><?=$headerMenu;?></strong> </h3>
 						</div>
 						<div class="boxs-body">
 							<form action="" method="post" id="UbahDataSistemDokumen">
 								<div class="row">
 									<div class="form-group col-sm-12">
 										<label for="username">Foto</label>
 										<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox"  id="foto" name="foto">
 										<small class="text-danger ">Harap Diisi.  Format JPG, PNG, JPEG max size 2mb..!</small>
 									</div>
 									<div class="form-group col-sm-12">
 										<label> Keterangan Foto</label>
 										<input type="text" name="keterangan" id="keterangan" class="form-control">
 									</div>
 									<div class="form-group col-sm-12">
 										<label> Kategori Foto</label>
 										<select name="ktd" id="ktd" class="form-control">
 											<option value="0">Pilih Kategori</option>
 											<option value="1">Haji</option>
 											<option value="2">Umroh</option>
 											<option value="3">Pariwisata</option>
 										</select>
 									</div>
 									<div class="form-group col-sm-12">
 										<button type="submit" id="SimpanUbahData" class="btn btn-success btn-raised">Simpan</button>
 										<a href="<?=base_url().'data/galeri';?>">
 											<button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Kembali</button>
 										</a>
 									</div>
 								</div>
 							</form>
 						</div>
 					</section>
 				</div>
 			</div>
 		</div>
 	</section>
 	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
 	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
 	<script>

 		$('#UbahDataSistemDokumen').submit(function(e){
 			e.preventDefault(); 
 			var base_url  = "<?php echo base_url();?>";
 			$.ajax({
 				url: base_url + 'data/galeri/UploadDokumen',
 				type:"post",
 				data:new FormData(this),
 				processData:false,
 				contentType:false,
 				cache:false,
 				async:false,
 				dataType: "JSON",
 				success: function (respone) {
 					if (respone.status == 'success') {
 						swal({
 							type: 'success',
 							title: respone.status,
 							text: respone.message,
 						},
 						function () {
 							location.reload(true);
 						});
 					}else{
 						swal({
 							type: 'error',
 							title: respone.status,
 							text: respone.message,
 						});
 					}
 				}
 			});
 		});
 	</script>