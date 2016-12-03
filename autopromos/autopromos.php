<?php

require_once dirname(__FILE__)."/autopromo.php";

function autopromos($nb = 5, $famille = 'global', $campagne = 'www', $interval=false) {
  $out = "";
	$out .= autopromo("JEU TEST 1", "banners/icone.png", file_get_contents(dirname(__FILE__)."/../products/".PRODUCT."/socle/autopromo.txt"), "http://www.google.fr");

  $out .= autopromo("JEU TEST 2", "banners/icone.png", file_get_contents(dirname(__FILE__)."/../products/".PRODUCT."/socle/autopromo.txt"), "http://www.google.fr");

	return $out;
}