<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bus_models extends CI_Model
{
	function Data()
	{
		$this->db->select('a.id,a.keterangan,a.nama_bus,a.kapasitas,a.id_dokumen_kemitraan,b.id_dokumen,b.nama_perusahaan,b.nilai_kerjasama,b.tanggal_berlaku,b.tanggal_berakhir,b.nama_pemberi_kerjasama,b.file_kemitraan');
		$this->db->from('db_transportasi_darat as a');
		$this->db->join('tb_dokumen_kemitraan as b','b.id_dokumen = a.id_dokumen_kemitraan');
		$query = $this->db->get();
		return $query;	
	}


	function CekDataDuplicate($DataCek)
	{
		$this->db->where($DataCek);
		$this->db->from('db_transportasi_darat');
		$query = $this->db->get();
		return $query;	
	}


	function Update($DataNya,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('db_transportasi_darat',$DataNya);
		return true;	
	}

	function UpdateDokumenKemitraan($UpdateStatus,$idDokumen)
	{
		$this->db->where('id_dokumen',$idDokumen);
		$this->db->update('tb_dokumen_kemitraan',$UpdateStatus);
		return true;	
	}


	function ShowData($id)
	{
		$this->db->select('a.id,a.keterangan,a.nama_bus,a.kapasitas,a.id_dokumen_kemitraan,b.id_dokumen,b.nama_perusahaan,b.nilai_kerjasama,b.tanggal_berlaku,b.tanggal_berakhir,b.nama_pemberi_kerjasama,b.file_kemitraan');
		$this->db->from('db_transportasi_darat as a');
		$this->db->join('tb_dokumen_kemitraan as b','b.id_dokumen = a.id_dokumen_kemitraan');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query;	
	}

	function Insert($DataNya)
	{
		$this->db->insert('db_transportasi_darat',$DataNya);
		return true;	
	}


	function InsertDokumenKemitraan($UpdateStatus)
	{
		$this->db->insert('tb_dokumen_kemitraan',$UpdateStatus);
		return true;	
	}


	function DeleteData($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('db_transportasi_darat');
		return true;	
	}

	function DeleteDokumenBus($IdFileNya)
	{
		$this->db->where('id_dokumen',$IdFileNya);
		$this->db->delete('tb_dokumen_kemitraan');
		return true;	
	}
}
