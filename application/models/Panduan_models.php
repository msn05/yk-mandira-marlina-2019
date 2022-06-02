<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panduan_models extends CI_Model
{
	function Data()
	{
		$this->db->from('tb_panduan');
		$this->db->order_by('tanggal','ASC');
		$query = $this->db->get();
		return $query;	
	}

	function DatassHaji($dataB)
	{
		$this->db->from('tb_panduan');
		$this->db->where('note_idText' ,$dataB);
		$this->db->where('id_kategori != ' ,'T');
		$this->db->where('id_kategori != ' ,'U');
		$this->db->where('id_kategori != ' ,'TU');
		$this->db->order_by('tanggal','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query;	
	}
	function DatassUmroh($dataB)
	{
		$this->db->from('tb_panduan');
		$this->db->where('note_idText' ,$dataB);
		$this->db->where('id_kategori != ' ,'TH');
		$this->db->where('id_kategori != ' ,'T');
		$this->db->where('id_kategori != ' ,'U');
		$this->db->order_by('tanggal','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query;	
	}

	function CekDataDuplicate($DataCek)
	{
		$this->db->where($DataCek);
		$this->db->from('tb_panduan');
		$query = $this->db->get();
		return $query;	
	}
	function Insert($DataNya)
	{
		$this->db->insert('tb_panduan',$DataNya);
		return true;	
	}

	function DeleteDataPanduanNya($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tb_panduan');
		return true;	
	}
	function Update($DataNya,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('tb_panduan',$DataNya);
		return true;	
	}
}
