var App = Class.extend({
    
    form: {},
    
    init: function(c){
        this.form = $(c);
    },
            
    /**
     * Handle the submit action, gather all form data
     * 
     * @return {void} Nothing
     * */
     
    handleLoginSubmit: function(evt) {
        var f = this.form;
       
        var data = f.serializeArray();
        
        var json = JSON.stringify(data);
        
        $.cookie('GSP_contact_data', json, { expires: 7 });
        
        window.location = "select";
    },
            
    readCookie: function(key) {

        var data = $.cookie(key);
        
        return JSON.parse(data);
        
    },
            
    makeId: function() {

        var text = "";
        
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ ) {
            
            text += possible.charAt(Math.floor(Math.random() * possible.length));
            
        }

        return text;
    }
});