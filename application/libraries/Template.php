<?php
class Template{
	protected $_ci;
	function __construct(){
		$this->_ci = &get_instance();
	}
	function Layout($content, $data = NULL){
		$data['header'] = $this->_ci->load->view('template/header',$data, true);
		$data['content'] = $this->_ci->load->view($content, $data, TRUE);
		$data['footer'] = $this->_ci->load->view('template/footer',$data, true);
		$this->_ci->load->view('akses/dashboard', $data);
	}
	function Depan($content, $data = NULL){
		$data['header'] = $this->_ci->load->view('template/header_depan',$data, true);
		$data['content'] = $this->_ci->load->view($content, $data, TRUE);
		$data['footer'] = $this->_ci->load->view('template/footer_depan',$data, true);
		$this->_ci->load->view('akses/dashboard_depan', $data);
	}
}
