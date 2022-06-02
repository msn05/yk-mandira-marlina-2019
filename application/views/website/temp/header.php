<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
	<meta name="author" content="Ansonika">
	<title><?=$Perusahaan->nama_perusahaan;?></title>
	<link rel="icon" href="<?=base_url().'image/logo/favicon.ico';?>" type="image/x-icon">

	<link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Montserrat:300,400,700" rel="stylesheet">

	<!-- COMMON CSS -->
	<link href="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/css/bootstrap.min.css';?>" rel="stylesheet">
	<link href="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/css/style.css';?>" rel="stylesheet">
	<link href="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/css/vendors.css';?>" rel="stylesheet">

	<!-- CUSTOM CSS -->
	<link href="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/css/custom.css';?>" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<script src="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/js/jquery-2.2.4.min.js';?>"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>

	<div id="preloader">
		<div class="sk-spinner sk-spinner-wave">
			<div class="sk-rect1"></div>
			<div class="sk-rect2"></div>
			<div class="sk-rect3"></div>
			<div class="sk-rect4"></div>
			<div class="sk-rect5"></div>
		</div>
	</div>
	<!-- End Preload -->

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<header>
		<div id="top_line">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<ul id="top_links">
							<li>
								<a href="<?=base_url();?>" id="fa fa-back">Kembali</a>
							</li>
							<li><a href="<?=base_url().'./login';?>" target='_blank'>Sign in</a></li>
						</ul>
					</div>
				</div><!-- End row -->
			</div><!-- End container-->
		</div><!-- End top line-->

		<div class="container">
			<div class="row">
				<div class="col-3">
					<div id="logo_home">
						<img src="<?=base_url().'image/logo/logo_depan.png';?>" width="160" height="34">
					</div>
				</div>
				<nav class="col-9">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="<?=base_url().'image/logo/logo_depan.png';?>"><span>Menu mobile</span></a>
					<div class="main-menu">
						<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
						<ul>
							<li class="submenu">
								<a href="<?=base_url().'welcome/Umroh';?>" class="show-submenu">Home </a>
							</li>
							<!-- <li class="submenu">
								<a href="<?=base_url().'PromoData';?>" class="show-submenu">Promo </a>
							</li> -->
							<li class="submenu">
								<a href="<?=base_url().'GaleriDokumentasi';?>" class="show-submenu">Galeri Foto </a>
							</li>
							<!-- <li class="third-level"><a href="javascript:void(0);">Panduan</a>
								<ul>
									<li><a href="<?=base_url().'welcome/PanduanPendaftaran';?>">Pendaftaran</a></li>
									<li><a href="<?=base_url().'welcome/PanduanPembayaran';?>">Pembayaran</a></li>
								</ul>
							</li> -->
						</ul>
					</div>

				</nav>
			</div>
		</div>
	</header>



