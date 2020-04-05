<div class="navbar-content">
  <!-- start: SIDEBAR -->
  <div class="main-navigation navbar-collapse collapse">
    <div class="user-info-left"> <img src="<?php echo ($result['profile']!='')?$result['profile']:HOST.'img/nophoto.jpg'; ?>" width="30" height="30"> </div>
    <!-- start: MAIN MENU TOGGLER BUTTON -->
    <div class="navigation-toggler"> <i class="clip-chevron-left"></i> <i class="clip-chevron-right"></i> </div>
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <ul class="main-navigation-menu">
      <li  <?php if($option=='dashboardContent' || $option=='') echo 'class="active open"';?>> <a href="./?option=dashboardContent"> <i class="clip-home-2"></i> <span class="title"> Dashboard </span><span class="selected"></span> </a> </li>
      <li  <?php if($option=='pos') echo 'class="active open"';?>> <a href="./?option=pos"> <i class="clip-cart"></i> <span class="title"> POS </span><span class="selected"></span> </a> </li>
      
      <li <?php if($option=='addProduct' || $option=='editProduct' || $option=='viewProduct' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-stack-2"></i> <span class="title"> Product Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addProduct') echo 'class="sub-active"';?>> <a href="./?option=addProduct"> <i class="clip-stack-empty"></i> <span class="title">Add Product </span> </a> </li>
          <li <?php if($option=='viewProduct') echo 'class="sub-active"';?>> <a href="./?option=viewProduct"> <i class="clip-eye"></i> <span class="title"> View Product </span> </a> </li>

        </ul>
      </li>
      
      <li  <?php if($option=='report') echo 'class="active open"';?>> <a href="./?option=report"> <i class="fa fa-pie-chart"></i> <span class="title"> Report </span><span class="selected"></span> </a> </li>
      <?php /////////////////////////////END ADMIN MENU ////////////////////////////////////// ?>
      <li> <a href="<?php echo HOST.'./?option=logout'; ?>"> <i class="clip-switch"></i> <span class="title"> Logout </span> <span class="selected"></span> </a> </li>
    </ul>
  </div>
  <!-- end: SIDEBAR -->
</div>
