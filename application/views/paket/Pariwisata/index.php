  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Paket Pariwisata</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Paket Pariwisata</strong></h3>
  							</div>
  							<?= $this->session->flashdata('message');?>
                <?php if($Level == 1 || $Level == 3) {?>
                 <a href="<?=base_url().'data/paket/formPariwisata';?>">
                  <button class="btn btn-raised btn-primary">Tambah Pariwisata</button>
                </a>
              <?php }elseif($Level == 2){?>
                <a href="<?=base_url().'welcome/pariwisata';?>">
                  <button class="btn btn-raised btn-primary">Tambah</button>
                </a>
              <?php }?>
              <div class="boxs-body">
                <div class="table-responsive">
                 <table id="datatable" class="display" style="width:100%">
                  <thead>
                   <tr>
                    <th>No</th>
                    <th>Kode Paket</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Masa Berlaku</th>
                    <th>Maximal Pelanggan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                  <th>No</th>
                  <th>Kode Paket</th>
                  <th>Nama Paket</th>
                  <th>Harga</th>
                  <th>Masa Berlaku</th>
                  <th>Maximal Pelanggan</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
               <?php
               $no =1;
               foreach ($paket->result_array() as $value ) {
                $d = base64_encode($value['id_paket']);
                echo "
                <tr>
                <td>".$no."</td>
                <td><a href='informasiPaket?idData=".$d."'>".$value['id_paket']."</a></td>
                <td>".$value['kode_paket_data']."-".$value['nama_layanan']."</td>
                <td>Rp. ". number_format($value['harga'],2,',','.')."</td>
                <td>".date('d-F-Y',strtotime($value['tanggal_Berakhir']))."</td>
                <td>".$value['maxPelanggan']." Orang</td>
                <td>
                <a href='./UbahDataPaketParis?idData=".$d."' type='button' class='btn btn-primary btn-raised' title='Ubah'>Ubah</a>
                </td>
                </tr>
                ";
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
</div>
</section>

<script>
  $(document).ready(function() {
   var base_url = "<?php echo base_url();?>";
   $('#datatable').DataTable();
 });
</script>