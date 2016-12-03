<?php

function autopromo($game, $icon, $text, $link) {
	$template = file_get_contents(dirname(__FILE__).'/autopromo.html');
	$template = str_replace('{{game}}', $game, $template);
	$template = str_replace('{{icon}}', $icon, $template);
	$template = str_replace('{{text}}', $text, $template);
	$template = str_replace('{{link}}', $link, $template);

	return $template;
}