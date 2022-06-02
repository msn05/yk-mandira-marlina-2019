<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class JadwalBerangkat extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Layanan_models','Paket_models','Pengguna_models','JadwalBerangkat_models','Pemesanan_models']);
		$this->load->library('template');
		False();
	}

	public function TravelHaji()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$this->load->helper('Tanggal');
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$Kode 					= 'TH';
			$data['paket']			= $this->JadwalBerangkat_models->Data($Kode);

			$this->template->layout('JadwalKeberangkatan/TravelUmroh/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}


	public function HistoriPemesanan()
	{
		$this->load->helper('Tanggal');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['headerMenu']		= 'Form Filter';
		$Kode 					= 'U';
		$data['paket']			= $this->JadwalBerangkat_models->DataHistori($Kode);
		$this->template->layout('JadwalKeberangkatan/HistoriPemesanan.php',$data);
	}
	public function HistoriPemesananPariwisata()
	{
		$this->load->helper('Tanggal');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['headerMenu']		= 'Form Filter';
		$Kode 					= 'U';
		$data['paket']			= $this->JadwalBerangkat_models->DataHistoriPariwisata($Kode);
		$this->template->layout('JadwalKeberangkatan/HistoriPemesananPariwisata.php',$data);
	}


	public function TravelUmroh()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$Kode 											= 'TU';
		$data['paket']			= $this->JadwalBerangkat_models->Data($Kode);

		$this->template->layout('JadwalKeberangkatan/TravelUmroh/index.php',$data);
	}

	public function tourPariwisata()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$Kode 											= 'U';
		$data['paket']			= $this->JadwalBerangkat_models->Data($Kode);

		$this->template->layout('JadwalKeberangkatan/TravelUmroh/index.php',$data);
	}

	public function CekPelanggan()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['Level']             = $DataNya['id_level'];
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$Paket = base64_decode($this->input->get('kodePelangganId'));
		if ($Paket != NULL) {
			$CekPelanggan =$Paket;
			$data['detailPelanggan']			= $this->JadwalBerangkat_models->ShowData($CekPelanggan);
			$this->template->layout('JadwalKeberangkatan/TravelUmroh/Pelanggan.php',$data);
		}
	}

	public function tambahPelanggan()
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
			$Paket 			= $this->input->get('idData');
			if ($Paket != NULL) {
				$data['headerMenu']	= ' Pelanggan Paket';
				$data['idPaket']			 = base64_decode($Paket);
				$data['Pelanggan']		= $this->Pengguna_models->DataPelanggan();
				$this->template->layout('JadwalKeberangkatan/TravelUmroh/formTambahJamaah.php',$data);
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function DataUmroh()
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
			1=>'kode_paket_data',
			2=>'tanggal_berangkat',
			3=>'maxPelanggan'
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
		$KodeUmroh = 'TU';
		$Menus = $this->JadwalBerangkat_models->Data($KodeUmroh);
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idLayananPaket = $rows->id_layanan;
			$data[]= array(
				$no++,
				strtoupper($rows->nama_layanan. ' /'. $rows->nama_paket),
				date('d-m-Y',strtotime($rows->tanggal_berangkat)),
				$rows->maxPelanggan. ' Terdaftar ',
				$rows->tanggal_berangkat < date('Y-m-d') ? '<span class="label label-default label-pill"> Belum Berangkat</span>' :  '<span class="label label-success label-pill">Telah Berangkat</span>',
				'asa',
				'asa',
				'asa',
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


	public function TotalNya()
	{
		$query = $this->db->select("COUNT(*) as num")->get("tb_keberangakatan");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

	public function simpanData()
	{
		$id 					= $this->session->userdata('id_akses');
		$kodePaket = $this->input->post('name_paket');
		$name_id 	= $this->input->post('name_id');
		$name_pelanggan = $this->input->post('name_pelanggan');
		if ([!empty($name_id) && !empty($name_pelanggan)  && !empty($kodePaket)]) {

			$rand 		= rand(1000,99999);
			$tanggal 		= date('dmY');
			$tanggalPost 		= date('Y-m-d H:i:s');
			$nomorTagihan 	= 'A'.'-'.$rand.'-'.$tanggal;
			$keterangan 		= 'Tagihan Awal Pembayawan';

			$AmbilHarga = $this->Paket_models->InformasiPaket($kodePaket)->row_array();
			$Harga = $AmbilHarga['harga'];

			$CekPembayaran 	= [
				'kode_pemesanan'					=>$name_id,
			];

			$CekPelanggan = $this->Pemesanan_models->CekData($CekPembayaran);

			if ($CekPelanggan->num_rows() > 0) {
				$respone = [
					'status' => 'error',
					'message' => 'Nomor Tagihan Pelanggan Sudah Ada..!',
				];
			}else{

				$DataBerangkat = [
					'id_pelanggan'  		=>$name_pelanggan,
				];

				$DataTagihan = [
					'kode_pemesanan'	=>$name_id,
					'nominal'			=>$Harga,
					'nomor_tagihan'		=>$nomorTagihan,
					'keterangan'		=>$keterangan,
				];

				$DetailTagihan = [
					'id_detail_tagihan'	=>$nomorTagihan,
					'hal_tagihan'		=> $keterangan,
					'tanggal'			=> $tanggalPost,
					'id_karyawan'			=> $id,
				];

				$StatusPemesanan 	= [
					'status'		=> 2,
				];

				$Insert = $this->JadwalBerangkat_models->Insert($DataBerangkat);
				if ($Insert == true) {
					$InsertLagi = $this->JadwalBerangkat_models->Tagihan($DataTagihan);
					$InsertLagi2 = $this->JadwalBerangkat_models->PemesananLayanan($StatusPemesanan,$name_id);
					$InsertLagidanLagi = $this->JadwalBerangkat_models->DetailTagihan($DetailTagihan);
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
				'message' => 'Terjadi Kesalahan..!',
			];
		}
		echo json_encode($respone);
	}

}
