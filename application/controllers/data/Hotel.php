<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hotel extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Hotel_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function travel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];

			$this->template->layout('hotel/travel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function form()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];

			$this->template->layout('hotel/formTambalHotel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function Ubah($KodeJadi)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');

			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$Kode					= $KodeJadi;
			$CekKodeHoel			= $this->Hotel_models->CekData($Kode)->row_array();
			$data['kode_hotel']		= $CekKodeHoel['kode_hotel'];
			$data['nama_hotel']		= $CekKodeHoel['nama_hotel'];
			$data['alamat']			= $CekKodeHoel['alamat'];
			$data['nomor_telphone']	= $CekKodeHoel['nomor_telphone'];
			$data['negara']			= $CekKodeHoel['negara'];
			$data['provinsi']		= $CekKodeHoel['provinsi'];
			$data['kota']			= $CekKodeHoel['kota'];
			$data['email']			= $CekKodeHoel['email'];
			$data['harga']			= $CekKodeHoel['harga'];
			$this->template->layout('hotel/formEditHotel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}


	public function info()
	{

		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$KodeJadi 				= base64_decode($this->input->get('id'));

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$Kode					= $KodeJadi;
			$CekKodeHoel			= $this->Hotel_models->CekData($KodeJadi)->row_array();
			$data['kode_hotel']		= $CekKodeHoel['kode_hotel'];
			$data['nama_hotel']		= $CekKodeHoel['nama_hotel'];
			$data['alamat']			= $CekKodeHoel['alamat'];
			$data['nomor_telphone']	= $CekKodeHoel['nomor_telphone'];
			$data['negara']			= $CekKodeHoel['negara'];
			$data['provinsi']		= $CekKodeHoel['provinsi'];
			$data['kota']			= $CekKodeHoel['kota'];
			$data['email']			= $CekKodeHoel['email'];
			$data['harga']			= $CekKodeHoel['harga'];
			$this->template->layout('hotel/info.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function HapusData($id)
	{

		if ($id != '') {

			$DataHapus = [
				'kode_hotel' => $id,
			];
			$DataNya    = $this->Hotel_models->DeleteData($DataHapus);
			$respone = [
				'status' 	=> 'success',
				'message' 	=> 'Berhasil Menghapus Data....!',
			];
		}else{
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan....!',
			];
		}
		echo json_encode($respone);
	}

	public function simpan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('harga','Harga','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('negara','Negara','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('prov','Prov','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kota','Kota','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('alamat','Alamat','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nomor_telp','Nomor_telp','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('email','Email','required|valid_email',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan....!',
			];
		}else{
			$menu		=  $this->input->post('menu');
			$kode		=  $this->input->post('kode');
			$email		=  $this->input->post('email');
			$nomor_telp	=  $this->input->post('nomor_telp');
			$alamat		=  $this->input->post('alamat');
			$kota		=  $this->input->post('kota');
			$prov		=  $this->input->post('prov');
			$negara 	=  $this->input->post('negara');
			$harga		=  $this->input->post('harga');
			$nama		=  $this->input->post('nama');

			$KodeJadi 	= $menu.'-'.+$kode;
			$CekKodeHoel= $this->Hotel_models->CekData($KodeJadi);
			if ($CekKodeHoel->num_rows() > 0 ) {
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Kode Hotel Sudah Ada....!',
				];
			}else{

				$DataNyaLagi 	= [
					'kode_hotel'	=> 	$KodeJadi,
					'nama_hotel'	=>  $nama,
					'harga'			=> 	$harga,
					'negara'		=>  $negara,
					'provinsi'		=>  $prov,
					'kota'			=>  $kota,
					'alamat'		=>  $alamat,
					'nomor_telphone'=>  $nomor_telp,
					'email'			=>  $email,
				];
				$insert				= 	$this->Hotel_models->Insert($DataNyaLagi);
				$respone = [
					'status' => 'success',
					'message' => 'Data Berhasil Ditambahkan..!',
				];
			}
		}
		echo json_encode($respone);
	}

	public function simpanLagi()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kode','Kode','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama','Nama','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('harga','Harga','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('negara','Negara','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('prov','Prov','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kota','Kota','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('alamat','Alamat','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nomor_telp','Nomor_telp','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('email','Email','required|valid_email|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan....!',
			];
		}else{
			$KodeJadi	= $this->input->post('kode');
			$email		= $this->input->post('email');
			$nomor_telp	= $this->input->post('nomor_telp');
			$alamat		= $this->input->post('alamat');
			$kota		= $this->input->post('kota');
			$prov		= $this->input->post('prov');
			$negara 	= $this->input->post('negara');
			$harga		= $this->input->post('harga');
			$nama		= $this->input->post('nama');



			if (!empty($email) && !empty($nomor_telp)) {
				$DataNyaLagi 	= [
					'nama_hotel'	=> htmlentities($nama),
					'harga'			=> htmlentities($harga),
					'negara'		=> htmlentities($negara),
					'provinsi'		=> htmlentities($prov),
					'kota'			=> htmlentities($kota),
					'alamat'		=> htmlentities($alamat),
				];
				$insert					= $this->Hotel_models->Update($KodeJadi,$DataNyaLagi);
				$respone = [
					'status' => 'success',
					'message' => 'Data Berhasil Diubah..!',
				];
			}else{
				$DataNyaLagi 	= [
					'nama_hotel'	=> htmlentities($nama),
					'harga'			=> htmlentities($harga),
					'negara'		=> htmlentities($negara),
					'provinsi'		=> htmlentities($prov),
					'kota'			=> htmlentities($kota),
					'alamat'		=> htmlentities($alamat),
				];
				$insert					= $this->Hotel_models->Update($KodeJadi,$DataNyaLagi);
				$respone = [
					'status' => 'errror',
					'message' => 'Data Gagal Diubah..!',
				];
			}

		}
		echo json_encode($respone);
	}

	public function dataTravel()
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
			0=>'kode_hotel',
			1=>'nama_hotel',
			2=>'harga',
			3=>'negara',
			4=>'provinsi',
			5=>'kota',
			6=>'alamat',
			7=>'nomor_telphone',
			8=>'email',
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
		$Menus = $this->Hotel_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$KodeJadi = $rows->kode_hotel;
			$data[]= array(
				$no++,
				$rows->kode_hotel,
				'<a href="info?id='.base64_encode($rows->kode_hotel).'">'.
				strtoupper($rows->nama_hotel).'</a>',
				$rows->negara.' / '.$rows->provinsi. ' / '.$rows->kota,
				$rows->email.' / '.$rows->nomor_telphone,
				'<a href="Ubah/'.$KodeJadi.'" type="button" class="editData fa fa-edit" title="Edit Data"></a> 
				'
			);    
			// <a type="submit" class="remove fa fa-trash-o" id="'.$rows->kode_hotel.'" nama="'.$rows->nama_hotel.'" title="Hapus"></a>
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
		$query = $this->db->select("COUNT(*) as num")->get("db_hotel");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}



}