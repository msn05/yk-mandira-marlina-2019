  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Buat Tiket</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
  			</div>
  			<div class="row">
  				<form method="POST" id="SimpanData" >
  					<div class="col-sm-4">
  						<section class="boxs">
  							<div class="boxs-header bg-blush">
  								<h3 class="custom-font">
  									<strong>Form Data</strong></h3>
  								</div>
  								<div class="row">
  									<div class="form-group col-sm-12">
  										<div class="col-sm-12">
  											<input type="hidden" name="id" id="id" value="<?=$idTiket;?>" >
  											<select  name="pelanggan" id="pelanggan" class="chosen-select form-control" style="width: 100%;">
  												<option value="0"> Pilih Nomor Tiket</option>
  												<?php foreach ($variable->result_array() as $value) {?>
  													<option value="<?=$value['id'];?>"><?=$value['nomor_kursi'];?></option>
  												<?php }?>
  											</select>
  											<small class="text-danger ">* Pilih Nomor Tiket</small>
  										</div>
  									</div>
  									<div class="form-group col-sm-12">
  										<div class="col-sm-12">
  											<button type="submit" id="SimpanData" class="btn btn-raised btn-primary">Simpan</button>
  											<a href="<?=base_url().'data/CetakTiketPelanggan';?>">
  												<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  											</a>
  										</div>
  									</div>
  								</div>
  							</section>
  						</div>
  					</form>

  				</div>
  			</div>
  		</div>
  	</div>
  </section>

  <script>
  	$('.chosen-select').select2();
  	$('#datatable').DataTable();
  	$('#SimpanData').on('submit', function (e) {
  		e.preventDefault();
  		var base_url = "<?php echo base_url();?>";
  		var SimpanData = $(this);
  		$.ajax({
  			url: base_url + 'data/CetakTiketPelanggan/simpanTiket',
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
  						window.location.href = base_url + 'data/CetakTiketPelanggan';
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