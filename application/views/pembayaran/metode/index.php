<section id="content">
 <div class="page page-forms-common">
  <!-- bradcome -->
  <div class="b-b mb-12">
   <div class="row">
    <div class="col-sm-6 col-xs-12">
     <h1 class="h3 m-0">Metode Pembayaran</h1>
     <small class="text-muted">Welcome to Falcon application</small>
   </div>
 </div>
 <div class="row">
   <div class="col-md-8">
    <section class="boxs ">
     <div class="boxs-header">
      <h3 class="custom-font hb-cyan">
       <strong>Daftar Metode Pembayaran</strong></h3>
     </div>
     <?php if($Level == 1){?>
      <a href="<?=base_url().'data/Metode_pembayaran/form';?>">
       <button class="btn btn-raised btn-primary">Tambah </button>
     </a>
   <?php }?>
   <div class="boxs-body">
     <div class="table-responsive">
      <table id="datatable" class="display" style="width:100%">
       <thead>
        <tr>
         <th>No</th>
         <th>Nama Metode</th>
         <th>Jumlah Keterangan</th>
         <?php if($Level == 1){?>
           <th>Action</th>
         <?php }?>
       </tr>
     </thead>
     <tfoot>
      <tr>
       <th>No</th>
       <th>Nama Metode</th>
       <th>Jumlah Keterangan</th>
       <?php if($Level == 1){?>
         <th>Action</th>
       <?php }?>
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
</div>
</div>
</section>

<script>

 $(document).ready(function() {

  $('#DataNya').on('submit', function (e) {
   e.preventDefault();
   var base_url = "<?php echo base_url();?>";
   var DataNya = $(this);
   $.ajax({
    type: "POST",
    url: base_url + 'index.php/data/Metode_pembayaran/SimpanBaru',
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
       window.location.href = base_url + 'data/metode_pembayaran';
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

  var base_url = "<?php echo base_url();?>";
  $('#datatable').DataTable({
   "serverSide": true,
   "cache"  : true,
   "ajax":{
    url :  base_url + 'data/metode_pembayaran/Data',
    type : 'POST',
  },
  "columnDefs": [{ 
    "targets": [0],
    "orderable": false
  }]
});


  $('#datatable').on('click','.Hapus',function(){
   var id      = $(this).attr('id');
   var nama    = $(this).attr('nama');
   swal({
    title: "Anda Yakin ingin Menghapus ?",
    text: "Ada memilih data "+nama ,
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
      url: 'metode_pembayaran/HapusMetode',
      type: 'POST',
      data : {id:id},
      dataType : "JSON",
      cache : false,
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
       },
       function () {
         location.reload(true);
       });
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