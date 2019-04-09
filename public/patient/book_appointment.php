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
    require_once(getSharedFilePath('patient/header.php'));

?>
  <section class="main_content">
    <h1>Book Appointment</h1>

    <form  class="mt-5 col col-sm-10 col-md-8 ml-auto mr-auto" action="<?php echo $_SERVER["SCRIPT_NAME"]; ?>" method="post">
      <div class="form-group">
        <label class="font-weight-bold">Select Doctor</label>
        <select class="form-control" name="<?php echo AppointmentTable::COLUMN_DOCTOR_ID; ?>">
          <?php foreach ($doctors as $doctor): ?>
            <option  value="<?php echo $doctor->getId(); ?>">
              <div class="doctor_detail_item">
                <div class="">
                  <?php echo $doctor->getName() . " (".$doctor->getSpecialization().")"; ?>
                </div><br>

              </div>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="input-group">
        <input  class="input--style-1" type="text" placeholder="Enter Your Problem" name="<?php echo AppointmentTable::COLUMN_PATIENT_PROBLEM; ?>" value="" required>
      </div>


      <input  class="btn btn-primary" type="Submit" name="submit" value="Send Request">
    </form>
  </section>





<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
