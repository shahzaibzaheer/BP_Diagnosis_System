<?php  require_once('../../private/initialize.php');
    require_doctor_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('doctor/header.php'));

    $doctor_id = loggedInDoctorId();
    $appointments = Appointment::findConfirmedAppointmentsByDoctorId($doctor_id);
    $prescriptions = Prescription::find_prescriptions_by_doctor_id($doctor_id);


?>


<section  class="main_content">
  <h1>Report</h1>
  <div class="card">
    <h4>Appointments Report</h4>
    <?php
    if(!$appointments){
      echo " <p>You have no any appointments</p> ";
    }else {

      foreach ($appointments  as $appointment) {
        echo "<p>* Appointment with <b>".$appointment->getPatient()->getName()."</b> at ".$appointment->getDate()."/".$appointment->getTime()."   </p>";
      }

    }

    ?>
    <!-- <p>*** Appointment with PATIENT_NAME at TIME</p> -->
  </div>
  <div class="card">
    <h4>Prescriptions Report</h4>
    <?php
    if(!$prescriptions){
      echo " <p>You don't asked for any prescription</p> ";
    }else {

      foreach ($prescriptions  as $prescription) {
        $prescriptionReport = "<p>* You Answered To ".$prescription->getPatientName()."'s  prescription  about <b>\"".$prescription->getSubject() ."\" </b> ";
        // if($prescription->getStatus() == Prescription::STATUS_ANSWERED){
        // $prescriptionReport .= ", That was replied by ".$prescription->getDoctorName();
        // }
        $prescriptionReport .= "</p>";
        echo $prescriptionReport;
      }

    }

    ?>

    <!-- <p>*** Your Ansered to PatientName's Prescription about "subject" at TIME</p> -->
  </div>




</section>




<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
