  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Jadwal Berangkat</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
         <div class="col-md-12">
          <section class="boxs ">
           <div class="boxs-header">
            <h3 class="custom-font hb-cyan">
             <strong>Daftar Jadwal Berangkat dan Jumlah Pelanggan</strong></h3>
           </div>
           <div class="boxs-body">
             <div class="table-responsive">
              <table id="datatable" class="display" style="width:100%">
               <thead>
                <tr>
                 <th>No</th>
                 <th>Kode / Nama Paket </th>
                 <th>Jadwal Berangkat</th>
                 <th>Jumlah Keberangkatan</th>
                 <th>Jumlah Jamaah Terdaftar</th>
               </tr>
             </thead>
             <tfoot>
              <tr>
                <th>No</th>
                <th>Kode / Nama Paket </th>
                <th>Jadwal Berangkat</th>
                <th>Jumlah Keberangkatan</th>
                <th>Jumlah Jamaah Terdaftar</th>
              </tr>
            </tfoot>
            <tbody>
             <?php
             $no =1;
             foreach ($paket->result_array() as $value ) {
              $Total = $this->db->select('count(id_pelanggan) as Total')->get_where('tb_keberangakatan',array('paket_id'=>$value['id_paket']))->row_array();
              $d = base64_encode($value['id_paket']);
              echo "
              <tr>
              <td>".$no."</td>
              <td>".$value['kode_paket_data']."-".$value['nama_layanan']."-".$value['id_paket']."</td>
              <td>".date('d-F-Y',strtotime($value['tanggal_berangkat']))."</td>
              <td>".$value['maxPelanggan']." Orang</td>
              <td>
              <a href=
              './CekPelanggan?kodePelangganId=$d'>
              ".$Total['Total']." Orang </a></td>
              </tr>
              ";
              $no++;
            }
            ?>
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