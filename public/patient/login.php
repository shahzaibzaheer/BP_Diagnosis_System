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

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>
  <body>
    <div class="login_registration_container mt-5">
      <div class="login-form col-3 mx-auto">
          <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
              <h2 class="text-center">Patient Login</h2>
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
