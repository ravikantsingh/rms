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
});