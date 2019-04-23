<?php


  // ini_set('display_errors', 'On');
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PROJECT_PATH . '/private/shared');


    // $_SERVER['SCRIPT_NAME'] will return, /seoExchange/public/index.php , hum public k bad /index.php ko cut off kr rahy hain
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root); // WWW_ROOT is public directory

    $project_end = strpos($_SERVER['SCRIPT_NAME'], '/BP_Diagnosis_System') + 20;
    $project_root = substr($_SERVER['SCRIPT_NAME'], 0, $project_end);
    define("STYLES_PATH", $project_root."/private/styles/css");
    define("SCRIPTS_PATH", $project_root."/private/scripts");
    define("ASSETS_PATH", $project_root."/private/shared/assets");




    require_once('Database/DB_Credentials.php');
    require_once('SESSION_CONTRACT.php');
    require_once('functions.php');
    require_once('UploadFile.php');
    require_once('model/patient.class.php');
    require_once('model/doctor.class.php');
    require_once('model/admin.class.php');
    require_once('model/prescription.class.php');
    require_once('model/replay.class.php');
    require_once('model/appointment.class.php');
    require_once('model/review.class.php');

    $db = dbConnect();
    Patient::setDatabase($db);
    Prescription::setDatabase($db);
    Doctor::setDatabase($db);
    Replay::setDatabase($db);
    Appointment::setDatabase($db);
    Admin::setDatabase($db);
    Review::setDatabase($db);



 ?>
