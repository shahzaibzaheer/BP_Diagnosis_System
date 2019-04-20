<?php  require_once('../../private/initialize.php');
    require_admin_login();
    // this page will access only when patient is logged in
    // in header we are getting $admin
    require_once(getSharedFilePath('admin/header.php'));

    if(isPostRequest()){
      // print_array($_POST);
      $admin->setName($_POST[AdminTable::COLUMN_NAME]);
      $admin->setGender($_POST[AdminTable::COLUMN_GENDER]);


      if($admin->save()){
        //login successfull
        redirectTo(urlFor('admin/profile.php'));
      }else {
        // login failed, get errors array
        $errors = $admin->getErrors();
        print_array($errors);
      }
    }


?>

<section class="main_content">
  <h1>My Profile</h1>
  <form class="ask_for_prescription_form" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
    <div class="input-group">
      <input class="input--style-1" type="text" placeholder="Name" name="<?php echo AdminTable::COLUMN_NAME; ?>" value="<?php echo $admin->getName(); ?>">
    </div>

    <select class="input-group form-control" name="<?php echo AdminTable::COLUMN_GENDER; ?>">


      <option value="male" <?php if($admin->getGender() == 'male'){ echo "selected";} ?>>Male</option>
      <option value="female" <?php if($admin->getGender() == 'female'){ echo "selected";} ?>>Female</option>
    </select>


    <div class="input-group">
      <input disabled class=" input--style-1" type="text" placeholder="Email" value="<?php echo $admin->getEmail(); ?>">
    </div>


    <input class="btn btn-primary disable" type="submit" name="submit" value="Update">
  </form>
</section>


<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
