<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DokumenKemitraan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Bus_models','Pengguna_models','Penerbangan_models']);
		$this->load->library('template');
		False();
	}

	public function penerbangan()
	{
		$Level 					= $this->session->userdata('id_level');
		if ([$Level == '1' || $Level == '4']) {

			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];
			$this->template->layout('DokumenKemitraan/penerbangan.php',$data);
		}else{
			redirect('Error/AksesData');
		}
	}
	public function bus()
	{
		$Level 					= $this->session->userdata('id_level');
		if ([$Level == '1' || $Level == '4']) {
			$data['Perusahaan']     = $this->Perusahaan_models->Tentang();
			$id 					= $this->session->userdata('id_akses');
			$DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
			$DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
			$data['nama']           = $DataNSiswa['nama_lengkap'];
			$data['id']             = $DataNya['id_akses'];
			$data['Level']             = $DataNya['id_level'];

		// $data['nama']           = $DataNya['username'];
			$this->template->layout('DokumenKemitraan/bus.php',$data);
		}else{
			redirect('Error/AksesData');
		}
	}

	public function DataBus()
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
			0=>'id',
			1=>'nama_bus',
			2=>'file_kemitraan',
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
		$Menus = $this->Bus_models->Data();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$IdData = $rows->id;
			$data[]= array(
				$no++,
				$rows->id.'-'.$rows->nama_bus,
				'<a target="_blank" href='.base_url().'image/kemitraan/'.$rows->file_kemitraan.'.'.'>'.$rows->file_kemitraan.'</a>',
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
		$query = $this->db->select("COUNT(*) as num")->get("db_transportasi_darat");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

	public function Datapenerbangan()
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
			0=>'id',
			1=>'kode_penerbangan',
			2=>'file_kemitraan',
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
		$Menus = $this->Penerbangan_models->DokumenTravel();
		$data = array();
		$no = 1;
		$num_char = 10;
		foreach($Menus->result() as $rows)
		{
			$IdData = $rows->id;
			$data[]= array(
				$no++,
				$rows->id.'-'.$rows->kode_penerbangan.'-'.$rows->nama_maskapai,
				'<a target="_blank" href='.base_url().'image/kemitraan/'.$rows->file_kemitraan.'.'.'>'.$rows->file_kemitraan.'</a>',
			);    
		}

		$TotalNya = $this->TotalNyaData();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $TotalNya,
			"recordsFiltered" => $TotalNya,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}


	public function TotalNyaData()
	{
		$query = $this->db->select("COUNT(*) as num")->get("db_penerbangan");
		$result = $query->row();
		if(isset($result)) return $result->num;
		return 0;
	}

}