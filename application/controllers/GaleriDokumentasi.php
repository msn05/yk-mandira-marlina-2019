<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GaleriDokumentasi extends CI_Controller {

	private $limit = 4;

	function __construct(){
		parent::__construct();
		$this->load->model(['Perusahaan_models','Galeri_models','Pengguna_models']);

	}

    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('GaleriDokumentasi/index'); //site url
        $config['total_rows'] = $this->db->count_all('tb_dokumentasi'); //total row
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

        $data['galeri'] = $this->Galeri_models->Limit($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();

        $Level                  = $this->session->userdata('id_level');
        $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
        $id                     = $this->session->userdata('id_akses');
        $DataNya                = $this->Pengguna_models->DataUbah($id)->row_array();
        $data['id']             = $DataNya['id_akses'];
        $data['Level']             = $DataNya['id_level'];
        $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
        $data['nama']           = $DataNSiswa['nama_lengkap'];
        $this->load->view('website/temp/header.php',$data);
        $this->load->view('website/galeri/index.php',$data);
        $this->load->view('website/temp/footer.php',$data);     
    }


    public function Pariwisata()
    {
      $this->load->library('pagination');
		$config['base_url'] = site_url('GaleriDokumentasi/Pariwisata'); //site url
        $config['total_rows'] = $this->db->count_all('tb_dokumentasi'); //total row
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

        $data['galeri'] = $this->Galeri_models->Limit1($config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();

        $Level 					= $this->session->userdata('id_level');
        $data['Perusahaan']     = $this->Perusahaan_models->Tentang();
        $id 					= $this->session->userdata('id_akses');
        $DataNya             	= $this->Pengguna_models->DataUbah($id)->row_array();
        $data['id']             = $DataNya['id_akses'];
        $data['Level']             = $DataNya['id_level'];
        $DataNSiswa             = $this->Pengguna_models->DataLengkap($id)->row_array();
        $data['nama']           = $DataNSiswa['nama_lengkap'];
        $this->load->view('website/temp/header_pariwisata.php',$data);
        $this->load->view('website/galeri/index.php',$data);
        $this->load->view('website/temp/footer.php',$data);		
    }


}