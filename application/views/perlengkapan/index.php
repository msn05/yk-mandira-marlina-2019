  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Perlengkapan Lanjutan Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="row">
  					<div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Perlengkapan Lanjutan</strong></h3>
                 </div>
                 <a href="<?=base_url().'index.php/data/Perlengkapan/form';?>">
                  <button class="btn btn-raised btn-primary">Tambah Perlengkapan</button>
                </a>
                <div class="boxs-body">
                  <div class="table-responsive">
                   <table id="datatable" class="display" style="width:100%">
                    <thead>
                     <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Status Perlengkapan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Status Perlengkapan</th>
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
</div>
</section>

<script>

 $(document).ready(function() {
  var base_url = "<?php echo base_url();?>";
  $('#datatable').DataTable({
   "serverSide": true,
   "cache"  : true,
   "ajax":{
    url :  base_url + 'index.php/data/Perlengkapan/Data',
    type : 'POST',
  },
  "columnDefs": [{ 
    "targets": [0],
    "orderable": false
  }]
});
  $('#datatable').on('click','.remove',function(){
    var id      = $(this).attr('id');
    var nama    = $(this).attr('nama');
    swal({
     title: "Anda Yakin ingin Menonaktifkan Pemberlakuan ini.. ?",
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
       url: 'Perlengkapan/HapusPerlengkapan?id='+id+'',
       type: 'POST',
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
  $('#datatable').on('click','.Aktifkan',function(){
    var id      = $(this).attr('id');
    var nama    = $(this).attr('nama');
    swal({
      title: "Anda Yakin ingin Memberlakukan Perlengkapan ini.. ?",
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
       url: 'Perlengkapan/AktifkanPerlengkapan?id='+id+'',
       type: 'POST',
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