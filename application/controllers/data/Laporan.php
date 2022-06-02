<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Bus_models','Pengguna_models','Pembayaran_models']);
		$this->load->library('template');
		False();
	}

	public function data()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		$idData =base64_decode($this->input->get('idData'));
		if ($idData == 'Pelanggan') {
			$data['Pelanggan'] = $this->Pengguna_models->DataPelanggan();
			$this->template->layout('Laporan/Pelanggan/index.php',$data);
		}else{
			$data['paket']			= $this->Pembayaran_models->Data();
			$this->template->layout('Laporan/Tagihan/index.php',$data);
		}
	}
	public function PelangganLaporan()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		$tanggal1 = $this->input->get('date1');
		$tanggal2 = $this->input->get('date2');
		if ($tanggal1 != '' &&  $tanggal2 != '') {

			$data['Pelanggan'] = $this->Pengguna_models->LaporanPelanggan($tanggal1,$tanggal2);
			$data['date1'] = $tanggal1;
			$data['date2'] = $tanggal2;
			$this->template->layout('Laporan/Pelanggan/data.php',$data);
		}else{
			redirect('error');
		}
	}
	public function TagihanLaporan()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		$tanggal1 = $this->input->get('date1');
		$tanggal2 = $this->input->get('date2');
		if ($tanggal1 != '' &&  $tanggal2 != '') {

			$data['paket'] = $this->Pembayaran_models->LaporanTagihan($tanggal1,$tanggal2);
			$data['date1'] = $tanggal1;
			$data['date2'] = $tanggal2;
			$this->template->layout('Laporan/Tagihan/data.php',$data);
		}else{
			redirect('error');
		}
	}

	public function Pelanggan()
	{
		$tanggal1    = $this->input->post('tanggal1');
		$tanggal2   = $this->input->post('tanggal2');
		if (empty($tanggal1) && empty($tanggal2)) {
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong...!',
			];

		}else{
			$CekDataDaftar = $this->Pengguna_models->LaporanPelanggan($tanggal1,$tanggal2);
			if ($CekDataDaftar->num_rows() > 0) {
				$respone = [
					'status' => 'success',
					'message' => 'Data Tersedia',
					'kode'	=> $tanggal1,
					'kode2'	=> $tanggal2,
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Tidak Tersedia',
				];
			}
		}
		echo json_encode($respone);
	}

	public function Tagihan()
	{
		$tanggal1    = $this->input->post('tanggal1');
		$tanggal2   = $this->input->post('tanggal2');
		if (empty($tanggal1) && empty($tanggal2)) {
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong...!',
			];

		}else{
			$CekDataDaftar = $this->Pembayaran_models->LaporanTagihan($tanggal1,$tanggal2);
			if ($CekDataDaftar->num_rows() > 0) {
				$respone = [
					'status' => 'success',
					'message' => 'Data Tersedia',
					'kode'	=> $tanggal1,
					'kode2'	=> $tanggal2,
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Tidak Tersedia',
				];
			}
		}
		echo json_encode($respone);
	}

	public function CetakPelanggan()
	{
		$this->load->library('pdf');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$date1 = $this->input->get('date1');
		$date2 = $this->input->get('date2');
		$tanggal1 = $date1;
		$tanggal2 = $date2;
		$data['tanggal1'] = $date1;
		$data['tanggal2'] = $date2;
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Pelanggan'] = $this->Pengguna_models->LaporanPelanggan($tanggal1,$tanggal2);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "laporan daftar Pelanggan.pdf";
		$this->pdf->load_view('Laporan/Pelanggan/laporanNya.php', $data);
	}

	public function CetakTagihan()
	{
		$this->load->library('pdf');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$date1 = $this->input->get('date1');
		$date2 = $this->input->get('date2');
		$tanggal1 = $date1;
		$tanggal2 = $date2;
		$data['tanggal1'] = $date1;
		$data['tanggal2'] = $date2;
		$data['paket'] = $this->Pembayaran_models->LaporanTagihan($tanggal1,$tanggal2);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = "laporan Tagihan Pembayaran Pelanggan.pdf";
		$this->pdf->load_view('Laporan/Tagihan/laporanNya.php', $data);
	}
}
