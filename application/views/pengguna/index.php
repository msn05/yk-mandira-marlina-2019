  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pengguna Sistem</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
         <div class="col-md-12">
          <section class="boxs ">
           <div class="boxs-header">
            <h3 class="custom-font hb-cyan">
             <strong>Daftar Pengguna</strong></h3>
             <div class="pull-right">
              <h3 class="custom-font ">
               <strong>Status AKun :</strong></h3>
               <span class="label label-success">Aktif</span>
               <span class="label label-warning">Tidak Aktif</span>
             </div>
           </div>
           <a href="<?=base_url().'data/Karyawan/form';?>"> 
            <button class="btn btn-raised btn-primary">Tambah Karyawan</button>
          </a>
          <div class="boxs-body">
            <div class="table-responsive">
             <table id="datatable" class="display" style="width:100%">
              <thead>
               <tr>
                <th>No</th>
                <th>Id Akses</th>
                <th>Nama Pengguna</th>
                <th>Password</th>
                <th>Level</th>
                <th>Nomor WA</th>
                <th>Status Akun</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
             <tr>
              <th>No</th>
              <th>Id Akses</th>
              <th>Nama Pengguna</th>
              <th>Password</th>
              <th>Level</th>
              <th>Nomor WA</th>
              <th>Status Akun</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>
</div>
</div>
</div>
</div>
</section>

<script>

 $(document).ready(function() {
  var base_url = "<?php echo base_url();?>";
  $('#datatable').DataTable({
   "serverSide": true,
   "cache"  : true,
   "ajax":{
    url :  base_url + 'data/Pengguna/Data',
    type : 'POST',
  },
  "columnDefs": [{ 
    "targets": [0],
    "orderable": false
  }]
});

  $('#datatable').on('click','.remove',function(){
   var id    = $(this).attr('id');
   var nama  = $(this).attr('nama');
   swal({
    title: "Anda Yakin ingin Menonaktifkan ?",
    text: "Ada memilih data "+nama,
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
      url: 'pengguna/NonAktifkan/'+id,
      type: 'POST',
      error: function() {
       swal({
        title: "error",
        text: "Gagal Menonaktifkan.",
        type: "error",
        timer: 1200
      });
     },
     success: function(data) {
       swal({
        title: "Update",
        text: "Berhasil Menonaktifkan Pengguna Tersebut.",
        type: "success",
        timer: 1200
      },
      function () {
        window.location.href = base_url + 'data/pengguna';
      });
     }
   });

   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });

  $('#datatable').on('click','.aktif',function(){
   var id    = $(this).attr('id');
   var nama  = $(this).attr('nama');
   swal({
    title: "Anda Yakin ingin Mengaktifkan ?",
    text: "Ada memilih data "+nama,
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
      url: 'pengguna/Aktif/'+id,
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
         window.location.href = base_url + 'data/pengguna';
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
  $('#datatable').on('click','.whatshapp',function(){
    var id=$(this).val('number');
    console.log(id);
    var md    = new MobileDetect(window.navigator.userAgent);
    if (md.mobile()) {
      document.getElementById("whatshapp").href = "https://wa.me/" + id;
    } else {
      document.getElementById("whatshapp").href = "https://web.whatsapp.com/send?phone=" + id;
    }
  });
  $('#datatable').on('click','.delete',function(){
   var id    = $(this).attr('id');
   var nama  = $(this).attr('nama');
   swal({
    title: "Anda Yakin ingin Menghapus Pengguna Ini ?",
    text: "Ada memilih data "+nama,
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
      url: 'pengguna/delete/'+id,
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
         window.location.href = base_url + 'data/pengguna';
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




});
</script>