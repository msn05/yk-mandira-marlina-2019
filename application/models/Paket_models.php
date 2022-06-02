<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paket_models extends CI_Model
{
	function Data()
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan','left');
		$this->db->where('b.kode_layanan != ','U');
		$query = $this->db->get();
		return $query;	
	}


	function SearchData($Tanggal)
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan');
		$this->db->where('a.tanggal_Berakhir >=',$Tanggal);
		// $this->db->where('a.lama_perjalanan >=',$hari);
		$this->db->where('b.kode_layanan','TU');
		$query = $this->db->get();
		return $query;	
	}

	function SearchDatass($Tanggal,$dari,$tujuan)
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan');
		$this->db->where('a.tanggal_Berakhir >=',$Tanggal);
		// $this->db->where('a.lama_perjalanan >=',$hari);
		$this->db->where(['a.start_in'=>$dari,'a.end_ind'=>$tujuan]);
		$this->db->where('b.kode_layanan','U');
		$query = $this->db->get();
		return $query;	
	}

	function SearchDataTiket($Tanggal,$da,$das)
	{
		$this->db->from('tb_tiket_yeka_madira');
		$this->db->where(['tanggal >='=>$Tanggal,'to'=>$da,'form'=>$das]);
		$query = $this->db->get();
		return $query;	
	}

	function SearchDataHaji($Tanggal)
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan');
		$this->db->where('a.tanggal_Berakhir >=',$Tanggal);
		// $this->db->where('a.lama_perjalanan >=',$hari);
		$this->db->where('b.kode_layanan','TH');
		$query = $this->db->get();
		return $query;	
	}

	function DataPaketParis()
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan','left');
		$this->db->where('b.kode_layanan','U');
		$query = $this->db->get();
		return $query;	
	}

	function ShowDataInfo($idDataNya)
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan','left');
		$this->db->join('db_transportasi_darat c','c.id=a.id_transportasi_paket','left');
		$this->db->where('id_paket',$idDataNya);
		$query = $this->db->get();
		return $query;	
	}


	function ShowDataInfo1($idDataNya)
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan','left');
		$this->db->join('db_transportasi_darat c','c.id=a.id_transportasi_paket','left');
		$this->db->where('id_paket',$idDataNya);
		$query = $this->db->get();
		return $query;	
	}


	function DataTour()
	{
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan','left');
		$this->db->join('db_transportasi_darat c','c.id=a.id_transportasi','left');
		$this->db->join('db_metode_pembayaran d','d.id_metode_pembayaran=a.id_metode','left');
		$this->db->join('db_data_akses g','g.id_akses=a.id_akses','left');
		$this->db->join('db_penerbangan h','h.id=a.id_penerbangan','left');
		$this->db->join('db_keterangan_toru i','i.id_paketnya=a.id_paket','left');
		$this->db->where('a.kode_paket','H');
		$query = $this->db->get();
		return $query;	
	}

	function InformasiPaket($kodePaket)
	{
		$this->db->where('id_paket',$kodePaket);
		$this->db->from('db_paket');
		$query = $this->db->get();
		return $query;	
	}

	function CekPaketNya($DataCek)
	{
		$this->db->where($DataCek);
		$this->db->from('db_paket');
		$query = $this->db->get();
		return $query;	
	}

	function PemesananInfo($dataPeka)
	{
		$this->db->from('tb_pemasanan_paket a');
		$this->db->join('db_paket b','b.id_paket=a.id_paket');
		$this->db->join('db_layanan c','c.id_layanan=b.id_layanan');
		$this->db->where('a.id_paket',$dataPeka);
		$query = $this->db->get();
		return $query;	
	}

	function UpdateKeteranganTour($InsertLagi,$kodePaket)
	{
		$this->db->where('id_paketnya',$kodePaket);
		$this->db->update('db_keterangan_toru',$InsertLagi);
		return true;	
	}

	function UpdatePenerbangan($DataNya,$nomor)
	{
		$this->db->where('id',$nomor);
		$this->db->update('db_penerbangan',$DataNya);
		return true;	
	}

	function UpdateTour($DataNyaLah,$kodePaket)
	{
		$this->db->where('id_paket',$kodePaket);
		$this->db->update('db_paket',$DataNyaLah);
		return true;	
	}

	function KeteranganTour($idLayanan)
	{
		$this->db->where('id_paketnya',$idLayanan);
		$this->db->from('db_keterangan_toru');
		$query = $this->db->get();
		return $query;	
	}

	function DataBus($KodeBus)
	{
		$this->db->where('id',$KodeBus);
		$this->db->from('db_transportasi_darat');
		$query = $this->db->get();
		return $query;	
	}

	function CekDataNya($DataNyaLah)
	{
		$this->db->where($DataNyaLah);
		$this->db->from('tb_perlengkapan_paket');
		$query = $this->db->get();
		return $query;	
	}

	function DataPerlengkapan($PaketKode)
	{
		$this->db->select('a.id,a.id_perlengkapan_paket,a.id_kelengkapan,a.jumlah,b.id_kelengkapandata,b.nama_barang');
		$this->db->from('tb_perlengkapan_paket as a');
		$this->db->join('db_kelengkapan_data as b ','a.id_kelengkapan=b.id_kelengkapandata','left');
		$this->db->where('id_perlengkapan_paket',$PaketKode);
		$query = $this->db->get();
		return $query;	
	}

	function Nonaktifkan($DataNya,$id)
	{
		$this->db->where('id_paket',$id);
		$this->db->update('db_paket',$DataNya);
		return true;	
	}


	function Update($DataNyaLah,$kodePaket)
	{
		$this->db->where('id_paket',$kodePaket);
		$this->db->update('db_paket',$DataNyaLah);
		return true;	
	}

	function InsertDataBaru($InsertData)
	{
		$this->db->insert('db_paket',$InsertData);
		return true;	
	}

	function DeletePerlengkapan($Hapus)
	{
		$this->db->where($Hapus);
		$this->db->delete('tb_perlengkapan_paket');
		return true;	
	}

	function InsertPerlengkapan($Data)
	{
		$this->db->insert('tb_perlengkapan_paket',$Data);
		return true;	
	}


	function InsertKeteranganTour($InsertLagi)
	{
		$this->db->insert('db_keterangan_toru',$InsertLagi);
		return true;	
	}


	function InsertTour($DataNyaLah)
	{
		$this->db->insert('db_paket',$DataNyaLah);
		return true;	
	}


	function CekPaket($id)
	{
		$this->db->where('id_paket',$id);
		$this->db->from('db_paket');
		$query = $this->db->get();
		return $query;	
	}





}

