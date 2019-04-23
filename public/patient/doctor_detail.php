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

        $patientReview = Review::find_review_by_patient_id($patient_id);
        // print_array($patientReview);exit;

    if(isPostRequest()){

            if(!$patientReview){
              $patientReview = new Review($_POST);
              $patientReview->setPatientId($patient_id);
              $patientReview->setDoctorId($doctor_id);

            }
            else {
              // $rating = $_POST[]
              $patientReview->setRating($_POST[ReviewTable::COLUMN_RATING] ?? '');
              $patientReview->setSubject($_POST[ReviewTable::COLUMN_SUBJECT] ?? '');
              $patientReview->setMessage($_POST[ReviewTable::COLUMN_MESSAGE] ?? '');

            // print_array($_POST);
            // exit;
          }
          if($patientReview->save()){
            //login successfull
            redirectTo(urlFor('patient/doctor_detail.php?doctor_id='.$doctor_id));
          }else {
            // login failed, get errors array
            $errors = $patientReview->getErrors();
            print_array($errors);
          }
  }

    require_once(getSharedFilePath('patient/header.php'));





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
          <a class="btn btn-primary mt-4" href="<?php echo urlFor('patient/book_appointment.php')."?doctor_id=".$doctor->getId(); ?>">Book Appointment</a>
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#feedbackModal"><?php  echo ($patientReview === false) ?  "Give Review" :  "Update Review"; ?></button>
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
        </div>










    </section>


    <!-- Modal HTML -->
    <form action="<?php echo $_SERVER['SCRIPT_NAME']."?doctor_id=".$doctor_id; ?>" method="post">
        <div id="feedbackModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <!-- <h4 class="modal-title">Confirmation</h4> -->
                    </div>
                    <div class="modal-body">



                        <?php
                            if(!$patientReview){
                              echo Review::getRatingStarsForForm();
                            }else {
                              echo Review::getRatingStarsForForm($patientReview->getRating());
                            }
                        ?>

                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" name="<?php echo ReviewTable::COLUMN_SUBJECT; ?>"
                            value="<?php if($patientReview){ echo $patientReview->getSubject(); } ?>">
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" placeholder="Message" name="<?php echo ReviewTable::COLUMN_MESSAGE; ?>"><?php if($patientReview){ echo $patientReview->getMessage(); } ?></textarea>
                          </div>
                          <div class="modal-footer">
                              <input class="btn btn-primary " type="submit" name="submit" value="<?php  echo ($patientReview === false) ?  "Give Review" :  "Update Review"; ?>">
                          </div>


                    </div>
                    <!-- <div class="modal-footer"> -->
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <!-- <button type="button" name="submit" class="btn btn-primary" data-dismiss="modal"></button> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
      </form>




  </div>
  <footer class="footer-distributed">
    <div class="row col-lg-9 mx-auto footer-content">
      <div class="col-11 col-md-5  mx-auto mb-5 footer-left">
        <div>
          <i class="fa fa-map-marker-alt"></i>
          <p>21 Revolution Street Paris,</br> France</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+1 555 123456</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:support@company.com">support@company.com</a></p>
        </div>

      </div>

      <div class="col-11 col-md-5  mx-auto mb-5 footer-right">
        <p class="footer-company-about">
          <span>About the company</span>
          Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
        </p>
      </div>
      <div class="copyright col-11 col-sm-8 col-md-6 mx-auto text-center">
        <p>&copy; Copyright <?php echo date('Y'); ?>, All Rights Reserved </p>
      </div>
    </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo getScriptPath('main_script.js'); ?>"></script>
</body>
</html>


    <!-- <?php   require_once(getSharedFilePath('patient/footer.php')); ?> -->
