<?php  require_once('../private/initialize.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <style media="screen">
      *{
        font-family: sans-serif;
      }
      a{
        text-decoration: none;
        color: #fff;
        background: #333;
        padding: 8px;
        border-radius: 5px;
      }
    </style>
  </head>
  <body>
    <h1>Home</h1>
        <a href="<?php echo urlFor('patient/login.php') ?>">Patient Login</a>
        <a href="<?php echo urlFor('patient/registration.php') ?>">Patient Registration</a>
  </body>
</html>
