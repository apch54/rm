# Installation #

1. Cloner le socle dans votre répertoire de travail sur serveur Web.
2. Copier le fichier config.sample.php vers config.php
3. Placer vous dans le repertoire 'ads'
4. copier tous les fichiers presents dans le repertoire ads/examples/ :
   dans le dossier parent "ads"
5. Crée un dossier products a la racine.
   Dans ce dossier vous clonerez le projet sur lequel vous souhaitez travailler.
6. Modifier le fichier de configuration config.php
      define('PRODUCT', '**Dossier du jeu**');

**ATTENTION** : Ne supprimer pas les fichiers .sample.php, car git vous invitera a les supprimer du repository ce qui peut engendrer des conflits.

# Que doit contenir le fichier de configuration (config.php) #

Le nom du produit (jeu) que l'on souhaite utiliser
Dans le dossier /products copier le jeu que vous souhaitez utiliser.
```
#!php

define('PRODUCT', 'gamename');
```

Preciser si vous souhaitez utiliser Phaser avec BOX2D ou sans
```
#!php

define('BOX2D', true);

define('BOX2D', false);
```

Donner le nom du jeu, cette constante permet de changer le titre de la page HTML (balise <title>)
```
#!php

define('TITLE', "It's my game ...");
```

Choix de la version du socle (v1 ou v2)

```
#!php

define("VERSION", "v1");
```

FaceBook App ID, permet au socle de se connecter a une application FaceBook
```
#!php

define("FACEBOOK_APP_ID", 'XXXXXXXXXXXXXX');
```

Menu en haut de la page d'Accueil Desktop

```
#!php

$GOBALS['menu'] = array(
  array( 
    'url' => 'http://google.com', 
    'text' => 'DOWNLOAD GAMES', 
  ),
  array( 
    'url' => 'http://google.com', 
    'text' => 'DISCOVER OUR GAMES', 
  ),
  array( 
    'url' => 'http://google.com', 
    'text' => 'NO FACEBOOK LOGIN ?', 
  ),
  array( 
    'url' => 'http://google.com', 
    'text' => 'TERMS & CONDITIONS', 
  ),
);
```

Utilisation de facebook
```
#!php

define("USE_FACEBOOK", false);
```

Header en page d'accueil, généralement on y mettra le logo du jeu.
```
#!php

define("HEADER", "aa");
define("HEADER", "<img src='chemin/vers/mon/image.jpg' />");
```

Textes d'explication

```
#!php

define('TEXT_TITLE_100', '');
define("TEXT_100", '');
define("TEXT_200", '');

define('GAME_EXPLANATION_TITLE_100', '');
define('GAME_EXPLANATION_100', '');

define('GAME_EXPLANATION_TITLE_200', '');
define("GAME_EXPLANATION_200", '');

```

FREE GAME, icônes présentes a des points statiques invitant a download le jeu.

```
#!php

define("FREE_GAME", "FREE GAME !");
define("FREE_GAME_LINK", "http://www.freegame.com");
```

Play Win Share - Icone présente en page d'accueil incitant a cliquer sur le bouton ci dessous
```
#!php

define("PLAY_WIN_SHARE", "PLAY - WIN - SHARE");
```

URL d'acces a la page game.php, permet de passer des paramètres GET
```
#!php

define('GAME_URL', 'game.php?param=valeur');
```

Contenu dans les zones Ad Sense et Square

```
#!php

define("ADSENSE", "AD SENSE");
define("SQUARE", "SQUARE");
```

Captures d'écran du jeu

```
#!php

define("SCREENSHOT_1", "chemin/vers/mon/screenshot1.jpg");
define("SCREENSHOT_2", "chemin/vers/mon/screenshot2.jpg");
```

Lien vers le fond d'ecran du jeu, cette option permet d'afficher le background en attendant que Phaser charge (Avant le loader).

```
#!php

define("BACKGROUND_GAME", "chemin/vers/le/background.jpg");
```

Game Page : Title et Header
Par default on affiche les valeurs présente en page d'accueil

```
#!php

define('GP_TITLE', TITLE);
define('GP_HEADER', HEADER);
```

Auto Promos

```
#!php

define('AUTO_PROMO_1_FRONT_LINK', '');
define('AUTO_PROMO_1_FRONT_IMG', '');
define('AUTO_PROMO_1_FRONT_TITLE', '');
define('AUTO_PROMO_1_FRONT_TEXT', '');

define('AUTO_PROMO_2_FRONT_LINK', '');
define('AUTO_PROMO_2_FRONT_IMG', '');
define('AUTO_PROMO_2_FRONT_TITLE', '');
define('AUTO_PROMO_2_FRONT_TEXT', '');

define('AUTO_PROMO_3_FRONT_LINK', '');
define('AUTO_PROMO_3_FRONT_IMG', '');
define('AUTO_PROMO_3_FRONT_TITLE', '');
define('AUTO_PROMO_3_FRONT_TEXT', '');

define('AUTO_PROMO_4_FRONT_LINK', '');
define('AUTO_PROMO_4_FRONT_IMG', '');
define('AUTO_PROMO_4_FRONT_TITLE', '');
define('AUTO_PROMO_4_FRONT_TEXT', '');

define('AUTO_PROMO_5_FRONT_LINK', '');
define('AUTO_PROMO_5_FRONT_IMG', '');
define('AUTO_PROMO_5_FRONT_TITLE', '');
define('AUTO_PROMO_5_FRONT_TEXT', '');



define('AUTO_PROMO_1_GAME_LINK', '');
define('AUTO_PROMO_1_GAME_IMG', '');
define('AUTO_PROMO_1_GAME_TITLE', '');
define('AUTO_PROMO_1_GAME_TEXT', '');

define('AUTO_PROMO_2_GAME_LINK', '');
define('AUTO_PROMO_2_GAME_IMG', '');
define('AUTO_PROMO_2_GAME_TITLE', '');
define('AUTO_PROMO_2_GAME_TEXT', '');

define('AUTO_PROMO_3_GAME_LINK', '');
define('AUTO_PROMO_3_GAME_IMG', '');
define('AUTO_PROMO_3_GAME_TITLE', '');
define('AUTO_PROMO_3_GAME_TEXT', '');

define('AUTO_PROMO_4_GAME_LINK', '');
define('AUTO_PROMO_4_GAME_IMG', '');
define('AUTO_PROMO_4_GAME_TITLE', '');
define('AUTO_PROMO_4_GAME_TEXT', '');

define('AUTO_PROMO_5_GAME_LINK', '');
define('AUTO_PROMO_5_GAME_IMG', '');
define('AUTO_PROMO_5_GAME_TITLE', '');
define('AUTO_PROMO_5_GAME_TEXT', '');
```


Options de jeu, ces options sont spécifiques a chaque produit, referez vous donc au repository du produit que vous souhaitez intégrer.
Toutefois les options de jeu se trouvent toujours dans un tableau associatif $gameOptions

```
#!php

$gameOptions = array(
  ...
);
```

# Développement d'un jeu pour le socle #

Avant de commencer tout nouveau jeux, il faut crée un repository git pour ce projet.
Cloner ce repository dans le dossier "products" de votre socle.

A partir de la vous devriez obtenir un repertoire portant le nom de votre projet, example "projects/**nom-du-jeu/**
Pendant le développement de ce jeu vous n'aurez a intervenir que dans ce dossier, **Le socle doit rester intact**

Pour information : le dossier product est ignorer par le repository du socle, ainsi vous avez la voie libre pour travailler dans ce dossier. Il ne faut donc jamais modifier les fichiers du socle (Sauf accord avec Clément).

## Structure de base d'un produit ##

### Dossier socle ###

C'est dans ce repertoire que vous allez pouvoir customizer le socle, par exemple pour changer le style des boutons.

Si vous le souhaitez, vous avez la possibilité de crée un fichier app.css dans un sous repertoire css soit depuis la racine du socle :

/products/nom-du-jeu/socle/css/app.css

Ce fichier vous permettra d'overrider les règles css de base.

### Dossier game ###

C'est dans ce repertoire que vous allez instancier phaser afin de crée votre jeu.

De base, un seul fichier est obligatoire : index.php

C'est dans ce fichier que vous allez lier les fichiers javascript dont vous aurez besoin pour faire fonctionner le jeu.



**example :**

```
#!php

<script type="text/javascript" src="<?php print ROOT_GAME ?>states/intro.js"></script>
<script type="text/javascript" src="<?php print ROOT_GAME ?>states/gameOver.js"></script>
<script type="text/javascript" src="<?php print ROOT_GAME ?>states/win.js"></script>


<!-- Put the states before the boot.js ALWAYS!!! -->

<script type="text/javascript" src="<?php print ROOT_GAME ?>states/jeu.js"></script>

<script type="text/javascript" src="<?php print ROOT_GAME ?>options.js"></script>

```

Veuillez noter que le javascript executer ici ne sera disponible que pour la page **game.php**

Le constante **ROOT_GAME** vous aidera a retrouver automatiquement le chemin du repertoire game de votre jeu.

**root_game** est une variable alias de la constante **ROOT_GAME** présente en javascript qui vous aidera lors des preload de vos assets dans le jeu.


