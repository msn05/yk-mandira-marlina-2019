<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Menu_models','Pengguna_models']);
		$this->load->library('template');
		False();
	}

	public function index()
	{
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$id 					= $this->session->userdata('id_akses');
		$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
		$DataNyaID             	= $this->Pengguna_models->DataLengkap($id)->row_array();
		$data['id']             = $DataNya['id_akses'];
		$data['nama']           = $DataNyaID['nama_lengkap'];
		$this->template->layout('menu/index.php',$data);
	}
	public function form()
	{
		$data['headerMenu']		   = 'Form Data';
		$data['Perusahaan']        = $this->Perusahaan_models->Tentang();
		$data['Akses']             = $this->Menu_models->Akses()->result();
		$data['KategoriMenu']      = $this->Menu_models->KategoriMenu()->result();
		$this->template->layout('menu/form.php',$data);
	}
	public function edit($id)
	{
		$data['headerMenu']		= 'Form Ubah Data';
		$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
		$DataNya             	= $this->Menu_models->DataUbah($id)->row_array();
		$data['id_menu']		= $DataNya['id_menu'];
		$data['menuKategori']	= $DataNya['kategori_menu'];
		$data['nama_menu']		= $DataNya['nama_menu'];
		$data['url']			= $DataNya['url'];
		$data['id_akses']		= $DataNya['id_akses'];
		$data['Akses']          = $this->Menu_models->Akses()->result();
		$data['KategoriMenu']   = $this->Menu_models->KategoriMenu()->result();
		$this->template->layout('menu/edit.php',$data);
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
			0=>'id_menu',
			1=>'nama_kategori',
			2=>'nama_menu',
			3=>'nama_level',
			4=>'tanggal_dibuat',
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
		$Menus = $this->Menu_models->Data();
		$data = array();
		foreach($Menus->result() as $rows)
		{

			
			$data[]= array(
				$rows->id_menu,
				$rows->nama_menu,
				$rows->url,
				$rows->nama_kategori,
				$rows->nama_level,
				$rows->tanggal_dibuat,
				$rows->Status == '0' ? 'Aktif' : 'Tidak Aktif',
				$rows->Status == '0' ? '<a type="submit" class="remove fa fa-power-off" id="'.$rows->id_menu.'" nama="'.$rows->nama_menu.'" title="Non Aktifkan"></a> <a type="submit" href="menu/edit/'.$rows->id_menu.'" class="fa fa-edit" title="Edit Data" ></a>' : '
				<a type="submit" class="aktif fa fa-external-link" id="'.$rows->id_menu.'" nama="'.$rows->nama_menu.'" title="Aktifkan"></a>
				<a href="menu/edit/id="'.$rows->id_menu.'" type="button"  class="fa fa-edit" title="Edit Data" ></a>
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
	public function TotalNya()
	{
		$query = $this->db->select("COUNT(*) as num")->get("db_menu");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}


	function delete($id)
	{
		$Waktu 	= date('Y-m-d H:i:s');
		$Status = 1;

		$UpdateStatus =[
			'Status' => $Status,
			'tanggal_dibuat' => $Waktu,
		];

		$res = $this->Menu_models->update($id,$UpdateStatus);
		if($res != null){
			echo 'Update successfully.';
		}
	}

	function simpanPerubahan()
	{
		$id 		= htmlspecialchars($this->input->post('id_menu'));
		$menu		= htmlspecialchars($this->input->post('menu'));
		$urlNya 	= htmlspecialchars($this->input->post('urlNya'));
		$am 		= htmlspecialchars($this->input->post('am'));
		$ak 		= htmlspecialchars($this->input->post('ak'));
		$Waktu		= date('Y-m-d:H:i:s');

		$Cek 		= $this->Menu_models->DataUbah($id)->row_array();

		if ($Cek != NULL) {

			$UpdateStatus =[
				'nama_menu' 	=> $menu,
				'url'			=> $urlNya,
				'id_akses'		=> $am,
				'kategori_menu'	=> $ak,
				'tanggal_dibuat'=> $Waktu,
			];

			$res = $this->Menu_models->update($id,$UpdateStatus);
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Mengubah Data...!'
			];

		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal Mengubah Data...!'
			];
		}
		
		echo json_encode($respone);

	}

	function aktif($id)
	{
		$Waktu 	= date('Y-m-d H:i:s');
		$Status = 0;

		$UpdateStatus =[
			'Status' => $Status,
			'tanggal_dibuat' => $Waktu
		];

		$res = $this->Menu_models->update($id,$UpdateStatus);


	}
	function simpan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('menu','Menu', 'required|trim|is_unique[db_menu.nama_menu]',['required' => 'Wajib Diisi.','is_unique' => 'Menu nya sudah ada..!']);
		$this->form_validation->set_rules('urlNya','urlNya', 'required|trim|is_unique[db_menu.url]',['required' => 'Wajib Diisi.','is_unique' => 'Url Menu nya sudah digunakan..!']);
		$this->form_validation->set_rules('am','am', 'required|trim');
		$this->form_validation->set_rules('ak','ak', 'required|trim');

		if($this->form_validation->run() == false){
			$respone = [
				'status' => 'error',
				'message' => 'Terjadi Kesalahan',
			];

		}else{
			$menu	= $this->input->post('menu');
			$urlNya = $this->input->post('urlNya');
			$ak     = $this->input->post('ak');
			$am     = $this->input->post('am');
			$DataNya = [
				'url'			=> $urlNya,
				'nama_menu'		=> $menu,
				'Kategori_menu'	=> $ak,
				'id_akses'		=> $am,
				'Status'		=> 0,
				'tanggal_dibuat'=> date('Y-m-d:H:i:s'),
			];

			$insert = $this->db->insert('db_menu',$DataNya);
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil Menambahkan Data...!'
			];
		}
		echo json_encode($respone);
	}
}




