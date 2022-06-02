  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pemesanan Pariwisata</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Pemesanan Pariwisata</strong></h3>
  							</div>
               <?php if($Level == 1 || $Level == 3) {?>
                 <a href="<?=base_url().'data/Pemesanan/formTambahPariwisata';?>">
                  <button class="btn btn-raised btn-primary">Tambah</button>
                </a>
              <?php }elseif($Level == 2){?>
               <p class='text-danger'><b>Jika Status Pemesanan Layanan ini tunda itu artinya data anda sedang cek oleh admin</b></p>
               <a href="<?=base_url().'welcome/pariwisata';?>">
                <button class="btn btn-raised btn-primary">Tambah</button>
              </a>
            <?php }?>
            
            <div class="boxs-body">
              <div class="table-responsive">
               <table id="datatable" >
                <thead>
                 <tr>
                  <th>No</th>
                  <th>Id Pemesanan</th>
                  <th>Nama Layanan Kode Paket</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Pesan</th>
                  <th>Harga</th>
                  <th>Status</th>
                  <th>Info Pembayaran</th>
                  <?php if($Level == 1 || $Level == 3){?>
                    <th>Action</th>
                  <?php }?>
                </tr>
              </thead>
              <tfoot>
               <tr>
                <th>No</th>
                <th>Id Pemesanan</th>
                <th>Nama Layanan Kode Paket</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pesan</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Info Pembayaran</th>
                <?php if($Level == 1 || $Level == 3){?>
                  <th>Action</th>
                <?php }?>
              </tr>
            </tfoot>
            <tbody>
             <?php 
             $no = 1;
             foreach ($paket->result_array() as $key) {
              $KodePemesanan = $this->db->get_where('tb_tagihan_pembayaran',array('kode_pemesanan'=> $key['id_pemesanan']))->row_array();
              ?>
              <tr>
               <td><?=$no++;?></td>
               <td><?=$key['id_pemesanan'];?></td>
               <td><?=$key['nama_layanan']. '-'.$key['id_paket'];?></td>
               <td><?=$key['nama_lengkap']. '/'.$key['no_ktp'];?></td>
               <td><?=$key['tanggal_pesan'];?></td>
               <td>Rp. <?=number_format($key['harga']);?></td>
               <td><?=$key['status'] == 1 ? 'Tunda' : ($key['status'] == 2 ? 'Proses'  : ($key['status'] == 3 ? 'Diterima' : 'Batal'));?></td>
               <td><?=$KodePemesanan['kode_pemesanan'] == $key['id_pemesanan'] ? '<a href="./../../data/Pembayaran/DataPembayaran?idData='.base64_encode($KodePemesanan['nomor_tagihan']).'&Aktivasi='.base64_encode('Pariwisata').'">'.$KodePemesanan['nomor_tagihan'].'</a>' : 'Belum Ada Nomor Tagihan';?></td>
               <?php if($Level == 1 || $Level ==3){?>
                 <td>
                  <?php if($KodePemesanan['kode_pemesanan'] != $key['id_pemesanan']){ ?>
                   <button type="submit" class="btn btn-raised fa fa-check" title="Terima" id='Terima' name_id='<?=$key['id_pemesanan'];?>' name_data='<?=$key['nama_lengkap'];?>' name_pelanggan='<?=$key['id_pelanggan'];?>' name_paket='<?=$key['id_paket'];?>'></button>
                 <?php }?>
                 <?php if ($key['status'] == 3) {
                 }else{?>

                 <?php }?>
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
</section>
<script>
  $('#datatable').DataTable();
  $('#datatable').on('click','#Terima',function(e){
   e.preventDefault();
   var name_id    = $(this).attr('name_id');
   var name_data  = $(this).attr('name_data');
   var name_pelanggan  = $(this).attr('name_pelanggan');
   var name_paket  = $(this).attr('name_paket');
   swal({
    title: "Anda Menyetujui Pelanggan ini?",
    text: "Ada memilih data "+name_data,
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
      url: './../JadwalBerangkat/simpanData',
      type: 'POST',
      data:{name_id:name_id,name_pelanggan:name_pelanggan,name_paket:name_paket},
      dataType: "JSON",
      success: function(respone) {
       if (respone.status == 'success') {
        swal({
         type: 'success',
         title: respone.status,
         text: respone.message,
         timer: 1200,
       },function(){
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
   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });

  $('#datatable').on('click','#Batal',function(e){
   e.preventDefault();
   var name_id    = $(this).attr('name_id');
   var name_pelanggan  = $(this).attr('name_pelanggan');
   swal({
    title: "Anda Menyetujui Pelanggan ini?",
    text: "Ada memilih data "+name_pelanggan,
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
      url: './../Pemesanan/DeletePesanan',
      type: 'POST',
      data:{name_id:name_id},
      dataType: "JSON",
      success: function(respone) {
       if (respone.status == 'success') {
        swal({
         type: 'success',
         title: respone.status,
         text: respone.message,
       },function(){
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
   } else {
     swal("Batal", "Batal :)", "error");
   }
 });
 });
</script>
