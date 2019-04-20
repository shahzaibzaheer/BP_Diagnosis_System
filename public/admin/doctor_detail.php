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
        foreach ($reviewsAssoc as $reviewAssoc) {
          $reviews[] = new Review($reviewAssoc);
        }
        if(empty($reviews)){
          $reviews = false;
        }

        // $patientReview = Review::find_review_by_patient_id($patient_id);
        // print_array($patientReview);exit;

  require_once(getSharedFilePath('admin/header.php'));


?>


    <section class="main_content">
      <h1 class=" "><?php echo $doctor->getName(); ?></h1>
      <div class="d-flex">
        <div class="card">
          <img class="card-img img-fluid" src="https://placehold.it/400x400" alt="">
          <a class="btn btn-primary mt-2" href="<?php echo urlFor('admin/delete_doctor.php')."?doctor_id=".$doctor->getId(); ?>">Delete Doctor</a>
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
        <div class="row d-flex  justify-content-around">
          <div class="average-rating-container card col-4">
            <h4>Average Rating</h4>
            <h2><?php echo Review::get_average_doctor_rating($doctor->getId()); ?> <span>/ 5 </span></h2>
            <?php echo Review::getRatingStars((int) Review::get_average_doctor_rating($doctor->getId())); ?>
          </div>
        </div>
        <div>


            <!-- Output all the reviews-->
            <?php foreach ($reviews as $review): ?>
              <div class="single-review" style="border: 1px solid #000">

                <h4><?php echo $review->getPatient()->getName(); ?></h4>
                <!-- <a href="<?php echo urlFor('admin/delete_patient.php')."?patient_id=".$review->getPatient()->getId(); ?>">Remove Patient</a> -->
                <p>Created On: <?php echo $review->getCreatedOn(); ?></p>
                  <?php echo Review::getRatingStars($review->getRating()); ?>
                <p> <b><?php echo $review->getSubject(); ?></b> </p>
                <p> <?php echo $review->getMessage(); ?></p>
              </div>

            <?php endforeach; ?>

        </div>
      </section>
    </section>



<?php   require_once(getSharedFilePath('patient/footer.php')); ?>
