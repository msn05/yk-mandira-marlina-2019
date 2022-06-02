<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PembayaranTiket_models extends CI_Model
{
	function data()
	{
		$this->db->from('tb_tagihan_tiketing');
		$query = $this->db->get();
		return $query;	
	}


}