<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perlengkapan_models extends CI_Model
{
	function Data()
	{
		$this->db->from('db_kelengkapan_data');
		$query = $this->db->get();
		return $query;	
	}

	function DataPaket()
	{
		$this->db->from('db_kelengkapan_data');
		$this->db->where('status !=',1);
		$query = $this->db->get();
		return $query;	
	}

	function DataUbah($idLayanan)
	{
		$this->db->from('db_kelengkapan_data');
		$this->db->where('id',$idLayanan);
		$query = $this->db->get();
		return $query;
	}

	function Valid($KodeBarang)
	{
		$this->db->from('db_kelengkapan_data');
		$this->db->where('id_kelengkapandata',$KodeBarang);
		$query = $this->db->get();
		return $query;
	}


	function Update($idLayanan,$DataNya)
	{
		$this->db->where('id',$idLayanan);
		$this->db->update('db_kelengkapan_data',$DataNya);
		return true;
	}

	function Delete($Primary)
	{
		$this->db->where('id',$Primary);
		$result = $this->db->delete('db_kelengkapan_data');
		return $result;
	}
	

	function Insert($DataNya)
	{
		$this->db->insert_batch('db_kelengkapan_data',$DataNya);
		return true;
	}

	function DeleteData($Delete,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('db_kelengkapan_data',$Delete);
		return true;
	}


	function CekDataDuplicate($X)
	{
		$this->db->where_in('nama_barang', $X);
		$this->db->from('db_kelengkapan_data');
		$query = $this->db->get()->result_array();
		return $query;
	}


	function DataKelengkapan($id_kelengkapandata)
	{
		$this->db->select('nama_barang,id_kelengkapandata,jumlah,status_barang,id');
		$this->db->from('db_kelengkapan_data');
		$this->db->where('id_kelengkapandata',$id_kelengkapandata);
		$query = $this->db->get();
		return $query;
	}

	function DataPerlengkapanPaket($PaketKode)
	{
		$this->db->select('a.id_perlengkapan_paket,a.id_kelengkapan,a.jumlah as JumlahBarangPelanggan,b.id_kelengkapandata,b.nama_barang');
		$this->db->from('tb_perlengkapan_paket as a');
		$this->db->join('db_kelengkapan_data as b','b.id_kelengkapandata=a.id_kelengkapan');
		$this->db->where('id_perlengkapan_paket',$PaketKode);
		$query = $this->db->get();
		return $query;
	}

}