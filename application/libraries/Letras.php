<?php
/**
	Clase ajustada del codigo publicado en http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
**/
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Letras{
	
	public function convert_number_to_words($number) {
	   
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'cero',
			1                   => 'uno',
			2                   => 'dos',
			3                   => 'tres',
			4                   => 'cuatro',
			5                   => 'cinco',
			6                   => 'seis',
			7                   => 'siete',
			8                   => 'ocho',
			9                   => 'nueve',
			10                  => 'diez',
			11                  => 'once',
			12                  => 'doce',
			13                  => 'trece',
			14                  => 'catorce',
			15                  => 'quince',
			16                  => 'diecisies',
			17                  => 'dicisiete',
			18                  => 'diesiocho',
			19                  => 'diecinueve',
			20                  => 'veinte',
			30                  => 'treinta',
			40                  => 'cuarenta',
			50                  => 'cincuenta',
			60                  => 'sesenta',
			70                  => 'setenta',
			80                  => 'ochenta',
			90                  => 'noventa',
			100                 => 'cien',
			500					=> 'quinientos',
			1000                => 'mil',
			1000000             => 'millon',
			1000000000          => 'billon',
			1000000000000       => 'trillon',
			1000000000000000    => 'cuadrillon',
			1000000000000000000 => 'quintillon'
		);
	   
		if (!is_numeric($number)) {
			return false;
		}
	   
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}
	   
		$string = $fraction = null;
	   
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	   
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= "'" . convert_number_to_words($remainder);
				}
				break;
		}
	   
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		$string = str_replace("dos cien","docientos ", $string);
		$string = str_replace("tres cien","trecientos ", $string);
		$string = str_replace("cuatro cien","cuantrocientos ", $string);
		$string = str_replace("cinco cien","quinientos ", $string);
		$string = str_replace("seis cien","seiscientos ", $string);
		$string = str_replace("siete cien","setecientos ", $string);
		$string = str_replace("ocho cien","ochocientos ", $string);
		$string = str_replace("nueve cien","novecientos ", $string);
		$string = str_replace("cinco cien","quinientos ", $string);
		
		return $string;
	}
	//para llamarla convert_number_to_words(123456789);
}
/* End of file Letras.php */
?>