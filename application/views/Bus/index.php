  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Bus Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="row">
  					<div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Bus</strong></h3>
  									<div class="pull-right">
  										<h3 class="custom-font ">
  											<strong>Kapasitas :</strong></h3>
  											<span class="label label-success">Masih</span>
  											<span class="label label-default">Habis</span>
  										</div>
  									</div>
  									<?= $this->session->flashdata('message');?>
  									<a href="<?=base_url().'data/bus/form';?>">
  										<button class="btn btn-raised btn-primary">Tambah Bus</button>
  									</a>
  									<div class="boxs-body">
  										<div class="table-responsive">
  											<table id="datatable" class="display" style="width:100%">
  												<thead>
  													<tr>
  														<th>No</th>
  														<th>Kode Bus</th>
  														<th>Nama Bus</th>
  														<th>Jumlah</th>
  														<th>Status</th>
                              <th>Info Data</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tfoot>
                           <tr>
                            <th>No</th>
                            <th>Kode Bus</th>
                            <th>Nama Bus</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Info Data</th>
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
           url :  base_url + 'data/Bus/Data',
           type : 'POST',
         },
         "columnDefs": [{ 
           "targets": [0],
           "orderable": false
         }]
       });
       $('#datatable').on('click','.remove',function(){
         var id         = $(this).attr('id');
         var nama       = $(this).attr('nama');
         swal({
          title: "Anda Yakin ingin Menghapus Data Ini ?",
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
            url: 'bus/delete',
            data : {id:id},
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
               window.location.href = base_url + 'data/bus';
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
           swal("Batal", "Anda Telah Membatal ", "error");
         }
       });
       });
     });


   </script>