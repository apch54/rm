<?php
$_UE=false; 

if(isset($langue)) {
  if ($langue=="DE" || $langue=="AT" || $langue=="BE" || $langue=="BG" || $langue=="CY" || $langue=="HR" || $langue=="DK" || $langue=="ES" || $langue=="EE" || $langue=="FI" || $langue=="FR" || $langue=="GR" || $langue=="HU" || $langue=="IE" || $langue=="IT" || $langue=="LV" || $langue=="LT"|| $langue=="LU" || $langue=="MT"|| $langue=="NL"|| $langue=="PL"|| $langue=="PT"|| $langue=="CZ"|| $langue=="RO"|| $langue=="GB"|| $langue=="SK"|| $langue=="SI"|| $langue=="SE"){
          
$_UE=true; 

?>
          
       <script type="text/javascript" src="/tarteaucitron/tarteaucitron.js"></script>

        <script type="text/javascript">
        tarteaucitron.init({
            "hashtag": "#tarteaucitron", /* Ouverture automatique du panel avec le hashtag */
            "highPrivacy": false, /* désactiver le consentement implicite (en naviguant) ? */
            "orientation": "top", /* le bandeau doit être en haut (top) ou en bas (bottom) ? */
            "adblocker": false, /* Afficher un message si un adblocker est détecté */
            "showAlertSmall": false, /* afficher le petit bandeau en bas à droite ? */
            "cookieslist": true, /* Afficher la liste des cookies installés ? */
            "removeCredit": true /* supprimer le lien vers la source ? */
        });
        </script>
          
          
          <?php }} ?>
