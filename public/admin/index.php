<?php  require_once('../../private/initialize.php');
    require_admin_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('admin/header.php'));
?>

<section class="main_content">
    <h1>Admin's Dashboard</h1>
    <div class="patient_dashboard">
     <div class="cards">
           <div href="#" class="card" onclick="location.href='<?php echo urlFor("admin/profile.php"); ?>';">
             <i class="card_icon fas fa-user"></i>
             <a >My Profile</a>
           </div>
           <div href="#" class="card" onclick="location.href='<?php echo urlFor("admin/managePatients.php"); ?>';">
             <i class="card_icon  fas fa-user-injured"></i>
             <a >Manage Patients</a>
           </div>
           <div href="#" class="card" onclick="location.href='<?php echo urlFor("admin/manageDoctors.php"); ?>';">
             <i class="card_icon  fas fa-user-md"></i>
             <a >Manage Doctors</a>
           </div>
           <div href="#" class="card" onclick="location.href='<?php echo urlFor("admin/appointmentHistory.php"); ?>';">
             <i class="card_icon  fas fa-calendar-check"></i>
             <a >View Appointments</a>
           </div>
           <div href="#" class="card" onclick="location.href='<?php echo urlFor(""); ?>';">
             <i class="card_icon  fas fa-star-half-alt"></i>
             <a >User's Feedback</a>
           </div>
           <div class="card" onclick="location.href='<?php echo urlFor("doctor/doLogout.php"); ?>';">
             <i class="card_icon fas fa-sign-out-alt"></i>
             <a >Logout</a>
           </div>
       </div>
    </div>

    </section>



<?php     require_once(getSharedFilePath('admin/footer.php')); ?>
