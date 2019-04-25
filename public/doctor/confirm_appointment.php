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
        // exit("Appointment successfully confirment");
        redirectTo(urlFor('doctor/my_appointments.php'));
      }else{
        exit("Error, occur while saving appointment");
      }

    }
    $page_title = "Confirm Appointment";
    require_once(getSharedFilePath('doctor/header.php'));

?>
<section class="main_content mt-5">
      <h1>Confirm Appointment</h1>
      <form class="ask_for_prescription_form col-11 mx-auto col-sm-8 col-md-6 col-lg-5 mt-5" action="<?php echo $_SERVER["SCRIPT_NAME"]."?appointment_id=".$appointment->getId(); ?>" method="post">
        <div class="form-group">
          <label>Appointment Date</label>
          <input  class="form-control" type="date" name="<?php echo AppointmentTable::COLUMN_APPOINTMENT_DATE; ?>" value="" required>
        </div>
        <div  class="form-group">
          <label>Appointment Time</label>
          <input  class="form-control" type="time" name="<?php echo AppointmentTable::COLUMN_APPOINTMENT_TIME; ?>" value="" required>
        </div>
        <input type="Submit"  class="btn btn-primary" name="submit" value="Confirm Appointment">
      </form>
    </section>


<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
