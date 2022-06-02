  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pemesanan Tiket</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Pemesanan Tiketting</strong></h3>
  							</div>
  							<?php if($Level == 2){?>
                 <p class='text-danger'><b>Jika Status Pemesanan Layanan ini tunda itu artinya data anda sedang cek oleh admin</b></p>
                 <a href="<?=base_url().'welcome/tiket';?>" target='_blank'> 
                   <button class="btn btn-raised btn-primary">Tambah</button>
                 </a>
               <?php }?>
               <div class="boxs-body">
                <div class="table-responsive">
                 <table id="datatable" class="display" style="width:100%">
                  <thead>
                   <tr>
                    <th>No</th>
                    <th>Kode Tiket</th>
                    <th>Maskapai</th>
                    <th>Tanggal Pesan</th>
                    <th>Jumlah Pesan</th>
                    <th>Total Uang</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                  <th>No</th>
                  <th>Kode Tiket</th>
                  <th>Maskapai</th>
                  <th>Tanggal Pesan</th>
                  <th>Jumlah Pesan</th>
                  <th>Total Uang</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
               <?php
               $no =1;
               foreach ($Pesanan->result_array() as $key ) {
                $Pesawat = $this->db->join('db_penerbangan','db_penerbangan.id=tb_tiket_yeka_madira.id_penerbangan')->get_where('tb_tiket_yeka_madira',array('id_tiket_YKM'=>$key['id_tiket_pesawat_data']))->row_array();
                $Pelanggan= $this->db->get_where('tb_pelanggan',array('id'=>$key['id_pelanggan']))->row_array();
                $CountTotal = $this->db->select('sum(jumlah_uang) as TotalData',FALSE)->get_where('tb_tagihan_tiketing',array('id_tagihannya'=>$key['id_tiket_data_pesan']))->row_array();
                $Total = $this->db->select('sum(jumlah) as TotalData, count(id_keterangan_tiket) as TotalLevel, sum(harga) as HargaNya',FALSE)->get_where('tb_detail_pesan_tiket_pelanggan',array('id_tiket_pemesanan'=>$key['id_tiket_data_pesan']))->row_array();
                ?>
                <tr>
                 <td><?=$no++;?></td>
                 <td><?=$key['id_pesan_tiket_data'];?></td>
                 <td><?=$Pesawat['nama_maskapai'].'/'.$Pesawat['kode_pesawat'];?></td>
                 <td><?=$key['tanggal_pesan'].''.$key['waktu_pesan'];?></td>
                 <td><?=$Total['TotalData'];?> Pesanan</td>
                 <td>Rp. <?=number_format($Total['HargaNya']);?> </td>
                 <td><?=$key['status'] == 1 ? 'Pending' :($key['status'] == 2 ? 'Proses' : ($key['status'] == 3 ? 'Diterima' : 'Batal'));?></td>
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
  $('#datatable').DataTable();
});
</script>