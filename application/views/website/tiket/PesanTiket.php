<section id="hero_2">
	<div class="intro_title">
		<h1>Halaman Order </h1>
	</div>
</section>
<main>
	
	<div class="container margin_60">
		<div class="main_title">
			<?php 
			$Masakapai = $this->db->get_where('db_penerbangan',array('id'=>$pesawat))->row_array();?>
			<h3>Anda Memilih masakapi <span><?=$Masakapai['nama_maskapai'];?></span></h3>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-8">
				<div class="box_style_1">
					<table class="table table-striped cart-list add_bottom_30">
						<thead>
							<tr>
								<th>Level</th>
								<th>	Harga Satuan</th>
								<th>	Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$MasakapaiLevelTiket = $this->db->get_where('tb_keterangan_harga_tiket',array('id_tiket_data'=>$paketID));
							foreach ($MasakapaiLevelTiket->result() as $key => $value) {
								$F = $value->level;
								?>
								<tr>
									<td><?=$value->level == 1 ? 'Anak-anak' : 'Dewasa';?></td>
									<td>Rp. <?=number_format($value->harga);?></td>
									<td>
										<?=$value->jumlah != 0 ? '<a href='.base_url().'welcome/PesanTiketNyaSekarang?idData='.base64_encode($idData).'&idJasa='.base64_encode($value->id).' id="fa fa-back" class="btn btn-info">PESAN</a>' : '<span class="text-danger">Habis</span>';?></td>
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>

				<aside class="col-lg-4">
					<div class="box_style_1">
						<h3 class="inner">- Informasi  -</h3>
						<div class="col-lg-12 add_bottom_15">
							<h3 class="text-danger"> * NOTE </h3>
							<hr>
							<p>Halaman ini merupakan halaman pemilihan level tiket dan harga tiket yang akan dipesan</p>
						</div>
					</aside>
					<!-- </main> -->

				</div>
			</main>
