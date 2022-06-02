<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PelangganPesan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model([
			'Perusahaan_models',
			'Menu_models',
			'Pengguna_models','Pemesanan_models','Paket_models','Tiket_models','PesanTiket_models']);
		$this->load->helper('validation');
	}

	public function simpanPesanan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namaLengkap','namaLengkap', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|trim');
		$this->form_validation->set_rules('no_ktp','No_ktp', 'required|trim');
		$this->form_validation->set_rules('no_kk','No_kk', 'required|trim');

		$this->form_validation->set_rules('jks','Jks', 'required|trim');
		$this->form_validation->set_rules('no_telp','No_telp', 'required|trim');
		$this->form_validation->set_rules('nowat','Nowat', 'required|trim');
		$this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		$this->form_validation->set_rules('tanggallahir','tanggallahir', 'required|trim');
		$this->form_validation->set_rules('pks','Pks', 'required|trim');
		$this->form_validation->set_rules('whk','Whk', 'required|trim');
		$this->form_validation->set_rules('pksd','Pksd', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Form Masih Ada Yang Kosong!',
			];

		}else{
			$id    = $this->input->post('id');

			$namaLengkap  = $this->input->post('namaLengkap');
			$email    = $this->input->post('email');
			$no_ktp   = $this->input->post('no_ktp');
			$no_kk    = $this->input->post('no_kk');
			$no_telp   = $this->input->post('no_telp');
			$tanggalLahir  = $this->input->post('tanggallahir');
			$tempatLahir  = $this->input->post('tempatLahir');
			$alamat   = $this->input->post('alamat');
			$nowat    = $this->input->post('nowat');
			$pks    = $this->input->post('pks');
			$jks    = $this->input->post('jks');
			$whk    = $this->input->post('whk');
			$pksd    = $this->input->post('pksd');
			$rand    = rand(1000,999999);
			$rands    = rand(1000,999999);
			$password = '123456';
			$password_hash = password_hash($password,PASSWORD_DEFAULT);


			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$respone = [
					'status'  => 'error',
					'message'  => 'Format Email Salah..!',
				];
			}else{
				$CekEmailData = $this->Pengguna_models->Emails($email)->num_rows();
				if ($CekEmailData > 0 ) {
					$respone = [
						'status'  => 'error',
						'message'  => 'Email Sudah Ada...!',
					];
				}else{
					if (!validate_HurufSaja($namaLengkap)) {
						$respone = [
							'status'  => 'error',
							'message'  => 'Nama Lengkap Format  Huruf Saja..!',
						];
					}else{
						if (!validate_HurufSaja($tempatLahir)) {
							$respone = [
								'status'  => 'error',
								'message'  => 'Tempat Lahir Format  Huruf Saja..!',
							];
						}else{
							if (!validate_HurufSaja($whk)) {
								$respone = [
									'status'  => 'error',
									'message'  => 'Wali Hakim Format  Huruf Saja..!',
								];
							}else{
								if (!validate_HurufSaja($pks)) {
									$respone = [
										'status'  => 'error',
										'message'  => 'Pekerjaan Format  Huruf Saja..!',
									];
								}else{
									if (!maxLenght16($no_ktp)) {
										$respone = [
											'status'  => 'error',
											'message'  => 'Maaf Nomor KTP Wajib 16 Angka..!',
										];
									}else{
										if (!maxLenght16($no_kk)) {
											$respone = [
												'status'  => 'error',
												'message'  => 'Maaf Nomor KK Wajib 16 Angka..!',
											];
										}else{
											if (!maxLenght10Sampe14($no_telp)) {
												$respone = [
													'status'  => 'error',
													'message'  => 'Maaf Nomor Telphone Min 10 Sampai 14..!',
												];
											}else{
												if (!maxLenght10Sampe14($nowat)) {
													$respone = [
														'status'  => 'error',
														'message'  => 'Maaf Nomor WhatShap Min 10 Sampai 14..!',
													];
												}else{


													$CekNomorTelphoneData = $this->Pengguna_models->NomorTelphones($no_telp)->num_rows();
													if ($CekNomorTelphoneData > 0) {
														$respone = [
															'status'  => 'error',
															'message'  => 'Nomor Telphone Sudah Ada...!',
														];
													}else{

														if ($jks == 0) {
															$respone = [
																'status'  => 'error',
																'message'  => 'Jenis Kelamin Wajib Dipilih...!',
															];
														}else{

															if ($pksd == 0) {
																$respone = [
																	'status'  => 'error',
																	'message'  => 'Status Wali Wajib Dipilih..!',
																];
															}else{
																$UpdateStatus = [
																	'id_akses' => $rands,
																	'password'  => $password_hash,
																	'status_users' => 1,
																	'id_level'   => 2,
																];

																$PostData2 = [
																	'id_akses_data'  => $rands,
																	'nama_lengkap' =>$namaLengkap,
																	'no_ktp' => $no_ktp,
																	'no_kk' => $no_kk,
																	'nomor_telphone' => $no_telp,
																	'nomor_wa'  => $nowat,
																	'emails'  => $email,
																	'alamat' => $alamat,
																	'tanggal_lahir' => $tanggalLahir,
																	'tempat_lahir' => $tempatLahir,
																	'jenis_kelamin' => $jks,
																	'pekerjaan' => $pks,
																	'ahli_hakim_id' => $whk,
																	'status_data_keluarga' => $pksd,
																	'id_file_dokumen'						=>$rand,
																];
																$dataFile = [
																	'id_file_identitas'=>$rand,
																];
																$Insert = $this->Pengguna_models->InsertData($UpdateStatus);
																if ($Insert == true) {
																	$InsertLagi2 = $this->Pengguna_models->InsertDataLagiNahs($dataFile);
																	$InsertLagi = $this->Pengguna_models->InsertDataLagis($PostData2);
																	$respone = [
																		'status'  	=> 'success',
																		'message'  => 'Berhasil Terdaftar. Silakan Lanjut Upload Dokumen',
																		'kode'					=> base64_encode($no_ktp),
																		'idDataNya'=> base64_encode($id),
																	];
																}else{
																	$respone = [
																		'status'  => 'error',
																		'message'  => 'Gagal Terdaftar..!',
																	];
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		echo json_encode($respone);
	}

	public function simpanPesananTiket()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namaLengkap','namaLengkap', 'required|trim');
		$this->form_validation->set_rules('email','Email', 'required|trim|valid_emails');
		$this->form_validation->set_rules('no_ktp','No_ktp', 'required|trim|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('no_kk','No_kk', 'required|trim|min_length[16]|max_length[16]');

		$this->form_validation->set_rules('jks','Jks', 'required|trim');
		$this->form_validation->set_rules('no_telp','No_telp', 'required|trim|min_length[10]|max_length[16]');
		$this->form_validation->set_rules('nowat','Nowat', 'required|trim|min_length[10]|max_length[16]');
		$this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
		$this->form_validation->set_rules('alamat','Alamat', 'required|trim');
		$this->form_validation->set_rules('tanggallahir','tanggallahir', 'required|trim');


		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Masih Ada Yang Kosong / Format Ada salah...!',
			];

		}else{
			$jasa    = $this->input->post('jasa');
			$id    		= $this->input->post('id');
			$namaLengkap  = $this->input->post('namaLengkap');
			$email    = $this->input->post('email');
			$no_ktp   = $this->input->post('no_ktp');
			$no_kk    = $this->input->post('no_kk');
			$no_telp   = $this->input->post('no_telp');
			$tanggalLahir  = $this->input->post('tanggallahir');
			$tempatLahir  = $this->input->post('tempatLahir');
			$alamat   = $this->input->post('alamat');
			$nowat    = $this->input->post('nowat');
			$jks    = $this->input->post('jks');

			$rand    	= rand(1000,999999);
			$rands    	= rand(1000,999999);
			$password 	= '123456';
			$password_hash = password_hash($password,PASSWORD_DEFAULT);
			if (!empty($email) && !empty($namaLengkap) && !empty($no_ktp) && !empty($no_kk) && !empty($no_telp) && !empty($tanggalLahir) && !empty($nowat) && !empty($jks) ){

				$CekEmailData = $this->Pengguna_models->Emails($email)->num_rows();
				if ($CekEmailData > 0 ) {
					$respone = [
						'status'  => 'error',
						'message'  => 'Email Sudah Ada...!',
					];
				}else{
					$CekNomorTelphoneData = $this->Pengguna_models->NomorTelphones($no_telp)->num_rows();
					if ($CekNomorTelphoneData > 0) {
						$respone = [
							'status'  => 'error',
							'message'  => 'Nomor Telphone Sudah Ada...!',
						];
					}else{
						if ([alpha($namaLengkap) && alpha($tempatLahir)]=== false ) {
							$respone = [
								'status'  => 'error',
								'message'  => 'Hanya Huruf..!',
							];

						}else{
							if ([numeric($nowat) && numeric($no_telp) && numeric($no_ktp) && numeric($no_kk)] == false ) {
								$respone = [
									'status'  => 'error',
									'message'  => 'Harus Angka ya..!',
								];
							}else{
								if ([$nowat && $no_telp] <= 10) {
									$respone = [
										'status'  => 'error',
										'message'  => 'Minimal 11 huruf ya..!',
									];

								}else{
									if ([$no_ktp && $no_kk] <= 15) {
										$respone = [
											'status'  => 'error',
											'message'  => 'Min 16 huruf ya..!',
										];

									}else{

										$UpdateStatus = [
											'id_akses' => $rands,
											'password'  => $password_hash,
											'status_users' => 1,
											'id_level'   => 2,
										];

										$PostData2 = [
											'id_akses_data'  => $rands,
											'nama_lengkap' =>$namaLengkap,
											'no_ktp' => $no_ktp,
											'no_kk' => $no_kk,
											'nomor_telphone' => $no_telp,
											'nomor_wa'  => $nowat,
											'emails'  => $email,
											'alamat' => $alamat,
											'tanggal_lahir' => $tanggalLahir,
											'tempat_lahir' => $tempatLahir,
											'jenis_kelamin' => $jks,
											'pekerjaan' => NULL,
											'ahli_hakim_id' => NULL,
											'status_data_keluarga' => NULL,
											'id_file_dokumen'						=>$rand,
										];
										$dataFile = [
											'id_file_identitas'=>$rand,
										];

										$Insert = $this->Pengguna_models->InsertData($UpdateStatus);
										if ($Insert == true) {
											$InsertLagi2 = $this->Pengguna_models->InsertDataLagiNahs($dataFile);
											$InsertLagi = $this->Pengguna_models->InsertDataLagis($PostData2);
											$respone = [
												'status'  => 'success',
												'message'  => 'Berhasil Terdaftar. Silakan Lanjut Upload Dokumen',
												'kode'					=> base64_encode($no_ktp),
												'idDataNya'					=> base64_encode($id),
												'idJasa'					=> base64_encode($jasa),
											];
										}else{
											$respone = [
												'status'  => 'error',
												'message'  => 'Gagal Terdaftar..!',
											];
										}
									}
								}
							}
						}
					}
				}
			}else{
				$respone = [
					'status'  => 'error',
					'message'  => 'Terjadi Kesalahan...!'
				];
			}
		}
		echo json_encode($respone);
	}

	public function ProsesPesanTanpaRegis()
	{
		$this->load->library('form_validation');


		$this->form_validation->set_rules('id_akses','Id_akses', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('password','password', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Ada yang Kosong..!',
			];
		}else{
			$Uname			= htmlentities($this->input->post('id_akses'));
			$Pass				= $this->input->post('password');
			$id				= $this->input->post('id');
			$id				= $this->input->post('id');
			$Cek_Data 	= $this->Pengguna_models->Login($Uname)->row_array();
			$StatusAkun	= $Cek_Data['status_users'];
			if ($Cek_Data == true) {
				if (password_verify($Pass, $Cek_Data['password'])) {
					if ($StatusAkun == 1 && $Cek_Data['id_level'] > 0) {
						$Kode = $Uname;
						$CekDataq = $this->Pengguna_models->DataShow1($Kode)->row_array();
						$idDataNya = $CekDataq['id'];
						$kodeKTP = $CekDataq['no_ktp'];

						$randData= rand(1000, 999999);
						$Kode = 'Ap';
						$KodePesan = $Kode.'-'.$randData;
						$date = date('Y-m-d H:i:s');
						$DataPesananya = [
							'id_pemesanan' =>$KodePesan,
							'id_paket'	=> $id,
							'id_pelanggan'=>$idDataNya,
							'tanggal_pesan'	=>$date,
							'status'	=>1,
						];
						$InsertLagi = $this->Pemesanan_models->Insert($DataPesananya);
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil!',
							'kode'	=>base64_encode($kodeKTP),
							'idData'=>base64_encode($id),

						];
					}else{
						$respone = [
							'status'  => 'error',
							'message'  => 'Status Akun Anda Tidak Aktif.!'
						];
					}
				}
			}else{
				$respone = [
					'status'  => 'error',
					'message'  => 'Akun Anda Tidak Terdaftar...!'
				];
			}
		}
		echo json_encode($respone);
	}


	public function ProsesPesanTanpaRegisTiket()
	{
		$this->load->library('form_validation');


		$this->form_validation->set_rules('id_akses','Id_akses', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('password','password', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Ada yang Kosong..!',
			];
		}else{
			$Uname			= htmlentities($this->input->post('id_akses'));
			$Pass			= $this->input->post('password');
			$idD				= $this->input->post('id');
			$idJ				= $this->input->post('jasa');
			$Cek_Data 	= $this->Pengguna_models->Login($Uname)->row_array();
			$StatusAkun	= $Cek_Data['status_users'];
			if ($Cek_Data == true) {
				if (password_verify($Pass, $Cek_Data['password'])) {
					if ($StatusAkun == 1 && $Cek_Data['id_level'] > 0) {
						$Kode = $Uname;
						$CekDataq = $this->Pengguna_models->DataShow1($Kode)->row_array();
						$idP = $CekDataq['id'];
						$kodeKTP = $CekDataq['no_ktp'];

						$CekData1 = ['id_tiket_YKM'=>$idD] ;
						$CekData2 = ['id'=>$idJ] ;
						$name_id = $idD;

						$CekDataG 					= $this->Tiket_models->CekDataLagi($CekData1)->row_array();
						$CekDatas 					= $this->Tiket_models->CekDataTiket1($CekData2)->row_array();
						$HargaTotal = $CekDatas['harga'];
						$JumlahTotal = $CekDatas['jumlah'];
						$JumlahTiketSebelumnya = $CekDataG['Jumlah_tiket'];

						$kode = 'TP-YKM';
						$rand = rand(1000,99999);
						$date = date('YmdHis');
						$kodePesan= $kode.'-'.$rand.'-'.$date;
						$Kurangi = $JumlahTiketSebelumnya - 1;
						$Kurangii = $JumlahTotal - 1;
						$TangglPesan = date('Y-m-d');
						$WaktuPesan = date('H:i');

						$InsertData = [
							'id_pesan_tiket_data'	=>$kodePesan,
							'id_tiket_data_pesan'	=>$rand,
							'id_pelanggan'	=>$idP,
							'tanggal_pesan'	=>$TangglPesan,
							'waktu_pesan'	=>$WaktuPesan,
							'status'		=>1,
							'id_tiket_pesawat_data'=>$idD,
						];

						$InsertData2 = [
							'id_tiket_pemesanan' =>$rand,
							'id_keterangan_tiket'=>$idJ,
							'jumlah'	=>1,
							'harga'	=>$HargaTotal,
						];

						$Total=[
							'Jumlah_tiket' =>$Kurangi
						];
						$InsertData4=[
							'jumlah' =>$Kurangii
						];
						$InsertLagi2 = $this->PesanTiket_models->InsertDataNya2($InsertData2);

						$InsertLagi = $this->PesanTiket_models->InsertDataNya($InsertData);
						if ($InsertLagi == true) {
							$InsertLagi21 = $this->Tiket_models->UpdateDataNya1($Total,$name_id);
							$InsertLagi22 = $this->Tiket_models->UpdateDataNyaHarga2($InsertData4,$idJ);
							$respone = [
								'status' => 'success',
								'message'=> 'Berhasil',
								'kode'	=>base64_encode($idP),
								'idData'=>base64_encode($idD),
								'idJasa'=>base64_encode($rand),

							];
						}else{
							$respone = [
								'status'  => 'error',
								'message'  => 'Gagal'
							];
						}
					}else{
						$respone = [
							'status'  => 'error',
							'message'  => 'Status Akun Anda Tidak Aktif.!'
						];
					}
				}
			}else{
				$respone = [
					'status'  => 'error',
					'message'  => 'Akun Anda Tidak Terdaftar...!'
				];
			}
		}
		echo json_encode($respone);
	}


	public function UploadDokumen ()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$dataIDS = $this->input->get('DataId');
			$dataPek = base64_decode($dataID);
			$idFile = $dataPek;
			$Pelanggan = $this->Pengguna_models->NoKtp($idFile)->row_array();
			$data['idNya'] = $Pelanggan['id'];
			$data['dataPek'] = $Pelanggan['id_file_dokumen'];
			$data['dataPeka'] = base64_decode($dataIDS);
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/travel/UploadDokumen.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}else{
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/error/404.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}
	}

	public function UploadDokumenTiket ()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$idJasa 	= $this->input->get('idJasa');
			$DataId 	= $this->input->get('DataId');
			$dataPek = base64_decode($dataID);
			$idFile = $dataPek;
			$Pelanggan = $this->Pengguna_models->NoKtp($idFile)->row_array();
			$data['idNya'] = $Pelanggan['id'];
			$data['dataPek'] = $Pelanggan['id_file_dokumen'];
			$data['dataPeka'] = base64_decode($DataId);
			$data['idJasa'] = base64_decode($idJasa);
			$this->load->view('website/temp/header_tiket.php',$data);
			$this->load->view('website/tiket/UploadDokumenTiket.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}else{
			$this->load->view('website/temp/header_tiket.php',$data);
			$this->load->view('website/error/404.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}
	}

	public function InformasiPemesanan ()
	{

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$dataIDS = $this->input->get('idDataNya');
			$dataPek = base64_decode($dataID);
			$dataPeka = base64_decode($dataIDS);
			$id = $dataPek;
			$Pemesanan = $this->Paket_models->PemesananInfo($dataPeka)->row_array();
			$data['KodePesan'] = $Pemesanan['id_pemesanan'];
			$data['namaLayanan'] = $Pemesanan['nama_layanan'];
			$data['kodePaket'] = $Pemesanan['kode_paket_data'];
			$data['id_paket'] = $Pemesanan['id_paket'];
			$data['tanggal_pesan'] = $Pemesanan['tanggal_pesan'];
			$data['harga'] = $Pemesanan['harga'];

			$Pelanggan = $this->Pengguna_models->idPelanggan($id)->row_array();
			$data['nama_lengkap'] = $Pelanggan['nama_lengkap'];
			$data['id_akses_data'] = $Pelanggan['id_akses_data'];
			$data['no_ktp'] = $Pelanggan['no_ktp'];
			$data['alamat'] = $Pelanggan['alamat'];


			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/travel/InformasiPemesanan.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}else{
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/error/404.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}
	}

	public function InformasiPemesananTiket ()
	{

		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$dataID = $this->input->get('idData');
		if (!empty($dataID)) {
			$dataIDS = $this->input->get('idDataNya');
			$idJasa = $this->input->get('idJasa');
			$dataPek = base64_decode($dataID);
			$dataPeka = base64_decode($dataIDS);
			$dataPekas = base64_decode($idJasa);
			var_dump($dataPekas);
			$id 		= $dataPek;
			$Kode 		= $dataPek;
			var_dump($Kode);
			$DataCekNya = $dataPekas;
			$Pemesanan 	= $this->PesanTiket_models->TiketPesanan($DataCekNya)->row_array();

			$data['id_pesan_tiket_data'] = $Pemesanan['id_pesan_tiket_data'];
			$data['tanggal_pesan'] = $Pemesanan['tanggal_pesan'];
			$data['waktu_pesan'] = $Pemesanan['waktu_pesan'];
			$data['jumlah'] = $Pemesanan['jumlah'];
			$data['harga'] = $Pemesanan['harga'];
			$data['level'] = $Pemesanan['level'];

			$CekData1 = ['id_tiket_YKM' => $Pemesanan['id_tiket_pesawat_data']];
			$NoteTiket = $this->Tiket_models->CekDataLagi($CekData1)->row_array();
			$data['hari']	= $NoteTiket['hari'];
			$data['waktu_berangkat']	= $NoteTiket['waktu_berangkat'];
			$data['tanggal']	= $NoteTiket['tanggal'];
			$data['to']			= $NoteTiket['to'];
			$data['form']		= $NoteTiket['form'];
			$data['bandara1']	= $NoteTiket['bandara1'];
			$data['bandara2']	= $NoteTiket['bandara2'];
			$id_penerbangan		= $NoteTiket['id_penerbangan'];
			$Maskapai = $this->Tiket_models->MaskapaiNya($id_penerbangan)->row_array();
			// var_dump($Maskapai);
			$data['nama_maskapai']	= $Maskapai['nama_maskapai'];
			$data['kode_penerbangan']	= $Maskapai['kode_penerbangan'];

			$Pelanggan = $this->Pengguna_models->DataShow($Kode)->row_array();
			$data['nama_lengkap'] = $Pelanggan['nama_lengkap'];
			$data['id_akses_data'] = $Pelanggan['id_akses_data'];
			$data['no_ktp'] = $Pelanggan['no_ktp'];
			$data['alamat'] = $Pelanggan['alamat'];


			$this->load->view('website/temp/header_tiket.php',$data);
			$this->load->view('website/tiket/InformasiPemesananTiket.php',$data);
			$this->load->view('website/temp/footer.php',$data);
		}else{
			$this->load->view('website/temp/header.php',$data);
			$this->load->view('website/error/404.php',$data);
			$this->load->view('website/temp/footer.php',$data);

		}
	}

	public function UploadDokumenProses()
	{
		$id 									= $this->input->post('idfile');
		$idD 									= $this->input->post('id');
		$idP 									= $this->input->post('idP');
		$CekData = $this->Pengguna_models->idPelanggan($id)->row_array();
		$NamaLengkap = $CekData['nama_lengkap'];
		
				$randData= rand(1000, 999999);
			$Kode = 'Ap';
			$KodePesan = $Kode.'-'.$randData;
			$date = date('Y-m-d H:i:s');
			$DataPesananya = [
				'id_pemesanan' =>$KodePesan,
				'id_paket'	=> $idD,
				'id_pelanggan'=>$idP,
				'tanggal_pesan'	=>$date,
				'status'	=>1,
			];
			$UpdateStatus = [
				'id_file_identitas'	=>$id,
			];
			$NamaLengkap 		= $CekData['nama_lengkap'];

            $_FILES['file1']['name']     = $_FILES['foto']['name'];
			$_FILES['file1']['type']     = $_FILES['foto']['type'];
			$_FILES['file1']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['file1']['error']    = $_FILES['foto']['error'];
			$_FILES['file1']['size']     = $_FILES['foto']['size'];
			
			$_FILES['file2']['name']     = $_FILES['ktp']['name'];
			$_FILES['file2']['type']     = $_FILES['ktp']['type'];
			$_FILES['file2']['tmp_name'] = $_FILES['ktp']['tmp_name'];
			$_FILES['file2']['error']    = $_FILES['ktp']['error'];
			$_FILES['file2']['size']     = $_FILES['ktp']['size'];

			$_FILES['file3']['name']     = $_FILES['kk']['name'];
			$_FILES['file3']['type']     = $_FILES['kk']['type'];
			$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
			$_FILES['file3']['error']    = $_FILES['kk']['error'];
			$_FILES['file3']['size']     = $_FILES['kk']['size'];

			$_FILES['file4']['name']     = $_FILES['Pasport']['name'];
			$_FILES['file4']['type']     = $_FILES['Pasport']['type'];
			$_FILES['file4']['tmp_name'] = $_FILES['Pasport']['tmp_name'];
			$_FILES['file4']['error']    = $_FILES['Pasport']['error'];
			$_FILES['file4']['size']     = $_FILES['Pasport']['size'];

			$_FILES['file5']['name']     = $_FILES['buku_nikah']['name'];
			$_FILES['file5']['type']     = $_FILES['buku_nikah']['type'];
			$_FILES['file5']['tmp_name'] = $_FILES['buku_nikah']['tmp_name'];
			$_FILES['file5']['error']    = $_FILES['buku_nikah']['error'];
			$_FILES['file5']['size']     = $_FILES['buku_nikah']['size'];

		
		if(!empty($_FILES['foto']['name']) ){
		    if(!empty($_FILES['ktp']['name'])){
		        if(!empty($_FILES['kk']['name'])){
                    if(!empty($_FILES['Pasport']['name'])){
                        if(!empty($_FILES['buku_nikah']['name'])){
                      
                      $uploadPath = './image/pelanggan/';
			$config5['upload_path'] = $uploadPath;
			$config5['allowed_types'] = 'pdf';
			$config5['max_size'] = '1024';
			$config5['file_name'] = 'Buku Nikah '.$NamaLengkap;
			$this->load->library('upload', $config5);
			$this->upload->initialize($config5);
                 
			if(! $this->upload->do_upload('file5')){
			    $respone = [
				'status' => 'error',
				'message'=> 'Foto Format Buku Nikah Salah / Ukuran Terlalu Besar..!'
			];
			}else{
			      	    $uploadPath = './image/pelanggan/';
			$config4['upload_path'] = $uploadPath;
			$config4['allowed_types'] = 'pdf';
			$config4['max_size'] = '1024';
			$config4['file_name'] = 'Pasport '.$NamaLengkap;
			$this->load->library('upload', $config4);
			$this->upload->initialize($config4);
			if(! $this->upload->do_upload('file4')){
			        $respone = [
			     'status' => 'error',
        'message'=> 'Maaf Format Passpor Salah / Ukuran Terlalu Besar...!'
        ];
			}else{
			
				$uploadPath = './image/pelanggan/';
			$config3['upload_path'] = $uploadPath;
			$config3['allowed_types'] = 'pdf';
			$config3['max_size'] = '1024';
			$config3['file_name'] = 'KK '.$NamaLengkap;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			if(! $this->upload->do_upload('file3')){
			       $respone = [
        'status' => 'error',
        'message'=> 'Maaf Format KK Salah / Ukuran Terlalu Besar...!'
        ];
			}else{
			    	$uploadPath = './image/pelanggan/';
			$config1['upload_path'] = $uploadPath;
			$config1['allowed_types'] = 'pdf';
			$config1['max_size'] = '1024';
			$config1['file_name'] = 'KTP '.$NamaLengkap;
			$this->load->library('upload', $config1);
			$this->upload->initialize($config1);
			if(!$this->upload->do_upload('file2')){
			    $respone = [
        'status' => 'error',
        'message'=> 'Maaf Format KTP Salah / Ukuran Terlalu Besar...!'
        ];
        
		}else{
		    
           $uploadPath = './image/pelanggan/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '1024';
			$config['file_name'] = 'foto '.$NamaLengkap;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file1')){
			    $respone = [
				'status' => 'error',
				'message'=> 'Foto Format Foto Salah / Ukuran Terlalu Besar..!'
			];
			}else{
			
		    $Insert					= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
			$InsertLagi = $this->Pemesanan_models->Insert($DataPesananya);
			$respone = [

				'status' => 'success',
				'message'=> 'Berhasil Upload Dokumen.!',
				'kode'	=>base64_encode($id),
				'idData'=>base64_encode($idD),

			];
			   
			}
			}
		    }
			    
			}
			    
			}
		
}else{
  
}
                    }else{
                         $respone = [
        'status' => 'error',
        'message'=> 'Maaf Pasport Tidak Boleh Kosong..!'
        ];
        
                        
                    }
		        }else{
		                  $respone = [
        'status' => 'error',
        'message'=> 'Maaf kk Tidak Boleh Kosong..!'
        ];
		        }
		    }else{
		  $respone = [
        'status' => 'error',
        'message'=> 'Maaf KTP Tidak Boleh Kosong..!'
        ];
		    }
	
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Foto Wajib Diisi..!'
			];

		}
		echo json_encode($respone);
	}


	public function UploadDokumenProsesTiket()
	{
		$id 										= $this->input->post('idfile');
		$idD 									= $this->input->post('id');
		$idP 									= $this->input->post('idP');
		$idJ 									= $this->input->post('idJ');
		$CekData1 = ['id_tiket_YKM'=>$idD] ;
		$CekData2 = ['id'=>$idJ] ;
		$name_id = $idD;

		$CekDataG 					= $this->Tiket_models->CekDataLagi($CekData1)->row_array();
		$CekData 					= $this->Pengguna_models->idPelanggan($id)->row_array();
		$CekDatas 					= $this->Tiket_models->CekDataTiket1($CekData2)->row_array();
		$NamaLengkap = $CekData['nama_lengkap'];
		$HargaTotal = $CekDatas['harga'];
		$JumlahTotal = $CekDatas['jumlah'];
		$JumlahTiketSebelumnya = $CekDataG['Jumlah_tiket'];
		if(!empty($_FILES['ktp']['name']) && !empty($_FILES['kk']['name']) && !empty($_FILES['Pasport']['name']) ){
			$kode = 'TP-YKM';
			$rand = rand(1000,99999);
			$date = date('YmdHis');
			$kodePesan= $kode.'-'.$rand.'-'.$date;
			$Kurangi = $JumlahTiketSebelumnya - 1;
			$Kurangii = $JumlahTotal - 1;
			// var_dump($Kurangi);die();
			$TangglPesan = date('Y-m-d');
			$WaktuPesan = date('H:i');

			$InsertData = [
				'id_pesan_tiket_data'	=>$kodePesan,
				'id_tiket_data_pesan'	=>$rand,
				'id_pelanggan'	=>$idP,
				'tanggal_pesan'	=>$TangglPesan,
				'waktu_pesan'	=>$WaktuPesan,
				'status'		=>1,
				'id_tiket_pesawat_data'=>$idD,
			];

			$InsertData2 = [
				'id_tiket_pemesanan' =>$rand,
				'id_keterangan_tiket'=>$idJ,
				'jumlah'	=>1,
				'harga'	=>$HargaTotal,
			];

			$Total=[
				'Jumlah_tiket' =>$Kurangi];
				$InsertData4=[
					'jumlah' =>$Kurangii];
					$UpdateStatus = [
						'id_file_identitas'	=>$id,
						'foto'	=>'default.png',
					];

					$_FILES['file2']['name']     = $_FILES['ktp']['name'];
					$_FILES['file2']['type']     = $_FILES['ktp']['type'];
					$_FILES['file2']['tmp_name'] = $_FILES['ktp']['tmp_name'];
					$_FILES['file2']['error']    = $_FILES['ktp']['error'];
					$_FILES['file2']['size']     = $_FILES['ktp']['size'];

					$_FILES['file3']['name']     = $_FILES['kk']['name'];
					$_FILES['file3']['type']     = $_FILES['kk']['type'];
					$_FILES['file3']['tmp_name'] = $_FILES['kk']['tmp_name'];
					$_FILES['file3']['error']    = $_FILES['kk']['error'];
					$_FILES['file3']['size']     = $_FILES['kk']['size'];

					$_FILES['file4']['name']     = $_FILES['Pasport']['name'];
					$_FILES['file4']['type']     = $_FILES['Pasport']['type'];
					$_FILES['file4']['tmp_name'] = $_FILES['Pasport']['tmp_name'];
					$_FILES['file4']['error']    = $_FILES['Pasport']['error'];
					$_FILES['file4']['size']     = $_FILES['Pasport']['size'];
					$uploadPath = './image/pelanggan/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '1024';
					$config['file_name'] = 'KTP '.$NamaLengkap;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('file2')){
						$data_upload = $this->upload->data();
						$config['image_library']='gd2';
						$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '50%';
						$config['width']= 100;
						$config['height']= 70;
						$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$UpdateStatus['ktp'] = $data_upload['file_name'];
					}
					else{
						$respone = [
							'status' =>'error',
							'message'=>'Terjadi Kesalahan upload ktp..!'];
						}
						$uploadPath = './image/pelanggan/';
						$config['upload_path'] = $uploadPath;
						$config['allowed_types'] = 'pdf';
						$config['max_size'] = '1024';
						$config['file_name'] = 'KK '.$NamaLengkap;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file3')){
							$data_upload = $this->upload->data();
							$config['image_library']='gd2';
							$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
							$config['create_thumb']= FALSE;
							$config['maintain_ratio']= FALSE;
							$config['quality']= '50%';
							$config['width']= 100;
							$config['height']= 70;
							$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
							$this->load->library('image_lib', $config);
							$this->image_lib->resize();
							$UpdateStatus['kk'] = $data_upload['file_name'];
						}
						else{
							$respone = [
								'status' =>'error',
								'message'=>'Terjadi Kesalahan upload KK..!'];
							}
							$uploadPath = './image/pelanggan/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['max_size'] = '1024';
							$config['file_name'] = 'Pasport '.$NamaLengkap;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if($this->upload->do_upload('file4')){
								$data_upload = $this->upload->data();
								$config['image_library']='gd2';
								$config['source_image']='./image/pelanggan/'.$data_upload['file_name'];
								$config['create_thumb']= FALSE;
								$config['maintain_ratio']= FALSE;
								$config['quality']= '50%';
								$config['width']= 100;
								$config['height']= 70;
								$config['new_image']= './image/pelanggan/'.$data_upload['file_name'];
								$this->load->library('image_lib', $config);
								$this->image_lib->resize();
								$UpdateStatus['Pasport'] = $data_upload['file_name'];
							}
							else{
								$respone = [
									'status' =>'error',
									'message'=>'Terjadi Kesalahan upload passport..!'];
								}
								$InsertLagi = $this->PesanTiket_models->InsertDataNya($InsertData);
								if ($InsertLagi == true) {
									$InsertLagi21 = $this->Tiket_models->UpdateDataNya1($Total,$name_id);
									$InsertLagi22 = $this->Tiket_models->UpdateDataNyaHarga2($InsertData4,$idJ);
									$InsertLagi2 = $this->PesanTiket_models->InsertDataNya2($InsertData2);
									$Insert						= $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil Upload Dokumen.!',
										'kode'	=>base64_encode($idP),
										'idData'=>base64_encode($idD),
										'idJasa'=>base64_encode($rand),

									];

								}else{
									$respone = [
										'status' => 'error',
										'message' => 'Ada Kesalahan dalam upload dokumen...!'
									];
								}
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Maaf Dokumen ini wajib diisi...!',
								];
							}
							echo json_encode($respone);
						}



					}
