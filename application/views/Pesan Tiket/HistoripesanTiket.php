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
                <?php if($Level == 4){?>
                 <a href="<?=base_url().'data/PesanTiket/CetakHistoriTiket';?>" class="btn btn-warning btn-raised fa fa-print"></a>
               <?php }?>
               <div class="boxs-body">
                <div class="table-responsive">
                 <table id="datatable" class="display" style="width:100%">
                  <thead>
                   <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Pesan</th>
                    <th>Tanggal Pesan</th>
                    <th>Status Pesanan</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                  <th>No</th>
                  <th>Nama Pelanggan</th>
                  <th>Jumlah Pesan</th>
                  <th>Tanggal Pesan</th>
                  <th>Status Pesanan</th>
                </tr>
              </tfoot>
              <tbody>
               <?php
               $no =1;
               foreach ($Pesanan->result_array() as $key ) {
                $Pelanggan= $this->db->get_where('tb_pelanggan',array('id'=>$key['id_pelanggan']))->row_array();
                $Total = $this->db->select('sum(jumlah) as TotalData, count(id_keterangan_tiket) as TotalLevel, sum(harga) as HargaNya',FALSE)->get_where('tb_detail_pesan_tiket_pelanggan',array('id_tiket_pemesanan'=>$key['id_tiket_data_pesan']))->row_array();
                ?>
                <tr>
                 <td><?=$no++;?></td>
                 <td><?=$Pelanggan['nama_lengkap'];?></td>
                 <td><?=$Total['TotalData'];?> Pesanan</td>
                 <td><?=$key['tanggal_pesan'];?> </td>
                 <td><?=$key['status'] == 1 ? 'pending' :($key['status'] == 2 ? 'Proses' : ($key['status'] == 3 ? 'Selesai' : 'Batal'));?></td>
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