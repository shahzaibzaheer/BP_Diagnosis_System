<?php  require_once('../../private/initialize.php');
$errors = [];
$doctor = new Doctor();


  if(isPostRequest()){
    $doctor = new Doctor($_POST);
    if($doctor->onForgetPassword()){
      // exit("Login successfull");
      // $_SESSION['patient_id'] = exit("patient id: ".$doctor->getId());
      // exit("redirect to reset password, with the patient id");
      $_SESSION['isDoctorPageOpenThroughForgetPassword'] = "1"; // we don't want to open resetPassword page directly
      redirectTo(urlFor('doctor/resetPassword.php?doctor_id='.$doctor->getId()));
    }
    else {
      // login filed.
      $errors = $doctor->getErrors();
      // print_array($errors);
    }

  }
  $page_title = "Forget Password";
  require_once(getSharedFilePath('main/login_registration_header.php'));

?>

    <div class="login_registration_container mt-5">
      <!-- <div class='alert alert-success alert-dismissible fade show mt-5 col-8 mx-auto '  role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
       Lorem Ipsum lorem ipsum pore asdjfl sdfls jaslf j </div> -->
      <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
          <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
              <h2 class="text-center mb-4">Forget Passwrod ?</h2>
              <div class="form-group ">
                <p class="text-danger"><?php if(isset($errors['invalidCredentials'])) echo "*".$errors['invalidCredentials']; ?></p>
                <input type="text" name="<?php echo DoctorTable::COLUMN_USERNAME ?>"
                    placeholder="Enter Username" required="required"
                    class="form-control"
                    value="<?php echo $doctor->getUserName(); ?>">

              </div>
              <div class="form-group ">
                <input type="text" name="<?php echo DoctorTable::COLUMN_PHONE ?>"
                    placeholder="Enter Phone Number" required="required"
                    class="form-control"
                    value="<?php echo $doctor->getPhone(); ?>">
              </div>

              <div class="form-group">
                <input type="date" name="<?php echo DoctorTable::COLUMN_DATE_OF_BITRH ?>"
                    placeholder="Enter Date of Birth" required="required"
                    class="form-control"
                    value="<?php echo $doctor->getDob(); ?>">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Log in</button>
              </div>

          </form>
          <p class="text-center"><a href="<?php echo urlFor('doctor/registration.php'); ?>">Create an Account</a></p>
      </div>
    </div>
  </body>
</html>
