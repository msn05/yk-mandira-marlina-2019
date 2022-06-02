<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pembayaran extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Paket_models','Pengguna_models','Pembayaran_models','Pemesanan_models']);
		$this->load->library('template');
		
		False();
	}

	public function laporan()
	{
		$this->load->library('pdf');
		$this->load->helper('Rupiah');
		$idPembayaran 	= $this->input->get('idDataPembayaran');
		if($idPembayaran != NULL){
			$AbmbilKodePaket = $this->Pembayaran_models->idPemesanan($idPembayaran)->row_array();

			$kode  					 = $AbmbilKodePaket['id_pelanggan'];
			$idDataNya  			 	= $AbmbilKodePaket['id_paket'];
			$id  			 		= $AbmbilKodePaket['id_karyawan'];
			$Karyawan 					= $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['namaKaryawan'] 				= $Karyawan['nama_lengkap'];
			$Paket	 						    = $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
			$data['nama_paket'] 	= $Paket['kode_paket_data'];
			$data['nama_layanan'] 	= $Paket['nama_layanan'];
			$data['id_paket'] 		= $Paket['id_paket'];

			$AbmbilKodePemesanan	 = $this->Pengguna_models->DataShow($kode)->row_array();

			$data['Total']		 =  $AbmbilKodePaket['nominal'] - $AbmbilKodePaket['jumlah'];
			$data['nomorTagihan']	 = $AbmbilKodePaket['id_detail_tagihannya'];
			$data['nominal']			 = $AbmbilKodePaket['nominal'];
			$data['tanggal']			 = $AbmbilKodePaket['tanggal'];
			$data['jumlah']			 = $AbmbilKodePaket['jumlah'];
			$data['hal_tagihan']	 = $AbmbilKodePaket['hal_tagihan'];
			$data['kodepesan']		 = $AbmbilKodePaket['id_pemesanan'];
			$data['nama_lengkap']	 	=$AbmbilKodePemesanan['nama_lengkap'];
			$data['alamat']	 		=$AbmbilKodePemesanan['alamat'];
			$data['note']			 = 'Segera Melakukan pembayaran layanan jika ingin merasakan layanan yang dipilih.';
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "laporan pembayaran.pdf";
			$this->pdf->load_view('pembayaran/data/travel/laporan_pembayaran.php', $data);
		}
	}

	public function Travel()
	{
		$Level = $this->session->userdata('id_level'); 
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['Level']           = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		if ($Level == 1 || $Level == 3) {
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['paket']			= $this->Pembayaran_models->Data();
			$this->template->layout('pembayaran/data/travel/index.php',$data);
		}else{
			redirect('error');
		}
	}

	public function DataPembayaran()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3 || $Level ==2) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$Pembayaran 			= base64_decode($this->input->get('idData'));
			$data['Keterangan'] 	= base64_decode($this->input->get('Aktivasi'));
			if ($Pembayaran != NULL)
			{
				$data['kodePembayaran']	= $Pembayaran;
				$data['pembayaran']				= $this->Pembayaran_models->ShowDetail($Pembayaran);
				$data['Totalpembayaran']		= $this->Pembayaran_models->TotalBayaran($Pembayaran)->row_array();
				$this->template->layout('pembayaran/data/travel/detailPembayaran.php',$data);
			}else{
				redirect('Errro/ErrorData');
			}
		}else{
			redirect('Error/AksesError');
		}

	}
	public function delete()
	{

		$idData 			= $this->input->post('name_id');
		if ($idData != NULL)
		{
			$Insert = $this->Pembayaran_models->DeletePembayaranDetail($idData);
			if ($Insert == true) {
				$respone = [
					'status' 	=> 'success',
					'message' 	=> 'Berhasil..!',
				];
			}else{
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Gagal..!',
				];
			}
		}else{
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Terjadi Kesalahan..!',
			];
		}
		echo json_encode($respone);
	}

	public function simpanData(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nominal','Nominal', 'required|trim|numeric');
		$this->form_validation->set_rules('note','Note', 'required|trim');
		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Format Tidak Sesuai / Form Kosong..!',
			];
		}else{
			$Pembayaran = $this->input->post('idPaket');
			$nominal 	= $this->input->post('nominal');
			$karyawan 	= $this->session->userdata('id_akses');
			$note 		= $this->input->post('note');
			$date 		= date('Y-m-d H:i:s');
			$idPembayaran 			= $Pembayaran;
			$Totalpembayaran		= $this->Pembayaran_models->TotalBayaran($Pembayaran)->row_array();
			$KeseluruhanData 		= $Totalpembayaran['TotalBayar'];
			$TotalBiaya				= $this->Pembayaran_models->JumlahUang($idPembayaran)->row_array();

			$KodePemesanan 			= $TotalBiaya['kode_pemesanan'];
			$CekPembayaran = [
				'id_pemesanan' => $KodePemesanan,
			];

			$PelangganPesan 					 = $this->Pemesanan_models->CekPesanan($CekPembayaran)->row_array();
			$idData = $PelangganPesan['id'];

			$Kode 					= $PelangganPesan['id_pelanggan'];
			$Paketnya 				= $PelangganPesan['id_paket'];
			$TotalData 				= $TotalBiaya['nominal'];
			$JumlahBayar 	 		= $KeseluruhanData + $nominal;

			if ($JumlahBayar > $TotalData) {
				$respone = [
					'status' 	=> 'error',
					'message' 	=> 'Maaf Jumlah Bayar Tidak Sesuai..!',
				];
			}else{
				if ($JumlahBayar == $TotalData) {
					$Pemesanan = [
						'status' =>3,
					];
					$PelangganBerangkat = [
						'id'  =>$idData,
						'id_pelanggan'  =>$Kode,
						'paket_id'		=>$Paketnya,
					];
					$DataNya = [
						'id_detail_tagihan' =>$idPembayaran,
						'jumlah'		=>$nominal,
						'tanggal'		=>$date,
						'id_karyawan'	=>$karyawan, 
						'hal_tagihan'	=>$note,
					];

					$Insert = $this->Pembayaran_models->insert($DataNya);
					if ($Insert == true) {
						$InsertLagi = $this->Pemesanan_models->UpdateStatus($Pemesanan,$KodePemesanan);
						$InsertLagiYo = $this->Pembayaran_models->BerangkatPelanggan($PelangganBerangkat);
						$respone = [
							'status' 	=> 'success',
							'message' 	=> 'Berhasil..!',
						];
					}
					
				}else{
					$DataNya = [
						'id_detail_tagihan' =>$idPembayaran,
						'jumlah'		=>$nominal,
						'tanggal'		=>$date,
						'id_karyawan'	=>$karyawan, 
						'hal_tagihan'	=>$note,
					];

					$Insert = $this->Pembayaran_models->insert($DataNya);
					$respone = [
						'status' 	=> 'success',
						'message' 	=> 'Berhasil..!',
					];

				}
			}
		}
		echo json_encode($respone);
	}

}