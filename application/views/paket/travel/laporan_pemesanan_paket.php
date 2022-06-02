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
  <table width="100%">
    <tr style="background-color: green">
      <th>No</th>
      <th>Kode Paket / Nomor Paket</th>
      <th>Tanggal Pemesanan</th>
      <th>Jumlah Pelanggan</th>
    </tr>
    <?php 
    $no = 1;
    foreach($paket->result_array() as $value){
      $Total = $this->db->select('count(id_pelanggan) as Total')->get_where('tb_keberangakatan',array('paket_id'=>$value['id_paket']))->row_array();
      $TotalData = $this->db->get_where('tb_pemasanan_paket',array('id_paket'=>$value['id_paket']))->row_array();
      ?>
      <tr>
       <td><?=$no++;?></td>
       <td><?=$value['kode_paket_data']."-".$value['nama_layanan']."-".$value['id_paket'];?></td>
       <td><?=$TotalData['tanggal_pesan'] != ''? ''.date('d-F-Y',strtotime($TotalData['tanggal_pesan'])).''  : 'Belum Pemesanan';?></td>
       <td><?=$Total['Total']. ' Pelanggan';?></td>
     </tr>
   <?php }?>
 </table>
</body>
</html>
