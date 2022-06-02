  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Tiket Pesawat</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-6">
  					<section class="boxs">
  						<div class="boxs-body">
  							<div class="pull-left">
  								<h3 class="custom-font">
  									<strong>INFORMASI TIKET</strong></h3>
  								</div>
                  <div class="table-responsive">
                   <table id="datatable1"  class="table" style="width:100%">
                    <thead>
                     <tr>
                      <th>No</th>
                      <th>Level</th>
                      <th>Jumlah</th>
                      <th>Harga / Kursi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                    <th>No</th>
                    <th>Level</th>
                    <th>Jumlah</th>
                    <th>Harga / Kursi</th>
                    <th>Action</th>

                  </tr>
                </tfoot>
                <tbody>
                 <?php 
                 $no = 1;
                 foreach ($ShowTiket->result_array() as $key ) {?>
                  <tr>
                   <td><?=$no++;?></td>
                   <td>
                    <input type="hidden" name="id" id="id" value="<?=$pesawat;?>">
                    <input type="hidden" name="rules" id="rules" value="<?=$key['id'];?>">
                    <input type="hidden" class="form-control" name="jumlah" id="jumlah" value="1">
                    <?=$key['level'] == 1 ? 'Anak-anak' : 'Dewasa' ;?></td>
                    <td><?=$key['jumlah'];?> Kursi</td>
                    <td>Rp. <?=number_format($key['harga']);?></td>
                    <td>
                      <?php if($key['jumlah'] != 0){ echo '
                      <button type="submit" class="pesan" title="pesan">Pesan</button>';
                    }?>
                  </td>
                </tr>
                <?php 
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </section>
  </div>
  <!-- </div> -->
  <!-- <div class="row"> -->
   <!-- <div class="col-md-6">
    <form method="POST" id="SimpanData" >
     <div class="row">
      <div class="col-sm-12">
       <section class="boxs">
        <div class="boxs-header bg-blush">
         <h3 class="custom-font">
          <strong>Form Data</strong></h3>
        </div>
        <div class="row">
          <div class="form-group col-sm-12">
           <div class="col-sm-12">
            <input type="hidden" name="id" id="id" value="<?=$pesawat;?>">
            <select  name="rules" id="rules" class="chosen-select form-control" style="width: 100%;"> -->
            <!--  <option value="0"> Pilih Rules Data</option>
             <?php   foreach ($ShowTiket->result_array() as $key ) {?>
              <option value="<?=$key['id'];?>" ><?=$key['level'] == 1 ? 'Anak-anak' : 'Dewasa';?></option>
            <?php }?>
          </select> -->
         <!--  <small class="text-danger ">* Pilih Rules Data</small>
        </div>
      </div>
      <div class="form-group col-sm-12">
       <div class="col-sm-12">
        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="jumlah">
        <small class="text-danger ">* Jumlah </small>
      </div>
    </div>
    <div class="form-group col-sm-12">
     <div class="col-sm-12">
      <button type="submit" class="btn btn-raised btn-success">Simpan</button>
    </div>
  </div>
</div>
</section>
</div>
</div>
</form>
</div> -->
<div class="col-md-6">
 <section class="boxs">
  <div class="boxs-body">
   <div class="pull-left">
    <h3 class="custom-font">
     <strong>INFORMASI PESANAN</strong></h3>
   </div>
   <div class="table-responsive">
     <table id="datatable" class="table table-bordered" style="width:100%">
      <thead>
       <tr>
        <th>No</th>
        <th>Level</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>#</th>

      </tr>
    </thead>
    <tbody>
     <?php 
     $no = 1;
     $nos = 1;
     foreach ($PemesananTiket->result_array() as $d ) {
      $StatusLevelTiket = $this->db->get_where('tb_keterangan_harga_tiket',array('id'=>$d['id_keterangan_tiket']))->row_array();
      ?>
      <tr>
       <td><?=$no++;?></td>
       <td><?=$d['id_keterangan_tiket'] == $StatusLevelTiket['id'] ? ''.($StatusLevelTiket['level'] == 1 ? 'Anak - anak' : 'Dewasa').'' : '' ;?></td>
       <td><?=$d['jumlah'];?> Kursi</td>
       <td>Rp. <?=number_format($d['harga']);?></td>
       <td>
        <button type="submit" id="remove"  name_id='<?=$d['id'];?>' name_nama='<?=$d['id_keterangan_tiket'];?>' name_jumlah='<?=$d['jumlah'];?>' name_no='<?=$nos++;?>'><i class="fa fa-trash-o"></i></button>
      </td>
    </tr>
    <?php 
  }
  ?>
  <tr>
   <th>Total</th>
   <th><?=$Total['TotalLevel'];?> Level</th>
   <th><?=$Total['TotalData'];?> Kursi</th>
   <th>Rp. <?=number_format($Total['HargaNya']);?></th>
   <th>
    <button type="submit" name_id='<?=$pesawat;?>' name_total='<?=$Total['HargaNya'];?>' class="save fa fa-save" title="proses"></button>
    <a href="<?=base_url().'data/PesanTiket/CetakPesanan?idDataPembayaran='.$pesawat.'';?>">
     <button type="submit" name_id='<?=$pesawat;?>' class="print fa fa-print" title="cetak"></button>
   </a>
 </th>
</tr>
</tbody>
</table>
</div>
</div>
</section>
</div>
</div>
<div class="row">

</div>
</div>
</div>
</section>
<script type="text/javascript">
 var base_url = "<?php echo base_url();?>";
 $('#datatable1').DataTable();
 $('#datatable').DataTable();
 $('#datatable1').on('click', '.pesan',function(e){
   e.preventDefault();
   var id    = $('#id').val();
   var rules    = $('#rules').val();
   var jumlah    = $('#jumlah').val();
   console.log(rules);
   $.ajax({
    url: base_url + 'data/PesanTiket/simpanPemesananTiket',
    type: "POST",
    data: {id:id,rules:rules,jumlah:jumlah},
    dataType: "JSON",
    cache : "false",
    success: function (respone) {
     if (respone.status == 'success') {
      swal({
       type: 'success',
       title: respone.status,
       text: respone.message,
     },
     function(){
       location.reload(true);
     });
    }else{
      swal({
       type: 'error',
       title: respone.status,
       text: respone.message,
     },
     function(){
       location.reload(true);
     });
    }
  }
});
 });

 $('#datatable').on('click','.save',function(){
   var name_id    = $(this).attr('name_id');
   var name_total    = $(this).attr('name_total');
   swal({
    title: "Anda Yakin Pelanggan Memesan tiket ini ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Ya",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function (Komfirmasi) {
    if (Komfirmasi) {
     $.ajax({
      url: 'selesaiPesan',
      data : {name_id:name_id,name_total:name_total},
      type: 'POST',
      error: function() {
       swal({
         title: "error",
         text: "Gagal.",
         type: "success",
       });
     },
     success: function(data) {
       swal({
        title: "success",
        text: "Berhasil.",
        type: "success",
      },
      function () {
        window.location.href = base_url + 'data/PesanTiket';
      });
     }
   });

   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });


 $('#datatable').on('click','#remove',function(){
   var name_id    = $(this).attr('name_id');
   var name_no    = $(this).attr('name_no');
   var name_nama    = $(this).attr('name_nama');
   var name_jumlah    = $(this).attr('name_jumlah');
   swal({
    title: "Anda Yakin ingin menghapus data ?",
    text: "Ada memilih data "+name_jumlah,
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Ya",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function (Komfirmasi) {
    if (Komfirmasi) {
     $.ajax({
      url: 'deleteTiketNya',
      data : {name_id:name_id,name_nama:name_nama,name_jumlah:name_jumlah},
      type: 'POST',
      error: function() {
       swal({
        title: "error",
        text: "Gagal Menghapus.",
        type: "error",
      },function(){
        location.reload(true);
      });
     },
     success: function(data) {
       swal({
        title: "success",
        text: "Berhasil Menghapus data.",
        type: "success",
      },
      function () {
        location.reload(true);
      });
     }
   });

   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });

</script>