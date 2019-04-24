<?php

class Review
{
    private $id;
    private $rating;
    private $patient_id;
    private $doctor_id;
    private $subject;
    private $message;
    private $created_on;
    private $patient; // initialize, when patient id collected
    private $doctor; // initialize, when doctor id collected

    static private $db;
    private $errors;

    private static $ratingId = 0;

    function __construct($args = []){
          $this->setId($args[ReviewTable::COLUMN_ID] ?? '');
          $this->setRating($args[ReviewTable::COLUMN_RATING] ?? '');
          $this->setPatientId($args[ReviewTable::COLUMN_PATIENT_ID] ?? '');
          $this->setDoctorId($args[ReviewTable::COLUMN_DOCTOR_ID] ?? '');
          $this->setSubject($args[ReviewTable::COLUMN_SUBJECT] ?? '');
          $this->setMessage($args[ReviewTable::COLUMN_MESSAGE] ?? '');
          $this->setCreatedOn($args[ReviewTable::COLUMN_CREATED_ON] ?? '');

        }




    /*** Database Related
    *************************************/
    static public function setDatabase($pdo){
      if($pdo){
        Review::$db = $pdo;
      }
      else{
        throw new \Exception("Please pass valid database in Review1 ");
      }
    }

    public function save(){
        if(!hasPresence($this->getId()))
        {
          // exit("Yes id has no presence");
          return $this->create();
        }else {
          // update the data
          return $this->update();
        }
    }

    static public function find_reviews_by_doctor_id($doctor_id){
      // SELECT * FROM reviews WHERE doctor_id = '15'
        $queryString  = "SELECT * FROM ".ReviewTable::TABLE_NAME." ";
        $queryString .= "WHERE ".ReviewTable::COLUMN_DOCTOR_ID." = ?";
        $stmt = Review::$db->prepare($queryString);
        $stmt->execute([$doctor_id]);
        // $reviews = [];
        $reviews  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_array($reviewsAssoc);exit;

        if(!empty($reviews)){
          return $reviews;
        }else{
          return false;
        }
      }

    static public function find_review_by_patient_id($patient_id){
        $queryString  = "SELECT * FROM ".ReviewTable::TABLE_NAME." ";
        $queryString .= "WHERE ".ReviewTable::COLUMN_PATIENT_ID." = ?";
        $stmt = Review::$db->prepare($queryString);
        $stmt->execute([$patient_id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        if($review){
          // return review object, not associative array
          return new self($review);
        }
        else {
          // echo "review Not found";
          return false;
        }
      }
    static public function find_review_by_patient_and_doctor_id($patient_id,$doctor_id){
        $queryString  = "SELECT * FROM ".ReviewTable::TABLE_NAME." ";
        $queryString .= "WHERE ".ReviewTable::COLUMN_PATIENT_ID." = ? AND ".ReviewTable::COLUMN_DOCTOR_ID." = ?";
        $stmt = Review::$db->prepare($queryString);
        $stmt->execute([$patient_id,$doctor_id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        if($review){
          // return review object, not associative array
          return new self($review);
        }
        else {
          // echo "review Not found";
          return false;
        }
      }





      // SELECT COUNT(*) as 'total_ratings', SUM(rating) as 'rating_sum' FROM `reviews` WHERE doctor_id = '15';
      private static function get_total_number_of_ratings($doctor_id){
        $queryString  = "SELECT COUNT(*) as ".ReviewTable::COLUMN_TOTAL_RATINGS;
        $queryString .= " FROM ".ReviewTable::TABLE_NAME." WHERE ".ReviewTable::COLUMN_DOCTOR_ID." = ?";
        $stmt = Review::$db->prepare($queryString);
        $stmt->execute([$doctor_id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        if($review){
          return $review[ReviewTable::COLUMN_TOTAL_RATINGS];
        }
        else {
          return false;
        }
      }
      private static function get_sum_of_ratings($doctor_id){
        $queryString  = "SELECT SUM(rating) as ".ReviewTable::COLUMN_SUM_OF_RATINGS;
        $queryString .= " FROM ".ReviewTable::TABLE_NAME." WHERE ".ReviewTable::COLUMN_DOCTOR_ID." = ?";
        $stmt = Review::$db->prepare($queryString);
        $stmt->execute([$doctor_id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        if($review){
          return $review[ReviewTable::COLUMN_SUM_OF_RATINGS];
        }
        else {
          return false;
        }
      }

      public static function get_average_doctor_rating($doctor_id){
        if(Review::get_sum_of_ratings($doctor_id) == 0) return "0";
        $avgRating = Review::get_sum_of_ratings($doctor_id)/Review::get_total_number_of_ratings($doctor_id);
        return number_format($avgRating,1,'.','');
      }












  /********** Getters & Setters
  *********************************************/

  public static function getRatingStarsForForm($rating = 4){
    Review::$ratingId++;

    /*
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
    */
    switch ($rating) {
      case 1:
      // by 1 star checked
      return '<div class="rating-container">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2"/>
          <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

          <input checked id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
        </fieldset>
      </div>';

      case 2:
      // by 1 star checked
      return '<div class="rating-container">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2" checked/>
          <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
        </fieldset>
      </div>';


      case 3:
      // by 1 star checked
      return '<div class="rating-container">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" checked/>
          <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
        </fieldset>
      </div>';
      case 4:
      // by 1 star checked
      return '<div class="rating-container">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

          <input checked id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4" />
          <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
        </fieldset>
      </div>';

      case 5:
      // by 1 star checked
      return '<div class="rating-container">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5" checked/>
          <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
        </fieldset>
      </div>';

      default:
              // by default return, empty stars
              return '<div class="rating-container">
                <fieldset class="rate">
                  <input id="'.Review::$ratingId.'-star5" type="radio" name="rating" value="5"  />
                  <label   for="'.Review::$ratingId.'-star5" title="Excellent">5</label>

                  <input id="'.Review::$ratingId.'-star4" type="radio" name="rating" value="4"/>
                  <label  for="'.Review::$ratingId.'-star4" title="Good">4</label>

                  <input id="'.Review::$ratingId.'-star3" type="radio" name="rating" value="3" />
                  <label  for="'.Review::$ratingId.'-star3" title="Satisfactory">3</label>

                  <input id="'.Review::$ratingId.'-star2" type="radio" name="rating" value="2"/>
                  <label  for="'.Review::$ratingId.'-star2" title="Bad">2</label>

                  <input id="'.Review::$ratingId.'-star1" type="radio" name="rating" value="1" />
                  <label  for="'.Review::$ratingId.'-star1" title="Very bad">1</label>
                </fieldset>
              </div>';
    }

  }
  public static function getRatingStars($rating = ""){
    Review::$ratingId++;

    switch ($rating) {
      case 1:
      // by 1 star checked
      return '<div class="static-rating-container disabled">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2"/>
          <label  for="'.Review::$ratingId.'-star2" title="">2</label>

          <input checked id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="">1</label>
        </fieldset>
      </div>';

      case 2:
      // by 1 star checked
      return '<div class="static-rating-container disabled">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2" checked/>
          <label  for="'.Review::$ratingId.'-star2" title="">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="">1</label>
        </fieldset>
      </div>';


      case 3:
      // by 1 star checked
      return '<div class="static-rating-container disabled">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" checked/>
          <label  for="'.Review::$ratingId.'-star3" title="">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="">1</label>
        </fieldset>
      </div>';
      case 4:
      // by 1 star checked
      return '<div class="static-rating-container disabled">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5"  />
          <label   for="'.Review::$ratingId.'-star5" title="">5</label>

          <input checked id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4" />
          <label  for="'.Review::$ratingId.'-star4" title="">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="">1</label>
        </fieldset>
      </div>';

      case 5:
      // by 1 star checked
      return '<div class="static-rating-container disabled">
        <fieldset class="rate">
          <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5" checked/>
          <label   for="'.Review::$ratingId.'-star5" title="">5</label>

          <input id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4"/>
          <label  for="'.Review::$ratingId.'-star4" title="">4</label>

          <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" />
          <label  for="'.Review::$ratingId.'-star3" title="">3</label>

          <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2" />
          <label  for="'.Review::$ratingId.'-star2" title="">2</label>

          <input id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1"  />
          <label  for="'.Review::$ratingId.'-star1" title="">1</label>
        </fieldset>
      </div>';

      default:
              // by default return, empty stars
              return '<div class="static-rating-container disabled">
                <fieldset class="rate">
                  <input id="'.Review::$ratingId.'-star5" type="radio" name="'.Review::$ratingId.'" value="5"  />
                  <label   for="'.Review::$ratingId.'-star5" title="">5</label>

                  <input id="'.Review::$ratingId.'-star4" type="radio" name="'.Review::$ratingId.'" value="4"/>
                  <label  for="'.Review::$ratingId.'-star4" title="">4</label>

                  <input id="'.Review::$ratingId.'-star3" type="radio" name="'.Review::$ratingId.'" value="3" />
                  <label  for="'.Review::$ratingId.'-star3" title="">3</label>

                  <input id="'.Review::$ratingId.'-star2" type="radio" name="'.Review::$ratingId.'" value="2"/>
                  <label  for="'.Review::$ratingId.'-star2" title="">2</label>

                  <input id="'.Review::$ratingId.'-star1" type="radio" name="'.Review::$ratingId.'" value="1" />
                  <label  for="'.Review::$ratingId.'-star1" title="">1</label>
                </fieldset>
              </div>';
    }

  }

  public function getPatient(){
    return $this->patient;
  }
  public function getDoctor(){
    return $this->doctor;
  }

  public function getId() {
       return $this->id ;
  }
  public function setId($id) {
       $this->id = $id ;
  }


  public function getRating() {
       return $this->rating ;
  }
  public function setRating($rating) {
       $this->rating = $rating ;
  }


  public function getPatientId() {
       return $this->patient_id ;
  }
  public function setPatientId($patient_id) {
       $this->patient_id = $patient_id ;
       $this->patient = Patient::find_patient_by_id($patient_id);
  }




  public function getDoctorId() {
       return $this->doctor_id ;
  }
  public function setDoctorId($doctor_id) {
       $this->doctor_id = $doctor_id ;
       $this->doctor = Doctor::find_doctor_by_id($doctor_id);
  }


  public function getSubject() {
       return $this->subject ;
  }
  public function setSubject($subject) {
       $this->subject = $subject ;
  }


  public function getMessage() {
       return $this->message ;
  }
  public function setMessage($message) {
       $this->message = $message ;
  }


  public function getCreatedOn() {
       return $this->created_on ;
  }
  public function setCreatedOn($created_on) {
       $this->created_on = $created_on ;
  }
  public function getErrors(){
    return $this->errors;
  }














/***************** Helper Functions
************************************************/
    private function create(){
        // first validate the data, if validation successfull then save data and return true
        // if validation fails, then return errors array
        $errorsArray = $this->validate();
        if(isContainErrors($errorsArray))
        {
          return false;
        }else {
          // build query string & save data.
          // exit("Now All the data is valid, it's time to Save Data to the database");
          $queryString  =  "INSERT INTO ".ReviewTable::TABLE_NAME;
          $queryString .=  " (";
          $queryString .=  ReviewTable::COLUMN_ID.",";
          $queryString .=  ReviewTable::COLUMN_RATING.",";
          $queryString .=  ReviewTable::COLUMN_PATIENT_ID.",";
          $queryString .=  ReviewTable::COLUMN_DOCTOR_ID.",";
          $queryString .=  ReviewTable::COLUMN_SUBJECT.",";
          $queryString .=  ReviewTable::COLUMN_MESSAGE.",";
          $queryString .=  ReviewTable::COLUMN_CREATED_ON;
          $queryString .=  " ) VALUES (";
          $queryString .=  ":".ReviewTable::COLUMN_ID.",";
          $queryString .=  ":".ReviewTable::COLUMN_RATING.",";
          $queryString .=  ":".ReviewTable::COLUMN_PATIENT_ID.",";
          $queryString .=  ":".ReviewTable::COLUMN_DOCTOR_ID.",";
          $queryString .=  ":".ReviewTable::COLUMN_SUBJECT.",";
          $queryString .=  ":".ReviewTable::COLUMN_MESSAGE.",";
          $queryString .=  ":".ReviewTable::COLUMN_CREATED_ON.")";

          try{
            $stmt = Review::$db->prepare($queryString);
            $stmt->execute([
              ReviewTable::COLUMN_ID => $this->getId(),
              ReviewTable::COLUMN_RATING => $this->getRating(),
              ReviewTable::COLUMN_PATIENT_ID => $this->getPatientId(),
              ReviewTable::COLUMN_DOCTOR_ID => $this->getDoctorId(),
              ReviewTable::COLUMN_SUBJECT => $this->getSubject(),
              ReviewTable::COLUMN_MESSAGE => $this->getMessage(),
              ReviewTable::COLUMN_CREATED_ON => $this->getCreatedOn()
            ]);
            return true;
          }catch(Exception $e){
            exit($e->getMessage());
          }

        }

    }
    private function update(){
          // first validate the data, if validation successfull then save data and return true
          // if validation fails, then return errors array
          $errorsArray = $this->validate();
          if(isContainErrors($errorsArray))
          {
            return false;
          }else {
            // build query string & update the data.
            // exit("Now All the data is valid, it's time to Save Data to the database");
            //  UPDATE `patients` SET `id` = NULL, `username` = '', `hashedPassword` = '', `dob` = '' WHERE `patients`.`id` = 1
            $queryString  =  "UPDATE ".ReviewTable::TABLE_NAME;
            $queryString .=  " SET ".ReviewTable::COLUMN_RATING." = :".ReviewTable::COLUMN_RATING.", ";
            $queryString .=  ReviewTable::COLUMN_SUBJECT." = :".ReviewTable::COLUMN_SUBJECT.", ";
            $queryString .=  ReviewTable::COLUMN_MESSAGE." = :".ReviewTable::COLUMN_MESSAGE." ";
            $queryString .=  " WHERE ".ReviewTable::COLUMN_ID." = ".$this->getId()." ";

            try{
              $stmt = Review::$db->prepare($queryString);
              $stmt->execute([
                ReviewTable::COLUMN_RATING => $this->getRating(),
                ReviewTable::COLUMN_SUBJECT => $this->getSubject(),
                ReviewTable::COLUMN_MESSAGE => $this->getMessage()
              ]);
              return true;
            }catch(Exception $e){
              exit($e->getMessage());
            }
          }

    }
    private function validate(){
     $errors = [];

     if(!hasPresence($this->getRating())){$errors[AdminTable::COLUMN_RATING]= 'Rating can\'t be blank';}
     if(!hasPresence($this->getSubject())){$errors[AdminTable::COLUMN_SUBJECT]= 'Subject can\'t be blank';}
     if(!hasPresence($this->getMessage())){$errors[AdminTable::COLUMN_MESSAGE]= 'Message can\'t be blank';}

     $this->errors = $errors;
     return $errors;
    }









}

?>
