<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Galeri extends CI_Controller {

	private $limit = 4;

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Galeri_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$Level 					= $this->session->userdata('id_level');
		if ([$Level == '1' || $Level == '3']) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['galeri']           = $this->Galeri_models->Data();

			$this->template->layout('galeri/index.php',$data);
		}else{
			redirect('Error');
		}
	}

	public function formTambah()
	{
		$Level 					= $this->session->userdata('id_level');
		if ([$Level == '1' || $Level == '3']) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['headerMenu']		='Form Tambah Foto Dokumentasi';
			$this->template->layout('galeri/FormDataTambah.php',$data);
		}else{
			redirect('Error/AksesData');
		}
	}

	public function deleteFoto()
	{
		$name_id 	= $this->input->post('name_id');
		if ($name_id != NULL) {
			$idData = $name_id;
			$AmbilData = $this->Galeri_models->ShowData($idData)->row_array();
			$FotoLama = $AmbilData['foto'];
			$DeleteFoto = $this->Galeri_models->DeleteFoto($name_id);
			if ($DeleteFoto == true) {
				unlink("./image/galeri/".$FotoLama);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal'
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data Kosong..!'
			];
		}
		echo json_encode($respone);
	}

	public function slideFoto()
	{
		$name_id 	= $this->input->post('name_id');
		$date = date('Y-m-d');
		if ($name_id != NULL) {
			$DataNya = [
				'created' =>$date,
				'action'	=>1,
				'image'	=>$name_id,
			];

			$AmbilData = $this->Galeri_models->SlideImage($DataNya);
			if ($AmbilData == true) {
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal'
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'terjadi Kesalahan...!'
			];
		}
		echo json_encode($respone);
	}

	public function EditGambar()
	{
		$Level 					= $this->session->userdata('id_level');
		if ([$Level == '1' || $Level == '3']) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['headerMenu']		='Form Ubah Foto Dokumentasi';
			$Galeri 				= $this->input->get('idData');
			if ($Galeri != NULL) {
				$idData = base64_decode($Galeri);
				$AmbilData = $this->Galeri_models->ShowData($idData)->row_array();
				$data['idName']  = $AmbilData['id'];
				$data['FotoLama']  = $AmbilData['foto'];
				$data['note'] 	   = $AmbilData['keterangan'];
				$data['kategori_dokumentasi'] 	   = $AmbilData['kategori_dokumentasi'];
				$this->template->layout('galeri/FormDataUbah.php',$data);
			}
		}else{
			redirect('Error/AksesData');
		}
	}

	public function UploadDokumen()
	{
		$keterangan = $this->input->post('keterangan');
		$ktg 						 = $this->input->post('ktd');
		$date = date('YmdHis');
		$datet = date('Y-m-d');

		if([!empty($keterangan) && !empty($ktg)]){
			$InsertData = [
				'kategori_dokumentasi'	=>$ktg,
				'keterangan'		=>$keterangan,
				'tanggal'			=>$datet,	
			];
			if(!empty($_FILES['foto']['name']) ){
				$_FILES['file1']['name']     = $_FILES['foto']['name'];
				$_FILES['file1']['type']     = $_FILES['foto']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['foto']['error'];
				$_FILES['file1']['size']     = $_FILES['foto']['size'];

				$uploadPath = './image/galeri/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '1024';

				$config['file_name'] = 'foto tanggal '.$date;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1') == true){
					$data_upload = $this->upload->data();
					$config['image_library']='gd2';
					$config['source_image']='./image/galeri/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= 'auto';
					$config['width']= 600;
					$config['height']= 400;
					$config['new_image']= './image/galeri/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$InsertData['foto'] = $data_upload['file_name'];
					$Insert  = $this->Galeri_models->UploadFoto($InsertData);

					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil Menambahkan Foto.!'
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Format Image Salah..!'
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Foto Tidak Kosong..!'
				];
			}

		}
		echo json_encode($respone);
	}
	public function UploadDokumenUbah()
	{
		$idData 		= $this->input->post('id');
		$keterangan = $this->input->post('keterangan');
		$ktg 		= $this->input->post('ktd');
		$date = date('YmdHis');
		$datet = date('Y-m-d');

		$CekData = $this->Galeri_models->ShowData($idData)->row_array();
		$FotoLama = $CekData['foto'];

		if(!empty($_FILES['foto']['name']) ){
			if([!empty($keterangan) && !empty($ktg)]){
				$InsertData = [
					'kategori_dokumentasi'	=>$ktg,
					'keterangan'			=>$keterangan,
					'tanggal'				=>$datet,	
				];

				$_FILES['file1']['name']     = $_FILES['foto']['name'];
				$_FILES['file1']['type']     = $_FILES['foto']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['foto']['error'];
				$_FILES['file1']['size']     = $_FILES['foto']['size'];

				$uploadPath = './image/galeri/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '1024';

				$config['file_name'] = 'foto tanggal '.$date;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1') == true){
					$data_upload = $this->upload->data();
					if ($FotoLama != '') {
						unlink("./image/galeri/".$FotoLama);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/galeri/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/galeri/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$InsertData['foto'] = $data_upload['file_name'];

					$Insert  = $this->Galeri_models->UpdateFoto($InsertData,$idData);
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil Mengubah Data.!'
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Format Image Salah..!'
					];
				}
			}else{
				$InsertData = [
					'kategori_dokumentasi'	=>$ktg,
					'keterangan'			=>$keterangan,
					'tanggal'				=>$datet,	
				];
				$Insert  = $this->Galeri_models->UpdateFoto($InsertData,$idData);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil'
				];
			}

		}else{
			$InsertData = [
				'kategori_dokumentasi'	=>$ktg,
				'keterangan'			=>$keterangan,
				'tanggal'				=>$datet,	
			];
			$Insert  = $this->Galeri_models->UpdateFoto($InsertData,$idData);
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil'
			];
		}
		echo json_encode($respone);
	}


}
