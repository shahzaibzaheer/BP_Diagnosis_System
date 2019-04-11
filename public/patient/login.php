<?php  require_once('../../private/initialize.php');
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
      print_array($patient->getErrors());
    }

  }
  require_once(getSharedFilePath('main/login_registration_header.php'));

?>

    <div class="login_registration_container mt-5">
      <div class="login-form col-4 mx-auto">
          <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
              <h2 class="text-center mb-4">Patient Login</h2>
              <div class="form-group">
                  <input type="text" name="<?php echo PatientTable::COLUMN_EMAIL ?>" class="form-control" placeholder="Email" required="required">
              </div>
              <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password" required="required">
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
