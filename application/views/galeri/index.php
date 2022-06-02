<link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/fancybox/dist/jquery.fancybox.css';?>">

<section id="content">
	<div class="page page-gallery">
		<div class="row">
			<div class="col-md-12 ">
				<section class="boxs ">
					<div class="boxs-header">
						<h3 class="custom-font hb-cyan">
							<strong>Daftar Dokumentasi</strong></h3>
							<p class="text-danger"> * Klik File Gambar Untuk Melihat</p>
						</div>
						<?php if($Level == 1 || $Level == 3){?>
							<a href="<?=base_url().'data/Galeri/formTambah';?>">
								<button class="btn btn-raised btn-primary">Tambah</button>
							</a>
						<?php }?>
						<div class="boxs-body">
							<div class="table-responsive">
								<table id="datatable" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Kategori Dokumentasi</th>
											<th>Note</th>
											<th>File</th>
											<th>Post</th>
											<?php if($Level == 1){?>
												<th>Action</th>
											<?php }?>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Kategori Dokumentasi</th>
											<th>Note</th>
											<th>File</th>
											<th>Post</th>
											<?php if($Level == 1){?>
												<th>Action</th>
											<?php }?>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$no = 1;
										foreach ($galeri->result_array() as $key ) {
											$slideImage = $this->db->get_where('tb_image_slide',array('image'=>$key['id']))->row_array();

											?>
											<tr>
												<td><?=$no++;?></td>
												<td><?=$key['kategori_dokumentasi'] == 0 ? 'Default' : ($key['kategori_dokumentasi'] == 1 ? 'Haji' : ($key['kategori_dokumentasi'] == 2 ? 'Umroh' : 'Pariwisata'));?></td>
												<td><?=$key['keterangan'] != NULL ? ''.$key['keterangan'].'' : '-';?></td>
												<td><a id="inline" data-fancybox-trigger="gallery"  class="show-image"  href="<?=base_url().'image/galeri/'.$key['foto'].'';?>"><?=$key['foto'];?></a></td>
												<td><?=date('d-m-Y',strtotime($key['tanggal']));?></td>
												<?php if($Level == 1){?>
													<td class="text-center">
														<?php if($key['id'] == $slideImage['image']){?>
														<?php }else{?>
															<a href='javascript:void(0);' title="jadikan slide" type="submit" class="Slide fa fa-sticky-note-o" name_id='<?=$key['id'];?>' name_pelanggan='<?=$key['foto'];?>'></a>
														<?php }?>
														<a href="<?=base_url().'data/galeri/EditGambar?idData='.base64_encode($key['id']).'';?>" class='fa fa-edit' title='edit data'></a>
														<a type='submit' class="hapus fa fa-remove" title="Hapus"  name_id='<?=$key['id'];?>' name_pelanggan='<?=$key['foto'];?>'></a>
													</td>
												<?php }?>
											</tr>
										<?php }?>

									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/fancybox/dist/jquery.fancybox.js';?>"></script>
	<script>
		$('#datatable').DataTable();
		$("a#inline").fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'width'		: 680,
			'height'		: 495,
		});


		$('#datatable').on('click','.hapus',function(){
			var name_id         										= $(this).attr('name_id');
			var name_pelanggan       = $(this).attr('name_pelanggan');
			swal({
				title: "Anda Yakin ingin Menghapus Data Ini ?",
				text: "Ada memilih data "+name_pelanggan,
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
						url: 'galeri/deleteFoto',
						data : {name_id:name_id},
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
								},
								function(){
									location.reload(true);
								})
							}
						}
					});

				} else {
					swal("Batal", "Anda Telah Membatal ", "error");
				}
			});
		});

		$('#datatable').on('click','.Slide',function(){
			var name_id         										= $(this).attr('name_id');
			var name_pelanggan       = $(this).attr('name_pelanggan');
			swal({
				title: "Anda Yakin ingin Menjadikan Foto ini Slide ?",
				text: "Ada memilih data "+name_pelanggan,
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
						url: 'galeri/slideFoto',
						data : {name_id:name_id},
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
								},
								function(){
									location.reload(true);
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