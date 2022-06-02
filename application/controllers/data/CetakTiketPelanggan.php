<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CetakTiketPelanggan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Paket_models','Tiket_models','PesanTiket_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$Level       			= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']       	= $DataNya['id_level'];
		if ($Level == 1 || $Level == 3 ) {
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];

			$data['variable']			= $this->Tiket_models->dataTiketCetak();
			$this->template->layout('tiket/CetakTiket.php',$data);
		}elseif($Level == 2){
			$Kode 					= $id;
			$DataNSiswa             = $this->Pengguna_models->DataShow1($Kode)->row_array();
			$pelanggan           	= $DataNSiswa['id'];
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['variable']			= $this->Tiket_models->dataTiketCetak1($pelanggan);
			$this->template->layout('tiket/Pelanggan/CetakTiket.php',$data);

		}else{
			redirect('Error/AksesError');
		}
	}
	public function CetakTiketNya()
	{
		$Level       			= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']       	= $DataNya['id_level'];
		$TiketCetak = $this->input->get('idData');
		if ($TiketCetak != NULL) {
			$Base = base64_decode($TiketCetak);
			$this->load->library('pdf');
			$variable			= $this->Tiket_models->Tiket($Base)->row_array();
			$data['nomorKursi']=$variable['nomor_kursi'];
			$data['maskapai']=$variable['nama_maskapai'];
			$this->pdf->setPaper('A7', 'landscape');
			$this->pdf->filename = "Tiket.pdf";
			$this->pdf->load_view('tiket/Pelanggan/Tiketnya.php', $data);

		}else{
			redirect('Error/AksesError');
		}
	}





	public function Buat()
	{
		$Level       			= $this->session->userdata('id_level');
		$Tiket = $this->input->get('idData');
		$idTiket = base64_decode($Tiket);
		$data['idTiket'] = $idTiket;
		$data['variable'] = $this->PesanTiket_models->ShowAllDataTiket($idTiket);
		if ($Tiket != NULL) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			if ($Level == 1 || $Level == 3) {
				$this->template->layout('tiket/CetakTiketFile.php',$data);
			}elseif($Level == 2 ){
				$this->template->layout('tiket/DataTiketFile.php',$data);
			}else{
				redirect('Error/AksesError');
			}
		}else{
			redirect('Error');
		}


	}public function simpanTiket()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('pelanggan','Pelanggan', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone 				= [
				'status' 	=> 'error',
				'message' => 'Form Kosong..!',
			];
		}else{

			$sess 			= $this->session->userdata('id_akses');
			$nomorTiket 	= $this->input->post('pelanggan');
			$kodePemesanan 	= $this->input->post('id');
			$date 			= date('Y-m-d H:i:s');

			if ($nomorTiket != 0) {
				$CekNomor = $this->Tiket_models->NomorTiketCek($kodePemesanan);
				if ($CekNomor->num_rows() > 0) {
					$respone 				= [
						'status' 	=> 'error',
						'message' => 'Kode Pemesanan sudah ada tiket..!',
					];
				}else{
					$TiketData = ['status_kursi'=>1];
					$dataNya = [
						'id_pemesanan'=>$kodePemesanan,
						'nomor_tiket'=>$nomorTiket,
						'tanggal'	=>$date,
						'id_karyawan'=>$sess,
					];
					$InsertLagi = $this->Tiket_models->UpdateKursiData($TiketData,$nomorTiket);
					if ($InsertLagi == true) {
						$InsertData = $this->Tiket_models->InsertDataTiketNomor($dataNya);
						$respone 				= [
							'status' 	=> 'success',
							'message' => 'Berhasil',
						];
					}else{
						$respone 				= [
							'status' 	=> 'error',
							'message' => 'Gagal',
						];
					}
				}
			}
		}
		echo json_encode($respone);
	}
}
