
<section class="section-grey section-bottom-border ">
	<div class="container">
		<div class="col-md-12 text-center padding-top-10">
			<h2 class="section-title">Informasi Layanan </h2>
			<p>Anda Memilih layanan <?=$nama_layanan;?> </p>
		</div>
		<hr>

		<div class="row no-gutters">
			<div class="col-md-6">
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
			    </div>
		</div>



		<div class="col-md-6 ">
			<div class="small-col-inside">
				<h3>Informasi Promo <?=$nama_layanan. '-'.$kode_paket_data;?></h3>
				<div class="accordion" id="accordionFAQ">
					<div class="card">

						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Note
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFAQ">
							<div class="card-body">
								Promo layanan ini diberikan akan memberikan informasi terhadap suatu layanan yang terdapat pada perusahaan 
							</div>
						</div>

					</div>
					<!--end card -->

					<!--begin card -->
					<div class="card">

						<div class="card-header" id="headingThree">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Pembayaran
								</button>
							</h5>
						</div>

						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionFAQ">
							<div class="card-body">
								Pembayaran Dapat dilakukan dengan melakukan pembayaran awal atau DP dengan ketentuan harga 20% harga
							</div>
						</div>

					</div>

					<div class="card">
						<div class="card-header" id="headingTwo">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Batas Promo
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionFAQ">
							<div class="card-body">
								Dimulai dari tanggal <?=date('d-m-Y',strtotime($tanggalAwal)). ' Sampai Dengan ' .date('d-m-Y',strtotime($tanggalAkhir)). ' Dan Akan berangkat pada tanggal '.date('d-m-Y',strtotime($TanggalBerangkat)). ' dengan perjalanan selama '.$lama_perjalanan. ' Hari';?>
							</div>
						</div>

					</div>

					<div class="card">

						<div class="card-header" id="headingFour">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									Harga
								</button>
							</h5>
						</div>

						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionFAQ">
							<div class="card-body">
								Harga dari Rp. <?=number_format($HrgaNya). ' Namun akan mendapatkan diskon menjadi Rp. '.number_format($harga);?>
							</div>
						</div>

					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h5 class="mb-0">
								<?php if($tanggalAkhir < date('Y-m-d')){?>
									<button class="btn btn-danger"> Maaf Promo Habis</button>
									
								<?php }else{?>
									<a href="<?=base_url().'welcome/PelangganUmroh?idData='.base64_encode($paketID).'';?>">
										<button class="btn btn-primary" type="submit" >
											PESAN SEKARANG
										</button>
									</a>
								<?php }?>
								<a href="<?=base_url().'PromoData/dataViews?idPromo='.$idLa.'';?>">
									<button class="btn btn-warning" type="submit" >
										KEMBALI
									</button>
								</a>
							</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<hr>
			<div class="col-md-12 text-center padding-top-10">
				<h2 class="section-title">Informasi Transportasi </h2>
			</div>
			<div class="row">
				<?php 
				foreach ($namaHotel->result_array() as $key) {
					if($namaHotel->num_rows() > 1){?>
						<div class="col-md-4 d-flex">
							<div class="process">
								<i class="pe-7s-home"></i>
								<h3><?=$key['nama_hotel'];?></h3>
								<p> Hotel ini berada di daerah negara <?=$key['negara'].' yang terletak pada provinsi '.$key['provinsi']. ' kota '.$key['kota']. ' dengan Alamat '. $key['alamat'];?></p>
							</div>
						</div>
						<div class="col-md-4 d-flex">
							<div class="process">
								<i class="pe-7s-home"></i>
								<h3><?=$key['nama_hotel'];?></h3>
								<p> Hotel ini berada di daerah negara <?=$key['negara'].' yang terletak pada provinsi '.$key['provinsi']. ' kota '.$key['kota']. ' dengan Alamat '. $key['alamat'];?></p>
							</div>
						</div>
					<?php }else{?>
						<div class="col-md-4 d-flex">
							<div class="process">
								<i class="pe-7s-home"></i>
								<h3><?=$key['nama_hotel'];?></h3>
								<p> Hotel ini berada di daerah negara <?=$key['negara'].' yang terletak pada provinsi '.$key['provinsi']. ' kota '.$key['kota']. ' dengan Alamat '. $key['alamat'];?></p>
							</div>
						</div>

					<?php }
				}?>

				<div class="col-md-4 d-flex">
					<div class="process">
						<i class="fas fa-plane"></i>
						<h3><?=$nama_maskapai;?></h3>
						<p> Nama Maskapai yang digunakan bernama  <?=$nama_maskapai.' dengan kode penerbangan '.$kode_penerbangan;?></p>
					</div>
				</div>
				<div class="col-md-4 d-flex">
					<div class="process">
						<i class="fas fa-car"></i>
						<h3><?=$nama_maskapai;?></h3>
						<p>   Kendaraan bernama  <?=$nama_bus.' dengan kode bus '.$kode_bus;?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<hr>
			<div class="col-md-12 text-center padding-top-10">
				<h2 class="section-title">Cara Pembayaran </h2>
			</div>
			<div class="row">
				<?php 
				foreach ($metodePembayaran->result_array() as $key) {?>

					<div class="col-md-4 d-flex">
						<div class="process">
							<?php if($key['bank_name'] == 'bca'){?>
								<img class="d-block w-100" src="<?=base_url().'image/logo/Bank-BCA-Vector-Logo-720x340.png';?>">
							<?php }elseif($key['bank_name'] == 'bri'){?>
								<img class="d-block w-100"  src="<?=base_url().'image/logo/bri-logo.png';?>">
							<?php }else{?>
								<img class="d-block w-100"  src="<?=base_url().'image/logo/yeka-pey.png';?>">

							<?php }?>
							<h3><?=$key['bank_name'];?></h3>
							<p><?=$key['keterangan'];?></p>

						</div>
					</div>

					<?php 
				}?>
			</div>
		</div>
		<div class="container-fluid">
			<hr>
			<div class="col-md-12 text-center padding-top-10">
				<h2 class="section-title">Informasi Perlengkapan Yang didapat </h2>
			</div>
			<div class="row">
				<?php 
				foreach ($PerlengkapanPaket->result_array() as $key) {?>

					<div class="col-md-4 d-flex">
						<div class="process">
							<i class="fa fa-cloud  "></i>
							<h3><?=$key['nama_barang'];?></h3>
							<p>Jumlah yang didapatkan sebanyak <?=$key['JumlahBarangPelanggan'];?> Buah</p>
						</div>
					</div>

					<?php 
				}?>
			</div>
		</div>
		<hr>
		<div class="container-fluid">
			<hr>
			<div class="col-md-12 text-center padding-top-10">
				<h2 class="section-title">Informasi Lainnya </h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<textarea name="editor1"><?=$catatan;?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="cointainer-fluid">
		<hr>
		<div class="row">
			<!-- <div class="col-md-12">
				<h3>Ayo segera daftarkan diri anda karena stok terbatas dan lagi ada promo potongan harganya..!. <a href="<?=base_url().'welcome/PelangganUmroh?idData='.base64_encode($paketID).'';?>">Klik link diini untuk mendaftar</a>
				</h3>
			</div> -->
		</div>
	</div>
</div>
</section>