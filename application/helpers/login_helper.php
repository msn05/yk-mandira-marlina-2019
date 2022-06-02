<?php

function True(){
	$ci 			= & get_instance();
	$user_session 	= $ci->session->userdata('id_akses');
	if($user_session){
		redirect('index.php/home');
	}

}

function False(){
	$ci 			=& get_instance();
	$user_session 	= $ci->session->userdata('id_akses');
	if(!$user_session){
		redirect('index.php/login');
	}	

}