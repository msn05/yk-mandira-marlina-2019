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
  <h3 style="text-align:text-center">Pemesanan Tiket Atas Nama</h3>
  <table width="100%">
    <tr>
      <th>Nama</th>
      <th>: <?=$nama_pelanggan;?></th>
    </tr>
    <tr>
      <th>Jenis Kelamin</th>
      <th>: <?=$jenis_kelamin == 1 ?'Laki-laki':'Perempuan';?></th>
    </tr>
  </tr>
</table>
<hr>
<h3 style="text-align: text-center">Informasi Pemesanan</h3>

<table width="100%">
  <tr>
    <th>Kode Pesanan</th>
    <th>: <?=$kodePemesanan;?></th>
  </tr>
  <tr>
    <th>Kode Pesawat</th>
    <th>: <?=$kodePesawatNya;?></th>
  </tr>
  <tr>
    <th>Form</th>
    <th>: <?=$form;?></th>
  </tr>
  <tr>
    <th>Tujuan</th>
    <th>: <?=$to;?></th>
  </tr>

  <tr>
    <th>Berangkat</th>
    <th>: <?=$hari.'-'.$tanggal;?></th>
  </tr>
  <tr>
    <th>Pukul</th>
    <th>: <?=$waktu_berangkat;?></th>
  </tr>
  <tr>
    <th>Start Plane</th>
    <th>: <?=$bandara1;?></th>
  </tr>
  <tr>
    <th>End Plane</th>
    <th>: <?=$bandara2;?></th>
  </tr>
</table>
<hr>
<h3>Perihal Pemesanan Kursi</h3>
<table width="100%" border="1">
  <tr>
    <th>No</th>
    <th>Keterangan Tiket</th>
    <th>Jumlah Tiket</th>
    <th>Harga Tiket</th>
  </tr>
  <?php $no=1;
  foreach ($detail->result_array() as $key) {
    ?>
    <tr>
      <td><?=$no++;?></td>
      <td><?=$key['id_keterangan_tiket'] == 1 ?'Anak-anak':'Dewasa';?></td>
      <td><?=$key['jumlah'];?> Kursi</td>
      <td>Rp. <?=number_format($key['harga']);?></td>
    </tr>
  <?php }?>
  <tr>
    <th>Total</th>
    <th><?=$Total['TotalLevel'];?></th>
    <th><?=$Total['TotalData'];?></th>
    <th>Rp. <?=number_format($Total['HargaNya']);?></th>
  </tr>
</table>
<p>Bapak/ibu dapat melakukan pembayaran melalui pembayaran via Bank ataupun Langsung yang dapat dilihat pada metode pembayaran dengan nominal sebesar <b><i><?=terbilang($Total['HargaNya']);?></i></b>. Bersama dengan ini kami pihak Yeka Madira akan menunggu pembayaran pemesan tiket ini selambat-lambatnya 1X24 jam kedepan untuk mendapatkan nomor kursinya.</p>
<p>Terima Kasih</p>
</body>
</html>
