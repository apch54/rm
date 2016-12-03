class @YourGame extends Phacker.GameState

    @gus ={} # the player
    @bbl ={} # bonus


    #----------.----------.----------
    update: ->
    #----------.----------.----------
        @_fle_ =' Jeu Update : '
        super() #Required

        console.log "- #{@_fle_} : ",@socleO.gus_velocity()

        ###
        @game.physics.arcade.collide @gus, @stairs
        # make steps if necessary
        @stepsO.make_stairs(@gus)

        #handle gus pos
        # in is_down function replace gus at the left button too
        if @gusO.is_down()
            @lostLife()
            @lost()
            @cd.play 'over'

        # gus has jumped
        if @gusO.has_jumped() then @win() ; @cd.play 'step'

        # manage bubbles or bonus
        if @bblO.overlap(@gus) then @winBonus() ; @cd.play 'bonus'

        ###

    #----------.----------.----------
    resetPlayer: -> #when gus 'down or retry (error in that case)
    #----------.----------.----------
        console.log "Reset the player "
        #reset gus, camera and ...
        #@gusO.reset() # reset gus and environnment


    #----------.----------.----------
    create: ->
    #----------.----------.----------
        super() #Required

        @game.physics.startSystem(Phaser.Physics.P2JS)
        @game.world.setBounds(0, -100000, 19200000, 19200000)

        #.----------.----------
        # manage socle
        # platform is the real socle physicaly speaking
        @socleO = new Phacker.Game.Socle(@game); #obj
        @platform = @socleO.set_group() #define plateform

        ###

        #.----------.----------
        # player
        @gusO = new Phacker.Game.Player(@game, @game.gus.x0, @game.gus.y0) # instance obj@ge.GusO = new Phacker.Game.gus(game, @ge.stepsO.x0+20, @ge.stepsO.y0-40); # instance obj
        @gusO.reset()
        @gus = @gusO.set() #define 'player'
        @socleO.bind(@gus)

        #.----------.----------
        #steps and stairs
        @stepsO = new Phacker.Game.Steps @game
        @stairs = @stepsO.stairs() # all the physical steps are here

        #.----------.----------
        # introduce bubbles or bonus
        @bblO = new Phacker.Game.Bubbles @game # the object
        @bbls = @bblO.init_bbls()
        @gusO.bind_bbl(@bblO)

        #.----------.----------
        # audio
        @cd = new Phacker.Game.A_sound @game, 'bs_audio'
        #@cd.play 'over'



        #  LOGIC OF YOUR GAME

        # Examples buttons actions

        lostBtn = @game.add.text(0, 0, "Bad Action");
        lostBtn.inputEnabled = true;
        lostBtn.y = @game.height * 0.5 - lostBtn.height * 0.5
        lostBtn.events.onInputDown.add ( ->
            @lost()
        ).bind @

        winBtn = @game.add.text(0, 0, "Good Action");
        winBtn.inputEnabled = true;
        winBtn.y = @game.height * 0.5 - winBtn.height * 0.5
        winBtn.x = @game.width - winBtn.width
        winBtn.events.onInputDown.add ( ->
            @win()
        ).bind @

        lostLifeBtn = @game.add.text(0, 0, "Lost Life");
        lostLifeBtn.inputEnabled = true;
        lostLifeBtn.y = @game.height * 0.5 - lostLifeBtn.height * 0.5
        lostLifeBtn.x = @game.width * 0.5 - lostLifeBtn.width * 0.5
        lostLifeBtn.events.onInputDown.add ( ->
            @lostLife()
        ).bind @

        bonusBtn = @game.add.text(0, 0, "Bonus");
        bonusBtn.inputEnabled = true;
        bonusBtn.y = @game.height * 0.5 - bonusBtn.height * 0.5 + 50
        bonusBtn.x = @game.width - bonusBtn.width
        bonusBtn.events.onInputDown.add ( ->
            @winBonus()
        ).bind @


       #Placement specific for mobile

       if gameOptions.fullscreen
           lostBtn.x = @game.width * 0.5 - lostBtn.width * 0.5
           lostBtn.y = @game.height * 0.25

           winBtn.x = @game.width * 0.5 - winBtn.width * 0.5
           winBtn.y = @game.height * 0.5

           lostLifeBtn.x = @game.width * 0.5 - lostLifeBtn.width * 0.5
           lostLifeBtn.y = @game.height * 0.75

           bonusBtn.x = @game.width * 0.5 - winBtn.width * 0.5
           bonusBtn.y = @game.height * 0.5 + 50

        ###