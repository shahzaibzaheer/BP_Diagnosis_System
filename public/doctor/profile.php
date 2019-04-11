<?php  require_once('../../private/initialize.php');
    require_doctor_login();
    // this page will access only when doctor is logged in
    require_once(getSharedFilePath('doctor/header.php'));

        if(isPostRequest()){
          // print_array($_POST);
          $doctor->setName($_POST[DoctorTable::COLUMN_NAME]);
          $doctor->setPhone($_POST[DoctorTable::COLUMN_PHONE]);
          $doctor->setAddress($_POST[DoctorTable::COLUMN_ADDRESS]);
          $doctor->setCity($_POST[DoctorTable::COLUMN_CITY]);
          $doctor->setGender($_POST[DoctorTable::COLUMN_GENDER]);
          $doctor->setSpecialization($_POST[DoctorTable::COLUMN_SPECIALIZATION]);
          $doctor->setQualification($_POST[DoctorTable::COLUMN_QUALIFICATION]);
          $doctor->setAbout($_POST[DoctorTable::COLUMN_ABOUT]);
          $doctor->setFees($_POST[DoctorTable::COLUMN_FEES]);


          if($doctor->save()){
            //login successfull
            redirectTo(urlFor('patient/index.php'));
          }else {
            // login failed, get errors array
            $errors = $doctor->getErrors();
            print_array($errors);
          }
        }
?>


<section class="main_content">
    <h1>My Profile</h1>
    <form class="ask_for_prescription_form" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Name" name="<?php echo DoctorTable::COLUMN_NAME; ?>" value="<?php echo $doctor->getName(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Phone" name="<?php echo DoctorTable::COLUMN_PHONE; ?>"  value="<?php echo $doctor->getPhone(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Address" name="<?php echo DoctorTable::COLUMN_ADDRESS; ?>" value="<?php echo $doctor->getAddress(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="City" name="<?php echo DoctorTable::COLUMN_CITY; ?>"  value="<?php echo $doctor->getCity(); ?>">
      </div>

      <select class="input-group form-control" name="<?php echo DoctorTable::COLUMN_GENDER; ?>">
        <option value="male" <?php if($doctor->getGender() == 'male'){ echo "selected";} ?>>Male</option>
        <option value="female" <?php if($doctor->getGender() == 'female'){ echo "selected";} ?>>Female</option>
      </select>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Specialization" name="<?php echo DoctorTable::COLUMN_SPECIALIZATION; ?>"  value="<?php echo $doctor->getSpecialization(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Qualification" name="<?php echo DoctorTable::COLUMN_QUALIFICATION; ?>"  value="<?php echo $doctor->getQualification(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="About" name="<?php echo DoctorTable::COLUMN_ABOUT; ?>"  value="<?php echo $doctor->getAbout(); ?>">
      </div>
      <div class="input-group">
        <input class="input--style-1" type="text" placeholder="Fees" name="<?php echo DoctorTable::COLUMN_FEES; ?>"  value="<?php echo $doctor->getFees(); ?>">
      </div>

      <div class="input-group">
        <input disabled class=" input--style-1" type="text" placeholder="Email" value="<?php echo $doctor->getEmail(); ?>">
      </div>

      <input class="btn btn-primary disable" type="submit" name="submit" value="Update">
    </form>
  </section>




<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
