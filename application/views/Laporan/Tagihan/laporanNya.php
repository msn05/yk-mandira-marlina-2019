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
  <h3 style="text-align:text-center">Daftar Tagihan Pelanggan dari tanggal <?=date('d-m-Y',strtotime($tanggal1)).' Sampai dengan tanggal '.date('d-m-Y',strtotime($tanggal2));?> </h3>
  <table width="100%" border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Tagihan</th>
        <th>Nama Pelanggan</th>
        <th>Harga Bayar</th>
        <th>Jumlah Bayar</th>
        <th>Status</th>
      </thead>
      <?php
      $no = 1;
      foreach ($paket->result_array() as $key ) {
        $JumlahBayar = $this->db->select('sum(jumlah) AS Total')->get_where('tb_detail_tagihan',array('id_detail_tagihan'=>$key['nomor_tagihan']))->row_array();
        $PelanggnaPembeli = $this->db->join('tb_pelanggan','tb_pelanggan.id=tb_pemasanan_paket.id_pelanggan')->get_where('tb_pemasanan_paket',array('id_pemesanan'=>$key['kode_pemesanan']))->row_array();

        echo "
        <tr>
        <td>".$no++."</td>
        <td>
        ".($key['nomor_tagihan'] != '' ? ''.$key['nomor_tagihan'].'' : 'Tidak Diketahu')."</td>
        <td>".($PelanggnaPembeli['id'] != '' ? ''.$PelanggnaPembeli['nama_lengkap'].'' : 'Tidak Diketahu')."</td>
        <td>Rp. ".number_format($key['nominal'],2,',','.')."</td>
        <td>Rp. ".number_format($JumlahBayar['Total'],2,',','.')."</td>
        <td>".($JumlahBayar['Total'] == $key['nominal'] ? 'selesai' : 'Belum')."</td>
        </tr>";
      }
      ?>     
    </table>

  </body>
  </html>
