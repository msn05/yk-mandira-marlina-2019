<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel_models extends CI_Model
{
	function Data()
	{
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}
	function DataHotel($idHotel)
	{
		$this->db->where('id',$idHotel);
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}
	function DataHotelPaketNya($idHotel)
	{
		$this->db->where_in('id',$idHotel);
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}

	function CekDataNya($DataNyaLah)
	{
		$this->db->where($DataNyaLah);
		$this->db->from('tb_hotel_paket');
		$query = $this->db->get();
		return $query;	
	}

	function DataPaket()
	{
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}

	function DataHotelPaket($PaketKode)
	{
		$this->db->select('a.id as IdPaketHotel,a.id_paket_hotel,a.rules_hotel,a.id_hotel,b.id,b.kode_hotel,b.nama_hotel,b.negara,b.provinsi,b.kota,b.alamat');
		$this->db->from('tb_hotel_paket as a');
		$this->db->join('db_hotel as b','a.id_hotel=b.id');
		$this->db->where('id_paket_hotel',$PaketKode);
		$query = $this->db->get();
		return $query;	
	}

	function CekData($KodeJadi)
	{
		$this->db->where('kode_hotel',$KodeJadi);
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}


	function CekEmailData($email)
	{
		$this->db->where('email',$email);
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}

	function Insert($DataNyaLagi)
	{
		$this->db->insert('db_hotel',$DataNyaLagi);
		return true;	
	}

	function InsertPaketHotel($Data)
	{
		$this->db->insert('tb_hotel_paket',$Data);
		return true;	
	}
	function DeleteData($DataHapus)
	{
		$this->db->where($DataHapus);
		$this->db->delete('db_hotel');
		return true;	
	}
	function DeletePaketHotel($Hapus)
	{
		$this->db->where($Hapus);
		$this->db->delete('tb_hotel_paket');
		return true;	
	}

	function Update($KodeJadi,$DataNyaLagi)
	{
		$this->db->where('kode_hotel',$KodeJadi);
		$this->db->update('db_hotel',$DataNyaLagi);
		return true;	
	}


}