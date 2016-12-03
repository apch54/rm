<?php

  require_once dirname(__FILE__)."/../autopromos/autopromos.php";

  if(!isset($gameOptions['slideFullscreen'])) :
    $gameOptions['slideFullscreen'] = false;
  endif;



  if(!isset($gameOptions['level_ads'])) :
    $gameOptions['level_ads'] = false;
  endif;

  //Force Fullscreen False if Desktop display
  if(!isMobile()) :
    $gameOptions['fullscreen'] = false;
    $gameOptions['slideFullscreen'] = false;
  else:
    if($_GET['fullscreen']) :
      $gameOptions['fullscreen'] = true;
      $gameOptions['slideFullscreen'] = false;
    endif;
  endif;

  if(file_exists(dirname(__FILE__).'/../category')):
    $category = trim(file_get_contents(dirname(__FILE__).'/../category'));
    switch($category) {
      case 'DP':
        $google_ad_client_id = "0000000000000000";
      break;
      case 'W':
        $google_ad_client_id = "0000000000000000";
      break;
      case 'DV':
        $google_ad_client_id = "0000000000000000";
      break;
      case 'M':
        $google_ad_client_id = "0000000000000000";
      break;
    }
  endif;

  if(!isset($gameOptions['autopromos_game_nb'])) :
    $gameOptions['autopromos_game_nb'] = 5;
  endif;

  if(!isset($gameOptions['autopromos_game_perimetre'])) :
    $gameOptions['autopromos_game_perimetre'] = 'global';
  endif;

  if(!isset($gameOptions['autopromos_game_campagne'])) :
    $gameOptions['autopromos_game_campagne'] = 'premium';
  endif;

  if(!isset($gameOptions['autopromos_game_interval'])) :
    $gameOptions['autopromos_game_interval'] = true;
  endif;

  //Get regie and campagne name by table name
  if(isset($gameOptions['table'])) :
    $infos = explode('_', $gameOptions['table']);
    $famille = $infos[0];
    $gamename = $infos[1];
    $regie = $infos[2];
    $campagne = $infos[3];

    if(file_exists(dirname(__FILE__).'/../afg_'.$regie.'_'.$campagne) and isset($gameOptions['pub_ads_game']) and $gameOptions['pub_ads_game'] == true) :
      error_log('AFG : Enabled');

      $gameOptions['pub_ads_game'] = true;
    else :
      if(isset($gameOptions['pub_ads_game']) and $gameOptions['pub_ads_game'] == true) :

        if(isset($gameOptions['table'])) :
          require dirname(__FILE__).'/../dbConfig.php';

          //CONNEXION BDD MYSQLI
          $timeout = 5;
          $mysqli= mysqli_init( );
          $mysqli->options( MYSQLI_OPT_CONNECT_TIMEOUT, $timeout ) ;
          $mysqli->real_connect($dbConfigArray['host'], $dbConfigArray['dbUserName'], $dbConfigArray['dbUserPassword'], $dbConfigArray['dbName']) ;

          $result = $mysqli->query("SELECT count(id) AS COUNT FROM `".$gameOptions['table']."`");
          if($result) :

            $count = $result->fetch_assoc();
            $count = intval($count['COUNT']);

            if($count >= 5) :
              file_put_contents(dirname(__FILE__).'/../afg_'.$regie.'_'.$campagne, '');
              chmod(dirname(__FILE__).'/../afg_'.$regie.'_'.$campagne, 0770);
              $gameOptions['pub_ads_game'] = true;
            else:
              $gameOptions['pub_ads_game'] = false;
            endif;
          endif;
        else:
          $gameOptions['pub_ads_game'] = false;
        endif;

      else:
        $gameOptions['pub_ads_game'] = false;
      endif;
    endif;
  else :
    $gameOptions['pub_ads_game'] = false;
    error_log("AFG Disabled : No table in config");
  endif;
?>



<!doctype html>
<html class="no-js" lang="en">
  <head>
    <?php include dirname(__FILE__).'/../tarteaucitron/top_UE.php'; ?>
    <meta charset="utf-8" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
      $title = $_SERVER['SERVER_NAME'];
      $title = str_replace('-', ' ', $title);
      $title = str_replace('.com', '', $title);
      $title = ucwords($title);
    ?>

    <title><?php echo $title ?></title>

    <?php if( isset($gameOptions['pub_ads_game']) and $gameOptions['pub_ads_game'] ) : ?>
    <script type="text/javascript" src="//imasdk.googleapis.com/js/sdkloader/outstream.js"></script>
    <?php endif; ?>

    <link rel="stylesheet" href="assets/libs/foundation/css/foundation.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <?php if(is_file(dirname(__FILE__).'/../products/'.PRODUCT.'/socle/css/app.css')) : ?>
      <link rel="stylesheet" type="text/css" href="products/<?php print PRODUCT ?>/socle/css/app.css">
    <?php endif; ?>
    <link rel="stylesheet" href="assets/libs/font-awesome/css/font-awesome.min.css">
    <?php if(defined("TARTEAUCITRON")) : ?>
      <link rel="stylesheet" type="text/css" href="tarteaucitron/css_tartecitron/<?php print TARTEAUCITRON; ?>/tarteaucitron/css/tarteaucitron.css">
    <?php else : ?>
      <link rel="stylesheet" type="text/css" href="tarteaucitron/css_tartecitron/gris/tarteaucitron/css/tarteaucitron.css">
    <?php endif; ?>

    <?php if( isset($gameOptions['slideFullscreen']) and $gameOptions['slideFullscreen'] ) : ?>
      <link rel="stylesheet" type="text/css" href="assets/css/sliderFullscreen.css">
    <?php endif; ?>


    <script type="text/javascript" src="assets/libs/foundation/js/vendor/jquery.js"></script>
    <script src="assets/js/backgroundHack.js"></script>

    <?php if(isset($google_ad_client_id)) : ?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-<?php print $google_ad_client_id; ?>",
        enable_page_level_ads: <?php print ($gameOptions['level_ads'] == true ? 'true' : 'false'); ?>
      });
    </script>
    <?php endif; ?>

        <style type="text/css">
            <?php $colors = json_decode(file_get_contents(dirname(__FILE__)."/../products/".PRODUCT."/design/colors.json")); ?>
            <?php include(dirname(__FILE__)."/../assets/css/dynamicCss.php"); ?>
        </style>
  </head>
  <body>
    <script type="text/javascript">
      var gameOptions = <?php print json_encode($gameOptions); ?>;
    </script>

    <div id="intersticiel"></div>

    <script type="text/javascript">
      function insertParam(key, value)
      {
          key = encodeURI(key); value = encodeURI(value);

          var kvp = document.location.search.substr(1).split('&');

          var i=kvp.length; var x; while(i--)
          {
              x = kvp[i].split('=');

              if (x[0]==key)
              {
                  x[1] = value;
                  kvp[i] = x.join('=');
                  break;
              }
          }

          if(i<0) {kvp[kvp.length] = [key,value].join('=');}

          //this will reload the page, it's likely better to store this until finished
          document.location.search = kvp.join('&');
      }
    </script>

    <?php if( isset($gameOptions['pub_ads_game']) and $gameOptions['pub_ads_game'] ) : ?>
    <script type="text/javascript">
      var adsController;
      var afgFor = 'game';

      function onAdLoaded() {
        replayGame();

        var current = $(window).scrollTop();
        $(window).scroll(function() {
            $(window).scrollTop(current);
        });

          document.getElementById('outstreamContainer').style.display = 'block';
        adsController.showAd();


      }

      function onDone() {
        if(afgFor == 'game') {
          // TODO: Be sure to handle ad completion events.
          document.getElementById('outstreamContainer').style.display = 'none';
          pauseGame();

          jQuery(window).off('scroll');
        }

        if(afgFor == 'fullscreen') {
          insertParam('fullscreen', true);

          afgFor = 'game';
        }

      }

      /**
       * Initialize the Outstream SDK.
       */
      window.onload = function () {
          var outstreamContainer = document.getElementById('outstreamContainer');
          if (!outstreamContainer) {
              outstreamContainer = document.createElement('DIV');
              outstreamContainer.id = 'outstreamContainer';
          }
          adsController = new google.outstream.AdsController(
                  outstreamContainer,
                  onAdLoaded,
                  onDone);
          // document.getElementById('requestAndShow').disabled = false;
      };

      function afg() {
        onClickBackgroundHack();

        //alert('AFG Launch');

        adsController.initialize();
        // Request ads

              var adTagUrl = 'http://googleads.g.doubleclick.net/pagead/ads?ad_type=video_text_image&client=ca-games-pub-<?php print $google_ad_client_id; ?>&description_url=http%3A%2F%2F<?php print $_SERVER['SERVER_NAME']; ?>&videoad_start_delay=0&max_ad_duration=30000';


        adsController.requestAds(adTagUrl);
      }

    </script>

    <style type="text/css">

      #outstreamContainer {
        width: 728px;
        height:475px;
      }

    @media screen and (max-width: 1024px) {

      #outstreamContainer {
        width: 100%;
        height:100%;
      }

    }
    </style>
    <?php endif; ?>

    <div id="page">

      <?php
        require_once dirname(__FILE__).'/../lib/checkBanners.php';
        checkBanners();
      ?>


      <div class="show-for-medium-up">
        <div class="medium-12 row">
          <div class="medium-12 columns">
            <div style='text-align:center;'>
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/desktop_game/logo.png" />
            </div>
          </div>
        </div>
        <div class="medium-12 row">
          <div class="medium-12 columns">
            <div class="text-block">
              <h1 class="title">Play <?php echo $title ?></h1>
              <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_tablet_haut.txt')) ?>
            </div>
          </div>
        </div>

      </div>


      <div class="show-for-small-only rowTextHaut">
        <?php if(isset($gameOptions['fullscreen']) and $gameOptions['fullscreen'] and isMobile()) : ?>
        <?php else : ?>
        <div class="small-12 row">
          <div class="medium-12 columns">
            <div class="text-block">
                <?php if( isset($gameOptions['slideFullscreen']) and $gameOptions['slideFullscreen'] ) : ?>
                <?php else : ?>
                  <h1 class="title">Play <?php echo $title ?></h1>
                <?php endif ?>

                <?php if( isset($gameOptions['slideFullscreen']) and $gameOptions['slideFullscreen'] ) : ?>
                  <?php echo substr(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_mobile_haut.txt'), 0, 270).'...'; ?>
                <?php else : ?>
                  <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_mobile_haut.txt')) ?>
                <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if( isset($gameOptions['pub_ads_content_game']) and $gameOptions['pub_ads_content_game'] ) : ?>
        <!--<div class="row">
          <div class="ads320_100">
            <div class="ads">Ads</div>-->
            <!-- 320x100 -->
            <?php //require dirname(__FILE__)."/../ads/game_mobile_haut.php"; ?>
          <!--</div>
        </div>-->
        <?php endif; ?>
      </div>

      <?php if( isset($gameOptions['pub_ads_game']) and $gameOptions['pub_ads_game'] ) : ?>
      <div id="outstreamContainer" style="z-index:9999;display:none;position:absolute;"></div>
      <?php endif; ?>

      <div class="row" id='game-container'>
        <?php if(isset($gameOptions['fullscreen']) and $gameOptions['fullscreen'] == true): ?>
          <img src="products/<?php print PRODUCT ?>/design/mobile/mobile_states/mobile_loading/mobile_loading_hack.gif" onClick="onClickBackgroundHack()" class="backgroundGame" />
        <?php else : ?>
          <img src="products/<?php print PRODUCT ?>/design/desktop/desktop_states/desktop_loading/desktop_loading_hack.gif" onClick="onClickBackgroundHack()" class="backgroundGame" />
        <?php endif; ?>
      </div>

      <?php if( isset($gameOptions['slideFullscreen']) and $gameOptions['slideFullscreen'] == true and $gameOptions['fullscreen'] == false ) : ?>
        <div class="iphone-slider">
          <input type="range" value="10">
          <span style="opacity: 1;">Play Fullscreen</span>
        </div>
      <?php endif; ?>


      <?php if( isset($gameOptions['pub_ads_content_game']) and $gameOptions['pub_ads_content_game'] ) : ?>
      <div class="row show-for-small-only">
        <div class="ads320_100">

          <div class="ads"><br /><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
          <!-- 320x100 -->
          <?php require dirname(__FILE__)."/../ads/game_mobile_bas.php"; ?>
        </div>
      </div>

      <div class="row show-for-medium-up">
        <div class="ads728_90">
          <div class="ads"><br /><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
          <!-- 728x90 -->
          <?php require dirname(__FILE__)."/../ads/game_tablet_bas.php"; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if( isset($gameOptions['freegame_enabled']) and $gameOptions['freegame_enabled'] ) : ?>
        <div class="row">
          <div class="medium-6 columns show-for-medium-up">
            <a href="<?php echo FREE_GAME_LINK ?>">
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/freegame_btn.png" />
            </a>
          </div>
          <div class="small-12 medium-6 columns">
            <a href="<?php echo FREE_GAME_LINK ?>">
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/freegame_btn.png" />
            </a>
          </div>
        </div>
      <?php endif; ?>

      <?php
        if( isset($gameOptions['show_autopromos_game']) and $gameOptions['show_autopromos_game'] ) :
          if(isset($gameOptions['autopromos_game_perimetre']) and $gameOptions['autopromos_game_perimetre'] == 'famille') :
            print autopromos($gameOptions['autopromos_game_nb'], trim(file_get_contents(dirname(__FILE__).'/../category')), $gameOptions['autopromos_game_campagne'], $gameOptions['autopromos_game_interval']);
          elseif(isset($gameOptions['autopromos_game_perimetre']) and $gameOptions['autopromos_game_perimetre'] == 'global'):
            print autopromos($gameOptions['autopromos_game_nb'], 'global', $gameOptions['autopromos_game_campagne'], $gameOptions['autopromos_game_interval']);
          else :
            print '<span style="color:red">Le perimetre autopromo doit etre global/famille.</span>';
          endif;
        endif;
      ?>

    </div>

    <?php if(BOX2D == true) : ?>
      <script type="text/javascript" src="assets/libs/phaser/phaser-230-box2d.js"></script>
    <?php else : ?>
      <script type="text/javascript" src="assets/libs/phaser/phaser.min.js"></script>
    <?php endif; ?>

    <script type="text/javascript">
      var tutoTexts = {
        first: "<?php echo file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_tuto_1.txt') ?>",
        second: "<?php echo file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_tuto_2.txt') ?>",
        third: "<?php echo file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/game_tuto_3.txt') ?>"
      }
    </script>

    <script type="text/javascript" src="assets/libs/foundation/js/vendor/modernizr.js"></script>
    <script type="text/javascript" src="assets/libs/foundation/js/foundation.min.js"></script>
    <script type="text/javascript" src="assets/libs/pGame/pGame.js"></script>
    <script type="text/javascript" src="assets/libs/phacker/build/phacker.js"></script>
    <?php if( isset($gameOptions['slideFullscreen']) and $gameOptions['slideFullscreen'] ) : ?>
    <script src="assets/js/slideToUnlock.js"></script>
    <?php endif; ?>
    <script>
      $(document).foundation();
      var root_game = "<?php print ROOT_GAME; ?>";
      var root_design = "<?php print ROOT_DESIGN; ?>";
    </script>
    <script type="text/javascript" src="<?php print ROOT_GAME ?>build/game.js"></script>

    <script type="text/javascript">

      var game = {
        state: {
          start: function() {
            jQuery.ajax({
              url: 'hack.php',
              data: {
                link: document.location.href
              }
            });

            if(typeof afg == 'function') {
              afg();
            }
          }
        }
      }
    </script>
    <?php include dirname(__FILE__).'/../tarteaucitron/bottom_UE.php'; ?>
  </body>
</html>
