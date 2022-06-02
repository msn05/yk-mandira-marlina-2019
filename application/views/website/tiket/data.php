   <section id="search_container">
   	<div id="search">
   		<div class="tab-content">
   			<a href="<?=base_url().'welcome/tiket';?>" id="fa fa-back" class='btn btn-warning'>Kembali</a>
   			<div class="container margin_60">
   				<div class="row">
   					<div class="col-lg-12">
   						
   						<?php if($CariData->num_rows() < 1 ){
   							echo "
                        <div class='alert alert-danger' role='alert'>Data Not Found..!</div>
                        ";
                     }else{
                      echo " <div class='alert alert-info' role='alert'>Silakan Lihat Data Dibawah..!</div>";
                      ?>
                      <table class="table table-striped cart-list add_bottom_30">
                       <thead>
                        <tr>
                         <th>No</th>
                         <th>
                           Nama Maskapai
                        </th>
                        <th>
                           Kode Pesawat
                        </th>
                        <th>
                         Jumlah Tiket
                      </th>
                      <th>
                         Tanggal
                      </th>
                      <th>
                        Waktu Berangkat
                     </th>
                     <th>
                       Action
                    </th>
                 </tr>
              </thead>
              <tbody>
               <tr>
                 <?php
                 $no = 1;
                 foreach ($CariData->result_array() as $key ) {
                    $PenerbanganData = $this->db->get_where('db_penerbangan',array('id'=>$key['id_penerbangan']))->row_array();
                    ?>
                    <td><?=$no++;?></td>
                    <td><?=$PenerbanganData['nama_maskapai'];?></td>
                    <td><?=$key['kode_pesawat'];?></td>

                    <td><?=$key['Jumlah_tiket'];?> Buah Tiket</td>
                    <td><?=$key['hari']. '-'.$key['tanggal'];?></td>
                    <td><?=$key['waktu_berangkat'];?></td>
                    <td><a href="<?=base_url().'welcome/InfoTiket?idData='.base64_encode($key['id_data_tiket']).'&X='.base64_encode($key['id_penerbangan']).'';?>" id="fa fa-back" class='btn btn-info'>PESAN</a></td>
                 </tr>
              <?php }?>
           </tbody>
        </table>
     <?php }?>
  </div>
</div>
</div>

</div>
</div>
</section>




