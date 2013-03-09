var App = Class.extend({
    
    loginForm: {},
    
    emailArr: new Array(),
    
    init: function(){
        
        this.loginForm = $('#loginForm');
        
        var self = this;
        
        $('.begin').on('click', function(evt) {

            evt.preventDefault();

            self.handleBegin(evt);
            
        });
        
        $('.submit').on('click', function(evt) {
            self.handleSubmit(evt);
        });
        
    },
            
    /**
     * Handle the submit action, gather all form data
     * 
     * @return {void} Nothing
     * */
     
     handleSubmit: function(evt) {
         
         var arr = this.emailArr;
         
         this.collectChoices();
         
         this.collectLoginFormData();
         
         console.dir(arr);
         
         var str = 'mailto:mike_newell@gspsf.com?subject=Response%20To%20Body&body=';
         
         str += '%0A%0AEmail%3A%20' + arr.email;
         str += '%0A%0APosition%3A%20' + arr.position;
         str += '%0A%0AName%3A%20' + arr.name;
         // this is typeing on the new keyboard, pretty sweet!!!
         var choicesCount = arr.choices.length;
         
         for(var i = 0; i < choicesCount; i++) {
             
             str +='%0A%0AVideo%20' + (i + 1) + '%3A%20' + arr.choices[i];
             
         }
         
         window.location = str;
         
//         $('.emailLink').attr('href', str);
//         
//         $('.emailLink').trigger('click');
         
         
     },
            
    /**
     * Hand the for being submitted
     * 
     * @return {void} Nothing
     * */
     
     handleBegin: function(evt) {
         var errors = false;

        $('.error').each(function(idx) {

            var display = $(this).css('display');

            if(display == 'inline') {

                errors = true;

            }

        });

        if(!errors) {

            $('#login').css({

                display: 'none'

            });

        }
            
     },
     
    /**
     * Collect and organize the list, then add it to email data
     * 
     * @return {void} 
     * */
     collectChoices: function() {
         
         var arr = new Array();
         
         var ea = this.emailArr;
         
         $('#choices').children('.video').each(function(idx) {
             
             arr.push($(this).data('name'));
             
         });
         
         ea['choices'] = arr;
         
         this.emailArr = ea;
         
     },
     
    /**
     * Returns serialized form data
     * 
     * @return {void} 
     * */
    collectLoginFormData: function() {

        var loginForm = this.loginForm;
        
        var ea = this.emailArr;
        
        $('.login').each(function(idx) {
            
            var name = $(this).attr('name');
            
            var v = $(this).val();
            
            ea[name] = v;
            
        })
        
        this.emailArr = ea;
        
    }
});