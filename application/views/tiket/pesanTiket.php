  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pemesanan Tiket</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Pemesanan Tiketting</strong></h3>
  							</div>
                <?php if($Level == 2){?>
                  <a href="<?=base_url().'welcome/tiket';?>"> 
                    <button class="btn btn-raised btn-primary">Tambah</button>
                  </a>
                <?php }?>
                <div class="boxs-body">
                  <div class="table-responsive">
                   <table id="datatable" class="display" style="width:100%">
                    <thead>
                     <tr>
                      <th>No</th>
                      <th>Kode Tiket</th>
                      <th>Maskapai</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Pesan</th>
                      <th>Jumlah Pesan</th>
                      <th>Total Uang</th>
                      <?php if($Level == 1 || $Level == 3){?>
                        <th>Action</th>
                      <?php }?>

                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                    <th>No</th>
                    <th>Kode Tiket</th>
                    <th>Maskapai</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesan</th>
                    <th>Jumlah Pesan</th>
                    <th>Total Uang</th>
                    <?php if($Level == 1 || $Level == 3){?>
                      <th>Action</th>
                    <?php }?>
                  </tr>
                </tfoot>
                <tbody>
                 <?php
                 $no =1;
                 foreach ($Pesanan->result_array() as $key ) {
                  $Pesawat = $this->db->join('db_penerbangan','db_penerbangan.id=tb_tiket_yeka_madira.id_penerbangan')->get_where('tb_tiket_yeka_madira',array('id_tiket_YKM'=>$key['id_tiket_pesawat_data']))->row_array();
                  $Pelanggan= $this->db->get_where('tb_pelanggan',array('id'=>$key['id_pelanggan']))->row_array();
                  $CountTotal = $this->db->select('sum(jumlah_uang) as TotalData',FALSE)->get_where('tb_tagihan_tiketing',array('id_tagihannya'=>$key['id_tiket_data_pesan']))->row_array();

                  $Total = $this->db->select('sum(jumlah) as TotalData, count(id_keterangan_tiket) as TotalLevel, sum(harga) as HargaNya',FALSE)->get_where('tb_detail_pesan_tiket_pelanggan',array('id_tiket_pemesanan'=>$key['id_tiket_data_pesan']))->row_array();
                  ?>
                  <tr>
                   <td><?=$no++;?></td>
                   <td><?=$key['id_pesan_tiket_data'];?></td>
                   <td><?=$Pesawat['nama_maskapai'].'/'.$Pesawat['kode_pesawat'];?></td>
                   <td><?=$Pelanggan['nama_lengkap'];?></td>
                   <td><?=$key['tanggal_pesan'].''.$key['waktu_pesan'];?></td>
                   <td><?=$Total['TotalData'];?> Pesanan</td>
                   <td>Rp. <?=number_format($Total['HargaNya']);?> </td>
                   <?php if($Level == 1 || $Level == 3){?>
                     <td>
                      <?=$key['status'] == 2 || $key['status'] == 1 ? '
                      <button type="submit" class="btn btn-raised fa fa-check" title="Terima" name_nama='.$Pelanggan['nama_lengkap'].' id="Terima" name_total='.$Total['HargaNya'].'  name_id='.$key['id_tiket_data_pesan'].'>':'';?>
                    </td>
                  <?php }?>
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
</div>
</section>

<script>

 $(document).ready(function() {
  var base_url = "<?php echo base_url();?>";
  $('#datatable').DataTable();


  $('#datatable').on('click','#Terima',function(e){
   e.preventDefault();
   var name_id    = $(this).attr('name_id');
   var name_nama    = $(this).attr('name_nama');
   var name_total    = $(this).attr('name_total');
   swal({
    title: "Anda Menyetujui Pelanggan ini?",
    text: "Ada memilih data "+name_nama,
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
      url: base_url + 'data/PesanTiket/Terima',
      type: 'POST',
      data:{name_id:name_id,name_total:name_total},
      dataType: "JSON",
      success: function(respone) {
       if (respone.status == 'success') {
        swal({
         type: 'success',
         title: respone.status,
         text: respone.message,
         timer: 1200,
       },function(){
         window.location.href = base_url + 'data/PesanTiket/InputUang?idData='+respone.kode+'&XcX='+respone.note
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
   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });

});
</script>