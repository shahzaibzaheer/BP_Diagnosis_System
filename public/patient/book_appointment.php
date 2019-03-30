<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    // $doctors = Doctor::find_all_doctors();
    // print_array($doctors);
    // exit;
    // test appointment class working
    $args = [
      AppointmentTable::COLUMN_PATIENT_PROBLEM => "Lorem Ipsum",
      AppointmentTable::COLUMN_PATIENT_ID => loggedInPatientId(),
      AppointmentTable::COLUMN_DOCTOR_ID => "15",
      AppointmentTable::COLUMN_STATUS => Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR
    ];
    $appointment = new Appointment($args);
    if($appointment->save()){
      exit("Appointment saved successfully");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Book Appointment</title>
  </head>
  <body>
    <h1>Book Appointment</h1>
  </body>
</html>
