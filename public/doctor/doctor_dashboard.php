<?php require_once('../../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor Dashboard</title>
  </head>
  <body>
    <h1>Doctor Dashboard</h1>
    <a href="<?php echo urlFor("doctor/prescription_requests.php"); ?>">Prescription Requests</a><br>
    <a href="<?php echo urlFor("doctor/doctor_answered_prescriptions.php"); ?>">My Answered Prescriptions</a><br>
    <a href="<?php echo urlFor("doctor/doLogout.php"); ?>">Logout</a><br>
    <a href="<?php echo urlFor("doctor/my_appointments.php"); ?>">My Appointments</a><br>

  </body>
</html>
