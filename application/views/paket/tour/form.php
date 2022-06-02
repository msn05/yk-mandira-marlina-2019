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
  		<form method="POST" id="SimpanData" >
  			<div class="row">
  				<div class="col-sm-12">
  					<section class="boxs">
  						<div class="boxs-header bg-blush">
  							<h3 class="custom-font">
  								<strong>Form Tambah Paket Travel</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="boxs-body">
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="username">Kode Paket</label>
  												<input type="text" class="form-control" placeholder="Kode Paket..!" id="kodePaket"  name="kodePaket"/>
  												<small class="text-danger ">* Harap Kode Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Nama Paket</label>
  												<input type="hidden" class="form-control" id="namaPaketNya" name="namaPaketNya" value="H" placeholder="Nama Paket..!"/>
  												<input type="text" class="form-control" id="namaPaket" name="namaPaket"placeholder="Nama Paket..!"/>
  												<small class="text-danger ">* Harap isi Nama Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Nama Layanan</label>
  												<select tabindex="3"  name="layanan" id="layanan" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Layanan</option>
  													<?php foreach ($Layanan as $key => $value) {?>
  														<option value="<?=$value->id_layanan;?>"><?=$value->nama_layanan;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Nama Layanan..!</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Harga</label>
  												<input type="number" class="form-control" id="HargaPaket" name="HargaPaket"placeholder="Harga Paket..!"/>
  												<small class="text-danger ">* Harap isi Harga Paket..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Maksimal Pelanggan</label>
  												<input type="number" class="form-control" id="MaxPelPaket" name="MaxPelPaket"placeholder="Maksimal Pelanggan Paket..!"/>
  												<small class="text-danger ">* Harap isi Maksimal Pelanggan..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Tanggal Berakhir Paket</label>
  												<input type="text" class="date form-control" id="TanggalBerakhir" name="TanggalBerakhir"placeholder="Tanggal Berakhir Paket" autocomplete="off" />
  												<small class="text-danger ">* Harap isi Tanggal Berakhir Paket..!</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Nama Maskapai</label>
  												<select tabindex="3"  name="penerbangan" id="penerbangan" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Penerbangan</option>
  													<?php foreach ($Penerbangan as $key => $value) {?>
  														<option value="<?=$value->kode_penerbangan;?>"><?=$value->nama_maskapai;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Maskapai yang digunakan Paket ini..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Hotel</label>
  												<select tabindex="3" multiple="multiple"  name="hotel[]" id="hotel[]" class="js-example-basic-single chosen-select form-control" style="width: 100%;">
  													<?php foreach ($Hotel as $key => $value) {?>
  														<option value="<?=$value->kode_hotel;?>"><?=$value->nama_hotel;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Hetel Paket ini <b>dan Memilih Dua Hotel</b>..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Pilih Metode Pembayaran</label>
  												<select tabindex="3"  name="MetodeTravel" id="MetodeTravel" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Metode Pembayaran</option>
  													<?php foreach ($Metode as $key => $value) {?>
  														<option value="<?=$value->id_metode_pembayaran;?>"><?=$value->metode;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap memilih metode Pembayaran..!</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Pilih Fasilitas Kendaraan</label>
  												<select tabindex="3"  name="KendaraanTravel" id="KendaraanTravel" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Metode Pembayaran</option>
  													<?php foreach ($Bus as $key => $value) {?>
  														<option value="<?=$value->id;?>"><?=$value->nama_bus;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Maskapai Paket ini..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Perlengkapan</label>
  												<select tabindex="3" multiple="multiple"  name="perlengkapan[]" id="perlengkapan[]" class="js-example-basic-single chosen-select form-control" style="width: 100%;">
  													<?php foreach ($Perlengkapan as $key => $value) {?>
  														<option value="<?=$value->id;?>"><?=$value->nama_barang;?></option>
  													<?php }?>
  												</select>
  												<small class="text-danger ">* Harap isi Maskapai <b>dan Memilih Dua Hotel</b>..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Dari</label>
  												<input type="text" class=" form-control" id="dariTour" name="dariTour"placeholder="Dari mana dimulai" autocomplete="off" />
  												<small class="text-danger ">* Harap isi..!</small>
  											</div>
  										</div>
  									</div>
  									<div class="row">
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Tujuan</label>
  												<input type="text" class=" form-control" id="TujuanTour" name="TujuanTour"placeholder="Tujuan Tour" autocomplete="off" />
  												<small class="text-danger ">* Harap isi..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-4">
  											<div class="col-sm-12">
  												<label for="password">Lama Perjanan</label>
  												<input type="number" class=" form-control" id="LamaNya" name="LamaNya"  autocomplete="off" />
  												<small class="text-danger ">* Harap isi..!</small>
  											</div>
  										</div>
                      <div class="form-group col-sm-4">
                       <div class="col-sm-12">
                        <label for="password">Tanggal Berangkat Paket</label>
                        <input type="text" class="date form-control" id="TanggalBerangkat" name="TanggalBerangkat"placeholder="Tanggal Berangkat Paket" autocomplete="off" />
                        <small class="text-danger ">* Harap isi Tanggal Berangkat Paket..!</small>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-sm-12">
                     <div class="col-sm-12">
                      <label for="password">Catatan</label>
                      <textarea class="form-control" id="CatatanTour" name="CatatanTour" autocomplete="off"></textarea>
                      <small class="text-danger ">* Harap isi..!</small>
                    </div>
                  </div>

                </div>
              </div>
              <hr class="line-dashed full-witdh-line" />
              <div class="row">
               <div class="form-group">
                <div class="col-sm-offset-5 col-sm-10">
                 <button type="submit" class="btn btn-raised btn-primary">Simpan</button>
                 <a href="<?=base_url().'data/paket/Tour';?>">
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

<script>
 $('.js-example-basic-single').select2({
  'placeholder' : 'Pilih Data',

});
 $(document).ready(function(){      

  $('#SimpanData').on('submit', function (e) {
   e.preventDefault();
   var base_url = "<?php echo base_url();?>";
   var SimpanData = $(this);
   $.ajax({
    type: "POST",
    url: base_url + 'data/paket/simpanTour',
    data: SimpanData.serialize(),
    dataType: "JSON",
    cache : "false",
    success: function (respone) {
     if (respone.status == 'success') {
      swal({
       type: 'success',
       title: respone.status,
       text: respone.message,
       timer: 1200,
     },
     function () {
       location.reload(true);
     });
    }else{
      swal({
       type: 'error',
       title: respone.status,
       text: respone.message,
       timer: 1200,
       cache : "false",
     });
    }
  }
});
 });
});
</script>