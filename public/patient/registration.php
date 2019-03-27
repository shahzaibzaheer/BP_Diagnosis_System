<?php  require_once('../../private/initialize.php');

    $args = [
      PatientTable::COLUMN_NAME => 'abc',
      PatientTable::COLUMN_USERNAME => 'aadasdfadsfsd',
      PatientTable::COLUMN_EMAIL => 'shahzadaib@gmail.com',
      PatientTable::COLUMN_PHONE => 'a03056302013',
      PatientTable::COLUMN_ADDRESS => 'Lorem Ipsum lorem ipsum, lorem ',
      PatientTable::COLUMN_CITY => 'Wazirabad',
      PatientTable::COLUMN_DATE_OF_BITRH => time(),
      "password" => 'Pakistan143143143',
      "confirmPassword" => 'Pakistan143143143'
    ];

    $patient = new Patient($args);
    // print_r($patient->save());
    if($patient->save()){
      //login successfull
      exit("Registration successfull");
    }else {
      // login failed, get errors array
      $errors = $patient->getErrors();
      print_r($errors);

    }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>

  </body>
</html>
