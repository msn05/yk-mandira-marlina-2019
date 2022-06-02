  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pelangggan</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12 col-sm-12">
  				<section class="boxs">
  					<div class="boxs-header">
  						<h3 class="custom-font hb-blue">
  							<strong><?=$headerMenu;?></strong> </h3>
  						</div>
  						<div class="boxs-body">
  							<form role="form" id="form1" method="post">
  								<div class="row">
  									<div class="form-group col-md-4">
  										<label for="password">Id Akses </label>
  										<input type="hidden" name="idPost"  class="form-control" id="idPost" value="<?=$DataPelangganId;?>"	readonly>
  										<input type="text" name="id"  class="form-control" id="id" value="<?=$kode;?>"	readonly>
  									</div>
  									<div class="form-group col-md-4">
  										<label for="password">Nama Lengkap <span class="text-danger">* </span></label>
  										<input type="text" value="<?=$nama_lengkap;?>" name="namaLengkap"  class="form-control" id="namaLengkap" placeholder="Nama Lengkap">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Jenis Kelamin  <span class="text-danger">* </span></label>
  										<select class="form-control" name="jks" id="jks">
  											<option value="0">Jenis Kelamin</option>
  											<option value="1"<?=$jenis_kelamin == 1 ? 'selected' : '';?>>Laki-laki</option>
  											<option value="2"<?=$jenis_kelamin == 2 ? 'selected' : '' ;?>>Perempuan</option>
  										</select>
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Kartu Tanda Penduduk  <span class="text-danger">* </span></label>
  										<input type="number" name="no_ktp" id="no_ktp" class="form-control" value="<?=$no_ktp;?>" placeholder="Hanya Angka 16 digit" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Kartu Keluarga  <span class="text-danger">* </span></label>
  										<input type="number" name="no_kk" id="no_kk" value="<?=$no_kk;?>" class="form-control" placeholder="Hanya Angka 16 digit">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="number">Nomor Telephone  <span class="text-danger">* </span></label>
  										<input type="number" value="<?=$nomor_telphone;?>" name="no_telp" id="no_telp" class="form-control" placeholder="Hanya Angka min 10">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Whatshap  <span class="text-danger">* </span></label>
  										<input type="number" value="<?=$nomor_wa;?>" name="nowat" id="nowat" class="form-control" placeholder="Hanya Angka min 10">
  									</div>
  									<div class="form-group col-md-8">
  										<label for="email">Alamat   <span class="text-danger">* </span></label>
  										<input type="text" name="alamat" id="alamat" class="form-control" value="<?=$alamat;?>" placeholder="Isi Alamat Karyawan">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Email   <span class="text-danger">* </span></label>
  										<input type="email" value="<?=$emails;?>" name="email" id="email" class="form-control" placeholder="Format Email Ya...!" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Tempat Lahir   <span class="text-danger">* </span></label>
  										<input type="text" value="<?=$tempat_lahir;?>" class="form-control " id="tempatLahir" name="tempatLahir" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Tanggal Lahir   <span class="text-danger">* </span></label>
  										<input type="date" value="<?=$tanggal_lahir;?>" class="form-control " id="tanggallahir" name="tanggallahir" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Pekerjaan  <span class="text-danger">* </span></label>
  										<select class="form-control" name="pks" id="pks">
  											<option value="0">Wajib Pilih</option>
  											<option value="1"<?=$pekerjaan == 1 ? 'selected' : '';?>>PNS</option>
  											<option value="2"<?=$pekerjaan == 2? 'selected' : '';?>>SWASTA</option>
  											<option value="3"<?=$pekerjaan == 3? 'selected' : '';?>>BUMN</option>
  											<option value="4"<?=$pekerjaan == 4? 'selected' : '';?>>BURUH</option>
  											<option value="5"<?=$pekerjaan == 5? 'selected' : '';?>>TIDAK BEKERJA</option>
  										</select>
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Wali Hakim Jamaah   <span class="text-danger">* </span></label>
  										<input type="text" value="<?=$ahli_hakim_id;?>" class="form-control " id="whk" name="whk" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Status Keluarga  <span class="text-danger">* </span></label>
  										<select class="form-control" name="pksd" id="pksd">
  											<option value="0">Wajib Pilih</option>
  											<option value="1"<?=$status_data_keluarga == 1 ? 'selected' : '';?>>Suami</option>
  											<option value="2"<?=$status_data_keluarga == 2 ? 'selected' : '';?>>Istri</option>
  											<option value="3"<?=$status_data_keluarga == 3 ? 'selected' : '';?>>Anak</option>
  										</select>
  									</div>
  								</div>
  								<div class="boxs-footer text-right ">
  									<a href="<?=base_url().'data/pelanggan';?>" class="btn btn-raised btn-warning">Kembali</a>
  									<?php if($KeteranganData === 'Ubah'){?>
  										<button type="submit" class="btn btn-raised btn-primary" id="form1Submit" >Update</button>
  									<?php }?>
  									<!-- </div> -->
  								</form>
  							</section>
  						</div>
  					</div>
  				</div>
  			</section>
  			<script>
  				$('#form1').on('submit', function (e) {
  					e.preventDefault();
  					var base_url 	= "<?php echo base_url();?>";
  					var form1 = $(this);
  					$.ajax({
  						type: "POST",
  						url: base_url + 'data/pelanggan/UpdatePelanggan',
  						data: form1.serialize(),
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
  									window.location.href = base_url + 'data/pelanggan'
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
  			</script>
