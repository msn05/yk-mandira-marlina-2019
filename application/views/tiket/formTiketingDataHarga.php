  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Form Input Ketentuan Harga</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-8">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Haraf Isi Form Input Ketentuan Harga</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable"  class="table-bordered" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Ketentuan</th>
  												<th>Jumlah</th>
  												<th>Harga / Kursi</th>
  												<th>#</th>
  											</tr>
  										</thead>
  										<tfoot>
  											<tr>
  												<th>No</th>
  												<th>Ketentuan</th>
  												<th>Jumlah</th>
  												<th>Harga / Kursi</th>
  												<th>#</th>
  											</tr>
  										</tfoot>
  										<tbody>
  											<?php 
  											$no = 1;
  											foreach ($Ketentuan->result_array() as $key ) {?>
  												<tr>
  													<td><?=$no++;?></td>
  													<td><?=$key['level'] == 1 ? 'Anak-anak' : 'Dewasa' ;?></td>
  													<td><?=$key['jumlah'];?> Kursi</td>
  													<td>Rp. <?=number_format($key['harga']);?></td>
  													<td>
  														<button type="submit" id="remove"  name_klass='<?=$ketentuanHarga;?>' name_id='<?=$key['id'];?>'><i class="fa fa-trash-o"></i></button>
  													</td>
  												</tr>
  												<?php 
  											}
  											?>
  										</tbody>
  									</table>
  								</div>
  							</div>
  						</section>
  					</div>
  					<div class="col-md-4">
  						<form method="POST" id="SimpanData" >
  							<div class="row">
  								<div class="col-sm-12">
  									<section class="boxs">
  										<div class="boxs-header bg-blush">
  											<h3 class="custom-font">
  												<strong>Form Data</strong></h3>
  											</div>
  											<div class="row">
  												<div class="form-group col-sm-12">
  													<div class="col-sm-12">
  														<input type="hidden" name="id" id="id" value="<?=$ketentuanHarga;?>">
  														<select  name="rules" id="rules" class="chosen-select form-control" style="width: 100%;">
  															<option value="0"> Pilih Rules Data</option>
  															<option value="1">Anak-anak</option>
  															<option value="2">Dewasa</option>
  														</select>
  														<small class="text-danger ">* Pilih Rules Data</small>
  													</div>
  												</div>
  												<div class="form-group col-sm-12">
  													<div class="col-sm-12">
  														<input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="jumlah">
  														<small class="text-danger ">* Jumlah </small>
  													</div>
  												</div>
  												<div class="form-group col-sm-12">
  													<div class="col-sm-12">
  														<input type="number" class="form-control" name="harga" id="harga" placeholder="Harga">
  														<small class="text-danger ">* Harga per Kursi </small>
  													</div>
  												</div>
  												<div class="form-group col-sm-12">
  													<div class="col-sm-12">
  														<?php 
  														$Data = $Ketentuan->num_rows();
  														if ($Data > 0) {?>
  															<button type="button" id="Insert" class="btn btn-raised btn-warning" name_id="<?=$ketentuanHarga;?>">Selesai</button>
  														<?php }?>
  														<button type="submit" class="btn btn-raised btn-success">Simpan</button>
  													</div>
  												</div>
  											</div>
  										</section>
  									</div>
  								</div>
  							</form>
  						</div>

  					</div>
  				</div>
  			</div>
  		</div>
  	</section>

  	<script>
  		$('#datatable').DataTable();
  		$('#SimpanData').on('submit', function (e) {
  			e.preventDefault();
  			var base_url = "<?php echo base_url();?>";
  			var SimpanData = $(this);
  			$.ajax({
  				url: base_url + 'data/Ticketing/simpanKetentuanTiket',
  				type:"POST",
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
  						function () {
  							window.location.href = base_url + 'data/Ticketing/ketentuanHarga?idKetentuan='+respone.kode;
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


  		$('#datatable').on('click','#remove',function(){
  			var name_id    = $(this).attr('name_id');
  			var name_klass    = $(this).attr('name_klass');
  			swal({
  				title: "Anda Yakin ingin menghapus data ?",
  				text: "Ada memilih data "+name_id,
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
  						url: 'deleteTiket',
  						data : {name_id:name_id,name_klass:name_klass},
  						type: 'POST',
  						error: function() {
  							swal({
  								title: "error",
  								text: "Gagal Menghapus.",
  								type: "error",
  							});
  						},
  						success: function(data) {
  							swal({
  								title: "success",
  								text: "Berhasil Menghapus data.",
  								type: "success",
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

  		$('#Insert').on('click',function(){
  			var base_url 	= "<?php echo base_url();?>";
  			var name_id    = $(this).attr('name_id');
  			swal({
  				title: "Anda Yakin telah selesai ?",
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
  						url: 'ProsesKursi',
  						data : {name_id:name_id},
  						type: 'POST',
  						error: function() {
  							swal({
  								title: "error",
  								text: "Gagal .",
  								type: "error",
  							});
  						},
  						success: function(data) {
  							swal({
  								title: "success",
  								text: "Berhasil.",
  								type: "success",
  							},
  							function () {
  								window.location.href = base_url + 'data/Ticketing';
  							});
  						}
  					});

  				} else {
  					swal("Batal", "Batal :)", "error");
  				}
  			});
  		});


  	</script>