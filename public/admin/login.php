<?php  require_once('../../private/initialize.php');
    // session_start();
    $errors = [];

    if(isAdminLoggedIn()){
      redirectTo(urlFor('admin/index.php'));
    }

  if(isPostRequest()){
    $admin = new Admin($_POST);
    if($admin->login()){
      // exit("Login successfull");
      // $_SESSION['patient_id'] = exit("patient id: ".$admin->getId());
      $_SESSION[SessionContract::SESSION_ADMIN_ID] = $admin->getId();
      // exit($_SESSION[SessionContract::SESSION_PATIETN_ID]);
      redirectTo(urlFor('admin/index.php'));
    }
    else {
      // login filed.
      $errors = $admin->getErrors();
      // print_array($admin->getErrors());
    }

  }
  $page_title = "Admin Login";
  require_once(getSharedFilePath('main/login_registration_header.php'));


?>

<div class="login_registration_container mt-5">
  <?php echo output_message_if_any(); ?>

  <div class="login-form col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto">
      <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
      <h2 class="text-center mb-4">Admin Login</h2>
      <div class="form-group">
        <p class="text-danger"><?php if(isset($errors['invalidCredantials'])) echo "*".$errors['invalidCredantials']; ?></p>
          <input type="email" name="<?php echo AdminTable::COLUMN_EMAIL ?>"
          class="form-control <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
          placeholder="Email" required="required"
          onfocus="this.classList.remove('is-invalid');">
      </div>
      <div class="form-group">
          <input type="password" name="password"
          class="form-control <?php if(isset($errors['invalidCredantials'])) echo "is-invalid" ?>"
           placeholder="Password" required="required"
           onfocus="this.classList.remove('is-invalid');">
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </div>
      <div class="clearfix">
          <a href="#" class=" pull-right">Forgot Password?</a>
      </div>
    </form>
    <!-- <p class="text-center"><a href="<?php echo urlFor('admin/registration.php'); ?>">Create an Account</a></p> -->
    </div>
  </div>
</body>
</html>
