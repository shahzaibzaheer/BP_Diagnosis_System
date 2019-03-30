<?php  require_once('../../private/initialize.php');
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
    // print_array($appointment); exit;

        // AppointmentTable::COLUMN_APPOINTMENT_DATE => $this->getDate(),
        // AppointmentTable::COLUMN_APPOINTMENT_TIME => $this->getTime(),
        // AppointmentTable::COLUMN_STATUS => $this->getStatus()

    if(isPostRequest()){
      // grab required data and update the appointment.
      $appointmentDate = $_POST[AppointmentTable::COLUMN_APPOINTMENT_DATE] ?? "";
      $appointmentTime = $_POST[AppointmentTable::COLUMN_APPOINTMENT_TIME] ?? "";

      // var_dump($appointmentTime);
      $appointment->setDate($appointmentDate);
      $appointment->setTime($appointmentTime);
      $appointment->setStatus(Appointment::STATUS_CONFIRMED_BY_DOCTOR);
      if($appointment->save()){
        // print_array($appointment); exit;
        exit("Appointment successfully confirment");
      }else{
        exit("Error, occur while saving appointment");
      }

    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Confirm Appointment</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER["SCRIPT_NAME"]."?appointment_id=".$appointment->getId(); ?>" method="post">
      <div>
        <label>Appointment Date</label>
        <input type="date" name="<?php echo AppointmentTable::COLUMN_APPOINTMENT_DATE; ?>" value="" required>
      </div>
      <div>
        <label>Appointment Time</label>
        <input type="time" name="<?php echo AppointmentTable::COLUMN_APPOINTMENT_TIME; ?>" value="" required>
      </div>
      <input type="Submit" name="submit" value="Confirm Appointment">
    </form>
  </body>
</html>
