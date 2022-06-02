  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pengguna Sistem</h1>
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
  										<input type="text" name="id"  class="form-control" id="id" value="<?=$idAkses;?>"	readonly>
  									</div>
  									<div class="form-group col-md-4">
  										<label for="password">Nama Lengkap <span class="text-danger">* </span></label>
  										<input type="text" name="namaLengkap"  class="form-control" id="namaLengkap" placeholder="Nama Lengkap">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Kartu Tanda Penduduk  <span class="text-danger">* </span></label>
  										<input type="number" name="no_ktp" id="no_ktp" class="form-control" placeholder="Hanya Angka 16 digit" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Kartu Keluarga  <span class="text-danger">* </span></label>
  										<input type="number" name="no_kk" id="no_kk" class="form-control" placeholder="Hanya Angka 16 digit">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="number">Nomor Telephone  <span class="text-danger">* </span></label>
  										<input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="Hanya Angka min 10">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Darurat  <span class="text-danger">* </span></label>
  										<input type="number" name="nodar" id="nodar" class="form-control" placeholder="Hanya Angka min 10">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="phone">Nomor Whatshap  <span class="text-danger">* </span></label>
  										<input type="number" name="nowat" id="nowat" class="form-control" placeholder="Hanya Angka min 10">
  									</div>
  									<div class="form-group col-md-8">
  										<label for="email">Alamat   <span class="text-danger">* </span></label>
  										<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Isi Alamat Karyawan">
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Email   <span class="text-danger">* </span></label>
  										<input type="email" name="email" id="email" class="form-control" placeholder="Format Email Ya...!" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Tanggal Lahir   <span class="text-danger">* </span></label>
  										<input type="date" class="form-control " id="tanggalLahir" name="tanggalLahir" placeholder="12-01-2020" >
  										<input type="hidden" class="idFoto form-control " id="idFoto" name="idFoto" value="<?=$idFoto;?>" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Tempat Lahir   <span class="text-danger">* </span></label>
  										<input type="text" class="form-control " id="tempatLahir" name="tempatLahir" >
  									</div>
  									<div class="form-group col-md-4">
  										<label for="email">Pilih Akses Login  <span class="text-danger">* </span></label>
  										<select class="form-control" name="aksesNya" id="aksesNya">
  											<option value="0">Wajib Pilih</option>
  											<?php foreach ($LevelData as $key => $value) {?>
  												<option value="<?=$value->id_level;?>"><?=$value->nama_level;?></option>
  											<?php }?>
  										</select>
  									</div>

  								</div>
  								<div class="boxs-footer text-right ">
  									<button type="submit" class="btn btn-raised btn-primary" id="form1Submit" >Simpan</button>
                    <a href="<?=base_url().'data/pengguna';?>" class="btn btn-raised btn-warning">Kembali
                    </a>
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
           var id 							= $('#idFoto').val();
           var base_url 	= "<?php echo base_url();?>";
           var form1 = $(this);
           $.ajax({
            type: "POST",
            url: base_url + 'data/karyawan/simpanData',
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
               window.location.href = base_url + 'data/karyawan/UploadFile?idFile='+id;
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
