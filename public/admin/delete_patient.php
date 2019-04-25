<?php  require_once('../../private/initialize.php');
    require_admin_login();  // this page will access only when admin is logged in

    $patient_id = $_GET["patient_id"] ?? null;
    if($patient_id===null){
      exit("no patient id passed");
    }



    $patient = Patient::find_patient_by_id($patient_id);
    if($patient===false){
      exit("No patient Found");
    }


    if(isPostRequest()){
      $isConfirmed = isset($_POST['confirm']);
      if($isConfirmed){
        // echo "confirm button pressed";
        $success  = $patient->delete();
        if($success){
          setMessage("Patient Successfully Removed");
          redirectTo(urlFor("admin/managePatients.php"));
        }else {
          exit("Error occur while performing deletion");
        }
      }
      else {
        // echo "cancel button pressed";
        redirectTo(urlFor("admin/managePatients.php"));
      }
    }

    // print_array($patients);
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
      <form  class="mt-5 btn-group-lg" action="<?php echo $_SERVER["SCRIPT_NAME"]."?patient_id=".$patient->getId(); ?>" method="post">
        <input type="submit" name="cancel" value="cancel" class="btn btn-light">
        <input type="submit" name="confirm" value="confirm" class="btn btn-danger">

      </form>

    </div>
  </body>
</html>
