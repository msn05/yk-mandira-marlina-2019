<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perusahaan_models extends CI_Model
{
	function Tentang()
	{
		$this->db->from('db_perusahaan');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	function ubahdataNya($Insert,$username)
	{
		$this->db->where('id_perusahaan',$username);
		$this->db->update('db_perusahaan',$Insert);
		return true;
	}

	function idFile($username)
	{
		$this->db->where('id_perusahaan',$username);
		$this->db->from('db_perusahaan');
		$query = $this->db->get();
		return $query;
	}


}