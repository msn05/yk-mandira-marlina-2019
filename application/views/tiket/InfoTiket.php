  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Info Ketentuan Harga</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<section class="boxs">
  						<div class="boxs-body">
  							<div class="pull-left">
  								<h3 class="custom-font">
  									<strong>INFORMASI TIKET</strong></h3>
  								</div>
  								<div class="pull-right">
                    <a type="submit" title='cetak data'  id='PrintData' href='<?=base_url().'data/ticketing/laporan?idDataTiket='.base64_encode($idLaporan).'';?>' class='btn btn-primary btn-raised'><i  class=' fa fa-print' >
                    </i>
                  </a>
                  <a href="<?=base_url().'data/ticketing';?>"><button class="btn btn-warning btn-raised">Kembali</button></a> 
                </div>
                <div class="table-responsive">
                 <table id="datatable"  class="table-bordered" style="width:100%">
                  <thead>
                   <tr>
                    <th>No</th>
                    <th>Ketentuan</th>
                    <th>Jumlah</th>
                    <th>Harga / Kursi</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                  <th>No</th>
                  <th>Ketentuan</th>
                  <th>Jumlah</th>
                  <th>Harga / Kursi</th>
                  <th>#</th>
                </tr>
              </tfoot>
              <tbody>
               <?php 
               $no = 1;
               foreach ($KursiData->result_array() as $key ) {?>
                <tr>
                 <td><?=$no++;?></td>
                 <td><?=$key['level'] == 1 ? 'Anak-anak' : 'Dewasa' ;?></td>
                 <td><?=$key['jumlah'];?> Kursi</td>
                 <td>Rp. <?=number_format($key['harga']);?></td>
                 <td>
                  <a href="<?=base_url().'data/ticketing/UbahDataTiket?idData='.base64_encode($key['id']).'';?>" title='Ubah Data'><i class="fa fa-edit"></i></a>
                </td>
              </tr>
              <?php 
            }
            ?>
            <tr>
              <th>Total Data </th>
              <th><?=$TotalLevel['TotalLevel'];?> Aksi Ketentuan</th>
              <th><?=$TotalLevel['TotalData'];?> Kursi</th>
              <th colspan="2">Rp. <?=number_format($TotalLevel['HargaNya']);?> </th>
            </tr>
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