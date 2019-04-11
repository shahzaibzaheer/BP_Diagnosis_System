<?php  require_once('../../private/initialize.php');
    // session_start();
    require_doctor_login();  // this page will access only when doctor is logged in
    $prescriptionId = $_GET['prescription_id'] ?? null;


    if(isPostRequest()){
      // print_array($_POST);

      $replayMessage = $_POST['replayMessage'] ?? '';
      $replay = new Replay();
      $replay->setReplayMessage($replayMessage);
      $replay->setDoctorReplay(true);
      $replay->setPrescriptionId($prescriptionId);

      if($replay->save()){
        //replay saved successfull, refresh the page
        // exit("Replay saved successfully ");
        // Now also save the doctor id in the prescrition.
        $prescription = Prescription::findPrescriptionById($prescriptionId);
        $prescription->setDoctorId(loggedInDoctorId());
        $prescription->setStatus(Prescription::STATUS_ANSWERED);
        // exit("Doctor Id: ".loggedInDoctorId());
        if($prescription->save()){
          redirectTo($_SERVER['SCRIPT_NAME']."?prescription_id=".$prescriptionId);
        }else {
          print_array($prescription->getErrors());
          exit;
        }
        // redirectTo(urlFor('doctor/login.php'));

      }else {
        exit("error, while saving the replay into the database");
      }
    }

    // print_array($_GET); exit;
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
    require_once(getSharedFilePath('doctor/header.php'));
?>

    <section class="main_content message_container">
      <h1>Prescription Detail</h1>
      <div class="message-wrapper">
        <div class="message from">
          <p class="meta-info">Created On: <b><?php echo $prescription->getCreatedOn(); ?></b></p>
              <p>
                <b>Subject: </b> <?php echo $prescription->getSubject(); ?> <br>
                <b>BP Reading: </b> <?php echo $prescription->getBpLow(). " low, ".$prescription->getBpHigh()." high "; ?> <br>
                <b>Headache: </b> <?php echo  $prescription->getHeadache()=='1'?  "Yes": "No"; ?> <br>
                <b>Any Visual Change: </b> <?php echo $prescription->getVisualChanges(); ?> <br>
                <b>Dizziness: </b> <?php echo $prescription->getDizziness()=='1'?  "Yes": "No"; ?> <br>
                <b>Medication: </b> <?php echo $prescription->getMedication(); ?> <br>
                <b>Food Detail: </b> <?php echo $prescription->getFoodDetail(); ?> <br>
                <b>Exercise Detail: </b> <?php echo $prescription->getExerciseDetail(); ?> <br>
                <b>Other Information: </b> <?php echo $prescription->getOtherInfo(); ?> <br>
              </p>
        </div>

        <?php
          $replies = Replay::find_replies_by_prescription_id($prescription->getPrescriptionId());
          if($replies){?>
              <!-- Output All the replies  -->
              <?php foreach ($replies as $reply):
                 if($reply->isDoctorReplay()){?> <!-- If is doctor's reply -->
                 <div class="message to">
                   <p class="meta-info">created on: <b><?php echo $reply->getCreatedOn(); ?></b> </p>
                   <p><?php echo $reply->getReplayMessage(); ?></p>
                 </div>
               <?php }else{?>
                 <div class="message from">
                   <p class="meta-info">created on: <b><?php echo $reply->getCreatedOn(); ?></b> </p>
                   <p><?php echo $reply->getReplayMessage(); ?></p>
                 </div>
                 <?php } ?>

              <?php endforeach; ?>
          <?php } ?>
          <!-- Visible the replay box to doctor -->
      </div>
      <div class="replay-box">
        <form action="<?php echo $_SERVER['SCRIPT_NAME']."?prescription_id=".$prescription->getPrescriptionId(); ?>" method="post">
          <input class="form-control" type="text" name="replayMessage" value="" placeholder="Enter Your Replay">
          <button class="btn btn-primary" type="submit"  name="button"> <i class="fas fa-paper-plane"></i> </button>
        </form>
      </div>
    </section>

<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
