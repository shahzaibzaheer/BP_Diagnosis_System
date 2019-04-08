<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
  </head>
  <body>
    <h1>Admin Dashboard</h1>
    <a href="<?php echo urlFor("admin/doLogout.php"); ?>">Logout</a> <br>

  </body>
</html>
