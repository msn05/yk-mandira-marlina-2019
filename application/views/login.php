<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="<?=base_url().'image/logo/favicon.ico';?>" type="image/x-icon">
	<title><?=$Perusahaan->nama_perusahaan;?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/bootstrap/bootstrap.min.css';?>">
	<!-- CSS Files -->
	<link href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/css/main.css';?>" rel="stylesheet">
	
</head>

<body id="falcon" class="authentication">
	<div class="wrapper">
		<div class="header header-filter" style="background-image: url('<?=base_url().'assets/temp_dep/falconadmin/html/assets/images/login-bg.jpg';?>'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
						<div class="card card-signup">
							<form class="form" id="DataNya" method="post" action="">
								<div class="header header-primary text-center">
									<h4>Sign in</h4>
									<div class="social-line">
									</div>
								</div>
								<h3 class="mt-0"><?=$Perusahaan->nama_perusahaan;?></h3>
								<p class="help-block">Tour and Travel</p>
								<div class="content">
									<div class="form-group">
										<input type="text" name="id_akses" id="id_akses" class="form-control underline-input" placeholder="Masukkan Username Anda...?">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" placeholder="Password..." class="form-control underline-input">
									</div>
									<div class="footer text-center">
										<button type="submit" class="btn btn-info btn-raised">Login</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<footer class="footer mt-20">
					<div class="container">
						<div class="col-lg-12 text-center">
							<div class="copyright text-white mt-20"> &copy; 2017, made with
								<i class="fa fa-heart heart"></i> by
								<a href="#">Theme Makker</a> Modifed by Marlina dan Nanda
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/libscripts.bundle.js';?>"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
		<script>
			
			$('#DataNya').on('submit', function (e) {
				e.preventDefault();
				var base_url = "<?php echo base_url();?>";
				var DataNya  = $(this);
				$.ajax({
					type: "POST",
					url: base_url + 'login/ProsesMasuk',
					data: DataNya.serialize(),
					dataType: "JSON",

					success: function (respone) {
						if (respone.status == 'success') {
							swal({
								type: 'success',
								title: respone.status,
								text: respone.message,
								timer: 1200,
							},
							function () {
								window.location.href = base_url + 'home';
							});
						}else{
							swal({
								type: 'error',
								title: respone.status,
								text: respone.message,
								timer: 1200,
							})
						}
					}
				});
			});


		</script>


	</body>
	</html>