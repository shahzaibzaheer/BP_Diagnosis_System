<?php
  $admin_id = loggedInAdminId();
  $admin = Admin::find_admin_by_id($admin_id);
 ?>
<!-- Patient Dashboard -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php if(!isset($page_title)){$page_title = "";}?>
    <title><?php echo $page_title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>
  <body>


      <div class="welcome_bar">
        <p>Welcome <?php echo $admin->getName(); ?> </p><i id="welcome_drop_down_btn" class="fas fa-caret-down"></i>
        <ul class="popOver">
          <li> <a href="<?php echo urlFor("admin/profile.php"); ?>">My Profile</a> </li>
          <li> <a href="<?php echo urlFor("admin/changePassword.php"); ?>">Change Password</a> </li>
          <li> <a href="<?php echo urlFor("admin/doLogout.php"); ?>">Logout</a> </li>
        </ul>
      </div>

    <div class="content">
      <!-- drawer_collapse -->
      <nav class="drawer
        <?php if($page_title=='Manage Patients' ||$page_title=='Manage Doctors'){echo "drawer_collapse";}; ?>">
         <i id="drawer_icon" class="fas fa-bars"></i>
         <ul>
         <li onclick="location.href='<?php echo urlFor("admin/index.php"); ?>';"
           class="<?php if($page_title=='Dashboard'){echo "item_selected";}; ?>">
           <i class="drawer_item_icon fas fa-home"></i>
           <a>Dashbard</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("admin/profile.php"); ?>';"
           class="<?php if($page_title=='Profile'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-user"></i>
           <a>My Profile</a>
         </li>

         <li onclick="location.href='<?php echo urlFor("admin/managePatients.php"); ?>';"
           class="<?php if($page_title=='Manage Patients'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-user-injured"></i>
           <a>Manage Patients</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("admin/manageDoctors.php"); ?>';"
           class="<?php if($page_title=='Manage Doctors'){echo "item_selected";}; ?>">
           <i class="drawer_item_icon fas fa-user-md"></i>
           <a>Manage Doctors</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("admin/appointmentHistory.php"); ?>';"
           class="<?php if($page_title=='Appointment History'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-calendar-check"></i>
           <a>View Appointments</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("admin/feedbacks.php"); ?>';"
           class="<?php if($page_title=="Users Feedbacks"){echo "item_selected";}; ?>">
           <i class="drawer_item_icon fas fa-star-half-alt"></i>
           <a>User's Feedback</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("admin/doLogout.php"); ?>';">
           <i class="drawer_item_icon fas fa-sign-out-alt"></i>
           <a>Logout</a>
         </li>

       </ul>

      </nav>
