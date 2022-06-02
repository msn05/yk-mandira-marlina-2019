<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pelanggan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model([
			'Perusahaan_models',
			'Menu_models',
			'Pengguna_models']);
		$this->load->library('template');
		False();

	}

	public function form()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			redirect('Login/index.php');

		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['idAkses']		= rand(1000,99999);
			$data['headerMenu']		= 'Form Tambah Pelanggan';
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       = $DataNya['id_level'];

			$this->template->layout('pelanggan/umroh/form.php',$data);
		}
	}
	public function FileDokumen()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			redirect('Login/index.php');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['headerMenu']		= 'Form Ubah Pelanggan';
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       = $DataNya['id_level'];

			$idData = $this->input->get('idData');
			if ($idData != '') {
				$id 			= base64_decode($idData);
				$data['idFile'] =$id;
				$data['DataFile']	= $this->Pengguna_models->idPelanggan($id)->row_array();
				$this->template->layout('pelanggan/umroh/file.php',$data);
			}else{
				redirect('error/ErrorData');
			}
		}
	}
	public function cariPelanggan()
	{
		$Kode 		=$this->input->post('pelanggan');
		$data['pelangganNya']	= $this->Pengguna_models->DataShow($Kode)->row_array();
		$this->load->view('Pelanggan/data.php',$data);
	}

	public function UbahPelanggan()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			redirect('Login/index.php');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       = $DataNya['id_level'];

			if ($this->input->get('kodePelangganId') != NULL) {
				$Kode 											= base64_decode($this->input->get('kodePelangganId'));
				$KodeUbah 					= $this->Pengguna_models->DataShow($Kode)->row_array();
				$data['KeteranganData'] 							= $this->input->get('Keterangan');
				$data['DataPelangganId'] 						= $KodeUbah['id'];
				$data['kode']																		= $KodeUbah['id_akses_data'];
				$data['no_ktp']																		= $KodeUbah['no_ktp'];
				$data['nama_lengkap']																		= $KodeUbah['nama_lengkap'];
				$data['no_kk']																		= $KodeUbah['no_kk'];
				$data['emails']																		= $KodeUbah['emails'];
				$data['nomor_telphone']																		= $KodeUbah['nomor_telphone'];
				$data['nomor_wa']																		= $KodeUbah['nomor_wa'];
				$data['alamat']																		= $KodeUbah['alamat'];
				$data['tempat_lahir']																		= $KodeUbah['tempat_lahir'];
				$data['tanggal_lahir']																		= $KodeUbah['tanggal_lahir'];
				$data['jenis_kelamin']																		= $KodeUbah['jenis_kelamin'];
				$data['pekerjaan']																		= $KodeUbah['pekerjaan'];
				$data['ahli_hakim_id']																		= $KodeUbah['ahli_hakim_id'];
				$data['status_data_keluarga']																		= $KodeUbah['status_data_keluarga'];
				$IdFileData									 = $KodeUbah['id_file_dokumen'];
				$File 															= $this->Pengguna_models->Dokumen($IdFileData)->row_array();
				$data['Foto'] 															= $File['foto'];
				$data['pasport'] 															= $File['pasport'];
				$data['buku_nikah'] 															= $File['buku_nikah'];
				$data['kk'] 																	= $File['kk'];
				$data['ktp'] 																= $File['ktp'];
				$data['headerMenu']		= 'Form Ubah Pelanggan';
				$this->template->layout('pelanggan/umroh/ubah.php',$data);
			}
		}
	}

	public function index()
	{
		$id 					= $this->session->userdata('id_akses');
		$Level 					= $this->session->userdata('id_level');
		if ($id == NULL ) {
			redirect('Login/index.php');
		}else{
			if ([$Level == '1' || $Level == '3']) {
				$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
				$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
				$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
				$data['nama']           = $DataNSiswa['nama_lengkap'];
				$data['id']             = $DataNya['id_akses'];
				$data['Level']       = $DataNya['id_level'];
				$this->template->layout('pelanggan/umroh/index.php',$data);
			}else{
				redirect('Error/AksesError.php');
			}
		}
	}

	public function UploadDokumen()
	{
		$this->load->library('form_validation');
		if (empty($_FILES['foto']['name']) && empty($_FILES['kk']['name']) && empty($_FILES['ktp']['name'])) {
			$this->form_validation->set_rules('foto','Foto', 'required');
			$this->form_validation->set_rules('kk','Kk', 'required');
			$this->form_validation->set_rules('ktp','Ktp', 'required');
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Foto, KTP, KK Tidak Boleh Kosong..!'
			];
		}else{
			$id 						= $this->input->post('id');
			$CekData					= $this->Pengguna_models->idPelanggan($id)->row_array();
			if ($CekData != NULL) {
				$NamaLengkap 		= $CekData['nama_lengkap'];
				$FotoLama 			= $CekData['foto'];
				$FotoKTP 			= $CekData['ktp'];
				$KKNya 				= $CekData['kk'];
				$Pasport 			= $CekData['pasport'];
				$BukuNikah 			= $CekData['buku_nikah'];
				if(empty($_FILES['buku_nikah']['name']) && empty($_FILES['Pasport']['name'])){
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

					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'png|jpg|jpeg';
					$config['max_size'] = '1024';
					$config['file_name'] = 'foto '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file1')){
						$data_upload = $this->upload->data();
						if ($FotoLama != 'default.png') {
							unlink("./image/pelanggan/".$FotoLama);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 600;
						$config['height']= 400;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['foto'] = $data_upload['file_name'];
					}
					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'KTP '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file2')){
						$data_upload = $this->upload->data();
						if ($FotoKTP) {
							unlink("./image/pelanggan/".$FotoKTP);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['ktp'] = $data_upload['file_name'];
					}

					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'KK '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file3')){
						$data_upload = $this->upload->data();
						if ($KKNya != '') {
							unlink("./image/pelanggan/".$KKNya);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['kk'] = $data_upload['file_name'];
					}

					$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil Mengupdate Foto.!'
					];

				}else{
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


					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'Buku Nikah '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file5')){
						$data_upload = $this->upload->data();
						if ($BukuNikah != '') {
							unlink("./image/pelanggan/".$BukuNikah);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['buku_nikah'] = $data_upload['file_name'];
					}

					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'png|jpg|jpeg';
					$config['max_size'] = '1024';
					$config['file_name'] = 'foto '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file1')){
						$data_upload = $this->upload->data();
						if ($FotoLama != 'default.png') {
							unlink("./image/pelanggan/".$FotoLama);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['foto'] = $data_upload['file_name'];
					}
					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'KTP '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file2')){
						$data_upload = $this->upload->data();
						if ($FotoKTP != '') {
							unlink("./image/pelanggan/".$FotoKTP);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['ktp'] = $data_upload['file_name'];
					}

					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'KK '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file3')){
						$data_upload = $this->upload->data();
						if ($KKNya != '') {
							unlink("./image/pelanggan/".$KKNya);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['kk'] = $data_upload['file_name'];
					}

					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'Pasport '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file4')){
						$data_upload = $this->upload->data();
						if ($Pasport != '') {
							unlink("./image/pelanggan/".$Pasport);
						}
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['Pasport'] = $data_upload['file_name'];
					}
					$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil Mengupdate Foto.!'
					];
				}

			}
		}

		echo json_encode($respone);
	}


	public function UploadDokumenJPG()
	{


		if (empty($_FILES['foto']['name']) ) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Tidak Boleh Kosong..!'
			];
		}else{
			$id 	= $this->input->post('id');
			$ids 	= $this->input->post('dds');
			$CekData					= $this->Pengguna_models->idPelanggan($id)->row_array();
			if ($CekData != NULL) {
				$NamaLengkap 		= $CekData['nama_lengkap'];
				$FotoLama 			= $CekData['foto'];
				
				$_FILES['file1']['name']     = $_FILES['foto']['name'];
				$_FILES['file1']['type']     = $_FILES['foto']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['foto']['error'];
				$_FILES['file1']['size']     = $_FILES['foto']['size'];

				$uploadPath = './image/pelanggan/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '1024';
				$config['file_name'] = $ids.'_'.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1')){
					$data_upload = $this->upload->data();
					if ($FotoLama != NULL) {
						unlink("./image/pelanggan/".$FotoLama);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 600;
					$config['height']= 400;
					$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['foto'] = $data_upload['file_name'];
				}
				
				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!',
					'kode'	=> base64_encode($id)
				];

			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal.!'
				];
			}

		}

		echo json_encode($respone);
	}


	public function UploadDokumenPDF()
	{

		if (empty($_FILES['foto']['name']) ) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Tidak Boleh Kosong..!'
			];
		}else{
			$ids 	= $this->input->post('dds');
			$id 	= $this->input->post('id');
			$idd 	= $this->input->post('idd');
			$CekData					= $this->Pengguna_models->idPelanggan($id)->row_array();
			if ($CekData != NULL) {
				$NamaLengkap 		= $CekData['nama_lengkap'];
				$ktp 			= $CekData['ktp'];
				$kk 			= $CekData['kk'];
				$buku_nikah 			= $CekData['buku_nikah'];
				$pasport 			= $CekData['pasport'];

				$_FILES['file1']['name']     = $_FILES['foto']['name'];
				$_FILES['file1']['type']     = $_FILES['foto']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['foto']['error'];
				$_FILES['file1']['size']     = $_FILES['foto']['size'];

				$uploadPath = './image/pelanggan/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = $ids.'_'.$NamaLengkap;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1')){
					$data_upload = $this->upload->data();
					if ($idd != '') {
						unlink("./image/pelanggan/".$idd);
					}
					$config['image_library']='gd2';
					$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus[$ids] = $data_upload['file_name'];
				}

				$Insert		= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Mengupdate Foto.!',
					'kode'	=> base64_encode($id)
				];

			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal.!'
				];
			}

		}

		echo json_encode($respone);
	}



	public function data()
	{
		$draw 	= intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order 	= $this->input->post("order");
		$search	= $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if(!empty($order))
		{
			foreach($order as $o)
			{
				$col = $o['column'];
				$dir= $o['dir'];
			}
		}

		if($dir != "asc" && $dir != "desc")
		{
			$dir = "asc";
		}


		$valid_columns = array(
			0=>'id',
			1=>'nama_lengkap',
			2=>'no_ktp',
			3=>'nomor_wa',
			4=>'tgl_daftar',
			5=>'id_file_dokumen',
			6=>'',
		);
		if(!isset($valid_columns[$col]))
		{
			$order = null;
		}
		else
		{
			$order = $valid_columns[$col];
		}
		if($order !=null)
		{
			$this->db->order_by($order, $dir);
		}

		if(!empty($search))
		{
			$x=0;
			foreach($valid_columns as $sterm)
			{
				if($x==0)
				{
					$this->db->like($sterm,$search);
				}
				else
				{
					$this->db->or_like($sterm,$search);
				}
				$x++;
			}                 
		}
		$this->db->limit($length,$start);
		$Menus = $this->Pengguna_models->DataPelanggan();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$LevelData       = $this->session->userdata('id_level');
			$X 	= "+62".format_phone_us($rows->nomor_wa);
			$id 			= $rows->id;
			$data[]= array(
				$no++,
				$rows->nama_lengkap,
				'<a href=		"./Pelanggan/UbahPelanggan?kodePelangganId='.base64_encode($id).'&Keterangan=Info">'.
				strtoupper($rows->no_ktp).'</a>',
				$rows->nomor_wa != '' ? "<a href='https://web.whatsapp.com/send?phone=".$X."' target='_blank'>+62".format_phone_us($rows->nomor_wa)."</a>" : "Tidak Ada",
				$rows->tgl_daftar,
				$rows->id_file_dokumen != NULL ? '<a href="./Pelanggan/FileDokumen?idData='.base64_encode($rows->id_file_dokumen).'">'.
				$rows->id_file_dokumen.'</a>' : '',
				$LevelData == 3 || $LevelData == 1 ? 
				'<a href=
				"./Pelanggan/UbahPelanggan?kodePelangganId='.base64_encode($id).'&Keterangan=Ubah"  type="button" class="editData fa fa-edit" title="Edit Data" ></a> '
				: '',
			);    
			// <a type="button" id="'.$id.'" nama="'.$rows->nama_lengkap.'" 	class=" Hapus fa fa-trash-o" title="Salah..!"></a>
		}

		$TotalNya = $this->TotalNya();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $TotalNya,
			"recordsFiltered" => $TotalNya,
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

	public function TotalNya()
	{
		$query = $this->db->select("COUNT(*) as num")->get("tb_pelanggan");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

	public function UploadFile()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			redirect('Login/index.php');

		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']           = $DataNya['id_level'];
			// $data['idAkses']		= rand(1000,99999);
			$data['id']             = $DataNya['id_akses'];
			if ($this->input->get('idFile') != NULL) {
				$data['headerMenu']		= 	' Pelanggan';
				$idFile	=base64_decode($this->input->get('idFile'));
				$data['idFile']		= $idFile;
				$this->template->layout('pelanggan/umroh/uploadFile.php',$data);
			}
		}
	}

	public function UploadFileUbahFile()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			redirect('Login/index.php');

		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']           = $DataNya['id_level'];
			// $data['idAkses']		= rand(1000,99999);
			$data['id']             = $DataNya['id_akses'];
			if ($this->input->get('idFile') != NULL) {
				$data['headerMenu']		= 	' Pelanggan';
				$idFile					=base64_decode($this->input->get('idFile'));
				$Type					=$this->input->get('Note');
				$FileT					=$this->input->get('ids');
				$File					=base64_decode($this->input->get('File'));
				$data['idFile']		= $idFile;
				$data['File']		= $File;
				$data['Note']		= $Type;
				$data['Notes']		= $FileT;
				$this->template->layout('pelanggan/umroh/uploadFileUbah.php',$data);
			}
		}
	}

	public function simpanData()
	{
		$this->load->library('form_validation');


		$this->form_validation->set_rules('id','Id', 'required|trim');
		$this->form_validation->set_rules('namaLengkap','namaLengkap', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|trim|valid_emails');
		$this->form_validation->set_rules('no_ktp','No_ktp', 'required|trim|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('no_kk','No_kk', 'required|trim|min_length[16]|max_length[16]');

		$this->form_validation->set_rules('jks','Jks', 'required|trim');
		$this->form_validation->set_rules('no_telp','No_telp', 'required|trim|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('nowat','Nowat', 'required|trim|min_length[10]|max_length[15]');

		$this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		// $this->form_validation->set_rules('tanggallahir','tanggallahir', 'required|trim');
		$this->form_validation->set_rules('pks','Pks', 'required|trim');
		$this->form_validation->set_rules('whk','Whk', 'required|trim');
		$this->form_validation->set_rules('pksd','Pksd', 'required|trim');


		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong / Format Salah...!',
			];
		}else{
			$id    = $this->input->post('id');
			$namaLengkap  = $this->input->post('namaLengkap');
			$email    = $this->input->post('email');
			$no_ktp   = $this->input->post('no_ktp');
			$no_kk    = $this->input->post('no_kk');
			$no_telp   = $this->input->post('no_telp');
			// $aksesNya   = $this->input->post('aksesNya');
			$tanggalLahir  = $this->input->post('tanggallahir');
			$tempatLahir  = $this->input->post('tempatLahir');
			$alamat   = $this->input->post('alamat');
			$nowat    = $this->input->post('nowat');
			$pks    = $this->input->post('pks');
			$jks    = $this->input->post('jks');
			$whk    = $this->input->post('whk');
			$pksd    = $this->input->post('pksd');
			$rand    = rand(1000,999999);
			$dateTime    = date('Y-m-d');
			$password = '123456';
			$password_hash = password_hash($password,PASSWORD_DEFAULT);

			if (!empty($email) && !empty($namaLengkap) && !empty($no_ktp) && !empty($no_kk) && !empty($no_telp) && !empty($tanggalLahir) && !empty($nowat) && !empty($pks) && !empty($jks) && !empty($whk) &&  !empty($pksd) ){

				$CekEmailData = $this->Pengguna_models->Emails($email)->num_rows();
				if ($CekEmailData > 0 ) {
					$respone = [
						'status'  => 'error',
						'message'  => 'Email Sudah Ada...!',
					];
				}else{
					$CekNomorTelphoneData = $this->Pengguna_models->NomorTelphones($no_telp)->num_rows();
					if ($CekNomorTelphoneData > 0) {
						$respone = [
							'status'  => 'error',
							'message'  => 'Nomor Telphone Sudah Ada...!',
						];
					}else{
						if ([alpha($namaLengkap) && alpha($tempatLahir) && alpha($whk)] === false ) {
							$respone = [
								'status'  => 'error',
								'message'  => 'Hanya Huruf..!',
							];

						}else{
							if ([numeric($nowat) && numeric($no_telp) && numeric($no_ktp) && numeric($no_kk)] == false ) {
								$respone = [
									'status'  => 'error',
									'message'  => 'Harus Angka ya..!',
								];
							}else{
								if ([$nowat && $no_telp] <= 10) {
									$respone = [
										'status'  => 'error',
										'message'  => 'Minimal 11 huruf ya..!',
									];

								}else{
									if ([$no_ktp && $no_kk] <= 15) {
										$respone = [
											'status'  => 'error',
											'message'  => 'Min 16 huruf ya..!',
										];

									}else{

										$UpdateStatus = [
											'id_akses' => $id,
											'password'  => $password_hash,
											'status_users' => 1,
											'id_level'   => 2,
										];

										$PostData2 = [
											'id_akses_data'  => $id,
											'nama_lengkap' =>$namaLengkap,
											'no_ktp' => $no_ktp,
											'no_kk' => $no_kk,
											'nomor_telphone' => $no_telp,
											'nomor_wa'  => $nowat,
											'emails'  => $email,
											'alamat' => $alamat,
											'tanggal_lahir' => $tanggalLahir,
											'tempat_lahir' => $tempatLahir,
											'jenis_kelamin' => $jks,
											'pekerjaan' => $pks,
											'ahli_hakim_id' => $whk,
											'status_data_keluarga' => $pksd,
											'id_file_dokumen'						=>$rand,
											'tgl_daftar'						=>$dateTime,
										];
										$dataFile = [
											'id_file_identitas'=>$rand,
										];

										$Insert = $this->Pengguna_models->InsertData($UpdateStatus);
										if ($Insert == true) {
											$InsertLagi2 = $this->Pengguna_models->InsertDataLagiNahs($dataFile);
											$InsertLagi = $this->Pengguna_models->InsertDataLagis($PostData2);
											$respone = [
												'status'  => 'success',
												'message'  => 'Berhasil Menambahkan Data..!',
												'kode'					=> base64_encode($rand),
											];
										}else{
											$respone = [
												'status'  => 'error',
												'message'  => 'Gagal Menambahkan Data..!',
											];
										}
									}
								}
							}
						}
					}
				}
			}else{
				$respone = [
					'status'  => 'error',
					'message'  => 'Terjadi Kesalahan...!'
				];
			}
		}
		echo json_encode($respone);
	}

	public function UpdatePelanggan()
	{
		$this->load->library('form_validation');


		$this->form_validation->set_rules('id','Id', 'required|trim');
		$this->form_validation->set_rules('namaLengkap','namaLengkap', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|trim|valid_emails');
		$this->form_validation->set_rules('no_ktp','No_ktp', 'required|trim');
		$this->form_validation->set_rules('no_kk','No_kk', 'required|trim');

		$this->form_validation->set_rules('jks','Jks', 'required|trim');
		$this->form_validation->set_rules('no_telp','No_telp', 'required|trim');
		$this->form_validation->set_rules('nowat','Nowat', 'required|trim');

		$this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		// $this->form_validation->set_rules('tanggallahir','tanggallahir', 'required|trim');
		$this->form_validation->set_rules('pks','Pks', 'required|trim');
		$this->form_validation->set_rules('whk','Whk', 'required|trim');
		$this->form_validation->set_rules('pksd','Pksd', 'required|trim');


		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong...!',
			];

		}else{
			$idPost    							= $this->input->post('idPost');
			$id    							= $this->input->post('id');
			$namaLengkap  = $this->input->post('namaLengkap');
			$email    				= $this->input->post('email');
			$no_ktp   				= $this->input->post('no_ktp');
			$no_kk    				= $this->input->post('no_kk');
			$no_telp   			= $this->input->post('no_telp');
			// $aksesNya   		= $this->input->post('aksesNya');
			$tanggalLahir = $this->input->post('tanggallahir');
			$tempatLahir  = $this->input->post('tempatLahir');
			$alamat   				= $this->input->post('alamat');
			$nowat    				= $this->input->post('nowat');
			$pks    						= $this->input->post('pks');
			$jks    						= $this->input->post('jks');
			$whk    						= $this->input->post('whk');
			$pksd    					= $this->input->post('pksd');

			if (!empty($email) && !empty($namaLengkap) && !empty($no_ktp) && !empty($no_kk) && !empty($no_telp) && !empty($tanggalLahir) && !empty($nowat) && !empty($pks) && !empty($jks) && !empty($whk) &&  !empty($pksd) ){

				$CekEmailData = $this->Pengguna_models->Emails($email)->num_rows();
				if ($CekEmailData > 1 ) {
					$respone = [
						'status'  => 'error',
						'message'  => 'Email Sudah Ada...!',
					];
				}else{
					$CekNomorTelphoneData = $this->Pengguna_models->NomorTelphones($no_telp)->num_rows();
					if ($CekNomorTelphoneData > 1) {
						$respone = [
							'status'  => 'error',
							'message'  => 'Nomor Telphone Sudah Ada...!',
						];
					}else{
						if ([alpha($namaLengkap) && alpha($tempatLahir) && alpha($whk)] === false ) {
							$respone = [
								'status'  => 'error',
								'message'  => 'Hanya Huruf..!',
							];

						}else{
							if ([numeric($nowat) && numeric($no_telp) && numeric($no_ktp) && numeric($no_kk)] == false ) {
								$respone = [
									'status'  => 'error',
									'message'  => 'Harus Angka ya..!',
								];
							}else{
								if ([$nowat && $no_telp] <= 10) {
									$respone = [
										'status'  => 'error',
										'message'  => 'Minimal 11 huruf ya..!',
									];

								}else{
									if ([$no_ktp && $no_kk] <= 15) {
										$respone = [
											'status'  => 'error',
											'message'  => 'Min 16 huruf ya..!',
										];

									}else{

										$PostData2 = [
											'nama_lengkap' =>$namaLengkap,
											'no_ktp' => $no_ktp,
											'no_kk' => $no_kk,
											'nomor_telphone' => $no_telp,
											'nomor_wa'  => $nowat,
											'emails'  => $email,
											'alamat' => $alamat,
											'tanggal_lahir' => $tanggalLahir,
											'tempat_lahir' => $tempatLahir,
											'jenis_kelamin' => $jks,
											'pekerjaan' => $pks,
											'ahli_hakim_id' => $whk,
											'status_data_keluarga' => $pksd,
										];

										$InsertLagi = $this->Pengguna_models->UpdateDataLagis($PostData2,$idPost);
										if ($InsertLagi == true) {
											$respone = [
												'status'  => 'success',
												'message'  => 'Berhasil Mengubah Data..!',
											];
										}else{
											$respone = [
												'status'  => 'error',
												'message'  => 'Gagal Mengubah Data..!',
											];
										}
									}
								}
							}
						}
					}
				}
			}else{
				$respone = [
					'status'  => 'error',
					'message'  => 'Terjadi Kesalahan...!'
				];
			}
		}
		echo json_encode($respone);
	}

}
