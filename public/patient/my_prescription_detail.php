<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    // $prescription
    // this page will receive prescription id, what user want to see
    $prescriptionId = $_GET['id'] ?? null;
    if(isset($prescriptionId)){
      $prescription = Prescription::findPrescriptionById($prescriptionId);
      if(!$prescription){
        exit("No prescription found");
      }
      // else just display the prescription
    }else {
      exit("User don't pass the id, redirect where it should be");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Prescription Detail</title>
    <style media="screen">
      body{
        font-family: sans-serif;
      }
    </style>
  </head>
  <body>
    <h1>Prescription Detail</h1>
    <div class="detail">
        <?php $patient = Patient::find_patient_by_id($prescription->getPatientId());  ?>

        <p><b>Patient Name: </b><?php echo $patient->getName();  ?></p>
        <p><b>Prescription Id: </b> <?php echo $prescription->getPrescriptionId(); ?></p>
        <p><b>Doctor Name: </b> ------------------------ </p>
        <p><b>Prescription Status: </b> <?php echo $prescription->getPrescriptionId(); ?> </p>
        <p><b>Subject: </b> <?php echo $prescription->getSubject(); ?> </p>
        <p><b>LOW BP: </b> <?php echo $prescription->getBpLow(); ?> </p>
        <p><b>High BP: </b> <?php echo $prescription->getBpHigh(); ?> </p>
        <p><b>headache: </b> <?php echo $prescription->getHeadache(); ?> </p>
        <p><b>Dizziness: </b> <?php echo $prescription->getDizziness(); ?> </p>
        <p><b>Any visual changes: </b> <?php echo $prescription->getVisualChanges(); ?> </p>
        <p><b>Medication: </b> <?php echo $prescription->getMedication(); ?> </p>
        <p><b>Food Detail: </b> <?php echo $prescription->getFoodDetail(); ?> </p>
        <p><b>Exercise Detail: </b> <?php echo $prescription->getExerciseDetail(); ?> </p>
        <p><b>Other Info: </b> <?php echo $prescription->getOtherInfo(); ?> </p>
        <p><b>Posted at: </b> <?php echo $prescription->getCreatedOn(); ?> </p>
    </div>
  </body>
</html>
