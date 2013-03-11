<!-- 
    Author: Mike Newell © 2012
-->
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>GSP 30th Anniversary</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/reset.css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link rel="stylesheet" type="text/css" href="../css/select.css" />
        <style>
            
        </style>
    </head>
    <body>
        <div id="wrap">
            <hr class="redBar" />
            <div id="container">
                <header>
                    <a href="#"><img src="../images/logo.png" /></a>
                    <hr />
                    <div class="nav"></div>
                </header>
                <section>
                    <header><h1>Help Select 10 for 30</h1></header>
                    <article>
                        <div class="videos">
                            
                            <?php
                            
                            function genId($length = 10) {
                                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $randomString = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                                }
                                return $randomString;
                            }
                            
                            for($i = 1; $i <= 52; $i++) {
                                
                                $id = genId(7);
                                
                                $block = <<<BLOCK
                            <div class="videoContainer" id="$id">
                                <div class="video" data-key="$id">
                                    <img class="videoThumb" src="../images/40x40/$i.jpg" />
                                    <img class="videoTile" src="../images/150x150/$i.jpg" />
                                </div>
                            </div>
BLOCK;
                                
                                echo $block;
                            }
                            
                            ?>
                            
                            <div class="clear"></div>
                        </div>
                        <ul class="choices">
                            <li class="choice">
                                <div class="choiceDrop"></div>
                                <span>1.</span>
                                <div class="choiceTitle"></div>
                            </li>
                            <li class="choice">
                                <div class="choiceDrop"></div>
                                <span>2.</span>
                                <div class="choiceTitle"></div>
                            </li>
                            <li class="choice">
                                <div class="choiceDrop"></div>
                                <span>3.</span>
                                <div class="choiceTitle"></div>
                            </li>
                            <li class="choice">
                                <div class="choiceDrop"></div>
                                <span>4.</span>
                                <div class="choiceTitle"></div>
                            </li>
                            <li class="choice">
                                <div class="choiceDrop"></div>
                                <span>5.</span>
                                <div class="choiceTitle"></div>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </article>
                </section>
            </div><!-- end container -->
        </div><!-- end wrap -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
        <script src="js/cufon.js"></script>
        <script src="js/berthold.js"></script>
        <script>
            (function($) {
                $(window).load(function() {
                    
                    // events
                    $('.video').on('dragstart', function(evt, ui) {
                        
                        var $this = $(this);
                        
                        if(!ui.helper.data('dropped')) {
                            
                            var $parent = $this.parent('.videoContainer');

                            $parent.addClass('empty');

                            var tile = $this.find('.videoTile'),
                                thumb = $this.find('.videoThumb');
                                
                            tile.css({
                                width: '40px',
                                height: '40px',
                                opacity: 0
                            });

                            thumb.css({
                                width: '40px',
                                height: '40px',
                                opacity: 1
                            });
                            
                            $this.css({
                                width: '40px',
                                height: '40px',
                            });
                        }
                    });
                    
                    $('.video').on('dragstop', function(evt, ui) {
                        
                        var $this = $(this);
                        
                        if(!ui.helper.data('dropped')) {
                            
                            var $parent = $this.parent('.videoContainer');

                            $parent.removeClass('empty');

                            var tile = $this.find('.videoTile'),
                                thumb = $this.find('.videoThumb');
                                
                            tile.css({
                                width: '150px',
                                height: '150px',
                                opacity: 1
                            });

                            thumb.css({
                                width: '150px',
                                height: '150px',
                                opacity: 0
                            });
                            
                            $this.css({
                                width: '150px',
                                height: '150px'
                            });
                        } else {
                            var o = $(ui.helper.data('dropElem')).offset();
                            $(this).offset(o);
                        }
                    });
                    
                    // set elements in ui
                    $('.video').draggable({
                        
                        // this is a neat little trick to get anything other than a drop to revert
                        revert: function(evt, ui) {
                            $(this).data('uiDraggable').originalPosition = {
                                top: 0,
                                left: 0,
                                'z-index': 20
                            };
                            
//                            $(this).data('uiDraggable').css({
//                                'z-index': 20
//                            });
                            
                            return !evt;
                        },
                        drag: function(evt, ui) {
                            $(this).css({
                                'z-index': 30
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 30
                        },
                        snap: '.choiceDrop',
                        snapMode: 'inner'
                    });
                    
                    $( ".choiceDrop" ).droppable({
                        drop: function( evt, ui ) {
                            ui.draggable.data('dropped', true);
                            ui.draggable.data('dropElem', this);
                            
                            $(this).droppable('option', 'accept', ui.draggable);
                        },
                        out: function(evt, ui) {
                            ui.draggable.data('dropped', false);
                            ui.draggable.data('dropElem', null);
                            
                            $(this).droppable('option', 'accept', '.video');
                        }
                    });
                    
                    Cufon.replace('h1, p, h2');
                    
                });
            })(jQuery);
        </script>
    </body>
</html>
