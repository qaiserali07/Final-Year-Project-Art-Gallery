<?php
	session_start();
  include("includes/config.php");

  if(isset($_SESSION['auth'])){ 
    if($_SESSION['Role'] != 'B' && $_SESSION['Role'] != 'P')
    {
      header('location: ..\..\includes/logout.php?mesg=please login again!');
    }
  }
  else{
    header('location: ..\..\index.php');
  }

  $ID = $_SESSION['ID'];
  
  $GetCount = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_messages` WHERE `RID` = $ID AND `_read` = -1");
  $count = $GetCount->fetch_assoc();

  $getMessages = $conn->query("SELECT * FROM `tbl_messages` WHERE `RID` = $ID AND `_read` = -1");

  $GetNotiCount = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_notifications` WHERE `NID` = $ID AND (`_Read` = -1 OR `_Read` = -2)");
  $GetNoti = $GetNotiCount->fetch_assoc();

  $getNotification = $conn->query("SELECT * FROM `tbl_notifications` WHERE `NID` = $ID AND (`_Read` = -1 OR `_Read` = -2) ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Art Gallary</title>
  <link rel='shortcut icon' type='image/x-icon' href='..\assets/img/icon.png' />
  <link rel="stylesheet" href="..\assets/css/app.min.css">
  <link rel="stylesheet" href="..\assets/bundles/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="..\assets/css/style.css">
  <link rel="stylesheet" href="..\assets/css/components.css">
  <link rel="stylesheet" href="..\assets/css/custom.css">
  <link rel="stylesheet" href="..\assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="..\assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="..\assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="..\assets/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="..\assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <style>


@media(min-width:568px) {
    .end {
        margin-left: auto
    }
}

@media(max-width:768px) {
    #post {
        width: 100%
    }
}







.comment {
    border: 1px solid rgba(16, 46, 46, 1);
    float: left;
    border-radius: 5px;
    padding-left: 20px;
    padding-right: 40px;
    padding-top: 20px;
	margin-left:60px;
	margin-bottom:10px;
}

.comment h4,
.comment span,
.darker h4,
.darker span {
    display: inline
}

h1,
h4 {
    font-weight: bold
}


</style>


</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              
                <?php 
                  if($count['Total']!=0)
                  { ?>
                    <span class='badge headerBadge1'>
                      <?php echo $count['Total'] ?>
                    </span>
                    <?php  }
                ?>  </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <?php 
                    while($message = $getMessages->fetch_assoc()):
                      $UID = $message['SID'];
                    $GetUserInfo = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
                    $User = $GetUserInfo->fetch_assoc();
                ?>
                  <a href="inbox.php" class="dropdown-item"> <span class="dropdown-item-avatar
                        text-white"> <img alt="image" src="images/User.png" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $User['FirstName']." ".$User['LastName'] ?></span>
                      <span class="time messege-text"><?php echo $message['Mesg'] ?></span>
                      <span class="time"><?php echo $message['DateTime'] ?></span>
                    </span>
                  </a>
                <?php endwhile; ?>
              </div>
              <div class="dropdown-footer text-center">
                <a href="inbox.php">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg">
              <?php 
                  if($GetNoti['Total']!=0)
                  { ?>
                    <i data-feather="bell" class="bell"></i>
                    <?php  } else {
                ?> 
                <i data-feather="bell" ></i>
              <?php } ?> 
              
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
              <?php 
                    while($notification = $getNotification->fetch_assoc()):
                      if($notification['Status']=="C"){
                ?>
                <a href="notification.php" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <?php echo $notification['Noti'] ?> <span class="time"><?php echo $notification['DateTime'] ?></span>
                  </span>
                </a> 
                <?php
                      }
                    else if($notification['Status']=="I"){
                ?>
                <a href="notification.php" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                  </span> <span class="dropdown-item-desc"> <?php echo $notification['Noti'] ?> <span class="time"><?php echo $notification['DateTime'] ?></span>
                  </span>
                </a>
                <?php
                      }
                    else if($notification['Status']=="D"){
                ?>
                <a href="notification.php" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <?php echo $notification['Noti'] ?> <span class="time"><?php echo $notification['DateTime'] ?></span>
                  </span>
                </a> 
                <?php
                      }
                    endwhile;
                ?>
              </div>
              <div class="dropdown-footer text-center">
                <a href="notification.php">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="images/User.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $_SESSION['Name'] ?></div>
              <a href="..\..\index.php" class="dropdown-item has-icon"> <i class="fa fa-home"></i> Home
              </a>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a>  <a href="change_password.php" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#"  data-toggle="modal" data-target="#logoutModal" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.php"> <img alt="image" src="..\assets/img/icon.png" class="header-logo" /> <span
                class="logo-name">Art Gallary</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Art</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="upload_art.php">Upload new</a></li>
                <li><a class="nav-link" href="all_collection.php">All collection</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Messages</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="inbox.php">Inbox</a></li>
                <li><a class="nav-link" href="sent.php">Sent</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>
	  <div class="main-content">