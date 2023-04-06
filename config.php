<?php

/**
 * merubah format nomor menjadi format uang Rupiah
 * 
 * @param integer $value
 * @return string
 */
function rupiah($value){
	$converted = "Rp " . number_format($value,0,',','.');
	return $converted;
}