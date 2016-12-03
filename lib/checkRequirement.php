<?php

$errors = array();

if(!file_exists('config.php')) {
	$errors[] = 'Le fichier config.php est oligatoire';
}

//Todo Clean
if(!file_exists('ads/home_mobile_pave1.php')) {
	$errors[] = 'Le fichier ads/home_mobile_pave1php est oligatoire';
}

if(!file_exists('ads/home_mobile_pave2.php')) {
	$errors[] = 'Le fichier ads/home_mobile_pave2.php est oligatoire';
}

if(!file_exists('ads/home_mobile_pave3.php')) {
	$errors[] = 'Le fichier ads/home_mobile_pave3.php est oligatoire';
}

if(!file_exists('ads/game_mobile_haut.php')) {
	$errors[] = 'Le fichier ads/game_mobile_haut.php est oligatoire';
}

if(!file_exists('ads/game_mobile_bas.php')) {
	$errors[] = 'Le fichier ads/game_mobile_bas.php est oligatoire';
}

if(!file_exists('ads/home_tablet_haut.php')) {
	$errors[] = 'Le fichier ads/home_tablet_haut.php est oligatoire';
}

if(!file_exists('ads/home_tablet_bas.php')) {
	$errors[] = 'Le fichier ads/home_tablet_bas.php est oligatoire';
}

if(!file_exists('ads/game_tablet_haut.php')) {
	$errors[] = 'Le fichier ads/game_tablet_haut.php est oligatoire';
}

if(!file_exists('ads/game_tablet_bas.php')) {
	$errors[] = 'Le fichier ads/game_tablet_bas.php est oligatoire';
}


if(count($errors) > 0) :
	print '<ul>';
	foreach ($errors as $error) {
		print '<li>' . $error . '</li>';
	}
	print '</ul>';
	die;
endif;
