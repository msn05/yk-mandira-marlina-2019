 <section id="content">
  <div class="page page-forms-common">
   <!-- bradcome -->
   <div class="b-b mb-10">
    <div class="row">
     <div class="col-sm-6 col-xs-12">
      <h1 class="h3 m-0">Pengguna Sistem</h1>
      <small class="text-muted">Welcome to Falcon application</small>
     </div>
    </div>
   </div>
   <div class="row">
    <div class="col-md-6 col-sm-12">
     <section class="boxs">
      <div class="boxs-header">
       <h3 class="custom-font hb-blue">
        <strong><?=$headerMenu;?></strong> </h3>
       </div>
       <div class="boxs-body">
        <form action="" method="post" id="UbahDataSistemDokumen">
         <div class="row">
          <div class="form-group col-sm-12">
           <label for="username">Foto</label>
           <input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox"  id="foto" name="foto">
           <input type="hidden" id="id" class="id" value="<?=$idFileNya;?>" name="id"/>
           <small class="text-danger ">Harap Diisi.  Format JPG, PNG, JPEG max size 2mb..!</small>
          </div>
          <div class="form-group col-sm-12">
           <label for="username">KTP</label>
           <input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox"  id="ktp" name="ktp">
           <small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
          </div>
          <div class="form-group col-sm-12">
           <label for="username">KK</label>
           <input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" id="kk" name="kk">
           <small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
          </div>

         </div>
         <hr class="line-dashed full-witdh-line" />
         <div class="modal-footer">
          <button type="submit" id="SimpanUbahData" class="btn btn-success">Ubah Data</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
        </form>
       </div>
      </section>
     </div>
    </div>
   </div>
  </section>
  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
  <script>

   $('#UbahDataSistemDokumen').submit(function(e){
    e.preventDefault(); 
    var base_url  = "<?php echo base_url();?>";
    $.ajax({
     url: base_url + 'data/karyawan/UploadDokumen',
     type:"post",
     data:new FormData(this),
     processData:false,
     contentType:false,
     cache:false,
     async:false,
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
        window.location.href = base_url + 'data/pengguna';
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