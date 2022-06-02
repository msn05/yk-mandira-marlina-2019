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
	<?php 
	$X = $KursiData->row_array();
	$PenerbanganData = $this->db->get_where('db_penerbangan',array('id'=>$X['id_penerbangan']))->row_array();
	?>
	<h3>Laporan Informasi Tiket Maskpai <?=$PenerbanganData['nama_maskapai'];?> dengan Kode Pesawat <?=$X['kode_pesawat'];?></h3>
	<span>Rute : <?= $X['form']. ' --' .$X['to'];?></span>
	<table width="100%" border="1" >
		<tr style="background-color: green">
			<th>No</th>
			<th>Ketentuan</th>
			<th>Jumlah</th>
			<th>Harga / Kursi</th>
		</tr>
		<?php 
		$no = 1;
		foreach ($KursiData->result_array() as $key ) {?>
		<tr>
			<td><?=$no++;?></td>
			<td><?=$key['level'] == 1 ? 'Anak-anak' : 'Dewasa' ;?></td>
			<td><?=$key['jumlah'];?> Kursi</td>
			<td>Rp. <?=number_format($key['harga']);?></td>
		</tr>
		<?php 
	}
	?>
	<tr>
		<th>Total Data </th>
		<th><?=$TotalLevel['TotalLevel'];?> Aksi Ketentuan</th>
		<th><?=$TotalLevel['TotalData'];?> Kursi</th>
		<th colspan="2">Rp. <?=number_format($TotalLevel['HargaNya']);?> </th>
	</tr>
</table>
</body>
</html>
