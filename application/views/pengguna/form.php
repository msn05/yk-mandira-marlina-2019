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
   <div class="col-md-12">
    <section class="boxs">
     <div class="boxs-header">
      <h3 class="custom-font hb-green">
       <strong><?=$headerMenu;?></h3>
       </div>
       <form method="POST" action="" id="DataNya" class="form-horizontal">
        <div class="boxs-body">
         <div class="row">
          <div class="col-md-12">
           <div class="form-group col-sm-4">
            <div class="col-sm-10">
             <input type="text" name="usernamenya"  class="form-control" id="usernamenya" placeholder="Username Anda">
             <small class="text-danger ">Harap isi Dengan Huruf..!</small>
           </div>
         </div>
         <div class="form-group col-sm-4">
          <div class="col-sm-10">
           <input type="text" name="namaLengkap"  class="form-control" id="namaLengkap" placeholder="Nama Lengkap">
           <small class="text-danger ">Harap isi Dengan Huruf..!</small>
         </div>
       </div>
       <div class="form-group col-sm-4">
        <div class="col-sm-10">
         <input type="number" name="nomor"  class="form-control" id="nomor" placeholder="Nomor Telphone Anda">
         <small class="text-danger ">Harap isi Dengan Angka..!  00000000000</small>
       </div>
     </div>
     <div class="form-group col-sm-4">
      <div class="col-sm-10">
       <input type="number" name="nomorWA"  class="form-control" id="nomorWA" placeholder="Nomor Telphone Anda">
       <small class="text-danger ">Harap isi Dengan Angka..!  00000000000</small>
     </div>
   </div>
   <div class="form-group col-sm-4">
    <div class="col-sm-10">
     <input type="text" name="email"  class="form-control" id="email" placeholder="Nomor Email Anda">
     <small class="text-danger ">Harap isi Dengan Format Email..!</small>
   </div>
 </div>
 <div class="form-group col-sm-4">
  <div class="col-sm-10">
   <input type="text" name="tempatLahir"  class="form-control" id="tempatLahir" placeholder="Nomor Tempat Lahir Anda">
   <small class="text-danger ">Harap isi Dengan Tempat Lahir Anda..!</small>
 </div>
</div>
<div class="form-group col-sm-4">
  <div class="col-sm-10">
   <input type="date" name="tanggalLahir"  class="form-control" id="tanggalLahir" placeholder="Nomor Tanggal Lahir Anda">
   <small class="text-danger ">Harap isi Dengan Format tanggal-bulan-tahun</small>
 </div>
</div>
<div class="form-group col-sm-4">
  <div class="col-sm-10">
   <input type="text" name="alamat"  class="form-control" id="alamat" placeholder="Alamat Anda">
   <small class="text-danger ">Harap isi Alamat Anda...!</small>
 </div>
</div>

<div class="form-group col-sm-4">
  <div class="col-sm-10">
   <input type="text" name="Password" class="form-control" id="Password" placeholder="Password Baru">
   <small class="text-danger">Jika tidak diisi passwordnya 123456 !</small>
 </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
   <div class="form-group col-sm-4">
    <div class="col-sm-10">
     <select tabindex="3" name="am" id="am" class="chosen-select form-control" style="width: 100%;">
      <option value="0"> Pilih Level Sistem</option>
      <?php 
      foreach ($Akses as $key => $value):?>
       <option value="<?= $value->id_level;?>"><?php echo $value->nama_level;?></option>
     <?php endforeach;?>
   </select>
   <small class="text-danger ">Harap Diisi..!</small>
 </div>
</div>
<div class="form-group col-sm-4">
  <div class="col-sm-10">
   <select tabindex="3" name="ak" id="ak" class="chosen-select form-control" style="width: 100%;">
    <option value="0"> Pilih Status Users</option>
    <option value="1">Aktif</option>
    <option value="1">Tidak Aktif </option>
  </select>
  <small class="text-danger ">Harap Diisi..!</small>
</div>
</div>
</div>
</div>
<hr class="line-dashed full-witdh-line" />
<div class="form-group">
  <div class="col-sm-offset-4 col-sm-6">
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
   url: base_url + 'data/pengguna/SimpanDataBaru',
   data: DataNya.serialize(),
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


