<?php  require_once('../../private/initialize.php');
    // session_start();
    if(isAdminLoggedIn()){
      redirectTo(urlFor('admin/admin_dashboard.php'));
    }

  if(isPostRequest()){
    $admin = new Admin($_POST);
    if($admin->login()){
      // exit("Login successfull");
      // $_SESSION['patient_id'] = exit("patient id: ".$admin->getId());
      $_SESSION[SessionContract::SESSION_ADMIN_ID] = $admin->getId();
      // exit($_SESSION[SessionContract::SESSION_PATIETN_ID]);
      redirectTo(urlFor('admin/admin_dashboard.php'));
    }
    else {
      // login filed.
      print_array($admin->getErrors());
    }

  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
  </head>
  <body>
    <h1>Admin Login</h1>
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <div>
        <label for="">Email: </label>
        <input type="email" name="<?php echo AdminTable::COLUMN_EMAIL ?>" value="" >
      </div>
      <div>
        <label for="">Passwrod: </label>
        <input type="password" name="password">
      </div>
      <input type="submit" name="submit" value="Log in">
    </form>

  </body>
</html>
