<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NomorTelp_model extends CI_Model
{
	function CekDataNomorTelp($nomor_telp)
	{
		$this->db->where('nomor_telphone',$nomor_telp);
		$this->db->from('db_hotel');
		$query = $this->db->get();
		return $query;	
	}
}
