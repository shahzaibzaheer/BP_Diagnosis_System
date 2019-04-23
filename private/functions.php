<?php
session_start();

/*** authorization related
*****************************/
function require_patient_login(){
  if(!isset($_SESSION[SessionContract::SESSION_PATIENT_ID])){
      // redirect patient for login
      redirectTo(urlFor('patient/login.php'));
  }
}

function setMessage($message){
  $_SESSION['message'] = $message;
}

function output_message_if_any(){
  if(isset($_SESSION['message'])){
    $message = " <div class='alert alert-success alert-dismissible fade show mt-5 col-8 mx-auto' role='alert'>";
    $message .= " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $message .= $_SESSION['message'] ."</div>";
    unset($_SESSION['message']);
    echo $message;
  }
}


function require_doctor_login(){
  if(!isset($_SESSION[SessionContract::SESSION_DOCTOR_ID])){
      // redirect patient for login
      redirectTo(urlFor('doctor/login.php'));
  }
}
function require_admin_login(){
  if(!isset($_SESSION[SessionContract::SESSION_ADMIN_ID])){
      // redirect patient for login
      redirectTo(urlFor('admin/login.php'));
  }
}
function loggedInPatientId(){
  return $_SESSION[SessionContract::SESSION_PATIENT_ID];
}
function loggedInDoctorId(){
  return $_SESSION[SessionContract::SESSION_DOCTOR_ID];
}
function loggedInAdminId(){
  return $_SESSION[SessionContract::SESSION_ADMIN_ID];
}


function isPatientLoggedIn(){
  return isset($_SESSION[SessionContract::SESSION_PATIENT_ID]);
}
function isDoctorLoggedIn(){
  return isset($_SESSION[SessionContract::SESSION_DOCTOR_ID]);
}

function isAdminLoggedIn(){
  return isset($_SESSION[SessionContract::SESSION_ADMIN_ID]);
}

function performLogout(){
  if(isset($_SESSION[SessionContract::SESSION_PATIENT_ID])){
    unset($_SESSION[SessionContract::SESSION_PATIENT_ID]);
  }elseif(isset($_SESSION[SessionContract::SESSION_DOCTOR_ID])){
    unset($_SESSION[SessionContract::SESSION_DOCTOR_ID]);
  }elseif(isset($_SESSION[SessionContract::SESSION_ADMIN_ID])){
    unset($_SESSION[SessionContract::SESSION_ADMIN_ID]);
  }
  else{
    exit("Some error happen while performing logout");
  }
}








// function isUserLoggedIn(){
//   session_start();
//   return isset($_SESSION[SessionContract::PATIETN_ID]) ||
//          isset($_SESSION[SessionContract::DOCTOR_ID]) ||
//          isset($_SESSION[SessionContract::ADMIN_ID]) ;
// }


/**********//////////













  function print_array($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    // exit;
  }

  function urlFor($script_path) {
      // add the leading '/' if not present
      if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
      }
      return WWW_ROOT . $script_path;
  }
  function getStylePath($stylesheet_name) {
      // add the leading '/' if not present
      if($stylesheet_name[0] != '/') {
        $stylesheet_name = "/" . $stylesheet_name;
      }
      return STYLES_PATH . $stylesheet_name;
  }
  function getScriptPath($script_name) {
      // add the leading '/' if not present
      if($script_name[0] != '/') {
        $script_name = "/" . $script_name;
      }
      return SCRIPTS_PATH . $script_name;
  }
  function getSharedFilePath($file_name) {
      // add the leading '/' if not present
      if($file_name[0] != '/') {
        $file_name = "/" . $file_name;
      }
      return SHARED_PATH . $file_name;
  }
  function getAssetsPath($file_name) {
      // add the leading '/' if not present
      if($file_name[0] != '/') {
        $file_name = "/" . $file_name;
      }
      return ASSETS_PATH . $file_name;
  }

  function redirectTo($url)  {
    header("Location: ".$url);
    exit();
  }

  function isPostRequest(){
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }


/*** Validation Functions
******************************/

   function isValidEmailFormat($email) {
     $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
     return preg_match($email_regex, $email) === 1;
   }


   // isBlank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function isBlank($value) {
    return !isset($value) || trim($value) === '';
  }
  // hasPresence('abcd')
  // * validate data presence
  // * reverse of isBlank()
  // * more developer friendly name
  function hasPresence($value) {
    return !isBlank($value);
  }

  function isContainErrors($errorsArray)
  {
    return !empty($errorsArray);
  }




  // has_length_greater_than('abcd', 3)
    // * validate string length
    // * spaces count towards length
    // * use trim() if spaces should not count
    function has_length_greater_than($value, $min) {
      $length = strlen($value);
      return $length > $min;
    }

    // has_length_less_than('abcd', 5)
    // * validate string length
    // * spaces count towards length
    // * use trim() if spaces should not count
    function has_length_less_than($value, $max) {
      $length = strlen($value);
      return $length < $max;
    }

    // has_length_exactly('abcd', 4)
    // * validate string length
    // * spaces count towards length
    // * use trim() if spaces should not count
    function has_length_exactly($value, $exact) {
      $length = strlen($value);
      return $length == $exact;
    }

    // has_length('abcd', ['min' => 3, 'max' => 5])
    // * validate string length
    // * combines functions_greater_than, _less_than, _exactly
    // * spaces count towards length
    // * use trim() if spaces should not count
    function has_length($value, $options) {
      if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
      } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
      } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
      } else {
        return true;
      }
    }







?>
