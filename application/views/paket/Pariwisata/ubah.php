  <section id="content">
  	<div class="page page-ui-portlets">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Paket Travel</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<form method="POST" id="SimpanData" action="<?=base_url().'data/paket/updatePaketParis';?>" >
  			<div class="row">
  				<div class="col-sm-12">
  					<section class="boxs">
  						<div class="boxs-header bg-blush">
  							<h3 class="custom-font">
  								<strong>Form Ubah Paket Travel</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="boxs-body">
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="username">Kode Paket</label>
  												<input type="text" value="<?=$namaPaket;?>" class="form-control" placeholder="Kode Paket..!" id="kodePaket"  name="kodePaket" readonly/>
  												<small class="text-danger ">* Harap Kode Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Nama Paket</label>
  												<input type="text" class="form-control" id="namapaket" name="namapaket"placeholder="Nama Paket..!" value="<?=$kode_paket_data;?>" autocomplete="off" />
  												<small class="text-danger ">* Harap isi Nama Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Nama Layanan</label>
  												<select tabindex="3"  name="layanan" id="layanan" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Layanan</option>
  													<?php foreach ($Layanan as $key => $value) {?>
  														<option value="<?=$value->id_layanan;?>"<?=$value->id_layanan == $id_layanan ? 'selected' : '';?>><?=$value->nama_layanan;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Nama Layanan..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-2">
  											<div class="col-sm-12">
  												<label for="password">Harga Paket</label>
  												<input type="number" value="<?=$harga;?>" class=" form-control" id="harga" name="harga"placeholder="Harga Paket" autocomplete="off" />
  												<small class="text-danger ">* Harga Paket</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Lama Perjalanan</label>
  												<input type="number" value="<?=$lama_perjalanan;?>" class="form-control" id="lama_perjalanan" name="lama_perjalanan"placeholder="Nama Paket..!" autocomplete="off" />
  												<small class="text-danger ">* Lama Perjalanan</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Tanggal Berakhir Paket</label>
  												<input type="text" value="<?=$tanggalAkhir;?>" class="date form-control" id="TanggalBerakhir" name="TanggalBerakhir"placeholder="Tanggal Berakhir Paket" autocomplete="off" />
  												<small class="text-danger ">* Tanggal Berakhir Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Bus Operasional Paket</label>
  												<select tabindex="3"  name="transBus" id="transBus" class="form-control" style="width: 100%;">
  													<option value="0"> Pilih Bus</option>
  													<?php foreach ($Bus as $key=> $value ) {?>
  														<option value="<?=$value->id;?>" <?=$value->id == $id_transportasi_paket ? 'selected' : '';?>><?=$value->nama_bus;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">*  Jenis Transportasi..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Pembayaran</label>
  												<select tabindex="3"  name="MetodeTravel" id="MetodeTravel" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Pembayaran</option>
  													<?php foreach ($Metode as $key => $value) {?>
  														<option value="<?=$value->id_metode_pembayaran;?>"<?=$value->id_metode_pembayaran == $id_metode_pembayaran_paket ? 'selected' : '';?>><?=$value->metode;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* metode Pembayaran..!</small>
  											</div>
  										</div>
  									</div>
  									
  									<div class="row">
  										<div class="form-group col-sm-3">
  											<div class="col-sm-12">
  												<label for="password">Tanggal Berangkat</label>
  												<input type="text" value="<?=$TanggalBerangkat;?>" class="date form-control" id="tanggalberangkat" name="tanggalberangkat"placeholder="Tanggal Berangkat..!" autocomplete="off" />
  												<small class="text-danger ">* Tanggal Berangkat</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Jumlah Max Pelanggan</label>
  												<input type="number" value="<?=$JumlahPelanggan;?>" class="form-control" id="pelanggan" name="pelanggan"placeholder="Jumlah Pelanggan..!" autocomplete="off" />
  												<small class="text-danger ">* Jumlah Maximal Pelanggan</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Maskapai Penerbangan</label>
  												<select tabindex="3"  name="penerbanganData" id="penerbanganData" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Pembayaran</option>
  													<?php foreach ($Penerbangan as $key => $value) {?>
  														<option value="<?=$value->id;?>"<?=$value->id == $idPenerbangan ? 'selected' : '';?>><?=$value->nama_maskapai. '-'.$value->kode_penerbangan;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Maskapai Penerbangan</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Kota Start</label>
  												<input type="text" name="start_in" id="start_in" class="form-control" value="<?=$start_in;?>">
  												<small class="text-danger">* Dimulai dari Kota</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Tujuan Kota</label>
  												<input type="text" name="end_ind" id="end_ind" class="form-control" value="<?=$end_ind;?>">
  												<small class="text-danger">* Tujuan Kota</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-12">
  											<div class="col-sm-12">
  												<label for="password">Catatan Paket</label>
  												<textarea class="form-control" name="catatan"  id="catatan" ><?=$catatan;?></textarea>
  												<small class="text-danger ">Jika Ada Catatan Dalam Paket ini Silakan Isi..!</small>
  											</div>
  										</div>
  									</div>

  								</div>
  								<hr class="line-dashed full-witdh-line" />
  								<div class="row">
  									<div class="form-group">
  										<div class="col-sm-offset-5 col-sm-10">
  											<button type="submit" class="btn btn-raised btn-primary">Update</button>
  											<a href="<?=base_url().'data/paket/travel';?>">
  												<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  											</a>
  										</div>
  									</div>
  								</div>
  							</section>
  						</div>
  					</div>
  				</form>
  			</div>
  		</section>
  		<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
  		<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
  		<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
  		<script>
  			CKEDITOR.replace( 'catatan',{
  				height: 200
  			});
  			$('.js-example-basic-single').select2({
  				'placeholder' : 'Pilih Data',

  			});

  		</script>