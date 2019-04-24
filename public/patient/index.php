<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    $page_title = "Dashboard";
    require_once(getSharedFilePath('patient/header.php'));
?>

  <section class="main_content mt-4">
      <h1 >Patient Dashboard</h1>
      <div class="patient_dashboard">
       <div class="cards col-md-10 col-lg-8 mx-auto row">
             <div href="#" class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/profile.php"); ?>';">
               <i class="card_icon fas fa-user"></i>
               <a href="#">My Profile</a>
             </div>
             <div class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/my_prescriptions.php"); ?>';">
               <i class="card_icon fas fa-capsules"></i>
               <a href="#">My Prescriptions</a>
             </div>
             <div  class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/ask_for_prescription.php"); ?>';" >
               <i class="card_icon fas fa-comment-medical" ></i>
               <a href="#">Ask For Prescription</a>
             </div>
             <div class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/book_appointment.php"); ?>';">
               <i class="card_icon fas fa-calendar-check"></i>
               <a href="#">Book Appointment</a>
             </div>
             <div class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/my_appointments.php"); ?>';">
               <i class="card_icon fas fa-history"></i>
               <a href="#">Appointment History</a>
             </div>
             <div class="col-11 col-sm-5 col-md-4  mx-auto  card" onclick="location.href='<?php echo urlFor("patient/doctors.php"); ?>';">
               <i class="card_icon fas fa-user-md"></i>
               <a >Doctors</a>
             </div>
         </div>
      </div>

      </section>


<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
