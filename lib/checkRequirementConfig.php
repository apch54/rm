<?php

$errors = array();

if( !isset($gameOptions) or !is_array($gameOptions) ) :
	$errors[] = 'La variable gameOptions doit etre definie, et de type array.';
endif;

$gameOptionsFields = array('duration', 'pointEarned', 'pointLost', 'pointToLevel1', 'winningLevel', 'timingTemps', 'percentToNextLevel', 'life', 'winCallback', 'loseCallback', 'facebook', 'gold', 'freegame_enabled', 'rewardText');

foreach($gameOptionsFields as $ga) :
	if( !isset($gameOptions[$ga])) :
		$errors[] = 'La variable $gameOptions["'.$ga.'"] n\'est pas definie.';
	endif;
endforeach;

if( !defined("PRODUCT") ) :
	$errors[] = 'La constante PRODUCT doit etre definie';
endif;

if( !defined("BOX2D") ) :
	$errors[] = 'La constante BOX2D doit etre definie';
endif;

if( !defined("VERSION") ) :
	$errors[] = 'La constante VERSION doit etre definie';
endif;

if(!isset($GOBALS['menu'])) :
	$errors[] = 'La global menu doit etre definie';
endif;

if( !defined("GAME_EXPLANATION_TITLE_100") ) :
	$errors[] = 'La constante GAME_EXPLANATION_TITLE_100 doit etre definie';
endif;

if( !defined("GAME_EXPLANATION_100") ) :
	$errors[] = 'La constante GAME_EXPLANATION_100 doit etre definie';
endif;

if( !defined("TEXT_TITLE_100") ) :
	$errors[] = 'La constante TEXT_TITLE_100 doit etre definie';
endif;

if( !defined("TEXT_100") ) :
	$errors[] = 'La constante TEXT_100 doit etre definie';
endif;

if( !defined("FREE_GAME_LINK") ) :
	$errors[] = 'La constante FREE_GAME_LINK doit etre definie';
endif;

if( !defined("FREE_GAME") ) :
	$errors[] = 'La constante FREE_GAME doit etre definie';
endif;

if( !defined("PLAY_WIN_SHARE") ) :
	$errors[] = 'La constante PLAY_WIN_SHARE doit etre definie';
endif;

if( !defined("USE_FACEBOOK") ) :
	$errors[] = 'La constante USE_FACEBOOK doit etre definie';
endif;

if( !defined("FACEBOOK_APP_ID") ) :
	$errors[] = 'La constante FACEBOOK_APP_ID doit etre definie';
endif;

if( !defined("GAME_EXPLANATION_TITLE_200") ) :
	$errors[] = 'La constante GAME_EXPLANATION_TITLE_200 doit etre definie';
endif;

if( !defined("GAME_EXPLANATION_200") ) :
	$errors[] = 'La constante GAME_EXPLANATION_200 doit etre definie';
endif;

if( !defined("GAME_EXPLANATION_200") ) :
	$errors[] = 'La constante GAME_EXPLANATION_200 doit etre definie';
endif;


if(count($errors) > 0) :
	print '<ul>';
	foreach ($errors as $error) {
		print '<li>' . $error . '</li>';
	}
	print '</ul>';
	die;
endif;
