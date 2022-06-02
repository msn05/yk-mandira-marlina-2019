   <section id="search_container">
   	<div id="search">
      <div class="tab-content">
        <a href="<?=base_url().'welcome/Umroh';?>" id="fa fa-back" class='btn btn-warning'>Kembali</a>
        <div class="container margin_60">
          <div class="row">
            <div class="col-lg-12">
             <?php if($CariData->num_rows() < 1 ){
               echo "<div class='alert alert-danger' role='alert'>Data Not Found..!</div>";
             }else{
               echo "<div class='alert alert-info' role='alert'>Silakan Lihat Data Dibawah..!</div>";
               ?>
             </div>
             <table class="table table-striped cart-list add_bottom_30">
              <thead>
                <tr>
                  <th>No</th>
                  <th>
                    Nama Paket Layanan
                  </th>
                  <th>
                   Pelanggan Terdaftar
                 </th>
                 <th>
                  Lama Perjalanan
                </th>
                <th>
                  Harga
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
                  $Pelanggan = $this->db->select('count(id_pelanggan) as TotalPelanggan')->get_where('tb_pemasanan_paket',array('id_paket'=>$key['id_paket']))->row_array();
                  ?>
                  <td><?=$no++;?></td>
                  <td><?=$key['kode_paket_data'].'-'.$key['nama_layanan'];?></td>
                  <td><?=$Pelanggan['TotalPelanggan'];?> Orang</td>
                  <td><?=$key['lama_perjalanan'];?> Hari</td>
                  <td>Rp. <?=number_format($key['harga']);?></td>

                  <td>  <a href="<?=base_url().'welcome/Info?idData='.base64_encode($key['id_paket']).'';?>" id="fa fa-back" class='btn btn-info'>PESAN</a></td>
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




