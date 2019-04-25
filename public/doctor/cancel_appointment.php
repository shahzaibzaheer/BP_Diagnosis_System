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
      $isConfirmed = isset($_POST['confirm']);
      if($isConfirmed){
        $appointment->setStatus(Appointment::STATUS_CANCEL_BY_DOCTOR);
        if($appointment->save()){
          // print_array($appointment); exit;
          setMessage("Appointment successfully canceled");
          redirectTo(urlFor("doctor/my_appointments.php"));
        }else{
          exit("Error, occur while canceling appointment");
        }
      }else {
        redirectTo(urlFor("doctor/my_appointments.php"));
      }


      // Cancel the appointment.



    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cancel Appointment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
    <div class="container text-center mt-5">
      <h1>Are You Sure?</h1>
    <form class="mt-5 btn-group-lg" action="<?php echo $_SERVER["SCRIPT_NAME"]."?appointment_id=".$appointment->getId(); ?>" method="post">
      <input type="submit" name="cancel" value="No" class="btn btn-light">
        <input type="submit" name="confirm" value="Yes" class="btn btn-danger">
    </form>
  </div>
  </body>
</html>
