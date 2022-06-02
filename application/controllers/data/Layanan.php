<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Layanan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Perlengkapan_models','Layanan_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$this->template->layout('layanan/index.php',$data);
		}
	}


	public function UbahDatanya($Primary)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{
			$idLayanan 						= $this->input->post('idNya');
			$Nama 							= $this->input->post('Nama');
			$Primary 						= $this->input->post('Primary');
			$id								= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$DataLayanan        = $this->Layanan_models->DataUbah($idLayanan)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']		= $DataNya['id_level'];
		// $nama          		= $DataNya['username'];
			$daidLayanan 		= $DataLayanan['id_layanan'];


			if ($Primary != '') {
				$insertLagi = $this->Perlengkapan_models->Insert($DataNyaNah);
				$respone = [
					'status' => 'succes',
					'message' => 'Data Berhasil Dihapus..!',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Gagal Berhasil Dihapus..!',
				];
			}
			echo json_encode($respone);
		}
	}

	public function Ubah($idLayanan)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{
			$data['headerMenu']		= 'Form Ubah Data';
			$data['Perusahaan']    	= $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']            	= $DataNya['id_akses'];
			$data['Level']            	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$DataLayanan            = $this->Layanan_models->DataUbah($idLayanan)->row_array();

			$data['idLayanan'] 		= $DataLayanan['id_layanan'];
			$data['kode_layanan'] 	= $DataLayanan['kode_layanan'];
			$data['namaLayanan'] 	= $DataLayanan['nama_layanan'];
			$data['Tanggal'] 		= $DataLayanan['tanggal_post'];
			$MenusO = $this->Layanan_models->DataUbah($idLayanan)->row_array();

			$this->template->layout('layanan/edit.php',$data);
		}
	}

	public function simpanLagi()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaLayanan','NamaLayanan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kodeLayanan','KodeLayanan','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];
		}else{
			$idLayanan		= $this->input->post('id');
			$NamaLayanan	= $this->input->post('namaLayanan');
			$KODE			= $this->input->post('kodeLayanan');

			$DataUbahNya	= $this->Layanan_models->DataUbah($idLayanan)->row_array();
			if (!empty($NamaLayanan)) {
				if ($NamaLayanan != $DataUbahNya['nama_layanan']) {
					$CekNamaLayanan =  $this->Layanan_models->CekKode($NamaLayanan)->num_rows();
					if ($CekNamaLayanan > 0) {
						$respone = [
							'status' => 'error',
							'message' => 'Data Sudah Ada..!',
						];
					}else{
						$DataNyaLagi = [
							'nama_layanan'		=> $NamaLayanan,
						];
						$insert					= $this->Layanan_models->UpdateData($idLayanan,$DataNyaLagi);
					}

				}else{
					if ($KODE != $DataUbahNya['kode_layanan']) {
						$DataNyaLagi = [
							'kode_layanan'		=> $KODE,
						];
						$insert					= $this->Layanan_models->UpdateData($idLayanan,$DataNyaLagi);
						$respone = [
							'status' => 'success',
							'message' => 'Berhasil Mengubah Data..!',
						];
					}else{
						$respone = [
							'status' => 'error',
							'message' => 'Data Tidak Ada Perubahan..!',
						];

					}
				}
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Kosong..!',
				];
			}
		}


		echo json_encode($respone);
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
			0=>'id_layanan',
			1=>'kode_layanan',
			2=>'nama_layanan',
			3=>'tanggal_post',
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
		$Menus = $this->Layanan_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayanan = $rows->id_layanan;
			$data[]= array(
				$no++,
				$rows->kode_layanan,
				strtoupper($rows->nama_layanan),
				date('d-m-Y',strtotime($rows->tanggal_post)),
				'<a href="layanan/Ubah/'.$idLayanan.'" type="button" class="editData fa fa-edit" title="Edit Data"></a> 
				' 
			);
			// <a type="butzton" id="'.$rows->id_layanan.'" nama="'.$rows->nama_layanan.'" class="Delete fa fa-trash-o" title="Hapus..!"></a>     
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
		$query = $this->db->select("COUNT(*) as num")->get("db_layanan");
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
			$data['Perusahaan']   = $this->Perusahaan_models->Tentang();
			$id 									= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$Level        			= $DataNya['id_level'];
			$Akses   						= $this->Menu_models->NamaAkses($Level)->row_array();
			$data['NamaLevel']	= $Akses['nama_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
		// $data['nama']       = $DataNya['username'];
			$data['Akses']      = $this->Menu_models->Akses()->result();
			$data['no']					= 1;
			$this->template->layout('layanan/form.php',$data);
		}
	}


	function simpan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaLayanan','NamaLayanan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kodeLayanan','KodeLayanan','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];

		}else{

			$idLayanan 							= stripslashes(rand(1,999999999));
			$NamaLayanan						= $this->input->post('namaLayanan');
			$KODE								= $this->input->post('kodeLayanan');
			$TanggalPost						= date('Y-m-d');


			$CekKode = $this->Layanan_models->CekKode($NamaLayanan)->num_rows();

			if ($CekKode > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Layanan Sudah Ada...!'
				];
			}else{
				$DataNyaLagi = [
					'id_layanan'		=> $idLayanan,
					'nama_layanan'		=> $NamaLayanan,
					'kode_layanan'		=> $KODE,
					'tanggal_post'		=> $TanggalPost,
				];

				$insert					= $this->db->insert('db_layanan',$DataNyaLagi);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Menambahkan Data...!'
				];

			}
		}
		echo json_encode($respone);
	}

	function delete()
	{
		$idLayanan		= $this->input->post('id');
		if ($idLayanan != '') {

			$insert					= $this->Layanan_models->Delete($idLayanan);
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Menghapus Layanan...!'
			];

		}
		echo json_encode($respone);
	}

}