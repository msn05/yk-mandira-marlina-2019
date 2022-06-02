<?php

function alpha($str)
{
	return ( ! preg_match('/^([a-zA-Z ])+$/iu', $str)) ? FALSE : TRUE;
} 

function numeric($str)
{
	return ( ! preg_match('/^([0-9])+$/iu', $str)) ? FALSE : TRUE;
} 

function alpha_numeric($str)
{
	return ( ! preg_match('/^([a-z_ 0-9])+$/iu', $str)) ? FALSE : TRUE;
}