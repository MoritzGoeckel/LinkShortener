<?php

function encrypt($txt)
{
	$zahl  = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
	$char =  array('h', 'l', 'q', 'p', 'e', 'b', 'd', 'y', 'u', 'z');
	return str_replace($zahl, $char, $txt);
}

function decrypt($txt)
{
	$zahl  = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
	$char =  array('h', 'l', 'q', 'p', 'e', 'b', 'd', 'y', 'u', 'z');
	return str_replace($char, $zahl, $txt);
}

function showUrl($txt, $maxlen)
{
	if(substr($txt, -1, 1) == "/")
		$txt = substr($txt, 0, -1);

	$http  = array('http://', 'https://');
	$not =  array('', '');
	$str = str_replace($http, $not, $txt);
	if(strlen($str) > 33)
		$str = substr($str, 0, 33 - 3) . "...";
		
	return $str;
}
?>