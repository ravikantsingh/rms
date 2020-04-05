<div class="navbar-content">
  <!-- start: SIDEBAR -->
  <div class="main-navigation navbar-collapse collapse">
    <div class="user-info-left"> <img src="<?php echo ( isset( $result['profile'] ) && $result['profile']!='')?$result['profile']:HOST.'img/nophoto.jpg'; ?>" width="30" height="30"> </div>
    <!-- start: MAIN MENU TOGGLER BUTTON -->
    <div class="navigation-toggler"> <i class="clip-chevron-left"></i> <i class="clip-chevron-right"></i> </div>
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <ul class="main-navigation-menu">
      <li  <?php if($option=='dashboardContent' || $option=='') echo 'class="active open"';?>> <a href="./?option=dashboardContent"> <i class="clip-home-2"></i> <span class="title"> Dashboard </span><span class="selected"></span> </a> </li>
      <li  <?php if($option=='pos') echo 'class="active open"';?>> <a href="./?option=pos"> <i class="clip-cart"></i> <span class="title"> POS </span><span class="selected"></span> </a> </li>

      <li <?php if($option=='orders' || $option=='canceledOrders' || $option=='preparedOrders'  || $option=='pendingOrders'  || $option=='deliveredOrders'  ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-stack-2"></i> <span class="title"> Order Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='orders') echo 'class="sub-active"';?>> <a href="./?option=orders"> <i class="clip-stack-empty"></i> <span class="title">Orders </span> </a> </li>
          <li <?php if($option=='canceledOrders') echo 'class="sub-active"';?>> <a href="./?option=canceledOrders"> <i class="clip-stack-empty"></i> <span class="title">Canceled Orders </span> </a> </li>
          <li <?php if($option=='preparedOrders') echo 'class="sub-active"';?>> <a href="./?option=preparedOrders"> <i class="clip-stack-empty"></i> <span class="title">Prepared Orders </span> </a> </li>
          <li <?php if($option=='pendingOrders') echo 'class="sub-active"';?>> <a href="./?option=pendingOrders"> <i class="clip-stack-empty"></i> <span class="title">Pending Orders </span> </a> </li>
          <li <?php if($option=='deliveredOrders') echo 'class="sub-active"';?>> <a href="./?option=deliveredOrders"> <i class="clip-stack-empty"></i> <span class="title">Delivered Orders </span> </a> </li>

        </ul>
        <li <?php if($option=='addExpense') echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-banknote"></i> <span class="title"> Daily Expense Mgmt </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addExpense') echo 'class="sub-active"';?>> <a href="./?option=addExpense"> <i class="clip-add"></i> <span class="title">Add/View Daily Expense </span> </a> </li>

        </ul>
      </li>
      </li>
        <?php if( $tableMode == 1){  ?>
        <li> <a href="<?php echo './?option=tables'; ?>"> <i class="fa fa-th-large"></i> <span class="title"> Tables </span> <span class="selected"></span> </a> </li>
        <?php } ?>
      <li  <?php if($option=='receipt') echo 'class="active open"';?>> <a href="./?option=receipt"> <i class="fa fa-print"></i> <span class="title"> Print Receipt </span><span class="selected"></span> </a> </li>
       <li  <?php if($option=='report') echo 'class="active open"';?>> <a href="./?option=report"> <i class="fa fa-pie-chart"></i> <span class="title"> Report </span><span class="selected"></span> </a> </li>
      <?php /////////////////////////////END ADMIN MENU ////////////////////////////////////// ?>
      <li> <a href="<?php echo HOST.'./?option=logout'; ?>"> <i class="clip-switch"></i> <span class="title"> Logout </span> <span class="selected"></span> </a> </li>
    </ul>
  </div>
  <!-- end: SIDEBAR -->
</div>
