<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in

    $prescriptionId = $_GET['prescription_id'] ?? null;
    if(isPostRequest()){
          // print_array($_POST);
          $replayMessage = $_POST['replayMessage'] ?? '';
          $replay = new Replay();
          $replay->setReplayMessage($replayMessage);
          $replay->setDoctorReplay(false);
          $replay->setPrescriptionId($prescriptionId);

          if($replay->save()){
            //replay saved successfull, refresh the page
            // redirectTo(urlFor('doctor/login.php'));
            exit("Patient replay successfully posted");

          }else {
            exit("error, while saving the replay into the database");
          }
        }


    // $prescription
    // this page will receive prescription id, that user want to see
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

        <p><b>Patient Name: </b><?php echo $prescription->getPatientName();  ?></p>
        <p><b>Prescription Id: </b> <?php echo $prescription->getPrescriptionId(); ?></p>
        <p><b>Doctor Name: </b>  <?php echo $prescription->getDoctorName(); ?> </p>
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

        <!-- agr kisi doctor ny reply kiya hy, tb hi user ko replay wali functionality do -->
        <?php
          $replies = Replay::find_replies_by_prescription_id($prescription->getPrescriptionId());
          if(!$replies){
            echo "No doctor replay this post";
          }else { ?>
            <!-- First output all the replies -->
              <?php
                $replies = Replay::find_replies_by_prescription_id($prescription->getPrescriptionId());
                print_array($replies);
              ?>

            <form action="<?php echo $_SERVER['SCRIPT_NAME']."?prescription_id=".$prescription->getPrescriptionId(); ?>" method="post">
                <input type="text" name="replayMessage" value="" placeholder="Replay" required>
                <input type="Submit" name="submit" value="submit">
            </form>
        <?php
          }
        ?>
    </div>
  </body>
</html>
