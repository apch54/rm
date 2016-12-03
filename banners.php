<h2>Banners</h2>

<?php $files = array('250x250.gif', '300x250.gif', '300x50.gif', '320x100.gif', '320x480.gif', '320x50.gif', '728x90.gif', '768x1024.gif', 'icone.png'); ?>

<?php foreach($files as $file) : ?>
  <?php if( file_exists(dirname(__FILE__).'/banners/'.$file) ) : ?>
    <h1 style="color:green"><?php print $file ?></h1>
    <img src="banners/<?php print $file ?>" />
  <?php else : ?>
    <h1 style="color: red"><?php print $file ?></h1>
  <?php endif; ?>
<?php endforeach; ?>
