# written by fc
# on2016
# description: 2016-10-05

#
#      '  _ ,  '     .- .-.. .-..  .- .-. .  ..-. --- --- .-..
#     -  (o)o)  -
#    -ooO'(_)--Ooo-


class  Phacker.Game.A_sound    #extends Phacker.Game.sound

    constructor : (game, name) ->
        @gm   = game
        @name = name

        @snd  = @gm.add.audio @name
        @snd.allowMultiple = true
        @add_markers()
        return


    add_markers: ()->
        snds = ['step','fall','bonus','over'] # list the whole sound in bs file

        for x in snds
            #console.log "In sound add cls", x
            switch x
                when 'step'   then @snd.addMarker x,     0,   .46   # gus walk on steps
                when 'fall'   then @snd.addMarker x,     0.5, 1.2   # Gus fall down
                when 'bonus'  then @snd.addMarker x,     1.8, .9    # bonus o2
                when 'over'   then @snd.addMarker x,     3,   3.2   # the end

    play: (key) -> @snd.play  key

