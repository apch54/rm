<?php
  require_once 'lib/checkRequirement.php';
  require_once 'geoloc.php';
  require_once 'config.php';
  require_once 'products/'.PRODUCT.'/config_socle.php';

  $file = $_SERVER["SCRIPT_NAME"];
  $break = explode('/', $file);
  $pfile = $break[count($break) - 1];
  $pfile = explode('_', $pfile);
  if ( isset($pfile[1]) ):
    $pfile = $pfile[1];
  else:
    $pfile = "";
  endif;

  if($pfile == '') :
    $gamepage = 'game.php';
  else :
    $pfile = explode('.', $pfile);
    $pfile = $pfile[0];
    $gamepage = 'game_'.$pfile.'.php';
  endif;

  if(isset($gameurl)) :
    define('GAME_URL', $gameurl);
  else:
    if( isset($_GET['subid']) ) :
      $gamepage .= "?subid=".addslashes($_GET['subid'])."&";
    else:
      $gamepage .= "?";
    endif;
      
    if ( isset($_GET['forceCampagne']) ) :
      $gamepage .= 'forceCampagne='.$_GET['forceCampagne'];
    endif;
    define('GAME_URL', $gamepage);
  endif;

  require_once 'lib/checkRequirementConfig.php';
  require_once 'templates/index.php';
