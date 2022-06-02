
<section class=" section-white section-top-border" id="home">

  <div class="container-fluid">

   <div class="row">

    <div class="col-md-12 padding-top-2">
     <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
       <?php
       $result = $this->db->get_where('tb_image_slide',array('action'=>1));
       for ($i=0; $i <$result->num_rows() ; $i++) { 
        echo '
        <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
        if($i==0){echo'class="active"';}echo'></li>';
      }
      ?> 
    </ol>
    <div class="carousel-inner">
     <?php
     if($result->num_rows > 0){
      foreach ($result->result_array() as $row ) {
       $Gambar = $this->db->get_where('tb_dokumentasi',array('id'=>$row['image']))->row_array();
       if($row['id'] == 1){
        echo'<div class="carousel-item active">';
      }else{echo'<div class="carousel-item">';
    }
    ?>
    <img class="d-block w-100"  height="450px" src='<?=base_url().'image/galeri/'.$Gambar['foto'].'';?>' alt='<?=$Gambar['keterangan'];?>'>
    <div class="carousel-caption d-md-block">
      <h1 class="text-white">Welcome To Yeka Madira Palembang</h1>
    </div>  
  </div>
<?php }}?>
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
</div>
<!-- </div> -->

   <!--  <div class="section-white">
     <h3><marquee behavior="scroll" direction="left" scrollamount="10">Selamat Datang, Silakan Scroll Untuk mendapatkan informasi tentang layanan kami
     </marquee></h3>
     <p class="text-right">Palembang, <?=date('d F Y H:i:s');?> </p>
   </div> -->
   <div class="footer">
     <div class="col-md-12 ">
      <h3><marquee behavior="scroll" direction="left" scrollamount="10">Selamat Datang, Silakan Scroll Untuk mendapatkan informasi tentang layanan kami
      </marquee></h3>
      <p class="text-right">Palembang, <?=date('d F Y H:i:s');?> </p>
    </div>
  </div>
</div>
</section>


<!--end home section -->
<section class="section-white" id="services">

  <div class="container-fluid">
   <div class="row">
    <!--begin col-md-12 -->
    <div class="col-md-12 text-center">

     <h2 class="section-title">Daftar Layanan</h2>
     <p class="section-subtitle">Silakan Pilih Layanan.</p>
   </div>
 </div>
</div>
<!--begin container -->
<div class="container">

 <!--begin row -->
 <div class="row">

  <div class="col-md-4 d-flex">
    <div class="testim-inner first">
     <div class="our-services">
      <a href="<?=base_url().'welcome/Umroh';?>"> <h3>Umroh dan Haji</h3>
       <p>Layanan yang memberikan informasi layanan umroh dan haji, pendaftaran layanan, dll. Silakan klik halaman untuk melihatnya..!</p></a>
     </div>
   </div>
 </div>
 <div class="col-md-4 d-flex">
  <div class="testim-inner first">
    <div class="our-services">
     <a href="<?=base_url().'welcome/pariwisata';?>">  <h3>Pariwisata</h3>
      <p>Layanan yang memberikan informasi layanan pariwisata, pendaftaran layanan, dll</p>
    </a>
  </div>
</div>
</div>
<div class="col-md-4 d-flex">
 <div class="testim-inner first">
  <div class="our-services">
   <a href="<?=base_url().'welcome/tiket';?>">  <h3>Tiketing</h3>
    <p>Layanan yang memberikan informasi layanan tiket, pemesanan tiket</p>
  </a>
</div>
</div>
</div>

</div>
</div>

</section>

<section class="promo-wrapper section-top-border section-bottom-border" id="promo">
 <div class="home-section-overlay"></div>
 <div class="container">
  <div class="col-md-12">
    <div class="row">

     <!--begin col-md-12 -->
     <div class="col-md-12 text-center padding-bottom-40">
      <h2 class="section-title white-text">Promo Layanan Saat ini</h2>
      <hr>
    </div>
    <?php foreach ($variable1->result_array() as $key ) {
      $Persenan = round($key['harga_normal_data'] - $key['harga']);
      $NilaiPersen = round($Persenan / $key['harga_normal_data']  * 100,2);
      $FotoLimit = $this->db->limit(1)->get_where('tb_promo_image',array('id_promo'=>$key['id_promo']))->row_array();
      ?>
      <div class="col-md-4">
        <div class="testim-inner first">
         <img width="100%" src="<?=base_url().'image/promo/'.$FotoLimit['image_file'];?>" alt="testimonials" class="testim-img">
         <p><?=$key['nama_layanan'];?></p>
         <p>Ayo Segera Daftar Diri anda Sebelum tanggal <?=date('d-m-Y',strtotime($key['tanggal_Berakhir']));?>  
       </p>
     </div>
   </div>
 <?php }?>
 <hr>
 <div class="col-md-12 text-center padding-bottom-40">
  <a href="<?=base_url().'PromoData/readme';?>"><h2 class="section-title white-text">Readme Promo</h2></a>
</div>
</div>
</div>

</div>
<!--end container -->

</section>
<section class="section-grey section-bottom-border" id="features">

 <!--begin container -->
 <div class="container">

  <!--begin row -->
  <div class="row">

   <!--begin col-md-12-->
   <div class="col-md-12 text-center padding-bottom-10">
    <h2 class="section-title">Apa saja yang anda dapatkan jika bergabung</h2>
  </div>
</div>
<!--end row -->

<!--begin row -->
<div class="row">


 <div class="col-md-4">

  <div class="feature-box wow fadeIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">

   <i class="pe-7s-cash"></i>

   <h4>Biaya</h4>

   <p>Harga Dijamin murah dan pelayanan tidak mengecewakan.</p>

 </div>
</div>
<!--end col-md-4 -->

<!--begin col-md 4-->
<div class="col-md-4">

  <div class="feature-box wow fadeIn" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeIn;">

   <i class="pe-7s-tools "></i>

   <h4>Service</h4>

   <p>Pelayanan pelanggan kami siap melayani 24 jam untuk kebutuhan anda.</p>

 </div>
</div>

<div class="col-md-4">

  <div class="feature-box wow fadeIn" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeIn;">

   <i class="pe-7s-file "></i>

   <h4>Dokumen </h4>

   <p>Mendapatkan dokumen yang jelas dan terverifikasi ke layanan.</p>

 </div>
</div>
<!--end col-md-4 -->

</div>
<!--end row -->

</div>
<!--end container -->

</section>

<section class="portfolio-wrapper section-top-border" id="showcase">

 <div class="image-green-overlay"></div>

 <!--begin container -->
 <div class="container-fluid">

  <!--begin row -->
  <div class="row">

   <!--begin col-md-12 -->
   <div class="col-md-12 text-center padding-bottom-20">
    <h2 class="section-title white-text">Dokumentasi Perjalanan Travel and Tour</h2>
  </div>
  <!--end col-md-12 -->

</div>
<!--end row -->

</div>
<!--end container -->

<!--begin showcase-wrapper -->
<div class="showcase-wrapper">

  <!--begin container -->
  <div class="container-fluid">

   <!--begin row-->
   <div class="row">

    <!--begin col md 12-->
    <div class="col-md-12 padding-top-10">

     <!--begin carousel-->
     <div id="carouselIndicators" class="carousel slide carousel-showcase" data-ride="carousel">

      <!--begin carousel-inner-->
      <div class="carousel-inner">

       <div class="carousel-item active">
        <div class="row d-flex">
         <?php foreach ($variable->result_array() as $key ) {?>
          <div class="col-md-4 col-sm-4 col-xs-6">
            <figure class="gallery-item ">
              <div class="popup-gallery popup-gallery-rounded portfolio-pic">
               <a class="popup2" href="<?=base_url().'image/galeri/'.$key['foto'];?>">
                <img src="<?=base_url().'image/galeri/'.$key['foto'];?>" class="width-100" alt="pic">
                <span class="eye-wrapper"><i class="fa fa-search-plus eye-icon" style="font-size: 38px;"></i></span>
              </a>
            </div>
            <div class="portfolio-box">
             <h3><a href="#"><?=$key['keterangan'] != '' ? ''.$key['keterangan'].'' : 'Tidak Ada Keterangan';?></a></h3>
           </div>
         </figure>
       </div>
     <?php }?>
   </div>

 </div>

</div>

</div>
<!--end carousel-->

</div>
<!--end col md 12-->

</div>
<!--end row -->

</div>
<!--end container -->

</div>
<!--end showcase-wrapper -->
</section>

<section class="section-white section-bottom-border" id="contact">

 <!--begin container-->
 <div class="container">

  <!--begin row-->
  <div class="row">

   <!--begin col-md-6 -->
   <div class="col-md-6">

    <h4>Tentang Perusahaan</h4>

    <h5>Visi</h5>
    <textarea name="editor1"><?=$Perusahaan->visi;?></textarea>
    <hr>
    <h5>Misi</h5>
    <textarea name="editor2"><?=$Perusahaan->misi;?></textarea>
  </div>
  <!--end col-md-6 -->

  <!--begin col-md-6 -->
  <div class="col-md-6 responsive-bottom-margins">

    <h4>Mapping Google</h4>

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15937.79637680239!2d104.7523186!3d-2.9727996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5e404d0b268bd4d!2sRSU%20YK%20Madira!5e0!3m2!1sid!2sid!4v1593637021726!5m2!1sid!2sid" width="600" height="495" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

  </div>
  <!--end col-md-6 -->

</div>
<!--end row-->

</div>
<!--end container-->

</section>