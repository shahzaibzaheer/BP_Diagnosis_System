<?php  require_once('../../private/initialize.php');
    // session_start();
    if(isPatientLoggedIn()){
      redirectTo(urlFor('patient/patient_dashboard.php'));
    }

  if(isPostRequest()){
    $patient = new Patient($_POST);
    if($patient->login()){
      // exit("Login successfull");
      // $_SESSION['patient_id'] = exit("patient id: ".$patient->getId());
      $_SESSION[SessionContract::SESSION_PATIENT_ID] = $patient->getId();
      // exit($_SESSION[SessionContract::SESSION_PATIETN_ID]);
      redirectTo(urlFor('patient/patient_dashboard.php'));
    }
    else {
      // login filed.
      print_array($patient->getErrors());
    }

  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient Login</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div>
        <label for="">Email: </label>
        <input type="email" name="<?php echo PatientTable::COLUMN_EMAIL ?>" value="" >
      </div>
      <div>
        <label for="">Passwrod: </label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Log in">
    </form>

  </body>
</html>
