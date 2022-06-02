<section id="content">
	<div class="page page-gallery">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Informasi Foto</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<?php if($variable->num_rows() > 2){?>
			<a href="<?=base_url().'data/promo';?>" class="btn btn-warning btn-raised btn-simple"></i>Kembali</a>
		<?php }
		if ($keterangan == 'Post') {?>
			<a href="javascript:void(0)" class="Tambah btn btn-primary btn-raised btn-simple"></i>Tambah Data</a>
		<?php }?>
		<div class="row">
			<div class="col-md-12 gallery-col">
				<section class="boxs">
					<div class="boxs-body">
						<?php if($variable->num_rows() > 0){
							foreach ($variable->result_array() as $key) {?>
								<a  class="show-image">
									<img src="<?=base_url().'image/promo/'.$key['image_file'].'';?>" alt="" class="img-responsive">
									<?php if($keterangan == 'Post'){?>
										<button type="submit" class="DeleteData btn btn-danger btn-raised fa fa-trash-o" name_nama='<?=$key['id'];?>' name_data='<?=$key['image_file'];?>' title='delete'></button>
									<?php }?>
								</a>
							<?php }
						}else{
							echo "<label class='text-danger'>Maaf File Kosong, Anda Harus Upload File Promo untuk pelanggan percaya..!</label>";
						}
						?>
					</div>
				</section>
			</div>
		</div>

	</div>
</section>
<form method="post" id="SimpanData">
	<div class="modal fade" id="myModal"" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Form Tambah Metode</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" id="foto" name="foto">
						<input type="hidden" value="<?=$idFile;?>" name="id" id='id'>
						<small class="text-danger">* Format JPG</small>
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
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
<script type="text/javascript">
	$('.Tambah').on('click', function () {
		$('#myModal').modal('show');
	});
	var base_url 	= "<?php echo base_url();?>";
	$('#SimpanData').submit(function(e){
		e.preventDefault(); 

		$.ajax({
			url: base_url + 'data/promo/UploadImage',
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
	$('.show-image').on('click','.DeleteData',function(){
		var name_nama         = $(this).attr('name_nama');
		var name_data         = $(this).attr('name_data');
		swal({
			title: "Anda Yakin ingin Menghapus Foto ini ?",
			text: "Ada memilih data "+name_data,
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
					url: base_url+'data/promo/deletePromoFile',
					data : {name_nama:name_nama},
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
								location.reload(true);
							});
						}else{
							swal({
								type: 'error',
								text: respone.message,
								title: respone.status,
							})
						}
					}
				});

			} else {
				swal("Batal", "Anda Telah Membatal ", "error");
			}
		});
	});


</script>