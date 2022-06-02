<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PembayaranTiket extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Paket_models','Pengguna_models','Pembayaran_models','Pemesanan_models','PembayaranTiket_models']);
		$this->load->library('template');
		False();
	}
	public function index()
	{
		$Level       			= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 3) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       = $DataNya['id_level'];
			$data['Tiket']			= $this->PembayaranTiket_models->Data();
			$this->template->layout('Pesan Tiket/HSPT.php',$data);
		}else{
			redirect('Error/AksesError');
		}

	}

}