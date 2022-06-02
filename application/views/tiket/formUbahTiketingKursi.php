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
  													<input type="hidden" name="id" id="id" value="<?=$id;?>">
  													<input type="hidden" name="id_tiket" id="id_tiket" value="<?=$id_tiket_data;?>">
  													<select  name="rules" id="rules" class="chosen-select form-control" style="width: 100%;">
  														<option value="0"> Pilih Rules Data</option>
  														<option value="1"<?=$level == 1 ? 'selected' : '';?>>Anak-anak</option>
  														<option value="2"<?=$level == 2 ? 'selected' : '';?>>Dewasa</option>
  													</select>
  													<small class="text-danger ">* Pilih Rules Data</small>
  												</div>
  											</div>
  											<div class="form-group col-sm-12">
  												<div class="col-sm-12">
  													<input type="number" value="<?=$jumlah;?>" class="form-control" name="jumlah" id="jumlah" placeholder="jumlah">
  													<small class="text-danger ">* Jumlah </small>
  												</div>
  											</div>
  											<div class="form-group col-sm-12">
  												<div class="col-sm-12">
  													<input type="number" value="<?=$harga;?>" class="form-control" name="harga" id="harga" placeholder="Harga">
  													<small class="text-danger ">* Harga per Kursi </small>
  												</div>
  											</div>
  											<div class="form-group col-sm-12">
  												<div class="col-sm-12">
  													<button type="submit" class="btn btn-raised btn-success">Update</button>
  													<a href="<?=base_url().'data/ticketing/InfoKursi?idKuris='.base64_encode($id_tiket_data).'';?>" class="btn btn-warning btn-raised">Kembali</a> 
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
  			url: base_url + 'data/Ticketing/simpanUbahKetentuanTiket',
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
  						window.location.href = base_url + 'data/Ticketing/InfoKursi?idKuris='+respone.kode;
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