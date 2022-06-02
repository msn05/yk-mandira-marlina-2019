  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Laporan Pelanggan Yeka Madira Palembang</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Nama-nama Pelanggan </strong></h3>
  							</div>
  							<a href="<?=base_url().'data/laporan/data?idData='.base64_encode('Pelanggan').'';?>" class="btn btn-raised btn-primary">Kembali
  							</a>
  							<a title="Cetak" href="<?=base_url().'data/Laporan/CetakPelanggan?date1='.$date1.'&date2='.$date2.'';?>" class="btn btn-raised btn-success "> <i class="fa fa-print"></i></a>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Nama Pelanggan</th>
  												<th>NIK</th>
  												<th>NO KK</th>
  												<th>Alamat</th>
  												<th>Jenis Kelamin</th>
  												<th>TTL</th>
  											</tr>
  										</thead>
  										<tbody>
  											<?php 
  											$no =1;
  											foreach ($Pelanggan->result_array() as $key ) {?>
  												<tr>
  													<td><?=$no++;?></td>
  													<td><?=$key['nama_lengkap'];?></td>
  													<td><?=$key['no_ktp'];?></td>
  													<td><?=$key['no_kk'];?></td>
  													<td><?=$key['alamat'];?></td>
  													<td><?=$key['jenis_kelamin'] == 1 ?'Laki-laki':'Perempuan';?></td>
  													<td><?=$key['tempat_lahir'] .','. $key['tanggal_lahir'];?></td>
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
