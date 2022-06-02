   <section id="search_container">
   	<div id="search">
   		<div class="tab-content">
   			<div class="container margin_60">
   				<div class="main_title">
   					<h2>Daftar <span>Promo</span> Layanan Travel </h2>
   				</div>
   				<hr>
   				<div class="row">

   					<table class="table table-striped cart-list add_bottom_30">
   						<thead>
   							<tr>
   								<th>No</th>
   								<th>
   									Kode Promo Paket Layanan
   								</th>
   								<th>
   									Harga Normal
   								</th>
   								<th>
   									Harga Promo
   								</th>
   								<th>
   									Tanggal Berakhir
   								</th>
   							</tr>
   						</thead>
   						<tbody>
   							<?php 
   							$no = 1;
   							foreach ($variable->result_array() as $key ) {?>
   								<tr>
   									<td><?=$no++;?></td>
   									<td><?=$key['nama_layanan'].'-'.$key['kode_paket_data'].'-'.$key['id_paket'];?></td>
   									<td>Rp. <?=number_format($key['harga_normal_data']);?></td>
   									<td>Rp. <?=number_format($key['harga']);?></td>
   									<td><?=$key['tanggal_Berakhir'];?></td>
   								</tr>
   							<?php }?>
   						</tbody>
   					</table>
   				</div>
   			</div>
   		</div>

   	</div>
   </div>
  </section>




