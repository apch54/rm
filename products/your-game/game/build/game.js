(function() {
  Phacker.Game.Socle = (function() {
    function Socle(gm) {
      this._fle_ = 'SOCLe';
      this.gm = gm;
      this.pfm = this.gm.add.group();
      this.pfm.enableBody = true;
      this.gus = {};
      this.vy = 0;
      this.pwr_btn_pressed = false;
    }

    Socle.prototype.set_group = function() {
      this.draw_sky();
      this.draw_btn();
      return this.pfm;
    };

    Socle.prototype.draw_sky = function() {
      this.sky = this.pfm.create(0, 48, 'sky');
      this.gm.world.sendToBack(this.sky);
      return this.sky.fixedToCamera = true;
    };

    Socle.prototype.draw_btn = function() {
      var x, y;
      x = this.gm.jmp_btn.x;
      y = this.gm.jmp_btn.y;
      this.pwr_btn = this.gm.add.button(x, y, 'jmp_btn', this.pressed, this, 1, 1, 0);
      this.pwr_btn.fixedToCamera = true;
      this.pwr_btn.onInputOut.add(this.over, this);
      this.pwr_btn.onInputUp.add(this.over, this);
      return this.pwr_btn.onInputDown.add(this.pressed, this);
    };

    Socle.prototype.bind = function(ply) {
      return this.gus = ply;
    };

    Socle.prototype.over = function() {
      return this.pwr_btn_pressed = false;
    };

    Socle.prototype.pressed = function() {
      return this.pwr_btn_pressed = true;
    };

    Socle.prototype.gus_velocity = function() {
      if (this.pwr_btn_pressed) {
        this.vy += 1;
      }
      return this.vy;
    };

    return Socle;

  })();

}).call(this);

(function() {
  Phacker.Game.Player = (function() {
    Player.gm = '';

    Player.bbls = {};

    function Player(gm, x, y) {
      this.gm = gm;
      this._fle_ = 'Gus';
      this.bblO = {};
      this.gus = this.gm.add.sprite(x, y, 'gus');
      this.gm.physics.arcade.enable(this.gus);
      this.gus.body.setSize(15, 55, 8, 0);
      this.gus.body.bounce.y = 0.07;
      this.gus.body.gravity.y = this.gm.gus.gravity;
      this.gus.body.drag.x = 0;
      this.gus.body.collideWorldBounds = true;
      this.gus.animations.add('right', [0, 1, 2, 3, 4, 5], 10, true);
      this.gus.animations.play('right');
      this.gus.body.velocity.x = this.gm.gus.vx;
    }

    Player.prototype.set = function() {
      return this.gus;
    };

    Player.prototype.bind_bbl = function(bblO) {
      return this.bblO = bblO;
    };

    Player.prototype.add_bonus_txt = function(txt) {
      var sstyle;
      sstyle = {
        font: "15px Courier",
        fill: "#ffff66"
      };
      this.text1 = this.gm.add.text(0, 0, '' + txt, sstyle);
      this.text1.y = -20;
      this.text1.x = -5;
      return this.gus.addChild(this.text1);
    };

    Player.prototype.has_jumped = function() {
      if (this.gus.body.touching.down && (this.gus.y < this.gm.gus.mini_height_to_score)) {
        this.gm.gus.mini_height_to_score = this.gus.y;
        this.create_bbl();
        this.gus.body.drag.x = 0;
        this.gus.body.velocity.x = this.gm.gus.vx;
        return true;
      }
      return false;
    };

    Player.prototype.create_bbl = function() {
      var bbl, xb, yb;
      if (this.gm.rnd_int(1, 4) < 3) {
        return;
      }
      xb = this.gus.x + this.gm.bbl_p.dx;
      yb = this.gus.y + this.gm.bbl_p.dy;
      return bbl = this.bblO.create_bbls(xb, yb);
    };

    Player.prototype.is_down = function(stp) {
      if (this.gus.x > this.gm.width * .25) {
        this.gm.camera.x = this.gus.x - this.gm.width * .25;
        this.gm.camera.y = this.gus.y - this.gm.height * .55 - 10;
      }
      if (this.gus.y > this.gm.gus.mini_height_to_score + 100) {
        if (!this.gm.gus.is_down) {
          this.gm.gus.is_down = true;
          this.gus.body.drag.x = 0;
          this.gus.body.velocity.x = this.gm.gus.vx;
          return true;
        }
      }
      return false;
    };

    Player.prototype.reset = function() {
      this.gus.x = this.gm.gus.x0;
      this.gus.y = this.gm.gus.y0;
      this.gus.body.velocity.y = 0;
      this.gus.body.velocity.x = this.gm.gus.vx;
      this.gm.camera.x = 0;
      this.gm.camera.y = 0;
      this.gm.gus.is_down = false;
      return this.gm.gus.mini_height_to_score = this.gm.step_p.y0 - 50;
    };

    return Player;

  })();

}).call(this);

(function() {
  Phacker.Game.Steps = (function() {
    function Steps(gm) {
      this._fle_ = 'STEPS';
      this.gm = gm;
      this.gus = {};
      this.stat = {
        nb: 0,
        st: {},
        blk: -1
      };
      this.last_step = {};
      this.score = 0;
      this.steps = this.gm.add.group();
      this.steps.enableBody = true;
      this.ratio = this.gm.gus.vx / this.gm.gus.drag / 3.5;
      this.set_blocks();
    }

    Steps.prototype.bind_gus = function(gus) {
      return this.gus = gus;
    };

    Steps.prototype.bind_score = function(scr) {
      return this.score = scr;
    };

    Steps.prototype.bind_bblO = function(bblO) {
      return this.bblO = bblO;
    };

    Steps.prototype.stairs = function() {
      this.create_first_step();
      this.draw_a_block(0);
      return this.steps;
    };

    Steps.prototype.create_first_step = function() {
      var y0;
      y0 = this.gm.step_p.y0;
      return this.add_a_step({
        x: this.gm.step_p.x0,
        y: this.gm.step_p.y0,
        w: 150
      });
    };

    Steps.prototype.destroy = function() {
      var lst;
      return lst = this.steps.getAt(this.steps.length - 1);
    };

    Steps.prototype.add_a_step = function(s) {
      var frame, st;
      if (s.w != null) {
        if (s.w < 55) {
          frame = 'stepS';
        } else {
          if (s.w < 80) {
            frame = 'stepL';
          } else {
            frame = 'stepXL';
          }
        }
      } else {
        frame = 'stepS';
        s.w = this.gm.step_p.width;
      }
      st = this.steps.create(s.x, s.y, frame);
      st.width = s.w;
      st.body.immovable = true;
      this.stat.st = st;
      return this.stat.nb += 1;
    };

    Steps.prototype.draw_a_block = function(n_blk) {
      var blk, i, j, ref, x, y;
      blk = this.blocks[n_blk];
      for (i = j = 1, ref = blk.n; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
        x = this.stat.st.position.x + blk.dx + this.stat.st.width;
        y = this.stat.st.position.y - blk.dy;
        this.add_a_step({
          x: x,
          y: y,
          w: blk.w
        });
      }
      return this.stat.blk = n_blk;
    };

    Steps.prototype.dx = function(fixed) {
      var ddx, w;
      w = this.gm.step_p.dx * this.ratio;
      if ((fixed != null) && Number.isInteger(fixed)) {
        ddx = w + fixed;
      } else {
        ddx = w + this.gm.rnd_int(0, this.gm.gus.vx / 4);
      }
      return ddx;
    };

    Steps.prototype.make_stairs = function(gus) {
      var ddx;
      ddx = this.stat.st.x - gus.x;
      if (ddx < (this.gm.width * .6)) {
        return this.draw_a_block(this.stat.blk + 1);
      }
    };

    Steps.prototype.set_blocks = function() {
      var dx0, dy0, w0;
      dx0 = this.gm.step_p.dx;
      dy0 = this.gm.step_p.dy;
      w0 = this.gm.step_p.width;
      return this.blocks = [
        {
          w: w0 * 1.6,
          dx: this.dx(0),
          dy: 20,
          n: 1,
          bbl: {
            type: 1
          }
        }, {
          w: w0 * 1.6,
          dx: this.dx(),
          dy: dy0,
          n: 2
        }, {
          w: w0 * 1,
          dx: this.dx(15),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(),
          dy: dy0,
          n: 2
        }, {
          w: w0 * 1,
          dx: this.dx(15),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(),
          dy: dy0 - 10,
          n: 1
        }, {
          w: w0 * 1,
          dx: this.dx(10),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(),
          dy: dy0 - 5,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: this.dx(),
          dy: dy0,
          n: 1
        }, {
          w: w0,
          dx: this.dx(10),
          dy: dy0,
          n: 2
        }, {
          w: w0 * 1.6,
          dx: this.dx(10),
          dy: dy0,
          n: 2
        }, {
          w: w0 * .9,
          dx: this.dx(10),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: this.dx(5),
          dy: dy0 - 10,
          n: 1
        }, {
          w: w0 * .9,
          dx: this.dx(10),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(5),
          dy: dy0 - 10,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: this.dx(),
          dy: dy0,
          n: 2
        }, {
          w: w0 * .9,
          dx: this.dx(),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(),
          dy: dy0,
          n: 1
        }, {
          w: w0 * .9,
          dx: this.dx(),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.6,
          dx: this.dx(0),
          dy: dy0 - 10,
          n: 1
        }, {
          w: w0 * .9,
          dx: this.dx(0),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: this.dx(0),
          dy: dy0,
          n: 2
        }, {
          w: w0 * .8,
          dx: this.dx(),
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: dx0,
          dy: dy0,
          n: 2
        }, {
          w: w0 * .8,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * .8,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: dx0,
          dy: dy0,
          n: 2
        }, {
          w: w0 * .8,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.5,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * .8,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.4,
          dx: dx0,
          dy: dy0,
          n: 2
        }, {
          w: w0 * .75,
          dx: dx0,
          dy: dy0,
          n: 3
        }, {
          w: w0 * 1.8,
          dx: dx0 * 1.2,
          dy: dy0,
          n: 2
        }, {
          w: w0 * .7,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0 * 1.4,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0,
          dx: dx0,
          dy: dy0,
          n: 1
        }, {
          w: w0,
          dx: dx0 * 1.2,
          dy: dy0,
          n: 5
        }, {
          w: w0 * 1.8,
          dx: dx0 * 1.2,
          dy: dy0,
          n: 1
        }, {
          w: 30,
          dx: dx0 * 1.1,
          dy: dy0,
          n: 10
        }, {
          w: w0 * 1.6,
          dx: dx0,
          dy: dy0,
          n: 15
        }
      ];
    };

    return Steps;

  })();

}).call(this);

(function() {
  Phacker.Game.Bubbles = (function() {
    function Bubbles(gm) {
      this.gm = gm;
      this._fle_ = 'BUBBLE';
      this.ge = this.gm.elements;
      this.gus = {};
      this.b_group = {};
      this.sprite = {};
    }

    Bubbles.prototype.init_bbls = function() {
      this.b_group = this.gm.add.group();
      this.b_group.enableBody = true;
      return this.b_group;
    };

    Bubbles.prototype.create_bbls = function(x, y) {
      var bbl;
      this.sprite = this.choose_sprite();
      bbl = this.b_group.create(x, y, this.sprite.face);
      bbl.frame = 0;
      bbl.body.gravity.y = this.gm.bbl_p.gravity;
      bbl.body.bounce.y = 0.8 + Math.random() * 0.2;
      bbl.collideWorldBounds = true;
      return bbl.inputEnabled = true;
    };

    Bubbles.prototype.choose_sprite = function() {
      var rtn, spt;
      spt = this.gm.rnd_int(1, 20);
      return rtn = (function() {
        switch (false) {
          case !(spt < 4):
            return {
              face: 'bubble'
            };
          case !(spt < 9):
            return {
              face: 'lens'
            };
          default:
            return {
              face: 'star'
            };
        }
      })();
    };

    Bubbles.prototype.manage_with = function(gus, cd) {
      this.gus = gus;
      return this.cd = cd;
    };

    Bubbles.prototype.overlap = function(gus) {
      var b, boundsA, boundsB;
      if ((this.b_group.getAt != null) && this.b_group.length > 0) {
        b = this.b_group.getAt(0);

        /*
        #1/ test  first bbl missed
        
        console.log "- #{@_fle_} : ",b.x, gus.x, @b_group.length
         * bbl behind gus
        if (b.x + 55)  <= gus.x then  b.destroy()
         */
        boundsA = gus.getBounds();
        boundsB = this.b_group.getBounds();
        if (Phaser.Rectangle.intersects(boundsA, boundsB)) {
          b.destroy();
          return true;
        }
      }
    };

    return Bubbles;

  })();

}).call(this);

(function() {
  Phacker.Game.A_sound = (function() {
    function A_sound(game, name) {
      this.gm = game;
      this.name = name;
      this.snd = this.gm.add.audio(this.name);
      this.snd.allowMultiple = true;
      this.add_markers();
      return;
    }

    A_sound.prototype.add_markers = function() {
      var i, len, results, snds, x;
      snds = ['step', 'fall', 'bonus', 'over'];
      results = [];
      for (i = 0, len = snds.length; i < len; i++) {
        x = snds[i];
        switch (x) {
          case 'step':
            results.push(this.snd.addMarker(x, 0, .46));
            break;
          case 'fall':
            results.push(this.snd.addMarker(x, 0.5, 1.2));
            break;
          case 'bonus':
            results.push(this.snd.addMarker(x, 1.8, .9));
            break;
          case 'over':
            results.push(this.snd.addMarker(x, 3, 3.2));
            break;
          default:
            results.push(void 0);
        }
      }
      return results;
    };

    A_sound.prototype.play = function(key) {
      return this.snd.play(key);
    };

    return A_sound;

  })();

}).call(this);

(function() {
  var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  this.YourGame = (function(superClass) {
    extend(YourGame, superClass);

    function YourGame() {
      return YourGame.__super__.constructor.apply(this, arguments);
    }

    YourGame.gus = {};

    YourGame.bbl = {};

    YourGame.prototype.update = function() {
      this._fle_ = ' Jeu Update : ';
      YourGame.__super__.update.call(this);
      return console.log("- " + this._fle_ + " : ", this.socleO.gus_velocity());

      /*
      @game.physics.arcade.collide @gus, @stairs
       * make steps if necessary
      @stepsO.make_stairs(@gus)
      
      #handle gus pos
       * in is_down function replace gus at the left button too
      if @gusO.is_down()
          @lostLife()
          @lost()
          @cd.play 'over'
      
       * gus has jumped
      if @gusO.has_jumped() then @win() ; @cd.play 'step'
      
       * manage bubbles or bonus
      if @bblO.overlap(@gus) then @winBonus() ; @cd.play 'bonus'
       */
    };

    YourGame.prototype.resetPlayer = function() {
      return console.log("Reset the player ");
    };

    YourGame.prototype.create = function() {
      YourGame.__super__.create.call(this);
      this.game.physics.startSystem(Phaser.Physics.P2JS);
      this.game.world.setBounds(0, -100000, 19200000, 19200000);
      this.socleO = new Phacker.Game.Socle(this.game);
      return this.platform = this.socleO.set_group();

      /*
      
      #.----------.----------
       * player
      @gusO = new Phacker.Game.Player(@game, @game.gus.x0, @game.gus.y0) # instance obj@ge.GusO = new Phacker.Game.gus(game, @ge.stepsO.x0+20, @ge.stepsO.y0-40); # instance obj
      @gusO.reset()
      @gus = @gusO.set() #define 'player'
      @socleO.bind(@gus)
      
      #.----------.----------
      #steps and stairs
      @stepsO = new Phacker.Game.Steps @game
      @stairs = @stepsO.stairs() # all the physical steps are here
      
      #.----------.----------
       * introduce bubbles or bonus
      @bblO = new Phacker.Game.Bubbles @game # the object
      @bbls = @bblO.init_bbls()
      @gusO.bind_bbl(@bblO)
      
      #.----------.----------
       * audio
      @cd = new Phacker.Game.A_sound @game, 'bs_audio'
      #@cd.play 'over'
      
      
      
       *  LOGIC OF YOUR GAME
      
       * Examples buttons actions
      
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
       */
    };

    return YourGame;

  })(Phacker.GameState);

}).call(this);

(function() {
  var game;

  game = new Phacker.Game();

  game.setGameState(YourGame);

  game.setSpecificAssets(function() {
    var aud, dsk, ld, mob;
    this._fle_ = 'specific asset';
    dsk = "products/your-game/design/desktop/desktop_gameplay/";
    mob = "products/your-game/design/mobile/mobile_gameplay/";
    aud = "products/your-game/game/audio/";
    ld = this.game.load;
    this.game.fullscreen = this.game.width < 377;
    this.game.rnd_int = function(min, max) {
      return this.rnd.integerInRange(min, max);
    };
    if (this.game.fullscreen) {
      ld.image('sky', mob + 'bg_gameplay.jpg');
    } else {
      ld.image('sky', dsk + 'bg_gameplay.jpg');
    }
    ld.spritesheet('star', dsk + 'bonus/star_bonus.png', 27, 27, 2);
    ld.spritesheet('bubble', dsk + 'bonus/coin_bonus.png', 20, 20, 7);
    ld.spritesheet('lens', dsk + 'bonus/telescope_bonus.png', 31, 38, 1);
    ld.image('stepS', dsk + 'platform/platform3.png');
    ld.image('stepL', dsk + 'platform/platform4.png');
    ld.image('stepXL', dsk + 'platform/platform2.png');
    ld.spritesheet('jmp_btn', dsk + 'Jump_btn.png', 200, 57, 2);
    ld.spritesheet('gus', dsk + 'character_sprite/character_sprite.png', 42, 55, 6);
    ld.audio('bs_audio', [aud + 'bs.mp3', aud + 'bs.ogg']);
    this.game.jmp_btn = {
      x: (this.game.width - 200) / 2,
      y: this.game.height - 80
    };
    this.game.step_p = {
      dy: 25,
      dx: 40,
      y0: this.game.jmp_btn.y - 20,
      x0: 40,
      width: 80
    };
    this.game.gus = {
      vy: -82,
      vx: 130,
      x0: 0,
      y0: this.game.step_p.y0 - 80,
      gravity: 100,
      is_down: false,
      drag: 35,
      mini_height_to_score: this.game.step_p.y0 - 50
    };
    this.game.bbl_p = {
      dy: -60,
      dx: 120,
      gravity: 25
    };
    game.setTextColorGameOverState('white');
    game.setTextColorWinState('white');
    game.setTextColorStatus('orange');
    game.setOneTwoThreeColor('darkblue');
    game.setLoaderColor(0xffffff);
    game.setTimerColor(0x00416b);
    return game.setTimerBgColor(0xffffff);
  });

  this.pauseGame = function() {
    return game.game.paused = true;
  };

  this.replayGame = function() {
    return game.game.paused = false;
  };

  game.run();

}).call(this);
