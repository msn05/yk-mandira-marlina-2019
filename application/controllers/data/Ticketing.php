<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ticketing extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Layanan_models','Pengguna_models','Pemesanan_models','Penerbangan_models','Tiket_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$Level = $this->session->userdata('id_level'); 
		$this->load->helper('Tanggal');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		if ($Level == 1 || $Level == 3) {
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['variable']		= $this->Tiket_models->ShowData();
			$this->template->layout('tiket/index.php',$data);
		}elseif($Level == 2){
			$Kode 					= $id;
			$DataNSiswa             = $this->Pengguna_models->DataShow1($Kode)->row_array();
			$pelanggan           	= $DataNSiswa['id'];
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['variable']		= $this->Tiket_models->ShowData1($pelanggan);

		}else{
			redirect('Error/AksesError');

		}
	}

	public function InfoKursi()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']			= $Level;
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$Keterangan 			= $this->input->get('idKuris');
			if ($Keterangan != NULL) {
				$dataKursi = base64_decode($Keterangan);
				$data['idLaporan'] = $dataKursi;

				$CekData = [
					'id_tiket_data'=>$dataKursi,
				];

				$data['TotalLevel'] = $this->Tiket_models->TotalDataKursi($dataKursi)->row_array();
				$data['KursiData'] 	= $this->Tiket_models->CekDataTiket($CekData);
				$this->template->layout('tiket/InfoTiket.php',$data);
			}else{
				redirect('Error/ErrorData');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function laporan()
	{
		$this->load->library('pdf');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];

		$idPembayaran 	= base64_decode($this->input->get('idDataTiket'));
		if($idPembayaran != NULL){
			$CekData = [
				'id_tiket_data'	=>$idPembayaran,
			];
			$dataKursi = $idPembayaran;
			$data['TotalLevel'] = $this->Tiket_models->TotalDataKursi($dataKursi)->row_array();
			$data['KursiData']	 	= $this->Tiket_models->CekDataTiket($CekData);
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "laporan data tiket.pdf";
			$this->pdf->load_view('tiket/laporan_tiket.php', $data);
		}
	}
	public function formTiketing()
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

			$data['variable'] 		= $this->Penerbangan_models->DataTravel();
			$this->template->layout('Tiket/formTiketingData.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function UbahData()
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
			$TiketData 				= $this->input->get('idData');
			if ($TiketData != NULL) {
				$idData 		= base64_decode($TiketData);
				$CekData = ['id_tiket_YKM' => $idData,];
				$variable 		= $this->Tiket_models->CekData($CekData)->row_array();
				$data['id_tiket_YKM'] 	= $variable['id_tiket_YKM'];
				$data['id_penerbangan'] = $variable['id_penerbangan'];
				$data['kode_pesawat'] 	= $variable['kode_pesawat'];
				$data['id_data_tiket'] 	= $variable['id_data_tiket'];
				$data['waktu_berangkat']= $variable['waktu_berangkat'];
				$data['tanggal'] 		= $variable['tanggal'];
				$data['to'] 			= $variable['to'];
				$data['form'] 			= $variable['form'];
				$data['bandara1'] 		= $variable['bandara1'];
				$data['bandara2'] 		= $variable['bandara2'];
				$data['Jumlah_tiket'] 	= $variable['Jumlah_tiket'];
				$data['variable1'] 		= $this->Penerbangan_models->DataTravel();

				$this->template->layout('Tiket/formUBahTiketingData.php',$data);
			}else{
				redirect('Error/ErrorData');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function UbahDataTiket()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']			= $Level;
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$KursiUbahData 			= base64_decode($this->input->get('idData'));

			if ($KursiUbahData != '') {
				$CekData = [
					'id'	=>$KursiUbahData,
				];
				$kursiNya	 = $this->Tiket_models->CekDataTiket($CekData)->row_array();
				$data['id']	 			= $kursiNya['id'];
				$data['id_tiket_data']	 = $kursiNya['id_tiket_data'];
				$data['level']	 = $kursiNya['level'];
				$data['harga']	 = $kursiNya['harga'];
				$data['jumlah']	 = $kursiNya['jumlah'];
				$this->template->layout('Tiket/formUbahTiketingKursi.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function ketentuanHarga()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']			= $Level;
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$ketentuanHarga			= base64_decode($this->input->get('idKetentuan'));
			if ($ketentuanHarga != '') {
				$data['Ketentuan']	 = $this->Tiket_models->ShowKetentuanHarga($ketentuanHarga);
				$data['ketentuanHarga']	= $ketentuanHarga;
				$this->template->layout('Tiket/formTiketingDataHarga.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}
	public function TambahPesanan()
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
			$ketentuanHarga			= base64_decode($this->input->get('idData'));
			if ($ketentuanHarga != '') {
				$data['headerMenu']	='Form Pesan Tiket';
				$data['pelanggan']	 = $this->Pengguna_models->DataPelanggan();
				$data['idTiket']	 = $ketentuanHarga;
				$this->template->layout('Pesan Tiket/formTambahPesanTiket.php',$data);
			}else{
				redirect('Error');
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function deleteTiket()
	{
		$name_id			= $this->input->post('name_id');
		if ($name_id != '') {
			$name_klass			= base64_encode($this->input->post('name_klass'));
			$KlasDelete = $this->Tiket_models->DeleteTiket($name_id);
			if ($name_klass == true) {
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil...!',
					'kode'	=>$name_klass,
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Gagal...!',
					'kode'	=>$name_klass,
				];
			}

		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan...!',
				'kode'	=>$name_klass,
			];

		}
		echo json_encode($respone);

	}

	public function ProsesKursi()
	{
		$name_id			= $this->input->post('name_id');
		$HitungTotal = $this->Tiket_models->TotalTiketData($name_id)->row_array();
		$JumlahData = $HitungTotal['TotalData'];
		if ($name_id != NULL) {
			$Total = [
				'Jumlah_tiket'	=>$JumlahData,
			];
			$UpdateDataTiket = $this->Tiket_models->UpdateTiket($Total,$name_id);
			if ($UpdateDataTiket == true) {
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil...!',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Gagal..!',
				];
			}	
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan...!',
			];
		}

		echo json_encode($respone);

	}

	public function simpanTiket()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('maskapai','Maskapai', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPesan','TanggalPesan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('waktuPesan','WaktuPesan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kodePenerbanganPesawat','KodePenerbanganPesawat','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('from','From','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('bandara','Bandara','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('to','To','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('transit','Transit','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];
		}else{

			$this->load->helper('Hari');
			$Tanggal 						= $this->input->post('tanggalPesan');
			$rand 	 						= rand(1000,99999);
			$kodeTiket 						= 'TP-YK';
			$KodeDataTiket 					= $kodeTiket.'-'.$rand;
			$maskapai 						= $this->input->post('maskapai');
			$waktuPesan 					= $this->input->post('waktuPesan');
			$kodePenerbanganPesawat 		= $this->input->post('kodePenerbanganPesawat');
			$from 							= $this->input->post('from');
			$bandara 						= $this->input->post('bandara');
			$to 							= $this->input->post('to');
			$idSess 						= $this->session->userdata('id_akses');
			$transit 						= $this->input->post('transit');
			$Hari 							= conHari(date('D',strtotime($Tanggal)));

			$CekData = [
				'id_data_tiket'		=>$KodeDataTiket,
				'id_penerbangan'	=>$maskapai,
				'tanggal'			=>$Tanggal,
				'form'				=>$from,
				'to'				=>$to,
			];

			$CekTiketData = $this->Tiket_models->CekData($CekData);


			if ($CekTiketData == false) {
				$respone = [
					'status' => 'error',
					'message' => 'Kode Penerbangan Maskapai sudah...! ',
				];
			}else{

				$InsertData = [
					'id_penerbangan' =>$maskapai,
					'kode_pesawat'	=>$kodePenerbanganPesawat,
					'id_data_tiket'	=>$KodeDataTiket,
					'waktu_berangkat'	=>$waktuPesan,
					'hari'		=>$Hari,
					'tanggal'	=>$Tanggal,
					'to'	=>$to,
					'form'	=>$from,
					'bandara1'	=>$bandara,
					'bandara2'	=>$transit,
					'session_karyawan_id'	=>$idSess,
				];

				$Insert = $this->Tiket_models->InsertDataNya($InsertData);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil..! ',
						'kode'		=> base64_encode($KodeDataTiket),
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan...! ',
					];

				}


			}

		}

		echo json_encode($respone);
	}

	public function simpanUbahTiket()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('maskapai','Maskapai', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPesan','TanggalPesan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('waktuPesan','WaktuPesan','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kodePenerbanganPesawat','KodePenerbanganPesawat','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('from','From','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('bandara','Bandara','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('to','To','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('transit','Transit','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];
		}else{

			$this->load->helper('Hari');
			$id 							= $this->input->post('id');
			$Tanggal 						= $this->input->post('tanggalPesan');
			$maskapai 						= $this->input->post('maskapai');
			$waktuPesan 					= $this->input->post('waktuPesan');
			$kodePenerbanganPesawat 		= $this->input->post('kodePenerbanganPesawat');
			$from 							= $this->input->post('from');
			$bandara 						= $this->input->post('bandara');
			$to 							= $this->input->post('to');
			$idSess 						= $this->session->userdata('id_akses');
			$transit 						= $this->input->post('transit');
			$Hari 							= conHari(date('D',strtotime($Tanggal)));


			$InsertData = [
				'id_penerbangan' =>$maskapai,
				'kode_pesawat'	=>$kodePenerbanganPesawat,
				'waktu_berangkat'	=>$waktuPesan,
				'hari'		=>$Hari,
				'tanggal'	=>$Tanggal,
				'to'	=>$to,
				'form'	=>$from,
				'bandara1'	=>$bandara,
				'bandara2'	=>$transit,
				'session_karyawan_id'	=>$idSess,
			];

			$Insert = $this->Tiket_models->UpdateDataNya($InsertData,$id);
			if ($Insert == true) {
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil..! ',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Terjadi Kesalahan...! ',
				];

			}


		}


		echo json_encode($respone);
	}
	public function simpanKetentuanTiket()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('rules','Rules', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('jumlah','Jumlah','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('harga','Harga','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];
		}else{
			$id 					= $this->input->post('id');
			$rules 					= $this->input->post('rules');
			$jumlah 				= $this->input->post('jumlah');
			$harga 					= $this->input->post('harga');
			$kode 					= base64_encode($id);
			$CekData = [
				'id_tiket_data'		=>$id,
				'level'				=>$rules,
			];
			$CekTiketData = $this->Tiket_models->CekDataTiket($CekData);

			if ($CekTiketData->num_rows() > 0) {
				$respone = [
					'status' => 'error',
					'message' => 'Sudah Ada Data...! ',
				];
			}else{
				$InsertData = [
					'id_tiket_data' =>$id,
					'level'	=>$rules,
					'harga'	=>$harga,
					'jumlah'	=>$jumlah,
				];

				$Insert = $this->Tiket_models->InsertDataNyaHarga($InsertData);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil..! ',
						'kode'		=>$kode,
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan...! ',
					];

				}

			}

		}

		echo json_encode($respone);
	}
	public function simpanUbahKetentuanTiket()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('rules','Rules', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('jumlah','Jumlah','required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('harga','Harga','required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada yang Kosong..!',
			];
		}else{
			$id 					= $this->input->post('id');
			$id_tiket 				= $this->input->post('id_tiket');
			$rules 					= $this->input->post('rules');
			$jumlah 				= $this->input->post('jumlah');
			$harga 					= $this->input->post('harga');
			$kode 					= base64_encode($id_tiket);
			$CekData = [
				'level'		=>$rules,
				'harga'		=>$harga,
				'jumlah'	=>$jumlah,
			];
			$CekTiketData 	= $this->Tiket_models->CekDataTiket($CekData);
			$CekData2 = [
				'id'	=>$id,
			];
			$RowArray = $this->Tiket_models->CekDataTiket1($CekData2)->row_array();
			$JumlahSebelumnya = $RowArray['jumlah'];
			$CekData1 = [
				'id_data_tiket'	=>$id_tiket,
			];
			$JumlahTotal 	  = $this->Tiket_models->CekDataLagi($CekData1)->row_array();
			$JLB 			  = $JumlahTotal['Jumlah_tiket'];
			$TotalDataUbah 	  = $JLB - $JumlahSebelumnya;

			$TXC 			  = $TotalDataUbah + $jumlah;
			$Total 			  = $TXC;
			$name_id 		   = $id_tiket;
			if ($rules == $RowArray['level']) {
				$InsertData = [
					'harga'	=>$harga,
					'jumlah'=>$jumlah,
				];
				$UpdateTiketData = [
					'Jumlah_tiket'	=>$Total,
				];

				$InsertLagi = $this->Tiket_models->UpdateTiket($UpdateTiketData,$name_id);
				$Insert = $this->Tiket_models->UpdateDataNyaHarga($InsertData,$id);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil..! ',
						'kode'		=>$kode,
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan...! ',
					];

				}

			}else{
				if ($CekTiketData->num_rows() > 0) {
					$respone = [
						'status' => 'error',
						'message' => 'Sudah Ada Aksinya...! ',
					];
				}else{
					$InsertData = [
						'harga'	=>$harga,
						'jumlah'=>$TXC,
					];
					$UpdateTiketData = [
						'Jumlah_tiket'	=>$Total,
					];

					$InsertLagi = $this->Tiket_models->UpdateTiket($UpdateTiketData,$name_id);
					$Insert = $this->Tiket_models->UpdateDataNyaHarga($InsertData,$id);
					if ($Insert == true) {
						$respone = [
							'status' => 'success',
							'message' => 'Berhasil..! ',
							'kode'		=>$kode,
						];
					}else{
						$respone = [
							'status' => 'error',
							'message' => 'Terjadi Kesalahan...! ',
						];

					}
				}
			}

		}

		echo json_encode($respone);
	}

}