<?php
    require_once('../../private/initialize.php');
    require_patient_login();
    performLogout();
    // redirect here, if you want
    redirectTo(urlFor('index.php'));
?>
