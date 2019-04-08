<?php  require_once('../../private/initialize.php');

    $args = [
    AdminTable::COLUMN_USERNAME => "doctorsalman123456",
    AdminTable::COLUMN_NAME => "salman",
    AdminTable::COLUMN_EMAIL => "salmanDoctor@gmail.com",
    AdminTable::COLUMN_GENDER => "1",
    "password" => "Pakistan143143",
    "confirmPassword" => "Pakistan143143"
  ];

  $admin = new Admin($args);
  if($admin->save()){
      exit("admin registration succesful");
  }else {
    $errors = $admin->getErrors();
    print_array($errors);
  }


 ?>
