<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Pengguna_models','Menu_models']);
		$this->load->library('template');
		False();		
	}


	public function index()
	{
		$data['Level']        	= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNyaiD             	= $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$Level        			= $DataNya['id_level'];
		$Akses   				= $this->Menu_models->NamaAkses($Level)->row_array();
		$data['NamaLevel']		= $Akses['nama_level'];
		$data['nama']           = $DataNyaiD['nama_lengkap'];
		$this->template->layout('errors/404.php',$data);

	}

	public function AksesError()
	{
		$data['Level']        	= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$Level        			= $DataNya['id_level'];
		$Akses   				= $this->Menu_models->NamaAkses($Level)->row_array();
		$data['NamaLevel']		= $Akses['nama_level'];
		$DataNyaiD             	= $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNyaiD['nama_lengkap'];
		$this->template->layout('errors/500.php',$data);
	}
	public function ErrorData(){
		$data['Level']        	= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$this->template->layout('errors/404.php',$data);
	}
}