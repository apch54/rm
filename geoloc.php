<?php
// *************************************************************
// *************************************************************
// GESTION DES LANGUES
// *************************************************************
// *************************************************************

if (file_exists(dirname(__FILE__).'/dbConfig.php')) {

    $_ip_nav=$_SERVER['HTTP_X_FORWARDED_FOR'];

    require(dirname(__FILE__).'/ip2country/phpip2country.class2.php');
    require(dirname(__FILE__).'/dbConfig.php');


    $phpIp2Country = new phpIp2Country($_ip_nav,$dbConfigArray);
    $langue=$phpIp2Country->getInfo(IP_COUNTRY_ISO);

    if($_GET['lang']) :
      echo '<b>CONF STANDARD IP country  2 letters  :-> </b>'.$phpIp2Country->getInfo(IP_COUNTRY_ISO);
    endif;

    // pour la suite du code
    //   	$_pays= $phpIp2Country->getInfo(IP_COUNTRY_NAME);
    //   	$json=$langue;
    //$langue="US";


    if (isset($_GET['lang'])){
      $langue=$_GET['lang'];
    }

    $_regie="TJ";
    $autopromo=true;
    $autopromo_webisio=false;


    if(isset($_GET['subid'])){
      $_subid="?subid=".addslashes($_GET['subid']);
    }

}
