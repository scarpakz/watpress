<?php
  include 'controller/gpsvalidation.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/materialize.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/OFFICIAL_LOGO_Pugong.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>WatPress</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://rawgithub.com/DmitryBaranovskiy/raphael/300aa589f5a0ba7fce667cd62c7cdda0bd5ad904/raphael-min.js"></script>
        <script src="https://rawgithub.com/DmitryBaranovskiy/g.raphael/master/g.raphael.js"></script>
        <script src="https://rawgithub.com/DmitryBaranovskiy/g.raphael/master/g.pie.js"></script>
        <script>
          //Load Notification
          $(document).ready(function(){
            $("#dropdown_notif").click(function(){
              $("loadNotification").load("controller/gpsvalidation.php",{

              });
            });
          });
        </script>
    </head>
    <body>

            <!-- DROPDOWN CONTENT -->
            <ul id="dropdown_admin" class="dropdown-content">
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="controller/logout.php">Sign Out</a></li>
            </ul>
            <!-- DROPDOWN NOTIFICATION -->
            <ul id='dropdown_notif' style="min-width: 500px !important;left:600px;" class='dropdown-content collection'>
              <?php if($locationName == ""){?>
              <li class="collection-item avatar">
                  <img src="images/notification-logo.png" alt="notification_logo" class="circle">
          				<span class="title">No Device found
                    <p>Installation of device is required.</p>
                  </span>
              </li>
              <?php } else { ?>
               <li id="loadNotification" class="collection-item avatar">
                  <img src="images/notification-logo.png" alt="notification_logo" class="circle">
          				<span class="title">DEVICE UPDATE
                    <p>New Location!</p>
                    <h6><?php echo $locationName;?></h6>
                    <h6>Latitude: <?php echo $latitude;?></h6>
                    <h6>Longitude: <?php echo $longitude;?></h6>
                    <h6><?php echo Date('d-M-Y');?></h6>
                  </span>
                  <form action="controller/gpsconfirm.php" method="post">
                    <button class="btn waves-effect waves-light blue" value="<?php echo $id; ?>?confirm=1" type="submit" name="value">Confirm</button>
                    <button class="btn waves-effect waves-light red" value="<?php echo $id; ?>?confirm=0" type="submit" name="value">Decline</button>
                  </form>
                </li>
              <?php }?>
            </ul>

            <nav>
                <div class="nav-wrapper blue">
                    <div class="container">
                        <a href="" class="brand-logo">WatPress</a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="main.php">Main View</a></li>
                            <!-- <i class="material-icons right">arrow_drop_down</i> -->
                            <!-- <li><a href="" class="dropdown-trigger" data-target="dropdown_refer">Management</a></li> -->
                            <!-- Dropdown Trigger -->
                            <li><a href="" class="dropdown-trigger" data-target="dropdown_notif" data-activates="dropdown_notif" data-beloworigin="true" data-constrainWidth="true">Notification<i class="material-icons right">arrow_drop_down</i>
                              <!-- <span class="new badge" data-badge-caption="">1</span></a></li> -->
                            <li><a href="" class="dropdown-trigger" data-target="dropdown_admin" data-beloworigin="true">Admin Settings<i class="material-icons right">arrow_drop_down</i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
