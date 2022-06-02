<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PromoData extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Pengguna_models','Promo_models','Menu_models','Paket_models','Bus_models','Penerbangan_models','MetodePembayaran_models','Hotel_models','Perlengkapan_models','Galeri_models']);
	}


	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		if ($this->input->get('idData') != '') 
		{
			$Data 					= base64_decode($this->input->get('idData'));
			$DataCek1 = ['id_promo'=>$Data];
			$idPromode	= $this->Promo_models->CekDataDuplicate($DataCek1)->row_array();
			$data['variable1']		= $this->Promo_models->DataPromo1();
			$data['HrgaNya'] = $idPromode['harga_normal_data'];
			$idDataNya = $idPromode['id_note_layanan'];
			$data['idDataS']			= $Data;
			$data['paketID']			= $idDataNya;
			$data['Notif']				= $this->input->get('Notif');
			$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();
			$data['idLa']		= $fileInfo['id_layanan'];
			$data['nama_layanan']		= $fileInfo['nama_layanan'];
			$data['kode_paket_data']		= $fileInfo['kode_paket_data'];
			$data['harga']				= $fileInfo['harga'];
			$data['namaPaket']			= $fileInfo['id_paket'];
			$data['TanggalBerangkat']	= $fileInfo['tanggal_berangkat'];
			$data['tanggalAkhir']		= $fileInfo['tanggal_Berakhir'];
			$data['tanggalAwal']		= $fileInfo['tanggal_dibuat'];
			$data['lama_perjalanan']		= $fileInfo['lama_perjalanan'];
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
			$this->load->view('website/temp/header_website1.php',$data);
			$this->load->view('website/Promo/index.php',$data);
			// $this->load->view('website/Promo/data.php',$data);
			$this->load->view('website/Promo.php',$data);
			$this->load->view('website/temp/footer_website.php');

		}
	}

	public function Pariwisata()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$data['variable']		= $this->Promo_models->DataPromoPariwisata();
		$this->load->view('website/temp/header_pariwisata.php',$data);
		$this->load->view('website/pariwisata/index.php',$data);
		$this->load->view('website/temp/footer.php',$data);
	}


	public function readme()
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('PromoData/readme'); //site url
        $config['total_rows'] = $this->db->count_all('tb_normatif_promo_layanan'); //total row
        $config['per_page'] = 6; 
        $config["uri_segment"] = 3;  
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['variable3'] = $this->Promo_models->Limit1s($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();

        $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
        $data['variable1']		= $this->Promo_models->DataPromo1();
        $data['variable']		= $this->Galeri_models->ShowData1();
        $this->load->view('website/temp/header_website1.php',$data);
        $this->load->view('website/Promo/index.php',$data);
    }

    public function dataViews()
    {
    	$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
    	$idPromo = $this->input->get('idPromo');
    	$data['variable']		= $this->Galeri_models->ShowData1();
    	$data['variable1']		= $this->Promo_models->DataPromo1($idPromo);
    	$data['variable2']		= $this->Promo_models->PromoData1($idPromo);
    	$this->load->view('website/temp/header_website1.php',$data);
    	$this->load->view('website/Promo/index.php',$data);
    }



}
