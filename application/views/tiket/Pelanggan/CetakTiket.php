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
                  <p class="text-danger"><b>Bapak ibu yang sudah mendapatkan nomor pesanan tiket diharapkan datang 1 jam lebih awal karena untuk menukarkan tiket asli kepada loket maskapai yang bersangkutan terlebih dahulu dan Sekaligus melakukan boarding pass </b></p>
                </div>
                <div class="boxs-body">
                  <div class="table-responsive">
                   <table id="datatable" class="display" style="width:100%">
                    <thead>
                     <tr>
                      <th>No</th>
                      <th>Nama Maskapai</th>
                      <th>Kode Pesawat</th>
                      <th>Dari</th>
                      <th>Tujuan</th>
                      <th>Nomor Kursi</th>
                      <th>Nomor Pesanan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                    <th>No</th>
                    <th>Nama Maskapai</th>
                    <th>Kode Pesawat</th>
                    <th>Dari / bandara</th>
                    <th>Tujuan / bandara</th>
                    <th>Nomor Kursi</th>
                    <th>Nomor Pesanan</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                 <?php
                 $no = 1;
                 foreach ($variable->result_array() as $key ) {
                  $Pesawat = $this->db->join('db_penerbangan a','a.id=b.id_penerbangan_kursi')->get_where('db_penerbangan_kursi b',array('b.id'=>$key['nomor_tiket']))->row_array();
                  ?>
                  <tr>
                   <td><?=$no++;?></td>
                   <td><?=$Pesawat['nama_maskapai'];?></td>
                   <td><?=$Pesawat['kode_penerbangan'];?></td>
                   <td><?=$key['to']. ' / '.$key['bandara1'];?></td>
                   <td><?=$key['form']. ' / '.$key['bandara2'];?></td>
                   <td><?=strtoupper($Pesawat['nomor_kursi']);?></td>
                   <td><?=$key['id_pemesanan'];?></td>
                   <td> <a href="<?=base_url().'data/CetakTiketPelanggan/CetakTiketNya?idData='.base64_encode($key['id_pemesanan']).'';?>">
                    <button class="fa fa-print" title="Cetak Tiket">
                    </button> 
                  </a></td>
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