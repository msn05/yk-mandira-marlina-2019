  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pelanggan Yeka Madira Palembang</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Nama-nama Pelanggan </strong></h3>
  							</div>
  							<a href="<?=base_url().'data/pelanggan/form';?>"> 
  								<button class="btn btn-raised btn-primary">Tambah Data Pelanggan</button>
  							</a>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable" class="display" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Nama Pelanggan</th>
  												<th>NIK</th>
                          <th>Nomor WA</th>
                          <th>Tanggal Daftar</th>
                          <th>Berkas Data</th>
                          <?php if($Level != 2 || $Level != 4){?>
                            <th>Action</th>
                          <?php }?>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Nama Pelanggan</th>
                          <th>NIK</th>
                          <th>Nomor WA</th>
                          <th>Tanggal Daftar</th>
                          <th>Berkas Data</th>
                          <?php if($Level != 2 || $Level != 4){?>
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
    </section>

    <script>

      $(document).ready(function() {
       var base_url = "<?php echo base_url();?>";
       $('#datatable').DataTable({
        "serverSide": true,
        "cache"  : true,
        "ajax":{
         url :  base_url + 'data/pelanggan/data',
         type : 'POST',
       },
       "columnDefs": [{ 
         "targets": [0],
         "orderable": false
       }]
     });

     });
   </script>