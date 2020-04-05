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
      if( c == 30 ){
        location.reload();
      }
    }, 1000);

});
