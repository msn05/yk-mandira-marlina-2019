<!doctype html>
<html class="no-js " lang="en">
<head>
 <meta charset="utf-8">
 <title><?=$Perusahaan->nama_perusahaan;?></title>
 <link rel="icon" href="<?=base_url().'image/logo/favicon.ico';?>" type="image/x-icon">
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- vendor css files -->

 <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/bootstrap/bootstrap.min.css';?>">    
 <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/css/vendor/animsition.min.css';?>">
 <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/morris/morris.css';?>">


 <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/css/main.css';?>">
 
 <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/libscripts.bundle.js';?>"></script>
 <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/vendorscripts.bundle.js';?>"></script>
 <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/mainscripts.bundle.js';?>"></script>
 
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
 <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.css';?>">

 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.19/jquery.datetimepicker.full.min.js"></script>
 <link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">
 <script type="text/javascript" src=" https://printjs-4de6.kxcdn.com/print.min.js"></script>
 
 <script>
  $(document).ready(function() {
   $('.date').datetimepicker();
 });
  
</script>

</head>
<body id="falcon" class="main_Wrapper">
 <div id="wrap" class="animsition">
  <div id="header">
   <header class="clearfix">
    <div class="branding">
     <a class="brand" href="<?=base_url().'home';?>">
      <span class="h5 m-0"><?=$Perusahaan->nama_perusahaan;?></span>
    </a>
    <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  <ul class="nav-left pull-left list-unstyled list-inline">
   <li class="leftmenu-collapse">
    <a role="button" tabindex="0" class="collapse-leftmenu">
     <i class="fa fa-outdent"></i>
   </a>
 </li>
</ul>
<ul class="nav-right pull-right list-inline">
 <li class="dropdown nav-profile">
  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
   <span  alt="" class="fa fa-user size-30x30"> </span></a>
   <ul class="dropdown-menu pull-right" role="menu">
    <li>
     <div class="user-info">
      <div class="user-name"><?=$nama;?>
      <span class="text-success pull-right user-position online">Online</span>
    </div>
  </div>
</li>
<li>
  <a href="<?=base_url().'data/profile/info/'.$id;?>" role="button" tabindex="0">
   <i class="fa fa-user"></i>Profile</a>
 </li>
 <li class="divider"></li>
 <li>
   <a type="button" id='Keluar' role="button" tabindex="0">
    <i class="fa fa-sign-out"></i>Logout</a>
  </li>
</ul>
</li>
</ul>
</header>
</div>
<div id="controls">
 <aside id="leftmenu">
  <div id="leftmenu-wrap">
   <div class="panel-group slim-scroll" role="tablist">
    <div class="panel panel-default">
     <div id="leftmenuNav" class="panel-collapse collapse in" role="tabpanel">
      <div class="panel-body">
       <ul id="navigation">
        <li class="active open">
         <a href="<?=base_url().'home';?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php if($Level == 1){?>
       <li>
        <a role="button" tabindex="0">
         <i class="fa fa-list"></i>
         <span>Master</span>
       </a>
       <ul>
      <!--    <li>
          <a href="<?=base_url().'data/karyawan';?>">
           <i class="fa fa-angle-right"></i> Karyawan
         </a>
       </li> -->
       <li>
        <a href="<?=base_url().'data/pelanggan';?>">
         <i class="fa fa-angle-right"></i> Pelanggan
       </a>
     </li>
     <li>
      <a href="<?=base_url().'data/pengguna';?>">
       <i class="fa fa-angle-right"></i> Karyawan</a>
     </li>
     <li>
       <a href="<?=base_url().'data/layanan';?>">
        <i class="fa fa-angle-right"></i> Layanan</a>
      </li>  
      <li calss="active open">
        <a role="button" >
         <i class="fa fa-angle-right"></i>
         <span>Pembayaran</span>
       </a>
       <ul>
         <li>
          <a href="<?=base_url().'data/metode_pembayaran';?>"><i class="fa fa-angle-right"></i>Metode</a>
        </li>
        <li>
          <a href="<?=base_url().'data/Pembayaran/Travel';?>"><i class="fa fa-angle-right"></i>Data</a>
        </li>
      </ul>
    </li>
  </ul>
</li>
<li calss="active open">
  <a role="button" >
   <i class="fa fa-list"></i>
   <span>Perlengkapan</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/perlengkapan';?>">
     <i class="fa fa-angle-right"></i> Lanjutan</a>
   </li>
   <li>
     <a href="<?=base_url().'data/bus';?>">
      <i class="fa fa-automobile (alias)"></i> Bus</a>
    </li> 
    <li>
      <a href="<?=base_url().'data/penerbangan/travel';?>">
       <i class="fa fa-fighter-jet"></i> Penerbangan</a>
     </li>
     <li>
       <a href="<?=base_url().'data/hotel/travel';?>">
        <i class="fa fa-hotel"></i> Hotel</a>
      </li> 
    </ul>
  </li>
  <li>
    <a role="button" tabindex="0">
     <i class="fa fa-list"></i>
     <span>Umroh dan Haji</span>
   </a>
   <ul>
     <li>
      <a href="<?=base_url().'data/paket/travel';?>">
       <i class="fa fa-angle-right"></i> Paket
     </a>
   </li>
   <li>
    <a href="<?=base_url().'data/Pemesanan/Travel';?>">
     <i class="fa fa-angle-right"></i> Pemesanan</a>
   </li>

   <li>
     <a role="button" >
      <i class="fa fa-angle-right"></i>
      <span>Jadwal Berangkat</span>
    </a>
    <ul>
      <li>
       <a href="<?=base_url().'data/JadwalBerangkat/TravelHaji';?>"><i class="fa fa-angle-right"></i>Haji</a>
     </li>
     <li>
       <a href="<?=base_url().'data/JadwalBerangkat/TravelUmroh';?>"><i class="fa fa-angle-right"></i>Umroh</a>
     </li>
   </ul>
 </li>
 <li>
   <a href="<?=base_url().'data/JadwalBerangkat/HistoriPemesanan';?>">
    <i class="fa fa-angle-right"></i> Histori Pemesanan</a>
  </li>  
</ul>
</li>
<li>
  <a role="button" tabindex="0">
   <i class="fa fa-list"></i>
   <span>Pariwisata</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/paket/pariwisata';?>">
     <i class="fa fa-angle-right"></i> Paket
   </a>
 </li>
 <li>
  <a href="<?=base_url().'data/Pemesanan/tourPariwisata';?>">
   <i class="fa fa-angle-right"></i> Pemesanan</a>
 </li>
 <li>
   <a href="<?=base_url().'data/JadwalBerangkat/tourPariwisata';?>"><i class="fa fa-angle-right"></i>Jadwal Berangkat</a>
 </li>
</li>
<li>
  <a href="<?=base_url().'data/JadwalBerangkat/HistoriPemesananPariwisata';?>">
   <i class="fa fa-angle-right"></i> Histori Pemesanan</a>
 </li>  
</ul>
</li>
<li>
 <a href="<?=base_url().'data/Pembayaran/Travel';?>"><i class="fa fa-list"></i>Pembayaran</a>
</li>
<li>
  <a href="<?=base_url().'data/Promo';?>"><i class="fa fa-list"></i>Promo Layanan</a>
</li>

<li>
 <a role="button" tabindex="0">
  <i class="fa fa-list"></i>
  <span>Ticketing</span>
</a>
<ul>
  <li>
   <a href="<?=base_url().'data/Ticketing';?>">
    <i class="fa fa-angle-right"></i> Data Tiket</a>
  </li>
  <li>
    <a href="<?=base_url().'data/PesanTiket';?>">
     <i class="fa fa-angle-right"></i> Daftar Pesanan</a>
   </li>
   <li>
    <li>
     <a href="<?=base_url().'data/PembayaranTiket';?>">
      <i class="fa fa-angle-right"></i> Pembayaran Tiket</a>
    </li>
    <li>
      <a href="<?=base_url().'data/CetakTiketPelanggan';?>">
        <i class="fa fa-angle-right"></i> Tiket Cetak </a>
      </li>
      <li>
        <a href="<?=base_url().'data/PesanTiket/HistoriPesanTiket';?>">
         <i class="fa fa-angle-right"></i> Histori Pesanan
       </a>
     </li>
   </ul>
 </li>

 <li>
  <a href="<?=base_url().'data/Pelanggan';?>">
   <i class="fa fa-list"></i>
   <span>Pelanggan</span>
 </a>
</li>
<li>
  <a role="button" tabindex="0">
   <i class="fa fa-list"></i>
   <span>Panduan</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/Panduan/Pendaftaran';?>">
     <i class="fa fa-angle-right"></i> Pendaftaran</a>
   </li>
   <li>
    <a href="<?=base_url().'data/Panduan/Pembayaran';?>">
      <i class="fa fa-angle-right"></i> Pembayaran</a>
    </li>

  </ul>
</li>
<div class="panel settings panel-default">
  <div class="panel-heading" role="tab">
   <h4 class="panel-title">
    <a data-toggle="collapse" href="#leftmenuControls">Perusahaan
     <i class="fa fa-angle-up"></i>
   </a>
 </h4>
</div>
<div id="leftmenuControls" class="panel-collapse collapse in" role="tabpanel">
 <div class="panel-body">
  <ul id="navigation">
   <li>
    <a href="<?=base_url().'data/Galeri';?>" role="button" tabindex="0">
     <i class="fa fa-file-image-o"></i>
     <span>Galeri</span>
   </a>
 </li>
 <li>
  <a role="button" href="<?=base_url().'data/YekaMandira';?>" tabindex="0">
   <i class="fa fa-university"></i>
   <span>Tentang Perusahaan</span>
 </a>
</li>
</ul>
</div>
</div>
</div>


<?php }elseif($Level == 3){
 ?>

 <li calss="active open">
  <a role="button" >
   <i class="fa fa-list"></i>
   <span>Perlengkapan</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/perlengkapan';?>">
     <i class="fa fa-angle-right"></i> Lanjutan</a>
   </li>
   <li>
     <a href="<?=base_url().'data/bus';?>">
      <i class="fa fa-automobile (alias)"></i> Bus</a>
    </li> 
    <li>
      <a href="<?=base_url().'data/penerbangan/travel';?>">
       <i class="fa fa-fighter-jet"></i> Penerbangan</a>
     </li>
     <li>
       <a href="<?=base_url().'data/hotel/travel';?>">
        <i class="fa fa-hotel"></i> Hotel</a>
      </li> 
    </ul>
  </li>
  <li>
    <a role="button" tabindex="0">
     <i class="fa fa-list"></i>
     <span>Umroh dan Haji</span>
   </a>
   <ul>
     <li>
      <a href="<?=base_url().'data/paket/travel';?>">
       <i class="fa fa-angle-right"></i> Paket
     </a>
   </li>
   <li>
    <a href="<?=base_url().'data/Pemesanan/Travel';?>">
     <i class="fa fa-angle-right"></i> Pemesanan</a>
   </li>

   <li>
     <a role="button" >
      <i class="fa fa-angle-right"></i>
      <span>Jadwal Berangkat</span>
    </a>
    <ul>
      <li>
       <a href="<?=base_url().'data/JadwalBerangkat/TravelHaji';?>"><i class="fa fa-angle-right"></i>Haji</a>
     </li>
     <li>
       <a href="<?=base_url().'data/JadwalBerangkat/TravelUmroh';?>"><i class="fa fa-angle-right"></i>Umroh</a>
     </li>
   </ul>
 </li>
 <li>
   <a href="<?=base_url().'data/JadwalBerangkat/HistoriPemesanan';?>">
    <i class="fa fa-angle-right"></i> Histori Pemesanan</a>
  </li>  
</ul>
</li>
<li>
  <a role="button" tabindex="0">
   <i class="fa fa-list"></i>
   <span>Pariwisata</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/paket/pariwisata';?>">
     <i class="fa fa-angle-right"></i> Paket
   </a>
 </li>
 <li>
  <a href="<?=base_url().'data/Pemesanan/tourPariwisata';?>">
   <i class="fa fa-angle-right"></i> Pemesanan</a>
 </li>
 <li>
   <a href="<?=base_url().'data/JadwalBerangkat/tourPariwisata';?>"><i class="fa fa-angle-right"></i>Jadwal Berangkat</a>
 </li>
</li>
<li>
  <a href="<?=base_url().'data/JadwalBerangkat/HistoriPemesananPariwisata';?>">
   <i class="fa fa-angle-right"></i> Histori Pemesanan</a>
 </li>  
</ul>
</li>
<li>
 <a href="<?=base_url().'data/Pembayaran/Travel';?>"><i class="fa fa-list"></i>Pembayaran</a>
</li>

<li>
 <a role="button" tabindex="0">
  <i class="fa fa-list"></i>
  <span>Ticketing</span>
</a>
<ul>
  <li>
   <a href="<?=base_url().'data/Ticketing';?>">
    <i class="fa fa-angle-right"></i> Data Tiket</a>
  </li>
  <li>
    <a href="<?=base_url().'data/PesanTiket';?>">
     <i class="fa fa-angle-right"></i> Daftar Pesanan</a>
   </li>
   <li>
     <a href="<?=base_url().'data/PembayaranTiket';?>">
      <i class="fa fa-angle-right"></i> Histori Pembayaran</a>
    </li>
    <li>
      <a href="<?=base_url().'data/PesanTiket/HistoriPesanTiket';?>">
       <i class="fa fa-angle-right"></i> Histori Pesanan
     </a>
   </li>
 </ul>
</li>

<li>
  <a href="<?=base_url().'data/Pelanggan';?>">
   <i class="fa fa-list"></i>
   <span>Pelanggan</span>
 </a>
</li>
<li>
  <a href="<?=base_url().'data/Promo';?>"><i class="fa fa-list"></i>Promo Layanan</a>
</li>

</ul>
</div>
</div>
</div>

</div>
<?php }elseif($Level == 4){?>
 <li>
  <a role="button" tabindex="0">
   <i class="fa fa-list"></i>
   <span>Laporan</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/Laporan/data?idData='.base64_encode('Pelanggan').'';?>">
     <i class="fa fa-angle-right"></i> Pelanggan</a>
   </li>
   <li>
     <a href="<?=base_url().'data/Laporan/data?idData='.base64_encode('Tagihan').'';?>">
      <i class="fa fa-angle-right"></i> Tagihan</a>
    </li>
  </ul>
</li>
<li>
  <a role="button" tabindex="0">
   <i class="fa fa-list"></i>
   <span>Document Mitra</span>
 </a>
 <ul>
   <li>
    <a href="<?=base_url().'data/DokumenKemitraan/bus';?>">
     <i class="fa fa-angle-right"></i> Bus</a>
   </li>
   <li>
     <a href="<?=base_url().'data/DokumenKemitraan/penerbangan';?>">
      <i class="fa fa-angle-right"></i> Penerbangan</a>
    </li>

  </ul>
</li>
</ul>
</div>
</div>
</div>

<?php }elseif($Level == 2){?>
  <li>
    <a href="<?=base_url().'data/Promo/InfoPelanggan';?>">
      <i class="fa fa-percent"></i> Promo</a>
    </li>
    <li>
     <a href='https://web.whatsapp.com/send?phone=+62 882-8641-7562' target='_blank'>
      <i class="fa fa-wechat"></i> Chat</a>
    </li>
    <li>
      <a role="button" >
       <i class="fa fa-list"></i>
       <span>Metode Pembayaran</span>
     </a>
     <ul>
       <li>
        <a href="<?=base_url().'data/metode_pembayaran/InfoViews';?>"><i class="fa fa-angle-right"></i>Metode</a>
      </li>
    </ul>
  </li>
  <li>
    <a role="button" >
     <i class="fa fa-list"></i>
     <span>Pemesanan</span>
   </a>
   <ul>
    <li>
      <a href="<?=base_url().'data/Pemesanan/travel';?>">
        <i class="fa fa-shopping-cart"></i> Haji dan Umroh</a>
      </li>
      <li>
       <a href="<?=base_url().'data/Pemesanan/tourPariwisata';?>">
        <i class="fa fa-shopping-cart"></i> Pariwisata</a>
      </li>
      <li>
        <a role="button" >
         <i class="fa fa-list"></i>
         <span>Tiket</span>
       </a>
       <ul>
        <li>
          <a href="<?=base_url().'data/PesanTiket/InfoTiketPesan';?>">
           <i class="fa fa-shopping-cart"></i> Daftar Pesanan</a>
         </li>
         <li>
          <a href="<?=base_url().'data/CetakTiketPelanggan';?>">
            <i class="fa fa-ticket"></i> Nomor Tiket</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <!-- <li>
    <a role="button" >
     <i class="fa fa-money"></i>
     <span>Histori Pembayaran</span>
   </a>
   <ul>
    <li>
     <a href="<?=base_url().'data/Pembayaran/Travel';?>">Tour and Travel</a>
   </li>
   <!-- <li>
    <a href="<?=base_url().'data/Ticketing';?>">
    Tiket</a>
  </li> -->
</ul>
</li> -->

<?php }?>
<<!-- div class="panel settings panel-default">
  <div class="panel-heading" role="tab">
   <h4 class="panel-title">
    <a data-toggle="collapse" href="#panduan">Panduan
      <i class="fa fa-angle-up"></i></a>
    </h4>
  </div>
  <div id="panduan" class="panel-collapse collapse in" role="tabpanel">
   <div class="panel-body">
    <ul id="navigation">
     <li>
      <a role="button" tabindex="0">
       <i class="fa fa-file"></i>
       <span>Penggunaan</span>
     </a>
     <a role="button" tabindex="0">
      <i class="fa fa-file"></i>
      <span>Tata Cara Paket</span>
    </a>
  </li>
</ul>
</div>
</div>
</div> -->
</div>
</div>
</aside>
</div>