<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Metode_pembayaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models','MetodePembayaran_models']);
		$this->load->library('template');
		False();
	}


	public function HapusKeterangan()
	{
		$id 									= $this->input->post('id');
		$DataNya     = $this->MetodePembayaran_models->DeleteKeteranganPembayaran($id);
		if ($DataNya == true) {
			$respone = [
				'status' 	=> 'success',
				'message' 	=> 'Data  Berhasil Dihapus..!',
			];
		}else{
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Data Gagal Berhasil Dihapus..!',
			];
		}
		echo json_encode($respone);
	}

	public function HapusMetode()
	{
		$id 		= $this->input->post('id');
		if ($id != '') {
			$Delete       		= $this->MetodePembayaran_models->DeleteDataPembayaran($id);
			$respone = [
				'status' 	=> 'success',
				'message' 	=> 'Data Berhasil Terhapus...!',
			];
		}else{
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan Saat Menghapus Data...!',
			];
		}

		echo json_encode($respone);
	}

	public function AmbilKeterangan($id)
	{
		$idLayanan 	  	= $id;
		$data      		= $this->MetodePembayaran_models->KeteranganEdit($idLayanan)->row();
		echo json_encode($data);
	}


	public function AmbilMetode($id)
	{
		$idNya 	  		= $id;
		$data      		= $this->MetodePembayaran_models->KeteranganMetodenya($idNya)->row();
		echo json_encode($data);
	}

	public function form()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
		// $data['nama']           = $DataNya['username'];
			$data['Kode']			= stripslashes(rand(1,99999));
			$this->template->layout('pembayaran/metode/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function ubah()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
			$idLayanan 													= base64_decode($this->input->get('namaData'));
			$Kode  																 = [	'id_metode_pembayaran' => $idLayanan	];

			$data['KeteranganPembayaran']   = $this->MetodePembayaran_models->Keterangan($idLayanan)->result();
			$DataNyaPembayaran      = $this->MetodePembayaran_models->DataUbah($Kode)->row_array();
			$data['idPerubahan']			 = $DataNyaPembayaran['id_metode_pembayaran'];
			$data['namaDataNya']			 = $DataNyaPembayaran['metode'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
		// $data['nama']           = $DataNya['username'];
			$data['Kode']											= stripslashes(rand(1,99999));
			$this->template->layout('pembayaran/metode/edit.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function simpanKeterangan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('keterangan','Keterangan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('id','Id','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan..!',
			];

		}else{
			$nama_bank 					= $this->input->post('nama_bank');
			$id 					= $this->input->post('id');
			$Keterangan 			= $this->input->post('keterangan');
			$caraPembayaran= date('Y-m-d');
			$Cek 										= ['id_metode_pembayaran'=>$id,'keterangan' =>$Keterangan];
			$CekCaraPembayaran 		= $this->MetodePembayaran_models->KeteranganCek($Cek)->num_rows();

			if ($CekCaraPembayaran > 0) {
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Cara Pembayaran Sudah Ada..!',
				];
			}else{
				if (!empty($nama_bank)){
					$DataNya1 = [
						'id_metode_pembayaran' 	=>htmlentities($id),
						'keterangan'			=>htmlentities($Keterangan),
						'tanggal_dibuat'		=>htmlentities($caraPembayaran),
						'bank_name'				=>htmlentities($nama_bank)
					];
				}else{
					$DataNya1 = [
						'id_metode_pembayaran'	=>htmlentities($id),
						'keterangan'			=>htmlentities($Keterangan),
						'tanggal_dibuat'		=>htmlentities($caraPembayaran),
						'bank_name'		=>NULL,
					];
				}
				$Insert 					= $this->MetodePembayaran_models->InsertKeterangan($DataNya1); 
				if ($Insert == true) {
					$respone = [
						'status' 	=> 'success',
						'message' 	=> 'Data Berhasil Ditambahkan..!',
					];
				}
			}
		}
		echo json_encode($respone);
	}

	public function SimpanMetodeUbah()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama','Nama','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggal','Tanggal','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Tidak Boleh Kosong....!',
			];

		}else{

			$id 				= $this->input->post('id');
			$metode 			= $this->input->post('nama');
			$Tanggal 			= $this->input->post('tanggal');

			if (!empty($metode)) {
				$CekMetode 					= $this->MetodePembayaran_models->CekMetode($metode)->num_rows(); 
				if ($CekMetode > 0) {
					$respone = [
						'status' 	=> 'error',
						'message' 	=> 'Nama Metode Sudah Ada.....!',
					];
				}else{
					$DataNya = [
						'metode'				=>htmlentities($metode),
						'tanggal_pembuatan'		=>htmlentities($Tanggal)
					];
					$Insert 					= $this->MetodePembayaran_models->InsertMetodeUbah($DataNya,$id);
					$respone = [
						'status' 	=> 'success',
						'message' 	=> 'Data Berhasil Ditambahkan..!',
					]; 
				}

			}else{
				$DataNya = [
					'tanggal_pembuatan'		=>htmlentities($Tanggal)
				];
				$Insert 					= $this->MetodePembayaran_models->InsertMetodeUbah($DataNya,$id);
				$respone = [
					'status' 	=> 'success',
					'message' 	=> 'Data Berhasil Ditambahkan..!',
				];
			}
		}
		echo json_encode($respone);
	}

	public function SimpanBaru()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama','Nama','required|trim',['required' => 'Wajib Diisi.']);


		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan / Format Tidak Sesuai',
			];

		}else{
			$KodePembayaran 	= stripslashes(rand(1,999999));
			$metode 			= $this->input->post('nama');

			if (alpha($metode) === false) {
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Hanya Huruf..!',
				];

			}else{

				$CekMetode 			= $this->MetodePembayaran_models->CekMetode($metode)->num_rows(); 

				if ($CekMetode > 0) {
					$respone = [
						'status' 	=> 'error',
						'message' 	=> 'Nama Metode Sudah Ada.....!',
					];

				}else{
					$DataNya = [
						'id_metode_pembayaran' 	=>htmlentities($KodePembayaran),
						'metode' 				=>htmlentities($metode),
					];
					$Insert 		= $this->MetodePembayaran_models->InsertMetode($DataNya); 
					if ($Insert == true) {
						$respone = [
							'status' 	=> 'success',
							'message' 	=> 'Data Berhasil Ditambahkan..!',
						];
					}else{
						$respone = [
							'status' 	=> 'error',
							'message' 	=> 'Gagal Menyimpan Data..!',
						];
					}
				}
			}
		}
		echo json_encode($respone);
	}
	public function UpdateDataMetode()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id','Id','required|trim');
		$this->form_validation->set_rules('nama','Nama','required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan / Format Tidak Sesuai',
			];

		}else{
			$id 						 = $this->input->post('id');
			$metode 			= $this->input->post('nama');

			if (alpha($metode) === false) {
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Hanya Huruf..!',
				];

			}else{
				$DataNyaPembayaran      = $this->MetodePembayaran_models->CekMetode($metode)->num_rows();

				if ($DataNyaPembayaran > 0) {
					$respone = [
						'status' 	=> 'error',
						'message' 	=> 'Nama Metode Sudah Ada.....!',
					];

				}else{

					$DataNya = [
						'metode' 		=>htmlentities($metode),
					];

					$Insert 		= $this->MetodePembayaran_models->InsertMetodeUbah($DataNya,$id); 
					if ($Insert == true) {

						$respone = [
							'status' 	=> 'success',
							'message' 	=> 'Berhasil Mengubah Data..!',
						];
					}else{
						$respone = [
							'status' 	=> 'error',
							'message' 	=> 'Gagal Mengubah Data..!',
						];
					}
				}
			}
		}
		echo json_encode($respone);
	}

	public function simpanKeteranganEdit()
	{

		$idData 				= $this->input->post('id');
		$id 					= $this->input->post('id_metode_pembayaran');
		$caraPembayaran 		= $this->input->post('Cara');
		$Keterangan 			= $this->input->post('keterangan');

		$CekCaraPembayaran 		= $this->MetodePembayaran_models->CekCaraPembayaran($caraPembayaran,$id)->num_rows();
		if ($id != NULL) {
			if ($CekCaraPembayaran > 0) {
				$DataNya = [
					'Keterangan'		=>htmlentities($Keterangan),
				];
				$Insert 				= $this->MetodePembayaran_models->UpdateKeterangan($idData,$DataNya); 
				$respone = [
					'status' 	=> 'success',
					'message' 	=> 'Data Berhasil Diubah..!',
				];

			}else{

				$DataNya = [
					'Keterangan'		=>htmlentities($Keterangan),
					'nama_pembayaran'	=>htmlentities($caraPembayaran)
				];

				$Insert 				= $this->MetodePembayaran_models->UpdateKeterangan($idData,$DataNya); 

				if ($Insert == true) {
					$respone = [
						'status' 	=> 'success',
						'message' 	=> 'Data Berhasil Ditambahkan..!',
					];
				}
			}
		}

		echo json_encode($respone);
	}

	public function index()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 4) {
			redirect('Error/AksesError');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']        	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$this->template->layout('pembayaran/metode/index.php',$data);
		}
	}

	public function InfoViews()
	{
		$Level = $this->session->userdata('id_level'); 
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']        	= $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		if ($Level != 2) {
			redirect('Error/AksesError');
		}else{
			$data['Metode_pembayaran'] = 
			$this->template->layout('pembayaran/metode/Pelanggan/index.php',$data);
		}
	}


	public function info()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 4) {
			redirect('Error/AksesError');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
		// $data['nama']           = $DataNya['username'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$idNya 					= base64_decode($this->input->get('kode'));
			$Kode = [
				'id_metode_pembayaran' 	=> $idNya,
			];
			$DataNya             		= $this->MetodePembayaran_models->DataUbah($Kode)->row_array();
			$data['DataNyaPembayaran']	= $this->MetodePembayaran_models->Keterangan_metode($idNya);
			$data['Kode']				= $DataNya['id_metode_pembayaran'];
			$data['nama_metode']		= $DataNya['metode'];
			$data['tanggal']			= $DataNya['tanggal_pembuatan'];
			$this->template->layout('pembayaran/metode/info.php',$data);
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
			0=>'metode',
			1=>'id_metode_pembayaran',
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
		$Menus 			= $this->MetodePembayaran_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayanan  			= $rows->id_metode_pembayaran;
			$KeteranganNya = $this->MetodePembayaran_models->Keterangan($idLayanan)->num_rows();
			$DataNya             		= $this->MetodePembayaran_models->HitungJumlah($idLayanan);
			$Jumlah 					= $DataNya['Jumlah'];
			$Level = $this->session->userdata('id_level');
			$data[]= array(
				$no++,
				strtoupper($rows->metode),
				$Jumlah. ' Keterangan Pembayaran' ,
				$Level == 1 || $Level == 3 ?
				'<a href="./Metode_pembayaran/ubah?namaData='.base64_encode($idLayanan).'" type="button" title="Edit Data" class=" Edit btn btn-warning btn-raised btn-simple btn-xs"><i class="fa fa-edit" ></i></a>
				<a type="button" id="'.$idLayanan.'" nama="'.$rows->metode.'" class=" Hapus btn btn-danger btn-raised btn-simple btn-xs"><i class="fa fa-trash-o" title="Hapus Data"></i></button></a> ':'
				<a href="./Metode_pembayaran/Info?namaData='.base64_encode($idLayanan).'" type="button" title="Info Data" class=" Edit btn btn-info btn-raised btn-simple btn-xs"><i class="fa fa-info" ></i></a>',
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
		$query = $this->db->select("COUNT(metode) as num")->get("db_metode_pembayaran");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}



}