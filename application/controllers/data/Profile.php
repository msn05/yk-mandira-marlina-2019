<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}


	public function simpanPerubahanDataAkun()
	{

		$this->load->library('form_validation');
		// $this->form_validation->set_rules('PL','PL', 'required|trim');
		$this->form_validation->set_rules('PB','PB', 'required|trim');
		$this->form_validation->set_rules('KPB','KPB', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong...!',
			];

		}else{
			$id				= $this->input->post('id');
			$Uname			= $this->input->post('username');
			$PasswordLama	= $this->input->post('PL');
			$PasswordBaru 	= $this->input->post('PB');
			$PasswordBaruKonf = $this->input->post('KPB');

			//Cek Username Lama 
			$Cek 									= $this->Pengguna_models->DataUbah($id)->row_array();
			$UsernameLama = $Cek['id_akses'];

			if ($Uname != $UsernameLama) {

				$CekLagi 					= $this->Pengguna_models->Login($Uname);

				if ($CekLagi->num_rows() > 0) {
					$respone = [
						'status' => 'error',
						'message'=> 'Username Sudah Ada ...!'
					];
				}else{

					if ($PasswordBaru == $PasswordBaruKonf) {
						
						if (!empty($password)) {

							if (password_verify($PasswordLama,$Cek['password'])) {

								$UpdateStatus =[
								// 'username'  => $Uname,
									'password'  => password_hash($PasswordBaru,PASSWORD_DEFAULT)
								];

								$res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatus);
								$respone = [
									'status' => 'success',
									'message'=> 'Berhasil Mengubah Data...!'
								];

							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Password Lama Salah...!'
								];
							}
						}else{
							$UpdateStatus =[
								// 'username'  => $Uname,
								'password'  => password_hash($PasswordBaru,PASSWORD_DEFAULT)
							];

							$res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatus);
							$respone = [
								'status' => 'success',
								'message'=> 'Berhasil Mengubah Data...!'
							];
						}						

					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Password Baru dan Password Baru Konfirmasi Tidak Sama...!'
						];

					}

				}

			}else{

				if ($PasswordBaru == $PasswordBaruKonf) {

					if (password_verify($PasswordLama,$Cek['password'])) {
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil...!'
						];

					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Password Lama Salah...!'
						];
					}						

				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Password Baru dan Password Baru Konfirmasi Tidak Sama...!'
					];

				}

			}


		}
		echo json_encode($respone);
	}


	public function UploadDokumen()
	{

		$id 									= $this->input->post('id');
		$CekData					= $this->Pengguna_models->IdData($id)->row_array();
		$NamaLengkap = $CekData['nama_lengkap'];
		$FotoLama 			= $CekData['foto'];
		$FotoKTP 				= $CekData['ktp'];
		$KKNya 						= $CekData['kk'];
		$Pasport 				= $CekData['pasport'];
		$BukuNikah 		= $CekData['buku_nikah'];

		if ($CekData != NULL) {
			if([!empty($_FILES['foto']['name']) && ($_FILES['ktp']['name']) && ($_FILES['Pasport']['name']) && ($_FILES['kk']['name']) && ($_FILES['buku_nikah']['name'])]){
				$_FILES['file1']['name']     = $_FILES['foto']['name'];
				$_FILES['file1']['type']     = $_FILES['foto']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['foto']['error'];
				$_FILES['file1']['size']     = $_FILES['foto']['size'];

				$_FILES['file2']['name']     = $_FILES['ktp']['name'];
				$_FILES['file2']['type']     = $_FILES['ktp']['type'];
				$_FILES['file2']['tmp_name'] = $_FILES['ktp']['tmp_name'];
				$_FILES['file2']['error']    = $_FILES['ktp']['error'];
				$_FILES['file2']['size']     = $_FILES['ktp']['size'];

				$_FILES['file3']['name']     = $_FILES['kk']['name'];
				$_FILES['file3']['type']     = $_FILES['kk']['type'];
				$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
				$_FILES['file3']['error']    = $_FILES['kk']['error'];
				$_FILES['file3']['size']     = $_FILES['kk']['size'];

				$_FILES['file4']['name']     = $_FILES['Pasport']['name'];
				$_FILES['file4']['type']     = $_FILES['Pasport']['type'];
				$_FILES['file4']['tmp_name'] = $_FILES['Pasport']['tmp_name'];
				$_FILES['file4']['error']    = $_FILES['Pasport']['error'];
				$_FILES['file4']['size']     = $_FILES['Pasport']['size'];

				$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
				$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
				$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
				$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
				$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];


				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file5')){
					$data_upload = $this->upload->data();
					if ($BukuNikah != '') {
						unlink("./image/dokumen/".$BukuNikah);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;

					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['buku_nikah'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '1024';
				$config['file_name'] = 'foto '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1')){
					$data_upload = $this->upload->data();
					if ($FotoLama != 'default.png') {
						unlink("./image/dokumen/".$FotoLama);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['foto'] = $data_upload['file_name'];

				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KTP '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file2')){
					$data_upload = $this->upload->data();
					if ($FotoKTP != '') {
						unlink("./image/dokumen/".$FotoKTP);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['ktp'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KK '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){
					$data_upload = $this->upload->data();
					if ($KKNya != '') {
						unlink("./image/dokumen/".$KKNya);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['kk'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Pasport '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file4')){
					$data_upload = $this->upload->data();
					if ($Pasport != '') {
						unlink("./image/dokumen/".$Pasport);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['Pasport'] = $data_upload['file_name'];
				}
				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!'
				];

			}elseif(!empty($_FILES['foto']['name'])){

				$_FILES['file2']['name']     = $_FILES['ktp']['name'];
				$_FILES['file2']['type']     = $_FILES['ktp']['type'];
				$_FILES['file2']['tmp_name'] = $_FILES['ktp']['tmp_name'];
				$_FILES['file2']['error']    = $_FILES['ktp']['error'];
				$_FILES['file2']['size']     = $_FILES['ktp']['size'];

				$_FILES['file3']['name']     = $_FILES['kk']['name'];
				$_FILES['file3']['type']     = $_FILES['kk']['type'];
				$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
				$_FILES['file3']['error']    = $_FILES['kk']['error'];
				$_FILES['file3']['size']     = $_FILES['kk']['size'];

				$_FILES['file4']['name']     = $_FILES['Pasport']['name'];
				$_FILES['file4']['type']     = $_FILES['Pasport']['type'];
				$_FILES['file4']['tmp_name'] = $_FILES['Pasport']['tmp_name'];
				$_FILES['file4']['error']    = $_FILES['Pasport']['error'];
				$_FILES['file4']['size']     = $_FILES['Pasport']['size'];

				$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
				$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
				$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
				$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
				$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file5')){
					$data_upload = $this->upload->data();
					if ($BukuNikah != '') {
						unlink("./image/dokumen/".$BukuNikah);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['buku_nikah'] = $data_upload['file_name'];

				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KTP '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file2')){
					$data_upload = $this->upload->data();
					if ($FotoKTP != '') {
						unlink("./image/dokumen/".$FotoKTP);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['ktp'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KK '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){
					$data_upload = $this->upload->data();
					if ($KKNya != '') {
						unlink("./image/dokumen/".$KKNya);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['kk'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Pasport '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file4')){
					$data_upload = $this->upload->data();
					if ($Pasport != '') {
						unlink("./image/dokumen/".$Pasport);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['Pasport'] = $data_upload['file_name'];
				}
				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!'
				];
			}elseif(!empty($_FILES['foto']['name']) && ($_FILES['ktp']['name'])){
				$_FILES['file3']['name']     = $_FILES['kk']['name'];
				$_FILES['file3']['type']     = $_FILES['kk']['type'];
				$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
				$_FILES['file3']['error']    = $_FILES['kk']['error'];
				$_FILES['file3']['size']     = $_FILES['kk']['size'];

				$_FILES['file4']['name']     = $_FILES['Pasport']['name'];
				$_FILES['file4']['type']     = $_FILES['Pasport']['type'];
				$_FILES['file4']['tmp_name'] = $_FILES['Pasport']['tmp_name'];
				$_FILES['file4']['error']    = $_FILES['Pasport']['error'];
				$_FILES['file4']['size']     = $_FILES['Pasport']['size'];

				$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
				$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
				$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
				$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
				$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file5')){
					$data_upload = $this->upload->data();
					if ($BukuNikah != '') {
						unlink("./image/dokumen/".$BukuNikah);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['buku_nikah'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KK '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){
					$data_upload = $this->upload->data();
					if ($KKNya != '') {
						unlink("./image/dokumen/".$KKNya);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['kk'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Pasport '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file4')){
					$data_upload = $this->upload->data();
					if ($Pasport != '') {
						unlink("./image/dokumen/".$Pasport);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['Pasport'] = $data_upload['file_name'];
				}
				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!'
				];
			}elseif([!empty($_FILES['foto']['name']) && ($_FILES['ktp']['name']) && ($_FILES['Pasport']['name'])]){

				$_FILES['file3']['name']     = $_FILES['kk']['name'];
				$_FILES['file3']['type']     = $_FILES['kk']['type'];
				$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
				$_FILES['file3']['error']    = $_FILES['kk']['error'];
				$_FILES['file3']['size']     = $_FILES['kk']['size'];

				$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
				$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
				$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
				$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
				$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file5')){
					$data_upload = $this->upload->data();
					if ($BukuNikah != '') {
						unlink("./image/dokumen/".$BukuNikah);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['buku_nikah'] = $data_upload['file_name'];
				}

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'KK '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file3')){
					$data_upload = $this->upload->data();
					if ($KKNya != '') {
						unlink("./image/dokumen/".$KKNya);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['kk'] = $data_upload['file_name'];
				}

				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!'
				];

			}elseif([!empty($_FILES['foto']['name']) && ($_FILES['ktp']['name']) && ($_FILES['Pasport']['name']) && ($_FILES['kk']['name'])]){

				$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
				$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
				$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
				$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
				$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];

				$uploadPath = './image/dokumen/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file5')){
					$data_upload = $this->upload->data();
					if ($BukuNikah != '') {
						unlink("./image/dokumen/".$BukuNikah);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/dokumen/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/dokumen/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['buku_nikah'] = $data_upload['file_name'];
				}

				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!'
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data Anda Tidak Ada.!'
			];
		}

		echo json_encode($respone);
	}

	public function simpanPerubahanDataAkunLanjnutan()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaLengkap','NamaLengkap', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|trim');
		$this->form_validation->set_rules('nomorDarurat','NomorDarurat', 'required|trim');
		$this->form_validation->set_rules('nomor','Nomor', 'required|trim');
		$this->form_validation->set_rules('nomorWA','NomorWA', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		$this->form_validation->set_rules('TanggalLahir','TanggalLahir', 'required|trim');
		$this->form_validation->set_rules('TempatLahir','TempatLahir', 'required|trim');

		if($this->form_validation->run() == false){

			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan Ubah Data...!',
			];

		}else{

			$CK							= $this->input->post('id');
			$id							= $this->input->post('idNya');
			$namaLengkap		= $this->input->post('namaLengkap');
			$nomor					= $this->input->post('nomor');
			$nomorWA 				= $this->input->post('nomorWA');
			$email 					= $this->input->post('email');
			$nomorDarurat 					= $this->input->post('nomorDarurat');
			$alamat 				= $this->input->post('alamat');
			$TanggalLahir 	= $this->input->post('TanggalLahir');
			$TempatLahir 		= $this->input->post('TempatLahir');


			$Cek 						= $this->Pengguna_models->DataLengkap($id)->row_array();
			$nomorTelephone 			= $Cek['nomor_telephone'];
			$nomorWAnya 				= $Cek['nomor_wa'];
			// $EmailNya 				= $Cek['email'];
			// $CekEmail 				  $this->Pengguna_models->Email($email);	

			if (empty($nomor) && empty($nomorWa) && empty($nomorDarurat)) {

				$respone = [
					'status' => 'error',
					'message'=> 'Nomor Telephone Kosong...!'
				];

			}else{

				$UpdateStatus =[
					'nama_lengkap'  	=> $namaLengkap,
					'nomor_telephone' => $nomor,
					'nomor_wa'  			=> $nomorWA,
					'alamat'  				=> $alamat,
					'tanggal_lahir'  	=> $TanggalLahir,
					'tempat_lahir'  	=> $TempatLahir,
					'nomor_darurat'  	=> $nomorDarurat,
					'email'  	=> $email,
				];

				$res = $this->Pengguna_models->UpdateStatusLanjutan($CK,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengubah Data...!'
				];

			}
		}

		echo json_encode($respone);
	}

	public function index()
	{

		$data['Perusahaan']             = $this->Perusahaan_models->Tentang();
		$this->template->layout('akun/profile.php',$data);
	}

	public function info($id)
	{
		$data['Perusahaan']   = $this->Perusahaan_models->Tentang();
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataLengkapNya       = $this->Pengguna_models->DataLengkap($id)->row_array();
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['Level']        = $this->session->userdata('id_level');
		$data['id']             = $DataNya['id_akses'];
		$data['nama']           = $DataLengkapNya['nama_lengkap'];
		$data['nomorDarurat']           = $DataLengkapNya['nomor_darurat'];
		$data['email']           = $DataLengkapNya['email'];
		$data['DataID'] 		= $DataLengkapNya['id_akses'];
		$IdFileData 			= $DataLengkapNya['id_file_identitas'];
		$DokumenNya       		= $this->Pengguna_models->Dokumen($IdFileData)->row_array();
		$data['IdFile']			= $DokumenNya['id_file_identitas'];
		$data['ktp']			= $DokumenNya['ktp'];
		$data['kk']				= $DokumenNya['kk'];
		$data['buku_nikah']		= $DokumenNya['buku_nikah'];
		$data['pasport']		= $DokumenNya['pasport'];
		$data['foto']			= $DokumenNya['foto'];
		$data['alert']				= '<div class="form-group col-sm-12">
		<div  class="kosong alert alert-danger alert-dismissable">
		Data Anda Tidak Punya Ya....!Silakan Hubungi Administrator..!</div></div>';
		$data['alertDokumen']				= '<div class="form-group col-sm-12">
		<div  class="kosong alert alert-danger alert-dismissable">
		Tidak Ada Dokumen yang di berikan kepada perusahaan..!</div></div>';

		$data['DataAkses'] 		= $DataLengkapNya['id_data_akses'];
		$data['NamaLengkap'] 	= $DataLengkapNya['nama_lengkap'];
		$data['Nomor'] 				= $DataLengkapNya['nomor_telephone'];
		$data['nomorWA'] 			= $DataLengkapNya['nomor_wa'];
		$data['Email'] 				= $DataLengkapNya['email'];
		$data['Alamat'] 			= $DataLengkapNya['alamat'];
		$data['TanggalLahir'] = $DataLengkapNya['tanggal_lahir'];
		$data['TempatLahir'] 	= $DataLengkapNya['tempat_lahir'];

		$data['idNya']          = $DataNya['id_akses'];
		$data['id_level']       = $DataNya['id_level'];
		$dataLevel       		= $DataNya['id_level'];
		// $data['nama']       	= $DataNya['username'];
		$data['Login']          = $DataNya['login'];
		$data['Out']           	= $DataNya['logout'];
		$data['Status']         = $DataNya['status_users'];
		$data['NamaLevel']      = $this->Menu_models->Akses()->row();
		$query = $this->db->select("id_level,nama_level")->get_where("db_level",array('id_level'=>$dataLevel))->row_array();
		$data['NamaLevelNya'] 			= $query['nama_level'];
		$this->template->layout('akun/info.php',$data);
	}
}