<?php

  if(isset($gameOptions['redirect_game']) and $gameOptions['redirect_game']) :
    if(basename($_SERVER["SCRIPT_FILENAME"]) == 'index.php'):
      if(file_exists(dirname(__FILE__).'/../route_default')):
        $regie = file_get_contents(dirname(__FILE__).'/../route_default');
        require dirname(__FILE__).'/../game_'.trim($regie).'.php';
      else :
        require dirname(__FILE__).'/../game_modele.php';
      endif;
    else:
      $file = explode('_', basename($_SERVER["SCRIPT_FILENAME"]));
      $fileExt = $file[1];
      require dirname(__FILE__).'/../game_'.$fileExt;
    endif;

  else :

    require_once dirname(__FILE__)."/../autopromos/autopromos.php";

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

    if(!isset($gameOptions['level_ads'])) :
      $gameOptions['level_ads'] = false;
    endif;

    if(!isset($gameOptions['autopromos_home_nb'])) :
      $gameOptions['autopromos_home_nb'] = 5;
    endif;

    if(!isset($gameOptions['autopromos_home_perimetre'])) :
      $gameOptions['autopromos_home_perimetre'] = 'global';
    endif;

    if(!isset($gameOptions['autopromos_home_campagne'])) :
      $gameOptions['autopromos_home_campagne'] = 'premium';
    endif;

    if(!isset($gameOptions['autopromos_home_interval'])) :
      $gameOptions['autopromos_home_interval'] = true;
    endif;
?>



  <!doctype html>
  <html class="no-js" lang="en">
    <head>
      <?php require dirname(__FILE__).'/../tarteaucitron/top_UE.php'; ?>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <?php
        $title = $_SERVER['SERVER_NAME'];
        $title = str_replace('-', ' ', $title);
        $title = str_replace('.com', '', $title);
        $title = ucwords($title);
      ?>

      <title><?php echo $title ?></title>

      <link rel="stylesheet" type="text/css" href="assets/libs/foundation/css/foundation.css" />
      <link rel="stylesheet" type="text/css" href="assets/css/app.css">
      <?php if(is_file(dirname(__FILE__).'/../products/'.PRODUCT.'/socle/css/app.css')) : ?>
        <link rel="stylesheet" type="text/css" href="products/<?php print PRODUCT ?>/socle/css/app.css">
      <?php endif; ?>
      <link rel="stylesheet" type="text/css" href="assets/libs/font-awesome/css/font-awesome.min.css">
      <?php if(defined("TARTEAUCITRON")) : ?>
        <link rel="stylesheet" type="text/css" href="tarteaucitron/css_tartecitron/<?php print TARTEAUCITRON; ?>/tarteaucitron/css/tarteaucitron.css">
      <?php else : ?>
        <link rel="stylesheet" type="text/css" href="tarteaucitron/css_tartecitron/gris/tarteaucitron/css/tarteaucitron.css">
      <?php endif; ?>

        <style type="text/css">
            <?php $colors = json_decode(file_get_contents(dirname(__FILE__)."/../products/".PRODUCT."/design/colors.json")); ?>
            <?php include(dirname(__FILE__)."/../assets/css/dynamicCss.php"); ?>
        </style>


      <?php if(isset($google_ad_client_id)) : ?>
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-<?php print $google_ad_client_id; ?>",
          enable_page_level_ads: <?php print ($gameOptions['level_ads'] == true ? 'true' : 'false'); ?>
        });
      </script>
      <?php endif; ?>

    </head>
    <body>
      <div id="intersticiel"></div>
      <div id="page">

        <?php
          require_once dirname(__FILE__).'/../lib/checkBanners.php';
          checkBanners();
        ?>

        <div class="row menu show-for-medium-up top-buttons">
          <?php foreach ($GOBALS['menu'] as $item): ?>
          <div class="medium-3 columns">
            <a href="<?php echo $item['url'] ?>" target="__blank" class="button expand item-menu">
              <?php echo $item['text'] ?>
            </a>
          </div>
          <?php endforeach ?>
        </div>


        <div class="row logoRow">
          <div class="small-12 columns">
            <div id="logo">
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/desktop_index/logo.png" class="show-for-medium-up" />
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/mobile_index/logo.png" class="show-for-small-only" />
            </div>
          </div>
        </div>


        <div class="row show-for-small-only textHautRow">
          <div class="columns">
            <div class="text-block">
                <h1 class="title">Play <?php echo $title ?></h1>
                <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/home_mobile_haut.txt')) ?> <a href="terms-and-conditions.php" target="__blank">Terms and conditions</a>
            </div>
          </div>
        </div>

        <?php if( isset($gameOptions['pub_ads_content_home']) and $gameOptions['pub_ads_content_home'] ) : ?>
        <div class="row show-for-small-only">
          <!-- 300x250 -->
          <div class="ads300_250">
            <div class="ads"><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
            <?php require dirname(__FILE__)."/../ads/home_mobile_pave1.php"; ?>
          </div>
        </div>
        <?php endif; ?>

        <div class="row text-center show-for-small-only txtLogoRow">
            <div id="logotxt">
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/mobile_index/txt_logo.png" />
            </div>
        </div>

        <div class="playWinShareAndTextBasRow">
           <div class="row show-for-small-only">
              <div class="columns">
              <div class = "text-block">
                <h1 class="title">HOW TO PLAY</h1>
                <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/home_mobile_bas.txt')) ?> <a href="terms-and-conditions.php" target="__blank">Terms and conditions</a>
                </div>
              </div>
            </div>

          <!-- Play win share for mobile -->
          <div class ="row show-for-small-only">
            <div id="playwinshare">
                <img src="products/<?php print PRODUCT ?>/design/mockup_devices/mobile_index/play_win_share.png" />
            </div>
          </div>
        </div>


          <div class="row show-for-medium-up">
            <div class="columns">
            <div class = "text-block">
              <h1 class="title">Play <?php echo $title ?></h1>
              <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/home_tablet_haut.txt')) ?> <a href="terms-and-conditions.php" target="__blank">Terms and conditions</a>
              </div>
            </div>
          </div>


        <?php if( isset($gameOptions['freegame_enabled']) and $gameOptions['freegame_enabled'] ): ?>
          <div class="row show-for-medium-up">
            <div class="medium-6 columns">
              <a href="<?php echo FREE_GAME_LINK ?>">
                  <img src="products/<?php print PRODUCT ?>/design/mockup_devices/freegame_btn.png" />
              </a>
            </div>
            <div class="medium-6 columns">

              <a href="<?php echo FREE_GAME_LINK ?>">
                  <img src="products/<?php print PRODUCT ?>/design/mockup_devices/freegame_btn.png" />
              </a>
            </div>
          </div>
        <?php endif; ?>

        <?php if( isset($gameOptions['pub_ads_content_home']) and $gameOptions['pub_ads_content_home'] ) : ?>
        <div class="row show-for-small-only">
          <div class="ads300_250">
            <div class="ads"><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?>
            </div>
            <!-- 300x250 -->
            <div id="banner-pilon">
              <?php require dirname(__FILE__)."/../ads/home_mobile_pave2.php"; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div class="row" style="text-align: center;">
          <div class="columns">
            <a href="<?php echo GAME_URL ?>">
              <div class="playnow_btn"></div>
            </a>
          </div>
        </div>


        <?php if( isset($gameOptions['pub_ads_content_home']) and $gameOptions['pub_ads_content_home'] ) : ?>
        <div class="row show-for-medium-up">
          <div class="ads728_90">
            <div class="ads"><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
            <?php require dirname(__FILE__)."/../ads/home_tablet_haut.php" ?>
          </div>
        </div>
        <?php endif; ?>





        <?php if( isset($gameOptions['freegame_enabled']) and $gameOptions['freegame_enabled'] ) : ?>
          <div class="row show-for-small-only">
            <div class="small-12 columns">
              <a href="<?php echo FREE_GAME_LINK ?>">
                  <img src="products/<?php print PRODUCT ?>/design/mockup_devices/freegame_btn.png" />
              </a>
            </div>
          </div>
        <?php endif; ?>

        <div class="row show-for-medium-up">
          <div class="columns">
            <div class="text-block">
                <?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/home_tablet_bas.txt')) ?>
            </div>
          </div>
        </div>

        <!-- Play win share for desktop -->
        <div class="row show-for-medium-up">
          <div id="playwinshare">
              <img src="products/<?php print PRODUCT ?>/design/mockup_devices/desktop_index/play_win_share.png" />
          </div>
        </div>

        <?php if( isset($gameOptions['pub_ads_content_home']) and $gameOptions['pub_ads_content_home'] ) : ?>
        <div class="row show-for-medium-up">
          <div class="ads728_90">
            <div class="ads"><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
            <!-- 728x90 -->
            <?php require dirname(__FILE__)."/../ads/home_tablet_bas.php"; ?>
          </div>
        </div>
        <?php endif; ?>


        <div class="row">
          <div class="medium-6 small-6 columns text-left"><img src="products/<?php print PRODUCT ?>/design/mockup_devices/mobile_index/screenshot1.jpg" class="screenshot" /></div>
          <div class="medium-6 small-6 columns text-right"><img src="products/<?php print PRODUCT ?>/design/mockup_devices/mobile_index/screenshot2.jpg" class="screenshot" /></div>
        </div>




        <?php if ( isset($gameOptions['freegame_enabled']) and $gameOptions['freegame_enabled'] ): ?>
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
          if( isset($gameOptions['show_autopromos_home']) and $gameOptions['show_autopromos_home'] ) :
            if($gameOptions['autopromos_home_nb'] > 2) :
              $nbAutopromos = '0,2';
            endif;

            if(isset($gameOptions['autopromos_home_perimetre']) and $gameOptions['autopromos_home_perimetre'] == 'famille') :
              print autopromos($nbAutopromos, trim(file_get_contents(dirname(__FILE__).'/../category')), $gameOptions['autopromos_home_campagne']);
            elseif(isset($gameOptions['autopromos_home_perimetre']) and $gameOptions['autopromos_home_perimetre'] == 'global'):
              print autopromos($nbAutopromos, 'global', $gameOptions['autopromos_home_campagne']);
            else :
              print '<span style="color:red">Le perimetre autopromo doit etre global/famille.</span>';
            endif;
          endif;
        ?>

        <?php if( isset($gameOptions['pub_ads_content_home']) and $gameOptions['pub_ads_content_home'] ) : ?>
        <div class="row show-for-small-only">
          <div class="ads300_250">
            <div class="ads"><?php echo nl2br(file_get_contents(dirname(__FILE__).'/../products/'.PRODUCT.'/texts/ads.txt')) ?></div>
            <!-- 300x250 -->
            <div id="banner-pilon">
              <?php require dirname(__FILE__)."/../ads/home_mobile_pave3.php"; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <?php
          if( isset($gameOptions['show_autopromos_home']) and $gameOptions['show_autopromos_home'] ) :
            if($gameOptions['autopromos_home_nb'] > 2) :
              $nbAutopromos = '2,'.($gameOptions['autopromos_home_nb']-2);
            endif;

            if(isset($gameOptions['autopromos_home_perimetre']) and $gameOptions['autopromos_home_perimetre'] == 'famille') :
              print autopromos($nbAutopromos, trim(file_get_contents(dirname(__FILE__).'/../category')), $gameOptions['autopromos_home_campagne'], $gameOptions['autopromos_home_interval']);
            elseif(isset($gameOptions['autopromos_home_perimetre']) and $gameOptions['autopromos_home_perimetre'] == 'global'):
              print autopromos($nbAutopromos, 'global', $gameOptions['autopromos_home_campagne'], $gameOptions['autopromos_home_interval']);
            else :
              print '<span style="color:red">Le perimetre autopromo doit etre global/famille.</span>';
            endif;
          endif;
        ?>

        <script type="text/javascript" src="assets/libs/foundation/js/vendor/jquery.js"></script>
        <script type="text/javascript" src="assets/libs/foundation/js/vendor/modernizr.js"></script>
        <script type="text/javascript" src="assets/libs/foundation/js/foundation.min.js"></script>
        <script type="text/javascript" src="assets/libs/pGame/pGame.js"></script>
        <script>
          $(document).foundation();

          if(detectmob()) {
            setInterval(function() {
                jQuery('.textHautRow').height( jQuery(window).height() - jQuery('.logoRow').height() - 110 );
                jQuery('.txtLogoRow').height( jQuery(window).height() - jQuery('.playWinShareAndTextBasRow').height() -12 - 60 )
            }, 100);
          }

        </script>
      </div>
      <?php require dirname(__FILE__).'/../tarteaucitron/bottom_UE.php'; ?>
    </body>
  </html>
<?php endif; ?>
