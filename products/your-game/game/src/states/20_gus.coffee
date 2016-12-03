#   _____
#  / ____|
# | |  __ _   _ ___
# | | |_ | | | / __|                .... ..    -.-. .-.. . --
# | |__| | |_| \__ \                |
#  \_____|\__,_|___/                |.===.
#                                   {}o o{}
# stands for Gustave the player  ooO--(_)--Ooo-  // fc 2016-10-18


class Phacker.Game.Player

    @gm = '' #game
    #@gus = '' #the player
    @bbls = {} # bubbles

    constructor: (gm, x, y)->
        @gm = gm
        @_fle_ = 'Gus'
        @bblO = {} # bubbles

        @gus = @gm.add.sprite(x, y, 'gus')
        @gm.physics.arcade.enable @gus
        @gus.body.setSize 15, 55, 8, 0
        @gus.body.bounce.y = 0.07
        @gus.body.gravity.y = @gm.gus.gravity
        @gus.body.drag.x = 0
        @gus.body.collideWorldBounds = true

        @gus.animations.add 'right', [0, 1, 2, 3, 4, 5], 10, true
        @gus.animations.play 'right'
        @gus.body.velocity.x = @gm.gus.vx

    #.----------.----------
    # binding or injections
    #.----------.----------
    set: -> @gus #return player obj
    bind_bbl: (bblO) -> @bblO = bblO

    #.----------.----------
    # display bonus over gus
    #.----------.----------
    add_bonus_txt: (txt)->
        sstyle = { font: "15px Courier", fill: "#ffff66" }
        @text1 = @gm.add.text 0, 0, '' + txt, sstyle

        @text1.y = -20
        @text1.x = -5

        @gus.addChild @text1

    #.----------.----------
    #  win a jump?
    #.----------.----------
    has_jumped: ->

        if @gus.body.touching.down and (@gus.y < @gm.gus.mini_height_to_score)
            # save last height to score ( step)
            @gm.gus.mini_height_to_score = @gus.y
            #console.log "- Gus : ", @gus.y, @gm.gus.mini_height_to_score, @gus.body.touching.down
            @create_bbl()

            @gus.body.drag.x = 0
            @gus.body.velocity.x = @gm.gus.vx

            return true
        false

    #.----------.----------
    #  create a bbl
    #.----------.----------
    create_bbl: ->
        if @gm.rnd_int(1,4) < 3 then return # set a bbl on 50/100

        xb =@gus.x + @gm.bbl_p.dx
        yb = @gus.y + @gm.bbl_p.dy
        bbl = @bblO.create_bbls(xb, yb)

    #.----------.----------
    # detect in jeu.update gus position
    #.----------.----------
    is_down: (stp)  ->

        # set camera on left button side of screen
        if @gus.x > @gm.width * .25
            @gm.camera.x = @gus.x - @gm.width * .25
            @gm.camera.y = @gus.y - @gm.height * .55 - 10

        # Gus 's down
        if @gus.y > @gm.gus.mini_height_to_score + 100  # Updated in score class with gus pos
            if not @gm.gus.is_down  # because lot's of lost lives arrive
                @gm.gus.is_down = true

                @gus.body.drag.x = 0
                @gus.body.velocity.x = @gm.gus.vx

                return true
        false

    #.----------.----------
    # reset player  when lost life
    #.----------.----------
    reset: ->
        #console.log "- #{@_fle_} : ", @gus.x
        @gus.x = @gm.gus.x0
        @gus.y = @gm.gus.y0

        @gus.body.velocity.y = 0
        @gus.body.velocity.x = @gm.gus.vx

        @gm.camera.x = 0
        @gm.camera.y = 0

        @gm.gus.is_down = false # soo it cal fall again
        @gm.gus.mini_height_to_score = @gm.step_p.y0 - 50


