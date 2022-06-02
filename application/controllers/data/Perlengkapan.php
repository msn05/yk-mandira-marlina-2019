<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perlengkapan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Perlengkapan_models','Layanan_models','Pengguna_models']);
		$this->load->library('template');
		False();

	}

	public function index()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['Level']          = $DataNya['id_level'];
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$this->template->layout('perlengkapan/index.php',$data);

		}else{
			redirect('error/AksesError');
		}
	}

	public function HapusPerlengkapan()
	{
		$id 		= $this->input->get('id');
		$Delete 		=[
			'status' 	=> 1			
		];

		$Insert 	= $this->Perlengkapan_models->DeleteData($Delete,$id);

		if ($Insert == true) {
			$respone = [
				'status' => 'success',
				'message' => 'Berhasil Menonaktifkan Pemberlakuan..!',
			];
		}else{
			$respone = [
				'status' => 'success',
				'message' => 'Gagal Menonaktifkan Pemberlakuan..!',
			];
		}
		echo json_encode($respone);
	}

	public function AktifkanPerlengkapan()
	{
		$id 		= $this->input->get('id');
		$Delete 		=[
			'status' 	=> 2			
		];

		$Insert 	= $this->Perlengkapan_models->DeleteData($Delete,$id);

		if ($Insert == true) {
			$respone = [
				'status' => 'success',
				'message' => 'Berhasil  diberlakuan..!',
			];
		}else{
			$respone = [
				'status' => 'success',
				'message' => 'Gagal diberlakuann..!',
			];
		}
		echo json_encode($respone);
	}


	public function Ubah()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$idLayanan 													= base64_decode($this->input->get('data'));
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																		 	= $this->session->userdata('id_akses');
			$DataNya             	  = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
		// $data['nama']           = $DataNya['username'];
			$X 						= $this->Perlengkapan_models->DataUbah($idLayanan)->row_array();

			$data['Id'] 											 = $X['id']; 
			$data['Kode'] 									 = $X['id_kelengkapandata']; 
			$data['NamaBarang'] 				= $X['nama_barang']; 
			$data['jumlah'] 								= $X['jumlah']; 
			$data['Tanggal'] 							= $X['tanggal_post']; 
			$this->template->layout('perlengkapan/edit.php',$data);
		}else{
			redirect('error');
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
			0=>'id_kelengkapandata',
			1=>'nama_barang',
			2=>'jumlah',
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
		$Menus = $this->Perlengkapan_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayanan 	= $rows->id_kelengkapandata;
			$id 		= $rows->id;
			$data[]= array(
				$no++,
				$rows->nama_barang,
				$rows->jumlah != 0 ? ''.$rows->jumlah. ' ' : '',

				$rows->status == 1 ? 'Belum diberlakuan' : 'Berlaku' ,

				$rows->status == 1 ? '
				<a type="submit" class="Aktifkan fa fa-lock" id="'.$id.'" nama="'.$rows->nama_barang.'" title="Berlakukan"></a> <a href="perlengkapan/Ubah?data='.base64_encode($id).'" type="button" class="editData fa fa-edit" title="Edit Data"></a> ' :($rows->status == 2 ? '<a href="perlengkapan/Ubah?data='.base64_encode($id).'" type="button" class="editData fa fa-edit" title="Edit Data"></a>' : ' '));    
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
		$query = $this->db->select("COUNT(*) as num")->group_by('nama_barang')->get("db_kelengkapan_data");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}


	public function form()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{

			$data['headerMenu']		= 'Form Data';
			$data['Perusahaan']   	= $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         	= $DataNya['id_akses'];
			$data['Level']         	= $DataNya['id_level'];
			$Level        			= $DataNya['id_level'];
			$Akses   				= $this->Menu_models->NamaAkses($Level)->row_array();
			$data['NamaLevel']	= $Akses['nama_level'];
		// $data['nama']       = $DataNya['username'];
			$data['Akses']      = $this->Menu_models->Akses()->result();
			$this->template->layout('perlengkapan/form.php',$data);
		}
	}

	function simpan	()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama[]','Nama', 'required|trim|alpha',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('jumlah[]','Jumlah','required|trim',['required' =>'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];

		}else{
			$NamaBarang 	= $this->input->post('nama[]');
			$JumlahBarang 	= $this->input->post('jumlah[]');
			$Tanggal 	= date('Y-m-d');
			if (!empty($NamaBarang)) {
				$DataNya 	= array();
				$index 		= 0;
				$X 			= $NamaBarang;
				$CekData 	= $this->Perlengkapan_models->CekDataDuplicate($X); 

				if ($CekData == true) {
					$respone = [
						'status' 	=> 'error',
						'message' 	=> 'Terdapat Data Yang sudah Ada..!',
					];

				}else{

					foreach ($NamaBarang as $key => $value) {
						$KodeBarang		= stripslashes(rand(1,99999));
						$DataNya[$index] = array(
							'nama_barang'		 => $value,
							'id_kelengkapandata' => $KodeBarang,
							'jumlah'			 => $JumlahBarang[$key],
							'tanggal_post'		 => $Tanggal,
							'status'			 => 1,
						);
						$index++;
					}
					$Insert = $this->Perlengkapan_models->Insert($DataNya);
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil Menambahkan Data..!',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Ada yang Kosong ..!',
				];
			}
		}
		echo json_encode($respone);
	}

	function UbahData	()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kode','Kode', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('NamaBarang','NamaBarang', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPost','TanggalPost','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('Jumlah','Jumlah','trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];

		}else{
			$idLayanan 		= $this->input->post('id');
			$KodeBarang 	= $this->input->post('kode');
			$NamaBarang 	= $this->input->post('NamaBarang');
			$JumlahBarang = $this->input->post('Jumlah');
			$Tanggal 			= $this->input->post('tanggalPost');

			if (!empty($NamaBarang)) {
				$CekData 				= $this->Perlengkapan_models->Valid($KodeBarang)->num_rows();
				if ($CekData > 0) {
					$DataNya 		= [
						'nama_barang'		 			=> $NamaBarang,
						'id_kelengkapandata' 	=> $KodeBarang,
						'jumlah'			 				=> $JumlahBarang,
						'tanggal_post'		 		=> $Tanggal,
					];
					$Insert = $this->Perlengkapan_models->Update($idLayanan,$DataNya);
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil Mengubah Data..!',
					];

				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal Mengubah Data..!',
					];
				}
			}else{
				$DataNya 		= [
					'id_kelengkapandata' 	=> $KodeBarang,
					'jumlah'			 				=> $JumlahBarang,
					'tanggal_post'		 		=> $Tanggal,
				];
				$Insert = $this->Perlengkapan_models->Update($idLayanan,$DataNya);
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil Mengubah Data..!',
				];
			}
		}
		echo json_encode($respone);
	}



}