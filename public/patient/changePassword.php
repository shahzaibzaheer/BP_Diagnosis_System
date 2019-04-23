<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
   // exit("...............".$patient->getGender());
    $errors = [];
    $patient_id = loggedInPatientId();

    if(isPostRequest()){
      // print_array($_POST);
      $patient->setId($patient_id);
      $patient->setCurrentPassword($_POST['currentPassword']);
      $patient->setPassword($_POST['password']);
      $patient->setConfirmPassword($_POST['confirmPassword']);


      if($patient->updatePassword()){
        //updation successfull
        // exit("Password Successfully changed");
        setMessage("Password Successfully Updated");
        // redirectTo(urlFor('patient/changePassword.php'));
      }else {
        // login failed, get errors array
        $errors = $patient->getErrors();
        // print_array($errors);
      }
    }





?>
  <section class="main_content mt-5">
    <?php output_message_if_any(); ?>




    <h1 class="mb-4">Change Password</h1>
    <form class="ask_for_prescription_form col-11 mx-auto col-sm-8 col-md-6 col-lg-5" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">

      <div class="input-group">
        <p class="text-danger mb-0"><?php if(isset($errors['currentPassword'])) echo "*".$errors['currentPassword']; ?></p>
        <input class="input--style-1 " type="password" placeholder="Current Password" name="currentPassword"  />
      </div>
      <div class="input-group">
        <p class="text-danger mb-0"><?php if(isset($errors['password'])) echo "*".$errors['password']; ?></p>
        <input class="input--style-1" type="password" placeholder="New Password" name="password"  />
      </div>
      <div class="input-group">
        <p class="text-danger mb-0"><?php if(isset($errors['confirmPassword'])) echo "*".$errors['confirmPassword']; ?></p>
        <input class="input--style-1" type="password" placeholder="Confirm Password" name="confirmPassword"   />
      </div>





      <input class="btn btn-primary disable" type="submit" name="submit" value="Update">
    </form>
  </section>




<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
