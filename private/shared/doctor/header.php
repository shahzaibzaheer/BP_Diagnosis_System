<?php
  $doctor_id = loggedInDoctorId();
  $doctor = Doctor::find_doctor_by_id($doctor_id);
 ?>
<!-- Patient Dashboard -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php if(!isset($page_title)){$page_title = "";}?>
    <title><?php echo $page_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo getStylePath("main.css"); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>
  <body>


      <div class="welcome_bar">
        <p>Welcome <?php echo $doctor->getName(); ?> </p><i id="welcome_drop_down_btn" class="fas fa-caret-down"></i>
        <ul class="popOver">
          <li> <a href="<?php echo urlFor("doctor/profile.php"); ?>">My Profile</a> </li>
          <li> <a href="<?php echo urlFor("doctor/changePassword.php"); ?>">Change Password</a> </li>
          <li> <a href="<?php echo urlFor("doctor/doLogout.php"); ?>">Logout</a> </li>
        </ul>
      </div>

    <div class="content">
      <!-- drawer_collapse -->
      <nav class="drawer
      <?php if($page_title=='My Appointments'){echo "drawer_collapse";}; ?>">
         <i id="drawer_icon" class="fas fa-bars"></i>
         <ul>
         <li onclick="location.href='<?php echo urlFor("doctor/index.php"); ?>';"
           class="<?php if($page_title=='Dashboard'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-home"></i>
           <a>Dashbard</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("doctor/prescription_requests.php"); ?>';"
           class="<?php if($page_title=='Prescription Requests'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-capsules"></i>
           <a>Prescription Requests</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("doctor/doctor_answered_prescriptions.php"); ?>';"
           class="<?php if($page_title=='My Answered Prescriptions'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-comment-medical"></i>
           <a>My Answered Prescriptions</a>
         </li>
         <li  onclick="location.href='<?php echo urlFor("doctor/my_appointments.php"); ?>';"
           class="<?php if($page_title=='My Appointments'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-calendar-check"></i>
           <a>My Appointments</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("doctor/report.php"); ?>';"
           class="<?php if($page_title=='View Report'){echo "item_selected";}; ?>">

           <i class="drawer_item_icon fas fa-receipt"></i>
           <a>View Report</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("doctor/profile.php"); ?>';"
           class="<?php if($page_title=='Profile'){echo "item_selected";}; ?>">
           <i class="drawer_item_icon fas fa-user"></i>
           <a>My Profile</a>
         </li>
         <li onclick="location.href='<?php echo urlFor("doctor/doLogout.php"); ?>';">
           <i class="drawer_item_icon fas fa-sign-out-alt"></i>
           <a>Logout</a>
         </li>
       </ul>

      </nav>
