<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in



    if(isPostRequest()){
      // also pass patient id , for which the prescription is for
      $prescription = new Prescription($_POST);
      $prescription->setPatientId(loggedInPatientId());
      if($prescription->save()){
        // exit("Prescription Successfully Posted");
        redirectTo(urlFor("patient/my_prescriptions.php"));
      }else {
        print_array($prescription->getErrors());
      }
    }

    require_once(getSharedFilePath('patient/header.php'));

?>
  <section class="main_content">
    <h1>Ask For Prescription</h1>
    <form class="ask_for_prescription_form" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Subject" name="<?php echo PrescriptionTable::COLUMN_SUBJECT; ?>" value="">
      </div>
        <div class="d-flex">
          <div class="input-group mr-4">
            <input class="input--style-1 " type="number"  placeholder="BP LOW" name="<?php echo PrescriptionTable::COLUMN_BP_LOW; ?>" value="">
          </div>
          <div  class="input-group ml-4">
            <input class="input--style-1" type="number"  placeholder="BP HIGH " name="<?php echo PrescriptionTable::COLUMN_BP_HIGH; ?>" value="">
          </div>
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Any Visual Changes" name="<?php echo PrescriptionTable::COLUMN_VISUAL_CHANGES; ?>" value="">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Food detail" name="<?php echo PrescriptionTable::COLUMN_FOOD_DETAIL; ?>" value="">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Exercise Detail" name="<?php echo PrescriptionTable::COLUMN_EXERCISE_DETAIL; ?>" value="">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Medication" name="<?php echo PrescriptionTable::COLUMN_MEDICATION; ?>" value="">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Other Info" name="<?php echo PrescriptionTable::COLUMN_OTHER_INFO; ?>" value="">
      </div>
      <div class="form-checkboxes">
        <div class="form-checkbox">
          <label for="">Headache </label>
          <input  class="form-check-input" type="checkbox" name="<?php echo PrescriptionTable::COLUMN_HEADACHE;  ?>" value="1">
          <input  class="form-check-input" type="hidden" name="<?php echo PrescriptionTable::COLUMN_HEADACHE; ?>" value="0">
        </div>
        <div class="form-checkbox">
          <label for="">Dizziness </label>
          <input  class="form-check-input" type="checkbox" name="<?php echo PrescriptionTable::COLUMN_DIZZINESS; ?>" value="1">
          <input  class="form-check-input" type="hidden" name="<?php echo PrescriptionTable::COLUMN_DIZZINESS; ?>" value="0">
        </div>
      </div>

      <input class="btn btn-primary" type="submit" name="submit" value="Send">
    </form>
  </section>


<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
