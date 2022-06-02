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
	<h3 style="text-align:text-center">Daftar Pelanggan dari tanggal <?=date('d-m-Y',strtotime($tanggal1)).' Sampai dengan tanggal '.date('d-m-Y',strtotime($tanggal2));?> </h3>
	<table width="100%" border="1">
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>NIK</th>
			<th>NO KK</th>
			<th>Nomor WA</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
		</tr>
		<?php 
		$no =1;
		foreach ($Pelanggan->result_array() as $key ) {?>
			<tr>
				<td><?=$no;?></td>
				<td><?=$key['nama_lengkap'];?></td>
				<td><?=$key['no_ktp'];?></td>
				<td><?=$key['no_kk'];?></td>
				<td><?=$key['nomor_wa'];?></td>
				<td><?=$key['alamat'];?></td>
				<td><?=$key['jenis_kelamin'] == 1 ?'Laki-laki':'Perempuan';?></td>
				<td><?=$key['tempat_lahir'];?></td>
				<td><?=$key['tanggal_lahir'];?></td>
			</tr>
		<?php }?>        
	</table>

</body>
</html>
