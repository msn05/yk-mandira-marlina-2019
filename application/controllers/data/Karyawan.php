<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models','Karyawan_models']);
		$this->load->library('template');
		False();
		
	}

	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
  $Level          = $this->session->userdata('id_level');
  if ($id == NULL) {
   redirect('Error/ErrorData');
  }elseif($Level != 1){
   redirect('Error/AksesError');
  }

  $data['Level']             = $Level;
  $DataNya              = $this->Pengguna_models->DataUbah($id)->row_array();
  $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
  $data['nama']           = $DataNSiswa['nama_lengkap'];
  $data['id']             = $DataNya['id_akses'];
  $this->template->layout('Karyawan/index.php',$data);
 }

 public function form()
 {
  $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
  $id      = $this->session->userdata('id_akses');
  if ($id == NULL) {
   redirect('Error/ErrorData');
  }
  $data['headerMenu']  = 'Form Tambah Karyawan';
  $data['idAkses']   = rand(1000,99999);
  $data['idFoto']   = rand(1000,99999);
  $data['LevelData']      = $this->Pengguna_models->Level()->result();
  $DataNya              = $this->Pengguna_models->DataUbah($id)->row_array();
  $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
  $data['nama']           = $DataNSiswa['nama_lengkap'];
  $data['id']             = $DataNya['id_akses'];
  $data['Level']       = $DataNya['id_level'];

  $this->template->layout('Karyawan/form.php',$data);
 }

 public function editAkses()
 {
  $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
  $id                     = base64_decode($this->input->get('AkunName'));
  if ($id == NULL) {
   redirect('Error/ErrorData');
  }
  $data['headerMenu']     = 'Form  Karyawan';
  $data['Akses']          = $this->Pengguna_models->Level()->result();
  $DataNya                = $this->Pengguna_models->DataUbah($id)->row_array();
  $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
  $data['nama']           = $DataNSiswa['nama_lengkap'];
  $data['id']             = $DataNya['id_akses'];
  $data['LevelNya']       = $DataNya['id_level'];
  $data['Level']       = $DataNya['id_level'];

  $this->template->layout('Karyawan/edit.php',$data);
 }

 public function simpanPerubahanAkses()
 {
  $id         = htmlspecialchars($this->input->post('id_akses'));
  $level      = htmlspecialchars($this->input->post('level'));
  if ($level != '') {
   $UpdateStatus =[
    'id_akses'  => $id,
    'status_users' => $level,
   ];
   $res = $this->Pengguna_models->UpdateStatus($id,$UpdateStatus);
   $respone = [
    'status' => 'success',
    'message'=> 'Berhasil Mengubah Data...!'
   ];
  }
  echo json_encode($respone);
 }
 public function Data()
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
   0=>'id_akses',
   1=>'password',
   2=>'nama_level',
   3=>'nomor_telephone',
   4=>'nama_lengkap',
   5=>'login',
   6=>'logout'
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
  $Menus = $this->Karyawan_models->Data();
  $data = array();
  $no = 1;
  $num_char = 10;
  foreach($Menus->result() as $rows)
  {
   $id = $rows->id_akses; 

   $data[]= array(
    $no++,
    '<a href="profile/info/'.$id.'" title="Informasi Karyawan">
    '.$rows->nama_lengkap.'</a>',
    $rows->nomor_telephone ,
    '<a href="karyawan/editAkses?AkunName='.base64_encode($id).'">'.(
     $rows->status_users == 1 ? '<span class="label label-success label-pill">Aktif</span>' : '<span class="label label-warning label-pill">Tidak Aktif</span>').'</a>',
    $rows->login,
    $rows->logout,


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
  $query = $this->db->select("COUNT(*) as num")->get_where("db_data_akses",array('status_akun_pengguna'=>1));
  $result = $query->row();
  if(isset($result)) return $result->num;
  return 0;
 }

 public function simpanData()
 {
  $this->load->library('form_validation');

  $this->form_validation->set_rules('id','Id', 'required|trim');
  $this->form_validation->set_rules('namaLengkap','namaLengkap', 'required|trim');
  $this->form_validation->set_rules('email','Email', 'required|trim|valid_emails');
  $this->form_validation->set_rules('no_ktp','No_ktp', 'required|trim');
  $this->form_validation->set_rules('no_kk','No_kk', 'required|trim');

  $this->form_validation->set_rules('no_telp','No_telp', 'required|trim');
  $this->form_validation->set_rules('nodar','Nodar', 'required|trim');
  $this->form_validation->set_rules('nowat','CNowat', 'required|trim');

  $this->form_validation->set_rules('tempatLahir','TempatLahir', 'required|trim');
  $this->form_validation->set_rules('alamat','Alamat', 'required|trim');
  $this->form_validation->set_rules('tanggalLahir','TanggalLahir', 'required|trim');
  $this->form_validation->set_rules('idFoto','IdFoto', 'required|trim');

  $this->form_validation->set_rules('aksesNya','AksesNya', 'required|trim');

  if($this->form_validation->run() == false){
   $respone = [
    'status' => 'error',
    'message' => 'Data Masih Ada Yang Kosong...!',
   ];

  }else{
   $id    = $this->input->post('id');
   $namaLengkap  = $this->input->post('namaLengkap');
   $email    = $this->input->post('email');
   $no_ktp   = $this->input->post('no_ktp');
   $no_kk    = $this->input->post('no_kk');
   $no_telp   = $this->input->post('no_telp');
   $aksesNya   = $this->input->post('aksesNya');
   $IdFileData   = $this->input->post('idFoto');
   $tanggalLahir  = $this->input->post('tanggalLahir');
   $tempatLahir  = $this->input->post('tempatLahir');
   $alamat   = $this->input->post('alamat');
   $nowat    = $this->input->post('nowat');
   $nodar    = $this->input->post('nodar');

   if (!empty($email) && !empty($namaLengkap) && !empty($id) && !empty($no_ktp) && !empty($no_kk) && !empty($no_telp) && !empty($aksesNya) && !empty($IdFileData) && !empty($tanggalLahir) && !empty($alamat) && !empty($nowat) && !empty($nodar) && !empty($tempatLahir) ){

    $CekEmailData = $this->Pengguna_models->Email($email)->num_rows();

    if ($CekEmailData > 0 ) {
     $respone = [
      'status'  => 'error',
      'message'  => 'Email Sudah Ada...!',
     ];
    }else{
     $CekNomorTelphoneData = $this->Pengguna_models->NomorTelphone($no_telp)->num_rows();
     // var_dump($CekNomorTelphoneData);die();
     if ($CekNomorTelphoneData > 0) {
      $respone = [
       'status'  => 'error',
       'message'  => 'Nomor Telphone Sudah Ada...!',
      ];
     }else{
      $CekNomorDarurat = $this->Pengguna_models->NomorDarurat($nodar)->num_rows();

      if ($CekNomorDarurat > 0 ) {
       $respone = [
        'status'  => 'error',
        'message'  => 'Nomor Darurat Sudah Ada...!',
       ];
      }else{
       $CekIdFileData = $this->Pengguna_models->Dokumen($IdFileData)->num_rows();
       if ($CekIdFileData > 0)  {
        $respone = [
         'status'  => 'error',
         'message'  => 'Kode File Data Pengguna Sudah Ada...!',
        ];
       }else{

        if ([alpha($namaLengkap) && alpha($tempatLahir)] === false ) {
         $respone = [
          'status'  => 'error',
          'message'  => 'Hanya Huruf..!',
         ];

        }else{
         if ([numeric($nowat) && numeric($nodar) && numeric($no_telp) && numeric($no_ktp) && numeric($no_kk)] == false ) {
          $respone = [
           'status'  => 'error',
           'message'  => 'Harus Angka ya..!',
          ];
         }else{
          if ([$nowat && $nodar && $no_telp] <= 10) {
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

            $password_hash = password_hash('123456',PASSWORD_DEFAULT);
            $UpdateStatus = [
             'id_akses' => $id,
             'password'  => $password_hash,
             'status_users' => 1,
             'id_level'   => $aksesNya,
            ];
            $PostData2 = [
             'id_akses'  => $id,
             'nama_lengkap' =>$namaLengkap,
             'no_ktp' => $no_ktp,
             'no_kk' => $no_kk,
             'nomor_telephone' => $no_telp,
             'nomor_wa'  => $nowat,
             'email'  => $email,
             'alamat' => $alamat,
             'tanggal_lahir' => $tanggalLahir,
             'tempat_lahir' => $tempatLahir,
             'nomor_darurat' => $nodar,
             'status_akun_pengguna' => 1,
             'id_file_identitas' => $IdFileData,
            ];
            $dataFile = [
             'id_file_identitas'=>$IdFileData,
            ];

            $Insert = $this->Pengguna_models->InsertData($UpdateStatus);
            if ($Insert == true) {
             $InsertLagi2 = $this->Pengguna_models->InsertDataLagiNah($dataFile);
             $InsertLagi = $this->Pengguna_models->InsertDataLagi($PostData2);
             $respone = [
              'status'  => 'success',
              'message'  => 'Berhasil Menambahkan Data..!',
             ];
            }else{
             $respone = [
              'status'  => 'error',
              'message'  => 'Gagal Menambahkan Data..!',
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
   }else{
    $respone = [
     'status'  => 'error',
     'message'  => 'Terjadi Kesalahan...!'
    ];
   }
  }
  echo json_encode($respone);
 }

 public function UploadFile(){
  $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
  $id                     = $this->session->userdata('id_akses');
  $Level                  = $this->session->userdata('id_level');
  if ($id == NULL) {
   redirect('Error/ErrorData');
  }elseif($Level != 1){
   redirect('Error/AksesError');
  }
  $data['headerMenu']     = 'Form Upload Data Karyawan';
  $data['idFileNya']      = $this->input->get('idFile');
  $DataNya                = $this->Pengguna_models->DataUbah($id)->row_array();
  $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
  $data['nama']           = $DataNSiswa['nama_lengkap'];
  $data['id']             = $DataNya['id_akses'];
  $data['Level']       = $DataNya['id_level'];
  
  $this->template->layout('Karyawan/Upload.php',$data);
 }

 public function UploadDokumen()
 {
  $id          = $this->input->post('id');
  $CekData     = $this->Pengguna_models->IdData($id)->row_array();
  $NamaLengkap = $CekData['nama_lengkap'];
  $FotoLama    = $CekData['foto'];
  $FotoKTP     = $CekData['ktp'];
  $KKNya       = $CekData['kk'];

  if ($CekData != NULL) {
   if([!empty($_FILES['foto']['name']) && ($_FILES['ktp']['name'])  && ($_FILES['kk']['name'])]){
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


    $uploadPath = './image/dokumen/';
    $config['upload_path'] = $uploadPath;
    $config['allowed_types'] = 'png|jpg|jpeg';
    $config['max_size'] = '1024';
    $config['file_name'] = 'foto '.$NamaLengkap;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if($this->upload->do_upload('file1')){
     $data_upload = $this->upload->data();
     if ($FotoLama != 'default.png') {
      unlink("./image/dokumen/".$FotoLama);
     }
     $config['image_library']='gd2';
     $config['source_image']='./image/dokumen/'.$data_upload['file_name'];
     $config['create_thumb']= FALSE;
     $config['maintain_ratio']= FALSE;
     $config['quality']= '50%';
     $config['width']= 100;
     $config['height']= 70;
     $config['new_image']= './image/dokumen/'.$data_upload['file_name'];
     $this->load->library('image_lib', $config);
     $this->image_lib->resize();
     $UpdateStatus['foto'] = $data_upload['file_name'];
    }
    $uploadPath = './image/dokumen/';
    $config['upload_path'] = $uploadPath;
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = '1024';
    $config['file_name'] = 'KTP '.$NamaLengkap;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if($this->upload->do_upload('file2')){
     $data_upload = $this->upload->data();
     if ($FotoKTP != '') {
      unlink("./image/dokumen/".$FotoKTP);
     }
     $config['image_library']='gd2';
     $config['source_image']='./image/dokumen/'.$data_upload['file_name'];
     $config['create_thumb']= FALSE;
     $config['maintain_ratio']= FALSE;
     $config['quality']= '50%';
     $config['width']= 100;
     $config['height']= 70;
     $config['new_image']= './image/dokumen/'.$data_upload['file_name'];
     $this->load->library('image_lib', $config);
     $this->image_lib->resize();
     $UpdateStatus['ktp'] = $data_upload['file_name'];
    }

    $uploadPath = './image/dokumen/';
    $config['upload_path'] = $uploadPath;
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = '1024';
    $config['file_name'] = 'KK '.$NamaLengkap;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if($this->upload->do_upload('file3')){
     $data_upload = $this->upload->data();
     if ($KKNya != '') {
      unlink("./image/dokumen/".$KKNya);
     }
     $config['image_library']='gd2';
     $config['source_image']='./image/dokumen/'.$data_upload['file_name'];
     $config['create_thumb']= FALSE;
     $config['maintain_ratio']= FALSE;
     $config['quality']= '50%';
     $config['width']= 100;
     $config['height']= 70;
     $config['new_image']= './image/dokumen/'.$data_upload['file_name'];
     $this->load->library('image_lib', $config);
     $this->image_lib->resize();
     $UpdateStatus['kk'] = $data_upload['file_name'];
    }

    $Insert  = $this->Pengguna_models->UploadFoto($id,$UpdateStatus);
    $respone = [
     'status' => 'success',
     'message'=> 'Berhasil Mengupdate Foto.!'
    ];
   }else{
    $respone = [
     'status' => 'error',
     'message'=> 'Gagal Upload File...!'
    ];
   }
  }else{
   $respone = [
    'status' => 'error',
    'message'=> 'Data Anda Tidak Ada.!'
   ];
  }

  echo json_encode($respone);
 }
}