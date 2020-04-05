<!--site header-->

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="clip-list-2"></span> </button>
      <div class="logo-header"> <a class="navbar-brand" href="#"> <img src="<?php echo $college['logo'] ?>" style="width:92px; height:38px;" class="logo"> </a> </div>
    </div>
    <div class="navbar-tools">
      <ul class="nav navbar-right">
        <!-- start: MESSAGE DROPDOWN -->

        <li id="header_inbox_bar" class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Mail Notification"> <i class="fa fa-envelope-o"></i> </a>
          <ul class="dropdown-menu extended inbox">
            <li>
              <p class="red"> You have no new mail</p>
            </li>
            <li> <a href="#">See all messages </a> </li>
          </ul>
        </li>
        <li id="header_inbox_bar" class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notification"> <i class="fa fa-bell-o"></i> </a>
          <ul class="dropdown-menu extended inbox">
            <li>
              <p class="red"> You have no new notification</p>
            </li>
          </ul>
        </li>
        <!-- end: MESSAGE DROPDOWN -->
        <!-- start: LANGUAGE DROPDOWN -->
        <!-- end: LANGUAGE DROPDOWN -->

        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true"> <img alt="" src="<?php echo ($result['profile']!='')?$result['profile']:HOST.'img/nophoto.jpg'; ?>" height="30px" width="30px"> <span class="username"><?php echo ucfirst($result['name']); ?></span> <b class="caret"></b> </a>
          <ul class="dropdown-menu extended logout">
            <li><a href="<?php echo HOST.'?option=logout' ?>"><i class="fa fa-key"></i> Logout</a></li>
          </ul>
        </li>
        <!-- end: USER DROPDOWN -->

      </ul>
      <!-- end: TOP NAVIGATION MENU -->
    </div>
  </div>
  <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<!-- end: SITE HEADER -->
