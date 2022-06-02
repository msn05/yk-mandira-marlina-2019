<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promo extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Promo_models','Pengguna_models','Paket_models','Bus_models','MetodePembayaran_models','Hotel_models','Perlengkapan_models','Penerbangan_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$Level       			= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 3) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['Promo']             = $this->Promo_models->Data();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       = $DataNya['id_level'];
			$this->template->layout('Promo/index.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function InfoPelanggan()
	{
		$Level       			= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['Promo']             = $this->Promo_models->Data();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['id']             = $DataNya['id_akses'];
		$data['Level']       	= $DataNya['id_level'];
		$this->template->layout('Promo/Pelanggan/index.php',$data);

	}
	public function Image()
	{
		$Level       			= $this->session->userdata('id_level');
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['Promo']          = $this->Promo_models->Data();
		$data['nama']           = $DataNSiswa['nama_lengkap'];
		$data['id']             = $DataNya['id_akses'];
		$data['Level']       	= $DataNya['id_level'];
		$idData= $this->input->get('idData');
		if ($idData != NULL) {
			$idDataS = base64_decode($idData);
			$data['keterangan']     = $this->input->get('Keterangan');
			$data['idFile'] = $idDataS;
			$data['variable'] = $this->Promo_models->FileImage($idDataS);
			$this->template->layout('Promo/Pelanggan/FotoPromo.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}
	public function deletePromo()
	{
		$pilih 					=$this->input->post('name_nama');
		if ($pilih != NULL ) {
			$idDataS = $pilih;
			$AmbekFileData= $this->Promo_models->FileImage($pilih)->result();
			
			$DeleteDatas	= $this->Promo_models->DeletePromoFiles($pilih);
			$DeleteData	= $this->Promo_models->DeletePromo($pilih);
			if ($DeleteData == true) {
				foreach ($AmbekFileData as $key => $value) {
					unlink("./image/promo/".$value->image_file);
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil'
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal'
				];
			}

		}else{

			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan'
			];
		}
		echo json_encode($respone);
	}
	public function deletePromoFile()
	{
		$pilih 					=$this->input->post('name_nama');
		$AmbekFileData= $this->Promo_models->AmbekFileDataPromo($pilih)->row_array();
		$name_file = $AmbekFileData['image_file'];
		if ($pilih != NULL ) {
			$DeleteData	= $this->Promo_models->DeletePromoFile($pilih);
			if ($DeleteData == true) {
				unlink("./image/promo/".$name_file);
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Gagal'
				];
			}

		}else{

			$respone = [
				'status' => 'error',
				'message'=> 'Terjadi Kesalahan'
			];
		}
		echo json_encode($respone);
	}

	public function cariHarga()
	{
		$pilih 				=$this->input->post('pilih');
		$data['harganya']	= $this->Promo_models->CariHarga($pilih)->row_array();
		$this->load->view('Promo/harga.php',$data);
	}

	public function form()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];

			$data['Panduan']       = $this->Promo_models->DataShowPaket();
			$this->template->layout('Promo/form.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function editpromo()
	{
		$Level       	= $this->session->userdata('id_level');
		if ($Level == 1 || $Level == 4) {
			$idData= $this->input->get('idData');
			if ($idData != NULL) {
				$idDataS = base64_decode($idData);
				$data['keterangan'] = base64_decode($this->input->get('idData'));
				$DataCek = [
					'id_promo' =>$idDataS
				];
				$dataFile = $this->Promo_models->CekDataDuplicate($DataCek)->row_array();
				$data['idFileData'] = $dataFile['id_promo'];
				$data['id_note_layanan'] = $dataFile['id_note_layanan'];
				$data['harga_normal_data'] = $dataFile['harga_normal_data'];

				$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
				$id 					= $this->session->userdata('id_akses');
				$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
				$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
				$data['nama']           = $DataNSiswa['nama_lengkap'];
				$data['id']             = $DataNya['id_akses'];
				$data['Level']       	= $DataNya['id_level'];
				$data['Panduan']       = $this->Promo_models->DataShowPaket();
				$this->template->layout('promo/edit.php',$data);
			}
		}else{
			redirect('Error/AksesError');
		}
	}

	public function InfoPromo()
	{
		$this->load->helper('Rupiah');
		$idData= $this->input->get('idData');
		if ($idData != NULL) {
			$idDataS = base64_decode($idData);
			$DataCek = [
				'id_promo' =>$idDataS
			];
			$idDataNya = $idData;
			$dataFile = $this->Promo_models->CekDataDuplicate($DataCek)->row_array();
			$data['idFileData'] = $dataFile['id_promo'];
			$data['id_note_layanan'] = $dataFile['id_note_layanan'];
			$idDataNya	= $dataFile['id_note_layanan'];
			$data['harga_normal_data'] = $dataFile['harga_normal_data'];
			$Paket 	= $this->Paket_models->ShowDataInfo1($idDataNya)->row_array();
			$data['nama_layanan']	=$Paket['nama_layanan'];
			$data['kode_paket_data']	=$Paket['kode_paket_data'];
			$data['lama_perjalanan']	=$Paket['lama_perjalanan'];
			$data['harga']				=$Paket['harga'];
			$data['maxPelanggan']		=$Paket['maxPelanggan'];
			$data['tanggal_Berakhir']		=$Paket['tanggal_Berakhir'];
			$data['tanggal_berangkat']		=$Paket['tanggal_berangkat'];
			$fileInfo					= $this->Paket_models->ShowDataInfo($idDataNya)->row_array();


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

			$data['PaketKode'] 			= $idDataNya;
			$PaketKode 				= $idDataNya;

			$data['metodePembayaran'] = $this->MetodePembayaran_models->DataPembayaranPaket($id_metode_pembayaran_paket);
			$data['namaHotel'] 		= $this->Hotel_models->DataHotelPaket($PaketKode);
			$data['PerlengkapanPaket']= $this->Perlengkapan_models->DataPerlengkapanPaket($PaketKode);
			$namaMaskapai 			= $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
			$data['kode_penerbangan']=$namaMaskapai['kode_penerbangan'];
			$data['nama_maskapai']=$namaMaskapai['nama_maskapai'];


			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']       	= $DataNya['id_level'];
			$data['Panduan']       = $this->Promo_models->DataShowPaket();
			$this->template->layout('promo/Pelanggan/Info.php',$data);
		}

	}
	function postPromo	()
	{
		$pilih 				= $this->input->post('pilih');
		$Catatan 			= $this->input->post('hargaPromo');

		if (empty($pilih) && empty($Catatan)) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Form Tidak Boleh Kosong..!'
			];
		}else{

			if(empty($Catatan)){
				$respone = [
					'status' => 'error',
					'message'=> 'Maaf Harga Promo Tidak Boleh Kosong..!'
				];

			}else{


				$hargaAwal 			= $this->input->post('fd');
				$Catatan 			= $this->input->post('hargaPromo');
				$Tanggal 			= date('Y-m-d');
				$rand = rand(1000, 999999);
				$kodeP = 'PPK';
				$KodePromo = $kodeP.'-'.$rand;
				if (!empty($pilih) && !empty($Catatan) && !empty($Tanggal)) {
					$DataCek = [
						'tanggal_post' 				=> $Tanggal,
						'id_note_layanan'			=> $pilih,
						'status_promo'  => 1,
					];

					$CekData 			= $this->Promo_models->CekDataDuplicate($DataCek)->num_rows(); 
					if ($CekData > 0) {
						$respone = [
							'status' => 'error',
							'message'=> 'Promo tersebut masih berlaku dan masih aktif..!'
						];

					}else{
						if ($Catatan < $hargaAwal ) {
							$respone = [
								'status' => 'error',
								'message'=> 'Maaf Harga Tidak Boleh Lebih Kecil dari harga paket..!',
							];
						}else{
							$DataNya = [
								'id_promo' 			 	=> $KodePromo,
								'tanggal_post' 			 	=> $Tanggal,
								'id_note_layanan'			 	=> $pilih,
								'harga_normal_data'			=> $Catatan,
								'status_promo'  			=> 1,
							];

							$InsertLagi = $this->Promo_models->Insert($DataNya);
							if ($InsertLagi == true) {
								$respone = [
									'status' => 'success',
									'message'=> 'Berhasil.',
									'kode'	=>base64_encode($KodePromo),
								];
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Gagal.',
								];
							}

						}
					}
				}
			}
		}
		echo json_encode($respone);
	}

	function UploadImage()
	{
		$pilih 				= $this->input->post('id');
		$date 				= date('Y-m-d H:i:s');

		$UpdateStatus = [
			'id_promo'=>$pilih,
			'created'=>$date,
		];

		if (!empty($_FILES['foto']['name'])) {

			$_FILES['file1']['name']     = $_FILES['foto']['name'];
			$_FILES['file1']['type']     = $_FILES['foto']['type'];
			$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['file1']['error']    = $_FILES['foto']['error'];
			$_FILES['file1']['size']     = $_FILES['foto']['size'];

			$uploadPath = './image/promo/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg';
			$config['max_size'] = '1024';
			$config['file_name'] = 'foto '.$pilih;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file1') == true){
				$data_upload = $this->upload->data();
				$config['image_library']='gd2';
				$config['source_image']='./image/promo/'.$data_upload['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '50%';
				$config['width']= 600;
				$config['height']= 400;
				$config['new_image']= './image/promo/'.$data_upload['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$UpdateStatus['image_file'] = $data_upload['file_name'];
				$Insert  = $this->Promo_models->UploadFotos($UpdateStatus);
				if ($Insert == true) {
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil',
					];	
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal.',
					];	
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Format Salah / File Terlalu Besar.',
				];	
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Foto Tidak Boleh Kosong...!.',
			];	
		}
		echo json_encode($respone);
	}

	function updatePromo	()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('pilih','Pilih', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('hargaPromo','HargaPromo', 'required|trim|numeric',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message'=> 'Format Salah..!'
			];

		}else{
			$id 				= $this->input->post('id');
			$hargaAwal 			= $this->input->post('fd');
			$pilih 				= $this->input->post('pilih');
			$Catatan 			= $this->input->post('hargaPromo');
			$Tanggal = date('Y-m-d');
			// $DataCek = [
			// 	'id_promo' =>$id
			// ];
			// $dataFile 			= $this->Promo_models->CekDataDuplicate($DataCek)->row_array();
			// $idFileData 		= $dataFile['id_promo'];
			// $id_note_layanan	= $dataFile['id_note_layanan'];
			// $harga_normal_data 	= $dataFile['harga_normal_data'];
			// $status 			= $dataFile['status_promo'];

			// if (!empty($pilih) && !empty($Catatan)) {

			$DataCek = [
				'tanggal_post' 				=> $Tanggal,
				'id_note_layanan'			=> $pilih,
				'status_promo'  => 1,
			];

			$CekData 			= $this->Promo_models->CekDataDuplicate($DataCek)->num_rows(); 
			if ($CekData > 1) {
				$respone = [
					'status' => 'error',
					'message'=> 'Promo tersebut masih berlaku dan masih aktif..!'
				];

			}else{
				if ($Catatan < $hargaAwal ) {
					$respone = [
						'status' => 'error',
						'message'=> 'Maaf Harga Tidak Boleh Lebih Kecil dari harga paket..!',
					];
				}else{

					$DataNya = [
						'tanggal_post' 			 	=> $Tanggal,
						'id_note_layanan'			 	=> $pilih,
						'harga_normal_data'			=> $Catatan,
						'status_promo'  			=> 1,
					];

					$InsertLagi = $this->Promo_models->UpdatePromo($DataNya,$id);
					if ($InsertLagi == true) {
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil.',
						];
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Gagal.',
						];
					}
				}
			}
		}
		echo json_encode($respone);
	}


}
