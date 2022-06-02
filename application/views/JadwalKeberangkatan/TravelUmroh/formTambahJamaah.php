  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0"><?=$headerMenu;?></h1>
       <small class="text-muted">Welcome to Falcon application</small>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-md-4">
      <section class="boxs">
       <div class="boxs-header">
        <h3 class="custom-font hb-blue">
         <strong><?=$headerMenu;?></strong> </h3>
        </div>
        <div class="boxs-body">
         <form role="form" id="form1" method="post">
          <div class="row">
           <div class="form-group col-md-12">
            <label for="email">Pilih Pelanggan  <span class="text-danger">* </span></label>
            <select class="select2 form-control" name="pelanggan" id="pelanggan"  >
             <option value="0">Pilih Pelanggan</option>
             <?php foreach ($Pelanggan ->result_array()as $key) {?>
              <option value="<?=$key['id'];?>"><?=$key['nama_lengkap'];?></option>
             <?php }?>
            </select>
            <input type="hidden" name="idPaket" id="idPaket" value="<?=$idPaket;?>">
           </div>

          </div>
          <div class="boxs-footer text-right ">
           <a href="<?=base_url().'data/JadwalBerangkat/TravelUmroh';?>" class="btn btn-warning btn-raised">Kembali</a>
           <button type="submit" class="btn btn-raised btn-primary" id="form1Submit" >Simpan</button>
           <!-- </div> -->
          </form>
         </section>
        </div>
        <div id="drop"></div>
       </div>
      </div>
     </section>

     <script>
      $('#pelanggan').change(function(){
       var pelanggan  = $(this).val();
       var base_url = "<?php echo base_url();?>";
       $.ajax({
        url: base_url + 'data/pelanggan/cariPelanggan',
        type: 'POST',
        data: 'pelanggan='+pelanggan,
        cache:'false',
        success:function(msg){
         $("#drop").html(msg);
        }
       });
      });
      $('#form1').on('submit', function (e) {
       e.preventDefault();
       var pelanggan 							= $('#pelanggan').val();
       var base_url 	= "<?php echo base_url();?>";
       var form1 = $(this);
       $.ajax({
        type: "POST",
        url: base_url + 'data/JadwalBerangkat/simpanData',
        data: form1.serialize(),
        dataType: "JSON",
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
          });
         }
        }
       });
      });
     </script>
