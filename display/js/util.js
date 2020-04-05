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
      if( c == 10 ){
        //location.reload();
      }
    }, 1000);
    var d = $('#activeDisplay');
    var display = parseInt( d.attr( 'data-display' ) );
    var active =  parseInt( d.val() );
    setInterval(function(){
      if( active < display ){
          $('#display-'+active).fadeOut(function(){
              active = active + 1;
              $('#display-'+(active )).fadeIn();
              
              d.val( active );
          });
          
      }
      else{
          $('#display-'+active).fadeOut(function(){
              active =  1;
              $('#display-'+(active )).fadeIn();
              
              d.val( active );
          });
          
      }
    }, 5000);
    // setInterval(function(){
    //     var token = $('#content').val();
    //     $.post('./inc/post/token.php', { token: token }, function(data){
    //         data = JSON.parse(data);
    //         if( data[0] !== 'fail' ){
    //             $('#displayList').html( data[1] );
    //         }
    //     });
    // }, 15000);
    function fetchdata(){
        var token = $('#content').val();
         $.ajax({
            method: "POST",
            data: { token: token },
              url: './inc/post/token.php',
              type: 'post',
              success: function(data){
               data = JSON.parse(data);
                    if( data[0] !== 'fail' ){
                        $('#displayList').html( data[1] );
                    }
              },
              complete:function(data){
               setTimeout(fetchdata,5000);
              }
         });
    }
    setTimeout(fetchdata,5000);
});
