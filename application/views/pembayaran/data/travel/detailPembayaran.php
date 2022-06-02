<section id="content">
	<div class="page page-forms-common">
		<!-- bradcome -->
		<div class="b-b mb-12">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Data Pembayaran Paket</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
				<div class="col-md-8">
					<section class="boxs ">
						<div class="boxs-header">
							<h3 class="custom-font hb-cyan">
								<strong>Histori Pembayaran Paket dengan kode <?=$kodePembayaran;?></strong></h3>
								<?php if($Keterangan == 'Travel'){?>
									<a href="<?=base_url().'data/Pemesanan/Travel';?>" class="btn btn-warning btn-raised">Kembali</a>
								<?php }else{?>
									<a href="<?=base_url().'data/Pemesanan/tourPariwisata';?>" class="btn btn-warning btn-raised">Kembali</a>
								<?php }?>
							</div>
							<div class="boxs-body">
								<div class="table-responsive">
									<table  class="table table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Tanggal</th>
												<th>Keterangan</th>
												<th>Jumlah</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no =1;
											foreach ($pembayaran->result_array() as $key ) {?>
												<tr>
													<td><?=$no++;?></td>
													<td><?=$key['tanggal'];?></td>
													<td><?=$key['hal_tagihan'];?></td>
													<td>Rp. <?=$key['jumlah'] == 0 ? ''.number_format($key['nominal'],1,',','.').'' : ''.number_format($key['jumlah'],1,',','.').'';?></td>
													<td>
														<a href='<?=base_url().'./data/Pembayaran/laporan?idDataPembayaran='.$key['id_detail_tagihannya'].'';?>'><button type="submit" id='PrintData' class='btn btn-default fa fa-print' title='cetak data'>
														</button>
													</a>
													<?php 
													$JumlahBayar 							= $Totalpembayaran['TotalBayar'];
													if ($key['hal_tagihan'] == 'Tagihan Awal Pembayawan') {
													}else{
														if ($Level == 1 ) {?>
															<button class="btn btn-default fa fa-trash-o" title="Delete Data" id="remove" name_id='<?=$key['id_detail_tagihannya'];?>' name_nama='<?=$key['jumlah'];?>'> </button>
														<?php }
													}?>

												</td>
											</tr>
										<?php }?>
										<tr>
											<th colspan="3" class="text-center">Sisa Pembayaran</th>
											<?php 
											$DataUang =  $pembayaran->row_array();
											$Utama 			= $DataUang['nominal'];
											$JumlahBayar = $Totalpembayaran['TotalBayar'];
											$Jadi 							= $Utama - $JumlahBayar;
											echo "<th>
											Rp. ".number_format($Jadi,1,',','.')."
											</th>
											";
											?>
											<th colspan="2" ></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
				<?php if ($JumlahBayar == $Utama) {
				}else{
					if($Level == 2 || $Level == 3){
					}else{
						?>
						<div class="col-md-4">
							<section class="boxs">
								<div class="boxs-header">
									<h3 class="custom-font hb-blue">
										<strong>Form Tambah Pembayaran</strong> </h3>
									</div>
									<div class="boxs-body">
										<form  id="form1" method="post">
											<div class="row">
												<div class="form-group col-md-12">
													<input type="hidden" name="idPaket" id="idPaket"value='<?=$kodePembayaran;?>'>
													<input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal">
													<span class="text-danger">* Wajib diisi</span>
												</div>
												<div class="form-group col-md-12">
													<textarea class="form-control" name="note" id='note' placeholder="Keterangan"></textarea>
													<span class="text-danger">* Wajib diisi</span>
												</div>
											</div>
											<div class="boxs-footer text-right ">
												<button type="submit" class="btn btn-raised btn-primary" >Simpan</button>
											</div>
										</form>
									</div>
								</section>
							</div>
						<?php }
					}?>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$('#form1').on('submit',function(e){
		e.preventDefault();
		var base_url 	= "<?php echo base_url();?>";
		var form1 = $(this);
		$.ajax({
			url: base_url + 'data/Pembayaran/simpanData',
			type: "POST",
			data: form1.serialize(),
			dataType: "JSON",
			success: function (respone) {
				if (respone.status == 'success') {
					swal({
						type: 'success',
						title: respone.status,
						text: respone.message,
					},function(){
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

	$('.table').on('click','#remove',function(){
		var name_id    = $(this).attr('name_id');
		var name_nama  = $(this).attr('name_nama');
		swal({
			title: "Anda Yakin ingin menghapus data ?",
			text: "Ada memilih data "+name_nama,
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
					url: 'delete',
					data : {name_id:name_id},
					type: 'POST',
					error: function() {
						swal({
							title: "error",
							text: "Gagal Menghapus.",
							type: "error",
							timer: 1200
						});
					},
					success: function(data) {
						swal({
							title: "success",
							text: "Berhasil Menghapus data.",
							type: "success",
							timer: 1200
						},
						function () {
							location.reload(true);
						});
					}
				});

			} else {
				swal("Batal", "Batal :)", "error");
			}
		});
	});
</script>