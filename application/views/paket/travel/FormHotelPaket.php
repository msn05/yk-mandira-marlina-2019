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
			<?php if($HotelPaket->num_rows() != 2){ ?>
				<div class="col-md-4">
					<form method="POST" id="SimpanData" >
						<div class="row">
							<div class="col-sm-12">
								<section class="boxs">
									<div class="boxs-header bg-blush">
										<h3 class="custom-font">
											<strong>Form Tambah Hotel Paket</strong></h3>
										</div>
										<div class="row">
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<input type="hidden" name="idname" id="idname" value="<?=$PaketKodeNya;?>">
													<select  name="id" id="id" class="chosen-select form-control" style="width: 100%;">
														<option value="0"> Pilih Hotel</option>
														<?php foreach ($Hotel->result_array() as $value) {?>
															<option value="<?=$value['id'];?>"><?=$value['nama_hotel'];?></option>
														<?php }?>
													</select>
													<small class="text-danger ">* Pilih Hotel</small>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<select  name="rules" id="rules" class="chosen-select form-control" style="width: 100%;">
														<option value="0"> Pilih Rules Hotel</option>
														<option value="1">Awal</option>
														<option value="2">Akhir</option>
													</select>
													<small class="text-danger ">* Jumlah untuk pelanggan</small>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-raised btn-success">Simpan</button>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</form>
					</div>
					<div id="drop"></div>
				<?php }else{?>
					<div class="col-md-8" id="Data">
						<section class="boxs ">
							<div class="boxs-header">
								<h3 class="custom-font hb-cyan">
									<strong>Hotel Paket</strong></h3>
									<p>Jika sudah menambahkan hotel paket haraf lanjutnya proses ya...!</p>
								</div>
								<a href="<?=base_url().'data/paket/FormKelengkapanPaket?KodePaket='.$PaketKodeNya.'';?>">
									<button class="btn btn-raised btn-primary">Kembali</button>
								</a>
								<?php if($HotelPaket->num_rows() > 1){?>
									<div class="pull-right">
										<a href="<?=base_url().'data/paket/travel';?>">
											<button class="btn btn-raised btn-success">Selesai</button>
										</a>
									</div>
								<?php }?>
								<div class="boxs-body">
									<div class="table-responsive">
										<table id="datatable" class="display" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Hotel</th>
													<th>Lokasi</th>
													<th>Rules</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nama Hotel</th>
													<th>Lokasi</th>
													<th>Rules</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$no=1;
												foreach ($HotelPaket->result_array() as $value ) {
													echo'
													<tr>
													<td>'.$no.'</td>
													<td>'.$value['nama_hotel'].'</td>
													<td>Jalan '.$value['alamat'].' '.$value['kota'].' '.$value['provinsi']. ' '.$value['negara'].'</td>
													<td>'.($value['rules_hotel'] == 1 ? 'Awal' : 'Tujuan').'</td>
													<td>
													<button class="hapus" id_name='.$value['IdPaketHotel'].' nama_barang='.$value['nama_hotel'].' type="submit" title="Hapus">Hapus</button>
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
					<?php }?>
				</div>
			</section>


			<script>
				$('#datatable').DataTable();

				$('#id').change(function(){
					var id 	= $(this).val();
					var base_url = "<?php echo base_url();?>";
					$.ajax({
						url: base_url + 'data/paket/cariHotel',
						type: 'POST',
						data: 'id='+id,
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
						url: base_url + 'data/paket/simpanHotel',
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
						title: "Anda Yakin ingin Menghapus Hotel ini dari daftar ?",
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
								url: 'deletehotelPaket',
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