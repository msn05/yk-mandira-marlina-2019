  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Akses Menu</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
          </div>
          <div class="row">
           <div class="col-md-12">
            <section class="boxs ">
             <div class="boxs-header">
              <h3 class="custom-font hb-cyan">
               <strong>Daftar Menu</strong></h3>
             </div>
             <a href="<?=base_url().'menu/form';?>">
               <button class="btn btn-raised btn-primary">Tambah Data</button>
             </a>
             <div class="boxs-body">
               <?= $this->session->flashdata('message');?>
               <div class="table-responsive">
                 <table id="datatable" class="display" style="width:100%">
                  <thead>
                   <tr>
                    <th>Id Menu</th>
                    <th>Nama Menu</th>
                    <th>Url</th>
                    <th>Kategori Menu</th>
                    <th>Akses Menu</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                  <th>Id Menu</th>
                  <th>Nama Menu</th>
                  <th>Url</th>
                  <th>Kategori Menu</th>
                  <th>Akses Menu</th>
                  <th>Tanggal</th>
                  <th>Status</th>
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
      url :  base_url + 'Menu/Data',
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
            url: 'delete/'+id,
            type: 'POST',
            error: function() {
              alert('Terjadi Kesalahan');
            },
            success: function(data) {
              swal({
                title: "Update",
                text: "Berhasil Menonaktifkan Menu Tersebut.",
                type: "success",
                timer: 1200
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
        closeOnConfirm: false
      },
      function (Komfirmasi) {
        if (Komfirmasi) {
          $.ajax({
            url: 'aktif/'+id,
            type: 'POST',
            error: function() {
              alert('Terjadi Kesalahan');
            },
            success: function(data) {
              swal({
                title: "Berhasil",
                text: "Berhasil Mengaktifkan Menu Tersebut.",
                type: "success",
                timer: 1200
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


  });
</script>