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
    <a href="<?php echo urlFor("doctor/prescription_requests.php"); ?>">Prescription Requests</a>
    <a href="<?php echo urlFor("doctor/doctor_answered_prescriptions.php"); ?>">My Answered Prescriptions</a>

  </body>
</html>
