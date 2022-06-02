<?php

function conHari($hari){ 
	switch($hari){
		case 'Sun':
		$getHari = "Minggu";
		break;
		case 'Mon': 
		$getHari = "Senin";
		break;
		case 'Tue':
		$getHari = "Selasa";
		break;
		case 'Wed':
		$getHari = "Rabu";
		break;
		case 'Thu':
		$getHari = "Kamis";
		break;
		case 'Fri':
		$getHari = "Jumat";
		break;
		case 'Sat':
		$getHari = "Sabtu";
		break;
		default:
		$getHari = "Salah"; 
		break;
	}
	
	return $getHari;
}