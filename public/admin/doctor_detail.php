<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in
    $patient_id = loggedInPatientId();
    $doctor_id =  $_GET['doctor_id'] ?? '';
    $doctor = Doctor::find_doctor_by_id($doctor_id);
    if(!$doctor){
      exit("Error while fecthing doctor");
    }


    // fetch all the reviews
        $reviews = [];
        $reviewsAssoc = Review::find_reviews_by_doctor_id($doctor_id);
        if($reviewsAssoc){
          foreach ($reviewsAssoc as $reviewAssoc) {
            $reviews[] = new Review($reviewAssoc);
          }
        }
        if(empty($reviews)){
          $reviews = false;
        }

        // $patientReview = Review::find_review_by_patient_id($patient_id);
        // print_array($patientReview);exit;

  require_once(getSharedFilePath('admin/header.php'));


?>


<section class="main_content mt-5">
  <h1 class=" mb-5"><?php echo $doctor->getName(); ?></h1>
  <div class="row doctor_detail_container">
    <div class="card col-10  col-sm-4 text-center">
      <h5 class="card-title text-capitalize mt-5"><?php echo $doctor->getName(); ?></h5>
      <div class="card-subtitle mt-2"><?php echo $doctor->getQualification(); ?></div>
      <div class="card-subtitle "><?php echo $doctor->getSpecialization(); ?></div>
      <div class="card-subtitle ">Fees: Rs <?php echo $doctor->getFees(); ?>/-</div>
      <?php echo Review::getRatingStars((int) Review::get_average_doctor_rating($doctor->getId())); ?>
      <a class="btn btn-primary mt-4" href="<?php echo urlFor('admin/delete_doctor.php')."?doctor_id=".$doctor->getId(); ?>">Delete Doctor</a>
    </div>
    <div class="doctor_detail col-10 col-sm-6 ml-4 mt-5">
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

    <section class="col-12  h-25 doctor-rating-holder  mt-5 mb-0">
      <div class="row">
        <div class="average-rating-container card  col-10 col-sm-6  col-md-4 mx-auto">
          <h4>Average Rating</h4>
          <h2><?php echo Review::get_average_doctor_rating($doctor->getId()); ?> <span>/ 5 </span></h2>
          <?php echo Review::getRatingStars((int) Review::get_average_doctor_rating($doctor->getId())); ?>
        </div>
      </div>
    </section>
    <?php if($reviews != false){ ?>

      <div class="col-12  ">
          <!-- Output all the reviews-->
          <?php foreach ($reviews as $review): ?>
            <div class="card review_container p-4">
              <div class=" col-12  col-sm-9  col-md-6  d-block text-center d-sm-flex ">
                <h2 class="mt-2 mr-4">4.3</h2>
                <div >
                  <?php echo Review::getRatingStars($review->getRating()); ?>
                </div>
              </div>

              <h4 class="reviewer-name"> <?php echo $review->getPatient()->getName(); ?></h4>
              <p class="card-subtitle">Created On: <?php echo $review->getCreatedOn(); ?></p>
              <p class="card-subtitle mt-4"> <b>Subject : </b> <?php echo $review->getSubject(); ?> </p>
              <p class="card-subtitle mt-2"><b>Message : </b>  <?php echo $review->getMessage(); ?></p>
            </div>

          <?php endforeach; ?>
      </div>
    <?php } ?>
    </div>

</section>



<?php   require_once(getSharedFilePath('patient/footer.php')); ?>
