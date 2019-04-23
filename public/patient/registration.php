<?php  require_once('../../private/initialize.php');
if(isPatientLoggedIn()){
  redirectTo(urlFor('patient/patient_dashboard.php'));
}
  $errors = [];
  $patient = new Patient([]);  // for preventing error , when get request

  if(isPostRequest()){
    // print_array($_POST);
    $patient = new Patient($_POST);
    if($patient->save()){
      //login successfull
      setMessage("Registration Successful :-)");
      redirectTo(urlFor('patient/login.php'));
    }else {
      // login failed, get errors array
      $errors = $patient->getErrors();
      // print_array($errors);
    }
  }


  require_once(getSharedFilePath('main/login_registration_header.php'));

?>

      <div class="login_registration_container mt-5">
        <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
                <h2 class="text-center mb-4">Patient Registration</h2>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_NAME])) echo "*".$errors[PatientTable::COLUMN_NAME]; ?></p>
                <input
                onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_NAME])) echo "is-invalid" ?>"
                    placeholder="Name" type="text" name="<?php echo PatientTable::COLUMN_NAME ?>" value="<?php echo $patient->getName(); ?>" >
              </div>
              <div class="form-group">
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_USERNAME])) echo "*".$errors[PatientTable::COLUMN_USERNAME]; ?></p>
                <input
                onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_USERNAME])) echo "is-invalid" ?>"
                    placeholder="Username" type="text" name="<?php echo PatientTable::COLUMN_USERNAME ?>" value="<?php echo $patient->getUserName(); ?>" >
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_EMAIL])) echo "*".$errors[PatientTable::COLUMN_EMAIL]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_EMAIL])) echo "is-invalid" ?>"
                    placeholder="Email" type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>" value="<?php echo $patient->getEmail(); ?>" >
              </div>
              <div class="form-group">
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_PHONE])) echo "*".$errors[PatientTable::COLUMN_PHONE]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_PHONE])) echo "is-invalid" ?>"
                    placeholder="Phone Number" type="text" name="<?php echo PatientTable::COLUMN_PHONE ?>" value="<?php echo $patient->getPhoneNumber(); ?>" >
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_CITY])) echo "*".$errors[PatientTable::COLUMN_CITY]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_CITY])) echo "is-invalid" ?>"
                    placeholder="City" type="text" name="<?php echo PatientTable::COLUMN_CITY ?>" value="<?php echo $patient->getCity(); ?>" >
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_ADDRESS])) echo "*".$errors[PatientTable::COLUMN_ADDRESS]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_ADDRESS])) echo "is-invalid" ?>"
                    placeholder="Address" type="text" name="<?php echo PatientTable::COLUMN_ADDRESS ?>" value="<?php echo $patient->getAddress(); ?>" >
              </div>
              <div class="form-group">
                <select class="form-control" name="<?php echo PatientTable::COLUMN_GENDER; ?>" >
                  <option value="male" checked> Male </option>
                  <option value="female"> Female </option>
                </select>
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors[PatientTable::COLUMN_DATE_OF_BITRH])) echo "*".$errors[PatientTable::COLUMN_DATE_OF_BITRH]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors[PatientTable::COLUMN_DATE_OF_BITRH])) echo "is-invalid" ?>"
                    type="date" name="<?php echo PatientTable::COLUMN_DATE_OF_BITRH ?>" value="<?php echo $patient->getDOB(); ?>" >
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors["password"])) echo "*".$errors["password"]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors["password"])) echo "is-invalid" ?>"
                    placeholder="Password" type="password" name="password" value="" >
              </div>
              <div class="form-group" >
                <p class="text-danger m-0"><?php if(isset($errors["confirmPassword"])) echo "*".$errors["confirmPassword"]; ?></p>
                <input onfocus="this.classList.remove('is-invalid');"
                class="form-control <?php if(isset($errors["confirmPassword"])) echo "is-invalid" ?>"
                    placeholder="Confirm Password" type="password" name="confirmPassword" value="" >
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
