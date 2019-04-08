<?php
    require_once('../../private/initialize.php');
    require_admin_login();
    performLogout();
    // redirect here, if you want
    redirectTo(urlFor('index.php'));
?>
