<?php require_once('../../private/initialize.php');
    // $doctor = Doctor::find_doctor_by_email("shahzaib@gmail.com");
    // $result = password_verify('Shahzaib12345', $doctor->getHashedPassword());
    // var_dump($result);
    // print_array($doctor);
    // exit;
    // session_start();
    if(isDoctorLoggedIn()){
      redirectTo(urlFor('doctor/doctor_dashboard.php'));
    }

    if(isPostRequest()){
    $doctor = new Doctor($_POST);
    if($doctor->login()){
      // print_array($doctor);
      // exit;
      $_SESSION[SessionContract::SESSION_DOCTOR_ID] = $doctor->getId();
      redirectTo(urlFor('doctor/doctor_dashboard.php'));
    }
    else {
      // login filed.
      exit("Login failed");
      print_array($doctor->getErrors());
    }

   }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor Login</title>
  </head>
  <body>
    <h1>Doctor Login</h1>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div>
        <label for="">Email: </label>
        <input type="email" name="<?php echo DoctorTable::COLUMN_EMAIL ?>" value="" >
      </div>
      <div>
        <label for="">Passwrod: </label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Log in">
    </form>

  </body>
</html>
