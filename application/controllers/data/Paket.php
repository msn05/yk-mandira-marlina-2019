<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paket extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models','Paket_models','Hotel_models','Penerbangan_models','MetodePembayaran_models','Perlengkapan_models','Layanan_models','Bus_models','JadwalBerangkat_models']);
		$this->load->library('template');
		$this->load->helper('Rupiah');
		$idLogin 					= $this->session->userdata('id_level');

	}

	public function travel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$id 					= $this->session->userdata('id_akses');
			$DataNya            	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         	= $DataNya['id_akses'];
			$data['Level']         	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
			$data['paket']			= $this->Paket_models->Data();
			$this->template->layout('paket/travel/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function pariwisata()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$id 					= $this->session->userdata('id_akses');
			$DataNya            	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         	= $DataNya['id_akses'];
			$data['Level']         	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
			$data['paket']			= $this->Paket_models->DataPaketParis();
			$this->template->layout('paket/Pariwisata/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function Tour()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$id 					= $this->session->userdata('id_akses');
			$DataNya            	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         	= $DataNya['id_akses'];
			$data['Level']         	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
			$this->template->layout('paket/tour/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function deleteTravel()
	{
		$id 																	=	 $this->input->get('id');
		if ($id != '') {
			$DataNya = [
				'status_paket' => 2
			];

			$Insert     	= $this->Paket_models->Nonaktifkan($DataNya,$id);
			$respone 				= [
				'status' 	=> 'success',
				'message' => 'Paket Berhasil Dinonaktifkan..!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Paket Tidak Ada....!',
			];
		}
		echo json_encode($respone);
	}

	public function deleteperlengkapan()
	{
		$id_name =  $this->input->post('id_name');
		if ($id_name != '') {

			$Hapus = [
				'id' 	=>$id_name,
			];
			$Insert     	= $this->Paket_models->DeletePerlengkapan($Hapus);
			$respone 				= [
				'status' 	=> 'success',
				'message' 	=> 'Perlengkapan paket berhasil dihapus..!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan....!',
			];
		}
		echo json_encode($respone);
	}

	public function deletehotelPaket()
	{
		$id_name =  $this->input->post('id_name');
		if ($id_name != '') {

			$Hapus = [
				'id' 	=>$id_name,
			];
			$Insert     	= $this->Hotel_models->DeletePaketHotel($Hapus);
			$respone 				= [
				'status' 	=> 'success',
				'message' 	=> 'hotel paket berhasil dihapus..!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan....!',
			];
		}
		echo json_encode($respone);
	}


	public function formTravel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['kode_paket'] 	= rand(1000,999999);
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$data['Penerbangan']= $this->Penerbangan_models->DataTravel()->result();
			$data['Layanan'] 	= $this->Layanan_models->DataPaket()->result();
			$data['Hotel'] 		= $this->Hotel_models->Data()->result();
			$data['Metode'] 	= $this->MetodePembayaran_models->Data()->result();
			$data['Bus'] 		= $this->Bus_models->Data()->result();
			$data['Perlengkapan']= $this->Perlengkapan_models->Data()->result();
			$this->template->layout('paket/travel/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function formPariwisata()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']       = $DataNSiswa['nama_lengkap'];
			$data['kode_paket'] = rand(1000,999999);
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$data['Penerbangan']= $this->Penerbangan_models->DataTravel()->result();
			$data['Layanan'] 	= $this->Layanan_models->DataPaketPariws()->result();
			$data['Hotel'] 		= $this->Hotel_models->Data()->result();
			$data['Metode'] 	= $this->MetodePembayaran_models->Data()->result();
			$data['Bus'] 		= $this->Bus_models->Data()->result();
			$data['Perlengkapan']= $this->Perlengkapan_models->Data()->result();
			$this->template->layout('paket/pariwisata/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function CetakHistoriPemesanan()
	{
		$this->load->library('pdf');
		$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
		$Kode 					= 'U';
		$data['paket']			= $this->JadwalBerangkat_models->DataHistori($Kode);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan histori pemesanan paket.pdf";
		$this->pdf->load_view('paket/travel/laporan_pemesanan_paket.php', $data);
	}

	public function CetakHistoriPemesananPariwisata()
	{
		$this->load->library('pdf');
		$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
		$Kode 					= 'U';
		$data['paket']			= $this->JadwalBerangkat_models->DataHistoriPariwisata($Kode);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan histori pemesanan pake pariwisatat.pdf";
		$this->pdf->load_view('paket/travel/laporan_pemesanan_paket.php', $data);
	}

	public function UbahDataPaket()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			if ($this->input->get('idData')) {
				$dataNya 			= base64_decode($this->input->get('idData'));
				$idDataNya 				= base64_decode($this->input->get('idData'));
				$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
				$data['nama_layanan']		= $fileInfo['nama_layanan'];
				$data['kode_paket_data']	= $fileInfo['kode_paket_data'];
				$data['namaPaket']			= $fileInfo['id_paket'];
				$data['TanggalBerangkat']	= $fileInfo['tanggal_berangkat'];
				$data['tanggalAkhir']		= $fileInfo['tanggal_Berakhir'];
				$data['tanggalAwal']		= $fileInfo['tanggal_dibuat'];
				$data['JumlahPelanggan']	= $fileInfo['maxPelanggan'];
				$data['lama_perjalanan']	= $fileInfo['lama_perjalanan'];
				$data['harga']	= $fileInfo['harga'];
				$data['id_layanan']	= $fileInfo['id_layanan'];
				$data['catatan']			= $fileInfo['catatan'];
				$data['id_metode_pembayaran_paket']	= $fileInfo['id_metode_pembayaran_paket'];
				$data['idPenerbangan'] 		= $fileInfo['maskapai_penerbangan'];
				$idPenerbangan 				= $fileInfo['maskapai_penerbangan'];
				$data['id_transportasi_paket'] 	= $fileInfo['id_transportasi_paket'];
				$id_transportasi_paket 			= $fileInfo['id_transportasi_paket'];
				$data['Penerbangan']= $this->Penerbangan_models->DataTravel()->result();
				$data['Layanan'] 	= $this->Layanan_models->DataPaket()->result();
				$data['Hotel'] 		= $this->Hotel_models->Data()->result();
				$data['Metode'] 	= $this->MetodePembayaran_models->Data()->result();
				$data['Bus'] 		= $this->Bus_models->Data()->result();
				$data['Perlengkapan']= $this->Perlengkapan_models->Data()->result();
				$this->template->layout('paket/travel/ubah.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}
	public function UbahDataPaketParis()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			if ($this->input->get('idData')) {
				$dataNya 			= base64_decode($this->input->get('idData'));
				$idDataNya 				= base64_decode($this->input->get('idData'));
				$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
				$data['nama_layanan']		= $fileInfo['nama_layanan'];
				$data['kode_paket_data']	= $fileInfo['kode_paket_data'];
				$data['namaPaket']			= $fileInfo['id_paket'];
				$data['TanggalBerangkat']	= $fileInfo['tanggal_berangkat'];
				$data['tanggalAkhir']		= $fileInfo['tanggal_Berakhir'];
				$data['tanggalAwal']		= $fileInfo['tanggal_dibuat'];
				$data['JumlahPelanggan']	= $fileInfo['maxPelanggan'];
				$data['lama_perjalanan']	= $fileInfo['lama_perjalanan'];
				$data['start_in']	= $fileInfo['start_in'];
				$data['end_ind']	= $fileInfo['end_ind'];
				$data['lama_perjalanan']	= $fileInfo['lama_perjalanan'];
				$data['harga']	= $fileInfo['harga'];
				$data['id_layanan']	= $fileInfo['id_layanan'];
				$data['catatan']			= $fileInfo['catatan'];
				$data['id_metode_pembayaran_paket']	= $fileInfo['id_metode_pembayaran_paket'];
				$data['idPenerbangan'] 		= $fileInfo['maskapai_penerbangan'];
				$idPenerbangan 				= $fileInfo['maskapai_penerbangan'];
				$data['id_transportasi_paket'] 	= $fileInfo['id_transportasi_paket'];
				$id_transportasi_paket 			= $fileInfo['id_transportasi_paket'];
				$data['Penerbangan']= $this->Penerbangan_models->DataTravel()->result();
				$data['Layanan'] 	= $this->Layanan_models->DataPaketPariws()->result();
				$data['Hotel'] 		= $this->Hotel_models->Data()->result();
				$data['Metode'] 	= $this->MetodePembayaran_models->Data()->result();
				$data['Bus'] 		= $this->Bus_models->Data()->result();
				$data['Perlengkapan']= $this->Perlengkapan_models->Data()->result();
				$this->template->layout('paket/pariwisata/ubah.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function informasiPaket()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 && $Level != 3) {
			
			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
			if ($this->input->get('idData') != '') {
				$idDataNya 				= base64_decode($this->input->get('idData'));
				$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
				$data['nama_layanan']		= $fileInfo['nama_layanan'];
				$data['namaPaket']			= $fileInfo['id_paket'];
				$data['TanggalBerangkat']	= $fileInfo['tanggal_berangkat'];
				$data['tanggalAkhir']		= $fileInfo['tanggal_Berakhir'];
				$data['tanggalAwal']		= $fileInfo['tanggal_dibuat'];
				$data['JumlahPelanggan']	= $fileInfo['maxPelanggan'];
				$data['catatan']			= $fileInfo['catatan'];
				$id_metode_pembayaran_paket	= $fileInfo['id_metode_pembayaran_paket'];
				$data['idPenerbangan'] 		= $fileInfo['maskapai_penerbangan'];
				$idPenerbangan 				= $fileInfo['maskapai_penerbangan'];
				$data['id_transportasi_paket'] 	= $fileInfo['id_transportasi_paket'];
				$id_transportasi_paket 			= $fileInfo['id_transportasi_paket'];
				$DataCekPenerbangan				= [
					'id'						=> $idPenerbangan,
				];
				$DataCek 				= [
					'id'				=> $id_transportasi_paket,
				];
				$namaBus 				= $this->Bus_models->CekDataDuplicate($DataCek)->row_array();
				$data['kode_bus']		= $namaBus['id'];
				$data['nama_bus']		= $namaBus['nama_bus'];

				$PaketKode 			= $idDataNya;

				$data['metodePembayaran'] = $this->MetodePembayaran_models->DataPembayaranPaket($id_metode_pembayaran_paket);
				$data['namaHotel'] 		= $this->Hotel_models->DataHotelPaket($PaketKode);
				$PaketKode 				= $idDataNya;
				$data['PerlengkapanPaket']= $this->Perlengkapan_models->DataPerlengkapanPaket($PaketKode);
				$namaMaskapai 			= $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
				$data['kode_penerbangan']=$namaMaskapai['kode_penerbangan'];
				$data['nama_maskapai']=$namaMaskapai['nama_maskapai'];

				$this->template->layout('paket/travel/Informasi_data.php',$data);
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function FormKelengkapanPaket()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$PaketKode			= $this->input->get('KodePaket');
			if ($PaketKode != NULL) {
				$data['PaketKodeNya']	  = $this->input->get('KodePaket');
				$data['PerlengkapanPaket']= $this->Paket_models->DataPerlengkapan($PaketKode);
				$data['Perlengkapan']= $this->Perlengkapan_models->DataPaket();
				$this->template->layout('paket/travel/FormKelengkapanPaket.php',$data);
			}else{
				redirect('Error/ErrorData');
			}
		}else{
			redirect('Error/AksesError');
		}
	}
	public function FormKelengkapanPaketParis()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$PaketKode			= $this->input->get('KodePaket');
			if ($PaketKode != NULL) {
				$data['PaketKodeNya']	  = $this->input->get('KodePaket');
				$data['PerlengkapanPaket']= $this->Paket_models->DataPerlengkapan($PaketKode);
				$data['Perlengkapan']= $this->Perlengkapan_models->DataPaket();
				$this->template->layout('paket/travel/FormKelengkapanPaket.php',$data);
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function formHotel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa         = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']       = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$PaketKode			= $this->input->get('KodePaket');
			if ($PaketKode != NULL) {
				$data['PaketKodeNya']	  = $this->input->get('KodePaket');
				$data['HotelPaket'] = $this->Hotel_models->DataHotelPaket($PaketKode);
				$data['Hotel']		= $this->Hotel_models->DataPaket();
				$this->template->layout('paket/Pariwisata/FormHotelPaket.php',$data);
			}else{
				redirect('Error/ErrorData');
			}
		}else{
			redirect('Error/AksesError');
		}
	}
	public function formHotelformHotel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$DataNSiswa         = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']       = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$PaketKode			= $this->input->get('KodePaket');
			if ($PaketKode != NULL) {
				$data['PaketKodeNya']	  = $this->input->get('KodePaket');
				$data['HotelPaket'] = $this->Hotel_models->DataHotelPaket($PaketKode);
				$data['Hotel']		= $this->Hotel_models->DataPaket();
				$this->template->layout('paket/travel/FormHotelPaket.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function formTour()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$id 				= $this->session->userdata('id_akses');
			$DataNya            = $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         = $DataNya['id_akses'];
			$data['Level']         = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] = $this->Perusahaan_models->Tentang();
			$data['Penerbangan']= $this->Penerbangan_models->DataTravel()->result();
			$data['Layanan'] 	= $this->Layanan_models->DataTour()->result();
			$data['Hotel'] 		= $this->Hotel_models->Data()->result();
			$data['Metode'] 	= $this->MetodePembayaran_models->Data()->result();
			$data['Bus'] 		= $this->Bus_models->Data()->result();
			$data['Perlengkapan']= $this->Perlengkapan_models->Data()->result();
			$this->template->layout('paket/tour/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function cariHotel()
	{
		$idHotel 			= $this->input->post('id');
		if ($idHotel == 0) {

		}else{
			$data['Hotel'] 		= $this->Hotel_models->DataHotel($idHotel)->row_array();
			$this->load->view('hotel/data.php',$data);
		}
	}


	public function Ubah()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{
			$id 					= $this->session->userdata('id_akses');
			$DataNya            	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']         	= $DataNya['id_akses'];
			$data['Level']         	= $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
			$kodePaket 				= base64_decode($this->input->get('kode'));
			$DataPaket 				= $this->Paket_models->InformasiPaket($kodePaket)->row_array();



			$data['KodePenerbangan']= $DataPaket['id_penerbangan'];
			$data['Metode'] 		= $this->MetodePembayaran_models->Data()->result();

			$data['Penerbangan']	= $this->Penerbangan_models->DataTravel()->result();
			$data['Layanan'] 		= $this->Layanan_models->Data()->result();
			$data['Bus'] 			= $this->Bus_models->Data()->result();
			$data['KodeBus'] 		= $DataPaket['id_transportasi'];
			$data['Hotel'] 			= $this->Hotel_models->Data()->result();

			$KodeBus 				= $DataPaket['id_transportasi'];
			$DataBus 				= $this->Paket_models->DataBus($KodeBus)->row_array();
			$idLayanan 															= $DataPaket['id_layanan'];

			$data['idLayanan'] 		= $DataPaket['id_layanan'];
			$data['kodePaket'] 		= $DataPaket['id_paket'];
			$data['namaPaket'] 		= $DataPaket['nama_paket'];
			$data['tanggalAwal']	= format_indo($DataPaket['tanggal_dibuat']);
			$data['tanggalAkhirNya'] 	= $DataPaket['tanggal_Berakhir'];
			$data['Jumlah'] 		= rupiah($DataPaket['harga_paket']);
			$data['Penyu'] 		  	= penyebut($DataPaket['harga_paket']);
			$data['Hargo'] 		  	= $DataPaket['harga_paket'];
			$data['Jpelanggan'] 	= $DataPaket['JumlahPelanggan'];
			$data['JumlahPelanggan']= $DataPaket['JumlahPelanggan'];
			$data['Pembayaran']  	= $DataPaket['id_metode'];


			$idPaketLayanan 		= $kodePaket;
			$DataBerangkat			= $this->JadwalBerangkat_models->Select($idPaketLayanan)->row_array();
			$data['TanggalBerangkat'] = $DataBerangkat['tanggal_berangkat'];
			$dataKeterangan			= $this->Paket_models->KeteranganTour($idPaketLayanan)->row_array();

			if ($dataKeterangan == '') {
				$this->template->layout('paket/travel/ubah.php',$data);

			}else{
				$data['Tujuan']			= $dataKeterangan['tujuan'];
				$data['Dari']			= $dataKeterangan['dari'];
				$data['lama_perjalanan']= $dataKeterangan['lama_perjalanan'];
				$data['CatatanTour']	= $dataKeterangan['catatan'];

				$this->template->layout('paket/tour/ubah.php',$data);
			}
		}
	}


	function simpanPaket()
	{

		$this->load->library('form_validation');
		// $this->form_validation->set_rules('paket','Paket', 'required|trim');
		$this->form_validation->set_rules('namapaket','Namapaket', 'required|trim');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('harga','Harga', 'required|trim|numeric');
		$this->form_validation->set_rules('lama_perjalanan','Lama_perjalanan', 'required|trim|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required|trim');
		$this->form_validation->set_rules('transBus','TransBus', 'required|trim');
		$this->form_validation->set_rules('pelanggan','Pelanggan', 'required|trim');
		$this->form_validation->set_rules('tanggalberangkat','Tanggalberangkat', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('penerbanganData','PenerbanganData', 'required|trim');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Input Tidak Valid.</div>');
			redirect(site_url('data/paket/travel'));

		}else{

			$Paket 					= $this->input->post('paket');
			$kodePaket 				= $this->input->post('kodePaket');
			$namaPaket 				= $this->input->post('namapaket');
			$layanan 				= $this->input->post('layanan');
			$harga 					= $this->input->post('harga');
			$lamaPerjalanan 		= $this->input->post('lama_perjalanan');
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 		= $this->input->post('tanggalberangkat');
			$transBus 				= $this->input->post('transBus');
			$MetodeTravel 			= $this->input->post('MetodeTravel');
			$penerbanganData 			= $this->input->post('penerbanganData');
			$catatan 				= $this->input->post('catatan');
			$Waktu					= date('Y-m-d');
			$Pelanggan 				= $this->input->post('pelanggan');
			$KodePaket 				= $Paket.'-'.$kodePaket;

			$DataCek 				= [
				'id_paket'			=>$KodePaket,
				'kode_paket_data'	=>$namaPaket,
				'id_layanan'		=>$layanan,
				'tanggal_Berakhir'	=> $TanggalBerakhir
			];

			$CekKodePaket  			= $this->Paket_models->CekPaketNya($DataCek);
			if ($CekKodePaket->num_rows() > 0 ) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
				redirect(site_url('data/paket/travel'));
			}else{
				if ($TanggalBerangkat < $TanggalBerakhir) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tanggal Berangkat Tidak Boleh Lebih Kecil dari tanggal berakhir</div>');
					redirect(site_url('data/paket/travel'));
				}else{
					$InsertData = [
						'id_paket'				=>$kodePaket,
						'kode_paket_data'		=>$namaPaket,
						'id_layanan'			=>$layanan,
						'lama_perjalanan'		=>$lamaPerjalanan,
						'tanggal_Berakhir'		=>$TanggalBerakhir,
						'tanggal_dibuat'		=>$Waktu,
						'maxPelanggan'			=>$Pelanggan,
						'tanggal_berangkat'		=>$TanggalBerangkat,
						'id_transportasi_paket'	=>$transBus,
						'id_metode_pembayaran_paket'=>$MetodeTravel,
						'maskapai_penerbangan'		=>$penerbanganData,
						'harga'						=>$harga,
						'catatan'					=>$catatan,
					];

					$InsertDataNya 		= $this->Paket_models->InsertDataBaru($InsertData);
					if ($InsertDataNya == true) {
						redirect(site_url('data/paket/FormKelengkapanPaketParis?KodePaket='.$kodePaket.''));
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
						redirect(site_url('data/paket/travel'));
					}
				}
			}
		}

	}
	function simpanPaketParis()
	{

		$this->load->library('form_validation');
		// $this->form_validation->set_rules('paket','Paket', 'required|trim');
		// dimulaiDari
		$this->form_validation->set_rules('namapaket','Namapaket', 'required|trim');
		$this->form_validation->set_rules('dimulaiDari','DimulaiDari', 'required|trim|alpha');
		$this->form_validation->set_rules('tujuanke','Tujuanke', 'required|trim|alpha');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('harga','Harga', 'required|trim|numeric');
		$this->form_validation->set_rules('lama_perjalanan','Lama_perjalanan', 'required|trim|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required|trim');
		$this->form_validation->set_rules('transBus','TransBus', 'required|trim');
		$this->form_validation->set_rules('pelanggan','Pelanggan', 'required|trim');
		$this->form_validation->set_rules('tanggalberangkat','Tanggalberangkat', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('penerbanganData','PenerbanganData', 'required|trim');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Input Tidak Valid.</div>');
			redirect(site_url('data/paket/pariwisata'));

		}else{

			$Paket 					= $this->input->post('paket');
			$kodePaket 				= $this->input->post('kodePaket');
			$namaPaket 				= $this->input->post('namapaket');
			$layanan 				= $this->input->post('layanan');
			$tujuanke 					= $this->input->post('tujuanke');
			$dimulaiDari 					= $this->input->post('dimulaiDari');
			$harga 					= $this->input->post('harga');
			$lamaPerjalanan 		= $this->input->post('lama_perjalanan');
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 		= $this->input->post('tanggalberangkat');
			$transBus 				= $this->input->post('transBus');
			$MetodeTravel 			= $this->input->post('MetodeTravel');
			$penerbanganData 			= $this->input->post('penerbanganData');
			$catatan 				= $this->input->post('catatan');
			$Waktu					= date('Y-m-d');
			$Pelanggan 				= $this->input->post('pelanggan');
			$KodePaket 				= $Paket.'-'.$kodePaket;

			$DataCek 				= [
				'id_paket'			=>$KodePaket,
				'kode_paket_data'	=>$namaPaket,
				'id_layanan'		=>$layanan,
				'tanggal_Berakhir'	=> $TanggalBerakhir
			];

			$CekKodePaket  			= $this->Paket_models->CekPaketNya($DataCek);
			if ($CekKodePaket->num_rows() > 0 ) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
				redirect(site_url('data/paket/pariwisata'));
			}else{
				if ($TanggalBerangkat < $TanggalBerakhir) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tanggal Berangkat Tidak Boleh Lebih Kecil dari tanggal berakhir</div>');
					redirect(site_url('data/paket/pariwisata'));
				}else{
					$InsertData = [
						'id_paket'				=>$kodePaket,
						'kode_paket_data'		=>$namaPaket,
						'id_layanan'			=>$layanan,
						'lama_perjalanan'		=>$lamaPerjalanan,
						'tanggal_Berakhir'		=>$TanggalBerakhir,
						'tanggal_dibuat'		=>$Waktu,
						'maxPelanggan'			=>$Pelanggan,
						'tanggal_berangkat'		=>$TanggalBerangkat,
						'id_transportasi_paket'	=>$transBus,
						'id_metode_pembayaran_paket'=>$MetodeTravel,
						'maskapai_penerbangan'		=>$penerbanganData,
						'harga'						=>$harga,
						'catatan'					=>$catatan,
						'start_in'					=>$dimulaiDari,
						'end_ind'					=>$tujuanke,
					];

					$InsertDataNya 		= $this->Paket_models->InsertDataBaru($InsertData);
					if ($InsertDataNya == true) {
						redirect(site_url('data/paket/FormKelengkapanPaket?KodePaket='.$kodePaket.''));
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
						redirect(site_url('data/paket/pariwisata'));
					}
				}
			}
		}

	}
	function updatePaket()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('namapaket','Namapaket', 'required|trim');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('harga','Harga', 'required|trim|numeric');
		$this->form_validation->set_rules('lama_perjalanan','Lama_perjalanan', 'required|trim|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required|trim');
		$this->form_validation->set_rules('transBus','TransBus', 'required|trim');
		$this->form_validation->set_rules('pelanggan','Pelanggan', 'required|trim');
		$this->form_validation->set_rules('tanggalberangkat','Tanggalberangkat', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('penerbanganData','PenerbanganData', 'required|trim');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Input Tidak Valid.</div>');
			redirect(site_url('data/paket/travel'));

		}else{

			$id 					= $this->input->post('kodePaket');
			$namaPaket 				= $this->input->post('namapaket');
			$layanan 				= $this->input->post('layanan');
			$harga 					= $this->input->post('harga');
			$lamaPerjalanan 		= $this->input->post('lama_perjalanan');
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 		= $this->input->post('tanggalberangkat');
			$transBus 				= $this->input->post('transBus');
			$MetodeTravel 			= $this->input->post('MetodeTravel');
			$penerbanganData 		= $this->input->post('penerbanganData');
			$catatan 				= $this->input->post('catatan');
			$Waktu					= date('Y-m-d');
			$Pelanggan 				= $this->input->post('pelanggan');

			$DataCek 				= [
				'kode_paket_data'	=>$namaPaket,
				'id_layanan'		=>$layanan,
				'tanggal_Berakhir'	=> $TanggalBerakhir
			];

			$CekKodePaket  			= $this->Paket_models->CekPaketNya($DataCek);
			if ($CekKodePaket->num_rows() > 1 ) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
				redirect(site_url('data/paket/travel'));
			}else{
				if ($TanggalBerangkat < $TanggalBerakhir) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tanggal Berangkat Tidak Boleh Lebih Kecil dari tanggal berakhir</div>');
					redirect(site_url('data/paket/travel'));
				}else{
					$DataNya = [
						'kode_paket_data'		=>$namaPaket,
						'id_layanan'			=>$layanan,
						'lama_perjalanan'		=>$lamaPerjalanan,
						'tanggal_Berakhir'		=>$TanggalBerakhir,
						'tanggal_dibuat'		=>$Waktu,
						'maxPelanggan'			=>$Pelanggan,
						'tanggal_berangkat'		=>$TanggalBerangkat,
						'id_transportasi_paket'	=>$transBus,
						'id_metode_pembayaran_paket'=>$MetodeTravel,
						'maskapai_penerbangan'		=>$penerbanganData,
						'harga'						=>$harga,
						'catatan'					=>$catatan,
					];

					$InsertDataNya 		= $this->Paket_models->Nonaktifkan($DataNya,$id);
					var_dump($InsertDataNya);
					if ($InsertDataNya == true) {
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Berhasil..!</div>');
						redirect(site_url('data/paket/travel'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
						redirect(site_url('data/paket/travel'));
					}
				}
			}
		}

	}

	function updatePaketParis()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('start_in','Start_in', 'required|trim|alpha');
		$this->form_validation->set_rules('end_ind','End_ind', 'required|trim|alpha');
		$this->form_validation->set_rules('namapaket','Namapaket', 'required|trim|alpha');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('harga','Harga', 'required|trim|numeric');
		$this->form_validation->set_rules('lama_perjalanan','Lama_perjalanan', 'required|trim|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required|trim');
		$this->form_validation->set_rules('transBus','TransBus', 'required|trim');
		$this->form_validation->set_rules('pelanggan','Pelanggan', 'required|trim');
		$this->form_validation->set_rules('tanggalberangkat','Tanggalberangkat', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('penerbanganData','PenerbanganData', 'required|trim');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Input Tidak Valid.</div>');
			redirect(site_url('data/paket/pariwisata'));

		}else{

			$id 					= $this->input->post('kodePaket');
			$namaPaket 				= $this->input->post('namapaket');
			$layanan 				= $this->input->post('layanan');
			$harga 					= $this->input->post('harga');
			$lamaPerjalanan 		= $this->input->post('lama_perjalanan');
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$Start_in 		= $this->input->post('start_in');
			$End_ind 		= $this->input->post('end_ind');
			$TanggalBerangkat 		= $this->input->post('tanggalberangkat');
			$transBus 				= $this->input->post('transBus');
			$MetodeTravel 			= $this->input->post('MetodeTravel');
			$penerbanganData 		= $this->input->post('penerbanganData');
			$catatan 				= $this->input->post('catatan');
			$Waktu					= date('Y-m-d');
			$Pelanggan 				= $this->input->post('pelanggan');

			$DataCek 				= [
				'kode_paket_data'	=>$namaPaket,
				'id_layanan'		=>$layanan,
				'tanggal_Berakhir'	=> $TanggalBerakhir
			];

			$CekKodePaket  			= $this->Paket_models->CekPaketNya($DataCek);
			if ($CekKodePaket->num_rows() > 1 ) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
				redirect(site_url('data/paket/travel'));
			}else{
				if ($TanggalBerangkat < $TanggalBerakhir) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tanggal Berangkat Tidak Boleh Lebih Kecil dari tanggal berakhir</div>');
					redirect(site_url('data/paket/pariwisata'));
				}else{
					$DataNya = [
						'kode_paket_data'		=>$namaPaket,
						'id_layanan'			=>$layanan,
						'lama_perjalanan'		=>$lamaPerjalanan,
						'tanggal_Berakhir'		=>$TanggalBerakhir,
						'tanggal_dibuat'		=>$Waktu,
						'maxPelanggan'			=>$Pelanggan,
						'tanggal_berangkat'		=>$TanggalBerangkat,
						'id_transportasi_paket'	=>$transBus,
						'id_metode_pembayaran_paket'=>$MetodeTravel,
						'maskapai_penerbangan'		=>$penerbanganData,
						'harga'						=>$harga,
						'start_in'						=>$Start_in,
						'end_ind'						=>$End_ind,
						'catatan'					=>$catatan,
					];

					$InsertDataNya 		= $this->Paket_models->Nonaktifkan($DataNya,$id);
					var_dump($InsertDataNya);
					if ($InsertDataNya == true) {
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Berhasil..!</div>');
						redirect(site_url('data/paket/pariwisata'));
					}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data Sudah Ada...</div>');
						redirect(site_url('data/paket/pariwisata'));
					}
				}
			}
		}

	}

	function simpanTour()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kodePaket','KodePaket', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPaket','NamaPaket', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('HargaPaket','HargaPaket', 'required|trim|numeric',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('MaxPelPaket','MaxPelPaket', 'required|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required');
		$this->form_validation->set_rules('TanggalBerangkat','TanggalBerangkat', 'required');
		$this->form_validation->set_rules('penerbangan','Penerbangan', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('dariTour','DariTour', 'required|trim');
		$this->form_validation->set_rules('TujuanTour','TujuanTour', 'required|trim');
		$this->form_validation->set_rules('LamaNya','LamaNya', 'required|trim');
		$this->form_validation->set_rules('CatatanTour','CatatanTour', 'required|trim');
		$this->form_validation->set_rules('hotel[]','Hotel[]','required');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong / Format Tidak Sesuai..!',
			];

		}else{
			$id 					= $this->session->userdata('id_akses');
			$kodePaket 				= htmlentities($this->input->post('kodePaket'));
			$namaPaket 				= htmlentities($this->input->post('namaPaket'));
			$HargaPaket 			= htmlentities($this->input->post('HargaPaket'));
			$MaxPelPaket 			= htmlentities($this->input->post('MaxPelPaket'));
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 		= $this->input->post('TanggalBerangkat');
			$Gabungkan 				= htmlentities($this->input->post('penerbangan'));
			$Layanan 				= htmlentities($this->input->post('layanan'));
			$MS 					= htmlentities($this->input->post('namaPaketNya'));
			$DariTour 				= htmlentities($this->input->post('dariTour'));
			$TujuanTour 			= htmlentities($this->input->post('TujuanTour'));
			$LamaNya 				= htmlentities($this->input->post('LamaNya'));
			$CatatanTour 			= htmlentities($this->input->post('CatatanTour'));
			$Hotel 					= $this->input->post('hotel');
			$perlengkapan 			= $this->input->post('perlengkapan');
			$dataPerlengkapan 		= implode(",", $perlengkapan);
			$MetodeTravel 			= $this->input->post('MetodeTravel');
			$KendaraanTravel 		= $this->input->post('KendaraanTravel');
			$JumlahHotel			= implode(',', $Hotel);
			$CekKodePaket 			= $this->Paket_models->CekPaket($kodePaket)->num_rows();
			$CekKursi  				= $this->Penerbangan_models->CekData($Gabungkan)->row_array();
			$JumlahKursiTersedia 	= $CekKursi['jumlah_kursi'];
			$idKursi 				= $CekKursi['id'];
			if ($CekKodePaket > 0 ) {

				$respone = [
					'status' => 'error',
					'message' => 'Terjadi Kesalahan..!',
				];

			}else{

				if ($MaxPelPaket > $JumlahKursiTersedia) {
					$respone = [
						'status' => 'error',
						'message' => 'Maaf Maksimal Pelanggan Melebihi Jumlah Kursi Dari Maskapai yang telah Ditentukan..!',
					];
				}else{
					$H 						= count($Hotel);
					$K = 1;
					if ($H <= $K) {

						$respone = [
							'status' => 'error',
							'message' => 'Minimal 2 Hotel..!',
						];

					}else{
						$TB 	= date('Y-m-d',strtotime($TanggalBerangkat));
						$TD 	= date('Y-m-d',strtotime($TanggalBerakhir));

						if ($TD > $TB) {
							$respone = [
								'status' => 'error',
								'message' => 'Maaf Tanggal Berangkat Tidak Boleh Lebih Cepat Dari Tanggal Berakhir Paket..!',
							];

						}else{

							$DataNyaLah =[
								'status_paket'		=> 1,
								'id_akses'			=> $id,
								'id_paket'			=> $kodePaket,
								'kode_paket'		=> $MS,
								'id_layanan'		=> $Layanan,
								'id_penerbangan' 	=> $idKursi,
								'JumlahPelanggan'	=> $MaxPelPaket,
								'nama_paket'		=> $namaPaket,
								'harga_paket'		=> $HargaPaket,
								'id_hotel'			=> $JumlahHotel,
								'id_metode'			=> $MetodeTravel,
								'id_transportasi'	=> $KendaraanTravel,
								'id_lanjutan'		=> $dataPerlengkapan,
								'tanggal_Berakhir'	=> $TanggalBerakhir,
							];

							$InsertLagi = [
								'id_paketnya'		=> $kodePaket,
								'catatan'			=> $CatatanTour,
								'dari'				=> $DariTour,
								'tujuan'			=> $TujuanTour,
								'lama_perjalanan'	=> $LamaNya,
							];

							$nomor 					= $Gabungkan;
							$UT 					= date('Y-m-d H:i:s');
							$DataNya  = [
								'tanggal_digunakan' => $UT
							];

							$DataBerangkat = [
								'paket_id'	=> $kodePaket,
								'tanggal_berangkat' => $TanggalBerangkat
							];

							$Insert           	= $this->Paket_models->InsertTour($DataNyaLah);
							if ($Insert == true) {
								$Insert           		= $this->Paket_models->InsertKeteranganTour($InsertLagi);
								$Insert           	= $this->JadwalBerangkat_models->Insert($DataBerangkat);
								$InsertLagi          = $this->Penerbangan_models->UpdateMaskapaiNya($DataNya,$nomor);
								$respone = [
									'status' => 'success',
									'message' => 'Berhasil Menambahkan Data',
								];

							}else{
								$respone = [
									'status' => 'error',
									'message' => 'Ada Kesalahan..!',
								];
							}
						}
					}
				}
			}


		}

		echo json_encode($respone);
	}

	function simpanTourUbah()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kodePaket','KodePaket', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPaket','NamaPaket', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('HargaPaket','HargaPaket', 'required|trim|numeric',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('MaxPelPaket','MaxPelPaket', 'required|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required');
		$this->form_validation->set_rules('TanggalBerangkat','TanggalBerangkat', 'required');
		$this->form_validation->set_rules('penerbangan','Penerbangan', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');
		$this->form_validation->set_rules('dariTour','DariTour', 'required|trim');
		$this->form_validation->set_rules('TujuanTour','TujuanTour', 'required|trim');
		$this->form_validation->set_rules('LamaNya','LamaNya', 'required|trim');
		$this->form_validation->set_rules('CatatanTour','CatatanTour', 'required|trim');
		$this->form_validation->set_rules('KendaraanTravel','KendaraanTravel', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong / Format Tidak Sesuai..!',
			];

		}else{
			$id 					= $this->session->userdata('id_akses');
			$kodePaket 				= htmlentities($this->input->post('kodePaket'));
			$namaPaket 				= htmlentities($this->input->post('namaPaket'));
			$HargaPaket 			= htmlentities($this->input->post('HargaPaket'));
			$MaxPelPaket 			= htmlentities($this->input->post('MaxPelPaket'));
			$TanggalBerakhir 		= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 		= $this->input->post('TanggalBerangkat');
			$nomor 					= htmlentities($this->input->post('penerbangan'));
			$Layanan 				= htmlentities($this->input->post('layanan'));
			$DariTour 				= htmlentities($this->input->post('dariTour'));
			$TujuanTour 			= htmlentities($this->input->post('TujuanTour'));
			$LamaNya 				= htmlentities($this->input->post('LamaNya'));
			$CatatanTour 			= htmlentities($this->input->post('CatatanTour'));
			$KendaraanTravel 		= htmlentities($this->input->post('KendaraanTravel'));
			$MetodeTravel 			= htmlentities($this->input->post('MetodeTravel'));


			$CekKodePaket 			= $this->Paket_models->CekPaket($kodePaket)->num_rows();
			$CekKursi  				= $this->Penerbangan_models->Cek($nomor)->row_array();


			$JumlahKursiTersedia 	= $CekKursi['jumlah_kursi'];
			$idKursi 				= $CekKursi['id'];
			if ($CekKodePaket > 1 ) {

				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Terjadi Kesalahan..!',
				];

			}else{

				if ($MaxPelPaket > $JumlahKursiTersedia) {
					$respone = [
						'status' => 'error',
						'message' => 'Maaf Maksimal Pelanggan Melebihi Jumlah Kursi Dari Maskapai yang telah Ditentukan..!',
					];
				}else{

					$TB 	= date('Y-m-d',strtotime($TanggalBerangkat));
					$TD 	= date('Y-m-d',strtotime($TanggalBerakhir));

					if ($TD > $TB) {
						$respone = [
							'status' => 'error',
							'message' => 'Maaf Tanggal Berangkat Tidak Boleh Lebih Cepat Dari Tanggal Berakhir Paket..!',
						];

					}else{

						$DataNyaLah =[
							'status_paket'		=> 1,
							'id_akses'			=> $id,
							'id_layanan'		=> $Layanan,
							'id_penerbangan' 	=> $nomor,
							'JumlahPelanggan'	=> $MaxPelPaket,
							'nama_paket'		=> $namaPaket,
							'harga_paket'		=> $HargaPaket,
							'id_metode'			=> $MetodeTravel,
							'id_transportasi'	=> $KendaraanTravel,
							'tanggal_Berakhir'	=> $TanggalBerakhir,
						];

						$InsertLagi = [
							'catatan'			=> $CatatanTour,
							'dari'				=> $DariTour,
							'tujuan'			=> $TujuanTour,
							'lama_perjalanan'	=> $LamaNya,
						];

						$UT 					= date('Y-m-d H:i:s');
						$DataNya  = [
							'tanggal_digunakan' => $UT
						];

						$DataBerangkat = [
							'tanggal_berangkat' => $TanggalBerangkat
						];

						$Insert           		= $this->Paket_models->UpdateKeteranganTour($InsertLagi,$kodePaket);

						if ($Insert == true) {
							$Insert           	= $this->Paket_models->UpdateTour($DataNyaLah,$kodePaket);
							$Insert           	= $this->JadwalBerangkat_models->UpdateTour($DataBerangkat,$kodePaket);
							$InsertLagi         = $this->Paket_models->UpdatePenerbangan($DataNya,$nomor);
							$respone = [
								'status' => 'success',
								'message' => 'Berhasil Mengubah Data',
							];

						}else{
							$respone = [
								'status' => 'error',
								'message' => 'Ada Kesalahan..!',
							];
						}
					}
				}
			}
		}

		echo json_encode($respone);
	}
	function simpanperlengkapanpaket()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('inamapaket','Inamapaket', 'required|trim');
		$this->form_validation->set_rules('id','Id', 'required|trim');
		$this->form_validation->set_rules('jumlah','Jumlah', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan..!',
			];

		}else{
			$kodePaket 			= htmlentities($this->input->post('inamapaket'));
			$id 				= htmlentities($this->input->post('id'));
			$jumlah 			= htmlentities($this->input->post('jumlah'));
			$DataNyaLah =[
				'id_perlengkapan_paket'		=> $kodePaket,
				'id_kelengkapan'			=> $id,
			];

			$CekData = $this->Paket_models->CekDataNya($DataNyaLah);
			if ($CekData->num_rows() > 0) {
				$respone = [
					'status' => 'error',
					'message' => 'Data Sudah Ada..!',
				];
			}else{
				$Data = [
					'id_perlengkapan_paket' => $kodePaket,
					'id_kelengkapan'		=> $id,
					'jumlah'				=>$jumlah
				];

				$Insert        = $this->Paket_models->InsertPerlengkapan($Data);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil Mengubah Data',
					];

				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal Input data..!',
					];
			// }
				}
			}
		}
		echo json_encode($respone);
	}

	function simpanHotel()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('idname','i=Idname', 'required|trim');
		$this->form_validation->set_rules('id','Id', 'required|trim');
		$this->form_validation->set_rules('rules','Rules', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan..!',
			];

		}else{
			$kodePaket 			= htmlentities($this->input->post('idname'));
			$id 				= htmlentities($this->input->post('id'));
			$jumlah 			= htmlentities($this->input->post('rules'));
			$DataNyaLah =[
				'id_paket_hotel'		=> $kodePaket,
				'rules_hotel'			=> $jumlah,
				'id_hotel'			=> $id,
			];

			$CekData = $this->Hotel_models->CekDataNya($DataNyaLah);
			if ($CekData->num_rows() > 0) {
				$respone = [
					'status' => 'error',
					'message' => 'Data Sudah Ada..!',
				];
			}else{
				$Data = [
					'id_paket_hotel' => $kodePaket,
					'rules_hotel'		=> $jumlah,
					'id_hotel'				=>$id
				];

				$Insert        = $this->Hotel_models->InsertPaketHotel($Data);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil Mengubah Data',
					];

				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal Input data..!',
					];
			// }
				}
			}
		}
		echo json_encode($respone);
	}

	function simpanUBah()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('namaPaket','NamaPaket', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('HargaPaket','HargaPaket', 'required|trim|numeric',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('MaxPelPaket','MaxPelPaket', 'required|numeric');
		$this->form_validation->set_rules('TanggalBerakhir','TanggalBerakhir', 'required');
		$this->form_validation->set_rules('TanggalBerangkat','TanggalBerangkat', 'required');
		$this->form_validation->set_rules('penerbangan','Penerbangan', 'required|trim');
		$this->form_validation->set_rules('MetodeTravel','MetodeTravel', 'required|trim');
		$this->form_validation->set_rules('layanan','Layanan', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong / Format Tidak Sesuai..!',
			];

		}else{
			$id 																= $this->session->userdata('id_akses');
			$kodePaket 									= htmlentities($this->input->post('kodePaket'));
			$namaPaket 									= htmlentities($this->input->post('namaPaket'));
			$HargaPaket 								= htmlentities($this->input->post('HargaPaket'));
			$MaxPelPaket 							= htmlentities($this->input->post('MaxPelPaket'));
			$TanggalBerakhir 			= $this->input->post('TanggalBerakhir');
			$TanggalBerangkat 			= $this->input->post('TanggalBerangkat');
			$nomor 													= htmlentities($this->input->post('penerbangan'));
			$Layanan 											= htmlentities($this->input->post('layanan'));
			$MetodeTravel 						= $this->input->post('MetodeTravel');
			$KendaraanTravel 			= $this->input->post('KendaraanTravel');

			$CekKodePaket 						= $this->Paket_models->CekPaket($kodePaket)->num_rows();
			$CekKursi  									= $this->Penerbangan_models->Cek($nomor)->row_array();
			$JumlahKursiTersedia= $CekKursi['jumlah_kursi'];
			if ($CekKodePaket > 1 ) {
				$respone = [
					'status' => 'error',
					'message' => 'Terjadi Kesalahan..!',
				];

			}else{

				if ($MaxPelPaket > $JumlahKursiTersedia) {
					$respone = [
						'status' => 'error',
						'message' => 'Maaf Maksimal Pelanggan Melebihi Jumlah Kursi Dari Maskapai yang telah Ditentukan..!',
					];
				}else{

					$TB 	= date('Y-m-d',strtotime($TanggalBerangkat));
					$TD 	= date('Y-m-d',strtotime($TanggalBerakhir));

					if ($TD > $TB) {
						$respone = [
							'status' => 'error',
							'message' => 'Maaf Tanggal Berangkat Tidak Boleh Lebih Cepat Dari Tanggal Berakhir Paket..!',
						];

					}else{

						$DataNyaLah =[
							'status_paket'					=> 1,
							'id_akses'									=> $id,
							'id_layanan'							=> $Layanan,
							'id_penerbangan' 		=> $nomor,
							'tanggal_Berakhir'	=> $TanggalBerakhir,
							'JumlahPelanggan'		=> $MaxPelPaket,
							'nama_paket'							=> $namaPaket,
							'harga_paket'						=> $HargaPaket,
							'id_metode'								=> $MetodeTravel,
							'id_transportasi'		=> $KendaraanTravel,
						];

						$UT 						= date('Y-m-d H:i:s');
						$DataNya  = [
							'tanggal_digunakan' => $UT
						];
						$DataBerangkat = [
							'tanggal_berangkat' => $TanggalBerangkat
						];


						$Insert           		= $this->Paket_models->Update($DataNyaLah,$kodePaket);
						if ($Insert == true) {
							$Insert           	= $this->JadwalBerangkat_models->UpdateTour($DataBerangkat,$kodePaket);

							$InsertLagi         = $this->Penerbangan_models->UpdatePenerbangan($DataNya,$nomor);
							$respone = [
								'status' => 'success',
								'message' => 'Berhasil Menambahkan Data',
							];
						}else{
							$respone = [
								'status' => 'error',
								'message' => 'Gagal Mengubah Data..!',
							];
						}

					}
				}
			}
		}

		echo json_encode($respone);
	}



	public function info()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$id 					= $this->session->userdata('id_akses');
			$DataNya       			= $this->Pengguna_models->DataUbah($id)->row_array();
			$kodePaket 				= base64_decode($this->input->get('kode'));
			$DataPaket 				= $this->Paket_models->InformasiPaket($kodePaket)->row_array();
			$idPaketLayanan 		= $DataPaket['id_paket'];

			if ($idPaketLayanan == 0) {
				redirect('Error');

			}else{
				$data['id']         	= $DataNya['id_akses'];
				$data['Level']         	= $DataNya['id_layanan'];
				$data['nama']       	= $DataNya['username'];
				$data['Perusahaan'] 	= $this->Perusahaan_models->Tentang();
				$data['nomor'] 			= $DataPaket['id_penerbangan'];
				$nomor 					= $DataPaket['id_penerbangan'];
				$idNya  				= $DataPaket['id_metode'];
				$DataPenerbangan 		= $this->Penerbangan_models->Cek($nomor)->row_array();
				$data['NamaMaskapai']	= $DataPenerbangan['nama_maskapai'];
				$data['KodePenerbangan']= $DataPenerbangan['kode_penerbangan'];
				$data['idPS']			= $DataPenerbangan['id'];
				$data['Tpd'] 			= $DataPaket['id_transportasi'];
				$KodeBus 				= $DataPaket['id_transportasi'];
				$DataBus 				= $this->Paket_models->DataBus($KodeBus)->row_array();
				$data['NamaBus']		= $DataBus['nama_bus'];
				$data['KodeBus']		= $DataBus['id'];
				$idLayanan 				= $DataPaket['id_layanan'];
				$dataLay				= $this->Layanan_models->DataLayanan($idLayanan)->row_array();
				$data['namaLayanan'] 	= $dataLay['nama_layanan'];
				$data['KodeBarang'] 	= $DataPaket['id_lanjutan'];
				$data['Perlengkapan']   = $this->Perlengkapan_models->Data()->result();

				$idAkses 		 					= $DataPaket['id_akses'];
				$data['idHotel']		= $DataPaket['id_hotel'];
				$data['idHotels']		= $DataPaket['id_hotel'];
				$data['DataPembayaran'] = $this->MetodePembayaran_models->Keterangan_metode($idNya)->result();
				$data['DataHotel'] 		= $this->Hotel_models->Data()->result();
				$data['alert'] 			= '<div  class="alert alert-danger alert-dismissable">
				Tidak Ada Data...!</div>';
				$data['NULL'] 			= '<div  class="alert alert-danger alert-dismissable">
				Tidak Diketahui...!</div>';
				$data['namaPaket'] 		= $DataPaket['nama_paket'];
				$data['tanggalAwal']	= format_indo($DataPaket['tanggal_dibuat']);
				$data['tanggalAkhir'] 	= format_indo($DataPaket['tanggal_Berakhir']);
				$data['Jumlah'] 		= rupiah($DataPaket['harga_paket']);
				$data['Penyu'] 		  	= penyebut($DataPaket['harga_paket']);
				$data['JumlahPelanggan']= $DataPaket['JumlahPelanggan'];

				$dataKeterangan			= $this->Paket_models->KeteranganTour($idPaketLayanan)->row_array();
				$DataBerangkat			= $this->Paket_models->KeteranganTour($idPaketLayanan)->row_array();
				$DataBerangkat			= $this->JadwalBerangkat_models->Select($idPaketLayanan)->row_array();
				$data['TanggalBerangkat'] = $DataBerangkat['tanggal_berangkat'];
				if ($dataKeterangan == '') {
					$this->template->layout('paket/travel/info.php',$data);
				}else{
					$data['Tujuan']			= $dataKeterangan['tujuan'];
					$data['Dari']			= $dataKeterangan['dari'];
					$data['lama_perjalanan']= $dataKeterangan['lama_perjalanan'];
					$data['Catatan']		= $dataKeterangan['catatan'];
					$this->template->layout('paket/tour/info.php',$data);
				}
			}
		}else{
			redirect('Error/AksesError');
		}

	}


	public function DataTravel()
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
			0=>'id_paket',
			1=>'nama_paket',
			2=>'nama_layanan',
			3=>'nama_maskapai',
			4=>'nama_bus',
			5=>'tanggal_dibuat',
			6=>'harga_paket'
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
		$Menus = $this->Paket_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayanan = $rows->id_paket;
			$data[]= array(
				$no++,
				$rows->id_paket,
				'<a href="info?kode='.base64_encode($idLayanan).'">'.
				strtoupper($rows->nama_layanan. ' '.$rows->nama_paket).'</a>',
				rupiah($rows->harga_paket),
				date('d-m-Y',strtotime($rows->tanggal_dibuat)),
				$rows->nama_lengkap,
				$rows->status_paket == 1 ? 
				'<a href="Ubah?kode='.base64_encode($idLayanan).'" type="button" class="editData fa fa-edit" title="Edit Data" ></a> 
				<a type="button" id="'.$idLayanan.'" nama="'.$rows->nama_layanan.'" 	class=" Hapus fa fa-sign-out" title="Menonaktifkan Paket..!"></a>' : ($rows->status_paket == 2 ? 
					' <a type="button" id="'.$idLayanan.'" nama="'.$rows->nama_layanan.'" 	class=" Aktifkan fa fa-arrow-left" title="Aktifkan Paket..!"></a> ' : '')

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

	public function DataTour()
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
			0=>'id_paket',
			1=>'nama_paket',
			2=>'nama_layanan',
			3=>'nama_maskapai',
			4=>'nama_bus',
			5=>'tanggal_dibuat',
			6=>'nama_lengkap',
			7=>'harga_paket',
			8=>'dari',
			9=>'tujuan'

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
		$Menus = $this->Paket_models->DataTour();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayanan 	= $rows->id_paket;
			$data[]= array(
				$no++,
				$rows->id_paket,
				'<a href="info?kode='.base64_encode($idLayanan).'">'.
				strtoupper($rows->nama_layanan. ' '.$rows->nama_paket).'</a>',
				$rows->dari. ' / '. $rows->tujuan,
				rupiah($rows->harga_paket),
				date('d-m-Y',strtotime($rows->tanggal_dibuat)),
				$rows->nama_lengkap,
				$rows->status_paket == 1 ? 
				'<a href="Ubah?kode='.base64_encode($idLayanan).'" type="button" class="editData fa fa-edit" title="Edit Data" ></a> 
				<a type="button" id="'.$idLayanan.'" nama="'.$rows->nama_layanan.'" 	class=" Hapus fa fa-sign-out" title="Menonaktifkan Paket..!"></a>' : ($rows->status_paket == 2 ? 
					' <a type="button" id="'.$idLayanan.'" nama="'.$rows->nama_layanan.'" 	class=" Aktifkan fa fa-arrow-left" title="Aktifkan Paket..!"></a> ' : '')
			);    
		}

		$TotalNyaTour = $this->TotalNyaTour();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $TotalNyaTour,
			"recordsFiltered" => $TotalNyaTour,
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}


	public function TotalNya()
	{
		$Paket = 'T';
		$query = $this->db->select("COUNT(*) as num")->where('kode_paket',$Paket)->get("db_paket");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}


	public function TotalNyaTour()
	{
		$Paket = 'H';
		$query = $this->db->select("COUNT(*) as num")->where('kode_paket',$Paket)->get("db_paket");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

}