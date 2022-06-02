<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_models extends CI_Model
{
	function Data()
	{
		$this->db->select('id_menu,kategori_menu,nama_menu,id_akses,tanggal_dibuat,id_kategori_menu,nama_kategori,id_level,nama_level,Status,url');
		$this->db->from('db_menu');
		$this->db->join('db_kategori_menu','db_kategori_menu.id_kategori_menu=db_menu.kategori_menu');
		$this->db->join('db_level','db_level.id_level=db_menu.id_akses');
		$query = $this->db->get();

		return $query;	
	}

	function Update($id,$UpdateStatus){
		$this->db->where('id_menu',$id);
		$this->db->update('db_menu',$UpdateStatus);
		// return true;
	}
	function DataUbah($id){
		$this->db->where('id_menu',$id);
		$this->db->from('db_menu');
		$query = $this->db->get();
		return $query;
	}


	function Akses(){
		$this->db->select('id_level,nama_level');
		$this->db->from('db_level');
		$query = $this->db->get();
		return $query;
	}

	function NamaAkses($Level){
		$this->db->where('id_level',$Level);
		$this->db->from('db_level');
		$query = $this->db->get();
		return $query;
	}

	function KategoriMenu(){
		$this->db->select('id_kategori_menu,nama_kategori');
		$this->db->from('db_kategori_menu');
		$query = $this->db->get();
		return $query;
	}

}