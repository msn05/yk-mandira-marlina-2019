<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MetodePembayaran_models extends CI_Model
{
	function Data()
	{
		// $this->db->select('a.id_metode_pembayaran as Metode_id,a.metode,b.id,b.id_metode_pembayaran ,b.tanggal_dibuat,b.keterangan');
		$this->db->from('db_metode_pembayaran ');
		// $this->db->join('tb_keterangan_metode_pembayaran as b','b.id_metode_pembayaran=a.id_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}
	function DataPembayaranPaket($id_metode_pembayaran_paket)
	{
		$this->db->select('a.id_metode_pembayaran as Metode_id,a.metode,b.id,b.id_metode_pembayaran ,b.tanggal_dibuat,b.keterangan,b.bank_name');
		$this->db->from('db_metode_pembayaran as a');
		$this->db->join('tb_keterangan_metode_pembayaran as b','b.id_metode_pembayaran=a.id_metode_pembayaran');
		$this->db->where('a.id_metode_pembayaran',$id_metode_pembayaran_paket);
		$query = $this->db->get();
		return $query;	
	}

	function Keterangan_metode($idNya)
	{
		$this->db->where('id_metode_pembayaran',$idNya);
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function CekCaraPembayaran($caraPembayaran,$id)
	{
		$this->db->where('id_metode_pembayaran',$id);
		$this->db->where('nama_pembayaran',$caraPembayaran);
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function KeteranganMetodenya($idNya)
	{
		$this->db->where('id_metode_pembayaran',$idNya);
		$this->db->from('db_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function CekMetode($metode)
	{
		$this->db->where('metode',$metode);
		$this->db->from('db_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function HitungJumlah($idLayanan)
	{
		$this->db->select('COUNT(id) as Jumlah');
		$this->db->where('id_metode_pembayaran',$idLayanan);
		$this->db->where('keterangan !=', 'NULL');
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get()->row_array();
		return $query;	
	}

	function Keterangan($idLayanan)
	{
		$this->db->where('id_metode_pembayaran',$idLayanan);
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function DeleteDataPembayaran($id)
	{
		$this->db->where('id_metode_pembayaran',$id);
		$this->db->delete('db_metode_pembayaran');
		return true;	
	}

	function DeleteKeteranganPembayaran($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tb_keterangan_metode_pembayaran');
		return true;	
	}

	function UpdateKeterangan($idData,$DataNya)
	{
		$this->db->where('id',$idData);
		$this->db->update('tb_keterangan_metode_pembayaran',$DataNya);
		return true;
	}

	function InsertMetodeUbah($DataNya,$id)
	{
		$this->db->where('id_metode_pembayaran',$id);
		$this->db->update('db_metode_pembayaran',$DataNya);
		return true;
	}
	
	function KeteranganEdit($idLayanan)
	{
		$this->db->where('id',$idLayanan);
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get();
		return $query;		
	}
	function KeteranganCek($Cek)
	{
		$this->db->where($Cek);
		$this->db->from('tb_keterangan_metode_pembayaran');
		$query = $this->db->get();
		return $query;		
	}

	function InsertKeterangan($DataNya1)
	{
		$this->db->insert('tb_keterangan_metode_pembayaran',$DataNya1);
		return true;	
	}

	function InsertMetode($DataNya)
	{
		$this->db->insert('db_metode_pembayaran',$DataNya);
		return true;	
	}


	function DataUbah($Kode)
	{
		$this->db->where($Kode);
		$this->db->from('db_metode_pembayaran');
		$query = $this->db->get();
		return $query;	
	}
}
