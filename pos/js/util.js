$(document).ready( function(){
    $( document ).on('click', '.scroll-left', function(){
            myScrollHorizontal( $('nav'), 100, 'left' );
    } );
    $( document ).on('click', '.scroll-right', function(){
        myScrollHorizontal( $('nav'), 100, 'right' )
    } );

    function myScrollHorizontal( s, p, t = 'left' ){
        if( t == 'left' ){
            s.scrollLeft( s.scrollLeft() - p );
        }
        else if( t == 'right' ){
            s.scrollLeft( s.scrollLeft() + p );
        }
    }
    var productRowCounter = 1;
    $('.add-product').click( function( ){
        var $this = $( this );
        var id= $this.data( 'id' ) ;
        var name = $( '#'+id).data( 'name' );
        var price = $( '#'+id).data( 'price' );
        var productID = $("#product-"+id);
        var numericID = $("#"+id).data( 'product-id' );

        $this.find( '.product-added').removeClass( 'hide' );
        if( typeof( productID.val() ) == 'undefined'){
            var data = '<input type="hidden" name="row'+numericID+'[]" value="'+numericID+'" /><input type="hidden" id="quantity-'+numericID+'" name="row'+numericID+'[]" value="1" /><input type="hidden" name="row'+numericID+'[]" value="'+price+'" /><div class="row product-row" id="product-'+id+'" ><div class="col-sm-1"> '+productRowCounter+'. </div><div class="col-sm-4"> '+ name+' </div> <div class="col-sm-2 quantity"> 1 x <span class="price-tag text-muted">  Rs.'+ price+' </span> <span class="qty-plus" data-id = "'+id+'"> + </span> <span class="qty-minus"  data-id = "'+id+'"> - </span></div> <div class="col-sm-2 price"> Rs.'+ price+'<input type="hidden" class="price-value" value="'+ price+'" /> </div> </div>';
            $( '.cart-content' ).append( data );
            productRowCounter++;
            calculateTotal( $("#product-"+id).find( '.price-value' ) );
        }
        else{
            var qty = productID.find( '.quantity' );
            var prc = productID.find( '.price' );
            var pv = productID.find( '.price-value' );
            var value = parseInt( qty.text() );
            $( "#quantity-"+numericID ).val( value + 1 );
            qty.html( ( value + 1 )+' x <span class="price-tag text-muted">  Rs.'+ price+' </span><span class="qty-plus"  data-id = "'+id+'"> + </span> <span class="qty-minus"  data-id = "'+id+'"> - </span>' );
            prc.html( 'Rs.' + parseFloat( price )*( value+1 ) + '<input type="hidden" class="price-value" value="'+ parseFloat( price ) +'" />' );
            pv.val( parseFloat( price ) );
            calculateTotal( pv );
        }
    });
    $(document).on( 'click', '.qty-plus', function(){
        var $this = $( this );
        var id= $this.data( 'id' ) ;
        var name = $( '#'+id).data( 'name' );
        var price = $( '#'+id).data( 'price' );
        var productID = $("#product-"+id);
        var numericID = $("#"+id).data( 'product-id' );

        var qty = productID.find( '.quantity' );
            var prc = productID.find( '.price' );
            var pv = productID.find( '.price-value' );
            var value = parseInt( qty.text() );
            $( "#quantity-"+numericID ).val( value + 1 );
            qty.html( ( value + 1 )+' x <span class="price-tag text-muted">  Rs.'+ price+' </span><span class="qty-plus"  data-id = "'+id+'"> + </span> <span class="qty-minus"  data-id = "'+id+'"> - </span>' );
            prc.html( 'Rs.' + parseFloat( price )*( value+1 ) + '<input type="hidden" class="price-value" value="'+ parseFloat( price ) +'" />' );
            pv.val( parseFloat( price ) );
            calculateTotal( pv );
        } );
    $(document).on( 'click', '.qty-minus', function(){
        var $this = $( this );
        var id= $this.data( 'id' ) ;
        var name = $( '#'+id).data( 'name' );
        var price = $( '#'+id).data( 'price' );
        var productID = $("#product-"+id);
        var numericID = $("#"+id).data( 'product-id' );

        var qty = productID.find( '.quantity' );
            var prc = productID.find( '.price' );
            var pv = productID.find( '.price-value' );
            var value = parseInt( qty.text() );
            if( value > 1 ){
                $( "#quantity-"+numericID ).val( value - 1 );
                qty.html( ( value - 1 )+' x <span class="price-tag text-muted">  Rs.'+ price+' </span><span class="qty-plus"  data-id = "'+id+'"> + </span> <span class="qty-minus"  data-id = "'+id+'"> - </span>' );
                prc.html( 'Rs.' + parseFloat( price )*( value-1 ) + '<input type="hidden" class="price-value" value="'+ parseFloat( price ) +'" />' );
                pv.val( parseFloat( price ) );
                calculateTotal( pv, '-' );
            }
        } );
    $(document).on('click', '#submit-pay-now', function(){
      var payable = parseFloat( $('#payable').val() );
      if( payable === 0 )
        $("#confirmOrderForm").submit();
      else {
        showMessage( 'Please Correct the amount before going ahead...' );
      }
    });
    function showMessage( b = '', h = 'Attention!', f = '<input type="button" class="btn btn-default" id="message-ok" value="Okay"/>' ){
        $('.message-head').html( h );
        $('.message-body').html( b );
        $('.message-foot').html( f );
        $('.message-container').show();
    }
    function calculateTotal( pv, ac = '+' ){
        var value = 0;
        if( typeof( pv ) != 'undefined' ){
            var total = parseFloat( $( '#cart-total' ).text() );
            value += parseFloat( pv.val() );
            if( ac == '+' ){

                $( '#cart-total' ).text( total + value );
            }
            else if( ac == '-'){

                $( '#cart-total' ).text( total - value );
            }
        }
    }
    $(document).on('click', ('#message-ok'), function(){
        $('.message-container').hide();
    })
    $(document).on('click', '#close-cashpad', function(){
        var x = $('.payment-panel-container');
        $('#cashPadInput').text('0.0');
        x.hide();
    });

    $(document).on('click', '#done-cashpad', function(){
        var x = $('.payment-panel-container');
        var $this = $( this );
        var $target = $('#'+$this.attr( 'data-target' ));
        var tf = $target.find( 'input[ type=checkbox ]' ).data( 'clicked' );
        var payable = parseFloat( $('#payable').val() );
        x.hide();
        var value = parseFloat( $('#cashPadInput').text() );
        var xv = $target.find( 'input[ type=text ]' ).val(  ) ;
        if( xv === '' ) xv = 0;
        xv = parseFloat( xv );
        if( value > ( payable + xv ) || ( payable + xv ) === 0 ){
                if( ( payable + xv ) !== 0  ){
                    if( tf === 0 ){
                        $target.find( 'input[ type=checkbox ]' ).trigger( 'click' ).data( 'clicked', 1 );
                        tf = 1;
                    }
                    $target.find( 'input[ type=text ]' ).val( ( payable + xv ) );
                    $('#payable').val( 0 );
                    x.find('#done-cashpad').attr('data-target', '');
                }
                showMessage( 'You entered amount greater than payable. Make sure to return Rs. ' +  (value - ( payable + xv )));
            }
        else if( value !== 0 || value !== '' ){
            if( tf === 0 ){
                $target.find( 'input[ type=checkbox ]' ).trigger( 'click' ).data( 'clicked', 1 );
                tf = 1;
            }

            $target.find( 'input[ type=text ]' ).val( value );
            $('#payable').val( payable + xv - value );
            x.find('#done-cashpad').attr('data-target', '');
        }
        else{
            if( tf == 1 ){
                $target.find( 'input[ type=checkbox ]' ).trigger( 'click' ).data( 'clicked', 0 );
                tf = 0;
            }
            $target.find( 'input[ type=text ]' ).val( '' );

            x.find('#done-cashpad').attr('data-target', '');
        }
        $('#cashPadInput').text('0.0');
    });
    $(document).on('click', '#clearTheCart', function(){
        $( '.cart-content' ).html( '' );
        $('.add-product').each(function(){
            $( '#cart-total' ).text( 0 );
            $(this).find( '.product-added').addClass( 'hide' );
        });
        productRowCounter = 1;
    });

    $(document).on( 'click', '#creatCart', function(){
        var tableModeFlag=$("#tableModeFlag").val( );
        if(tableModeFlag=='1'){
         var action = $('#action').val();
                $('#creatCartForm').attr('action', action);
                $('#creatCartForm').submit();
        }
        else{
                var mobile = $("#mobile").val( );
                var cn = $("#customer_name").val( );
                var ct = parseFloat( $("#cart-total").text( ) );
                if( mobile == '' || !( $.isNumeric( mobile ) )  ){

                        showMessage( 'Enter valid mobile number...' );
                }
                else if( cn == '' ){

                        showMessage( 'Enter valid customer name...' );
                }
                else if( ct == 0 ){

                        showMessage( 'Your cart is empty, add some items first...' );
                }
                else{
                    if(  ( mobile.length == 10 ) || ( mobile.length == 11 ) || ( mobile.length == 13 ) ){
                        var action = $('#action').val();
                        //console.log(action);
                        $('#creatCartForm').attr('action', action);
                        $('#creatCartForm').submit();
                    }
                    else{
                        showMessage( 'Mobile number you entered is not a valid number, recheck it...' );
                    }
                }
        }
    });
    $('#leftSideNote').height(parseInt($('#noteHolder').height())-7);
    $('#rightSideNote').height(parseInt($('#noteHolder').height())-7);
	$(document).on('click', '.note tr td', function(){
    				var $this=$(this);
    				var operator=$('#operatorSelector').val();
    				var value=parseFloat($('#cashPadInput').text());
    				var value1=parseFloat($this.text());
    				if(operator=='+')
    				$('#cashPadInput').text(value + value1);
    				else if(operator=='-')
    				$('#cashPadInput').text(value - value1);
    			});
    $(document).on('click', '#numPad tr td',  function(){
        var $this=$(this);
        if($this.attr('class')!='numPadTopRow') if($this.attr('class')!='numPadX') if($this.attr('id')!='numPadOK'){
            var number=$('#numPadAmount').text();
            $('#numPadAmount').text(number.trim()+$this.text().trim());
        }else {}
    });
$(document).on('click', '#numPadOK', function(){
			var number=$('#numPadAmount').text();
			var operator=$('#operatorSelector').val();
			if(number!=''){
				if(operator=='+')
			        $('#cashPadInput').text((parseFloat(number)+parseFloat($('#cashPadInput').text())));
			    else if(operator=='-')
			        $('#cashPadInput').text((parseFloat($('#cashPadInput').text())-parseFloat(number)));
			    $('#numPadAmount').text('');
			}
		});

$('#numPadPlus').click(function(){
		$('#operatorSelector').val('+');
	});
$('#numPadMinus').click(function(){
		$('#operatorSelector').val('-');
	});
$(document).on('click', '#numPadX', function(){
			$('#cashPadInput').text('0.0');
		});
$( document ).on( 'keyup', '#mobile', function(){
    var $this = $(this);
    var key = $this.val();
    if( key !== '' ){
        $.post('./inc/post/ds.php',{key: key}, function( data ){
            $('#search_result').html(data);
        });
    }
});
$( document ).on( 'click', '.search-value', function(){
    var $this = $(this);
    var m = $this.attr( 'data-mobile' );
    var n = $this.attr( 'data-name' );
    if( m !== '' &&  n !== '' ){
        $('#mobile').val( m );
        $('#customer_name').val( n );
        $('#search_result').html( '' );
    }
});



});
 $(document).ready( function(){
      var c = 0;
        setInterval(function(){
          $('.progress-loading-bar').each(function(){
            var $this = $(this);
            var w = $this.css('width');
            var t = parseFloat( $this.attr('data-t') );
            var rt = parseFloat( $this.attr('data-rt') );
            var p = ((rt + c)*100)/t
            if( p <= 100 )
              $this.css('width', p+'%');

          });
          c++;
        //   if( c == 30 ){
        //     location.reload();
        //   }
        }, 1000);

    });

    $(document).ready(function(){
    $(document).on('click', '.item-btn', function(){
        $('.display-modes, .display-items').fadeOut();
        var $this = $(this);
        var id = $this.attr('data-id');
        var o = $this.attr('data-on');
        if( o == "0" ){
            $('#'+id).fadeIn();
            $this.attr('data-on', 1);
        }
        else{
            $('#'+id).fadeOut();
            $this.attr('data-on', 0);
        }
    });
    $(document).on('click', '.mode-btn', function(){
        $('.display-modes, .display-items').fadeOut();
        var $this = $(this);
        var id = $this.attr('data-id');
        var o = $this.attr('data-on');
        if( o == "0" ){
            $('#'+id).fadeIn();
            $this.attr('data-on', 1);
        }
        else{
            $('#'+id).fadeOut();
            $this.attr('data-on', 0);
        }
    });
});
