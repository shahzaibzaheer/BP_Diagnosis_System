<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Dashboard</title>
  </head>
  <body>
      <h1>Patient Dashboard</h1>
      <a href="<?php echo urlFor("patient/doLogout.php"); ?>">Logout</a> <br>
      <a href="<?php echo urlFor("patient/ask_for_prescription.php"); ?>">Ask For Prescription</a><br>
      <a href="<?php echo urlFor("patient/my_prescriptions.php"); ?>">My Prescription</a> <br>
      <a href="<?php echo urlFor("patient/book_appointment.php"); ?>">Book Appointment</a>
  </body>
</html>
