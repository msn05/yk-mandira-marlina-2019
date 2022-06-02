  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Penerbangan Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="row">
  					<div class="col-md-12">
  						<section class="boxs ">
  							<div class="boxs-header">
  								<h3 class="custom-font hb-cyan">
  									<strong>Daftar Penerbangan Maskapai <i class="text-danger"><?=$namaMaskapai;?></i></strong></h3>
  								</div>
                  <hr class="line-dashed full-witdh-line" />
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                       <div class="pull-left">
                         <h4 class="text-right">
                          <img src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/images/airplane.png';?>" width="120" alt="img">
                        </h4>
                        <br>
                        <address>
                          <strong><?=$namaMaskapai;?></strong>
                          <br> <?=$kodePenerbangan;?>
                        </address>
                      </div>
                      <div class="pull-right mt-20">
                        <table class="table display"">
                          <tr>
                            <td><strong>Tanggal Pesan</strong></td>
                            <td>:</td>
                            <td><?=date('d-m-Y H:i:s', strtotime($tanggalPesan));?></td>
                          </tr>
                          <tr>
                            <td><strong>Jumlah Kursi</strong></td>
                            <td>:</td>
                            <td><?=count($Kursi);?> Kursi</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <hr class="line-dashed full-witdh-line" />
                  <div class="col-md-6">
                   <div class="table-responsive">
                    <table id="myTable" class="table table-condensed">
                     <thead>
                      <tr>
                       <th>No</th>
                       <th>Nomor Kursi</th>
                       <th>Status Kursi</th>
                     </tr>
                   </thead>
                   <tbody>
                    <?php 
                    $no=1; 
                    foreach ($Kursi as $key =>$value) {?>
                      <tr>
                        <td><?=$no;?></td>                    
                        <td><?=$value->nomor_kursi;?></td>                    
                        <td><?=$value->status_kursi == 0 ? '<span class="label label-success label-pill">Sudah Ada Pelanggan</span>' : '<span class="label label-warning label-pill">Tidak Ada</span>';?></td>                    
                      </tr>
                      <?php $no++; 
                    }?>
                  </tbody>
                  <tfoot>
                    <tr>
                     <th>No</th>
                     <th>Nomor Kursi</th>
                     <th>Status Kursi</th>
                   </tr>
                 </tfoot>
               </table>
             </div>
           </div>
           <div class="col-md-6">
            <div class="boxs-header bg-info">
              <h3 class="custom-font">
                <strong>Keterangan</strong></h3>
              </div>
              <div class="table-responsive">
                <div class="form-group">
                  <label class="text-muted"> Halaman ini menampilkan informasi penerbangan Travel Umroh dan Haji</label>
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
  $(document).ready( function () {
    $('#myTable').DataTable();
  } );
</script>