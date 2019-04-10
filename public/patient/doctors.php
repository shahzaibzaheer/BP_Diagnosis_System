<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
    $doctors = Doctor::find_all_doctors();
    if(!$doctors){ exit("There is no doctor availabel");}
?>

  <section class="main_content">
    <h1>Doctors</h1>

      <div class="doctors-container">
        <div class="row d-flex justify-content-around  gutter grid-column-gap-1 col-md-12 mx-auto">
          <?php foreach ($doctors as $doctor): ?>
            <div  class="card col-8 col-sm-5 col-md-3 text-center mt-4 ml-1 mr-1 " style="padding:0;"  onclick="location.href='<?php echo urlFor('patient/doctor_detail.php')."?doctor_id=".$doctor->getId(); ?>';">
              <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
              <h5 class="card-title text-uppercase"><?php echo $doctor->getName(); ?></h5>
              <div class="card-subtitle"><?php echo $doctor->getQualification(); ?></div>
              <div class="card-subtitle"><?php echo $doctor->getSpecialization(); ?></div>
              <div class="card-subtitle">Fees: Rs <?php echo $doctor->getFees(); ?>/-</div>
              <a class="btn btn-primary mt-2" href="<?php echo urlFor('patient/book_appointment.php')."?doctor_id=".$doctor->getId(); ?>">Book Appointment</a>
            </div>
          <?php endforeach; ?>


        </div>

      </div>

  </section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
