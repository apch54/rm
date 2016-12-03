<?php 
  require_once('config.php');
  require_once 'products/'.PRODUCT.'/config_socle.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php echo TITLE ?></title>

    <link rel="stylesheet" type="text/css" href="assets/libs/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/app.css">
    <?php if(is_file('products/'.PRODUCT.'/socle/css/app.css')) : ?>
      <link rel="stylesheet" type="text/css" href="products/<?php print PRODUCT ?>/socle/css/app.css">
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" href="assets/libs/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <div id="page">
        <div class="medium-12 row">
          <div class="medium-12 columns header">
            <div style='text-align:center;'>
              <img src="products/<?php print PRODUCT ?>/socle/logo.png" />
            </div>
          </div>
        </div>


        <div class="row">
          <div class="small-12 columns text-block game-explanation-100">
            <h1 class="title">TERMS AND CONDITIONS</h1>
            "Please note that <?php print $_SERVER['SERVER_NAME']; ?> webisite propose free games using your facebook photos. We access to your photo thanks to Facebook but they are never stored in our secured servers.<br /><br />We guarantee that we will never use, share or sell your personal information. Your privacy is important to us. <br /><br />You also have to read and accept the Privacy Policy and Term of Use of Facebook.com before continuing to use <?php print $_SERVER['SERVER_NAME']; ?> or the website of Facebook.<br /><br />We colect your email and we will never share ou sell it.<br /><br />We don’t have access to Facebook usernames and passwords. <br /><br />Any image that are editd by <?php print $_SERVER['SERVER_NAME']; ?> are not uploaded on our servers to create clics area.<br /><br />If you no longer desire to use <?php print $_SERVER['SERVER_NAME']; ?> as a User, you may remove <?php print $_SERVER['SERVER_NAME']; ?> from your Facebook acount. Once you have removed it, al personal information given to us is deleted.<br />For your convenience, <?php print $_SERVER['SERVER_NAME']; ?> site may provide links to various web sites that we do not control. When you clik on one of these links, you will be transfered out of our Site and connected to the web site of the organization or company that you selected (third-party companies).<br /><br />Before providing information to any party other than our app, you should check their privacy policy, as they are third parties. We are not responsible for the content or the privacy practices utilized by any other sites or apps, link by us. Uses of any such linked web site are at the user\'s own risk. <br /><br />You may not use Prohibited Content according to facebook’s application content. Such content includes photos that indicates alcohol content; hateful, threatening, defamatory, or pornographic; incites violence; or contains nudity or graphic or gratuitous violence."
          </div>
        </div>


 
      <div class="row">
        <div class="medium-6 small-6 columns text-left"><img src="products/<?php print PRODUCT ?>/socle/screenshot1.png" /></div>
        <div class="medium-6 small-6 columns text-right"><img src="products/<?php print PRODUCT ?>/socle/screenshot2.png" /></div>
      </div>
      
      <script type="text/javascript" src="assets/libs/foundation/js/vendor/jquery.js"></script>
      <script type="text/javascript" src="assets/libs/foundation/js/vendor/modernizr.js"></script>
      <script type="text/javascript" src="assets/libs/foundation/js/foundation.min.js"></script>
      <script>
        $(document).foundation();
      </script>
      <?php if(USE_FACEBOOK) : ?>
        <script>var facebook_app_id = '<?php echo FACEBOOK_APP_ID ?>';</script>
        <script src="http://connect.facebook.net/en_US/sdk.js"></script>
        <script src="assets/js/facebook.js"></script>
      <?php endif; ?>
    </div>
  </body>
</html>
