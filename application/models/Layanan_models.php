<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Layanan_models extends CI_Model
{
	function Data()
	{
		$this->db->from('db_layanan');
		$query = $this->db->get();
		return $query;	
	}

	function DataPaket()
	{
		$this->db->from('db_layanan');
		$this->db->where('kode_layanan !=','U');
		$query = $this->db->get();
		return $query;	
	}
	function DataPaketPariws()
	{
		$this->db->from('db_layanan');
		$this->db->where('kode_layanan','U');
		$query = $this->db->get();
		return $query;	
	}

	function DataTour()
	{
		$this->db->where('kode_layanan','U');
		$this->db->from('db_layanan');
		$query = $this->db->get();
		return $query;	
	}



	function DataUbah($idLayanan)
	{
		$this->db->select('id_layanan,nama_layanan,tanggal_post,kode_layanan');
		$this->db->from('db_layanan');
		$this->db->where('id_layanan',$idLayanan);
		$query = $this->db->get();
		return $query;	
	}

	function CekKode($NamaLayanan)
	{
		$this->db->where('nama_layanan',$NamaLayanan);
		$this->db->from('db_layanan');
		$query = $this->db->get();
		return $query;	
	}


	function UpdateData($idLayanan,$DataNyaLagi)
	{
		$this->db->where('id_layanan',$idLayanan);
		$this->db->update('db_layanan',$DataNyaLagi);
		return true;	
	}


	function Delete($idLayanan)
	{
		$this->db->where('id_layanan',$idLayanan);
		$this->db->delete('db_layanan');
		return true;	
	}


	function InsertData($DataNya)
	{
		$this->db->insert('db_histori_layanan',$DataNya);
		return true;	
	}

	function DataLayanan($idLayanan)
	{
		$this->db->where('id_layanan',$idLayanan);
		$this->db->from('db_layanan');
		$query = $this->db->get();
		return $query;	
	}
	
}
