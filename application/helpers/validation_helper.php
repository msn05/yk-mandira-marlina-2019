<?php
function _check_length($input, $min, $max)
{
	$length = strlen($input);

	if ($length <= $max && $length >= $min)
	{
		return TRUE;
	}
	elseif ($length < $min)
	{
		$this->form_validation->set_message('_check_length', 'Minimum number of characters is ' . $min);
		return FALSE;        
	}
	elseif ($length > $max)
	{
		$this->form_validation->set_message('_check_length', 'Maximum number of characters is ' . $max);
		return FALSE;        
	}
}

function validate_alpha($text)
{
	return preg_match("/^[A-Za-z0-9_- ]+$/", $text);
}


function validate_number($text)
{
	return preg_match("/^[0-9]+$/", $text);
}

function validate_HurufSaja($text)
{
	return preg_match("/^[a-zA-Z ]+$/", $text);
}

function maxLenght16($text)
{
	return preg_match("/^(\d{16})$/", $text);
}

function maxLenght10Sampe14($text)
{
	return preg_match("/^(\d{10,14})$/", $text);
}

function Emails($email)
{
	$v = "/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/";
	return preg_match($v, $email);
}