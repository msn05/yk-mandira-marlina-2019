  <section id="content">
    <div class="page page-forms-common">
      <!-- bradcome -->
      <div class="b-b mb-10">
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <h1 class="h3 m-0">Histori Pemesanan Paket</h1>
            <small class="text-muted">Welcome to Falcon application</small>
          </div>
          <div class="col-md-10">
            <section class="boxs ">
             <div class="boxs-header">
              <h3 class="custom-font hb-cyan">
                <strong>Daftar Pemesanan Paket</strong></h3>
              </div>
              <div class="boxs-body">
               <?php if($Level == 4){?>
                <div class="pull-right">
                  <a href="<?=base_url().'data/Paket/CetakHistoriPemesanan';?>">
                    <button title="Print Data" class="btn btn-raised btn-success"><i class="fa fa-print"></i></button>
                  </a>
                </div>
              <?php }?>
              <div class="table-responsive">
                <table id="datatable" class="display" style="width:100%">
                 <thead>
                  <tr>
                   <th>No</th>
                   <th>Kode / Nama Paket </th>
                   <th>Bulan Tahun</th>
                   <th>Jumlah Pelanggan Terdaftar</th>
                 </tr>
               </thead>
               <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode / Nama Paket </th>
                  <th>Bulan Tahun</th>
                  <th>Jumlah Pelanggan Terdaftar</th>
                </tr>
              </tfoot>
              <tbody>
                <?php 
                $no =1;
                foreach ($paket->result_array() as $value ) {
                 $Total = $this->db->select('count(id_pelanggan) as Total')->get_where('tb_keberangakatan',array('paket_id'=>$value['id_paket']))->row_array();
                 $TotalData = $this->db->get_where('tb_pemasanan_paket',array('id_paket'=>$value['id_paket']))->row_array();?>
                 <tr>
                   <td><?=$no++;?></td>
                   <td><?=$value['kode_paket_data']."-".$value['nama_layanan']."-".$value['id_paket'];?></td>
                   <td><?=$TotalData['tanggal_pesan'] != ''? ''.date('d-F-Y',strtotime($TotalData['tanggal_pesan'])).''  : 'Belum Pemesanan';?></td>
                   <td><?=$Total['Total']. ' Pelanggan';?></td>
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
</section>

<script>
  $(document).ready(function() {
   $('#datatable').DataTable();
 });
</script>