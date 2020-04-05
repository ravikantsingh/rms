$(document).ready(function(){
  function toggleDiscount(e){
  	var target = e.attr('data-target');
  	$('#'+target).toggleClass( 'display-none' );
    if( $('#'+target).is(':visible') ){
      $('#discount').attr('name', 'discount');
    }
    else{
      $('#discount').removeAttr('name');
    }


  }
  $(document).on('click', '#discountToggle', function(){
    toggleDiscount($(this));
  });
  $(document).on('click', '.addProductWrapper', function(){
    var $this = $(this);
    var id = $this.attr('id');
    $('.modalWrapper').removeClass('hidden');
    $('#selectProduct').find('#target').val(id);
  });
  $(document).on('click', '#close', function(){
    $('.modalWrapper').addClass('hidden');
    $('#category_id').val(0);
    $('#comboItems').html('<option value = "0"> No Items </option>');
    $('#selectProduct').find('#target').val('');
  });
  $(document).on('change', '#category_id', function(){
    var p = $(this).val();
    // var s = $('#search').val();
    $.post('./inc/post/findProduct.php', { p:p, s:'n/a' }, function(data){
      data = data.split('&^&');
      $('#itemsWrapper').html( data[0] );
      $('#nextContainer').val(data[1]);
      $('#comboItems').focus();
    });
  });
  $(document).on('click', '#addComboItem', function(){
    var id = $('#target').val();
    var v = $('#comboItems').val()
    var r = $('#'+id).find('.replace').val();
    if( v != 0 ){
      var nextId = $('#nextContainer').val();
      $('#'+id).html('<span class="comboItemName">'+$('#comboItems :selected').text()+'</span><input type="hidden" value="'+v+'" name="comboItems[]" /><input type="hidden" value="yes" class="replace" />');
      if( r == 'no' ){
        $('#addProductMainWrapper').append('<div class="form-group"  > <div class="col-sm-3 col-sm-offset-2"> <div class="addProductWrapper" id="'+nextId+'"> <span class="addProductcontainer"> + <span> <input type="hidden" value="no" class="replace" /> </div></div></div>');
      }
      $('.modalWrapper').addClass('hidden');
      $('#category_id').val(0);
      $('#comboItems').html('<option value = "0"> No Items </option>');
      $('#selectProduct').find('#target').val('');
    }
  });
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
