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




?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>
    <form class="" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div >
        <label for="">Name: </label>
        <input type="text" name="<?php echo PatientTable::COLUMN_NAME ?>" value="<?php echo $patient->getName(); ?>" >
      </div>
      <div>
        <label for="">Username: </label>
        <input type="text" name="<?php echo PatientTable::COLUMN_USERNAME ?>" value="<?php echo $patient->getUserName(); ?>" >
      </div>
      <div class="">
        <label for="">Email: </label>
        <input type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>" value="<?php echo $patient->getEmail(); ?>" >
      </div>
      <div>
        <label for="">Phone: </label>
        <input type="text" name="<?php echo PatientTable::COLUMN_PHONE ?>" value="<?php echo $patient->getPhoneNumber(); ?>" >
      </div>
      <div class="">
        <label for="">City: </label>
        <input type="text" name="<?php echo PatientTable::COLUMN_CITY ?>" value="<?php echo $patient->getCity(); ?>" >
      </div>
      <div class="">
        <label for="">Address: </label>
        <input type="text" name="<?php echo PatientTable::COLUMN_ADDRESS ?>" value="<?php echo $patient->getAddress(); ?>" >
      </div>
      <div class="">
        <label for="">Date of birth: </label>
        <input type="date" name="<?php echo PatientTable::COLUMN_DATE_OF_BITRH ?>" value="<?php echo $patient->getDOB(); ?>" >
      </div>
      <div class="">
        <label for="">Password: </label>
        <input type="password" name="password" value="" >
      </div>
      <div class="">
        <label for="">Confirm Password: </label>
        <input type="password" name="confirmPassword" value="" >
      </div>
      <input type="submit" name="submit" value="Register">

    </form>

  </body>
</html>
