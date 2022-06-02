<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Promo_models extends CI_Model
{
	function Data()
	{
		$this->db->from('tb_normatif_promo_layanan');
		$this->db->order_by('tanggal_post','asc');
		$query = $this->db->get();
		return $query;	
	}

	function Limit1s($limit, $start)
	{
		// $this->db->where('tb_ ',3);
		$query = $this->db->get('tb_normatif_promo_layanan',$limit, $start);
		return $query;
	}

	function PromoData1($idPromo)
	{
		$this->db->from('db_paket b');
		$this->db->join('tb_normatif_promo_layanan a','a.id_note_layanan=b.id_paket');
		$this->db->where('b.id_layanan',$idPromo);
		$this->db->where('a.status_promo',1);
		$this->db->order_by('a.id_note_layanan','asc');
		$query = $this->db->get();
		return $query;	
	}

	function DataPromo()
	{
		$this->db->from('tb_normatif_promo_layanan');
		$this->db->join('db_paket','db_paket.id_paket=tb_normatif_promo_layanan.id_note_layanan');
		$this->db->join('db_layanan','db_layanan.id_layanan=db_paket.id_layanan');
		$this->db->where('db_layanan.kode_layanan !=','U');
		$this->db->order_by('tb_normatif_promo_layanan.tanggal_post','asc');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query;	
	}

	function DataPromo1()
	{
		$this->db->from('tb_normatif_promo_layanan');
		$this->db->join('db_paket','db_paket.id_paket=tb_normatif_promo_layanan.id_note_layanan');
		$this->db->join('db_layanan','db_layanan.id_layanan=db_paket.id_layanan');
				// $this->db->where('db_layanan.id_layanan');
		$this->db->order_by('tb_normatif_promo_layanan.tanggal_post','asc');

		$this->db->limit('3');
		$query = $this->db->get();
		return $query;	
	}

	function FileImage($idDataS)
	{
		$this->db->where('id_promo',$idDataS);
		$this->db->from('tb_promo_image');
		$this->db->order_by('created','asc');
		$query = $this->db->get();
		return $query;	
	}

	function DataPromoPariwisata()
	{
		$this->db->from('tb_normatif_promo_layanan');
		$this->db->join('db_paket','db_paket.id_paket=tb_normatif_promo_layanan.id_note_layanan');
		$this->db->join('db_layanan','db_layanan.id_layanan=db_paket.id_layanan');
		$this->db->where('db_layanan.kode_layanan','U');
		$this->db->order_by('tb_normatif_promo_layanan.tanggal_post','asc');
		// $this->db->limit('1');
		$query = $this->db->get();
		return $query;	
	}

	function DataShowPaket()
	{
		$date = date('Y-m-d H:i:s');
		$this->db->from('db_paket a');
		$this->db->join('db_layanan b','b.id_layanan=a.id_layanan');
		// $this->db->order_by('tanggal_post','asc');
		$this->db->where('a.tanggal_berangkat > ',$date);
		$query = $this->db->get();
		return $query;	
	}

	function CariHarga($pilih)
	{
		$this->db->where('id_paket',$pilih);
		$this->db->from('db_paket');
		$query = $this->db->get();
		return $query;	
	}

	function ShowData1()
	{
		$this->db->where('id_paket',$pilih);
		$this->db->from('db_paket');
		$query = $this->db->get();
		return $query;	
	}

	function AmbekFileDataPromo($pilih)
	{
		$this->db->where('id',$pilih);
		$this->db->from('tb_promo_image');
		$query = $this->db->get();
		return $query;	
	}


	function CekDataDuplicate($DataCek)
	{
		$this->db->where($DataCek);
		$this->db->from('tb_normatif_promo_layanan');
		$query = $this->db->get();
		return $query;	
	}
	function CekDataDuplicate1($DataCek1)
	{
		$this->db->where($DataCek1);
		$this->db->from('tb_normatif_promo_layanan');
		$query = $this->db->get();
		return $query;	
	}

	function Insert($DataNya)
	{
		$this->db->insert('tb_normatif_promo_layanan',$DataNya);
		return true;	
	}

	function UploadFotos($InsertData)
	{
		$this->db->insert('tb_promo_image',$InsertData);
		return true;	
	}

	function DeletePromo($pilih)
	{
		$this->db->where('id_promo',$pilih);
		$this->db->delete('tb_normatif_promo_layanan');
		return true;	
	}
	function DeletePromoFile($pilih)
	{
		$this->db->where('id',$pilih);
		$this->db->delete('tb_promo_image');
		return true;	
	}

	function DeletePromoFiles($pilih)
	{
		$this->db->where_in('id_promo',$pilih);
		$this->db->delete('tb_promo_image');
		return true;	
	}

	function UpdatePromo($DataNya,$id)
	{
		$this->db->where('id_promo',$id);
		$this->db->update('tb_normatif_promo_layanan',$DataNya);
		return true;	
	}
}