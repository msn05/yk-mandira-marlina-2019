<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class YekaMandira extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}
	public function index()
	{
		$Level 					= $this->session->userdata('id_level');
		if ($Level != 1) {
			redirect('error');
		}
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNyaId             	= $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$data['nama']           = $DataNyaId['nama_lengkap'];
		$this->template->layout('Perusahaan/index.php',$data);
	}


	public function simpanperubahan()
	{

		$id 					= $this->session->userdata('id_level');
		if ($id == 1 || $id == 4) {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email', 'required|trim|valid_emails');
			$this->form_validation->set_rules('level','Level', 'required|trim');
			$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
			$this->form_validation->set_rules('notel','Notel', 'required|trim|numeric|min_length[10]|max_length[16]');
			$this->form_validation->set_rules('alamat','alamat', 'required|trim');
			if($this->form_validation->run() == false){
				
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Format Salah</div>');
				redirect(site_url('data/YekaMandira'));
			}else{

				$username	= $this->input->post('username');
				$level 		= $this->input->post('level');
				$alamat 	= $this->input->post('alamat');
				$notel 		= $this->input->post('notel');
				$nofac 		= $this->input->post('nofac');
				$email 		= $this->input->post('email');
				$noreg 		= $this->input->post('noreg');
				$visi 		= $this->input->post('visi');
				$misi 		= $this->input->post('misi');

				if ($nofac != '') {

					$Insert = [
						'nama_perusahaan'=>$level,
						'alamat'	=>$alamat,
						'no_telphone'	=>$notel,
						'no_fax'	=>$nofac,
						'email'=>$email,
						'nomor_registrasi'=>$noreg,
						'visi'=>$visi,
						'misi'=>$misi,
					];

					
				}else{
					$Insert = [
						'nama_perusahaan'=>$level,
						'alamat'	=>$alamat,
						'no_telphone'	=>$notel,
						'no_fax'	=>NULL,
						'email'=>$email,
						'nomor_registrasi'=>$noreg,
						'visi'=>$visi,
						'misi'=>$misi,
					];
				}
				$DataInsert = $this->Perusahaan_models->ubahdataNya($Insert,$username);
				if ($DataInsert == true) {
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Berhasil</div>');
					redirect(site_url('data/YekaMandira'));
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Gagal</div>');
					redirect(site_url('data/YekaMandira'));
				}
			}
		}else{
			redirect('error');
		}
	}

	public function SimpanSejarah()
	{

		$id 					= $this->session->userdata('id_level');
		if ($id == 1 || $id == 3) {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('sp1','Sp1', 'required');
			if($this->form_validation->run() == false){
				
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Kosong...!</div>');
				redirect(site_url('data/YekaMandira'));
			}else{

				$username	= $this->input->post('username');
				$sp1 		= $this->input->post('sp1');

				if ($username != '') {

					$Insert = [
						'serajarah_perusahaan'=>$sp1,
					];
					$DataInsert = $this->Perusahaan_models->ubahdataNya($Insert,$username);
					if ($DataInsert == true) {
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Berhasil</div>');
						redirect(site_url('data/YekaMandira'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Gagal</div>');
						redirect(site_url('data/YekaMandira'));
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tidak ada Perusahaan..!</div>');
					redirect(site_url('data/YekaMandira'));
				}
			}
		}else{
			redirect('error');
		}
	}



	public function Uploadstruktur()
	{

		$username = $this->input->post('username');
		$CekData					= $this->Perusahaan_models->idFile($username)->row_array();
		$FotoLama =	$CekData['struktur_organisasi'];

		if (!empty($_FILES['foto']['name'])) {

			$_FILES['file1']['name']     = $_FILES['foto']['name'];
			$_FILES['file1']['type']     = $_FILES['foto']['type'];
			$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['file1']['error']    = $_FILES['foto']['error'];
			$_FILES['file1']['size']     = $_FILES['foto']['size'];

			$uploadPath = './image/struktur/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'png';
			$config['max_size'] = '1024';
			$config['file_name'] = 'Struktur_Organisasi ';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file1')){
				$data_upload = $this->upload->data();
				if ($FotoLama != '') {
					unlink("./image/struktur/".$FotoLama);
				}
				$config['image_library']='gd2';
				$config['source_image']='./image/struktur/'.$data_upload['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '50%';
				$config['width']= 800;
				$config['height']= 500;
				$config['new_image']= './image/struktur/'.$data_upload['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$Insert['struktur_organisasi'] = $data_upload['file_name'];

				$Insert		= $this->Perusahaan_models->ubahdataNya($Insert,$username);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil..!'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan..'
				];
			}

		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal..'
			];
		}
		echo json_encode($respone);

	}

}
