<?php

function tampil($str)
{
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}
function simpan($str)
{
	echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function format_phone_us($phone) {
	if(!isset($phone{3})) { return ''; }
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	switch($length) {
		case 7:
		return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
		break;
		case 10:
		return preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})/", "$1 $2-$3", $phone);
		break;
		case 11:
		return preg_replace("/([0-9]{0})([0-9]{3})([0-9]{4})([0-9]{4})/", "$1 $2 $3-$4", $phone);
		break;
		default:
		return $phone;
		break;
	}
}

function Rupiah($rupiah)
{
	$nilai = "Rp " . number_format($rupiah,2,',','.');
	return $nilai;

}