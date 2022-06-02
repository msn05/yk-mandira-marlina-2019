
<section class="portfolio-wrapper section-top-border" id="showcase">

	<div class="image-green-overlay"></div>

	<!--begin container -->
	<div class="container-fluid">

		<!--begin row -->
		<div class="row">

			<!--begin col-md-12 -->
			<div class="col-md-12 text-center padding-bottom-20">
				<h2 class="section-title white-text">Daftar Promo Layanan </h2>
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
						<div class="carousel-inner">

							<div class="carousel-item active">
								<div class="row">
									<?php foreach ($variable2->result_array() as $key ) {
										$query = $this->db->select('image_file,id_promo')
										->where('id_promo', $key['id_promo'])
										->limit(1)
										->get('tb_promo_image')->row_array();

										?>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<figure class="gallery-item">
												<a href="<?=base_url().'PromoData?idData='.base64_encode($key['id_promo']).'';?>"> 
													<img src="<?=base_url().'image/promo/'.$query['image_file'];?>" class="width-100" alt="pic">
												</a>	
												<div class="portfolio-box">
													<p>Harga Awal dari <span style="text-decoration: line-through;"><b> Rp. <?=number_format($key['harga_normal_data']);?></b> </span> Menjadi  <b> Rp. <?=number_format($key['harga']);?> </b></a></p>
												</div>
											</figure>
										</div>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

