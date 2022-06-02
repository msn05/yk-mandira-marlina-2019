  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Tiketting</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Tiketting</strong></h3>
  							</div>
  							<a href="<?=base_url().'data/Ticketing/formTiketing';?>">
  								<button class="btn btn-raised btn-primary">Tambah Tiket</button>
  							</a>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable" class="display" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Nama Maskapai</th>
                          <th>Kode Pesawat</th>
                          <th>Form</th>
                          <th>To</th>
                          <th>Jam</th>
                          <th>Jumlah Kursi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                       <tr>
                        <th>No</th>
                        <th>Nama Maskapai</th>
                        <th>Kode Pesawat</th>
                        <th>Form</th>
                        <th>To</th>
                        <th>Jam</th>
                        <th>Jumlah Kursi</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($variable->result_array() as $key ) {
                        $PenerbanganData = $this->db->get_where('db_penerbangan',array('id'=>$key['id_penerbangan']))->row_array();
                        ?>
                        <tr>
                          <td><?=$no++;?></td>
                          <td><?=$PenerbanganData['nama_maskapai'];?></td>
                          <td><?=$key['kode_pesawat'];?></td>
                          <td><?=$key['form'];?></td>
                          <td><?=$key['to'];?></td>
                          <td><?=$key['waktu_berangkat'];?></td>
                          <td>
                            <a href="<?=base_url().'data/Ticketing/InfoKursi?idKuris='.base64_encode($key['id_data_tiket']).'';?>"><?=$key['Jumlah_tiket'];?> Kursi </a></td>
                            <td>
                              <a href="<?=base_url().'data/Ticketing/UbahData?idData='.base64_encode($key['id_tiket_YKM']).'';?>">
                                <button class="fa fa-edit" title="ubah data">
                                </button> 
                              </a>
                              <a href="<?=base_url().'data/Ticketing/TambahPesanan?idData='.base64_encode($key['id_tiket_YKM']).'';?>">
                                <button class="fa fa-plus" title="tambah pelanggan">
                                </button> 
                              </a>
                            </td>
                          </tr>

                        <?php }?>
                      </tbody>
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
    $('#datatable').DataTable();
  });
</script>