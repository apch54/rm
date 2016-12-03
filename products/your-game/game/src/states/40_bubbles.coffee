#ecrit par fc#le 2016-10-03
#description: manage gamme bubbles
#
#             --
#   	   .       .
#        '          '
#   	'   ##        '
#      (    ##         )
#       .             .
#        \.         ./
#          .      .
#             ..
#             ..
#   	     `||'
#           ( oo )       ... --- ...
#          o0#( )#0o
#   	     #####       ···· · ·−·· ·−−·   −− ·   −·−· ·−·· · −−
#   	     #####
#   	     #####

class Phacker.Game.Bubbles

    constructor: (@gm ) ->
        @_fle_ ='BUBBLE'
        @ge     = @gm.elements
        @gus    = {}
        @b_group= {}
        @sprite = {}

    init_bbls:() -> #group

        @b_group = @gm.add.group()
        @b_group.enableBody = true

        #console.log "- #{@_fle_} : ",@sprite

        @b_group # group of bbls (bonus)

    create_bbls: (x, y)->
        @sprite = @choose_sprite()

        bbl = @b_group.create(x, y, @sprite.face)
        bbl.frame=0
        bbl.body.gravity.y = @gm.bbl_p.gravity
        bbl.body.bounce.y = 0.8 + Math.random() * 0.2
        bbl.collideWorldBounds = true
        bbl.inputEnabled = true
        #bbl.input.enableDrag()


    # choose the sprite to display ; 3 types
    choose_sprite:()->
        spt = @gm.rnd_int 1,20
        rtn = switch
            when spt < 4  then {face: 'bubble'}
            when spt < 9  then {face: 'lens'};
            else {face: 'star'}

   # to be set in create jeu
    manage_with:(gus, cd)->
        @gus       = gus
        @cd        = cd

    #.----------.----------
    # determine if gus is overlaping bbl
    #.----------.----------
    overlap :(gus) ->
        if @b_group.getAt? and @b_group.length > 0
            b  = @b_group.getAt 0
            ###
            #1/ test  first bbl missed

            console.log "- #{@_fle_} : ",b.x, gus.x, @b_group.length
            # bbl behind gus
            if (b.x + 55)  <= gus.x then  b.destroy()
            ###

            #2/ test gus ovelaping bubble
            boundsA = gus.getBounds()
            boundsB = @b_group.getBounds()

            #return true if  gus overlaps the bubble
            if Phaser.Rectangle.intersects(boundsA, boundsB)
                #@cd.play 'bonus'
                b.destroy()
                return true # overlaped







