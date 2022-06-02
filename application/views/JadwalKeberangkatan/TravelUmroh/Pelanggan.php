  <?php error_reporting(0);?>
  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pelanggan Paket Berangkat</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
         <div class="col-md-12">
          <section class="boxs ">
           <div class="boxs-header">
            <h3 class="custom-font hb-cyan">
              <strong>Daftar Pelanggan Paket yang Akan Berangkat</strong></h3>
            </div>
            <a href="<?=base_url().'home';?>" class="btn btn-warning btn-raised ">Kembali</a>
            <div class="boxs-body">
             <div class="table-responsive">
              <table id="datatable" class="display" style="width:100%">
               <thead>
                <tr>
                 <th>No</th>
                 <th>NIK </th>
                 <th>Nama Pelanggan </th>
                 <th>Alamat</th>
                 <th>Nomor Telphone</th>
               </tr>
             </thead>
             <tfoot>
              <tr>
               <th>No</th>
               <th>NIK </th>
               <th>Nama Pelanggan </th>
               <th>Alamat</th>
               <th>Nomor Telphone</th>
             </tr>
           </tfoot>
           <tbody>
            <?php 
            $no = 1;
            foreach ($detailPelanggan->result_array() as $key) {
              echo'
              <tr>
              <td>'.$no++.'</td>
              <td>'.$key['no_ktp'].'</td>
              <td>'.$key['nama_lengkap'].'</td>
              <td>'.$key['alamat'].'</td>
              <td>'.$key['nomor_telphone'].'</td>

              </tr>';
            }?>

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

<script>
  $(document).ready(function() {
   $('#datatable').DataTable();
 });
</script>