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
  			<div class="col-md-6">
  				<section class="boxs">
  					<div class="boxs-header">
  						<h3 class="custom-font hb-green">
  							<strong><?=$headerMenu;?></h3>
  							</div>
  							<form method="POST" action="" id="DataNya" class="form-horizontal">
  								<div class="boxs-body">
  									<div class="form-group">
  										<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
  										<div class="col-sm-10">
                        <input type="hidden" class="form-control" name="id_akses" value="<?=$id_akses;?>" id="id_akses" readonly/>
                        <input type="text" class="form-control" name="nama" value="<?=$nama;?>" id="nama" readonly/>
                        <!-- <small class="text-danger ">Harap isi Dengan Huruf..!</small> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">password Baru</label>
                      <div class="col-sm-10">
                       <input type="text" name="Password" class="form-control" id="Password" placeholder="Password Baru">
                       <small class="text-danger">Jika Tidak Ingin Mengganti Silakan Kosongkan ...!</small>
                     </div>
                   </div>
                  <!--  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Level Users</label>
                    <div class="col-sm-10">
                     <select tabindex="3" name="am" id="am" class="chosen-select form-control" style="width: 100%;">
                      <option value="0"> Pilih Akses Sistem</option>
                      <?php 
                      foreach ($Akses as $key => $value):?>
                       <option value="<?= $value->id_level;?>"<?=$value->id_level ==  $id_level ? 'selected' : null;?>><?php echo $value->nama_level;?></option>
                     <?php endforeach;?>
                   </select>
                   <small class="text-danger ">Harap Diisi..!</small>
                 </div>
               </div> -->
               <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" id="SimpanData" class="btn btn-raised btn-primary">Simpan</button>
                 <a href="<?=base_url().'data/pengguna';?>">
                  <button type="button"  class="btn btn-raised btn-warning">Kembali</button>
                </a>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
</section>
<script>
 $('#DataNya').on('submit', function (e) {
  e.preventDefault();
  var base_url = "<?php echo base_url();?>";
  var DataNya = $(this);
  $.ajax({
   type: "POST",
   url: base_url + 'data/pengguna/simpanPerubahanData',
   data: DataNya.serialize(),
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
      window.location.href = base_url + 'data/pengguna';
    });
   }else{
     swal({
      type: 'error',
      title: respone.status,
      text: respone.message,
      timer: 1200,
    })
   }
 }
});
});
</script>


