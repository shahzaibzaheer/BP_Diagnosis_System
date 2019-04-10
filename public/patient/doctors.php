<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    require_once(getSharedFilePath('patient/header.php'));
?>

  <section class="main_content">
    <h1>Doctors</h1>

      <div class="doctors-container">
        <div class="row d-flex justify-content-around  gutter grid-column-gap-1">
            <div  class="card col-8 col-sm-5 col-md-4 text-center  " style="padding:0;">
              <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
              <h5 class="card-title ">Salman Asghar</h5>
              <div class="card-subtitle">MBBS, MS</div>
              <div class="card-subtitle">Heart Surgon</div>
              <div class="card-subtitle">Fees: Rs 2000/-</div>
              <a class="btn btn-primary mt-2" href="#">Book Appointment</a>
            </div>
            <div  class="card col-8 col-sm-5 col-md-4 text-center " style="padding:0;">
              <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
              <h5 class="card-title ">Salman Asghar</h5>
              <div class="card-subtitle">MBBS, MS</div>
              <div class="card-subtitle">Heart Surgon</div>
              <div class="card-subtitle">Fees: Rs 2000/-</div>
              <a class="btn btn-primary mt-2" href="#">Book Appointment</a>
            </div>
            <div  class="card col-8 col-sm-5 col-md-4 text-center " style="padding:0;">
              <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
              <h5 class="card-title ">Salman Asghar</h5>
              <div class="card-subtitle">MBBS, MS</div>
              <div class="card-subtitle">Heart Surgon</div>
              <div class="card-subtitle">Fees: Rs 2000/-</div>
              <a class="btn btn-primary mt-2" href="#">Book Appointment</a>
            </div>
        </div>

      </div>

  </section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
