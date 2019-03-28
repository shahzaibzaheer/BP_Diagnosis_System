<?php  require_once('../../private/initialize.php');
    require_patient_login();  // this page will access only when patient is logged in



    if(isPostRequest()){
      // also pass patient id , for which the prescription is for
      $prescription = new Prescription($_POST);
      $prescription->setPatientId(loggedInPatientId());
      if($prescription->save()){
        exit("Prescription Successfully Posted");
      }else {
        print_array($prescription->getErrors());
      }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ask For Prescription</title>
  </head>
  <body>
    <h1>Ask For Prescription</h1>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div>
        <label for="">Subject: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_SUBJECT; ?>" value="">
      </div>
      <div>
        <label for="">BP LOW: </label>
        <input type="number" name="<?php echo PrescriptionTable::COLUMN_BP_LOW; ?>" value="">
      </div>
      <div>
        <label for="">BP HIGH: </label>
        <input type="number" name="<?php echo PrescriptionTable::COLUMN_BP_HIGH; ?>" value="">
      </div>
      <div>
        <label for="">Headache: </label>
        <input type="hidden" name="<?php echo PrescriptionTable::COLUMN_HEADACHE; ?>" value="0">
        <input type="checkbox" name="<?php echo PrescriptionTable::COLUMN_HEADACHE;  ?>" value="1">
      </div>
      <div>
        <label for="">Dizziness: </label>
        <input type="hidden" name="<?php echo PrescriptionTable::COLUMN_DIZZINESS; ?>" value="0">
        <input type="checkbox" name="<?php echo PrescriptionTable::COLUMN_DIZZINESS; ?>" value="1">
      </div>
      <div>
        <label for="">Any Visual Changes: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_VISUAL_CHANGES; ?>" value="">
      </div>
      <div>
        <label for="">Food detail: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_FOOD_DETAIL; ?>" value="">
      </div>
      <div>
        <label for="">Exercise Detail: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_EXERCISE_DETAIL; ?>" value="">
      </div>
      <div>
        <label for="">Medication: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_MEDICATION; ?>" value="">
      </div>
      <div>
        <label for="">Other Info: </label>
        <input type="text" name="<?php echo PrescriptionTable::COLUMN_OTHER_INFO; ?>" value="">
      </div>
      <input type="submit" name="submit" value="post">
    </form>

  </body>
</html>
