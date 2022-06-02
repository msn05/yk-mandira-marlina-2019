<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model([
			'Perusahaan_models',
			'Menu_models',
			'Pengguna_models']);
		$this->load->library('template');
		False();

	}

	public function index()
	{
		$id 					= $this->session->userdata('id_akses');
		if ($id == NULL) {
			// $this->template->layout('Login/index.php',$data);
			redirect('Login/index.php');

		}else{
			$Level = $this->session->userdata('id_level'); 
			if ($Level != 1) {
				redirect('Error');
			}else{
				$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
				$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
				$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
				$data['nama']           = $DataNSiswa['nama_lengkap'];
				$data['id']             = $DataNya['id_akses'];
				$data['Level']          = $DataNya['id_level'];
				$this->template->layout('pengguna/index.php',$data);
			}
		}
	}

	public function simpanPerubahanData()
	{
		$id 								= htmlspecialchars($this->input->post('id_akses'));
		$Password			= htmlspecialchars($this->input->post('Password'));
		// $UsernameNya		= htmlspecialchars($this->input->post('UsernameNya'));
		// $am 				= htmlspecialchars($this->input->post('am'));

		$Cek 		= $this->Pengguna_models->DataUbah($id)->row_array();
		$PasswordLama = $Cek['password'];
		if ($Password == '') {
			$UpdateStatus =[
				'id_akses' 	=> $id,
				'password'	=> password_hash($PasswordLama, PASSWORD_DEFAULT),
				// 'id_level'		=> $am,
			];

			// $res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatus);
			// $respone = [
			// 	'status' => 'success',
			// 	'message'=> 'Berhasil Mengubah Data...!'
			// ];

		}else{
			$UpdateStatus =[
				'id_akses' 	=> $id,
				'password'	=> password_hash($Password, PASSWORD_DEFAULT),
				// 'id_level'		=> $am,
			];

			$res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatus);
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Mengubah Data...!'
			];
		// }else{
		// 	$respone = [
		// 		'status' => 'error',
		// 		'message'=> 'Gagal Mengubah Data...!'
		// 	];
		}

		echo json_encode($respone);
	}



	public function form()
	{
		$data['headerMenu']		= 'Form Data';
		$data['Perusahaan']   = $this->Perusahaan_models->Tentang();
		$id 									= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']         = $DataNya['id_akses'];
		$Level        			= $DataNya['id_level'];
		$Akses   						= $this->Menu_models->NamaAkses($Level)->row_array();
		$data['NamaLevel']	= $Akses['nama_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Akses']      = $this->Menu_models->Akses()->result();

		$this->template->layout('pengguna/form.php',$data);
	}


	public function edit($id)
	{
		$data['headerMenu']					= 'Form Ubah Data';
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id_akses']							= $DataNya['id_akses'];
		$data['password']							= $DataNya['password'];
		$data['status_users']						= $DataNya['status_users'];
		$data['id_level']							= $DataNya['id_level'];
		$data['Akses']          = $this->Menu_models->Akses()->result();
		$this->template->layout('pengguna/edit.php',$data);
	}


	function SimpanDataBaru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('usernamenya','Usernamenya', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('Password','Password', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaLengkap','NamaLengkap', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('am','Am', 'required|trim');
		$this->form_validation->set_rules('ak','Ak', 'required|trim');
		$this->form_validation->set_rules('nomor','Nomor', 'required|trim');
		$this->form_validation->set_rules('nomorWA','NomorWA', 'required|trim');
		$this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
		$this->form_validation->set_rules('tanggalLahir','TanggalLahir', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[db_data_akses.email]',['required' => 'Wajib Diisi.','is_unique' => 'Email Sudah Terdaftar']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong',
			];

		}else{
			$idAkses 					= stripslashes(rand(1,999999999));
			$kodeLagi 				= stripslashes(rand(1,999999));
			$am								= $this->input->post('am');
			$ak								= $this->input->post('ak');
			$password					= $this->input->post('Password');
			$username					= $this->input->post('usernamenya');
			$nama							= $this->input->post('namaLengkap');
			$nomor						= $this->input->post('nomor');
			$nomorWA					= $this->input->post('nomorWA');
			$email						= $this->input->post('email');
			$tempat						= $this->input->post('tempatLahir');
			$tgl							= $this->input->post('tanggalLahir');
			$alamat						= $this->input->post('alamat');

			$DataNyaLagi = [
				'id_akses'				=> $idAkses,
				'nama_lengkap'		=> $nama,
				'nomor_telephone'	=> $nomor,
				'nomor_wa'				=> $nomorWA,
				'email'						=> $email,
				'alamat'					=> $alamat,
				'tempat_lahir'		=> $tempat,
				'tanggal_lahir'		=> $tgl,
				'id_file_identitas'	=> $kodeLagi,
			];

			$DataNya = [
				'id_akses'		=> $idAkses,
				'password'		=> password_hash($password,PASSWORD_DEFAULT),
				'status_users'=> $am,
				'id_level'		=> $ak,
			];

			$DataNyadanLagi = [
				'id_file_identitas'		=> $kodeLagi,
				'foto'								=> 'default.png',
			];


			$insert				= $this->db->insert('db_akses',$DataNya);
			$insertLagi 	= $this->db->insert('db_data_akses',$DataNyaLagi);
			$insertdanLagi= $this->db->insert('db_file',$DataNyadanLagi);
			$KirimEmail 	= $this->_sendEmail($email,$password,'Success');

			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Menambahkan Data...!'
			];
		}
		echo json_encode($respone);
	}


	private function _sendEmail($email,$username,$password,$type)
	{
		$config = [
			'protocol'    	=> 'smtp', 
			'smtp_host'   	=> 'ssl://smtp.googlemail.com',
			'smtp_user'   	=> 'm.satrion0501997@gmail.com',
			'smtp_pass'   	=> 'akamsi123',
			'smtp_port'   	=> 465,
			'mailtype'    	=> 'html',
			'charset'   	=> 'utf-8',
			'newline'   	=> "\r\n"

		];

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from('Sistem Tour and Travel','YEKA MANDIRA');
		$this->email->to($email);
		$this->email->subject('Data Akun Anda');

		if ($type == 'Success' && $email != NULL) {
		//css email nyoo...!

			$this->email->message('');
		}

		if($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
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
			0=>'id_akses',
			1=>'password',
			2=>'nama_level',
			3=>'nomor_wa',
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
		$Menus = $this->Pengguna_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$Level = $this->session->userdata('id_level'); 

			$id = $rows->id_akses; 
			$Kode = $rows->id_akses; 
			$n 	= $rows->nomor_wa;
			$DataNSiswa       = $this->Pengguna_models->DataLengkap($id)->row_array();
			$Pelanggan       = $this->Pengguna_models->DataShow1($Kode)->row_array();
			$username           = $DataNSiswa['nama_lengkap'];
			$X 	= "+62".format_phone_us($n);
			$data[]= array(
				$no++,
				$rows->id_akses,
				$id == $DataNSiswa['id_akses'] ? 

				'<a href="profile/info/'.$id.'">
				'.$username.'</a>' : '<a href="profile/info/'.$id.'">
				'.$Pelanggan['nama_lengkap'].'</a>',
				$rows->id_level == 1 ? '':'
				'.
				substr($rows->password,0,$num_char).'',
				$rows->nama_level,
				$rows->nomor_wa != '' ? "<a href='https://web.whatsapp.com/send?phone=".$X."' target='_blank'>+62".format_phone_us($rows->nomor_wa)."</a>" : "Tidak Ada",
				$rows->status_users == 1 ? '<span class="label label-success label-pill">Aktif</span>' : '<span class="label label-warning label-pill">Tidak Aktif</span>',
				$Level == 1 ? ''.($rows->status_users != 1 ? '<a type="submit" class="aktif fa fa-external-link" id="'.$rows->id_akses.'" nama="'.$username.'" title="Aktifkan"></a> ':''.(
					$rows->id_level == 1  || $rows->id_level == 4 ? '': 
					'<a type="submit" class="remove fa fa-power-off" id="'.$rows->id_akses.'" nama="'.$username.'" title="Non Aktifkan"></a> ').'').'' : '',
				// <a type="submit" href="pengguna/edit/'.$rows->id_akses.'" class="fa fa-edit" title="Edit Data" ></a> 
				// <a type="submit" class="delete fa fa-trash-o" id="'.$rows->id_akses.'" nama="'.$username.'" title="Hapus Akun"></a>
				// <a type="submit" class="aktif fa fa-external-link" id="'.$rows->id_akses.'" nama="'.$username.'" title="Aktifkan"></a> 
				// ' :
				// '
				// '
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
		$query = $this->db->select("COUNT(*) as num")->get("db_akses");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

	function NonAktifkan($id)
	{
		$Waktu 	= date('Y-m-d H:i:s');
		$Status = 0;
		$UpdateStatusNya =[
			'status_users' => $Status,
		];

		$res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatusNya);

		if ($res == false) {
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal Menonaktifkan Pengguna Ini...!'
			];

		}else{
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Menonaktifkan Pengguna Ini...!'
			];

		}
		echo json_encode($respone);
	}

	function Aktif($id)
	{
		$Waktu 	= date('Y-m-d H:i:s');
		$Status = 1;
		$UpdateStatusNya =[
			'status_users' => $Status,
		];

		$res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatusNya);

		if ($res == false) {
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal Mengaktifkan Pengguna Ini...!'
			];

		}else{
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Mengaktifkan Pengguna Ini...!'
			];

		}
		echo json_encode($respone);
	}

	function delete($id)
	{
		$res = $this->Pengguna_models->DeleteAKun($id);

		if ($res == false) {
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal MengHapus Pengguna Ini...!'
			];

		}else{
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil MengHapus Pengguna Ini...!'
			];

		}
		echo json_encode($respone);
	}
}


