<?php  require_once('../../private/initialize.php');
    require_patient_login();
    // this page will access only when patient is logged in

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

    if(isPostRequest()){
      print_array($_POST);
      exit;
    }

    require_once(getSharedFilePath('patient/header.php'));





?>


    <section class="main_content">
      <h1 class=" "><?php echo $doctor->getName(); ?></h1>
      <div class="d-flex">
        <div class="card">
          <img class="card-img img-fluid" src="../../private/shared/assets/default_img.png" alt="">
          <a class="btn btn-primary mt-2" href="<?php echo urlFor('patient/book_appointment.php')."?doctor_id=".$doctor->getId(); ?>">Book Appointment</a>
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#reviewModal">Give Feedback</button>
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

      <form action="<?php echo $_SERVER['SCRIPT_NAME']."?doctor_id=".$doctor_id; ?>" method="post">

        <div class="rating-container">
          <fieldset class="rate">
            <input id="rate1-star5" type="radio" name="rating" value="5" />
            <label for="rate1-star5" title="Excellent">5</label>

            <input id="rate1-star4" type="radio" name="rating" value="4" checked />
            <label for="rate1-star4" title="Good">4</label>

            <input id="rate1-star3" type="radio" name="rating" value="3" />
            <label for="rate1-star3" title="Satisfactory">3</label>

            <input id="rate1-star2" type="radio" name="rating" value="2" />
            <label for="rate1-star2" title="Bad">2</label>

            <input id="rate1-star1" type="radio" name="rating" value="1" />
            <label for="rate1-star1" title="Very bad">1</label>
          </fieldset>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Subject" name="<?php echo ReviewTable::COLUMN_SUBJECT; ?>" value="">
        </div>
        <div class="form-group">
          <textarea class="form-control" placeholder="Message" name="<?php echo ReviewTable::COLUMN_MESSAGE; ?>"></textarea>
        </div>
        <input class="btn btn-primary col-3 " type="submit" name="submit" value="Post Review">
      </form>





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
                <p>Created On: <?php echo $review->getCreatedOn(); ?></p>
                  <?php echo Review::getRatingStars($review->getRating()); ?>
                <p> <b><?php echo $review->getSubject(); ?></b> </p>
                <p> <?php echo $review->getMessage(); ?></p>
              </div>

            <?php endforeach; ?>

        </div>
      </section>
    </section>



<?php     require_once(getSharedFilePath('patient/footer.php')); ?>
