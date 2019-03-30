<?php require_once('../../private/initialize.php');
    // session_start();
    require_doctor_login();  // this page will access only when doctor is logged in


    $appointment_id = $_GET['appointment_id'] ?? null;
    if(!isset($appointment_id)){
      // redirectTo(urlFor('doctor/my_appointments.php'));
      exit("Appointment_id not passed");
    }
    $appointment = Appointment::findAppointmentById($appointment_id);
    // exit($doctor_id);
    if(!$appointment){
      exit("No Appointment found");
    }

    if(isPostRequest()){
      // Cancel the appointment.

      $appointment->setStatus(Appointment::STATUS_CANCEL_BY_DOCTOR);
      if($appointment->save()){
        // print_array($appointment); exit;
        exit("Appointment successfully canceled");
      }else{
        exit("Error, occur while canceling appointment");
      }

    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cancel Appointment</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER["SCRIPT_NAME"]."?appointment_id=".$appointment->getId(); ?>" method="post">
      <input type="Submit" name="submit" value="Confirm Cancel">
    </form>
  </body>
</html>
