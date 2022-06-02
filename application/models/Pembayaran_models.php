<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pembayaran_models extends CI_Model
{
	function Data()
	{
		$this->db->from('tb_tagihan_pembayaran');
		$query = $this->db->get();
		return $query;
	}

	function Data1($pelanggan)
	{
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('tb_tagihan_pembayaran b','b.kode_pemesanan=a.id_pemesanan','left');
		$this->db->where('a.id_pelanggan',$pelanggan);
		$query = $this->db->get();
		return $query;
	}


	function LaporanTagihan($tanggal1,$tanggal2)
	{
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('tb_tagihan_pembayaran b','b.kode_pemesanan=a.id_pemesanan','left');
		$this->db->where('tanggal_pesan >=', $tanggal1);
		$this->db->where('tanggal_pesan <=', $tanggal2);
		$query = $this->db->get();
		return $query;
	}

	function insert($DataNya)
	{
		$this->db->insert('tb_detail_tagihan',$DataNya);
		return true;
	}
	function BerangkatPelanggan($PelangganBerangkat)
	{
		$this->db->insert('tb_keberangakatan',$PelangganBerangkat);
		return true;
	}

	function DeletePembayaranDetail($idData)
	{
		$this->db->where('id_detail_tagihannya',$idData);
		$this->db->delete('tb_detail_tagihan');
		return true;
	}

	function ShowDetail($Pembayaran)
	{
		$this->db->from('tb_detail_tagihan a');
		$this->db->join('tb_tagihan_pembayaran b','b.nomor_tagihan=a.id_detail_tagihan');
		$this->db->where('id_detail_tagihan',$Pembayaran);
		$query = $this->db->get();
		return $query;
	}

	function idPemesanan($idPembayaran)
	{
		$this->db->from('tb_detail_tagihan a');
		$this->db->join('tb_tagihan_pembayaran b', 'b.nomor_tagihan=a.id_detail_tagihan');
		$this->db->join('tb_pemasanan_paket c','c.id_pemesanan=b.kode_pemesanan');
		$this->db->where('a.id_detail_tagihannya',$idPembayaran);
		$query = $this->db->get();
		return $query;
	}

	function JumlahUang($idPembayaran)
	{
		$this->db->where('nomor_tagihan',$idPembayaran);
		$this->db->from('tb_tagihan_pembayaran ');
		$query = $this->db->get();
		return $query;
	}

	function TotalBayaran($Pembayaran)
	{
		$this->db->select('sum(jumlah) as TotalBayar');
		$this->db->from('tb_detail_tagihan a');
		$this->db->where('id_detail_tagihan',$Pembayaran);
		$query = $this->db->get();
		return $query;
	}


}
