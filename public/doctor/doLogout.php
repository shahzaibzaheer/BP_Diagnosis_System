<?php
    require_once('../../private/initialize.php');
    require_doctor_login();
    performLogout();
    // redirect here, if you want
    redirectTo(urlFor('index.php'));
?>
