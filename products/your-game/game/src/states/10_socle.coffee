
#-------------------------------------------------!
#               #                 #               !
#               #=ooO=========Ooo=#               !
#               #  \\  (o o)  //  #               !
#               --------(_)--------
#       ·−− ···· ·− −    ·−    −− · ··· ···       !
#-------------------------------------------------!
#                socle: 2016/10/19                !
#                      apch                       !
#-------------------------------------------------!
#  My name's Gus stands for Gustave the 'socler'  !
#-------------------------------------------------!

class Phacker.Game.Socle

    # Platform ss

    constructor: (gm) ->
        @_fle_          = 'SOCLe'
        @gm             = gm              #game
        @pfm            = @gm.add.group() #platform
        @pfm.enableBody = true
        @gus            = {} #the player
        @vy             = 0
        @pwr_btn_pressed = false


    #.----------.----------
    # build socle
    #.----------.----------
    set_group :->
        @draw_sky()
        @draw_btn()
        @pfm    # return platform obj

    draw_sky :  ->
        @sky= @pfm.create(0,48, 'sky')
        @gm.world.sendToBack(@sky)
        @sky.fixedToCamera = true;

    draw_btn: ->
        x = @gm.jmp_btn.x
        y = @gm.jmp_btn.y
        #console.log "- #{@_fle_} : ",@ge.screen.height, @ge.btn.height, y,@gnd.y
        @pwr_btn = @gm.add.button(x, y, 'jmp_btn', @pressed, @, 1, 1, 0)
        @pwr_btn.fixedToCamera = true

        #@pwr_btn.onInputOver.add(@over, this);
        @pwr_btn.onInputOut.add(@over, this);
        @pwr_btn.onInputUp.add(@over, this);
        @pwr_btn.onInputDown.add(@pressed, this);



    bind:(ply) ->  @gus = ply # connect player to the platform

    #.----------.----------
    #.manage player animations
    #.----------.----------
    over: ->  @pwr_btn_pressed = false #console.log "- #{@_fle_} : ",@pwr_btn_pressed
    pressed: ->  @pwr_btn_pressed = true #console.log "- #{@_fle_} : ",@pwr_btn_pressed

    gus_velocity: ->
        if @pwr_btn_pressed then @vy += 1
        @vy


