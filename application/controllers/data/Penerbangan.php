<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penerbangan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Penerbangan_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function Travel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 										= $this->session->userdata('id_akses');
			$DataNya             		= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$this->template->layout('penerbangan/travel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function infoTravel($Gabungkan)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 										= $this->session->userdata('id_akses');
			$DataNya             		= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['Level']           = $Level;
			$data['kode'] 					= $Gabungkan;
			$data['Kursi']					= $this->Penerbangan_models->DataKursi($Gabungkan)->result();
			$data['TotalData']			= $this->Penerbangan_models->TotalData($Gabungkan)->row();

			$this->template->layout('penerbangan/infoKursi.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}


	public function info($Gabungkan)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 										= $this->session->userdata('id_akses');
			$DataNya             		= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];

			$nomor 									= $Gabungkan;
			$Maskapai								= $this->Penerbangan_models->AmbekJumlah($nomor)->row_array();
			$data['namaMaskapai']		= $Maskapai['nama_maskapai'];
			$data['kodePenerbangan']	= $Maskapai['kode_penerbangan'];
			$data['tanggalPesan']		= $Maskapai['tanggal_pesan'];
			$data['JK']					= $Maskapai['jumlah_kursi'];
			$data['Kursi']				= $this->Penerbangan_models->DataKursi($Gabungkan)->result();

			$this->template->layout('penerbangan/infoMaskapai.php',$data);
		}else{
			redirect('Error/AksesError');
		}	
	}

	public function editTravel($idDataNya)
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             		= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
		// $data['nama']           = $DataNya['username'];

			$data['Params']							= $this->input->get('Keterangan');
			$Cek 																		= $this->Penerbangan_models->ShowData($idDataNya)->row_array();
			$data['idData']		= $Cek['id'];
			$data['kode']		= $Cek['kode_penerbangan'];
			$data['Np']				= $Cek['nama_perusahaan'];
			$data['NK']				= $Cek['nilai_kerjasama'];
			$data['TB']				= $Cek['tanggal_berlaku'];
			$data['TBR']			= $Cek['tanggal_berakhir'];
			$data['NPK']			= $Cek['nama_pemberi_kerjasama'];
			$data['FK']				= $Cek['file_kemitraan'];
			$data['NS']				= $Cek['nama_maskapai'];
			$data['JK']				= $Cek['jumlah_kursi'];
			$data['TP']				= $Cek['tanggal_pesan'];
			$data['IDF']			= $Cek['id_dokumen_kemitraan'];

			$this->template->layout('penerbangan/EditDatatravel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function formTravel()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$this->template->layout('penerbangan/formtravel.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function TambahKursi()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['Level']           = $Level;
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$KursiNya	= $this->input->get('Kursi');
			$DataCekPenerbangan 					= [
				'id' =>$KursiNya,
			];
			$Keterangan 												= $this->input->get('Keterangan');
			$JumlahKursi 										 = $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
			$data['TotalKursi']					= $JumlahKursi['jumlah_kursi'];
			$data['idKursi']								= $JumlahKursi['id'];

			$this->template->layout('penerbangan/formKursi.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}

	public function InfoKursi()
	{
		$Level = $this->session->userdata('id_level'); 
		if ($Level == 1 || $Level == 3) {
			
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 																				= $this->session->userdata('id_akses');
			$DataNya             			= $this->Pengguna_models->DataUbah($id)->row_array();
			$data['id']             = $DataNya['id_akses'];
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$KursiNya	= base64_decode($this->input->get('kursi'));
			$DataCekPenerbangan 					= [
				'id' =>$KursiNya,
			];
			$data['Level']           = $Level;
			
			$JumlahKursi 										 = $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
			$data['TotalKursi']					= $JumlahKursi['jumlah_kursi'];
			$data['namaMaskapai']			= $JumlahKursi['nama_maskapai'];
			$data['kodepenerbangan']= $JumlahKursi['kode_penerbangan'];

			$CekNomorKursiId = 	[
				'id_penerbangan_kursi' => $KursiNya,
			];

			$data['Kursi'] 									= $this->Penerbangan_models->NomorKursiCek($CekNomorKursiId);
			$data['idData']									= $KursiNya;

			$this->template->layout('penerbangan/infoKursi.php',$data);
		}else{
			redirect('Error/AksesError');
		}
	}


	public function deleteTravel($id)
	{
		$HapusKursi 						= $this->Penerbangan_models->DeleteKursi($id);
		if ($HapusKursi == true) 
		{
			$HapusMaskapai 					= $this->Penerbangan_models->DeleteMaskapai($id);
			$respone = [
				'status' => 'success',
				'message' => 'Data Berhasil Dihapus...!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Data Tidak Dapat Dihapus....!',
			];

		}
		echo json_encode($respone);
	}

	public function deleteKursi()
	{
		$id 														= $this->input->post('id');
		$idPenerbangan 		 = $this->input->post('per');
		$DataCekPenerbangan =[
			'id'		=>$idPenerbangan
		];

		$AmbekJumlah 					= $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->row_array();
		$idDataNya 											= $AmbekJumlah['id'];
		$JumlahKursi 					= $AmbekJumlah['jumlah_kursi'];
		$TokUpdate								= $JumlahKursi - 1;

		$DataPenerbangan 				=[
			'jumlah_kursi'				=>$TokUpdate	
		];
		$InsertDataLagi 				= $this->Penerbangan_models->UpdateMaskapaiNya($DataPenerbangan,$idDataNya);
		if ($InsertDataLagi == true) 
		{
			$HapusKursi 						= $this->Penerbangan_models->DeleteKursiNya($id);
			$respone = [
				'status' => 'success',
				'message' => 'Data Berhasil Dihapus...!',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message' => 'Data Tidak Dapat Dihapus....!',
			];

		}
		echo json_encode($respone);
	}

	public function simpanKursi()
	{

		$id= 		 	  $_POST['id'];
		$nomor 		= $_POST['nomor'];
		$DataNya = array();
		for($i=0;$i < count($nomor);$i++){
			$DataNya[] 		 = array(
				'id_penerbangan_kursi'=>$id[$i],
				'nomor_kursi'									=>$nomor[$i],
			);

		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nomor[]','Nomor[]', 'required|trim|alpha_numeric_spaces');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Tidak Sesuai Format / Ada Data yang kosong..!',
			];

		}else{
			$Insert  			= $this->Penerbangan_models->InsertKursi($DataNya);
			if ($Insert == true) {
				$respone = [
					'status' => 'success',
					'message' => 'Berhasil',
				];
			}
		}
		// }
		echo json_encode($respone);
	}
	public function UpdateKursi()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nomor','Nomor', 'required|trim|alpha_numeric_spaces');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Tidak Sesuai Format / Data kosong..!',
			];

		}else{

			$id 							= $this->input->post('id');
			$nomor 				= $this->input->post('nomor');
			$valid 				= $this->input->post('valid');

			$CekNomorKursiId = [
				'id'			=> $id
			];

			if (!empty($nomor)) {
				if ($valid == 1) {
					$CekNomorBaru 		= $this->Penerbangan_models->NomorKursiCek($CekNomorKursiId)->row_array();
					$KodePenerbangan = $CekNomorBaru['id_penerbangan_kursi'];
					if ($nomor == $CekNomorBaru['nomor_kursi']) {
						$respone = [
							'status' => 'error',
							'message' => 'Data Tidak Ada Perubahan..!',
						];
					}else{
						$CekNomorDua = [
							'id_penerbangan_kursi'=>$KodePenerbangan,
							'nomor_kursi'									=>$nomor
						];

						$CekNomorBaru 		= $this->Penerbangan_models->NomorCekDua($CekNomorDua)->num_rows();
						if ($CekNomorBaru > 0) {
							$respone = [
								'status' => 'error',
								'message' => 'Nomor Sudah Dipakai..!',
							];
						}else{
							$data = [
								'nomor_kursi'=>$nomor
							];
							$this->db->update('db_penerbangan_kursi',$data,array('id'=>$id));
							$respone = [
								'status' => 'success',
								'message' => 'Berhasil',
							];
						}
					}
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Klik validasi data!',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message' => 'Nomor Kosong..!',
				];
			}
		}

		echo json_encode($respone);
	}

	public function TambahKursiTravelLagi()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama','required|alpha_numeric_spaces');

		if ($this->form_validation->run() == false) {
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan Input Data....!',
			];
		}else{
			$id													= $this->input->post('id');
			$nomor										= $this->input->post('nama');

			$DataCek 								= [
				'id_penerbangan_kursi' 		=> $id,
				'nomor_kursi'			 								=> $nomor
			];
			$Cek 										= $this->Penerbangan_models->CekDataKursi($DataCek)->num_rows();

			if ($Cek > 0) 
			{
				$respone = [
					'status' => 'error',
					'message' => 'Maaf Nomor Tersebut Sudah Ada.....!',
				];
			}else{
				$DataPenerbanganNya 	= [
					'id_penerbangan_kursi' 	=> $id,
					'nomor_kursi'											=> $nomor,
					'status_kursi'										=> 0
				];

				$DataNya = [
					'id' => $id
				];

				$CekDataFor 										= $this->Penerbangan_models->CekDataFor($DataNya)->row_array();
				$JumlahSebelumnya 				= $CekDataFor['jumlah_kursi'];
				$TokUpdate 											= $JumlahSebelumnya + 1;

				$TambahKursi 									=[
					'jumlah_kursi'	=> $TokUpdate
				];
				$idDataNya 											=  $id;
				$InsertDataLagi 					= $this->db->update('db_penerbangan', $TambahKursi, array('id' => $id));
				if ($InsertDataLagi == true) {
					$InsertData 					= $this->Penerbangan_models->UpdateKuris($DataPenerbanganNya);
					$respone = [
						'status' => 'success',
						'message' => 'Data Berhasil Ditambahkan....!',
					];

				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Gagal Input Data...!',
					];
				}
			}
		}
		echo json_encode($respone);
	}

	public function HapusKursiTravel()
	{

		$id												= $this->input->post('id');
		$nomor										= $this->input->post('nama');

		$DataCek 								= [
			'kode_penerbangan' 		=> $nomor,
			'nomor_kursi'			 		=> $id
		];

		$Cek 										= $this->Penerbangan_models->CekDataKursi($DataCek)->row_array();
		$SK 										= $Cek['status_kursi'];
		$idKusri 								= $Cek['id'];

		if ($SK == 0) 
		{
			$respone = [
				'status' => 'error',
				'message' => 'Maaf Nomor Tidak Bisa DiHapus.....!',
			];

		}else{

			$Cek 								= $this->Penerbangan_models->AmbekJumlah($nomor)->row_array();
			$JumlahSebelumnya 					= $Cek['jumlah_kursi'];
			$HitungKursi 						= count($id);
			$TokUpdate 							= $JumlahSebelumnya - $HitungKursi;
			$DataPenerbangan 				=[
				'jumlah_kursi'				=>$TokUpdate	
			];

			$InsertData 						= $this->Penerbangan_models->DeleteKursiMaskapai($idKusri);
			$InsertDataLagi 				= $this->Penerbangan_models->UpdateMaskapaiNya($DataPenerbangan,$nomor);

			$respone = [
				'status' => 'success',
				'message' => 'Data Dihapus....!',
			];

		}
		echo json_encode($respone);
	}

	public function datapenerbangantravel()
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
			0=>'kode_penerbangan',
			1=>'nama_maskapai',
			2=>'tanggal_pesan',
			3=>'jumlah_kursi',
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
		$Menus = $this->Penerbangan_models->DataTravel();

		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$idDataNya = $rows->id; 
			$data[]= array(
				$no++,
				'<a href="editTravel/'.$idDataNya.'?Keterangan=Info">'.$rows->kode_penerbangan.'</a>',
				$rows->nama_maskapai,
				date('d-m-Y',strtotime($rows->tanggal_pesan)),
				'<a href="InfoKursi/?kursi='.base64_encode($idDataNya).'">'.$rows->jumlah_kursi. ' Kursi'.' </a>',
				$rows->tanggal_pesan != NULL ? 
				'<a type="submit" href="editTravel/'.$idDataNya.'?Keterangan=Ubah" class="fa fa-edit" title="Edit Data"> ' : '<a type="submit" class="remove fa fa-trash-o" id="'.$idDataNya.'" nama="'.$rows->nama_maskapai.'" jumlah="'.$rows->jumlah_kursi.'" title="Hapus"></a>
				'
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
	public function simpanTravel()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nameKode','NameKode', 'required|trim|alpha',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kodePenerbangan','KodePenerbangan', 'required|trim|numeric',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama_perusahaan','Nama_perusahaan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama','Nama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPesan','TanggalPesan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerlaku','TanggalBerlaku', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerakhir','TanggalBerakhir', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nilaiKerjasama','nilaiKerjasama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('kursi','Kursi', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPK','NamaPK', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terdapat Kesalahan Input Data..!',
			];

		}else{
			$kode				= $this->input->post('nameKode');
			$nomor				= $this->input->post('kodePenerbangan');
			$nama_perusahaan	= $this->input->post('nama_perusahaan');
			$nama				= $this->input->post('nama');
			$tanggalPesan		= $this->input->post('tanggalPesan');
			$tanggalBerlaku		= $this->input->post('tanggalBerlaku');
			$tanggalBerakhir	= $this->input->post('tanggalBerakhir');
			$nilaiKerjasama		= $this->input->post('nilaiKerjasama');
			$kursi				= $this->input->post('kursi');
			$namaPK				= $this->input->post('namaPK');
			$idPenerbangan		= rand(1000,99999);
			$kodeKursiData		= rand(1000,99999);
			$idData				= rand(1000,99999);
			$Gabungkan 			= $kode.'-'.$nomor;
			$DataCekPenerbangan = [
				'id' 			  =>$idPenerbangan,
				'kode_penerbangan'=>$Gabungkan,
				'id_dokumen_kemitraan'=>$idData,
			];
			$CekKodePenerbangan = $this->Penerbangan_models->DataCekPenerbangan($DataCekPenerbangan)->num_rows();

			if ($CekKodePenerbangan > 0 ) 
			{
				$respone = [
					'status' 	=> 'error',
					'message' => 'Data Sudah Ada..!',
				];	
			}else{

				$CekKodeDokumenPenerbangan = $this->Penerbangan_models->DataCekKodeDokumenPenerbangan($idData)->num_rows();

				if ($CekKodeDokumenPenerbangan > 0) {
					$respone = [
						'status' 	=> 'error',
						'message' 	=> 'Data Sudah Ada..!',
					];	
				}else{

					$CekKodeKursinPenerbangan = $this->Penerbangan_models->CekKodeKursinPenerbangan($idPenerbangan)->num_rows();

					if ($CekKodeKursinPenerbangan > 0) {
						$respone = [
							'status' 	=> 'error',
							'message' 	=> 'Data Sudah Ada..!',
						];	
					}else{

						$DataNya = [
							'id'		 		 											=> $idPenerbangan,
							'kode_penerbangan' 		=> $Gabungkan,
							'nama_maskapai'						=> $nama,
							'tanggal_pesan'						=> $tanggalPesan,
							'jumlah_kursi'							=> $kursi,
							'id_dokumen_kemitraan'	=> $idData,
						];

						$UpdateStatus = [
							'id_dokumen'		 		=> $idData,
							'nama_perusahaan' 			=> $nama_perusahaan,
							'nilai_kerjasama'			=> $nilaiKerjasama,
							'tanggal_berlaku'			=> $tanggalBerlaku,
							'tanggal_berakhir'			=> $tanggalBerakhir,
							'nama_pemberi_kerjasama'	=> $namaPK,
						];

						if(!empty($_FILES['ktp']['name'])){
							$_FILES['file1']['name']     = $_FILES['ktp']['name'];
							$_FILES['file1']['type']     = $_FILES['ktp']['type'];
							$_FILES['file1']['tmp_name'] = $_FILES['ktp']['tmp_name'];
							$_FILES['file1']['error']    = $_FILES['ktp']['error'];
							$_FILES['file1']['size']     = $_FILES['ktp']['size'];

							$uploadPath = './image/kemitraan/';
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = 'pdf';
							$config['max_size'] = '1024';
							$config['file_name'] = 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaan'.$nama_perusahaan;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if($this->upload->do_upload('file1')){
								$data_upload = $this->upload->data();
								$config['image_library']='gd2';
								$config['source_image']='./image/kemitraan/'.$data_upload['file_name'];
								$config['create_thumb']= FALSE;
								$config['maintain_ratio']= FALSE;
								$config['quality']= '50%';
								$config['width']= 100;
								$config['height']= 70;
								$config['new_image']= './image/kemitraan/'.$data_upload['file_name'];
								$this->load->library('image_lib', $config);
								$this->image_lib->resize();
								$UpdateStatus['file_kemitraan'] = $data_upload['file_name'];
							}

						// }else{

							$Insert 				= $this->Penerbangan_models->InsertMaskapaiNya($DataNya);
							$InsertNah 	= $this->Penerbangan_models->InsertDokumenKemitraan($UpdateStatus);
							$respone = [
								'status' => 'success',
								'message' => 'Selanjutnya Silakan TambahKan Kursi nya..!',
								'kursi'	=> $idPenerbangan,
							];
							// $respone = [
							// 	'status' => 'error',
							// 	'message' => 'Wajib Ada File..!',
							// ];
						// }
						}
					}
				}
			}
		}
		echo json_encode($respone);

	}

	public function UbahPenerbangan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_perusahaan','Nama_perusahaan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nama','Nama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPesan','TanggalPesan', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerlaku','TanggalBerlaku', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalBerakhir','TanggalBerakhir', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('nilaiKerjasama','nilaiKerjasama', 'required|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('namaPK','NamaPK', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terdapat Kesalahan Input Data..!',
			];


		}else{
			$idDataNya								= $this->input->post('id');
			$kode													= $this->input->post('nameKode');
			$nama_perusahaan		= $this->input->post('nama_perusahaan');
			$nama													= $this->input->post('nama');
			$tanggalPesan					= $this->input->post('tanggalPesan');
			$tanggalBerlaku			= $this->input->post('tanggalBerlaku');
			$tanggalBerakhir		= $this->input->post('tanggalBerakhir');
			$nilaiKerjasama			= $this->input->post('nilaiKerjasama');
			$namaPK											= $this->input->post('namaPK');
			$idFile											= $this->input->post('ktp1');
			$idFile2										= $this->input->post('ktp2');

			$DataNya = [
				'nama_maskapai'						=> $nama,
				'tanggal_pesan'						=> $tanggalPesan,
			];

			$UpdateStatus = [
				'nama_perusahaan' 			=> $nama_perusahaan,
				'nilai_kerjasama'				=> $nilaiKerjasama,
				'tanggal_berlaku'				=> $tanggalBerlaku,
				'tanggal_berakhir'			=> $tanggalBerakhir,
				'nama_pemberi_kerjasama'	=> $namaPK,
			];

			if(!empty($_FILES['ktp']['name'])){
				$_FILES['file1']['name']     = $_FILES['ktp']['name'];
				$_FILES['file1']['type']     = $_FILES['ktp']['type'];
				$_FILES['file1']['tmp_name'] = $_FILES['ktp']['tmp_name'];
				$_FILES['file1']['error']    = $_FILES['ktp']['error'];
				$_FILES['file1']['size']     = $_FILES['ktp']['size'];

				$uploadPath = './image/kemitraan/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = 'Dokumen_Kemitraan_Penerbangan_dengan_perusahaan'.$nama_perusahaan;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file1')){
					if ($idFile2 != '') {
						unlink("./image/kemitraan/".$idFile2);
					}
					$data_upload = $this->upload->data();
					$config['image_library']='gd2';
					$config['source_image']='./image/kemitraan/'.$data_upload['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '50%';
					$config['width']= 100;
					$config['height']= 70;
					$config['new_image']= './image/kemitraan/'.$data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$UpdateStatus['file_kemitraan'] = $data_upload['file_name'];
				}
				$InsertNah 	= $this->Penerbangan_models->UpdateDokumenKemitraan($UpdateStatus,$idFile);
				if ($InsertNah == true) {
					$Insert 				= $this->Penerbangan_models->UpdateMaskapaiNya($DataNya,$idDataNya);
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan..!',
					];
				}
			}else{
				$InsertNah 	= $this->Penerbangan_models->UpdateDokumenKemitraan($UpdateStatus,$idFile);
				if ($InsertNah == true) {
					$Insert 				= $this->Penerbangan_models->UpdateMaskapaiNya($DataNya,$idDataNya);
					$respone = [
						'status' => 'success',
						'message' => 'Berhasil',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message' => 'Terjadi Kesalahan..!',
					];
				}
			}
		}
		echo json_encode($respone);

	}

	public function UbahTravel()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','Nama', 'required|alpha_numeric_spaces|trim',['required' => 'Wajib Diisi.']);
		$this->form_validation->set_rules('tanggalPesan','TanggalPesan', 'required|trim',['required' => 'Wajib Diisi.']);

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Data Tidak Sesuai Dengan Inputan....!',
			];

		}else{

			$nomor				= $this->input->post('nomor');
			$nama					= $this->input->post('nama');
			$tanggalPesan	= $this->input->post('tanggalPesan');

			$DataPenerbangan 	= [
				'nama_maskapai'			=> $nama,
				'tanggal_pesan'			=> $tanggalPesan,
			];

			$InsertLagi = $this->Penerbangan_models->UpdateMaskapaiNya($DataPenerbangan,$nomor);
			$respone = [
				'status' 	=> 'success',
				'message' => 'Data Berhasil Tersimpan..!',
			];
		}
		echo json_encode($respone);

	}

	public function TotalNya()
	{
		$query = $this->db->select("COUNT(*) as num")->order_by('nama_maskapai','ASC')->get("db_penerbangan");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}


}
