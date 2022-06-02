<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Galeri_models extends CI_Model
{
	function Data()
	{
		$this->db->from('tb_dokumentasi');
		$this->db->order_by('tanggal','desc');
		$query = $this->db->get();
		return $query;	
	}

	function ShowData1()
	{
		$this->db->from('tb_dokumentasi');
		$this->db->where('kategori_dokumentasi != ',0);
		// $this->db->order_by('tanggal','desc');
		$this->db->limit('6');
		$query = $this->db->get();
		return $query;	
	}

	function Limit($limit, $start)
	{
		$this->db->where('kategori_dokumentasi != ',3);
		$query = $this->db->get('tb_dokumentasi',$limit, $start);
		return $query;
	}
	function Limit1($limit, $start)
	{
		$this->db->where('kategori_dokumentasi ',3);
		$query = $this->db->get('tb_dokumentasi',$limit, $start);
		return $query;
	}

	function DataShoow()
	{
		$this->db->from('tb_dokumentasi');
		$this->db->order_by('tanggal','desc');
		$this->db->where('kategori_dokumentasi !=',3);
		$query = $this->db->get();
		return $query;	
	}

	function ShowData($idData)
	{
		$this->db->where('id',$idData);
		$this->db->from('tb_dokumentasi');
		$query = $this->db->get();
		return $query;	
	}

	function UpdateFoto($InsertData,$idData)
	{
		$this->db->where('id',$idData);
		$this->db->update('tb_dokumentasi',$InsertData);
		return true;	
	}

	function DeleteFoto($name_id)
	{
		$this->db->where('id',$name_id);
		$this->db->delete('tb_dokumentasi');
		return true;	
	}

	function UploadFoto($InsertData)
	{
		$this->db->insert('tb_dokumentasi',$InsertData);
		return true;	
	}

	function SlideImage($DataNya)
	{
		$this->db->insert('tb_image_slide',$DataNya);
		return true;	
	}
}
