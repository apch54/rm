#Register Game
game = new Phacker.Game()

game.setGameState YourGame

game.setSpecificAssets ->

    # my param
    @_fle_ = 'specific asset'
    dsk = "products/your-game/design/desktop/desktop_gameplay/"
    mob = "products/your-game/design/mobile/mobile_gameplay/"
    aud = "products/your-game/game/audio/"

    ld= @game.load
    @game.fullscreen = @game.width < 377 # fullscreen if samall screen

    @game.rnd_int = (min, max)->  @rnd.integerInRange min, max

    #.----------.----------
    #images & sprites
    #.----------.----------

    if @game.fullscreen # small width
        ld.image  'sky', mob + 'bg_gameplay.jpg'
    else # large width
        ld.image  'sky', dsk + 'bg_gameplay.jpg'

    #bonus
    ld.spritesheet 'star',      dsk + 'bonus/star_bonus.png', 27,27,2
    ld.spritesheet 'bubble',    dsk + 'bonus/coin_bonus.png', 20,20,7
    ld.spritesheet 'lens',      dsk + 'bonus/telescope_bonus.png', 31,38,1

    # platform
    ld.image  'stepS',  dsk + 'platform/platform3.png'
    ld.image  'stepL',  dsk + 'platform/platform4.png'
    ld.image  'stepXL', dsk + 'platform/platform2.png'

    ld.spritesheet 'jmp_btn', dsk + 'Jump_btn.png', 200, 57, 2
    ld.spritesheet 'gus', dsk + 'character_sprite/character_sprite.png', 42, 55, 6

    ld.audio 'bs_audio',       [ aud + 'bs.mp3', aud + 'bs.ogg' ]


    #.----------.----------
    #consts
    #.----------.----------

    # buttons
    @game.jmp_btn = # jmp btn param
        x: (@game.width - 200) / 2
        y: @game.height - 80

    #steps & stairs
    @game.step_p     = #steps prameters
        dy          : 25 # dy between 2 stps ; set in boot
        dx          : 40
        y0          : @game.jmp_btn.y - 20 # above btn
        x0          : 40
        width       : 80 # as small step

    #player
    @game.gus =
        vy          : -82 # for a jump ( up = - )
        vx          :  130 # initial velocity.x
        x0          :  0 # initial location
        y0          :  @game.step_p.y0 - 80
        gravity     :  100
        is_down     :  false
        drag        :  35  #wind when gus' up
        mini_height_to_score : @game.step_p.y0 - 50


    #bbl or bonus
    @game.bbl_p =
        dy          : -60 # bbl initial location
        dx          :  120
        gravity     :  25

    #.----------.----------
    # to be let
    #.----------.----------

    game.setTextColorGameOverState 'white'
    game.setTextColorWinState 'white'
    game.setTextColorStatus 'orange'
    game.setOneTwoThreeColor 'darkblue'

    game.setLoaderColor 0xffffff
    game.setTimerColor 0x00416b
    game.setTimerBgColor 0xffffff


@pauseGame = ->
    game.game.paused = true

@replayGame = ->
    game.game.paused = false

game.run();
