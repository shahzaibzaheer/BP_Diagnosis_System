<?php

class Doctor
{
    private $id; //int
    private $username; //String
    private $name; //String
    private $email; //String
    private $gender; //boolean
    private $hashedPassword; //String
    private $password;
    private $confirmPassword;
    private $phone; //String
    private $address; //String
    private $city; //String
    private $dob; //String
    private $about; //String
    private $specialization; //String
    private $qualification; //String
    private $fees; //int
    private $created_on; //String

    private $reviews; //String



    static private $db;
    private $errors;




    function __construct($args =[]){
            $this->setId($args[DoctorTable::COLUMN_ID] ?? '');
            $this->setUsername($args[DoctorTable::COLUMN_USERNAME] ?? '');
            $this->setName($args[DoctorTable::COLUMN_NAME] ?? '');
            $this->setEmail($args[DoctorTable::COLUMN_EMAIL] ?? '');
            $this->setGender($args[DoctorTable::COLUMN_GENDER] ?? '');
            $this->setHashedPassword($args[DoctorTable::COLUMN_HASHED_PASSWORD] ?? '');
            $this->setPassword($args['password'] ?? '');
            $this->setConfirmedPassword($args['confirmPassword'] ?? '');
            $this->setPhone($args[DoctorTable::COLUMN_PHONE] ?? '');
            $this->setAddress($args[DoctorTable::COLUMN_ADDRESS] ?? '');
            $this->setCity($args[DoctorTable::COLUMN_CITY] ?? '');
            $this->setDob($args[DoctorTable::COLUMN_DATE_OF_BITRH] ?? '');
            $this->setAbout($args[DoctorTable::COLUMN_ABOUT] ?? '');
            $this->setSpecialization($args[DoctorTable::COLUMN_SPECIALIZATION] ?? '');
            $this->setQualification($args[DoctorTable::COLUMN_QUALIFICATION] ?? '');
            $this->setFees($args[DoctorTable::COLUMN_FEES] ?? '');
            $this->setCreated_on($args[DoctorTable::COLUMN_CREATED_ON] ?? '');

    }
    private function bind_doctor_data($args){
            $this->setId($args[DoctorTable::COLUMN_ID] ?? '');
            $this->setUsername($args[DoctorTable::COLUMN_USERNAME] ?? '');
            $this->setName($args[DoctorTable::COLUMN_NAME] ?? '');
            $this->setEmail($args[DoctorTable::COLUMN_EMAIL] ?? '');
            $this->setGender($args[DoctorTable::COLUMN_GENDER] ?? true);
            $this->setHashedPassword($args[DoctorTable::COLUMN_HASHED_PASSWORD] ?? '');
            $this->setPhone($args[DoctorTable::COLUMN_PHONE] ?? '');
            $this->setAddress($args[DoctorTable::COLUMN_ADDRESS] ?? '');
            $this->setCity($args[DoctorTable::COLUMN_CITY] ?? '');
            $this->setDob($args[DoctorTable::COLUMN_DATE_OF_BITRH] ?? '');
            $this->setAbout($args[DoctorTable::COLUMN_ABOUT] ?? '');
            $this->setSpecialization($args[DoctorTable::COLUMN_SPECIALIZATION] ?? '');
            $this->setQualification($args[DoctorTable::COLUMN_QUALIFICATION] ?? '');
            $this->setFees($args[DoctorTable::COLUMN_FEES] ?? '');
            $this->setCreated_on($args[DoctorTable::COLUMN_CREATED_ON] ?? '');

    }

/*** Database Related
*************************************/
    static public function setDatabase($pdo){
      if($pdo){
        Doctor::$db = $pdo;
      }
      else{
        throw new \Exception("Please pass valid database in doctor ");
      }
    }

    public function save(){
      if(!hasPresence($this->getId()))
      {
        // exit("Yes id has no presence, so create new user");
        return $this->create();
      }else {
        // update the data
        // exit("update the Doctor data");
        return $this->update();
      }
    }

    static public function find_doctor_by_id($id){
        // SELECT * FROM `doctors` WHERE `username` = 'abc'
        $queryString = "SELECT * FROM ".DoctorTable::TABLE_NAME;
        $queryString .= " WHERE ".DoctorTable::COLUMN_ID." = ?";
        $stmt = Doctor::$db->prepare($queryString);
        $stmt->execute([$id]);
        // print_array($stmt);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        if($doctor){
          return new Doctor($doctor);
        }
        return false;
    }

    static public function find_doctor_by_username($username){
      // SELECT * FROM `doctors` WHERE `username` = 'abc'
        $queryString = "SELECT * FROM ".DoctorTable::TABLE_NAME;
        $queryString .= " WHERE ".DoctorTable::COLUMN_USERNAME." = ?";
        $stmt = Doctor::$db->prepare($queryString);
        $stmt->execute([$username]);
        // print_array($stmt);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        if($doctor){
          return new Doctor($doctor);
        }
        return false;
    }

    static public function find_doctor_by_email($email){
      // SELECT * FROM `doctors` WHERE `email` = 'doctor@gmail.com'
        $queryString = "SELECT * FROM ".DoctorTable::TABLE_NAME;
        $queryString .= " WHERE ".DoctorTable::COLUMN_EMAIL." = ?";
        $stmt = Doctor::$db->prepare($queryString);
        $stmt->execute([$email]);
        // print_array($stmt);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        if($doctor){
          return new Doctor($doctor);
        }
        return false;
    }
    static public function find_doctor_by_email_assoc($email){
      // SELECT * FROM `doctors` WHERE `email` = 'doctor@gmail.com'
        $queryString = "SELECT * FROM ".DoctorTable::TABLE_NAME;
        $queryString .= " WHERE ".DoctorTable::COLUMN_EMAIL." = ?";
        $stmt = Doctor::$db->prepare($queryString);
        $stmt->execute([$email]);
        // print_array($stmt);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        if($doctor){
          return $doctor;
        }
        return false;
    }
    static public function find_all_doctors(){
     $queryString  = "SELECT * FROM ".DoctorTable::TABLE_NAME;
     $stmt = Doctor::$db->prepare($queryString);
     $stmt->execute();
     $doctors = [];
     // we want to return prescription objects
     while($doctorAssoc = $stmt->fetch(PDO::FETCH_ASSOC)){
       $doctors[]= new self($doctorAssoc);
     }
     if(!empty($doctors)){
       return $doctors;
     }else{
       return false;
     }
    }

    public function delete(){
      if(hasPresence($this->getId()))
      {  // means , doctor exit in db and this object is successfull binded with db data
        // "DELETE FROM `patients` WHERE `patients`.`id` = 49"
        $queryString =  "DELETE FROM ".DoctorTable::TABLE_NAME." WHERE ".DoctorTable::COLUMN_ID." = ?";
        $stmt = Doctor::$db->prepare($queryString);
        $stmt->execute([$this->getId()]);
        return true;
      }
      else {
        return false;
      }
    }


/******* Getters & Setters
**************************************/
    public function getId() {
         return $this->id;
    }
    public function setId($id) {
         $this->id = $id;
         $this->reviews = Review::find_reviews_by_doctor_id($id);

    }

    public function getUsername() {
         return $this->username;
    }
    public function setUsername($username) {
         $this->username = $username;
    }

    public function getName() {
         return $this->name;
    }
    public function setName($name) {
         $this->name = $name;
    }

    public function getEmail() {
         return $this->email;
    }
    public function setEmail($email) {
         $this->email = $email;
    }

    public function getGender() {
         return $this->gender;
    }
    public function setGender($gender) {
         $this->gender = $gender;
    }

    public function getHashedPassword() {
         return $this->hashedPassword;
    }
    public function setHashedPassword($hashedPassword) {
         $this->hashedPassword = $hashedPassword;
    }

    public function getPhone() {
         return $this->phone;
    }
    public function setPhone($phone) {
         $this->phone = $phone;
    }

    public function getAddress() {
         return $this->address;
    }
    public function setAddress($address) {
         $this->address = $address;
    }

    public function getCity() {
         return $this->city;
    }
    public function setCity($city) {
         $this->city = $city;
    }

    public function getDob() {
         return $this->dob;
    }
    public function setDob($dob) {
         $this->dob = $dob;
    }

    public function getAbout() {
         return $this->about;
    }
    public function setAbout($about) {
         $this->about = $about;
    }

    public function getSpecialization() {
         return $this->specialization;
    }
    public function setSpecialization($specialization) {
         $this->specialization = $specialization;
    }

    public function getQualification() {
         return $this->qualification;
    }
    public function setQualification($qualification) {
         $this->qualification = $qualification;
    }

    public function getFees() {
         return $this->fees;
    }
    public function setFees($fees) {
         $this->fees = $fees;
    }

    public function getCreated_on() {
         return $this->created_on;
    }
    public function setCreated_on($created_on) {
         $this->created_on = $created_on;
    }
    public function getPassword() {
         return $this->password;
    }
    public function setPassword($password) {
         $this->password = $password;
    }
    public function getConfirmedPassword() {
         return $this->confirmPassword;
    }
    public function setConfirmedPassword($confirmPassword) {
         $this->confirmPassword = $confirmPassword;
    }
    public function getErrors(){
      return $this->errors;
    }



/******* Helper Functions
************************************/
    private function create(){
        // first validate the data, if validation successfull then save data and return true
        // if validation fails, then return errors array
        $errorsArray = $this->validate();
        if(isContainErrors($errorsArray))
        {
          return false;
        }else{
          // build query string & save data.
          // exit("Now All the data is valid, it's time to Save Data to the database");

          $queryString  = "INSERT INTO ".DoctorTable::TABLE_NAME;
          $queryString  .= " (";
          $queryString .= DoctorTable::COLUMN_USERNAME.",";
          $queryString .= DoctorTable::COLUMN_NAME.",";
          $queryString .= DoctorTable::COLUMN_EMAIL.",";
          $queryString .= DoctorTable::COLUMN_GENDER.",";
          $queryString .= DoctorTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .= DoctorTable::COLUMN_PHONE.",";
          $queryString .= DoctorTable::COLUMN_ADDRESS.",";
          $queryString .= DoctorTable::COLUMN_CITY.",";
          $queryString .= DoctorTable::COLUMN_DATE_OF_BITRH.",";
          $queryString .= DoctorTable::COLUMN_ABOUT.",";
          $queryString .= DoctorTable::COLUMN_SPECIALIZATION.",";
          $queryString .= DoctorTable::COLUMN_QUALIFICATION.",";
          $queryString .= DoctorTable::COLUMN_FEES;
          $queryString .= " ) VALUES (";
          $queryString .= ":".DoctorTable::COLUMN_USERNAME. ",";
          $queryString .= ":".DoctorTable::COLUMN_NAME. ",";
          $queryString .= ":".DoctorTable::COLUMN_EMAIL. ",";
          $queryString .= ":".DoctorTable::COLUMN_GENDER. ",";
          $queryString .= ":".DoctorTable::COLUMN_HASHED_PASSWORD. ",";
          $queryString .= ":".DoctorTable::COLUMN_PHONE. ",";
          $queryString .= ":".DoctorTable::COLUMN_ADDRESS. ",";
          $queryString .= ":".DoctorTable::COLUMN_CITY. ",";
          $queryString .= ":".DoctorTable::COLUMN_DATE_OF_BITRH. ",";
          $queryString .= ":".DoctorTable::COLUMN_ABOUT. ",";
          $queryString .= ":".DoctorTable::COLUMN_SPECIALIZATION. ",";
          $queryString .= ":".DoctorTable::COLUMN_QUALIFICATION. ",";
          $queryString .= ":".DoctorTable::COLUMN_FEES. ")";

          // exit($queryString);

          try{
            $stmt = Doctor::$db->prepare($queryString);
            $values = [
                DoctorTable::COLUMN_USERNAME  => $this->getUserName(),
                DoctorTable::COLUMN_NAME  => $this->getName(),
                DoctorTable::COLUMN_EMAIL  => $this->getEmail(),
                DoctorTable::COLUMN_GENDER  => $this->getGender(),
                DoctorTable::COLUMN_HASHED_PASSWORD  => $this->getHashedPassword(),
                DoctorTable::COLUMN_PHONE  => $this->getPhone(),
                DoctorTable::COLUMN_ADDRESS  => $this->getAddress(),
                DoctorTable::COLUMN_CITY  => $this->getCity(),
                DoctorTable::COLUMN_DATE_OF_BITRH  => $this->getDob(),
                DoctorTable::COLUMN_ABOUT  => $this->getAbout(),
                DoctorTable::COLUMN_SPECIALIZATION  => $this->getSpecialization(),
                DoctorTable::COLUMN_QUALIFICATION  => $this->getQualification(),
                DoctorTable::COLUMN_FEES  => $this->getFees()
            ];
            // print_array($values);exit;
            $stmt->execute($values);
            return true;
          }catch(Exception $e){
            exit($e->getMessage());
          }
        }
    }

    private function update(){
          // first validate the data, if validation successfull then save data and return true
          // if validation fails, then return errors array
          $errorsArray = $this->validateUpdation();
          if(isContainErrors($errorsArray))
          {
            return false;
          }else {
            // build query string & update the data.
            // exit("Now All the data is valid, it's time to Save Data to the database");
            //  UPDATE `patients` SET `id` = NULL, `username` = '', `hashedPassword` = '', `dob` = '' WHERE `patients`.`id` = 1
            $queryString  =  "UPDATE ".DoctorTable::TABLE_NAME;
            $queryString .=  " SET ".DoctorTable::COLUMN_NAME." = :".DoctorTable::COLUMN_NAME.", ";
            $queryString .=  DoctorTable::COLUMN_GENDER." = :".DoctorTable::COLUMN_GENDER.", ";
            $queryString .=  DoctorTable::COLUMN_PHONE." = :".DoctorTable::COLUMN_PHONE.", ";
            $queryString .=  DoctorTable::COLUMN_ADDRESS." = :".DoctorTable::COLUMN_ADDRESS.", ";
            $queryString .=  DoctorTable::COLUMN_SPECIALIZATION." = :".DoctorTable::COLUMN_SPECIALIZATION.", ";
            $queryString .=  DoctorTable::COLUMN_QUALIFICATION." = :".DoctorTable::COLUMN_QUALIFICATION.", ";
            $queryString .=  DoctorTable::COLUMN_ABOUT." = :".DoctorTable::COLUMN_ABOUT.", ";
            $queryString .=  DoctorTable::COLUMN_FEES." = :".DoctorTable::COLUMN_FEES.", ";
            $queryString .=  DoctorTable::COLUMN_CITY." = :".DoctorTable::COLUMN_CITY." ";
            $queryString .=  " WHERE ".DoctorTable::COLUMN_ID." = ".$this->getId()." ";

            try{
              $stmt = Doctor::$db->prepare($queryString);
              $stmt->execute([
                DoctorTable::COLUMN_NAME => $this->getName(),
                DoctorTable::COLUMN_GENDER => $this->getGender(),
                DoctorTable::COLUMN_PHONE => $this->getPhone(),
                DoctorTable::COLUMN_ADDRESS => $this->getAddress(),
                DoctorTable::COLUMN_SPECIALIZATION => $this->getSpecialization(),
                DoctorTable::COLUMN_QUALIFICATION => $this->getQualification(),
                DoctorTable::COLUMN_ABOUT => $this->getAbout(),
                DoctorTable::COLUMN_FEES => $this->getFees(),
                DoctorTable::COLUMN_CITY => $this->getCity()
              ]);
              return true;
            }catch(Exception $e){
              exit($e->getMessage());
            }

          }

      }



      private function validateUpdation(){
        $errors = [];

        if(!hasPresence($this->getName())){
          $errors[DoctorTable::COLUMN_NAME]='Doctor name can\'t be blank';
        }elseif (!has_length($this->getName(), array('min' => 2, 'max' => 30))) {
          $errors[DoctorTable::COLUMN_NAME] = "Doctor name must be between 2 and 30 characters.";
        }


        if(!hasPresence($this->getPhone())){$errors[DoctorTable::COLUMN_PHONE]= 'Phone Number can\'t be blank';}
        elseif (!has_length($this->getPhone(), array('min' => 10))) {
          $errors[DoctorTable::COLUMN_PHONE] = "Please Enter a valid phone number";
        }
        if(!hasPresence($this->getAddress())){$errors[DoctorTable::COLUMN_ADDRESS]= 'Address can\'t be blank';}
        elseif (!has_length($this->getAddress(), array('min' => 20))) {
          $errors[DoctorTable::COLUMN_ADDRESS] = "Please enter complete address";
        }

        if(!hasPresence($this->getCity())){$errors[DoctorTable::COLUMN_CITY]= 'City can\'t be blank';}
        if(!hasPresence($this->getSpecialization())){$errors[DoctorTable::COLUMN_CITY]= 'Specialization can\'t be blank';}
        if(!hasPresence($this->getQualification())){$errors[DoctorTable::COLUMN_CITY]= 'Qualification can\'t be blank';}
        if(!hasPresence($this->getAbout())){$errors[DoctorTable::COLUMN_CITY]= 'About can\'t be blank';}
        if(!hasPresence($this->getFees())){$errors[DoctorTable::COLUMN_CITY]= 'Fees can\'t be blank';}

        $this->errors = $errors;
        return $errors;
      }



    private function validate(){
     $errors = [];

     if(!hasPresence($this->getName())){
       $errors[DoctorTable::COLUMN_NAME]='Doctor name can\'t be blank';
     }elseif (!has_length($this->getName(), array('min' => 2, 'max' => 30))){
       $errors[DoctorTable::COLUMN_NAME] = "Doctor name must be between 2 and 30 characters.";
     }

     if(!hasPresence($this->getUserName())) {
       $errors[DoctorTable::COLUMN_USERNAME] = "Username cannot be blank.";
     } elseif (!has_length($this->getUserName(), array('min' => 8, 'max' => 40))) {
       $errors[DoctorTable::COLUMN_USERNAME] = "Username must be between 8 and 40 characters.";
     } elseif($this->isUsernameAlreadyExists($this->getUserName())){
       $errors[DoctorTable::COLUMN_USERNAME] = "Username already exist, try another";
     }

     if(!isValidEmailFormat($this->getEmail())){$errors[DoctorTable::COLUMN_EMAIL]="Please enter a valid Email address";}
     elseif($this->isEmailAlreadyExists($this->getEmail())){$errors[DoctorTable::COLUMN_EMAIL]="Email is already existed, use new or Login</a>";}






       // password validation
       if(!hasPresence($this->getPassword())) {
         $errors['password'] = "Password cannot be blank.";
       } elseif (!has_length($this->getPassword(), array('min' => 12))) {
         $errors['password'] = "Password must contain 12 or more characters";
       } elseif (!preg_match('/[A-Z]/', $this->getPassword())) {
         $errors['password'] = "Password must contain at least 1 uppercase letter";
       } elseif (!preg_match('/[a-z]/', $this->getPassword())) {
         $errors['password'] = "Password must contain at least 1 lowercase letter";
       } elseif (!preg_match('/[0-9]/', $this->getPassword())) {
         $errors['password'] = "Password must contain at least 1 number";
       }
       // elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->getPassword())) {
       //   $errors['password'] = "Password must contain at least 1 symbol";
       // }

       if(!hasPresence($this->getConfirmedPassword())) {
         $errors['confirmPassword'] = "Confirm password cannot be blank.";
       } elseif ($this->getPassword() !== $this->getConfirmedPassword()) {
         $errors['confirmPassword'] = "Password and confirm password not match";
       }
       //if password has pass the validation, then encrypt the password for storing in the database
       if(!isset($errors['password']) && !isset($errors['confirmPassword']))
       {
         $encryptedPassword = password_hash($this->getPassword(),PASSWORD_DEFAULT);
         $this->setHashedPassword($encryptedPassword);
       }


     if(!hasPresence($this->getPhone())){$errors[DoctorTable::COLUMN_PHONE]= 'Phone Number can\'t be blank';}
     elseif (!has_length($this->getPhone(), array('min' => 10))) {
       $errors[DoctorTable::COLUMN_PHONE] = "Please Enter a valid phone number";
     }
     if(!hasPresence($this->getAddress())){$errors[DoctorTable::COLUMN_ADDRESS]= 'Address can\'t be blank';}
     elseif (!has_length($this->getAddress(), array('min' => 20))) {
       $errors[DoctorTable::COLUMN_ADDRESS] = "Please enter complete address";
     }

     if(!hasPresence($this->getCity())){$errors[DoctorTable::COLUMN_CITY]= 'City can\'t be blank';}
     if(!hasPresence($this->getDob())){$errors[DoctorTable::COLUMN_DATE_OF_BITRH]= 'Select Date of birth';}
     if(!hasPresence($this->getAbout())){$errors[DoctorTable::COLUMN_ABOUT]= 'About can\'t be blank';}
     if(!hasPresence($this->getSpecialization())){$errors[DoctorTable::COLUMN_SPECIALIZATION]= 'Specialization can\'t be blank';}
     if(!hasPresence($this->getQualification())){$errors[DoctorTable::COLUMN_QUALIFICATION]= 'Qualification can\'t be blank';}
     if(!hasPresence($this->getFees())){$errors[DoctorTable::COLUMN_FEES]= 'Fees can\'t be blank';}

     $this->errors = $errors;
     return $errors;

    }

    public function isUsernameAlreadyExists($userName){
        $doctor = Doctor::find_doctor_by_username($userName);
        if($doctor === false){
        // doctor not exists
          return false;
        }
        else {
          return true;
        }
    }
    public function isEmailAlreadyExists($email){
        $doctor =  Doctor::find_doctor_by_email($email);
        if($doctor === false){
          // doctor not exists
          return false;
        }
        else {
          return true;
        }
    }


    public function login(){
       $result = $this->validateLoginCredentials();
       if($result === true)
       {
         return true; // login successfull
       }
       else {
         $this->errors = $result;
         return false;
       }
    }

    public function validateLoginCredentials(){
      if(!isValidEmailFormat($this->getEmail()))
      {
        $errors[DoctorTable::COLUMN_EMAIL]="Please enter a valid Email address";
      }
      if(!hasPresence($this->getPassword())) {
        $errors['password'] = "Password cannot be blank.";
      }
      if(!isset($errors[DoctorTable::COLUMN_EMAIL]) && !isset($errors['password']))
      {
        // check email & password
        if(!$this->isEmailAlreadyExists($this->getEmail()))
        {
          $errors['invalidCredantials'] = 'Email not exists';
          // $errors['invalidCredantials'] = 'Email or Passworrd is incorrect!';
        }else{
          // email exits, validate password
          $doctor = Doctor::find_doctor_by_email_assoc($this->getEmail());
          if($doctor)
          {
              // echo "Hashed: ". $doctor->getHashedPassword() ."<br />";
              // echo "Password: ".$this->getPassword();
              // exit;
              $isSuccess = password_verify($this->getPassword(), $doctor[DoctorTable::COLUMN_HASHED_PASSWORD]);
              // var_dump($isSuccess);
              if(!$isSuccess){
                  // $errors['invalidCredantials'] = 'Email or Password is incorrect!';
                  $errors['invalidCredantials'] = 'Password is incorrect!';
              }else {
                // patient login successfull , bind patient data
                $this->bind_doctor_data($doctor);
                return true;
              }
          }
        }
      }
      return $errors;
    }
}

 ?>
