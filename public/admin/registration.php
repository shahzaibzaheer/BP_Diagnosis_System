<?php  require_once('../../private/initialize.php');
if(isAdminLoggedIn()){
  redirectTo(urlFor('admin/admin_dashboard.php'));
}

  $admin = new Admin();  // for preventing error , when get request

  if(isPostRequest()){
    // print_array($_POST);
    $admin = new Admin($_POST);
    if($admin->save()){
      //login successfull
      redirectTo(urlFor('admin/login.php'));
    }else {
      // login failed, get errors array
      $errors = $admin->getErrors();
      print_array($errors);
    }
  }




?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Registration</title>
   </head>
   <body>
     <form class="" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
       <div >
         <label for="">Name: </label>
         <input type="text" name="<?php echo AdminTable::COLUMN_NAME ?>" value="<?php echo $admin->getName(); ?>" >
       </div>
       <div>
         <label for="">Username: </label>
         <input type="text" name="<?php echo AdminTable::COLUMN_USERNAME ?>" value="<?php echo $admin->getUserName(); ?>" >
       </div>
       <div>
         <label for="">Gender: </label>
         <input type="radio" name="<?php echo AdminTable::COLUMN_GENDER; ?>" value="male" checked> Male
         <input type="radio" name="<?php echo AdminTable::COLUMN_GENDER; ?>" value="female"> Female
       </div>
       <div class="">
         <label for="">Email: </label>
         <input type="email" name="<?php echo AdminTable::COLUMN_EMAIL ?>" value="<?php echo $admin->getEmail(); ?>" >
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
