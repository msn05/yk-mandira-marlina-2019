  <section id="content">
  	<div class="page page-ui-portlets">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Layanan</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<form method="POST" id="SimpanData" class="form-horizontal">
  			<div class="row">
  				<div class="col-sm-6">
  					<section class="boxs">
  						<div class="boxs-header bg-blush">
  							<h3 class="custom-font">
  								<strong><?=$headerMenu;?></strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="boxs-body">
  									<div class="row">
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="username">Nama Layanan</label>
  												<input type="hidden" value="<?=$idLayanan;?>" class="form-control" id="id"  name="id"/>
  												<input type="text" class="form-control" value="<?=$namaLayanan;?>"  id="namaLayanan"  name="namaLayanan" autocomplete="off"/>
  												<small class="text-danger ">Harap isi Dengan Huruf..!</small>
  											</div>
  										</div>
  										<div class="form-group col-sm-6">
  											<div class="col-sm-12">
  												<label for="password">Kode Layanan </label>
  												<select tabindex="3"  name="kodeLayanan" id="kodeLayanan" class="chosen-select form-control" style="width: 100%;">
  													<option value="0"> Pilih Layanan</option>
  													<option value="TU"<?=$kode_layanan == 'TU' ? 'selected' : 'Null';?>> Umroh</option>
                            <option value="TH"<?=$kode_layanan == 'TH' ? 'selected' : 'Null';?>> Haji</option>
                            <option value="U"<?=$kode_layanan == 'U' ? 'selected' : 'Null';?>> Umum</option>
                          </select>
                          <small class="text-danger ">Harap isi Memilih.!</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="line-dashed full-witdh-line" />
                <div class="form-group">
                 <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-raised btn-primary">Simpan</button>
                  <a href="<?=base_url().'data/layanan';?>">
                   <button type="button"  class="btn btn-raised btn-warning">Kembali</button>
                 </a>
               </div>
             </div>
           </section>
         </div>
       </div>
     </form>
   </div>
 </section>

 <script>
  $(document).ready(function() {
   $('#SimpanData').on('submit', function (e) {
     e.preventDefault();
     var base_url = "<?php echo base_url();?>";
     var SimpanData = $(this);
     $.ajax({
      type: "POST",
      url: base_url + 'data/layanan/simpanLagi',
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
       },function(){
        window.location.href = base_url + 'data/layanan';
      });
      }else{
        swal({
         type: 'error',
         title: respone.status,
         text: respone.message,
         timer: 1200,
       });
      }
    }
  });
   });
 });
</script>





