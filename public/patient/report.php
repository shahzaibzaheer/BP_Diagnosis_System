<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
    $patientId = loggedInPatientId();
    // grab all patient's appointments
    $appointments = Appointment::findConfirmedAppointmentsByPatientId($patientId);
    $prescriptions = Prescription::findPrescriptionsByPatientId($patientId);

    // print_array($appointments);
    // exit;

?>
<button  class="btn btn-primary" onclick="printDiv('printMe')" name="button" style="position: fixed; right:0; margin-top:80px">Print</button>
<section id='printMe' class="main_content">
  <h1>Report</h1>
  <div class="card">
    <h4>Appointments Report</h4>
    <?php
    if(!$appointments){
      echo " <p>You have no any appointments</p> ";
    }else {

      foreach ($appointments  as $appointment) {
        echo "<p>* Appointment with <b>".$appointment->getDoctor()->getName()."</b> at ".$appointment->getDate()."/".$appointment->getTime()."   </p>";
      }

    }

    ?>
    <!-- <p>*** Appointment with DOCTOR_NAME at TIME</p> -->
  </div>
  <div class="card">
    <h4>Prescriptions Report</h4>
    <?php
    if(!$prescriptions){
      echo " <p>You don't asked for any prescription</p> ";
    }else {

      foreach ($prescriptions  as $prescription) {
        $prescriptionReport = "<p>* You Asked For Prescription <b>\"".$prescription->getSubject() ."\"</b>";
        $prescriptionReport .= " at ".$prescription->getCreatedOn();
        // if($prescription->getStatus() == Prescription::STATUS_ANSWERED){
        // $prescriptionReport .= ", That was replied by ".$prescription->getDoctorName();
        // }
        $prescriptionReport .= "</p>";
        echo $prescriptionReport;
      }

    }

    ?>

    <!-- <p>*** Asked For Prescription about  PROBLEM at TIME</p> -->
  </div>


  <script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>

</section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
