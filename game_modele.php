<?php
  require_once 'lib/checkRequirement.php';
  require_once 'geoloc.php';
  require_once 'config.php';
  require_once 'products/'.PRODUCT.'/config_socle.php';
  require_once 'lib/checkRequirementConfig.php';
  require_once 'lib/isMobile.php';

  define("ROOT_GAME", "products/".PRODUCT."/game/");
  define("ROOT_DESIGN", "products/".PRODUCT."/design/");

	require_once 'templates/game.php';