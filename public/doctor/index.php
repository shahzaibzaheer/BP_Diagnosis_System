<?php  require_once('../../private/initialize.php');
    require_doctor_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('doctor/header.php'));
?>

  <section class="main_content">
      <h1>Doctor's Dashboard</h1>
      <div class="patient_dashboard">
        <div class="cards col-md-10 col-lg-8 mx-auto row">
             <div href="#" class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/profile.php"); ?>';">
               <i class="card_icon fas fa-user"></i>
               <a href="#">My Profile</a>
             </div>
             <div class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/prescription_requests.php"); ?>';">
               <i class="card_icon fas fa-capsules"></i>
               <a href="#">Prescription Requests</a>
             </div>
             <div  class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/my_appointments.php"); ?>';" >
               <i class="card_icon fas fa-calendar-check" ></i>
               <a href="#">My Appointments</a>
             </div>
             <div class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/doctor_answered_prescriptions.php"); ?>';">
               <i class="card_icon fas fa-comment-medical"></i>
               <a href="#">My Answered Prescriptions</a>
             </div>
             <div class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/report.php"); ?>';">
               <i class="card_icon fas fa-receipt"></i>
               <a href="#">View Report</a>
             </div>
             <div class=" col-11 col-sm-5 col-md-4  mx-auto   card" onclick="location.href='<?php echo urlFor("doctor/doLogout.php"); ?>';">
               <i class="card_icon fas fa-sign-out-alt"></i>
               <a >Logout</a>
             </div>
         </div>
      </div>

      </section>


<?php     require_once(getSharedFilePath('doctor/footer.php')); ?>
