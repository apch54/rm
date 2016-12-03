#fc-19-09-2016

class Phacker.Game.Steps

    constructor: (gm) ->
        @_fle_   = 'STEPS'
        @gm       = gm
        @gus      = {}

        # steps nb, last step,  level game, current block of steps
        # save infos
        @stat     = {nb:0, st:{}, blk:-1 }

        @last_step= {} # defined in add_a_stp()
        @score    = 0  # score to be binded after for level

        @steps = @gm.add.group() #define as a group
        @steps.enableBody = true

        # if vx up ratio up ; if drag up ratio down
        @ratio = @gm.gus.vx / @gm.gus.drag / 3.5
        #console.log "- #{@_fle_}  ratio: ",@ratio
        @set_blocks()

    #.----------.----------
    # bind gus & score
    #.----------.----------
    bind_gus:(gus)   ->   @gus   = gus
    bind_score:(scr) ->   @score = scr
    bind_bblO :(bblO)->   @bblO  = bblO  #bbl object

    #.----------.----------
    # here are created all the steps
    # as a group
    #.----------.----------
    stairs: -> # contain all physical steps
       @create_first_step()
       @draw_a_block(0)
       @steps #return the stair() = step which is a group

    create_first_step: -> #position of 1st step is set at random
        y0 = @gm.step_p.y0  # alt 1st step
        @add_a_step {x: @gm.step_p.x0, y: @gm.step_p.y0,  w: 150}

    #.----------.----------
    # destroy all steps
    #.----------.----------
    destroy: -> # to be finished
        lst = @steps.getAt(@steps.length - 1)
        #console.log "- #{@_fle_} : ",lst

    # .----------.----------
    # params  in s{}
    # x,y : step location
    # w : step width
    #.----------.----------

    add_a_step: (s)->
        if s.w?
            if s.w < 55 then        frame ='stepS'
            else
                if s.w < 80 then    frame ='stepL'
                else                frame ='stepXL'
        else
            frame = 'stepS'
            s.w= @gm.step_p.width

        #console.log "- #{@_fle_} : ", frame, s.w
        st = @steps.create(s.x, s.y, frame) # steps is a group
        st.width = s.w

        st.body.immovable = on
        @stat.st = st
        @stat.nb += 1 # save nb steps


    #.----------.----------
    # draw a block of steps
    # buid a steps refering to former one and block number
    # n_blk is the nb block in list to display
    #.----------.----------
    draw_a_block:(n_blk) ->
        blk= @blocks[n_blk]

        for i in [1..blk.n] # each line must be repeated as n
            x = @stat.st.position.x + blk.dx + @stat.st.width # new step position
            y = @stat.st.position.y - blk.dy

            @add_a_step {x: x ,y: y, w: blk.w} # draw it

        @stat.blk = n_blk # save block number

    #.----------.----------
    # calculate dx : interval between 2 steps
    # depends on gus.velocity
    # number : fixed  means  no random part is applied for dx
    #.----------.----------
    dx: (fixed) ->
        w = @gm.step_p.dx * @ratio
        # initial rnd part of step dx : ddx
        if fixed? and Number.isInteger(fixed)
            ddx = w + fixed
        else
            ddx= w + @gm.rnd_int(0, @gm.gus.vx / 4)
        #console.log "- #{@_fle_} : ",ddx
        ddx

    #.----------.----------
    # function called by jeu update
    #.----------.----------
    make_stairs :(gus) ->
        ddx = @stat.st.x - gus.x

        # Draw  satairs at the right moment
        if ddx < (@gm.width * .6)
             @draw_a_block(@stat.blk + 1)
             #console.log @stat.blk ,@stat.nb, gus.x, @stat.st.x

    #.----------.----------
    # def of all steps in block lines
    # w: width
    # dx, dy : separation between 2 steps
    # n : number of equal steps
    #.----------.----------

    set_blocks : ->
        dx0 = @gm.step_p.dx
        dy0 = @gm.step_p.dy
        w0  = @gm.step_p.width

        @blocks = [
            #level 1

            #{ w: w0*.4,      dx: @dx(-30), dy: 10, n: 1 }
            { w: w0 * 1.6,   dx: @dx(0),  dy: 20, n: 1, bbl: { type : 1 }}

            #lvl 2
            { w: w0 * 1.6,  dx: @dx(),   dy: dy0, n: 2}
            { w: w0 * 1,    dx: @dx(15),    dy: dy0, n: 1 }
            { w: w0 * 1.6,  dx: @dx(),   dy: dy0, n: 2}
            { w: w0 * 1,    dx: @dx(15),    dy: dy0, n: 1 }

            #trap
            { w: w0 * 1.6,  dx: @dx(), dy: dy0 - 10, n: 1 }
            { w: w0 * 1,    dx: @dx(10), dy: dy0, n: 1 }
            { w: w0 * 1.6,  dx: @dx(), dy: dy0 - 5, n: 1 }

            { w: w0 * 1.5, dx: @dx(), dy: dy0, n: 1}
            { w: w0 ,      dx: @dx(10), dy: dy0, n: 2 }
            { w: w0 * 1.6, dx: @dx(10), dy: dy0, n:2,}
            { w: w0 * .9,  dx: @dx(10), dy: dy0, n: 1 }

            #trap
            { w: w0 * 1.5,   dx: @dx(5), dy: dy0 - 10, n: 1 }
            { w: w0 * .9,    dx: @dx(10), dy: dy0, n: 1 }
            { w: w0 * 1.6,   dx: @dx(5), dy: dy0 - 10, n: 1 }

            #alea
            { w: w0 * 1.5, dx: @dx(), dy: dy0, n: 2}
            { w: w0 * .9,  dx: @dx(), dy: dy0, n: 1 }
            { w: w0 * 1.6, dx: @dx(), dy: dy0, n: 1}
            { w: w0 * .9,  dx: @dx(), dy: dy0, n: 1 }

            #trap
            { w: w0 * 1.6,    dx: @dx(0), dy: dy0 - 10, n: 1 }
            { w: w0 * .9,     dx: @dx(0), dy: dy0, n: 1 }
            { w: w0 * 1.5,    dx: @dx(0), dy: dy0, n: 2 }


            { w: w0 * .8,  dx: @dx(), dy: dy0, n: 1 }
            { w: w0 * 1.5, dx: dx0,   dy: dy0, n: 2 }
            { w: w0 * .8,  dx: dx0,   dy: dy0, n: 1 }

            { w: w0 * .8,  dx: dx0, dy: dy0, n: 1 }
            { w: w0 * 1.5, dx: dx0, dy: dy0, n: 2 }
            { w: w0 * .8,  dx: dx0, dy: dy0, n: 1 }

            #lvl 5
            {w: w0* 1.5 ,      dx :dx0,  dy :dy0,  n:1}
            {w: w0 * .8 ,      dx :dx0,  dy :dy0,  n:1}

            #lvl 6
            {w: w0 * 1.4 ,     dx :dx0,  dy :dy0,  n:2}
            {w: w0 * .75 ,     dx :dx0,  dy :dy0,  n:3}

            #lvl 7 & 8
            {w: w0 * 1.8 ,    dx :dx0*1.2,  dy :dy0,  n:2}
            {w: w0 *.7,       dx :dx0,      dy :dy0,  n:1}
            {w: w0 *1.4,      dx :dx0,      dy :dy0,  n:1}
            {w: w0    ,       dx :dx0,      dy :dy0,   n:1}

            {w: w0 ,          dx :dx0*1.2,  dy :dy0,  n:5 }
            {w: w0 *1.8,      dx :dx0*1.2,  dy :dy0,  n:1}
            {w: 30 ,          dx :dx0*1.1,  dy :dy0,  n:10}
            {w: w0*1.6,       dx :dx0,      dy :dy0,  n:15}
        ]
