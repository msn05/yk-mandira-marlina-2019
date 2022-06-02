<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Pengguna_models','Menu_models']);
		$this->load->library('template');
		False();		

	}

	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$Kode =$id;
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             	= $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$Level        			= $DataNya['id_level'];
		$data['Level']        	= $DataNya['id_level'];
		$Akses   				= $this->Menu_models->NamaAkses($Level)->row_array();
		$data['NamaLevel']		= $Akses['nama_level'];
		if ($Level == 1 || $Level == 3 || $Level ==4) {
			$data['Level']        	= $DataNya['id_level'];
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['TotalPelanggan'] = $this->Pengguna_models->TotalPelangganNya()->row_array();
			$data['TotalMitraPener'] = $this->Pengguna_models->TotalPener()->row_array();
			$data['TotalMitraBus'] = $this->Pengguna_models->TotalBus()->row_array();
			$data['TotalPesananTiket'] = $this->Pengguna_models->TotalTiket()->row_array();
			$data['TotalPesananUmroh'] = $this->Pengguna_models->TotalTiketUmroh()->row_array();
			$data['TotalPesananHaji'] = $this->Pengguna_models->TotalTiketHaji()->row_array();
			$data['TotalPesananParis'] = $this->Pengguna_models->TotalTiketPariws()->row_array();
			$data['GrafikData'] = $this->Pengguna_models->Grafik();
			$this->template->layout('akses/home.php',$data);
		}elseif ($Level == '2') {
			$data['Level']        	= $DataNya['id_level'];
			$DataPelanggan            	= $this->Pengguna_models->DataShow1($Kode)->row_array();
			$name_id 	=$DataPelanggan['id'];
			$this->load->model(['Pemesanan_models']);
			$data['nama']           = $DataPelanggan['nama_lengkap'];
			$dataCekNya = [
				'id_pelanggan'=>$name_id,
			];
			
			$data['TotalPesananPaket']	= $this->Pemesanan_models->CekDataPemesanan1($dataCekNya)->row_array();
			$data['TotalPesanan']	= $this->Pemesanan_models->CekDataPemesanan2($name_id)->row_array();
			$this->template->layout('akses/home_pelanggan.php',$data);
		}
	}

	public function website()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$this->this->load('website/index.php',$data);
	}


}
