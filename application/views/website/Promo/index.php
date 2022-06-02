<section class="section-white">
  <div class="container ">
    <div class="row  pt-5">
     <!--begin col-md-12 -->
     <div class="col-md-12 text-center">
      <h2 class="section-title ">Halaman Daftar Promo</h2>
      <hr>
    </div>
    <div class="col-md-12">
      <div class="row">
        <?php foreach ($variable1->result_array() as $key ) {
          $Persenan = round($key['harga_normal_data'] - $key['harga']);
          $NilaiPersen = round($Persenan / $key['harga_normal_data']  * 100,2);
          $FotoLimit = $this->db->limit(1)->get_where('tb_promo_image',array('id_promo'=>$key['id_promo']))->row_array();
          ?>
          <div class="col-md-4">
           <img width="100%" src="<?=base_url().'image/promo/'.$FotoLimit['image_file'];?>" alt="testimonials" class="testim-img">
         </div>
       <?php }?>
      </div>
    </div>
   <div class="container">
    <hr>
    <?php if(isset($_GET['idData']) != ''){?>

    <?php }else{?>
      <div class="row">
        <div class="col-md-4" style="border-right: 1px black solid">
          <?php foreach ($variable1->result_array() as $key ) {
            $Persenan = round($key['harga_normal_data'] - $key['harga']);
            $NilaiPersen = round($Persenan / $key['harga_normal_data']  * 100,2);
            $FotoLimit = $this->db->limit(1)->get_where('tb_promo_image',array('id_promo'=>$key['id_promo']))->row_array();
            ?>
            <div class="col-md-12">
              <a href="<?=base_url().'PromoData/dataViews?idPromo='.$key['id_layanan'].'';?>">
                <div class="testim-inner first">
                  <p><?=$key['nama_layanan'];?></p>
                </div>
              </a>
            </div>
          <?php }?>
        </div>
        <?php if(isset($_GET['idPromo']) != ''){?>
         <div class="col-md-8">
          <?php
          foreach ($variable2->result_array() as $key ) {
            $query = $this->db->select('image_file,id_promo')
            ->where('id_promo', $key['id_promo'])
            ->limit(1)
            ->get('tb_promo_image')->row_array();
            ?>
            <div class="row ">
              <div class="col-md-4 padding-top-20">
                <img src="<?=base_url().'image/promo/'.$query['image_file'];?>" class="width-100" alt="Happy Woman">
              </div>
              <div class="col-md-8 padding-top-20 ">
                <div class="small-col-inside">
                  <h3><?=$key['kode_paket_data'];?></h3>
                  <div class="card">
                    <div class="card-body">
                      <p>Harga Awal dari <span style="text-decoration: line-through;"><b> Rp. <?=number_format($key['harga_normal_data']);?></b> </span> Menjadi  <b> Rp. <?=number_format($key['harga']);?> </b>. Promo dimulai dari tanggal <?=$key['tanggal_dibuat'];?> sampai dengan tanggal <?=$key['tanggal_Berakhir'];?>.</p>
                      <a href="<?=base_url().'PromoData?idData='.base64_encode($key['id_promo']).'';?>"> 
                        <button class="btn btn-primary" type="submit" >
                          INFO LENGKAP
                        </button>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>

          <?php }?>
        </div>
      <?php }else{?>
        <div class="col-md-8">
          <?php 
          foreach ($variable3->result_array() as $keys ) {
           $query = $this->db->select('image_file,id_promo')
           ->where('id_promo', $keys['id_promo'])
           ->limit(1)
           ->get('tb_promo_image')->row_array();
           $query1 = $this->db->get_where('db_paket',array('id_paket'=>$keys['id_note_layanan']))->row_array();
           ?>
           <div class="row no-gutters">
            <div class="col-md-4">
              <img src="<?=base_url().'image/promo/'.$query['image_file'];?>" class="width-100" alt="Happy Woman">
            </div>
            <div class="col-md-8 padding-top-20 ">
              <div class="small-col-inside">
                <h3><?=$query1['kode_paket_data'];?></h3>
                <div class="card">
                  <div class="card-body">
                    <p>Harga Awal dari <span style="text-decoration: line-through;"><b> Rp. <?=number_format($keys['harga_normal_data']);?></b> </span> Menjadi  <b> Rp. <?=number_format($query1['harga']);?> </b>. Promo dimulai dari tanggal <?=$key['tanggal_dibuat'];?> sampai dengan tanggal <?=$query1['tanggal_Berakhir'];?>.</p>
                    <a href="<?=base_url().'PromoData?idData='.base64_encode($keys['id_promo']).'';?>"> 
                      <button class="btn btn-primary" type="submit" >
                        INFO LENGKAP
                      </button>
                    </a>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
        <?php }?>
        <?php echo $pagination; ?>
      <?php }?>
    </div>
  <?php }?>
</div>
</div>
</section>