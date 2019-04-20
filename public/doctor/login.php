<?php require_once('../../private/initialize.php');
    // $doctor = Doctor::find_doctor_by_email("shahzaib@gmail.com");
    // $result = password_verify('Shahzaib12345', $doctor->getHashedPassword());
    // var_dump($result);
    // print_array($doctor);
    // exit;
    // session_start();
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
      print_array($doctor->getErrors());
    }

   }
   require_once(getSharedFilePath('main/login_registration_header.php'));

?>


<div class="login_registration_container mt-5">
  <div class="login-form col-4 mx-auto">
      <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
          <h2 class="text-center mb-4">Doctor Login</h2>
          <div class="form-group">
              <input type="email" name="<?php echo DoctorTable::COLUMN_EMAIL ?>" class="form-control" placeholder="Email" required="required">
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
      <p class="text-center"><a href="<?php echo urlFor('doctor/registration.php'); ?>">Create an Account</a></p>
  </div>
</div>
</body>
</html>
