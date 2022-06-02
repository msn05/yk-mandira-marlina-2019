  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pembayaran Tiket</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
         <div class="col-md-12">
          <section class="boxs ">
           <div class="boxs-header">
            <h3 class="custom-font hb-cyan">
             <strong>Daftar Data Pembayaran Tiket</strong></h3>
           </div>
           <div class="boxs-body">
             <div class="table-responsive">
              <table id="datatable" class="display" style="width:100%">
               <thead>
                <tr>
                 <th>No</th>
                 <th>Kode Pembayaran</th>
                 <th>Jumlah Biaya</th>
                 <th>Jumlah Bayar</th>
                 <th>Tanggal Bayar</th>
                 <th>Keterangan</th>
                 <th>Kirim Tiket</th>
               </tr>
             </thead>
             <tfoot>
              <tr>
               <th>No</th>
               <th>Kode Pembayaran</th>
               <th>Jumlah Biaya</th>
               <th>Jumlah Bayar</th>
               <th>Tanggal Bayar</th>
               <th>Keterangan</th>
               <th>Kirim Tiket</th>
             </tr>
           </tfoot>
           <tbody>
            <?php 
            $no = 1;
            foreach ($Tiket->result_array() as $key) {
             $Total = $this->db->select('sum(jumlah) as TotalData, sum(harga) as HargaNya',FALSE)->get_where('tb_detail_pesan_tiket_pelanggan',array('id_tiket_pemesanan'=>$key['id_tagihannya']))->row_array();
             $Pesawat = $this->db->get_where('tb_pesan_tiket',array('id_tiket_data_pesan'=>$key['id_tagihannya']))->row_array();
             $Pesawat1 = $this->db->get_where('tb_file_tiket',array('id_pemesanan'=>$Pesawat['id_pesan_tiket_data']))->row_array();
             ?>
             <tr>
              <td><?=$no++;?></td>
              <td><?=$Pesawat['id_pesan_tiket_data'];?></td>
              <td>Rp. <?=number_format($Total['HargaNya']);?></td>
              <td>Rp. <?=number_format($key['jumlah_uang']);?></td>
              <td><?=$key['tanggal_post'];?></td>
              <td><?=$key['keterangan'];?></td>

              <td>
                <?=$key['jumlah_uang'] == $Total['HargaNya'] ? ''.($Pesawat['id_pesan_tiket_data'] != $Pesawat1['id_pemesanan'] ? '<a href='.base_url().'data/CetakTiketPelanggan/Buat?idData='.base64_encode($Pesawat['id_pesan_tiket_data']).''.'>
                  <button class="fa fa-plus" title="Buat Tiket">
                  </button> 
                  </a>' : '').'' : '';?>
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
</section>
<script type="text/javascript">
  $('#datatable').DataTable();
</script>