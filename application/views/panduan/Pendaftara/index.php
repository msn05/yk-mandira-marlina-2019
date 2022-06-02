  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Panduan Pendaftaran</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
  				<div class="col-md-12">
  					<section class="boxs ">
  						<div class="boxs-header">
  							<h3 class="custom-font hb-cyan">
  								<strong>Daftar Panduan</strong></h3>
  							</div>
                <?= $this->session->flashdata('message');?>
                <a href="<?=base_url().'data/panduan/form';?>">
                  <button class="btn btn-raised btn-primary">Tambah</button>
                </a>
                <div class="boxs-body">
                  <div class="table-responsive">
                   <table id="datatable" class="display" style="width:100%">
                    <thead>
                     <tr>
                      <th>No</th>
                      <th>Kode Panduan</th>
                      <th>Tanggal Dibuat</th>
                      <th>Note</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                    <th>No</th>
                    <th>Kode Panduan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Note</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                 <?php
                 $no = 1;
                 foreach ($Panduan->result_array() as $key) {?>
                  <tr>
                   <td><?=$no++;?></td>
                   <td><?=htmlentities($key['id_kategori'] == 'TU' ? 'Travel Umroh' :($key['id_kategori'] == 'TH' ? 'Travel Haji' : ($key['id_kategori'] == 'U' ? 'Pariwisata' : 'Tiket')))?></td>
                   <td><?=date('d-F-Y',strtotime($key['tanggal']));?></td>
                   <td><?=substr(htmlspecialchars($key['keterangan']), 0,15);?></td>
                   <td>
                    <a href="<?=base_url().'data/panduan/editpendaftaran?idData='.base64_encode($key['id']).'&keterangan='.base64_encode('Ubah').'';?>" class='btn btn-warning btn-raised fa fa-cog ' title='edit data'> </a>
                    <a href="<?=base_url().'data/panduan/editpendaftaran?idData='.base64_encode($key['id']).'&keterangan='.base64_encode('Info').'';?>" class='btn btn-info btn-raised fa fa-info' title='edit data'> </a>
                    <button type="submit" class="DeleteData btn btn-danger btn-raised fa fa-trash-o" name_nama='<?=$key['id_kategori'];?>' name_id='<?=$key['id'];?>' title='delete'></button>
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
    var name_id         = $(this).attr('name_id');
    var name_nama       = $(this).attr('name_nama');
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
        url: base_url+'data/panduan/deletePendaftaran',
        data : {name_id:name_id},
        type: 'POST',
        dataType: "JSON",
        success: function(respone) {
         if (respone.status == 'success') {
          swal({
           type: 'success',
           text: respone.message,
           title: respone.status,
           timer: 1200,
         },
         function () {
          window.location.href = base_url + 'data/panduan/Pendaftaran';
        });
        }else{
          swal({
           type: 'error',
           text: respone.message,
           title: respone.status,
           timer: 1200,
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