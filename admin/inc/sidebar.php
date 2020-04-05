<div class="navbar-content">
  <!-- start: SIDEBAR -->
  <div class="main-navigation navbar-collapse collapse">
    <div class="user-info-left"> <img src="<?php echo ( isset( $result['profile'] ) && $result['profile'] != '' ) ? $result['profile']:HOST.'img/nophoto.jpg'; ?>" width="30" height="30"> </div>
    <!-- start: MAIN MENU TOGGLER BUTTON -->
    <div class="navigation-toggler"> <i class="clip-chevron-left"></i> <i class="clip-chevron-right"></i> </div>
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <ul class="main-navigation-menu">
      <li  <?php if($option=='dashboardContent' || $option=='') echo 'class="active open"';?>> <a href="./?option=dashboardContent"> <i class="clip-home-2"></i> <span class="title"> Dashboard </span><span class="selected"></span> </a> </li>

      <li <?php if($option=='restaurantInformation' || $option=='paymentSettings' || $option=='emailSettings' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-wrench-2"></i> <span class="title"> Tools </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='restaurantInformation') echo 'class="sub-active"';?>> <a href="./?option=restaurantInformation"> <i class="clip-info-2"></i> <span class="title"> Restaurant Information </span> </a> </li>
          <li <?php if($option=='paymentSettings') echo 'class="sub-active"';?>> <a href="./?option=paymentSettings"> <i class="fa fa-gear"></i> <span class="title"> Payment Settings </span> </a> </li>
          <li <?php if($option=='emailSettings') echo 'class="sub-active"';?>> <a href="./?option=emailSettings"> <i class="fa fa-gear"></i> <span class="title"> Email Settings </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addUser' || $option=='viewUser' || $option=='editUser' || $option=='profile' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-users-3"></i> <span class="title"> User Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addUser') echo 'class="sub-active"';?>> <a href="./?option=addUser"> <i class="clip-user-plus"></i> <span class="title">Add User </span> </a> </li>
          <li <?php if($option=='viewUser') echo 'class="sub-active"';?>> <a href="./?option=viewUser"> <i class="clip-eye"></i> <span class="title">View User </span> </a> </li>
          <li <?php if($option=='profile') echo 'class="sub-active"';?>> <a href="./?option=profile"> <i class="fa fa-user-secret"></i> <span class="title"> Profile </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addCustomer' || $option=='viewCustomer' || $option=='editCustomer' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-users-3"></i> <span class="title"> Customer Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addCustomer') echo 'class="sub-active"';?>> <a href="./?option=addCustomer"> <i class="clip-user-plus"></i> <span class="title">Add Customer </span> </a> </li>
          <li <?php if($option=='viewCustomer') echo 'class="sub-active"';?>> <a href="./?option=viewCustomer"> <i class="clip-eye"></i> <span class="title">View Customer </span> </a> </li>
        </ul>
      </li>
      <li <?php if($option=='addProduct' || $option=='editProduct' || $option=='viewProduct' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-stack-2"></i> <span class="title"> Product Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addProduct') echo 'class="sub-active"';?>> <a href="./?option=addProduct"> <i class="clip-stack-empty"></i> <span class="title">Add Product </span> </a> </li>
          <li <?php if($option=='viewProduct') echo 'class="sub-active"';?>> <a href="./?option=viewProduct"> <i class="clip-eye"></i> <span class="title"> View Product </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addCombo' || $option=='editCombo' || $option=='viewCombo' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="fa fa-cutlery" aria-hidden="true"></i>
 <span class="title"> Combo Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addCombo') echo 'class="sub-active"';?>> <a href="./?option=addCombo"> <i class="clip-stack-empty"></i> <span class="title">Add Combo </span> </a> </li>
          <li <?php if($option=='viewCombo') echo 'class="sub-active"';?>> <a href="./?option=viewCombo"> <i class="clip-eye"></i> <span class="title"> View Combo </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addCategory' || $option=='editCategory' || $option=='viewCategory' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-grid-6"></i> <span class="title"> Category Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addCategory') echo 'class="sub-active"';?>> <a href="./?option=addCategory"> <i class="clip-add"></i> <span class="title">Add Category </span> </a> </li>
          <li <?php if($option=='viewCategory') echo 'class="sub-active"';?>> <a href="./?option=viewCategory"> <i class="clip-eye"></i> <span class="title"> View Category </span> </a> </li>

        </ul>
      </li>

      <li <?php if($option=='addTax' || $option=='editTax' || $option=='viewTax' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-banknote"></i> <span class="title"> Tax Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addTax') echo 'class="sub-active"';?>> <a href="./?option=addTax"> <i class="clip-add"></i> <span class="title">Add Tax </span> </a> </li>
          <li <?php if($option=='viewTax') echo 'class="sub-active"';?>> <a href="./?option=viewTax"> <i class="clip-eye"></i> <span class="title"> View Tax </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addExpense') echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-banknote"></i> <span class="title"> Daily Expense Mgmt </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addExpense') echo 'class="sub-active"';?>> <a href="./?option=addExpense"> <i class="clip-add"></i> <span class="title">Add/View Daily Expense </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addDiscount' || $option=='editDiscount' || $option=='viewDiscount' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-banknote"></i> <span class="title"> Discount Manager </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addDiscount') echo 'class="sub-active"';?>> <a href="./?option=addDiscount"> <i class="clip-add"></i> <span class="title">Add Discount </span> </a> </li>
          <li <?php if($option=='viewDiscount') echo 'class="sub-active"';?>> <a href="./?option=viewDiscount"> <i class="clip-eye"></i> <span class="title"> View Discount </span> </a> </li>

        </ul>
      </li>
      <li <?php if($option=='addPaymentMode' || $option=='editPaymentMode' || $option=='viewPaymentMode' ) echo 'class="active open"';?>> <a href="javascript:void(0);"> <i class="clip-banknote"></i> <span class="title"> Payment Mode Mgmt </span> <i class="clip-chevron-right pull-right"></i> <span class="selected"></span> </a>
        <ul class="sub-menu">
          <li <?php if($option=='addPaymentMode') echo 'class="sub-active"';?>> <a href="./?option=addPaymentMode"> <i class="clip-add"></i> <span class="title">Add Payment Mode </span> </a> </li>
          <li <?php if($option=='viewPaymentMode') echo 'class="sub-active"';?>> <a href="./?option=viewPaymentMode"> <i class="clip-eye"></i> <span class="title"> View Payment Mode </span> </a> </li>

        </ul>
      </li>
      <li  <?php if($option=='report') echo 'class="active open"';?>> <a href="./?option=report"> <i class="fa fa-pie-chart"></i> <span class="title"> Report </span><span class="selected"></span> </a> </li>
      <?php /////////////////////////////END ADMIN MENU ////////////////////////////////////// ?>
      <li> <a href="<?php echo HOST.'./?option=logout'; ?>"> <i class="clip-switch"></i> <span class="title"> Logout </span> <span class="selected"></span> </a> </li>
    </ul>
  </div>
  <!-- end: SIDEBAR -->
</div>
