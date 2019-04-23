<?php  require_once('../../private/initialize.php');


    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
    $doctors = Doctor::find_all_doctors();
    if(!$doctors){ exit("There is no doctor availabel");}
?>

  <section class="main_content mt-5">
    <h1 class="mb-4">Doctors</h1>
      <div class="doctors-container">
        <div class="row col-lg-10 mx-auto">
          <?php foreach ($doctors as $doctor): ?>
            <div  class="card text-center col-10  col-md-5 mx-auto"
                style="padding:0;"  onclick="location.href='<?php echo urlFor('patient/doctor_detail.php')."?doctor_id=".$doctor->getId(); ?>';">
              <!-- <img class="card-img img-fluid" src="https://placehold.it/400x400" alt=""> -->
              <h5 class="card-title text-capitalize mt-5"><?php echo $doctor->getName(); ?></h5>
              <div class="card-subtitle mt-2"><?php echo $doctor->getQualification(); ?></div>
              <div class="card-subtitle "><?php echo $doctor->getSpecialization(); ?></div>
              <div class="card-subtitle ">Fees: Rs <?php echo $doctor->getFees(); ?>/-</div>
              <?php echo Review::getRatingStars((int) Review::get_average_doctor_rating($doctor->getId())); ?>
              <a class="btn btn-primary " href="<?php echo urlFor('patient/book_appointment.php')."?doctor_id=".$doctor->getId(); ?>">Book Appointment</a>
            </div>
          <?php endforeach; ?>


        </div>

      </div>

  </section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
