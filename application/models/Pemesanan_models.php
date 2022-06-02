<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pemesanan_models extends CI_Model
{
	function Data()
	{
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket = a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan = b.id_layanan');
		$this->db->join('tb_pelanggan d','d.id = a.id_pelanggan');
		$this->db->where('c.kode_layanan !=','U');
		$query = $this->db->get();
		return $query;	
	}
	function DataPelanggan($id)
	{
		$this->db->from('tb_pelanggan a');
		$this->db->join('tb_pemasanan_paket b','b.id_pelanggan=a.id');
		$this->db->join('db_paket c','c.id_paket = b.id_paket');
		$this->db->join('db_layanan d','d.id_layanan = c.id_layanan');
		$this->db->join('tb_pelanggan e','e.id = b.id_pelanggan');
		$this->db->where('d.kode_layanan !=','U');
		$this->db->where('a.id_akses_data',$id);
		$query = $this->db->get();
		return $query;	
	}

	function DataPariwisata()
	{
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket = a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan = b.id_layanan');
		$this->db->join('tb_pelanggan d','d.id = a.id_pelanggan');
		$this->db->where('c.kode_layanan','U');
		$query = $this->db->get();
		return $query;	
	}

	function DataPariwisata1($id)
	{
		$this->db->from('tb_pelanggan a');
		$this->db->join('tb_pemasanan_paket b','b.id_pelanggan=a.id');
		$this->db->join('db_paket c','c.id_paket = b.id_paket');
		$this->db->join('db_layanan d','d.id_layanan = c.id_layanan');
		// $this->db->join('tb_pelanggan d','d.id = a.id_pelanggan');
		$this->db->where('d.kode_layanan','U');
		$this->db->where('a.id_akses_data',$id);
		$query = $this->db->get();
		return $query;	
	}

	function CekData($CekPembayaran)
	{
		$this->db->where($CekPembayaran);
		$this->db->from('tb_tagihan_pembayaran');
		$query = $this->db->get();
		return $query;	
	}

	function CekDataPemesanan($dataCekNya)
	{
		$this->db->where($dataCekNya);
		$this->db->from('tb_pemasanan_paket');
		$query = $this->db->get();
		return $query;	
	}
	

	function CekDataPemesanan2($name_id)
	{
		$this->db->select('count(id_pesan_tiket_data) as Total');
		$this->db->from('tb_pesan_tiket');
		$this->db->where('id_pelanggan',$name_id);
		$query = $this->db->get();
		return $query;	
	}
	
	function CekDataPemesanan1($dataCekNya)
	{
		$this->db->select('count(id_pemesanan) as Total');
		$this->db->from('tb_pemasanan_paket');
		$this->db->where($dataCekNya);
		$query = $this->db->get();
		return $query;	
	}
	

	
	
	function Insert($DataPesananya)
	{
		$this->db->insert('tb_pemasanan_paket',$DataPesananya);
		return true;	
	}

	function DeleteTagihan($KodeTagihan)
	{
		$this->db->where('id_detail_tagihan',$KodeTagihan);
		$this->db->delete('tb_detail_tagihan');
		return true;	
	}

	function DeleteDat($id)
	{
		$this->db->where('kode_pemesanan',$id);
		$this->db->delete('tb_tagihan_pembayaran');
		return true;	
	}

	function DeletePesanan($id)
	{
		$this->db->where('id_pemesanan',$id);
		$this->db->delete('tb_pemasanan_paket');
		return true;	
	}


	function CekPesanan($CekPembayaran)
	{
		$this->db->where($CekPembayaran);
		$this->db->from('tb_pemasanan_paket');
		$query = $this->db->get();
		return $query;	
	}

	function UpdateStatus($Pemesanan,$KodePemesanan)
	{
		$this->db->where('id_pemesanan',$KodePemesanan);
		$this->db->update('tb_pemasanan_paket',$Pemesanan);
		return true;	
	}


}