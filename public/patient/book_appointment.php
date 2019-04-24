<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    $doctor = new Doctor();
    $isDoctorSelected = isset($_GET['doctor_id']) ? true : false;
    if($isDoctorSelected){
      $doctor_id =  $_GET['doctor_id'];
      $doctor = Doctor::find_doctor_by_id($doctor_id);
      if(!$doctor){
        exit("Error while fecthing doctor");
      }

    }



    // $doctors = Doctor::find_all_doctors();
    // // print_array($doctors);
    // // exit;
    // // test appointment class working
    // // $args = [
    // //   AppointmentTable::COLUMN_PATIENT_PROBLEM => "Lorem Ipsum",
    // //   AppointmentTable::COLUMN_PATIENT_ID => loggedInPatientId(),
    // //   AppointmentTable::COLUMN_DOCTOR_ID => "15",
    // //   AppointmentTable::COLUMN_STATUS => Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR
    // // ];
    // // $appointment = new Appointment($args);
    if(isPostRequest()){

      $patient_problem = $_POST[AppointmentTable::COLUMN_PATIENT_PROBLEM] ?? "";
      $doctor_id = $_GET[AppointmentTable::COLUMN_DOCTOR_ID] ?? "";
      $patient_id =  loggedInPatientId();

      $appointment = new Appointment();
      $appointment->setPatient_problem($patient_problem);
      $appointment->setDoctor_id($doctor_id);
      $appointment->setPatient_id($patient_id);
      $appointment->setStatus(Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR);
      // print_array($appointment);exit;
      if($appointment->save()){
        setMessage("Your Request for appointment is transfered toward the doctor");
        redirectTo(urlFor('patient/my_appointments.php'));
      }
    }
    $page_title = "Book Appointment";
    require_once(getSharedFilePath('patient/header.php'));

?>
  <section class="main_content mt-5 ">
    <h1 class="mb-5">Book Appointment</h1>

    <form  class="col-11 mx-auto col-sm-8 col-md-6" action="<?php echo $_SERVER["SCRIPT_NAME"]."?".AppointmentTable::COLUMN_DOCTOR_ID."=".$doctor->getId(); ?>" method="post">
      <?php if(!$isDoctorSelected){ ?>
        <div class="form-group">
          <button onclick="location.href='<?php echo urlFor("patient/doctors.php"); ?>';" class="btn btn-outline-primary mb-5">Select Doctor</button>
        <?php }else{?>
            <!-- display seleted doctor name, with button to change selection  -->
            <div  class="seleted_doctor card text-center" >
              <h5 class="card-title text-capitalize p-4"><?php echo $doctor->getName(); ?></h5>
              <div class="card-subtitle"><?php echo $doctor->getQualification(); ?></div>
              <div class="card-subtitle"><?php echo $doctor->getSpecialization(); ?></div>
              <div class="card-subtitle">Fees: Rs <?php echo $doctor->getFees(); ?>/-</div>
            </div>
            <button class="btn btn-outline-primary mb-4 mt-1" onclick="location.href='<?php echo urlFor("patient/doctors.php"); ?>';" >Change Seletion</button>

          <?php } ?>
      <div class="input-group">
        <input  class="input--style-1" type="text" placeholder="Enter Your Problem" name="<?php echo AppointmentTable::COLUMN_PATIENT_PROBLEM;  ?>" value="" required  >
      </div>


      <input  class="btn btn-primary" type="Submit" name="submit" value="Send Request">
    </form>
  </section>





<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
