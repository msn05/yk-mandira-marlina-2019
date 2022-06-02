<!DOCTYPE html>
<html lang="zxx">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="">
 <meta name="description" content="">

 <title><?=$Perusahaan->nama_perusahaan;?></title>

 <!-- Loading Bootstrap -->
 <link href="<?=base_url().'assets/leadPage/css/bootstrap.min.css';?>" rel="stylesheet">

 <!-- Loading Template CSS -->
 <link href="<?=base_url().'assets/leadPage/css/style.css';?>" rel="stylesheet">
 <link href="<?=base_url().'assets/leadPage/css/animate.css';?>" rel="stylesheet">
 <link rel="stylesheet" href="<?=base_url().'assets/leadPage/css/pe-icon-7-stroke.css';?>">
 <link href="<?=base_url().'assets/leadPage/css/style-magnific-popup.css';?>" rel="stylesheet">

 <!-- Awsome Fonts -->
 <link rel="stylesheet" href="<?=base_url().'assets/leadPage/css/all.min.css';?>">

 <!-- Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">

 <!-- Font Favicon -->
 <link rel="shortcut icon" href="<?=base_url().'image/logo/favicon.ico';?>">

</head>

<body>

 <!--begin header -->
 <header class="header">

  <!--begin navbar-fixed-top -->
  <nav class="navbar navbar-default navbar-fixed-top">

   <!--begin container -->
   <div class="container">

    <!--begin navbar -->
    <nav class="navbar navbar-expand-lg">

     <a class="navbar-brand" href="<?=base_url().'welcome';?>">
      <img width="16%" src="<?=base_url().'image/logo/home-page.png';?>">
      <?=$Perusahaan->nama_perusahaan;?></a>
      <!--end logo -->

      <!--begin navbar-toggler -->
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
     </button>
     <!--end navbar-toggler -->

     <!--begin navbar-collapse -->
     <div class="navbar-collapse collapse" id="navbarCollapse">

       <!--begin navbar-nav -->
       <ul class="navbar-nav ml-auto">

        <li><a href="#home"><i class="fa fa-home"> Home</i></a></li>

        <li><a href="#services"><i class=" fa fa-bookmark"> Layanan</i></a></li>
        <li><a href="#promo"><i class=" fa fa-percent"> Promo</i></a></li>

        <li><a href="#features"><i class="fa fa-check-square"> Keutungan </i></a></li>
        <li><a href="#showcase"><i class="fa fa-image"> Galeri</i></a></li>

        <li><a href="#contact"><i class=" fa fa-certificate"> Tentang</i></a></li>
 
       <li class="Login"></li>


      </ul>
      <!--end navbar-nav -->
    
    </div>
  
<a class='pl-2' target='_blank' href="<?=base_url('').'Login';?>"><i class="fa fa-sign-in" >LOGIN</i></a>
  </nav>
  <!--end navbar -->

</div>
<!--end container -->

</nav>
<!--end navbar-fixed-top -->

</header>