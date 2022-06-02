<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<table width="100%">
		<tr>
			<th>
				<img style="float:left, padding=100px" width="100px" src="./image/logo/laporan.png">
			</th>
			<th style="float:left">
				<h2>Yeka Madira Palembang</h2>
				<span><?=$Perusahaan->alamat;?></span>
				<span><?=$Perusahaan->email;?></span>
			</th>
		</tr>
	</table>
	<hr>
	<h3 style="text-align:text-center">Pemesanan Tiket Pelanggan</h3>
	<table width="100%" border="1">
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Jumlah Pesanan</th>
			<th>Tanggal Pesan</th>
			<th>Status Pesanan</th>
		</tr>
		<?php
		$no =1;
		foreach ($Pesanan->result_array() as $key ) {
			$Pelanggan= $this->db->get_where('tb_pelanggan',array('id'=>$key['id_pelanggan']))->row_array();
			$Total = $this->db->select('sum(jumlah) as TotalData, count(id_keterangan_tiket) as TotalLevel, sum(harga) as HargaNya',FALSE)->get_where('tb_detail_pesan_tiket_pelanggan',array('id_tiket_pemesanan'=>$key['id_tiket_data_pesan']))->row_array();
			?>
			<tr>
				<td><?=$no++;?></td>
				<td><?=$Pelanggan['nama_lengkap'];?></td>
				<td><?=$Total['TotalData'];?> Pesanan</td>
				<td><?=$key['tanggal_pesan'];?> </td>
				<td><?=$key['status'] == 1 ? 'pending' :($key['status'] == 2 ? 'Proses' : ($key['status'] == 3 ? 'Selesai' : 'Batal'));?></td>
			</tr>

		<?php }?>
	</table>

</body>
</html>
