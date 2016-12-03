
<?php

//Le nom du produit (jeu) que l'on souhaite utiliser Dans le dossier /products copier le jeu que vous souhaitez utiliser.
define('PRODUCT', 'your-game');

$gameOptions = array(
    'heightOfTiles' => 140,
    //100
    'heightOfTilesFullScreen' => 100,
    'speedOfTiles' => 2,
    //point pou augment le speed
    'pointToIncreaseSpeed' => 50,

    //la nuvel vitess
    'speedOfTiles2' => 3,  

	'duration' => 60,
	'pointEarned' => 5,
    'pointLost' => 5,
	'pointToLevel1' => 55,
    'winningLevel' => 2,
    'timingTemps'=> false,
    'percentToNextLevel' => 1.25,
    'life' => 3,
    'pointBonus' => 5,

    'winCallback' => 'http://www.google.com',
    'loseCallback' => 'http://www.google.com',


    'timeText' =>'Time :',
    'scoreText' =>'Score :',
    'levelTitleText' =>'Level :',
    'nextLevelType' => 'popup',
    'facebook' => false,
    'gold' => false,
    'closeRedirectWin' =>'http://www.google.fr',
    'closeRedirectLose' =>'http://www.google.fr',
    'fbShareURL' =>'http://www.google.fr',
    'youWinText' =>'Your score :',
    'youLoseText' =>'You Lose',
    'congratText' =>'YOU WIN',
    'clickGetReward' => 'Clic to get reward',
    'rewardText' => 'YOU GET YOUR REWARD',
    'gameOverText' =>'score',

    'congratNextLevelText' =>'Congrat you are level ',
    'nextScoreText' =>'Next point to level up: ',
    'yourScoreText' => " Current Score: ",
    'pointsText' =>'Score',


    //line 1 text options on intro
    'Textstyleline1' => "18px Andalus",
    'line1' => "1. Activate the tiles once they reach the red line",
    'colorline1' => '#000000',
    'line1Posx' => 270,
    'line1Posy' => 290,

    //line 2 text options
    'Textstyleline2' => "18px Andalus",
    'line2' => "2. Dont the tiles exceed the red line",
    'colorline2' => '#000000',
    'line2Posx' => 270,
    'line2Posy' => 320,


    //line 3 text options
    'Textstyleline3' => "18px Andalus",
    'line3' => "3. Reach max points",
    'colorline3' => '#000000',
    'line3Posx' => 270,
    'line3Posy' => 350,

        //line 1 text options on intro   fullscreen
    'Textstyleline1fullscreen' => "12px Andalus",
    'line1fullscreen' => "1.Activate the tiles once the reach the red line",
    'colorline1fullscreen' => '#000000',
    'line1Posxfullscreen' => 100,
    'line1Posyfullscreen' => 290+40,

    //line 2 text options  fullscreen
    'Textstyleline2fullscreen' => "12px Andalus",
    'line2fullscreen' => "2. Dont the tiles exceed the red line",
    'colorline2fullscreen' => '#000000',
    'line2Posxfullscreen' => 100,
    'line2Posyfullscreen' => 320+40,


    //line 3 text options fullscreen
    'Textstyleline3fullscreen' => "12px Andalus",
    'line3fullscreen' => "3. Reach max points",
    'colorline3fullscreen' => '#000000',
    'line3Posxfullscreen' => 100,
    'line3Posyfullscreen' => 350+40,


    'freegame_enabled' => false,

    'fullscreen' => false,
    'redirect_game' => false,
    'slideFullscreen' => true,
    //true

    'pub_ads_content_home' => true,
    'pub_ads_content_game' => true,

    'show_autopromos_home' => true,
    'show_autopromos_game' => true,










);
//REGIEREPLACE
