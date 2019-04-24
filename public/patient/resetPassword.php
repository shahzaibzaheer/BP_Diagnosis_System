<?php  require_once('../../private/initialize.php');

  $is_page_open_from_forget_passwod_page = isset($_SESSION['isPageOpenThroughForgetPassword']) && $_SESSION['isPageOpenThroughForgetPassword'] == "1";

  $patient_id = $_GET['patient_id'] ?? false;
  if(!$is_page_open_from_forget_passwod_page || $patient_id == false){
    redirectTo(urlFor('/index.php'));
  }



  // now let the user to create new password


  $errors = [];

  if(isPostRequest()){
      $patient = Patient::find_patient_by_id($patient_id);
      $patient->setPassword($_POST['password'] ?? '');
      $patient->setConfirmPassword($_POST['confirmPassword'] ?? '');
      if($patient){
        if($patient->resetPassword()){
          // var_dump($patient); exit;
            $_SESSION['isPageOpenThroughForgetPassword'] = "0";
            setMessage("Password reset Successfully, Please Login");
            redirectTo(urlFor('patient/login.php'));
            exit;
        }else {
          $errors = $patient->getErrors();
          // var_dump($errors); exit;

        }
      }else {
        exit("Error while fetching the patient data");
      }
  }

    require_once(getSharedFilePath('main/login_registration_header.php'));

?>


<div class="login_registration_container mt-5">
  <!-- <div class='alert alert-success alert-dismissible fade show mt-5 col-8 mx-auto '  role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
   Lorem Ipsum lorem ipsum pore asdjfl sdfls jaslf j </div> -->
  <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
      <form  action="<?php echo $_SERVER['SCRIPT_NAME']."?patient_id=".$patient_id; ?>" method="post">
          <h2 class="text-center mb-4">Reset Your Password</h2>

          <div class="form-group">
            <p class="text-danger mb-0"><?php if(isset($errors['password'])) echo "*".$errors['password']; ?></p>
            <div class="input-group mt-2">
              <input class="input--style-1 form-control <?php if(isset($errors['password'])) echo "is-invalid" ?>"
                type="password" placeholder="New Password" name="password"
                onfocus="this.classList.remove('is-invalid');" />
            </div>
          </div>

          <div class="form-group">
            <p class="text-danger mb-0"><?php if(isset($errors['confirmPassword'])) echo "*".$errors['confirmPassword']; ?></p>
            <div class="input-group mt-2">
              <input class="input--style-1 form-control <?php if(isset($errors['confirmPassword'])) echo "is-invalid" ?>"
              type="password" placeholder="Confirm Password" name="confirmPassword"
              onfocus="this.classList.remove('is-invalid');" />
            </div>
          </div>

          <div class="form-group mt-2">
              <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
      </form>
      <p class="text-center"><a href="<?php echo urlFor('patient/registration.php'); ?>">Create an Account</a></p>
  </div>
</div>
</body>
</html>
