<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengguna_models extends CI_Model
{

	function Data()
	{
		$this->db->select('a.status_users,a.id_akses,a.id_level,a.login,a.logout,a.password,b.nama_level,b.id_level,c.id_akses as Nomor,c.nomor_wa,c.nomor_telephone,c.nama_lengkap');
		$this->db->from('db_akses a');
		$this->db->join('db_level b','b.id_level = a.id_level');
		$this->db->join('db_data_akses c','c.id_akses = a.id_akses','left');
		$this->db->where('a.id_level != ','2');
		$query = $this->db->get();
		return $query;	
	}

	function TotalPelangganNya()
	{
		$this->db->select('count(id) as TotalPelangganData');
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;	
	}


	function LaporanPelanggan($tanggal1,$tanggal2)
	{
		// $this->db->select('count(id) as TotalPelangganData');
		$this->db->from('tb_pelanggan');
		$this->db->where('tgl_daftar >=', $tanggal1);
		$this->db->where('tgl_daftar <=', $tanggal2);
		$query = $this->db->get();
		return $query;	
	}
	function TotalBus()
	{
		$this->db->select('count(id) as TotalBusData');
		$this->db->from('db_transportasi_darat');
		$query = $this->db->get();
		return $query;	
	}

	function TotalPener()
	{
		$this->db->select('count(id) as TotalPenerData');
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function TotalTiket()
	{
		$this->db->select('count(id_pesan_tiket_data) as TotalPesan');
		$this->db->from('tb_pesan_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function TotalTiketUmroh()
	{
		$this->db->select('count(id_pemesanan) as TotalPesanNya');
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket=a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan=b.id_layanan');
		$this->db->where('c.kode_layanan','TU');
		$query = $this->db->get();
		return $query;	
	}
	function TotalTiketPariws()
	{
		$this->db->select('count(id_pemesanan) as TotalPesanNya');
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket=a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan=b.id_layanan');
		$this->db->where('c.kode_layanan','U');
		$query = $this->db->get();
		return $query;	
	}

	function Grafik()
	{
		// $query = $this->db->query("SELECT merk,SUM(stok) AS stok FROM barang GROUP BY merk");
		
		// if($query->num_rows() > 0){
		// 	foreach($query->result() as $data){
		// 		$hasil[] = $data;
		// 	}
		// 	return $hasil;
		// }
	}

	function TotalTiketHaji()
	{
		$this->db->select('count(id_pemesanan) as TotalPesanNya');
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket=a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan=b.id_layanan');
		$this->db->where('c.kode_layanan','TH');
		$query = $this->db->get();
		return $query;	
	}

	function DataShow($Kode)
	{
		$this->db->where('id',$Kode);
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;	
	}

	function UpdateStatus($id,$UpdateStatusNya)
	{
		$this->db->where('id_akses',$id);
		$this->db->update('db_akses',$UpdateStatusNya);
		return true;
	}
	function UpdateDataLagis($PostData2,$idPost)
	{
		$this->db->where('id',$idPost);
		$this->db->update('tb_pelanggan',$PostData2);
		return true;
	}

	function UpdateStatusLanjutan($CK,$UpdateStatusNya)
	{
		$this->db->where('id_data_akses',$CK);
		$this->db->update('db_data_akses',$UpdateStatusNya);
		return true;
	}

	function UploadFoto($id,$UpdateStatus)
	{
		$this->db->where('id_file_identitas',$id);
		$this->db->update('db_file',$UpdateStatus);
		return true;
	}

	function Email($email)
	{
		$this->db->where('email',$email);
		$this->db->from('db_data_akses');
		$query = $this->db->get();
		return $query;
	}
	function Emails($email)
	{
		$this->db->where('emails',$email);
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;
	}


	function DataShow1($Kode)
	{
		$this->db->where('id_akses_data',$Kode);
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;
	}

	function DataPelanggan()
	{
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;
	}
	function idPelanggan($id)
	{
		
		$this->db->select('a.id_file_dokumen,a.nama_lengkap,a.id_akses_data,a.alamat,a.no_ktp,b.id_file_identitas,b.foto,b.ktp,b.kk,b.pasport,b.buku_nikah');
		$this->db->from('tb_pelanggan a');
		$this->db->join('db_file b','b.id_file_identitas = a.id_file_dokumen');
		$this->db->where('a.id_file_dokumen',$id);
		$query = $this->db->get();
		return $query;
	}

	function NomorTelphone($no_telp)
	{
		$this->db->where('nomor_telephone',$no_telp);
		$this->db->from('db_data_akses');
		$query = $this->db->get();
		return $query;
	}
	function NoKtp($idFile)
	{
		$this->db->where('no_ktp',$idFile);
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;
	}

	function NomorTelphones($no_telp)
	{
		$this->db->where('nomor_telphone',$no_telp);
		$this->db->from('tb_pelanggan');
		$query = $this->db->get();
		return $query;
	}

	function NomorDarurat($nodar)
	{
		$this->db->where('nomor_darurat',$nodar);
		$this->db->from('db_data_akses');
		$query = $this->db->get();
		return $query;
	}

	function IdData($id)
	{
		$this->db->select('a.id_file_identitas,a.nama_lengkap,b.id_file_identitas,b.foto,b.ktp,b.kk,b.pasport,b.buku_nikah');
		$this->db->from('db_data_akses a');
		$this->db->join('db_file b','b.id_file_identitas = a.id_file_identitas');
		$this->db->where('a.id_file_identitas',$id);
		$query = $this->db->get();
		return $query;
	}

	function CekKodeNya($Carikode)
	{
		$this->db->select('id_akses');
		$this->db->from('db_akses');
		$this->db->where('id_akses',$Carikode);
		$query = $this->db->get();
		return $query;
	}

	function Level()
	{
		$this->db->where('id_level !=',2);
		$this->db->from('db_level');
		$query = $this->db->get();
		return $query;
	}

	function DeleteAKun($id)
	{
		$this->db->where('id_akses',$id);
		$this->db->delete('db_akses');
		return true;
	}

	function Login($Uname)
	{
		$this->db->where('id_akses',$Uname);
		$this->db->from('db_akses');
		$query = $this->db->get();
		return $query;
	}

	function DataUbah($id)
	{
		$this->db->where('id_akses',$id);
		$this->db->from('db_akses');
		$query = $this->db->get();
		return $query;
	}

	function DataLengkap($id)
	{
		$this->db->where('id_akses',$id);
		$this->db->from('db_data_akses');
		$query = $this->db->get();
		return $query;
	}

	function Dokumen($IdFileData)
	{
		$this->db->where('id_file_identitas',$IdFileData);
		$this->db->from('db_file');
		$query = $this->db->get();
		return $query;
	}

	function InsertData($UpdateStatus)
	{
		$this->db->insert('db_akses',$UpdateStatus);
		return true;
	}
	function UploadFotoDepan($UpdateStatus)
	{
		$this->db->insert('db_file',$UpdateStatus);
		return true;
	}
	function InsertDataLagi($PostData2)
	{
		$this->db->insert('db_data_akses',$PostData2);
		return true;
	}

	function InsertDataLagis($PostData2)
	{
		$this->db->insert('tb_pelanggan',$PostData2);
		return true;
	}

	function InsertDataLagiNah($dataFile)
	{
		$this->db->insert('db_file',$dataFile);
		return true;
	}
	function InsertDataLagiNahs($dataFile)
	{
		$this->db->insert('db_file',$dataFile);
		return true;
	}
}
