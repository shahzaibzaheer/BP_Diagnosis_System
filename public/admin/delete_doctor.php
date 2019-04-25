<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in

    $doctor_id = $_GET["doctor_id"] ?? null;
    if($doctor_id===null){
      exit("no doctor id passed");
    }



    $doctor = Doctor::find_doctor_by_id($doctor_id);
    if($doctor===false){
      exit("No doctor Found");
    }


    if(isPostRequest()){
      $isConfirmed = isset($_POST['confirm']);
      if($isConfirmed){
        // echo "confirm button pressed";
        $success  = $doctor->delete();
        if($success){
          setMessage("Doctor Successfully Removed");
          redirectTo(urlFor("admin/manageDoctors.php"));
        }else {
          exit("Error occur while performing deletion");
        }
      }
      else {
        // echo "cancel button pressed";
        redirectTo(urlFor("admin/manageDoctors.php"));
      }
    }

    // print_array($doctors);
    // exit;
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Delete Patient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
    <div class="container text-center mt-5">

      <h1>Are You Sure?</h1>
      <form class="mt-5 btn-group-lg" action="<?php echo $_SERVER["SCRIPT_NAME"]."?doctor_id=".$doctor->getId(); ?>" method="post">
        <input type="submit" name="cancel" value="cancel" class="btn btn-light">
          <input type="submit" name="confirm" value="confirm" class="btn btn-danger">

      </form>
    </div>
  </body>
</html>
