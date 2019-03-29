<?php  require_once('../../private/initialize.php');

  $doctor = new Doctor([]);// for preventing error , when get request

  if(isDoctorLoggedIn()){
    redirectTo(urlFor('doctor/doctor_dashboard.php'));
  }
  if(isPostRequest()){

      $doctor = new Doctor($_POST);
      // print_array($doctor);
      // exit;
      if($doctor->save()){
        //login successfull
        redirectTo(urlFor('doctor/login.php'));
      }else {
        // login failed, get errors array
        $errors = $doctor->getErrors();
        print_array($errors);
      }
  }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor Registration</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div >
              <label for="">Name: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_NAME ?>" value="<?php echo $doctor->getName(); ?>" >
      </div>
      <div >
              <label for="">Email: </label>
              <input type="email" name="<?php echo DoctorTable::COLUMN_EMAIL ?>" value="<?php echo $doctor->getEmail(); ?>" >
      </div>
      <div >
              <label for="">Username: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_USERNAME ?>" value="<?php echo $doctor->getUserName(); ?>" >
      </div>
      <div >
              <label for="">Phone: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_PHONE ?>" value="<?php echo $doctor->getPhone(); ?>" >
      </div>
      <div >
              <label for="">Clinic Address: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_ADDRESS ?>" value="<?php echo $doctor->getAddress(); ?>" >
      </div>
      <div >
              <label for="">City: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_CITY ?>" value="<?php echo $doctor->getCity(); ?>" >
      </div>
      <div>
        <label for="">Gender: </label>
        <input type="radio" name="<?php echo DoctorTable::COLUMN_GENDER; ?>" value="male" checked> Male
        <input type="radio" name="<?php echo DoctorTable::COLUMN_GENDER; ?>" value="female"> Female
      </div>
      <div class="">
        <label for="">Date of birth: </label>
        <input type="date" name="<?php echo DoctorTable::COLUMN_DATE_OF_BITRH ?>" value="<?php echo $doctor->getDob(); ?>" >
      </div>
      <div >
              <label for="">Specialization: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_SPECIALIZATION ?>" value="<?php echo $doctor->getSpecialization(); ?>" >
      </div>
      <div >
              <label for="">Qualification: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_QUALIFICATION ?>" value="<?php echo $doctor->getQualification(); ?>" >
      </div>
      <div >
              <label for="">About: </label>
              <input type="text" name="<?php echo DoctorTable::COLUMN_ABOUT ?>" value="<?php echo $doctor->getAbout(); ?>" >
      </div>
      <div >
              <label for="">Fees: </label>
              <input type="number" name="<?php echo DoctorTable::COLUMN_FEES ?>" value="<?php echo $doctor->getFees(); ?>" >
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
