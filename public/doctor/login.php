<?php require_once('../../private/initialize.php');
    $errors = [];
    if(isDoctorLoggedIn()){
      redirectTo(urlFor('doctor/index.php'));
    }

    if(isPostRequest()){
    $doctor = new Doctor($_POST);
    if($doctor->login()){
      // print_array($doctor);
      // exit;
      $_SESSION[SessionContract::SESSION_DOCTOR_ID] = $doctor->getId();
      redirectTo(urlFor('doctor/index.php'));
    }
    else {
      // login filed.
      // exit("Login failed");
      $errors = $doctor->getErrors();
      // print_array($doctor->getErrors());
    }

  }
  $page_title = "Doctor Login";
   require_once(getSharedFilePath('main/login_registration_header.php'));

?>


<div class="login_registration_container mt-5">
  <?php echo output_message_if_any(); ?>

  <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
      <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
          <h2 class="text-center mb-4">Doctor Login</h2>
          <div class="form-group">
              <span>Email:    <strong>doctor@gmail.com</strong></span> <br>
              <span>Password: <strong>Doctor123456789</strong></span>
            <p class="text-danger"><?php if(isset($errors['invalidCredantials'])) echo "*".$errors['invalidCredantials']; ?></p>
              <input type="email" name="<?php echo DoctorTable::COLUMN_EMAIL ?>"
              class="form-control <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
              placeholder="Email" required="required"
              onfocus="this.classList.remove('is-invalid');"
              value="doctor@gmail.com">
          </div>
          <div class="form-group">
              <input type="password" name="password"
              class="form-control <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
              placeholder="Password" required="required"
              onfocus="this.classList.remove('is-invalid');"
              value="Doctor123456789">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
          <div class="clearfix">
              <a href="<?php echo urlFor('doctor/forgetPassword.php'); ?>" class=" pull-right">Forgot Password?</a>
          </div>
      </form>
      <p class="text-center"><a href="<?php echo urlFor('doctor/registration.php'); ?>">Create an Account</a></p>
  </div>
</div>
</body>
</html>
