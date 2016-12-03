<?php
if(file_exists(dirname(__FILE__).'/route_default')):
  $regie = file_get_contents(dirname(__FILE__).'/route_default');
  require_once dirname(__FILE__).'/game_'.trim($regie).'.php';
else :
  require_once 'game_modele.php';
endif;
