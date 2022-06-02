<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bus extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Bus_models','Pengguna_models']);
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
			$this->template->layout('Bus/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}


	public function form()
	{
		$Level       			= $this->session->userdata('id_level');
		if ($Level != 2 || $Level != 4) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']       = $DataNya['id_level'];
			$data['Kode']			= stripslashes(rand(1,99999));
			$this->template->layout('Bus/form.php',$data);
		}else{
			redirect('Error');
		}
	}


	public function Info($IdData)
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 										= $this->session->userdata('id_akses');
		$DataNya             		= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$Bus 										= $this->Bus_models->ShowData($IdData)->row_array();
		$data['keterangan']     = $Bus['keterangan'];
		$data['Level']       = $DataNya['id_level'];

		$this->template->layout('Bus/ShowKeterangan.php',$data);
	}


	public function Ubah($IdData)
	{
		$data['Params']			= $this->input->get('Keterangan');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']       	= $DataNya['id_level'];

		// $data['nama']           = $DataNya['username'];
		$Bus 					= $this->Bus_models->ShowData($IdData)->row_array();
		$data['keterangan']     = $Bus['keterangan'];
		$data['kode']     		= $Bus['id'];
		$data['bus']     		= $Bus['nama_bus'];
		$data['ks']     		= $Bus['kapasitas'];
		$data['idKemitraan']    = $Bus['id_dokumen_kemitraan'];
		$data['nama_perusahaan']    = $Bus['nama_perusahaan'];
		$data['nama_pemberi_kerjasama']    = $Bus['nama_pemberi_kerjasama'];
		$data['nilai_kerjasama']    = $Bus['nilai_kerjasama'];
		$data['tanggal_berlaku']    = $Bus['tanggal_berlaku'];
		$data['tanggal_berakhir']    = $Bus['tanggal_berakhir'];
		$data['file_kemitraan']    = $Bus['file_kemitraan'];


		$this->template->layout('Bus/edit.php',$data);
	}


	public function delete()
	{
		$id 	= $this->input->post('id');
		$QueryHapusFile = $this->Bus_models->ShowData($id)->row_array();
		$IdFileNya 		= $QueryHapusFile['id_dokumen_kemitraan'];
		$FileNya 		= $QueryHapusFile['file_kemitraan'];
		if ($id != NULL) {
			$HapusFileRoot = unlink("./image/kemitraan/".$FileNya);
			if ($HapusFileRoot == true) {
				$Bus 										= $this->Bus_models->DeleteData($id);
				$BusFile 									= $this->Bus_models->DeleteDokumenBus($IdFileNya);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Menghapus Data...!'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Terjadi Kesalahan...!'
				];		
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data tidak ada.....!'
			];
		}
		echo json_encode($respone);
	}


	function simpan	()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('menu','Menu', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kode','Kode', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama','Nama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('ks','Ks','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama_perusahaan','Nama_perusahaan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nilaiKerjasama','NilaiKerjasama','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerlaku','TanggalBerlaku','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerakhir','TanggalBerakhir','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPemberiKerjasama','NamaPemberiKerjasama','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Terjadi Kesalahan Input Data.</div>');
			redirect(site_url('data/bus'));

		}else{
			$idDokumen 		= rand(100,99999);
			$GeT 			= $this->input->post('menu');
			$KodeBarang 	= $this->input->post('kode');
			$NamaBarang 	= $this->input->post('nama');
			$JumlahBarang 	= $this->input->post('ks');
			$nama_perusahaan 		= $this->input->post('nama_perusahaan');
			$nilaiKerjasama 		= $this->input->post('nilaiKerjasama');
			$TanggalBerlaku 		= $this->input->post('tanggalBerlaku');
			$tanggalBerakhir 		= $this->input->post('tanggalBerakhir');
			$namaPemberiKerjasama 	= $this->input->post('namaPemberiKerjasama');
			$Catatan 				= $this->input->post('catatan');
			$Tanggal 				= date('Y-m-d');


			if (!empty($GeT) && !empty($NamaBarang) && !empty($nama_perusahaan) && !empty($KodeBarang) && !empty($nilaiKerjasama) && !empty($namaPemberiKerjasama)) {

				$DataCek = [
					'id'					=> $GeT.'-'.$KodeBarang,
					'nama_bus' 				=> $NamaBarang,
					'tanggal_post'			=> $Tanggal,
					'id_dokumen_kemitraan'  => $idDokumen,
				];

				$CekData 			= $this->Bus_models->CekDataDuplicate($DataCek)->num_rows(); 
				if ($CekData > 0) {
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada..!</div>');
					redirect(site_url('data/bus'));

				}else{
					$DataNya = [
						'id'		 		 	=> $GeT.'-'.$KodeBarang,
						'nama_bus' 			 	=> $NamaBarang,
						'kapasitas'			 	=> $JumlahBarang,
						'tanggal_post'			=> $Tanggal,
						'keterangan'			=> $Catatan,
						'id_dokumen_kemitraan'	=> $idDokumen,
					];

					$UpdateStatus = [
						'id_dokumen'		 		=> $idDokumen,
						'nama_perusahaan' 			=> $nama_perusahaan,
						'nilai_kerjasama'			=> $nilaiKerjasama,
						'tanggal_berlaku'			=> $TanggalBerlaku,
						'tanggal_berakhir'			=> $tanggalBerakhir,
						'nama_pemberi_kerjasama'	=> $namaPemberiKerjasama,
					];

					if(!empty($_FILES['ktp']['name'])){
						$_FILES['file1']['name']     = $_FILES['ktp']['name'];
						$_FILES['file1']['type']     = $_FILES['ktp']['type'];
						$_FILES['file1']['tmp_name'] = $_FILES['ktp']['tmp_name'];
						$_FILES['file1']['error']    = $_FILES['ktp']['error'];
						$_FILES['file1']['size']     = $_FILES['ktp']['size'];

						$uploadPath = './image/kemitraan/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'pdf';
						$config['max_size'] = '1024';
						$config['file_name'] = 'Dokumen_Kemitraan_Bus_dengan_perusahaan'.$nama_perusahaan;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file1')){
							$data_upload = $this->upload->data();
							$config['image_library']='gd2';
							$config['source_image']='./image/kemitraan/'.$data_upload['file_name'];
							$config['create_thumb']= FALSE;
							$config['maintain_ratio']= FALSE;
							$config['quality']= '50%';
							$config['width']= 100;
							$config['height']= 70;
							$config['new_image']= './image/kemitraan/'.$data_upload['file_name'];
							$this->load->library('image_lib', $config);
							$this->image_lib->resize();
							$UpdateStatus['file_kemitraan'] = $data_upload['file_name'];
						}

						$InsertLagi = $this->Bus_models->Insert($DataNya);
						$Insert 	= $this->Bus_models->InsertDokumenKemitraan($UpdateStatus);
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Berhasil Tersimpan...!</div>');
						redirect(site_url('data/bus'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alertdanger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>File Kemitraan Gagal Tersimpan..!</div>');
						redirect(site_url('data/bus'));
					}
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Form Data Kosong..!</div>');
				redirect(site_url('data/bus'));
			}
		}
	}

	function simpanPerubahan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('idData','IdData', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kode','Kode', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama','Nama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('ks','Ks','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama_perusahaan','Nama_perusahaan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nilaiKerjasama','NilaiKerjasama','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerlaku','TanggalBerlaku','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerakhir','TanggalBerakhir','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPemberiKerjasama','NamaPemberiKerjasama','required|trim',['required' => 'Wajib Diisi.']);


		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Terjadi Kesalahan Input Data.</div>');
			redirect(site_url('data/bus'));

		}else{
			$idDokumen 		= $this->input->post('idData');
			$id 			= $this->input->post('kode');
			$NamaBarang 	= $this->input->post('nama');
			$JumlahBarang 	= $this->input->post('ks');
			$nama_perusahaan 		= $this->input->post('nama_perusahaan');
			$nilaiKerjasama 		= $this->input->post('nilaiKerjasama');
			$TanggalBerlaku 		= $this->input->post('tanggalBerlaku');
			$tanggalBerakhir 		= $this->input->post('tanggalBerakhir');
			$namaPemberiKerjasama 	= $this->input->post('namaPemberiKerjasama');
			$Catatan 				= $this->input->post('catatan');



			if (!empty($NamaBarang) && !empty($nama_perusahaan) && !empty($id) && !empty($nilaiKerjasama) && !empty($namaPemberiKerjasama) && !empty($JumlahBarang)) {

				$DataCek = [
					'id'					=> $id,
					'nama_bus' 				=> $NamaBarang,
					'id_dokumen_kemitraan'  => $idDokumen,
				];

				$AmbekData 			= $this->Bus_models->ShowData($id)->row_array(); 
				$GambarLama			= $AmbekData['file_kemitraan'];
				$CekData 			= $this->Bus_models->CekDataDuplicate($DataCek)->num_rows(); 
				if ($CekData > 1) {
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada..!</div>');
					redirect(site_url('data/bus'));

				}else{
					$DataNya = [
						'nama_bus' 			 	=> $NamaBarang,
						'kapasitas'			 	=> $JumlahBarang,
						'keterangan'			=> $Catatan,
						'id_dokumen_kemitraan'	=> $idDokumen,
					];

					$UpdateStatus = [
						// 'id_dokumen'		 		=> $idDokumen,
						'nama_perusahaan' 			=> $nama_perusahaan,
						'nilai_kerjasama'			=> $nilaiKerjasama,
						'tanggal_berlaku'			=> $TanggalBerlaku,
						'tanggal_berakhir'			=> $tanggalBerakhir,
						'nama_pemberi_kerjasama'	=> $namaPemberiKerjasama,
					];

					if(!empty($_FILES['ktp']['name'])){
						$_FILES['file1']['name']     = $_FILES['ktp']['name'];
						$_FILES['file1']['type']     = $_FILES['ktp']['type'];
						$_FILES['file1']['tmp_name'] = $_FILES['ktp']['tmp_name'];
						$_FILES['file1']['error']    = $_FILES['ktp']['error'];
						$_FILES['file1']['size']     = $_FILES['ktp']['size'];

						$uploadPath = './image/kemitraan/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'pdf';
						$config['max_size'] = '1024';
						$config['file_name'] = 'Dokumen_Kemitraan_Bus_dengan_perusahaan'.$nama_perusahaan;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file1')){
							if ($GambarLama != '') {
								unlink("./image/kemitraan/".$GambarLama);
							}
							$data_upload = $this->upload->data();
							$config['image_library']='gd2';
							$config['source_image']='./image/kemitraan/'.$data_upload['file_name'];
							$config['create_thumb']= FALSE;
							$config['maintain_ratio']= FALSE;
							$config['quality']= '50%';
							$config['width']= 100;
							$config['height']= 70;
							$config['new_image']= './image/kemitraan/'.$data_upload['file_name'];
							$this->load->library('image_lib', $config);
							$this->image_lib->resize();
							$UpdateStatus['file_kemitraan'] = $data_upload['file_name'];
						}

						$InsertLagi = $this->Bus_models->Update($DataNya,$id);
						$Insert 	= $this->Bus_models->UpdateDokumenKemitraan($UpdateStatus,$idDokumen);
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Berhasil Tersimpan...!</div>');
						redirect(site_url('data/bus'));
					}else{
						$InsertLagi = $this->Bus_models->Update($DataNya,$id);
						$Insert 	= $this->Bus_models->UpdateDokumenKemitraan($UpdateStatus,$idDokumen);
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Berhasil Tersimpan...!</div>');
						redirect(site_url('data/bus'));
					}
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Form Data Kosong..!</div>');
				redirect(site_url('data/bus'));
			}
		}
	}

	public function Data()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search= $this->input->post("search");
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
			1=>'nama_bus',
			2=>'kapasitas',
			3=>'id_dokumen_kemitraan',
			4=>'tanggal_post',
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
		$Menus = $this->Bus_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$IdData = $rows->id;
			$data[]= array(
				$no++,
				$rows->id,
				$rows->nama_bus,
				''.$rows->kapasitas.' Orang',
				date('Y-m-d') > $rows->tanggal_berakhir  ? '<span class="label label-default label-pill"> Habis</span>' :  '<span class="label label-success label-pill">Masih</span>' ,
				'<a href="./bus/Ubah/'.$IdData.'?Keterangan=Info"><button type="button" class="ShowKeterangan btn btn-info btn-raised" data-toggle="modal" id="'.$rows->id.'" ket="'.$rows->keterangan.'" ">Lihat</button></a>',
				date('Y-m-d') < $rows->tanggal_berakhir ? '<a href="bus/Ubah/'.$IdData.'?Keterangan=Ubah" type="button" class="editData fa fa-edit" title="Edit Data"></a> ' :
				' <a type="submit" class="remove fa fa-trash-o" id="'.$rows->id.'" nama="'.$rows->nama_bus.'" title="Hapus"></a> 
				'
			);    
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
		$query = $this->db->select("COUNT(*) as num")->get("db_transportasi_darat");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

}
