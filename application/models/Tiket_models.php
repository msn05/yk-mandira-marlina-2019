<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tiket_models extends CI_Model
{
	function CekData($CekData)
	{
		$this->db->where($CekData);
		$this->db->from('tb_tiket_yeka_madira');
		$query = $this->db->get();
		return $query;	
	}

	function Tiket($Base)
	{
		$this->db->from('tb_file_tiket a');
		$this->db->join('db_penerbangan_kursi b','b.Id=a.nomor_tiket');
		$this->db->join('db_penerbangan c','c.id=b.id_penerbangan_kursi');
		$this->db->where('a.id_pemesanan',$Base);
		$query = $this->db->get();
		return $query;	
	}
	function CekDataLagi($CekData1)
	{
		$this->db->where($CekData1);
		$this->db->from('tb_tiket_yeka_madira');
		$query = $this->db->get();
		return $query;	
	}


	function NomorTiketCek($kodePemesanan)
	{
		$this->db->where('id_pemesanan',$kodePemesanan);
		$this->db->from('tb_file_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function ShowData()
	{
		$this->db->from('tb_tiket_yeka_madira');
		$query = $this->db->get();
		return $query;	
	}

	function ShowData1($pelanggan)
	{
		$this->db->where('id_pelanggan',$pelanggan);
		$this->db->from('tb_pesan_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function CekDataTiket($CekData)
	{
		$this->db->from('tb_keterangan_harga_tiket a');
		$this->db->join('tb_tiket_yeka_madira b','b.id_data_tiket = a.id_tiket_data');
		$this->db->where($CekData);
		$query = $this->db->get();
		return $query;	
	}

	function CekDataTiket1($CekData2)
	{
		$this->db->where($CekData2);
		$this->db->from('tb_keterangan_harga_tiket');
		$query = $this->db->get();
		return $query;	
	}


	function MaskapaiNya($id_penerbangan)
	{
		$this->db->where('id',$id_penerbangan);
		$this->db->from('db_penerbangan');
		$query = $this->db->get();
		return $query;	
	}

	function ShowKetentuanHarga($ketentuanHarga)
	{
		$this->db->where('id_tiket_data',$ketentuanHarga);
		$this->db->from('tb_keterangan_harga_tiket');
		$query = $this->db->get();
		return $query;	
	}


	function dataTiketCetak()
	{
		$this->db->from('tb_file_tiket a');
		$query = $this->db->get();
		return $query;	
	}


	function dataTiketCetak1($pelanggan)
	{
		$this->db->from('tb_pesan_tiket a');
		$this->db->join('tb_file_tiket b','b.id_pemesanan=a.id_pesan_tiket_data');
		$this->db->join('tb_tiket_yeka_madira c','c.id_tiket_YKM=a.id_tiket_pesawat_data');
		$this->db->where('a.id_pelanggan',$pelanggan);
		$query = $this->db->get();
		return $query;	
	}


	function TotalTiketData($name_id)
	{
		$this->db->select('sum(jumlah) as TotalData',FALSE);
		$this->db->where('id_tiket_data',$name_id);
		$this->db->from('tb_keterangan_harga_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function TotalDataKursi($dataKursi)
	{
		$this->db->select('sum(jumlah) as TotalData, count(level) as TotalLevel, sum(harga) as HargaNya',FALSE);
		$this->db->where('id_tiket_data',$dataKursi);
		$this->db->from('tb_keterangan_harga_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function InsertDataNya($InsertData)
	{
		$this->db->insert('tb_tiket_yeka_madira',$InsertData);
		return true;
	}

	function InsertDataTiketNomor($dataNya)
	{
		$this->db->insert('tb_file_tiket',$dataNya);
		return true;
	}

	function DeleteTiket($name_id)
	{
		$this->db->where('id',$name_id);
		$this->db->delete('tb_keterangan_harga_tiket');
		return true;
	}

	function UpdateTiket($Total,$name_id)
	{
		$this->db->where('id_data_tiket',$name_id);
		$this->db->update('tb_tiket_yeka_madira',$Total);
		return true;
	}

	function UpdateKursiData($TiketData,$nomorTiket)
	{
		$this->db->where('id',$nomorTiket);
		$this->db->update('db_penerbangan_kursi',$TiketData);
		return true;
	}

	function UpdateDataNyaHarga($InsertData,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('tb_keterangan_harga_tiket',$InsertData);
		return true;
	}

	function UpdateDataNyaHarga2($InsertData4,$idJ)
	{
		$this->db->where('id',$idJ);
		$this->db->update('tb_keterangan_harga_tiket',$InsertData4);
		return true;
	}
	function UpdateDataNyaHarga1($InsertData1,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('tb_keterangan_harga_tiket',$InsertData1);
		return true;
	}

	function UpdateDataNya($InsertData,$id)
	{
		$this->db->where('id_tiket_YKM',$id);
		$this->db->update('tb_tiket_yeka_madira',$InsertData);
		return true;
	}

	function UpdateDataNya1($Total,$name_id)
	{
		$this->db->where('id_tiket_YKM',$name_id);
		$this->db->update('tb_tiket_yeka_madira',$Total);
		return true;
	}

	function InsertDataNyaHarga($InsertData)
	{
		$this->db->insert('tb_keterangan_harga_tiket',$InsertData);
		return true;
	}



}
