<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Paket Travel</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<section class="boxs ">
					<div class="boxs-header">
						<h3 class="custom-font hb-cyan">
							<strong>Perlengkapan Paket</strong></h3>
							<p>Jika sudah menambahkan perlengkapan paket haraf lanjutnya proses ya...!</p>
						</div>
						<a href="<?=base_url().'index.php/data/Perlengkapan/form';?>">
							<button class="btn btn-raised btn-primary">Kembali</button>
						</a>
						<?php if($PerlengkapanPaket->num_rows() > 0){?>
							<div class="pull-right">
								<a href="<?=base_url().'data/paket/formHotelPaket?KodePaket='.$PaketKodeNya.'';?>">
									<button class="btn btn-raised btn-success">Lanjut Proses</button>
								</a>
							</div>
						<?php }?>
						<div class="boxs-body">
							<div class="table-responsive">
								<table id="datatable" class="display" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Barang</th>
											<th>Jumlah Barang</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama Barang</th>
											<th>Jumlah Barang</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$no=1;
										foreach ($PerlengkapanPaket->result_array() as $value ) {
											echo'
											<tr>
											<td>'.$no.'</td>
											<td>
											<input type="hidden" name="id" id="id">'.$value['nama_barang'].'</td>
											<td>'.($value['jumlah'].' Unit ').'</td>
											<td>
											<button class="hapus" id_name='.$value['id'].' nama_barang='.$value['nama_barang'].' type="submit" title="Hapus">Hapus</button>
											</td>
											</tr>
											';
											$no++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>

				<div class="col-sm-4">
					<form method="POST" id="SimpanData" >
						<div class="row">
							<div class="col-sm-12">
								<section class="boxs">
									<div class="boxs-header bg-blush">
										<h3 class="custom-font">
											<strong>Form Tambah Perlengkapan</strong></h3>
										</div>
										<div class="row">
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<select  name="id" id="id" class="chosen-select form-control" style="width: 100%;">
														<option value="0"> Pilih Layanan</option>
														<?php foreach ($Perlengkapan->result_array() as $value) {?>
															<option value="<?=$value['id_kelengkapandata'];?>"><?=$value['nama_barang'];?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<input type="hidden" class=" form-control" id="inamapaket" name="inamapaket"placeholder="Jumlah" value="<?=$PaketKodeNya;?>" autocomplete="off" />
													<input type="number" class=" form-control" id="jumlah" name="jumlah"placeholder="Jumlah" autocomplete="off" />
													<small class="text-danger ">* Jumlah untuk pelanggan</small>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-raised btn-success">Simpan</button>
												</div>
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





		<script>

			$('#datatable').DataTable();

			$('#SimpanData').on('submit',function(e){
				e.preventDefault();
				var SimpanData = $(this);
				var base_url = "<?php echo base_url();?>";
				$.ajax({
					url: base_url + 'data/paket/simpanperlengkapanpaket',
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
								timer: 1200,
							},
							function(){
								location.reload(true);
							});
						}else{
							swal({
								type: 'error',
								title: respone.status,
								text: respone.message,
								timer: 1200,
							},
							function(){
								location.reload(true);
							});
						}
					}
				});
			});

			$('#datatable').on('click','.hapus',function(){
				var id_name    = $(this).attr('id_name');
				var nama_barang  = $(this).attr('nama_barang');
				swal({
					title: "Anda Yakin ingin Menghapus Perlengkapan ini ?",
					text: "Ada memilih data "+nama_barang,
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
							url: 'deleteperlengkapan',
							data : {id_name:id_name},
							type: 'POST',
							dataType: "JSON",
							success: function(respone) {
								if (respone.status == 'success') {
									swal({
										type: 'success',
										text: respone.message,
										title: respone.status,
										timer: 1200,
									},
									function () {
										location.reload(true);
									});
								}else{
									swal({
										type: 'error',
										text: respone.message,
										title: respone.status,
										timer: 1200,
									})
								}
							}
						});

					} else {
						swal("Batal", "Batal :)", "error");
					}
				});
			});

		</script>