<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class JadwalBerangkat_models extends CI_Model
{
	function Data($Kode)
	{
		$this->db->from('db_paket b');
		$this->db->join('db_layanan c', 'c.id_layanan = b.id_layanan');
		$this->db->where('c.kode_layanan',$Kode);
		$query = $this->db->get();
		return $query;	
	}
	function DataHistori($Kode)
	{
		$this->db->from('db_paket b');
		$this->db->join('db_layanan c', 'c.id_layanan = b.id_layanan');
		$this->db->where('c.kode_layanan !=',$Kode);
		$query = $this->db->get();
		return $query;	
	}

	function DataHistoriPariwisata($Kode)
	{
		$this->db->from('db_paket b');
		$this->db->join('db_layanan c', 'c.id_layanan = b.id_layanan');
		$this->db->where('c.kode_layanan',$Kode);
		$query = $this->db->get();
		return $query;	
	}

	function CekData($CekPelanggan)
	{
		$this->db->where($CekPelanggan);
		$this->db->from('tb_keberangakatan');
		$query = $this->db->get();
		return $query;	
	}

	function ShowData($CekPelanggan)
	{
		$this->db->from('tb_keberangakatan a');
		$this->db->join('tb_pelanggan b','b.id=a.id_pelanggan');
		$this->db->where('a.paket_id',$CekPelanggan);
		$query = $this->db->get();
		return $query;	
	}

	function Insert($DataBerangkat)
	{
		$this->db->insert('tb_keberangakatan',$DataBerangkat);
		return true;	
	}

	function Tagihan($DataTagihan)
	{
		$this->db->insert('tb_tagihan_pembayaran',$DataTagihan);
		return true;	
	}

	function DetailTagihan($DetailTagihan)
	{
		$this->db->insert('tb_detail_tagihan',$DetailTagihan);
		return true;	
	}


	function UpdateTour($DataBerangkat,$kodePaket)
	{
		$this->db->where('paket_id',$kodePaket);
		$this->db->update('db_jadwal_keberangkatan',$DataBerangkat);
		return true;	
	}


	function PemesananLayanan($StatusPemesanan,$name_id)
	{
		$this->db->where('id_pemesanan',$name_id);
		$this->db->update('tb_pemasanan_paket',$StatusPemesanan);
		return true;	
	}


	function Select($kodePaket)
	{
		$this->db->where('paket_id',$kodePaket);
		$this->db->from('db_jadwal_keberangkatan');
		$query = $this->db->get();
		return $query;	
	}


}