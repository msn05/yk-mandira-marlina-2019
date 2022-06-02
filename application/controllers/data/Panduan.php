<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panduan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Panduan_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function Pendaftaran()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			$DataCek = [
				'note_idText' =>'Pendaftaran',
			];
			$data['Panduan']        = $this->Panduan_models->CekDataDuplicate($DataCek);
			$this->template->layout('panduan/Pendaftara/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function Pembayaran()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$DataCek = [
				'note_idText' =>'Pendaftaran',
			];
			$data['Panduan']        = $this->Panduan_models->CekDataDuplicate($DataCek);
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			$this->template->layout('panduan/Pembayaran/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function editpendaftaran()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$dataID = $this->input->get('idData');
			if ($dataID != NULL) {
				$data['keteranganData'] = base64_decode($this->input->get('keterangan'));
				$DataCek1 = base64_decode($dataID);
				$data['dataNya'] = $DataCek1;
				$DataCek = [
					'id'=>$DataCek1,
				];
				$dKeterangan = base64_decode($this->input->get('keterangan'));
				$dataEdit = $this->Panduan_models->CekDataDuplicate($DataCek)->row_array();
				$data['idKete'] 				= $dataEdit['id_kategori'];
				$data['keterangan'] = $dataEdit['keterangan'];
			}else{
				redirect('error');
			}
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['Panduan']        = $this->Panduan_models->Data();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			$this->template->layout('panduan/Pendaftara/edit.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function deletePendaftaran()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$id = $this->input->post('name_id');
			if ($id != null) {
				$DeleteDataPanduan = $this->Panduan_models->DeleteDataPanduanNya($id);
				if ($DeleteDataPanduan == true) {
					$respone = [
						'status' =>'success',
						'message'=>'Berhasil.',
					];
				}else{
					$respone = [
						'status' =>'error',
						'message'=>'Gagal.',
					];
				}
			}else{
				redirect('error');
			}
		}else{
			redirect('Error/AksesError');
		}
		echo json_encode($respone);
	}

	public function form()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['Panduan']        = $this->Panduan_models->Data();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			$this->template->layout('panduan/Pendaftara/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	function simpanpendaftaran	()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pilihs','Pilihs', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('pilih','Pilih', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('catatan','Catatan', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tidak Sesuai Format.</div>');
			redirect(site_url('data/panduan/pendaftaran'));

		}else{
			$pilihs 				= $this->input->post('pilihs');
			$pilih 				= $this->input->post('pilih');
			$Catatan 				= $this->input->post('catatan');
			$Tanggal 				= date('Y-m-d H:i:s');

			if (!empty($pilih) && !empty($Catatan) && !empty($Tanggal) && !empty($pilihs)) {

				$DataCek = [
					'tanggal' 				=> $Tanggal,
					'id_kategori'			=> $pilih,
					'keterangan'  => $Catatan,
					'note_idText'  => $pilihs,
				];

				$CekData 			= $this->Panduan_models->CekDataDuplicate($DataCek)->num_rows(); 
				if ($CekData > 0) {
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada..!</div>');
					redirect(site_url('data/panduan/pendaftaran'));

				}else{
					$DataNya = [
						'tanggal' 			 	=> $Tanggal,
						'id_kategori'			 	=> $pilih,
						'keterangan'			=> $Catatan,
						'note_idText'  			=> $pilihs,
					];

					$InsertLagi = $this->Panduan_models->Insert($DataNya);
					if ($InsertLagi == true) {
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Berhasil Tersimpan...!</div>');
						redirect(site_url('data/panduan/pendaftaran'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alertdanger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>File Kemitraan Gagal Tersimpan..!</div>');
						redirect(site_url('data/panduan/pendaftaran'));
					}
				}
			}
		}
	}
	function simpaneditpendaftaran	()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pilih','Pilih', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('catatan','Catatan', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tidak Sesuai Format.</div>');
			redirect(site_url('data/panduan/pendaftaran'));

		}else{
			$id 					= $this->input->post('id');
			$pilih 					= $this->input->post('pilih');
			$Catatan 				= $this->input->post('catatan');
			$Tanggal 				= date('Y-m-d H:i:s');

			if (!empty($pilih) && !empty($Catatan) && !empty($Tanggal)) {

				$DataCek = [
					'tanggal' 				=> $Tanggal,
					'id_kategori'			=> $pilih,
					'keterangan'  => $Catatan,
				];

				$CekData 			= $this->Panduan_models->CekDataDuplicate($DataCek)->num_rows(); 
				if ($CekData > 0) {
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada..!</div>');
					redirect(site_url('data/panduan/pendaftaran'));
				}else{
					$DataNya = [
						'tanggal' 			 				=> $Tanggal,
						'id_kategori'			 	=> $pilih,
						'keterangan'						=> $Catatan,
					];

					$InsertLagi = $this->Panduan_models->Update($DataNya,$id);
					if ($InsertLagi == true) {
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Berhasil Tersimpan...!</div>');
						redirect(site_url('data/panduan/pendaftaran'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alertdanger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>File Kemitraan Gagal Tersimpan..!</div>');
						redirect(site_url('data/panduan/pendaftaran'));
					}
				}
			}
		}
	}

}