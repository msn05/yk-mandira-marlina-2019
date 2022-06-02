
<main class="">
  <div class="container margin_30 pt-4">
   <hr>
   <div class="row">
    <div class="col-lg-12" id="single_tour_desc">
     <?php if($Notif == 'Umroh'){?>
       <p>
         Pada layanan umroh ini menggunakan 2 hotel yang digunakan untuk ditetapi oleh jamaah selama menjalani ibadah dimulai dari indonesia. Berikut ini informasi yang dapat dilihat dibawah ini..
       </p>
     <?php }else{?>
      <p>
        Pada layanan haju ini menggunakan 2 hotel yang digunakan untuk ditetapi oleh jamaah selama menjalani ibadah dimulai dari indonesia. Berikut ini informasi yang dapat dilihat dibawah ini..
      </p>

    <?php }?>
  </div>
  <div class="container margin_60">
   <div class="row">
    <div class="col-lg-7">
      <div class="box_style_1">
       <div id="single_tour_feat">
         <ul>
           <li><i class="fas fa-home"></i>Hotel 1</li>
           <li><i class="fas fa-car"></i>BUS</li>
           <li><i class="fas fa-plane"></i>Penerbangan</li>
           <li><i class="fas fa-cog"></i>Perlengkapan</li>
         </ul>
       </div>
       <div class="row">
        <?php
        $no = 1;
        foreach ($namaHotel->result_array() as $key) {?>
          <div class="col-lg-3">
            <h3>Hotel <?=$no++;?></h3>
          </div>
          <div class="col-lg-9">
            <h4><?=$key['nama_hotel'];?></h4>
            <p>
              Hotel ini berada di daerah negara <?=$key['negara'].' yang terletak pada provinsi '.$key['provinsi']. ' kota '.$key['kota']. ' dengan Alamat '. $key['alamat'];?>
            </p>
            <hr>	
          </div>
        <?php }?>
      </div>
      <div class="row">
       <div class="col-lg-3">
         <h3>Transportasi Darat</h3>
       </div>
       <div class="col-lg-9">
         <h4><?=$nama_bus;?></h4>
         <p>
           Kendaraan bernama  <?=$nama_bus.' dengan kode bus '.$kode_bus. ' dengan catatan '.$keterangan;?>
         </p>
         <hr>	
       </div>
     </div>

     <div class="row">
      <div class="col-lg-3">
        <h3>Pesawat</h3>
      </div>
      <div class="col-lg-9">
        <h4><?=$nama_maskapai;?></h4>
        <p>
          Nama Maskapai yang digunakan bernama  <?=$nama_maskapai.' dengan kode penerbangan '.$kode_penerbangan;?>
        </p>
        <hr>	
      </div>
    </div>
    <hr>
    <div class="row">
     <div class="col-lg-3">
       <h3>Perlengkapan</h3>
     </div>
     <div class="col-lg-9">
       <div class="table-responsive">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>
                 Nama Barang
               </th>
               <th>
                 Jumlah
               </th>
             </tr>
           </thead>
           <tbody>
            <?php
            foreach ($PerlengkapanPaket->result_array() as $key) {?>
              <tr>
                <td><?=$key['nama_barang'];?></td>
                <td><?=$key['JumlahBarangPelanggan'];?> Pcs</td>
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>
</div>
<aside class="col-lg-3">
  <div class="box_style_4"> 
    <h3>Informasi Lokasi Tempat</h3>
    <div class="col-md-12 padding-top-2">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
          <?php
          $result = $this->db->get_where('tb_promo_image',array('id_promo'=>$idDataS));
          for ($i=0; $i <$result->num_rows() ; $i++) { 
            echo '
            <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
            if($i==0){echo'class="active"';}echo'></li>';
          }
          ?> 
        </ol>
        <div class="carousel-inner">
          <?php
          $C =      $this->db->where('id_promo', $idDataS);
          $num_rows = $this->db->count_all_results('tb_promo_image');
          if($result->num_rows > 0){
            $no = 1;
            foreach ($result->result_array() as $row ) {
              if($num_rows == $no){
                echo'<div class="carousel-item active">';
              }else{echo'<div class="carousel-item">';
            }
            ?>
            <img class="d-block w-100" height="250px" src='<?=base_url().'image/promo/'.$row['image_file'].'';?>' >
            <div class="carousel-caption d-none d-md-block">
            </div>  
          </div>
          <?php 
          $no++;
        }}?>
      </div>
      <div class="padding-bottom-2">
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
              </a>
          </div>
        </div>
  </div>

  <div class="box_style_4">
   <i class="fa fa-users"></i>
   <h4>Batas Pelanggan : <?=$JumlahPelanggan;?> Orang</h4>
   <h3>Total Pelanggan Terdaftar
     <hr>
     <?php
     $Total = $this->db->select('count(id_pelanggan) as Total')->get_where('tb_pemasanan_paket',array('id_paket'=>$paketID))->row_array();?>
     <?=$Total['Total'];?> Orang</h3>
   </div>
 </aside>
 <aside class="col-lg-2">
   <p class="d-none d-xl-block d-lg-block d-xl-none">
     <a href="<?=base_url().'welcome/umroh';?>" class=" btn btn-warning green medium form-control text-center">Kembali</a>
   </p>
   <p class=" d-none d-xl-block ">
     <a href="<?=base_url().'welcome/PelangganUmroh?idData='.base64_encode($paketID).'';?>" class=" btn_1 green medium text-center">Pesan Sekarang</a>
   </p>
   <div class="box_style_4">
     <i class="fa fa-money"></i>
     <h4>Harga Paket
       <small><b>Rp. <?=number_format($harga);?></b></small></h4>
     </div>


     <div class="box_style_4">
       <i class="fa fa-calendar"></i>
       <h4>Batas Pemesanan</h4>
       <small><b><?=date('d-F-Y H:i:s',strtotime($TanggalBerangkat));?></b></small>
     </div>



   </aside>
 </div>
 <!--End row -->
</div>
<!--End container -->

<div id="overlay"></div>
<!-- Mask on input focus -->

</main>