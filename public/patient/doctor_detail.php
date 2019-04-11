<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in

    $doctor_id =  $_GET['doctor_id'] ?? '';
    $doctor = Doctor::find_doctor_by_id($doctor_id);
    if(!$doctor){
      exit("Error while fecthing doctor");
    }

    require_once(getSharedFilePath('patient/header.php'));

?>

    <section class="main_content">
      <h1 class=" "><?php echo $doctor->getName(); ?></h1>
      <div class="d-flex">
        <div class="card">
          <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
          <a class="btn btn-primary mt-2" href="<?php echo urlFor('patient/book_appointment.php')."?doctor_id=".$doctor->getId(); ?>">Book Appointment</a>
        </div>
        <div class="">
          <div class="">
            <h6>About Doctor:</h6>
            <p><?php echo $doctor->getAbout(); ?></p>
          </div>
          <div class="">
            <h6>Email:</h6>
            <p><?php echo $doctor->getEmail(); ?></p>
          </div>
          <div class="">
            <h6>Contact:</h6>
            <p><?php echo $doctor->getPhone(); ?></p>
          </div>
          <div class="">
            <h6>Speciality:</h6>
            <p><?php echo $doctor->getSpecialization(); ?></p>
          </div>
          <div class="">
            <h6>Qualification:</h6>
            <p><?php echo $doctor->getQualification(); ?></p>
          </div>
          <div class="">
            <h6>Fees:</h6>
            <p><?php echo "Rs.".$doctor->getFees()."-/"; ?></p>
          </div>
          <div class="">
            <h6>Clinic Address:</h6>
            <p><?php echo $doctor->getAddress(); ?></p>
          </div>
        </div>
      </div>
      <section class="doctor-rating-holder">
        <div class="average-rating-container card col-4">
          <h4>Average Rating</h4>
          <h2><?php echo Review::get_average_doctor_rating($doctor->getId()); ?> <span>/ 5 </span></h2>
          <?php echo Review::getRatingStars((int) Review::get_average_doctor_rating($doctor->getId())); ?>

        </div>
      </section>
    </section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
