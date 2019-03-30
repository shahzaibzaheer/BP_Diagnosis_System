<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    $doctors = Doctor::find_all_doctors();
    // print_array($doctors);
    // exit;
    // test appointment class working
    // $args = [
    //   AppointmentTable::COLUMN_PATIENT_PROBLEM => "Lorem Ipsum",
    //   AppointmentTable::COLUMN_PATIENT_ID => loggedInPatientId(),
    //   AppointmentTable::COLUMN_DOCTOR_ID => "15",
    //   AppointmentTable::COLUMN_STATUS => Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR
    // ];
    // $appointment = new Appointment($args);
    if(isPostRequest()){

      $patient_problem = $_POST[AppointmentTable::COLUMN_PATIENT_PROBLEM] ?? "";
      $doctor_id = $_POST[AppointmentTable::COLUMN_DOCTOR_ID] ?? "";
      $patient_id =  loggedInPatientId();

      $appointment = new Appointment();
      $appointment->setPatient_problem($patient_problem);
      $appointment->setDoctor_id($doctor_id);
      $appointment->setPatient_id($patient_id);
      $appointment->setStatus(Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR);
      // print_array($appointment);exit;
      if($appointment->save()){
        exit("Appointment successfully Posted");
      }
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

      <form  action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
        <div>
          <label>Select Doctor:</label>
          <select name="<?php echo AppointmentTable::COLUMN_DOCTOR_ID; ?>">
            <?php foreach ($doctors as $doctor): ?>
              <option value="<?php echo $doctor->getId(); ?>">
                <?php echo "Name: ".$doctor->getName().", Speciality: ".$doctor->getSpecialization().", Fees: ".$doctor->getFees(); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div >
          <label>Your Problem:</label>
          <input type="text" name="<?php echo AppointmentTable::COLUMN_PATIENT_PROBLEM; ?>" value="" required>
        </div>
        <input type="Submit" name="submit" value="Send Request">
      </form>
  </body>
</html>
