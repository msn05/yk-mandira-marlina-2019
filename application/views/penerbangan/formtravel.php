<section id="content">
 <div class="page page-ui-portlets">
  <!-- bradcome -->
  <div class="b-b mb-10">
   <div class="row">
    <div class="col-sm-6 col-xs-12">
     <h1 class="h3 m-0">Penerbangan Travel</h1>
     <small class="text-muted">Welcome to Falcon application</small>
   </div>
 </div>
</div>
<section class="boxs">
 <div class="boxs-header bg-green">
  <h3 class="custom-font">
   <strong>Form Tambah Penerbangan</strong></h3>
 </div>
 <form method="POST" id="DataNya" method="post" action="" enctype="multipart/form-data">
   <div class="boxs-body">
    <div class="row">
     <div class="col-md-4">
      <div class="form-group">
       <label>Kode Penerbangan</label>
       <div class="row">
         <div class="col-sm-6">
           <input type="text" id="nameKode" name="nameKode" class="form-control" placeholder="AIR" autocomplete="off">
         </div>
         <div class="col-sm-6">
          <input type="number" id="kodePenerbangan" name="kodePenerbangan" class="form-control" placeholder="001" autocomplete="off">
        </div>
      </div>
    </div>
    <small class="text-danger ">Harap isi Mengisi Kode Penerbangan.!</small>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Nama Perusahaan</label>
      <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan" autocomplete="off">
    </div>
    <small class="text-danger ">Harap isi Nama Perusahaan.!</small>
  </div>
  <div class="col-md-4">
    <div class="form-group">
     <label>Nama Maskapai</label>
     <input type="text" id="nama" name="nama"  placeholder="Nama Maskapai" class="form-control" autocomplete="off">
   </div>
   <small class="text-danger ">Harap isi Nama Maskapai.!</small>
 </div>
 <div class="col-md-3">
  <div class="form-group">
    <label>Tanggal Pesan</label>
    <input type='date' name="tanggalPesan"  id='datetimepicker1' class="form-control" autocomplete="off" />
  </div>
  <small class="text-danger ">Tanggal Pesan Tiket Ke Maskapai.!</small>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label>Tanggal Belaku</label>
    <input type='date' name="tanggalBerlaku"  id='datetimepicker1' class="form-control" autocomplete="off" />
  </div>
  <small class="text-danger ">Tanggal Berlaku Tiket..!</small>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label>Tanggal Berakhir</label>
    <input type='date' name="tanggalBerakhir"  id='datetimepicker1' class="form-control" autocomplete="off" />
  </div>
  <small class="text-danger ">Tanggal Berakhir Tiket..!</small>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label>Nilai Kerjasama</label>
    <div class='input-group'>
      <input type='number' name="nilaiKerjasama"  id='nilaiKerjasama' class="form-control" autocomplete="off" />
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-euro"></span>
      </span>
    </div>
  </div>
  <small class="text-danger ">Nominal Kerja sama..!</small>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label>Jumlah Kursi</label>
    <div class='input-group'>
      <input type='number' name="kursi"  id='kursi' class="form-control" autocomplete="off" />
      <span class="input-group-addon">
        <span class="fa fa-sort-numeric-desc"></span>
      </span>
    </div>
  </div>
  <small class="text-danger ">Jumlah Kursi.!</small>
</div>
<div class="col-md-3">
  <div class="form-group">
    <label>Nama Pemberi Kerja sama</label>
    <div class='input-group'>
      <input type='text' name="namaPK"  id='namaPK' class="form-control" autocomplete="off" />
      <span class="input-group-addon">
        <span class="fa  fa-text-width"></span>
      </span>
    </div>
  </div>
  <small class="text-danger ">Nama Pekerja Mitra</small>
</div>

<div class="col-sm-6">
 <div class="form-group">
  <label for="username">Dokumen Kerjasama Mitra</label>
  <input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox"  id="ktp" name="ktp">
  <small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
</div>
</div>
</div>

<hr class="line-dashed full-witdh-line" />
<div class="row"> 
 <div class="form-group">
  <div class="col-sm-offset-4 col-sm-10">
   <button type="submit" class="btn btn-raised btn-primary">Simpan</button>
   <a href="<?=base_url().'data/Penerbangan/Travel';?>">
    <button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  </a>
</div>
</div>
</div>
</div>
</form>
</section>
</div>
</section>
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
<script>
  $(document).ready(function() {

    // $('.js-example-basic-single').select2();
    $('#DataNya').on('submit', function (e) {
      e.preventDefault();
      var base_url = "<?php echo base_url();?>";
      var DataNya = $(this);
      $.ajax({
       url: base_url + 'data/Penerbangan/simpanTravel',
       type: "POST",
       data:  new FormData(this),
       contentType: false,
       cache: false,
       processData:false,
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
          window.location.href = base_url + 'data/Penerbangan/TambahKursi?Kursi='+respone.kursi;
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

  });
</script>