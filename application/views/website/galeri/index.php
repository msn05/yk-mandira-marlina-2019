<section id="hero_2">
	<div class="intro_title">
		<h1>Halaman Galeri </h1>
	</div>
</section>
<main>
	<div class="container margin_60">
		<div class="main_title">
			<h2>Daftar <span>images</span> from travellers</h2>
		</div>
		<hr>
		<div class="box_style_1">
			<div class="row magnific-gallery add_bottom_60 ">
				<?php
				foreach ($galeri->result_array() as $key) {?>
					<div class="col-md-4">
						<div class="img_wrapper_gallery">
							<div class="img_container_gallery">
								<a href="<?=base_url().'image/galeri/'.$key['foto'];?>" title="Photo title" ><img  width="100%" src="<?=base_url().'image/galeri/'.$key['foto'];?>" alt="Image">
									<i class="icon-resize-full-2"></i>
								</a>
							</div>
						</div>
					</div>
				<?php }?>

			</div>
			<?php echo $pagination; ?>
		</div>
	</div>
</div>
</main>

