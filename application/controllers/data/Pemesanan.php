<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemesanan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Pengguna_models','Paket_models','Pemesanan_models']);
		$this->load->library('template');
		False();
	}

	public function travel()
	{
		$Level = $this->session->userdata('id_level'); 
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['Level']             = $DataNya['id_level'];
		if ($Level == 1 || $Level == 3) {
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['paket']			= $this->Pemesanan_models->Data();
			$this->template->layout('Pemesanan/Travel/index.php',$data);
		}elseif($Level == 2 ){
			$Kode = $id;
			$DataNSiswa             = $this->Pengguna_models->DataShow1($Kode)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$pelanggan           	= $DataNSiswa['id'];
			$data['paket']			= $this->Pemesanan_models->DataPelanggan($id);
			$this->template->layout('Pemesanan/Travel/index.php',$data);
		}else{
			redirect('error');
		}
	}

	public function tourPariwisata()
	{
		$Level = $this->session->userdata('id_level'); 
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['Level']             = $DataNya['id_level'];
		if ($Level == 1 || $Level == 3) {
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['paket']			= $this->Pemesanan_models->DataPariwisata();
			$this->template->layout('Pemesanan/Pariwisata/index.php',$data);
		}elseif($Level == 2 ){
			$Kode = $id;
			$DataNSiswa             = $this->Pengguna_models->DataShow1($Kode)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$pelanggan           	= $DataNSiswa['id'];
			$data['paket']			= $this->Pemesanan_models->DataPariwisata1($id);
			$this->template->layout('Pemesanan/Pariwisata/index.php',$data);
		}
	}

	public function formTambahTravel()
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
			$data['headerMenu']		= 'Form Tambah Pemesanan';
			$data['pelanggan']		= $this->Pengguna_models->DataPelanggan();

			$data['paket']			= $this->Paket_models->Data();
			$this->template->layout('Pemesanan/Travel/formTambahTravel.php',$data);
		}
	}

	public function formTambahPariwisata()
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
			$data['headerMenu']		= 'Form Tambah Pemesanan';
			$data['pelanggan']		= $this->Pengguna_models->DataPelanggan();
			$data['paket']			= $this->Paket_models->DataPaketParis();
			$this->template->layout('pemesanan/Pariwisata/formTambahTravel.php',$data);
		}
	}

	public function DeletePesanan()
	{
		$id 		= $this->input->post('name_id');
		if ($id != '') {
			$dataCekNya = [
				'kode_pemesanan' =>$id,
			];
			$CekPembayaran = [
				'kode_pemesanan' => $id,
			];

			$CekKodePesanan  = $this->Pemesanan_models->CekData($CekPembayaran)->row_array();
			$KodeTagihan = $CekKodePesanan['nomor_tagihan'];
			if ($KodeTagihan != NULL) {
				$Insert = $this->Pemesanan_models->DeleteTagihan($KodeTagihan);
				if ($Insert == true) {
					$DeleteLagi = $this->Pemesanan_models->DeleteDat($id);
					$DeletePesanan = $this->Pemesanan_models->DeletePesanan($id);
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil..!',
					];				
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal..!',
					];
				}
			}else{
				$DeletePesanan = $this->Pemesanan_models->DeletePesanan($id);
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil..!',
				];	
			}


		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan..!',
			];

		}
		echo json_encode($respone);

	}

	public function simpanPaketPemesanan()
	{
		$kodePaket 			= $this->input->post('id_paket');
		$name_pelanggan 	= $this->input->post('pelanggan');

		if ([!empty($kodePaket) && !empty($pelanggan)]) {

			$dataCekNya= [
				'id_pelanggan' =>$name_pelanggan,
				'status'		=>1,
			];

			$CekStatusPelanggan = $this->Pemesanan_models->CekDataPemesanan($dataCekNya)->num_rows();

			if ($CekStatusPelanggan > 0) {
				$respone = [
					'status' => 'error',
					'message' => 'Maaf Pelanggan tersebut telah mengikuti paket sebelumnya dan paket tersebut dalam proses..!',
				];
			}else{

				$rand 						= rand(1000,99999);
				$tanggalPost 				= date('Y-m-d H:i:s');
				$KodePemesannya 			= 'Ap'.'-'.$rand;

				$CekPembayaran 	= [
					'id_pemesanan'	=> $KodePemesannya,
				];

				$CekkodePesanan = $this->Pemesanan_models->CekPesanan($CekPembayaran)->num_rows();

				$AmbilHarga = $this->Paket_models->InformasiPaket($kodePaket)->row_array();
				$Harga = $AmbilHarga['harga'];

				if ($CekkodePesanan > 0) {
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan..!',
					];
				}else{

					$DataPesananya 	= [
						'id_pemesanan'	=>$KodePemesannya,
						'id_paket'					=>$kodePaket,
						'id_pelanggan'	=>$name_pelanggan,
						'tanggal_pesan'=>$tanggalPost,
						'status'		=>1,
					];

					$Insert = $this->Pemesanan_models->Insert($DataPesananya);
					if ($Insert == true) {
						$respone = [
							'status' => 'success',
							'message' => 'Berhasil',
						];
					}else{
						$respone = [
							'status' => 'error',
							'message' => 'Gagal',
						];
					}
				}

			}
		}
		echo json_encode($respone);
	}



}