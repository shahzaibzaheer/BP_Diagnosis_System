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
    $page_title = "Prescription Detail";
    require_once(getSharedFilePath('doctor/header.php'));
?>

<section class="main_content message_container">
  <h1>Prescription Detail</h1>
  <div class="messages-wrapper">
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
    <!-- <div class="message from">
      <p class="meta-info">By: <b>Shahzaib Mughal </b> , created on: <b>2019-04-10 13:45:58</b> </p>
      This is my second text message</div> -->

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
        </div>


      <?php } ?>
      <!-- Visible the replay box to the user -->
      <div class="replay-box col-12 ">
        <form action="<?php echo $_SERVER['SCRIPT_NAME']."?prescription_id=".$prescription->getPrescriptionId(); ?>" method="post">
          <input class="form-control" type="text" name="replayMessage" value="" placeholder="Enter Your Replay" required>
          <button class="btn btn-primary" type="submit"  name="button"> <i class="fas fa-paper-plane"></i> </button>
        </form>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo getScriptPath('main_script.js'); ?>"></script>
  </body>
  </html>
