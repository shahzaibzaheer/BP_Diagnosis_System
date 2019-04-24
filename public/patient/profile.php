<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
   // exit("...............".$patient->getGender());
   $errors = [];

    if(isPostRequest()){
      // print_array($_POST);
      $patient->setName($_POST[PatientTable::COLUMN_NAME]);
      $patient->setPhoneNumber($_POST[PatientTable::COLUMN_PHONE]);
      $patient->setAddress($_POST[PatientTable::COLUMN_ADDRESS]);
      $patient->setCity($_POST[PatientTable::COLUMN_CITY]);
      $patient->setGender($_POST[PatientTable::COLUMN_GENDER]);


      if($patient->save()){
        //login successfull
        setMessage("Profile Data Updated successfully");
        redirectTo(urlFor('patient/profile.php'));
      }else {
        // login failed, get errors array
        $errors = $patient->getErrors();
        // print_array($errors);
      }
    }





?>
  <section class="main_content mt-5">
    <?php output_message_if_any(); ?>

    <h1 class="mb-4">My Profile</h1>
    <form class="ask_for_prescription_form col-11 mx-auto col-sm-8 col-md-6 col-lg-5" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div class="input-group">
        <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_NAME])) echo "*".$errors[PatientTable::COLUMN_NAME]; ?></p>
        <input class="input--style-1" type="text" placeholder="Name" name="<?php echo PatientTable::COLUMN_NAME; ?>" value="<?php echo $patient->getName(); ?>">
      </div>
      <div class="input-group">
        <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_PHONE])) echo "*".$errors[PatientTable::COLUMN_PHONE]; ?></p>
        <input class="input--style-1" type="text" placeholder="Phone" name="<?php echo PatientTable::COLUMN_PHONE; ?>"  value="<?php echo $patient->getPhoneNumber(); ?>">
      </div>
      <div class="input-group">
        <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_ADDRESS])) echo "*".$errors[PatientTable::COLUMN_ADDRESS]; ?></p>
        <input class="input--style-1" type="text" placeholder="Address" name="<?php echo PatientTable::COLUMN_ADDRESS; ?>" value="<?php echo $patient->getAddress(); ?>">
      </div>
      <div class="input-group">
        <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_CITY])) echo "*".$errors[PatientTable::COLUMN_CITY]; ?></p>
        <input class="input--style-1" type="text" placeholder="City" name="<?php echo PatientTable::COLUMN_CITY; ?>"  value="<?php echo $patient->getCity(); ?>">
      </div>

      <select class="input-group form-control" name="<?php echo PatientTable::COLUMN_GENDER; ?>">


        <option value="male" <?php if($patient->getGender() == 'male'){ echo "selected";} ?>>Male</option>
        <option value="female" <?php if($patient->getGender() == 'female'){ echo "selected";} ?>>Female</option>
      </select>


      <div class="input-group">
        <input disabled class=" input--style-1" type="text" placeholder="Email" value="<?php echo $patient->getEmail(); ?>">
      </div>


      <input class="btn btn-primary disable" type="submit" name="submit" value="Update">
    </form>
  </section>




<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
