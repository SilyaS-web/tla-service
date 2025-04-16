<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Змейка</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/snake.css?v=2">
</head>
<body>
    <div class="wrapper">
        <div class="score">
                <div class="score__num">
                    <span class="score__simple">000</span>
                    <p class="score__bonus"><span>0</span>/30</p>
                </div>
                <div class="score__progress-bar progress-bar">
                    <div class="progress-bar__items">
                        <div class="progress-bar__item progress-bar__main">
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                            <div class="progress-bar__main-item"></div>
                        </div>
                        <div class="progress-bar__item progress-bar__bonus">
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                            <div class="progress-bar__bonus-item"></div>
                        </div>
                    </div>
                </div>
                <div class="question">
                    <img src="/images/snake/icon-question.png" alt="">
                </div>
            </div>
            <div class="stage"></div>
        </body>
        <div
            id="popup-instruction"
            class="popup">
            <div class="popup__content">
                <div class="popup__header">
                    <div class="popup__title">
                        Игра "Змейка"
                    </div>
                </div>
                <div class="popup__body">
                    <p>
                        Перед вами игра змейка, суть которой собирать <b class="--red">красные</b> и <b class="--gold">золотые</b> квадратики.
                    </p>
                    <p><b>Один красный квадрат = Один балл</b></p>
                    <p><b>Один золотой квадрат = Пять бонусных рублей, которые можно использовать в клубе</b></p>
                    <p>
                        Бонусные рубли можно собирать раз в трое суток
                    </p>
                    <p>
                        Для управления змейкой используйте стрелки, либо свайпы в стороны.
                    </p>
                </div>
                <div class="popup__footer">
                    <button class="btn popup-btn primary">Понятно</button>
                </div>
            </div>
        </div>
        <div
            id="popup-ended"
            class="popup">
            <div class="popup__content">
                <div class="popup__header">
                    <div class="popup__title">
                        Игра окончена!
                    </div>
                </div>
                <div class="popup__body">
                    <p>Игра окончена! Вас счет: <span id="score">1</span></p>
                </div>
                <div class="popup__footer">
                    <button class="btn primary popup-btn">Начать заново</button>
                    <button class="btn secondary popup-btn">Забрать бонусы</button>
                </div>
            </div>
        </div>
        <div class="logo">
            <img src="/images/snake/logo.png" alt="">
        </div>
    </div>
<script>
/*================================================

Polyfill

================================================*/

(function(){ 'use strict';

    /*================================================

    Request Animation Frame

    ================================================*/

    var lastTime = 0;
    var vendors = [ 'webkit', 'moz' ];
    for( var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x ) {
        window.requestAnimationFrame = window[ vendors[ x ] + 'RequestAnimationFrame' ];
        window.cancelAnimationFrame = window[ vendors[ x ] + 'CancelAnimationFrame' ] || window[ vendors[ x ] + 'CancelRequestAnimationFrame' ];
    }

    if( !window.requestAnimationFrame ) {
        window.requestAnimationFrame = function( callback, element ) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max( 0, 16 - ( currTime - lastTime ) );
            var id = window.setTimeout(
                function() {
                    callback( currTime + timeToCall );
                }, timeToCall );
            lastTime = currTime + timeToCall;
            return id;
        }
    }

    if( !window.cancelAnimationFrame ) {
        window.cancelAnimationFrame = function( id ) {
            clearTimeout( id );
        }
    }

})();

/*================================================

DOM Manipulation

================================================*/

(function(){ 'use strict';

    function hasClass( elem, className ) {
        return new RegExp( ' ' + className + ' ' ).test( ' ' + elem.className + ' ' );
    };

    function addClass( elem, className ) {
        if( !hasClass(elem, className ) ) {
            elem.className += ' ' + className;
        }
    };

    function removeClass( elem, className ) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ' ) + ' ';
        if( hasClass( elem, className ) ) {
            while( newClass.indexOf(' ' + className + ' ' ) >= 0 ) {
                newClass = newClass.replace( ' ' + className + ' ', ' ' );
            }
            elem.className = newClass.replace( /^\s+|\s+$/g, '' );
        }
    };

    function toggleClass( elem, className ) {
        var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ' ) + ' ';
        if( hasClass(elem, className ) ) {
            while( newClass.indexOf( ' ' + className + ' ' ) >= 0 ) {
                newClass = newClass.replace( ' ' + className + ' ' , ' ' );
            }
            elem.className = newClass.replace( /^\s+|\s+$/g, '' );
        } else {
            elem.className += ' ' + className;
        }
    };

})();

/*================================================

Core

================================================*/

g = {};

(function(){ 'use strict';

    /*================================================

    Math

    ================================================*/

    g.m = Math;
    g.mathProps = 'E LN10 LN2 LOG2E LOG10E PI SQRT1_2 SQRT2 abs acos asin atan ceil cos exp floor log round sin sqrt tan atan2 pow max min'.split( ' ' );
    for ( var i = 0; i < g.mathProps.length; i++ ) {
        g[ g.mathProps[ i ] ] = g.m[ g.mathProps[ i ] ];
    }
    g.m.TWO_PI = g.m.PI * 2;

    /*================================================

    Miscellaneous

    ================================================*/

    g.isset = function( prop ) {
        return typeof prop != 'undefined';
    };

    g.log = function() {
        if( g.isset( g.config ) && g.config.debug && window.console ){
            console.log( Array.prototype.slice.call( arguments ) );
        }
    };

})();

/*================================================

Group

================================================*/

(function(){ 'use strict';

    g.Group = function() {
        this.collection = [];
        this.length = 0;
    };

    g.Group.prototype.add = function( item ) {
        this.collection.push( item );
        this.length++;
    };

    g.Group.prototype.remove = function( index ) {
        if( index < this.length ) {
            this.collection.splice( index, 1 );
            this.length--;
        }
    };

    g.Group.prototype.empty = function() {
        this.collection.length = 0;
        this.length = 0;
    };

    g.Group.prototype.each = function( action, asc ) {
        var asc = asc || 0,
            i;
        if( asc ) {
            for( i = 0; i < this.length; i++ ) {
                this.collection[ i ][ action ]( i );
            }
        } else {
            i = this.length;
            while( i-- ) {
                this.collection[ i ][ action ]( i );
            }
        }
    };

})();

/*================================================

Utilities

================================================*/

(function(){ 'use strict';

    g.util = {};

    /*================================================

    Random

    ================================================*/

    g.util.rand = function( min, max ) {
        return g.m.random() * ( max - min ) + min;
    };

    g.util.randInt = function( min, max ) {
        return g.m.floor( g.m.random() * ( max - min + 1) ) + min;
    };

}());

/*================================================

State

================================================*/

(function(){ 'use strict';

    g.states = {};

    g.addState = function( state ) {
        g.states[ state.name ] = state;
    };

    g.setState = function( name ) {
        if( g.state ) {
            g.states[ g.state ].exit();
        }
        g.state = name;
        g.states[ g.state ].init();
    };

    g.currentState = function() {
        return g.states[ g.state ];
    };

}());

/*================================================

Time

================================================*/

(function(){ 'use strict';

    g.Time = function() {
        this.reset();
    }

    g.Time.prototype.reset = function() {
        this.now = Date.now();
        this.last = Date.now();
        this.delta = 60;
        this.ndelta = 1;
        this.elapsed = 0;
        this.nelapsed = 0;
        this.tick = 0;
    };

    g.Time.prototype.update = function() {
        this.now = Date.now();
        this.delta = this.now - this.last;
        this.ndelta = Math.min( Math.max( this.delta / ( 1000 / 60 ), 0.0001 ), 10 );
        this.elapsed += this.delta;
        this.nelapsed += this.ndelta;
        this.last = this.now;
        this.tick++;
    };

})();

/*================================================

Grid Entity

================================================*/

(function(){ 'use strict';

    g.Grid = function( cols, rows ) {
        this.cols = cols;
        this.rows = rows;
        this.tiles = [];
        for( var x = 0; x < cols; x++ ) {
            this.tiles[ x ] = [];
            for( var y = 0; y < rows; y++ ) {
                this.tiles[ x ].push( 'empty' );
            }
        }
    };

    g.Grid.prototype.get = function( x, y ) {
        return this.tiles[ x ][ y ];
    };

    g.Grid.prototype.set = function( x, y, val ) {
        this.tiles[ x ][ y ] = val;
    };

})();

/*================================================

Board Tile Entity

================================================*/

(function(){ 'use strict';

    g.BoardTile = function( opt ) {
        this.parentState = opt.parentState;
        this.parentGroup = opt.parentGroup;
        this.col = opt.col;
        this.row = opt.row;
        this.x = opt.x;
        this.y = opt.y;
        this.z = 0;
        this.w = opt.w;
        this.h = opt.h;
        this.elem = document.createElement( 'div' );
        this.elem.style.position = 'absolute';
        this.elem.className = 'tile';
        this.parentState.stageElem.appendChild( this.elem );
        this.classes = {
            pressed: 0,
            path: 0,
            up: 0,
            down: 0,
            left: 0,
            right: 0
        }
        this.updateDimensions();
    };

    g.BoardTile.prototype.update = function() {
        for( var k in this.classes ) {
            if( this.classes[ k ] ) {
                this.classes[ k ]--;
            }
        }

        if( this.parentState.food.tile.col == this.col || this.parentState.food.tile.row == this.row ) {
            this.classes.path = 1;
            if( this.col < this.parentState.food.tile.col ) {
                this.classes.right = 1;
            } else {
                this.classes.right = 0;
            }
            if( this.col > this.parentState.food.tile.col ) {
                this.classes.left = 1;
            } else {
                this.classes.left = 0;
            }
            if( this.row > this.parentState.food.tile.row ) {
                this.classes.up = 1;
            } else {
                this.classes.up = 0;
            }
            if( this.row < this.parentState.food.tile.row ) {
                this.classes.down = 1;
            } else {
                this.classes.down = 0;
            }
        } else {
            this.classes.path = 0;
        }

        if( this.parentState.food.eaten ) {
            this.classes.path = 0;
        }
    };

    g.BoardTile.prototype.updateDimensions = function() {
        this.x = this.col * this.parentState.tileWidth;
        this.y = this.row * this.parentState.tileHeight;
        this.w = this.parentState.tileWidth - this.parentState.spacing;
        this.h = this.parentState.tileHeight - this.parentState.spacing;
        this.elem.style.left = this.x + 'px';
        this.elem.style.top = this.y + 'px';
        this.elem.style.width = this.w + 'px';
        this.elem.style.height = this.h + 'px';
    };

    g.BoardTile.prototype.render = function() {
        var classString = '';
        for( var k in this.classes ) {
            if( this.classes[ k ] ) {
                classString += k + ' ';
            }
        }
        this.elem.className = 'tile ' + classString;
    };

})();

/*================================================

Snake Tile Entity

================================================*/

(function(){ 'use strict';

    g.SnakeTile = function( opt ) {
        this.parentState = opt.parentState;
        this.parentGroup = opt.parentGroup;
        this.col = opt.col;
        this.row = opt.row;
        this.x = opt.x;
        this.y = opt.y;
        this.w = opt.w;
        this.h = opt.h;
        this.color = null;
        this.scale = 1;
        this.rotation = 0;
        this.blur = 0;
        this.alpha = 1;
        this.borderRadius = 0;
        this.borderRadiusAmount = 0;
        this.elem = document.createElement( 'div' );
        this.elem.style.position = 'absolute';
        this.parentState.stageElem.appendChild( this.elem );
    };

    g.SnakeTile.prototype.update = function( i ) {
        this.x = this.col * this.parentState.tileWidth;
        this.y = this.row * this.parentState.tileHeight;
        if( i == 0 ) {
            this.color = '#fff';
            this.blur = this.parentState.dimAvg * 0.03 + Math.sin( this.parentState.time.elapsed / 200 ) * this.parentState.dimAvg * 0.015;
            if( this.parentState.snake.dir == 'n' ) {
                this.borderRadius = this.borderRadiusAmount + '% ' + this.borderRadiusAmount + '% 0 0';
            } else if( this.parentState.snake.dir == 's' ) {
                this.borderRadius = '0 0 ' + this.borderRadiusAmount + '% ' + this.borderRadiusAmount + '%';
            } else if( this.parentState.snake.dir == 'e' ) {
                this.borderRadius = '0 ' + this.borderRadiusAmount + '% ' + this.borderRadiusAmount + '% 0';
            } else if( this.parentState.snake.dir == 'w' ) {
                this.borderRadius = this.borderRadiusAmount + '% 0 0 ' + this.borderRadiusAmount + '%';
            }
        } else {
            this.color = '#fff';
            this.blur = 0;
            this.borderRadius = '0';
        }
        this.alpha = 1 - ( i / this.parentState.snake.tiles.length ) * 0.6;
        this.rotation = ( this.parentState.snake.justAteTick / this.parentState.snake.justAteTickMax ) * 90;
        this.scale = 1 + ( this.parentState.snake.justAteTick / this.parentState.snake.justAteTickMax ) * 1;
    };

    g.SnakeTile.prototype.updateDimensions = function() {
        this.w = this.parentState.tileWidth - this.parentState.spacing;
        this.h = this.parentState.tileHeight - this.parentState.spacing;
    };

    g.SnakeTile.prototype.render = function( i ) {
        this.elem.style.left = this.x + 'px';
        this.elem.style.top = this.y + 'px';
        this.elem.style.width = this.w + 'px';
        this.elem.style.height = this.h + 'px';
        this.elem.style.backgroundColor = 'rgba(0,255,240, ' + this.alpha + ')';
        this.elem.style.boxShadow = '0 0 ' + this.blur + 'px #fff';
        this.elem.style.borderRadius = this.borderRadius;
    };

})();

/*================================================

Food Tile Entity

================================================*/

(function(){ 'use strict';

    g.FoodTile = function( opt ) {
        this.parentState = opt.parentState;
        this.parentGroup = opt.parentGroup;
        this.col = opt.col;
        this.row = opt.row;
        this.x = opt.x;
        this.y = opt.y;
        this.w = opt.w;
        this.h = opt.h;
        this.blur = 0;
        this.scale = 1;
        this.hue = opt.hue;
        this.bgc = opt.bgc;
        this.opacity = 0;
        this.elem = document.createElement( 'div' );
        this.elem.style.position = 'absolute';
        this.parentState.stageElem.appendChild( this.elem );
    };

    g.FoodTile.prototype.update = function() {
        this.x = this.col * this.parentState.tileWidth;
        this.y = this.row * this.parentState.tileHeight;
        this.blur = this.parentState.dimAvg * 0.03 + Math.sin( this.parentState.time.elapsed / 200 ) * this.parentState.dimAvg * 0.015;
        this.scale = 0.8 + Math.sin( this.parentState.time.elapsed / 200 ) * 0.2;

        if( this.parentState.food.birthTick || this.parentState.food.deathTick ) {
            if( this.parentState.food.birthTick ) {
                this.opacity = 1 - ( this.parentState.food.birthTick / 1 ) * 1;
            } else {
                this.opacity = ( this.parentState.food.deathTick / 1 ) * 1;
            }
        } else {
            this.opacity = 1;
        }
    };

    g.FoodTile.prototype.updateDimensions = function() {
        this.w = this.parentState.tileWidth - this.parentState.spacing;
        this.h = this.parentState.tileHeight - this.parentState.spacing;
    };

    g.FoodTile.prototype.render = function() {
        this.elem.style.left = this.x + 'px';
        this.elem.style.top = this.y + 'px';
        this.elem.style.width = this.w + 'px';
        this.elem.style.height = this.h + 'px';
        this.elem.style[ 'transform' ] = 'translateZ(0) scale(' + this.scale + ')';
        this.elem.style.backgroundColor = this.bgc;
        this.elem.style.boxShadow = '0 0 ' + this.blur + 'px hsla(' + this.hue + ', 100%, 60%, 1)';
        this.elem.style.opacity = this.opacity;
    };

})();

/*================================================

Snake Entity

================================================*/

(function(){ 'use strict';

    g.Snake = function( opt ) {
        this.parentState = opt.parentState;
        this.dir = 'e',
        this.currDir = this.dir;
        this.tiles = [];
        for( var i = 0; i < 5; i++ ) {
            this.tiles.push( new g.SnakeTile({
                parentState: this.parentState,
                parentGroup: this.tiles,
                col: 8 - i,
                row: 3,
                x: ( 8 - i ) * opt.parentState.tileWidth,
                y: 3 * opt.parentState.tileHeight,
                w: opt.parentState.tileWidth - opt.parentState.spacing,
                h: opt.parentState.tileHeight - opt.parentState.spacing
            }));
        }
        this.last = 0;
        this.updateTick = 10;
        this.updateTickMax = this.updateTick;
        this.updateTickLimit = 3;
        this.updateTickChange = 0.05;
        this.deathFlag = 0;
        this.justAteTick = 0;
        this.justAteTickMax = 1;
        this.justAteTickChange = 0.05;

        // sync data grid of the play state
        var i = this.tiles.length;

        while( i-- ) {
            this.parentState.grid.set( this.tiles[ i ].col, this.tiles[ i ].row, 'snake' );
        }
    };

    g.Snake.prototype.updateDimensions = function() {
        var i = this.tiles.length;
        while( i-- ) {
            this.tiles[ i ].updateDimensions();
        }
    };

    g.Snake.prototype.update = function() {
        if( this.parentState.keys.up ) {
            if( this.dir != 's' && this.dir != 'n' && this.currDir != 's' && this.currDir != 'n' ) {
                this.dir = 'n';
            }
        } else if( this.parentState.keys.down) {
            if( this.dir != 'n' && this.dir != 's' && this.currDir != 'n' && this.currDir != 's' ) {
                this.dir = 's';
            }
        } else if( this.parentState.keys.right ) {
            if( this.dir != 'w' && this.dir != 'e' && this.currDir != 'w' && this.currDir != 'e' ) {
                this.dir = 'e';
            }
        } else if( this.parentState.keys.left ) {
            if( this.dir != 'e' && this.dir != 'w' && this.currDir != 'e' && this.currDir != 'w' ) {
                this.dir = 'w';
            }
        }

        this.parentState.keys.up = 0;
        this.parentState.keys.down = 0;
        this.parentState.keys.right = 0;
        this.parentState.keys.left = 0;

        this.updateTick += this.parentState.time.ndelta;
        if( this.updateTick >= this.updateTickMax ) {
            // reset the update timer to 0, or whatever leftover there is
            this.updateTick = ( this.updateTick - this.updateTickMax );

            // rotate snake block array
            this.tiles.unshift( new g.SnakeTile({
                parentState: this.parentState,
                parentGroup: this.tiles,
                col: this.tiles[ 0 ].col,
                row: this.tiles[ 0 ].row,
                x: this.tiles[ 0 ].col * this.parentState.tileWidth,
                y: this.tiles[ 0 ].row * this.parentState.tileHeight,
                w: this.parentState.tileWidth - this.parentState.spacing,
                h: this.parentState.tileHeight - this.parentState.spacing
            }));
            this.last = this.tiles.pop();
            this.parentState.stageElem.removeChild( this.last.elem );

            this.parentState.boardTiles.collection[ this.last.col + ( this.last.row * this.parentState.cols ) ].classes.pressed = 2;

            // sync data grid of the play state
            var i = this.tiles.length;

            while( i-- ) {
                this.parentState.grid.set( this.tiles[ i ].col, this.tiles[ i ].row, 'snake' );
            }
            this.parentState.grid.set( this.last.col, this.last.row, 'empty' );


            // move the snake's head
            if ( this.dir == 'n' ) {
                this.currDir = 'n';
                this.tiles[ 0 ].row -= 1;
            } else if( this.dir == 's' ) {
                this.currDir = 's';
                this.tiles[ 0 ].row += 1;
            } else if( this.dir == 'w' ) {
                this.currDir = 'w';
                this.tiles[ 0 ].col -= 1;
            } else if( this.dir == 'e' ) {
                this.currDir = 'e';
                this.tiles[ 0 ].col += 1;
            }

            // wrap walls
            this.wallFlag = false;
            if( this.tiles[ 0 ].col >= this.parentState.cols ) {
                this.tiles[ 0 ].col = 0;
                this.wallFlag = true;
            }
            if( this.tiles[ 0 ].col < 0 ) {
                this.tiles[ 0 ].col = this.parentState.cols - 1;
                this.wallFlag = true;
            }
            if( this.tiles[ 0 ].row >= this.parentState.rows ) {
                this.tiles[ 0 ].row = 0;
                this.wallFlag = true;
            }
            if( this.tiles[ 0 ].row < 0 ) {
                this.tiles[ 0 ].row = this.parentState.rows - 1;
                this.wallFlag = true;
            }

            // check death by eating self
            if( this.parentState.grid.get( this.tiles[ 0 ].col, this.tiles[ 0 ].row ) == 'snake' ) {
                this.parentState.isGamePaused = true;

                const saveData = {
                    score: this.parentState.score,
                    bonusScore: this.parentState.bonusScore,
                    chatID: this.parentState.chatID,
                }

                EndGamePopup(saveData)
            }

            // check eating of food
            if( this.parentState.grid.get( this.tiles[ 0 ].col, this.tiles[ 0 ].row ) == 'bonus' ) {
                this.tiles.push( new g.SnakeTile({
                    parentState: this.parentState,
                    parentGroup: this.tiles,
                    col: this.last.col,
                    row: this.last.row,
                    x: this.last.col * this.parentState.tileWidth,
                    y: this.last.row * this.parentState.tileHeight,
                    w: this.parentState.tileWidth - this.parentState.spacing,
                    h: this.parentState.tileHeight - this.parentState.spacing
                }));
                if( this.updateTickMax - this.updateTickChange > this.updateTickLimit ) {
                    this.updateTickMax -= this.updateTickChange;
                }

                if(this.parentState.bonusScore + 5 <= 30) {
                    this.parentState.bonusScore += 5;
                    this.parentState.updateBonusScore();
                }

                this.justAteTick = this.justAteTickMax;

                this.parentState.stageElem.removeChild( this.parentState.bonus.tile.elem );
                this.parentState.bonus = null;

                this.parentState.bonusTicksUntilCreate = this.parentState.defaultBonusTicksUntilCreate;
                this.parentState.bonusTicksUntilDelete = this.parentState.defaultBonusTicksUntilDelete;

                document.querySelector('.progress-bar__bonus').style.opacity = '0';
                document.querySelectorAll('.progress-bar__bonus-item').forEach(item => item.style.opacity = '1');
            }

            // check eating of food
            if( this.parentState.grid.get( this.tiles[ 0 ].col, this.tiles[ 0 ].row ) == 'food' ) {
                this.tiles.push( new g.SnakeTile({
                    parentState: this.parentState,
                    parentGroup: this.tiles,
                    col: this.last.col,
                    row: this.last.row,
                    x: this.last.col * this.parentState.tileWidth,
                    y: this.last.row * this.parentState.tileHeight,
                    w: this.parentState.tileWidth - this.parentState.spacing,
                    h: this.parentState.tileHeight - this.parentState.spacing
                }));
                if( this.updateTickMax - this.updateTickChange > this.updateTickLimit ) {
                    this.updateTickMax -= this.updateTickChange;
                }
                this.parentState.score++;

                this.parentState.updateScore();

                this.justAteTick = this.justAteTickMax;

                this.parentState.food.eaten = 1;
                this.parentState.stageElem.removeChild( this.parentState.food.tile.elem );

                var _this = this;

                this.foodCreateTimeout = setTimeout( function() {
                    _this.parentState.food = new g.Food({
                        parentState: _this.parentState
                    });
                }, 300);
            }

            // check death by eating self
            if( this.deathFlag ) {
                g.setState( 'play' );
            }
        }

        // update individual snake tiles
        var i = this.tiles.length;
        while( i-- ) {
            this.tiles[ i ].update( i );
        }

        if( this.justAteTick > 0 ) {
            this.justAteTick -= this.justAteTickChange;
        } else if( this.justAteTick < 0 ) {
            this.justAteTick = 0;
        }
    };

    g.Snake.prototype.render = function() {
        // render individual snake tiles
        var i = this.tiles.length;
        while( i-- ) {
            this.tiles[ i ].render( i );
        }
    };

})();

/*================================================

Food Entity

================================================*/

(function(){ 'use strict';

    g.Food = function( opt ) {
        this.parentState = opt.parentState;
        this.tile = new g.FoodTile({
            parentState: this.parentState,
            hue: 10,
            bgc: 'hsla(10, 100%, 51%, 1)',
            col: 0,
            row: 0,
            x: 0,
            y: 0,
            w: opt.parentState.tileWidth - opt.parentState.spacing,
            h: opt.parentState.tileHeight - opt.parentState.spacing
        });
        this.reset();
        this.eaten = 0;
        this.birthTick = 1;
        this.deathTick = 0;
        this.birthTickChange = 0.025;
        this.deathTickChange = 0.05;
    };

    g.Food.prototype.reset = function() {
        var empty = [];
        for( var x = 0; x < this.parentState.cols; x++) {
            for( var y = 0; y < this.parentState.rows; y++) {
                var tile = this.parentState.grid.get( x, y );
                if( tile == 'empty' ) {
                    empty.push( { x: x, y: y } );
                }
            }
        }
        var newTile = empty[ g.util.randInt( 0, empty.length - 1 ) ];
        this.tile.col = newTile.x;
        this.tile.row = newTile.y;
    };

    g.Food.prototype.updateDimensions = function() {
        this.tile.updateDimensions();
    };

    g.Food.prototype.update = function() {
        // update food tile
        this.tile.update();

        if( this.birthTick > 0 ) {
            this.birthTick -= this.birthTickChange;
        } else if( this.birthTick < 0 ) {
            this.birthTick = 0;
        }

        // sync data grid of the play state
        this.parentState.grid.set( this.tile.col, this.tile.row, 'food' );
    };

    g.Food.prototype.render = function() {
        this.tile.render();
    };

})();


(function(){ 'use strict';

    g.Bonus = function( opt ) {
        this.parentState = opt.parentState;
        this.tile = this.tile = new g.FoodTile({
            parentState: this.parentState,
            col: 0,
            row: 0,
            hue: 40,
            bgc:'hsla(40, 99%, 49%, 1)',
            x: 0,
            y: 0,
            w: opt.parentState.tileWidth - opt.parentState.spacing,
            h: opt.parentState.tileHeight - opt.parentState.spacing
        });
        this.reset();
        this.eaten = 0;
        this.birthTick = 1;
        this.deathTick = 0;
        this.birthTickChange = 0.025;
        this.deathTickChange = 0.05;
        this.ticksUntilDelete = 5000;
        this.defaultTicksUntilDelete = 5000;
    };

    g.Bonus.prototype.reset = function() {
        var empty = [];
        for( var x = 0; x < this.parentState.cols; x++) {
            for( var y = 0; y < this.parentState.rows; y++) {
                var tile = this.parentState.grid.get( x, y );
                if( tile == 'empty' ) {
                    empty.push( { x: x, y: y } );
                }
            }
        }
        var newTile = empty[ g.util.randInt( 0, empty.length - 1 ) ];
        this.tile.col = newTile.x;
        this.tile.row = newTile.y;
    };

    g.Bonus.prototype.updateDimensions = function() {
        this.tile.updateDimensions();
    };

    g.Bonus.prototype.update = function() {
        this.tile.update();

        if( this.birthTick > 0 ) {
            this.birthTick -= this.birthTickChange;
        } else if( this.birthTick < 0 ) {
            this.birthTick = 0;
        }

        this.parentState.grid.set( this.tile.col, this.tile.row, 'bonus' );
    };

    g.Bonus.prototype.remove = function() {
        this.parentState.stageElem.removeChild( this.parentState.bonus.tile.elem );

        this.parentState.grid.set( this.tile.col, this.tile.row, 'tile' );
    };

    g.Bonus.prototype.render = function() {
        this.tile.render();
    };

})();

/*================================================

Play State

================================================*/

(function(){ 'use strict';

    function StatePlay() {
        this.name = 'play';
    }

    function delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    StatePlay.prototype.init = async function () {
        await delay(3000);
        this.scoreElem = document.querySelector('.score');
        this.stageElem = document.querySelector('.stage');
        this.isGamePaused = false;
        this.xDown = null;
        this.yDown = null;
        this.dimLong = 28;
        this.dimShort = 16;
        this.padding = 0.25;
        this.boardTiles = new g.Group();
        this.keys = {};
        this.foodCreateTimeout = null;
        this.score = 0;
        this.bonusScore = 0;
        this.time = new g.Time();
        this.getDimensions();
        if (this.winWidth < this.winHeight) {
            this.rows = this.dimLong;
            this.cols = this.dimShort;
        } else {
            this.rows = this.dimShort;
            this.cols = this.dimLong;
        }
        this.spacing = 1;
        this.grid = new g.Grid(this.cols, this.rows);
        this.maxBonusCount = this.cols * this.rows - 5
        this.resize();
        this.createBoardTiles();
        this.bindEvents();
        this.snake = new g.Snake({
            parentState: this
        });
        this.food = new g.Food({
            parentState: this
        });

        this.bonusTicksUntilDelete = 750;
        this.defaultBonusTicksUntilDelete = 750;
        this.bonusTicksUntilCreate = 2000;
        this.defaultBonusTicksUntilCreate = 2000;

        this.bonusScore = null

        this.chatID = null

        this.updateScore()
    };

    StatePlay.prototype.getDimensions = function() {
        this.winWidth = window.innerWidth;
        this.winHeight = window.innerHeight;
        this.activeWidth = this.winWidth - ( this.winWidth * this.padding );
        this.activeHeight = this.winHeight - ( this.winHeight * this.padding );
    };

    StatePlay.prototype.updateScore = async function() {
        var _this = g.currentState();

        if(_this.score >= 10) {
            _this.scoreElem.querySelector('.score__num .score__simple').innerHTML = `0${_this.score}`
        }
        else{
            _this.scoreElem.querySelector('.score__num .score__simple').innerHTML = `00${_this.score}`
        }

        //progress bar
        const progressBarItems = document.querySelectorAll('.progress-bar__main-item');
        const filledItemsCount = Math.floor(_this.score / progressBarItems.length);

        for (let i = 0; i < filledItemsCount; i++){
            progressBarItems[i].style.opacity = '1';
        }

        const remainedScore = (_this.score / progressBarItems.length) - filledItemsCount;

        if(remainedScore > 0){
            progressBarItems[filledItemsCount].style.opacity = `${remainedScore}`;
        }
    };

    StatePlay.prototype.updateBonusScore = async function() {
        var _this = g.currentState();

        document.querySelector('.score__bonus span').innerHTML = _this.bonusScore
    };

    StatePlay.prototype.resize = function() {
        var _this = g.currentState();

        _this.getDimensions();

        _this.stageRatio = _this.rows / _this.cols;

        if( _this.activeWidth > _this.activeHeight / _this.stageRatio ) {
            _this.stageHeight = _this.activeHeight;
            _this.stageElem.style.height = _this.stageHeight + 'px';
            _this.stageWidth = Math.floor( _this.stageHeight /_this.stageRatio );
            _this.stageElem.style.width = _this.stageWidth + 'px';
            _this.scoreElem.style.width = _this.stageWidth + 'px';
        } else {
            _this.stageWidth = _this.activeWidth;
            _this.stageElem.style.width = _this.stageWidth + 'px';
            _this.scoreElem.style.width = _this.stageWidth + 'px';
            _this.stageHeight = Math.floor( _this.stageWidth * _this.stageRatio );
            _this.stageElem.style.height = _this.stageHeight + 'px';
        }

        _this.tileWidth = ~~( _this.stageWidth / _this.cols );
        _this.tileHeight = ~~( _this.stageHeight / _this.rows );
        _this.dimAvg = ( _this.activeWidth + _this.activeHeight ) / 2;
        _this.spacing = Math.max( 1, ~~( _this.dimAvg * 0.0025 ) );

        _this.stageElem.style.marginTop = ( -_this.stageElem.offsetHeight / 2 ) + _this.headerHeight / 2 + 'px';

        _this.boardTiles.each( 'updateDimensions' );
        _this.snake !== undefined && _this.snake.updateDimensions();
        _this.food !== undefined && _this.food.updateDimensions();
    };

    StatePlay.prototype.createBoardTiles = function() {
        for( var y = 0; y < this.rows; y++ ) {
            for( var x = 0; x < this.cols; x++ ) {
                this.boardTiles.add( new g.BoardTile({
                    parentState: this,
                    parentGroup: this.boardTiles,
                    col: x,
                    row: y,
                    x: x * this.tileWidth,
                    y: y * this.tileHeight,
                    w: this.tileWidth - this.spacing,
                    h: this.tileHeight - this.spacing
                }));
            }
        }
    };

    StatePlay.prototype.upOn = function() { g.currentState().keys.up = 1; }
    StatePlay.prototype.downOn = function() { g.currentState().keys.down = 1; }
    StatePlay.prototype.rightOn = function() { g.currentState().keys.right = 1; }
    StatePlay.prototype.leftOn = function() { g.currentState().keys.left = 1; }
    StatePlay.prototype.upOff = function() { g.currentState().keys.up = 0; }
    StatePlay.prototype.downOff = function() { g.currentState().keys.down = 0; }
    StatePlay.prototype.rightOff = function() { g.currentState().keys.right = 0; }
    StatePlay.prototype.leftOff = function() { g.currentState().keys.left = 0; }

    StatePlay.prototype.keydown = function( e ) {
        e.preventDefault();
        var e = ( e.keyCode ? e.keyCode : e.which ),
            _this = g.currentState();
        if( e === 38 || e === 87 ) { _this.upOn(); }
        if( e === 39 || e === 68 ) { _this.rightOn(); }
        if( e === 40 || e === 83 ) { _this.downOn(); }
        if( e === 37 || e === 65 ) { _this.leftOn(); }
    };

    StatePlay.prototype.handleTouchStart = function(evt){
        var _this = g.currentState();

        const firstTouch = _this.getTouches(evt)[0];

        _this.xDown = firstTouch.clientX;
        _this.yDown = firstTouch.clientY;
    }

    StatePlay.prototype.handleTouchMove = function(evt){
        var _this = g.currentState();

        if ( ! _this.xDown || ! _this.yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = _this.xDown - xUp;
        var yDiff = _this.yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
            if ( xDiff > 0 ) {
                _this.leftOn();
            } else {
                _this.rightOn();
            }
        } else {
            if ( yDiff > 0 ) {
                _this.upOn();
            } else {
                _this.downOn();
            }
        }

        _this.xDown = null;
        _this.yDown = null;
    }

    StatePlay.prototype.getTouches = function(evt) {
        return evt.touches ||             // browser API
            evt.originalEvent.touches; // jQuery
    }

    StatePlay.prototype.bindEvents = function() {
        var _this = g.currentState();

        window.addEventListener( 'keydown', _this.keydown, false );
        window.addEventListener( 'resize', _this.resize, false );

        window.addEventListener('touchstart', _this.handleTouchStart, false);
        window.addEventListener('touchmove', _this.handleTouchMove, false);
    };

    StatePlay.prototype.step = function() {
        this.boardTiles.each( 'update' );
        this.boardTiles.each( 'render' );
        this.snake.update();
        this.snake.render();
        this.food.update();
        this.food.render();
        this.time.update();

        if(this.timer) return

        if(this.bonusScore === 30) return

        if(this.bonusTicksUntilCreate === 0 && !this.bonus){
            this.bonus = new g.Bonus({
                parentState: this
            });

            this.bonusTicksUntilCreate = this.defaultBonusTicksUntilCreate

            document.querySelector('.progress-bar__bonus').style.opacity = '1';
            document.querySelectorAll('.progress-bar__bonus-item').forEach(item => item.style.opacity = '1')
        }
        else if(!this.bonus){
            this.bonusTicksUntilCreate--
        }

        if(this.bonusTicksUntilDelete === 0 && this.bonus){
            this.bonus.remove();
            this.bonus = null;

            document.querySelector('.progress-bar__bonus').style.opacity = '0';

            this.bonusTicksUntilDelete = this.defaultBonusTicksUntilDelete
        }
        else if(this.bonus){
            this.bonusTicksUntilDelete--

            const progressBarItems = document.querySelectorAll('.progress-bar__bonus-item');
            const filledItemValue = Math.floor(this.defaultBonusTicksUntilDelete / progressBarItems.length);
            const remainItemsValue = this.defaultBonusTicksUntilDelete - this.bonusTicksUntilDelete

            let itemsValueCount = 0;

            for (let i = progressBarItems.length - 1; i >= 0; i--){
                itemsValueCount+=filledItemValue;

                if(itemsValueCount <= remainItemsValue) progressBarItems[i].style.opacity = '0'

                if(itemsValueCount > remainItemsValue){
                    const valuesDiff = itemsValueCount - remainItemsValue;

                    progressBarItems[i].style.opacity = `${((valuesDiff * 100) / filledItemValue) / 100}`
                }
            }
        }

        if(this.bonus){
            this.bonus.update();
            this.bonus.render();
        }
    };

    StatePlay.prototype.exit = function() {
        window.removeEventListener( 'keydown', this.keydown, false );
        window.removeEventListener( 'resize', this.resize, false );
        this.stageElem.innerHTML = '';
        this.grid.tiles = null;
        this.time = null;
    };

    g.addState( new StatePlay() );

})();

/*================================================

App

================================================*/

(function(){ 'use strict';
    g.config = {
        title: 'Snakely',
        debug: window.location.hash == '#debug' ? 1 : 0,
        state: 'play'
    };

    g.setState( g.config.state );

    g.time = new g.Time();

    const chatID = getUrlParameter('chat_id');

    if(!chatID){
        throw new Error('Отсутствует айди чата')
    }

    g.config.chatID = chatID

    g.currentState().chatID = chatID;

    g.step = function() {
        const gameState = g.currentState();

        if(gameState.isGamePaused) return;

        requestAnimationFrame( g.step );
        g.states[ g.state ].step();

        g.time.update();
    };

    window.addEventListener( 'load', async function(){
        const timerParams = new URLSearchParams({ chat_id: chatID }).toString()
        const timer = await fetch('https://lk.adswap.ru/api/snake-game/timer?' + timerParams).then((res) => res.json()).then((json) => json.result.timer)

        if(timer){
            g.currentState().timer = timer
        }

        if(timer){
            const timerElem = document.querySelector('.score__bonus');

            const diffTimestamp = new Date().getTime() + Math.abs(timer);

            let currentDiff = (diffTimestamp - Date.now()) / 1000;

            let days = Math.floor(currentDiff / 86400);
            currentDiff -= days * 86400;

            let hours = Math.floor(currentDiff / 3600) % 24;
            currentDiff -= hours * 3600;

            let minutes = Math.floor(currentDiff / 60) % 60;
            currentDiff -= minutes * 60;

            timerElem.innerHTML = `До появления бонусов: ${days}д. ${hours}ч. ${minutes}м.`

            setInterval(() => {
                currentDiff = (diffTimestamp - Date.now()) / 1000;

                days = Math.floor(currentDiff / 86400);
                currentDiff -= days * 86400;

                hours = Math.floor(currentDiff / 3600) % 24;
                currentDiff -= hours * 3600;

                minutes = Math.floor(currentDiff / 60) % 60;
                currentDiff -= minutes * 60;

                timerElem.innerHTML = `До появления бонусов: ${days}д. ${hours}ч. ${minutes}м.`
            }, 1000 * 60)
        }
    }, false );

    window.addEventListener( 'load', function(){
        setTimeout(() => { g.step() }, 500)
    }, false );

    window.addEventListener('load', () => {
        document.querySelector('.question').addEventListener('click', (evt) => {
            const gameState = g.currentState();

            gameState.isGamePaused = true;

            const result = InstructionPopup();

            result.then(() => {
                gameState.isGamePaused = false;
                g.step();
            })
        })
    })

    window.addEventListener('load', () => {
        if(window.TelegramWebviewProxy){
            const web_app_setup_swipe_behavior = JSON.stringify({ allow_vertical_swipe: false });

            window
              .TelegramWebviewProxy
              .postEvent('web_app_setup_swipe_behavior', web_app_setup_swipe_behavior);

            window
              .TelegramWebviewProxy
              .postEvent('web_app_request_fullscreen');
        }
    })


})();

/*================================================

Popups

================================================*/

const InstructionPopup = function(){
    return new Promise((resolve, reject) => {
        const popup = document.querySelector('#popup-instruction')

        popup.classList.add('--opened');

        popup.querySelector('.popup-btn').addEventListener('click', (evt)=>{
            evt.preventDefault();
            popup.classList.remove('--opened');

            resolve(true)
        })
    })
}


const EndGamePopup = function(data){
    return new Promise((resolve, reject) => {
        const popup = document.querySelector('#popup-ended')

        popup.querySelector('#score').innerHTML = data.score + data.bonusScore

        popup.classList.add('--opened');

        const fireworkInterval = setInterval(createFirework, 300);

        setTimeout(() => { clearInterval(fireworkInterval) }, 5000)

        popup.querySelector('.popup-btn.primary').addEventListener('click', (evt)=>{
            evt.preventDefault();
            popup.classList.remove('--opened');

            window.location.reload()

            resolve(true)
        })

        popup.querySelector('.popup-btn.secondary').addEventListener('click', sendResults)

        async function sendResults(evt){
            evt.preventDefault();

            const btn = evt.target;

            btn.removeEventListener('click', sendResults);
            btn.classList.add('loading')

            const endGameParams = new URLSearchParams({
                chat_id: data.chatID,
                score: data.score,
                bonusScore: data.bonusScore,
            }).toString()

            const response = await fetch('https://lk.adswap.ru/api/snake-game/end?' + endGameParams)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.status === 'ok'){
                        btn.classList.remove('loading')
                        btn.innerHTML = 'Успешно!'
                    }

                    setTimeout(() => { window.location.reload() }, 1500)
                })
                .catch(error => {
                     btn.classList.remove('loading')
                     btn.innerHTML = 'Попробуйте позже'
                });

        }
    })
}


/*================================================

Popups

================================================*/


/*================================================

Utils

================================================*/

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

/*================================================

Utils

================================================*/


/*================================================

Firework

================================================*/

function random(min, max) {
    return min + Math.random() * (max + 1 - min);
}

const fireworkTime = 750;

const createFirework = () => {
    const xPos = random(0, 100)
    const yPos = random(0, 100)
    const colour = '#'+Math.random().toString(16).substr(2,6);

    for (let i = 1; i <= 50; i++) {
        const firework = document.createElement('div')
        firework.className = 'firework'
        firework.classList.add(`firework${i}`)
        firework.style.backgroundColor = colour
        firework.style.left = xPos + '%'
        firework.style.top = yPos + '%'
        document.querySelector('.wrapper').appendChild(firework)
    }
}

</script>
</html>
