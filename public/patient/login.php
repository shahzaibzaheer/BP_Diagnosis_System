<?php  require_once('../../private/initialize.php');
$errors = [];
$patient = new Patient();
    // session_start();
    if(isPatientLoggedIn()){
      redirectTo(urlFor('patient/index.php'));
    }

  if(isPostRequest()){
    $patient = new Patient($_POST);
    if($patient->login()){
      // exit("Login successfull");
      // $_SESSION['patient_id'] = exit("patient id: ".$patient->getId());
      $_SESSION[SessionContract::SESSION_PATIENT_ID] = $patient->getId();
      // exit($_SESSION[SessionContract::SESSION_PATIETN_ID]);
      redirectTo(urlFor('patient/index.php'));
    }
    else {
      // login filed.
      $errors = $patient->getErrors();
      // print_array($errors);
    }

  }
  require_once(getSharedFilePath('main/login_registration_header.php'));

?>

    <div class="login_registration_container mt-5">

      <?php echo output_message_if_any(); ?>
      <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
          <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
              <h2 class="text-center mb-4">Patient Login</h2>
              <div class="form-group ">

                <p class="text-danger"><?php if(isset($errors['invalidCredantials'])) echo "*".$errors['invalidCredantials']; ?></p>
                <input type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>"
                    class="form-control <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
                    placeholder="Email" required="required"
                    value="<?php echo $patient->getEmail(); ?>"
                    onfocus="this.classList.remove('is-invalid');">

              </div>
              <div class="form-group">
                  <input type="password" name="password"
                      class="form-control  <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
                      placeholder="Password" required="required"
                      onfocus="this.classList.remove('is-invalid');"
                      >
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Log in</button>
              </div>
              <div class="clearfix">
                  <a href="#" class=" pull-right">Forgot Password?</a>
              </div>
          </form>
          <p class="text-center"><a href="<?php echo urlFor('patient/registration.php'); ?>">Create an Account</a></p>
      </div>
    </div>
  </body>
</html>
