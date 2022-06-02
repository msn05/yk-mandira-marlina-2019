  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Promo Layanan</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Promo layanan</strong></h3>
  							</div>
  							<a href="<?=base_url().'data/promo/form';?>">
  								<button class="btn btn-raised btn-primary">Tambah</button>
  							</a>
  							<div class="boxs-body">
  								<div class="table-responsive">
  									<table id="datatable" class="display" style="width:100%">
  										<thead>
  											<tr>
  												<th>No</th>
  												<th>Kode Promo</th>
  												<th>Nama Layanan - Nama Paket</th>
                          <th>Harga Normal</th>
                          <th>Harga Sesudah Promo</th>
                          <th>Tanggal Post</th>
                          <th>Image Show</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                       <tr>
                        <th>No</th>
                        <th>Kode Promo</th>
                        <th>Nama Layanan - Nama Paket</th>
                        <th>Harga Normal</th>
                        <th>Harga Sesudah Promo</th>
                        <th>Tanggal Post</th>
                        <th>Image Show</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                     <?php
                     $no = 1;
                     foreach ($Promo->result_array() as $key) {
                      $LayananPromo = $this->db->join('db_layanan','db_layanan.id_layanan=db_paket.id_layanan','left')->get_where('db_paket',array('id_paket'=>$key['id_note_layanan']))->row_array();
                      ?>
                      <tr>
                       <td><?=$no++;?></td>
                       <td><?=$key['id_promo'];?></td>
                       <td><?=$LayananPromo['nama_layanan'].'-'.$LayananPromo['kode_paket_data'].'-'.$LayananPromo['id_paket'];?></td>
                       <td>Rp. <?=number_format($key['harga_normal_data']);?></td>
                       <td>Rp. <?=number_format($LayananPromo['harga']);?></td>
                       <td><?=date('d-F-Y',strtotime($key['tanggal_post']));?></td>
                       <td>
                        <a href="<?=base_url().'data/promo/Image?idData='.base64_encode($key['id_promo']).'&Keterangan=Lihat';?>" >Lihat Foto </a>
                      </td>
                      <td>
                        <a href="<?=base_url().'data/promo/editpromo?idData='.base64_encode($key['id_promo']).'&keterangan='.base64_encode('Ubah').'';?>" class='btn btn-warning btn-raised fa fa-cog ' title='edit data'> </a>
                        <a href="<?=base_url().'data/promo/editpromo?idData='.base64_encode($key['id_promo']).'&keterangan='.base64_encode('Info').'';?>" class='btn btn-info btn-raised fa fa-info' title='info data'> </a>
                        <button type="submit" class="DeleteData btn btn-danger btn-raised fa fa-trash-o" name_nama='<?=$key['id_promo'];?>' title='delete'></button>
                      </td>
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
  var base_url = "<?=base_url();?>";

  $('#datatable').on('click','.DeleteData',function(){
   var name_nama         = $(this).attr('name_nama');
   swal({
    title: "Anda Yakin ingin Menghapus Data Ini ?",
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
      url: base_url+'data/promo/deletePromo',
      data : {name_nama:name_nama},
      type: 'POST',
      dataType: "JSON",
      success: function(respone) {
       if (respone.status == 'success') {
        swal({
         type: 'success',
         text: respone.message,
         title: respone.status,
       },
       function () {
         window.location.href = base_url + 'data/promo';
       });
      }else{
        swal({
         type: 'error',
         text: respone.message,
         title: respone.status,
       })
      }
    }
  });

   } else {
     swal("Batal", "Anda Telah Membatal ", "error");
   }
 });
 });

</script>