  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Pelanggan Yeka Madira Palembang</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
          </div>
          <div class="col-md-8">
           <section class="boxs ">
            <div class="boxs-header">
             <h3 class="custom-font hb-cyan">
              <strong>File-file Pelanggan </strong></h3>
            </div>
            <a href="<?=base_url().'data/pelanggan';?>"> 
              <button class="btn btn-raised btn-primary">Kembali</button>
            </a>
            <div class="boxs-body">
              <div class="table-responsive">
               <table id="datatable" class="display" style="width:100%">
                <thead>
                 <tr>
                  <th>Name</th>
                  <th>File Data</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <tr>
                <td>FOTO</td>
                <td><?=$DataFile['foto'] != NULL ? '<a target="_blank" href='.base_url().'image/pelanggan/'.$DataFile['foto'].''.'>'.$DataFile['foto'].'</a>' : 'Tidak Ada';?></td>
                <td>
                  <a href="<?=base_url().'data/pelanggan/UploadFileUbahFile?idFile='.base64_encode($idFile).'&ids=JPEG&Note=foto&File='.base64_encode($DataFile['foto']).'';?>"> <button class="fa fa-edit" title="Edit"></button>
                  </a>
                </td>
              </tr>
              <tr>
                <td>KTP</td>
                <td><?=$DataFile['ktp'] != NULL ? '<a target="_blank" href='.base_url().'image/pelanggan/'.$DataFile['ktp'].''.'>'.$DataFile['ktp'].'</a>' : 'Tidak Ada';?></td>
                <td>
                  <a href="<?=base_url().'data/pelanggan/UploadFileUbahFile?idFile='.base64_encode($idFile).'&ids=PDF&Note=ktp&File='.base64_encode($DataFile['ktp']).'';?>"> <button class="fa fa-edit" title="Edit"></button>
                  </a>

                </td>

              </tr>
              <tr>
                <td>KK</td>
                <td><?=$DataFile['kk'] != NULL ? '<a target="_blank" href='.base_url().'image/pelanggan/'.$DataFile['kk'].''.'>'.$DataFile['kk'].'</a>' : 'Tidak Ada';?></td>
                <td>
                  <a href="<?=base_url().'data/pelanggan/UploadFileUbahFile?idFile='.base64_encode($idFile).'&ids=PDF&Note=kk&File='.base64_encode($DataFile['kk']).'';?>"> <button class="fa fa-edit" title="Edit"></button>
                  </a>

                </td>

              </tr>
              <tr>
                <td>PASPORT</td>
                <td><?=$DataFile['pasport'] != NULL ? '<a target="_blank" href='.base_url().'image/pelanggan/'.$DataFile['pasport'].''.'>'.$DataFile['pasport'].'</a>' : 'Tidak Ada';?></td>
                <td>
                  <a href="<?=base_url().'data/pelanggan/UploadFileUbahFile?idFile='.base64_encode($idFile).'&ids=PDF&Note=pasport&File='.base64_encode($DataFile['pasport']).'';?>"> <button class="fa fa-edit" title="Edit"></button>
                  </a>
                </td>
              </tr>
              <tr>
                <td>BUKU NIKAH</td>
                <td><?=$DataFile['buku_nikah'] != NULL ? '<a target="_blank" href='.base_url().'image/pelanggan/'.$DataFile['buku_nikah'].''.'>'.$DataFile['buku_nikah'].'</a>' : 'Tidak Ada';?></td>
                <td>
                  <a href="<?=base_url().'data/pelanggan/UploadFileUbahFile?idFile='.base64_encode($idFile).'&ids=PDF&Note=buku_nikah&File='.base64_encode($DataFile['buku_nikah']).'';?>"> <button class="fa fa-edit" title="Edit"></button>
                  </a>

                </td>

              </tr>
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

</script>
