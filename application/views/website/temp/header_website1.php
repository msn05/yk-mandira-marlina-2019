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
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="<?=base_url().'welcome';?>">
						<img width="16%" src="<?=base_url().'image/logo/home-page.png';?>">
						<?=$Perusahaan->nama_perusahaan;?></a>
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
						</button>
						<div class="navbar-collapse collapse" >
							<ul class="navbar-nav ml-auto">
								<li>
									<a href="<?=base_url().'welcome';?>"><i class="fa fa-home"> Home</i>
									</a></li>
								</ul>
							</div>
						</nav>
					</div>
				</nav>
			</header>