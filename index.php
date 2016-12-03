<?php
if(file_exists(dirname(__FILE__).'/route_default')):
  $regie = file_get_contents(dirname(__FILE__).'/route_default');
  require dirname(__FILE__).'/index_'.trim($regie).'.php';
else :
  require dirname(__FILE__).'/index_modele.php';
endif;
