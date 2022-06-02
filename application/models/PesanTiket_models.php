<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PesanTiket_models extends CI_Model
{
	function ShowData($KodeTiketData)
	{
		$this->db->where('id_tiket_data',$KodeTiketData);
		$this->db->from('tb_keterangan_harga_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function ShowAllData()
	{
		$this->db->from('tb_pesan_tiket');
		$query = $this->db->get();
		return $query;	
	}

	function ShowAllDataPelanggan($pelanggan)
	{
		$this->db->from('tb_pesan_tiket');
		$this->db->where('id_pelanggan',$pelanggan);
		$query = $this->db->get();
		return $query;	
	}

	function ShowAllDataTiket($idTiket)
	{
		$this->db->from('tb_pesan_tiket d');
		$this->db->join('tb_tiket_yeka_madira a','a.id_tiket_YKM
			=d.id_tiket_pesawat_data');
		$this->db->join('db_penerbangan b','b.id=a.id_penerbangan');
		$this->db->join('db_penerbangan_kursi c','c.id_penerbangan_kursi=b.id');
		$this->db->where(['d.id_pesan_tiket_data'=>$idTiket,'c.status_kursi'=>0]);
		$query = $this->db->get();
		return $query;	
	}

	function InsertTagihan($dataInsert)
	{
		$this->db->insert('tb_tagihan_tiketing',$dataInsert);
		return true;	
	}


	function ShowData1($KodeTiketData)
	{
		$this->db->where('id_tiket_pemesanan',$KodeTiketData);
		$this->db->from('tb_detail_pesan_tiket_pelanggan');
		$query = $this->db->get();
		return $query;	
	}

	function TotalDataKursi($KodeTiketData)
	{
		$this->db->select('sum(jumlah) as TotalData, count(id_keterangan_tiket) as TotalLevel, sum(harga) as HargaNya',FALSE);
		$this->db->where('id_tiket_pemesanan',$KodeTiketData);
		$this->db->from('tb_detail_pesan_tiket_pelanggan');
		$query = $this->db->get();
		return $query;	
	}

	function CekTiketNya($DataCekNya)
	{
		$this->db->where($DataCekNya);
		$this->db->from('tb_detail_pesan_tiket_pelanggan');
		$query = $this->db->get();
		return $query;	
	}
	function CekTiketNya1($DataCekNya)
	{
		$this->db->where('id_tiket_pemesanan',$DataCekNya);
		$this->db->from('tb_detail_pesan_tiket_pelanggan');
		$query = $this->db->get();
		return $query;	
	}

	function TiketPesanan($DataCekNya)
	{
		$this->db->from('tb_pesan_tiket a');
		$this->db->join('tb_detail_pesan_tiket_pelanggan b','b.id_tiket_pemesanan=a.id_tiket_data_pesan');
		$this->db->join('tb_keterangan_harga_tiket c','c.id=b.id_keterangan_tiket');
		$this->db->where('a.id_tiket_data_pesan',$DataCekNya);
		$query = $this->db->get();
		return $query;	
	}

	function deleteNya($delete)
	{
		$this->db->where('id',$delete);
		$this->db->delete('tb_detail_pesan_tiket_pelanggan');
		return true;	
	}

	function update($DataUpdate,$delete)
	{
		$this->db->where('id',$delete);
		$this->db->update('tb_pesan_tiket',$DataUpdate);
		return true;	
	}

	function TambahTiketDelete($DataUpdateTiket,$name_nama)
	{
		$this->db->where('id',$name_nama);
		$this->db->update('tb_keterangan_harga_tiket',$DataUpdateTiket);
		return true;	
	}
	function InsertDataNya($InsertData)
	{
		$this->db->insert('tb_pesan_tiket',$InsertData);
		return true;
	}

	function UpdatePemesananTiket($status,$idPesanan)
	{
		$this->db->where('id_pesan_tiket_data',$idPesanan);
		$this->db->update('tb_pesan_tiket',$status);
		return true;
	}
	

	function TagihanPembayaran($DataTagihanTiket)
	{
		$this->db->insert('tb_tagihan_tiketing',$DataTagihanTiket);
		return true;
	}

	function InsertDataNya1($InsertData)
	{
		$this->db->insert('tb_detail_pesan_tiket_pelanggan',$InsertData);
		return true;
	}

	function InsertDataNya2($InsertData2)
	{
		$this->db->insert('tb_detail_pesan_tiket_pelanggan',$InsertData2);
		return true;
	}


}