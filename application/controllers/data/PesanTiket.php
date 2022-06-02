<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PesanTiket extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','PesanTiket_models','Tiket_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		$data['Pesanan']		= $this->PesanTiket_models->ShowAllData();
		$this->template->layout('tiket/pesanTiket.php',$data);
	}

	public function InfoTiketPesan()
	{
		$Level 					= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$Kode = $id;
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataShow1($Kode)->row_array();
		$pelanggan           	= $DataNSiswa['id'];
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']           = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		if ($Level == 2) {
			$data['Pesanan']		= $this->PesanTiket_models->ShowAllDataPelanggan($pelanggan);
			$this->template->layout('tiket/Pelanggan/pesanTiket.php',$data);
		}else{
			redirect('error');
		}
	}

	public function HistoriPesanTiket()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];

		$data['id']             = $DataNya['id_akses'];
		$data['Pesanan']		= $this->PesanTiket_models->ShowAllData();
		$this->template->layout('Pesan Tiket/HistoripesanTiket.php',$data);
	}

	public function formTiketing()
	{

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['headerMenu']		= 'Form Pesan Tiket';
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$data['pelanggan']		= $this->Pengguna_models->DataPelanggan();
		$data['tiket']			= $this->Tiket_models->ShowData();
		$this->template->layout('tiket/TambahpesanTiket.php',$data);
	}

	public function deleteTiketNya()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['headerMenu']		= 'Form Pesan Tiket';
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];

		$delete 		= $this->input->post('name_id');
		// $TotalJumlah = =$CekJumlah['']
		$name_nama 		= $this->input->post('name_nama');
		$CekJumlah = $this->db->get_where('tb_keterangan_harga_tiket',array('id'=>$name_nama))->row_array();
		$TotalJumlah = $CekJumlah['jumlah'];
		$name_jumlah 	= $this->input->post('name_jumlah');
		$DeleteJumlahPemesanan = $TotalJumlah + $name_jumlah;
		$DataUpdateTiket = [
			'jumlah'=>$DeleteJumlahPemesanan,
		];
		$DeleteData = $this->PesanTiket_models->deleteNya($delete);
		if ($DeleteData == true) {
			$JumlahTiketNambah = $this->PesanTiket_models->TambahTiketDelete($DataUpdateTiket,$name_nama);

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
	}
	public function selesaiPesan()
	{

		$DataCekNya = $this->input->post('name_id');
		$name_total = $this->input->post('name_total');
		$CekData = $this->PesanTiket_models->TiketPesanan($DataCekNya)->row_array();
		$idPesanan = $CekData['id_pesan_tiket_data'];
		$kode = rand(1000,99999);
		$TK = 'TkT';
		$kodePesananNyaTiket = $TK.'-'.$kode;

		$status = [
			'status' =>2,
		];

		$UpdateTiketPesan = $this->PesanTiket_models->UpdatePemesananTiket($status,$idPesanan);

	}

	public function Terima()
	{

		$DataCekNya = $this->input->post('name_id');
		$name_total = $this->input->post('name_total');
		$CekData = $this->PesanTiket_models->TiketPesanan($DataCekNya)->row_array();
		$idPesanan = $CekData['id_pesan_tiket_data'];
		$status = [
			'status' =>3,
		];

		$UpdateTiketPesan = $this->PesanTiket_models->UpdatePemesananTiket($status,$idPesanan);
		if ($UpdateTiketPesan == true) {
			$respone = [
				'status' => 'success',
				'message' => 'Silakan Lanjut Pilih Kursi...!',
				'kode'	=>base64_encode($DataCekNya),
				'note'	=>base64_encode($name_total),
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Gagal',
			];
		}
		echo json_encode($respone);
	}

	public function terimauang()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan','Keterangan', 'required|trim');
		$this->form_validation->set_rules('tglterima','Tglterima', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' 	=> 'error',
				'message' 	=> 'Format Tidak Sesuai / Form Kosong..!',
			];
		}else{
			$id = $this->input->post('id');
			$nomimal = $this->input->post('nomimal');
			$tglterima = $this->input->post('tglterima');
			$keterangan = $this->input->post('keterangan');

			if ($id != NULL) {
				$dataInsert = [
					'id_tagihannya'=>$id,
					'jumlah_uang'=>$nomimal,
					'tanggal_post'=>$tglterima,
					'keterangan'=>$keterangan,
				];

				$UpdateTiketPesan = $this->PesanTiket_models->InsertTagihan($dataInsert);
				if ($UpdateTiketPesan == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil.',
						
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal',
					];
				}
			}else{
				redirect('error/AksesError');
			}
		}
		echo json_encode($respone);
	}
	public function InputUang()
	{
		$Data = $this->input->get('idData');
		if ($Data != NULL) {
			$nos = $this->input->get('XcX');
			$data['no'] = base64_decode($nos);
			$data['idData'] = base64_decode($Data);
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['headerMenu']		= 'Form Input Pembayaran';
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']          = $DataNya['id_level'];
			$data['id']             = $DataNya['id_akses'];
			$this->template->layout('Pesan Tiket/Input_Pembayaran.php',$data);
		}else{
			redirect('error/AksesError');
		}

	}

	public function CetakPesanan()
	{
		$this->load->library('pdf');
		$this->load->helper('Rupiah');
		$idPembayaran 	= $this->input->get('idDataPembayaran');
		if($idPembayaran != NULL){
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['headerMenu']		= 'Form Pesan Tiket';
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];

			$DataCekNya				= $idPembayaran;
			$TiketNya				= $this->PesanTiket_models->TiketPesanan($DataCekNya)->row_array();


			$Pswt 		= $TiketNya['id_tiket_pesawat_data'];
			$KodeTiketData = $idPembayaran;
			$CekData1 = [
				'id_tiket_YKM'=>$Pswt,
			];
			$Kode 		= $TiketNya['id_pelanggan'];
			$DataPelanggan = $this->Pengguna_models->DataShow($Kode)->row_array();
			$data['nama_pelanggan']	=$DataPelanggan['nama_lengkap'];
			$data['jenis_kelamin']=$DataPelanggan['jenis_kelamin'];
			$data['TanggalHarDey']	=date('d-M-Y');
			$Pesawat 		= $this->Tiket_models->CekDataLagi($CekData1)->row_array();
			$data['kodePesawatNya']	= $Pesawat['kode_pesawat'];
			$data['waktu_berangkat']	= $Pesawat['waktu_berangkat'];
			$data['hari']	= $Pesawat['hari'];
			$data['tanggal']	= $Pesawat['tanggal'];
			$data['to']			= $Pesawat['to'];
			$data['form']		= $Pesawat['form'];
			$data['bandara1']	= $Pesawat['bandara1'];
			$data['bandara2']	= $Pesawat['bandara2'];
			$data['detail'] = $this->PesanTiket_models->CekTiketNya1($DataCekNya);
			$data['kodePemesanan']	= $TiketNya['id_pesan_tiket_data'];
			$data['Total'] = $this->PesanTiket_models->TotalDataKursi($KodeTiketData)->row_array();
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "laporan Pemesanan Tiket Pelanggan.pdf";
			$this->pdf->load_view('Pesan Tiket/laporan_pemesanan.php', $data);

		}
	}

	public function CetakHistoriTiket()
	{
		$this->load->library('pdf');
		$this->load->helper('Rupiah');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['headerMenu']		= 'Form Pesan Tiket';
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['Level']             = $DataNya['id_level'];
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];

		$data['Pesanan']		= $this->PesanTiket_models->ShowAllData();
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan pembayaran.pdf";
		$this->pdf->load_view('Pesan Tiket/laporan_pemesananKeseluruhan.php', $data);

	}

	public function FormPilihJumlah()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level != 1 || $Level == 3) {
			redirect('Error/AksesError');
		}else{
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['headerMenu']		= 'Form Pesan Tiket';
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];

			$data['Level']             = $DataNya['id_level'];
			$Pesa = $this->input->get('idPesawat');
			if ($Pesa != '') {
				$KodeTiketData = base64_decode($this->input->get('idPesawat'));
				$Tiket = base64_decode($this->input->get('Tiket'));
				$CekData2 = [
					'id_tiket_data'=>$Tiket,
				];
				$data['pesawat'] = $KodeTiketData;
				$data['ShowTiket'] = $this->Tiket_models->CekDataTiket1($CekData2);
				$data['PemesananTiket']	= $this->PesanTiket_models->ShowData1($KodeTiketData);
				$data['Total'] = $this->PesanTiket_models->TotalDataKursi($KodeTiketData)->row_array();

				$this->template->layout('Pesan Tiket/TambahpesanTiket.php',$data);
			}else{
				redirect('error');
			}
		}
	}


	public function simpanPemesanan()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['headerMenu']		= 'Form Pesan Tiket';
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];

			$pelanggan 				= $this->input->post('pelanggan');
			$idTiket 				= $this->input->post('id');
			if (!empty($pelanggan)) {
				$CekData = [
					'id_tiket_YKM' =>$idTiket,
				];
				$tiket			= $this->Tiket_models->CekData($CekData)->row_array();
				$KodeTiketData  = $tiket['id_data_tiket'];

				$kode = 'TP-YKM';
				$rand = rand(1000,99999);
				$date = date('YmdHis');
				$kodePesan= $kode.'-'.$rand.'-'.$date;

				$TangglPesan = date('Y-m-d');
				$WaktuPesan = date('H:i');

				$InsertData = [
					'id_pesan_tiket_data'	=>$kodePesan,
					'id_tiket_data_pesan'	=>$rand,
					'id_pelanggan'	=>$pelanggan,
					'tanggal_pesan'	=>$TangglPesan,
					'waktu_pesan'	=>$WaktuPesan,
					'status'		=>1,
					'id_tiket_pesawat_data'=>$idTiket,
				];

				$Insert = $this->PesanTiket_models->InsertDataNya($InsertData);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message' => 'Silakan Lanjut Pilih Kursi...!',
						'kode'	=>base64_encode($rand),
						'tiket'	=>base64_encode($KodeTiketData),
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal Pilih..!',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Data Not Found.!',
				];
			}
		}else{
			redirect('Error/AksesError');
		}
		echo json_encode($respone);
	}

	public function simpanPemesananTiket()
	{
		$rules 					= $this->input->post('rules');
		$idTiket 				= $this->input->post('id');
		// var_dump($idTiket);die();
		$jumlah 				= $this->input->post('jumlah');
		if ([!empty($pelanggan) && !empty($jumlah)]) {
			$CekData2 = [
				'id' =>$rules,
			];
			$tiket			= $this->Tiket_models->CekDataTiket1($CekData2)->row_array();
			$level  = $tiket['level'];
			$harga  = $tiket['harga'];
			$jumlahNya  = $tiket['jumlah'];
			$name_id  = $tiket['id_tiket_data'];
			$CekData1 =[ 'id_data_tiket'=>$name_id,
		];

		$DataCekNya = [
			'id_tiket_pemesanan'=>$idTiket,
			'id_keterangan_tiket'=>$level,
		];

		$idTiketCek = $this->PesanTiket_models->CekTiketNya($DataCekNya)->num_rows();
		if ($idTiketCek > 0) {

			$respone = [
				'status' => 'error',
				'message' => 'Maaf Data sudah ada. Jika ingin mengubah sebaiknya hapus dahulu..!',
			];
		}else{

			$tiketData			= $this->Tiket_models->CekDataLagi($CekData1)->row_array();
			$Totals = $tiketData['Jumlah_tiket'];
			$S = $Totals-$jumlah;

			$R = $jumlahNya - $jumlah;
			$id = $rules;
			$HargaTotal = $jumlah * $harga;

			$InsertData1 = [
				'jumlah'=>$R,
			];

			$InsertData = [
				'id_tiket_pemesanan' =>$idTiket,
				'id_keterangan_tiket'=>$rules,
				'jumlah'	=>$jumlah,
				'harga'	=>$HargaTotal,
			];

			$Total = [
				'Jumlah_tiket' =>$S,
			];

			$InsertData = $this->PesanTiket_models->InsertDataNya1($InsertData);
			if ($InsertData == true) {

				$TiketUpdate = $this->Tiket_models->UpdateDataNyaHarga1($InsertData1,$id);
				$TiketUpdate1 = $this->Tiket_models->UpdateTiket($Total,$name_id);

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
	}else{
		$respone = [
			'status' => 'error',
			'message' => 'maaf anda belum mengisi jumlah dan rules',
		];
	}

	echo json_encode($respone);
}


}