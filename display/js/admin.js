$(document).ready(function(){
    
    $( 'input[ type=checkbox ]' ).click( function(){
        var $this = $(this);
        var id = $this.data('id');
        var type = $this.data('type');
        var value = '';
        if( type == 'switch') value = 0;
        if( $this.is(':checked') ) value = $this.val();
        
        $('#'+id ).val( value );
    } );
    
    $( '.checkbox-mask' ).on('click', function(){
       var $this = $( this ).parent();
       var target = $( this ).data( 'id' );
       var x = $('.payment-panel-container');
       if(x.is(':visible')){
           x.hide();
           x.find('#done-cashpad').data('target', '');
       }
       else{
           x.show();
           x.find('#done-cashpad').attr('data-target', target);
       }
    });
});