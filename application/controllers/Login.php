<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Pengguna_models']);
	}

	public function index()
	{
		$data['Perusahaan']             = $this->Perusahaan_models->Tentang();
		True();
		$this->load->view('login',$data);
	}

	public function ProsesKeluar()
	{
		$this->session->unset_userdata('id_akses');
		$this->session->unset_userdata('id_level');
		
		$Jam = [
			'logout' => date('Y-m-d H:i:s')
		];

		$this->db->update('db_akses',$Jam);
		$respone = [
			'status' => 'success',
			'message'=> 'Data Berhasil Keluar...!'
		];
		echo json_encode($respone);
	}

	public function ProsesMasuk()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_akses','Id_akses', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('password','password', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Ada yang Kosong..!',
			];
		}else{
			$Uname			= htmlentities($this->input->post('id_akses'));
			$Pass				= $this->input->post('password');
			$Cek_Data 	= $this->Pengguna_models->Login($Uname)->row_array();
			$StatusAkun	= $Cek_Data['status_users'];
			if ($Cek_Data == true) {
				if (password_verify($Pass, $Cek_Data['password'])) {
					if ($StatusAkun == 1 && $Cek_Data['id_level'] > 0) {
						$Session = [
							'id_akses' 		=> $Cek_Data['id_akses'],
							'id_level' 		=> $Cek_Data['id_level'],
							'LoginSistem' 	=> (bool)true
						];
						$this->session->set_userdata($Session);
						$UpdateStatusNya =[
							'login' => date('Y-m-d H:i:s')
						];
						$this->db->update('db_akses',$UpdateStatusNya);
						$respone = [
							'status' => 'success',
							'message'=> 'Data Anda Tersedia...!'
						];
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Status Anda Non Aktif atau anda Tidak Mempunyai Akses..!'
						];
					}
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Password Tidak Sama..!'
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Data Tidak Ada...!'
				];
			}
		}
		echo json_encode($respone);
	}

}
