  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Tiket Cetak</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Tiketting Pesawat yang dicetak</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable" class="display" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Nama Maskapai</th>
                          <th>Kode Pesawat</th>
                          <th>Nomor Kursi</th>
                          <th>Nomor Pesanan</th>
                          <th>Nama Pelanggan</th>
                        </tr>
                      </thead>
                      <tfoot>
                       <tr>
                        <th>No</th>
                        <th>Nama Maskapai</th>
                        <th>Kode Pesawat</th>
                        <th>Nomor Kursi</th>
                        <th>Nomor Pesanan</th>
                        <th>Nama Pelanggan</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($variable->result_array() as $key ) {
                        $Pesawat = $this->db->join('db_penerbangan a','a.id=b.id_penerbangan_kursi')->get_where('db_penerbangan_kursi b',array('b.id'=>$key['nomor_tiket']))->row_array();
                        
                        $Pelanggan = $this->db->join('tb_pelanggan a','a.id=b.id_pelanggan')->get_where('tb_pesan_tiket b',array('b.id_pesan_tiket_data'=>$key['id_pemesanan']))->row_array();
                        ?>
                        <tr>
                          <td><?=$no++;?></td>
                          <td><?=$Pesawat['nama_maskapai'];?></td>
                          <td><?=$Pesawat['kode_penerbangan'];?></td>
                          <td><?=$Pesawat['nomor_kursi'];?></td>
                          <td><?=$key['id_pemesanan'];?></td>
                          <td><?=$Pelanggan['nama_lengkap'];?></td>
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