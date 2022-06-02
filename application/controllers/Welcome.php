<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model(['Perusahaan_models','Galeri_models','Menu_models','Pengguna_models','Paket_models','Hotel_models','Penerbangan_models','MetodePembayaran_models','Perlengkapan_models','Layanan_models','Bus_models','JadwalBerangkat_models','Panduan_models','Tiket_models','Promo_models']);
	}
	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$data['variable']		= $this->Galeri_models->ShowData1();
		$data['variable1']		= $this->Promo_models->DataPromo1();
		$this->load->view('website/temp/header_website.php',$data);
		$this->load->view('website/index.php',$data);
		$this->load->view('website/temp/footer_website.php',$data);
	}

	public function Umroh()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$data['variable']		= $this->Galeri_models->ShowData1();
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/home.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function PesanTiketNyaSekarang()
	{
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$dataPek = base64_decode($dataID);
			$data['dataPek'] = $dataPek;
			$data['X'] = base64_decode($this->input->get('idJasa'));

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/tiket/formpesantiket.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}
	}

	public function tiket()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$this->load->view('website/temp/header_tiket.php',$data);
		$this->load->view('website/tiket/index.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function pariwisata()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$data['variable']		= $this->Galeri_models->ShowData1();
		$this->load->view('website/temp/header_pariwisata.php',$data);
		$this->load->view('website/pariwisata_home.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function PanduanPendaftaran()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataB = 'Pendaftaran';
		$data['variable']		= $this->Panduan_models->DatassHaji($dataB)->row_array();
		$data['variable1']		= $this->Panduan_models->DatassUmroh($dataB)->row_array();
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/panduan/pendaftaran.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function PanduanPembayaran()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataB = 'pembayaran';
		$date = date('Y-m-d');
		$data['variable']		= $this->Panduan_models->DatassHaji($dataB)->row_array();
		$data['variable1']		= $this->Panduan_models->DatassUmroh($dataB)->row_array();
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/panduan/pembayaran.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function SearchUmroh()
	{
		// $this->library('form_validation');

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$Tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['CariData'] = $this->Paket_models->SearchData($Tanggal);
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/travel/umroh.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function SearchTiket()
	{
		// $this->library('form_validation');

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$Tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$da = $this->input->post('1da');
		$das = $this->input->post('1das');

		$data['CariData'] = $this->Paket_models->SearchDataTiket($Tanggal,$da,$das);
		$this->load->view('website/temp/header_tiket.php',$data);
		$this->load->view('website/tiket/data.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}


	public function SearchParis()
	{

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$Tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$dari = $this->input->post('dari');
		$tujuan = $this->input->post('tujuan');
        if($Tanggal != '' && $dari != '' && $tujuan != ''){
		$data['CariData'] = $this->Paket_models->SearchDatass($Tanggal,$dari,$tujuan);
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/travel/pariwisata.php',$data);
		$this->load->view('website/temp/footer.php',$data);
        }else{
          $data = $this->session->set_flashdata('mess', 'Form anda Masih ada yang kosong...!.');
            redirect('welcome/pariwisata');
        }
	}

	public function SearchHaji()
	{
		// $this->library('form_validation');

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$Tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['CariData'] = $this->Paket_models->SearchDataHaji($Tanggal);
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/travel/haji.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}

	public function PelangganUmroh()
	{

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$data['dataPek'] = base64_decode($dataID);
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/travel/umrohPesan.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}else{
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/error/404.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}
	}

	public function Info()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();

		if ($this->input->get('idData') != '') 
		{
			$idDataNya 					= base64_decode($this->input->get('idData'));
			$DataCek = ['id_note_layanan'=>$idDataNya];
			$variable1s		= $this->Promo_models->CekDataDuplicate($DataCek)->row_array();
			$data['idDataS'] = $variable1s['id_promo'];
			$idDataS = $variable1s['id_promo'];
		
			$data['variable1']		= $this->Promo_models->FileImage($idDataS);

			$data['paketID']			= $idDataNya;

			$data['Notif']				= $this->input->get('Notif');
			$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
			$data['nama_layanan']		= $fileInfo['nama_layanan'];
			$data['harga']			= $fileInfo['harga'];
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
			$data['keterangan']		= $namaBus['keterangan'];

			$PaketKode 			= $idDataNya;

			$data['metodePembayaran'] = $this->MetodePembayaran_models->DataPembayaranPaket($id_metode_pembayaran_paket);
			$data['namaHotel'] 		= $this->Hotel_models->DataHotelPaket($PaketKode);
			$PaketKode 				= $idDataNya;
			$data['PerlengkapanPaket']= $this->Perlengkapan_models->DataPerlengkapanPaket($PaketKode);
			$namaMaskapai 			= $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
			$data['kode_penerbangan']=$namaMaskapai['kode_penerbangan'];
			$data['nama_maskapai']=$namaMaskapai['nama_maskapai'];
		}
		$this->load->view('website/temp/header.php',$data);
		$this->load->view('website/travel/info_umroh.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}


	public function InfoTiket()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		if ($this->input->get('idData') != '') 
		{
			$idDataNya 					= base64_decode($this->input->get('idData'));
			// var_dump($idDataNya);
			// 
			
			$CekData = [
				'id_data_tiket'=>$idDataNya,
			];

			$data['pesawat'] 			= base64_decode($this->input->get('X'));
			$data['paketID']			= $idDataNya;
			$fileInfo					= $this->Tiket_models->CekData($CekData)->row_array();
			$data['idData'] =$fileInfo['id_tiket_YKM'];
			$this->load->view('website/temp/header_tiket.php',$data);
			$this->load->view('website/tiket/PesanTiket.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}else{
			redirect('welcome/tiket');
		}
	}


}
