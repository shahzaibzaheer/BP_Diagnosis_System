<?php  require_once('../../private/initialize.php');
if(isPatientLoggedIn()){
  redirectTo(urlFor('patient/patient_dashboard.php'));
}

  $patient = new Patient([]);  // for preventing error , when get request

  if(isPostRequest()){
    // print_array($_POST);
    $patient = new Patient($_POST);
    if($patient->save()){
      //login successfull
      redirectTo(urlFor('patient/login.php'));
    }else {
      // login failed, get errors array
      $errors = $patient->getErrors();
      print_array($errors);
    }
  }


  require_once(getSharedFilePath('main/login_registration_header.php'));

?>

      <div class="login_registration_container mt-5">
        <div class="login-form col-4 mx-auto">
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
                <h2 class="text-center mb-4">Patient Registration</h2>

              <div class="form-group" >
                <input class="form-control" placeholder="Name" type="text" name="<?php echo PatientTable::COLUMN_NAME ?>" value="<?php echo $patient->getName(); ?>" >
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Username" type="text" name="<?php echo PatientTable::COLUMN_USERNAME ?>" value="<?php echo $patient->getUserName(); ?>" >
              </div>
              <div class="form-group" >
                <input class="form-control" placeholder="Email" type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>" value="<?php echo $patient->getEmail(); ?>" >
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" type="text" name="<?php echo PatientTable::COLUMN_PHONE ?>" value="<?php echo $patient->getPhoneNumber(); ?>" >
              </div>
              <div class="form-group" >
                <input class="form-control" placeholder="City" type="text" name="<?php echo PatientTable::COLUMN_CITY ?>" value="<?php echo $patient->getCity(); ?>" >
              </div>
              <div class="form-group" >
                <input class="form-control" placeholder="Address" type="text" name="<?php echo PatientTable::COLUMN_ADDRESS ?>" value="<?php echo $patient->getAddress(); ?>" >
              </div>
              <div class="form-group">
                <select class="form-control" name="<?php echo PatientTable::COLUMN_GENDER; ?>" >
                  <option value="male" checked> Male </option>
                  <option value="female"> Female </option>
                </select>
              </div>
              <div class="form-group" >
                <input class="form-control"  type="date" name="<?php echo PatientTable::COLUMN_DATE_OF_BITRH ?>" value="<?php echo $patient->getDOB(); ?>" >
              </div>
              <div class="form-group" >
                <input class="form-control" placeholder="Password" type="password" name="password" value="" >
              </div>
              <div class="form-group" >
                <input class="form-control" placeholder="Confirm Password" type="password" name="confirmPassword" value="" >
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <a href="#" class=" pull-right">Forgot Password?</a>
            </form>
            <p class="text-center">Already Registered ?<a href="<?php echo urlFor('patient/login.php'); ?>"> Log In</a></p>
        </div>
      </div>


  </body>
</html>
