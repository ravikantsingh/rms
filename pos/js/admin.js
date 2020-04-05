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
           var payable = parseFloat( $('#payable').val() );
        var xv = $( '#'+target ).find( 'input[ type=text ]' ).val(  ) ;
        if( xv === '' ) xv = 0;
        xv = parseFloat( xv );
        if( ( payable + xv ) === 0 ){
                
            showMessage( 'Amount is already settled, you need not enter now...');
        }
        else{
            x.show();
            x.find('#done-cashpad').attr('data-target', target);
        }
           
       }
    });

    
    function showMessage( b = '', h = 'Attention!', f = '<input type="button" class="btn btn-default" id="message-ok" value="Okay"/>' ){
        $('.message-head').html( h );
        $('.message-body').html( b );
        $('.message-foot').html( f );
        $('.message-container').show();
    }
});