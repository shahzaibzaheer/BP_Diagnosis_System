<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
?>

  <section class="main_content">
      <h1>Patient Dashboard</h1>
      <div class="patient_dashboard">
       <div class="cards">
             <div href="#" class="card">
               <i class="card_icon fas fa-user"></i>
               <a href="#">My Profile</a>
             </div>
             <div class="card" onclick="location.href='<?php echo urlFor("patient/my_prescriptions.php"); ?>';">
               <i class="card_icon fas fa-capsules"></i>
               <a href="#">My Prescriptions</a>
             </div>
             <div  class="card" onclick="location.href='<?php echo urlFor("patient/ask_for_prescription.php"); ?>';" >
               <i class="card_icon fas fa-comment-medical" ></i>
               <a href="#">Ask For Prescription</a>
             </div>
             <div class="card" onclick="location.href='<?php echo urlFor("patient/book_appointment.php"); ?>';">
               <i class="card_icon fas fa-calendar-check"></i>
               <a href="#">Book Appointment</a>
             </div>
             <div class="card" onclick="location.href='<?php echo urlFor("patient/my_appointments.php"); ?>';">
               <i class="card_icon fas fa-history"></i>
               <a href="#">Appointment History</a>
             </div>
             <div class="card">
               <i class="card_icon fas fa-user-md"></i>
               <a href="#" class="">Doctors</a>
             </div>
         </div>
      </div>

      </section>


<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
