<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penerbangan_models extends CI_Model
{
	function DataTravel()
	{
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function DokumenTravel()
	{
		$this->db->from('db_penerbangan a');
		$this->db->join('tb_dokumen_kemitraan b','b.id_dokumen=a.id_dokumen_kemitraan');
		$query = $this->db->get();
		return $query;	
	}
	function ShowData($idDataNya)
	{
		$this->db->select('a.id,a.kode_penerbangan,a.nama_maskapai,a.tanggal_pesan,a.jumlah_kursi,a.id_dokumen_kemitraan,b.id_dokumen,b.nama_perusahaan,b.nilai_kerjasama,b.tanggal_berlaku,b.tanggal_berakhir,b.nama_pemberi_kerjasama,b.file_kemitraan');
		$this->db->from('db_penerbangan as a');
		$this->db->join('tb_dokumen_kemitraan as b','b.id_dokumen = a.id_dokumen_kemitraan');
		$this->db->where('id',$idDataNya);
		$query = $this->db->get();
		return $query;	
	}


	function AmbekJumlah($nomor)
	{
		$this->db->where('kode_penerbangan',$nomor);
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function NomorKursiCek($CekNomorKursiId)
	{
		$this->db->where($CekNomorKursiId);
		$this->db->from('db_penerbangan_kursi');
		$query = $this->db->get();
		return $query;	
	}


	function DataCekPenerbangan($DataCekPenerbangan)
	{
		$this->db->where($DataCekPenerbangan);
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function DataCekKodeDokumenPenerbangan($idData)
	{
		$this->db->where('id_dokumen');
		$this->db->from('tb_dokumen_kemitraan');
		$query = $this->db->get();
		return $query;	
	}

	function CekKodeKursinPenerbangan($idPenerbangan)
	{
		$this->db->where('id_penerbangan_kursi');
		$this->db->from('db_penerbangan_kursi');
		$query = $this->db->get();
		return $query;	
	}

	function NomorCekDua($CekNomorDua)
	{
		$this->db->where($CekNomorDua);
		$this->db->from('db_penerbangan_kursi');
		$query = $this->db->get();
		return $query;	
	}

	function DataKursi($Gabungkan)
	{
		$this->db->where('kode_penerbangan',$Gabungkan);
		$this->db->from('db_penerbangan_kursi');
		$this->db->order_by('nomor_kursi','ASC');
		$query = $this->db->get();
		return $query;	
	}



	function CekData($Gabungkan)
	{
		$this->db->where('kode_penerbangan',$Gabungkan);
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}


	function CekDataFor($DataNya)
	{
		$this->db->where($DataNya);
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function InsertKursi($DataNya)
	{
		$this->db->insert_batch('db_penerbangan_kursi',$DataNya);
		return true;	
	}


	function TotalData($Gabungkan)
	{
		$this->db->select('count(kode_penerbangan) as Jumlah');
		$this->db->where('kode_penerbangan',$Gabungkan);
		$this->db->where('status_kursi',1);
		$this->db->from('db_penerbangan_kursi');
		$this->db->order_by('kode_penerbangan',$Gabungkan);
		$query = $this->db->get();
		return $query;	
	}


	function CekDataKursi($DataCek)
	{
		$this->db->where($DataCek);
		$this->db->from('db_penerbangan_kursi');
		$query = $this->db->get();
		return $query;	
	}


	function UpdateDokumenKemitraan($UpdateStatus,$idFile)
	{
		$this->db->where('id_dokumen',$idFile);
		$this->db->update('tb_dokumen_kemitraan',$UpdateStatus);
		return true;	
	}

	function UpdateMaskapaiNya($DataNya,$idDataNya)
	{
		$this->db->where('id',$idDataNya);
		$this->db->update('db_penerbangan',$DataNya);
		return true;	
	}

	function UpdateKuris($DataPenerbanganNya)
	{
		$this->db->insert('db_penerbangan_kursi',$DataPenerbanganNya);
		return true;	
	}


	// function InsertTravel($DataNya1)
	// {
	// 	$this->db->insert_batch('db_penerbangan_kursi',$DataNya1);
	// 	return true;	
	// }

	function DeleteMaskapai($id)
	{
		$this->db->where('kode_penerbangan',$id);
		$this->db->delete('db_penerbangan_kursi');
		return true;	
	}

	function DeleteKursiMaskapai($idKusri)
	{
		$this->db->where('id',$idKusri);
		$this->db->delete('db_penerbangan_kursi');
		return true;	
	}

	function DeleteKursi($id)
	{
		$this->db->where('kode_penerbangan',$id);
		$this->db->delete('db_penerbangan');
		return true;	
	}

	function DeleteKursiNya($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('db_penerbangan_kursi');
		return true;	
	}

	function InsertMaskapaiNya($DataNya)
	{
		$this->db->insert('db_penerbangan',$DataNya);
		return true;	
	}

	function InsertDokumenKemitraan($UpdateStatus)
	{
		$this->db->insert('tb_dokumen_kemitraan',$UpdateStatus);
		return true;	
	}
}

