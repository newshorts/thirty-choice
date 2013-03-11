var Choices = Class.extend({
    
    init: function(){
        
        // events
        $('.video').on('dragstart', function(evt, ui) {

            var $this = $(this);

            if(!ui.helper.data('dropped')) {

//                            if($this.parent().hasClass('choiceDrop')) {
//                                var parentID = $this.data('key');
//                                var elem = $this.detach();               
//                                $('#' + parentID).html(elem);
//                            }

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

//                            if($this.parent().hasClass('choiceDrop')) {
//                                var parentID = $this.data('key');
//                                var elem = $this.detach();               
//                                $('#' + parentID).html(elem);
//                            }

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
        
        this.setDraggable();
        this.setDroppable();
        
    },
            
    /**
     * Set the draggable element
     * 
     * @return {void} Nothing
     * */
     
     setDraggable: function() {
        $('.video').draggable({

            // this is a neat little trick to get anything other than a drop to revert
            revert: function(evt, ui) {

                $(this).data('uiDraggable').originalPosition = {
                    top: 0,
                    left: 0,
                    'z-index': 20
                };

                if($(this).parent().hasClass('choiceDrop') && !evt) {
                    var o = $(this).parent('.choiceDrop').offset();
                    var parentID = $(this).data('key');
                    var elem = $(this).detach();               
                    $('#' + parentID).html(elem);
                    
                    
                    // TODO find out if this is working or not
                    $(this).data('uiDraggable').currentPosition = o;
                }

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
     },
     
     
     /**
     * Set the droppable element
     * 
     * @return {void} Nothing
     * */
     
     setDroppable: function() {
        $( ".choiceDrop" ).droppable({
            drop: function( evt, ui ) {
                ui.draggable.data('dropped', true);
                ui.draggable.data('dropElem', this);

                var elem = ui.draggable.detach();                            
                $(this).html(elem);
                
                $(this).removeClass('empty');
                
                var t = ui.draggable.data('heading');
                $(this).siblings('.choiceTitle').text(t);
                
                // TODO figure out how to set an offset on the draggable dropped elem so it doesnt snapt to top left corner of choiceDrop
//                ui.draggable.css({
//                    top: '20px',
//                    left: '20px'
//                });

                $(this).droppable('option', 'accept', ui.draggable);
            },
            out: function(evt, ui) {
                ui.draggable.data('dropped', false);
                ui.draggable.data('dropElem', null);
                
                $(this).addClass('empty');
                
                $(this).siblings('.choiceTitle').text('');

                // find the original parent of the item
        //                            var p = ui.draggable.data('key');
        //                            var elem = ui.draggable.detach();                            
        //                            $('#' + p).html(elem);

                $(this).droppable('option', 'accept', '.video');
            }
        });
     }
      
});