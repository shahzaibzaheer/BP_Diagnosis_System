<?php
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
 ?>
