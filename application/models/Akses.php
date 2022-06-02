<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akses extends CI_Model
{
	function MasterMenu()
	{
		$this->db->select('id_menu,kategori_menu,nama_menu,id_akses,tanggal_dibuat,id_kategori_menu,nama_kategori,id_level,nama_level');
		$this->db->from('db_menu');
		$this->db->join('db_kategori_menu','db_kategori_menu.id_kategori_menu=db_menu.kategori_menu');
		$this->db->join('db_level','db_level.id_level=db_menu.id_akses');
		$query = $this->db->get();
		return $query;	
	}


}