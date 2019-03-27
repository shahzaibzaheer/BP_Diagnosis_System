<?php

class Patient {


    private $id;
    private $name;
    private $userName;
    private $email;
    private $gender;
    private $hashedPassword;
    private $password;
    private $confirmPassword;
    private $phoneNumber;
    private $address;
    private $city;
    private $date_of_birth;
    private $createdOn;
    static private $db;



    function __construct($args)
    {
      $this->setId($args[PatientTable::COLUMN_ID] ?? '');
      $this->setName($args[PatientTable::COLUMN_NAME] ?? '');
      $this->setUserName($args[PatientTable::COLUMN_USERNAME] ?? '');
      $this->setEmail($args[PatientTable::COLUMN_EMAIL] ?? '');
      $this->setGender($args[PatientTable::COLUMN_GENDER] ?? 1);
      $this->setHashedPassword($args[PatientTable::COLUMN_HASHED_PASSWORD] ?? '');
      $this->setPhoneNumber($args[PatientTable::COLUMN_PHONE] ?? '');
      $this->setAddress($args[PatientTable::COLUMN_ADDRESS] ?? '');
      $this->setCity($args[PatientTable::COLUMN_CITY] ?? '');
      $this->setDOB($args[PatientTable::COLUMN_DATE_OF_BITRH] ?? '');
      $this->setCreatedOn($args[PatientTable::COLUMN_CREATED_ON] ?? '');
      $this->setPassword($args['password'] ?? '');
      $this->setConfirmPassword($args['confirmPassword'] ?? '');
    }





  /*** Database Related
  *************************************/

  static public function setDatabase($pdo){
    if($pdo){
      Patient::$db = $pdo;
    }
    else{
      throw new \Exception("Please pass valid database in Patient ");
    }
  }



  public function save(){
    if(!hasPresence($this->getId()))
    {
      // exit("Yes id has no presence");
      return $this->create();
    }else {
      // update the data
      exit("update the Patient data");
    }
  }



  /******** Setters
  **************************/
  private function setId($id)
  {
    $this->id = $id;
  }
  public function setName($name='')
  {
    $this->name = $name;
  }
  public function setUserName($userName='')
  {
    $this->userName = $userName;
  }
  public function setEmail($email='')
  {
    $this->email = $email;
  }
  public function setGender($gender){
    $this->gender = $gender;
  }
  public function setPassword($password='')
  {
    $this->password = $password;
  }
  public function setConfirmPassword($confirmPassword='')
  {
    $this->confirmPassword = $confirmPassword;
  }
  private function setHashedPassword($hashedPassword)
  {
    $this->hashedPassword = $hashedPassword;
  }
  public function setPhoneNumber($phoneNumber='')
  {
    $this->phoneNumber = $phoneNumber;
  }
  public function setAddress($address='')
  {
    $this->address = $address;
  }
  public function setCity($city='')
  {
    $this->city = $city;
  }
  public function setDOB($date_of_birth = ''){
    $this->date_of_birth = $date_of_birth;
  }
  private function setCreatedOn($timestamp = '')
  {
    $this->createdOn = $timestamp;
  }



  /******** Getters
  **************************/
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getUserName()
  {
    return $this->userName;
  }
  public function getGender()
  {
    return $this->gender;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getPhoneNumber()
  {
    return $this->phoneNumber;
  }
  private function getPassword(){
    return $this->password;
  }
  private function getConfirmedPassword()
  {
    return $this->confirmPassword;
  }
  private function getHashedPassword()
  {
    return $this->hashedPassword;
  }
  public function getAddress()
  {
    return $this->address;
  }
  public function getCity()
  {
    return $this->city;
  }
  public function getDOB()
  {
    return $this->date_of_birth;
  }

  public function getCreatedOn()
  {
    return $this->createdOn;
  }




  /******* Helper Functions
  ************************************/
  public function isUsernameAlreadyExists($userName){
      return false; //false means username not exist
  }
  public function isEmailAlreadyExists($email){
      return false; //false means email not exist
  }

  private function create(){
        // first validate the data, if validation successfull then save data and return true
        // if validation fails, then return errors array
        $errorsArray = $this->validate();
        if(isContainErrors($errorsArray))
        {
          return $errorsArray;
        }else {
          // build query string & save data.
          // exit("Now All the data is valid, it's time to Save Data to the database");
          $queryString  =  "INSERT INTO ".PatientTable::TABLE_NAME;
          $queryString .=  " (".
          $queryString .=  PatientTable::COLUMN_USERNAME.",";
          $queryString .=  PatientTable::COLUMN_EMAIL.",";
          $queryString .=  PatientTable::COLUMN_GENDER.",";
          $queryString .=  PatientTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .=  PatientTable::COLUMN_PHONE.",";
          $queryString .=  PatientTable::COLUMN_ADDRESS.",";
          $queryString .=  PatientTable::COLUMN_CITY.",";
          $queryString .=  PatientTable::COLUMN_DATE_OF_BITRH;
          $queryString .=  ." ) VALUES (";

          $queryString .=  ":".PatientTable::COLUMN_USERNAME.",";
          $queryString .=  ":".PatientTable::COLUMN_EMAIL.",";
          $queryString .=  ":".PatientTable::COLUMN_GENDER.",";
          $queryString .=  ":".PatientTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .=  ":".PatientTable::COLUMN_PHONE.",";
          $queryString .=  ":".PatientTable::COLUMN_ADDRESS.",";
          $queryString .=  ":".PatientTable::COLUMN_CITY.",";
          $queryString .=  ":".PatientTable::COLUMN_DATE_OF_BITRH.")";
          exit($queryString);

        }

    }

  private function validate(){
     $errors = [];

     if(!hasPresence($this->getName())){
       $errors[PatientTable::COLUMN_NAME]='Patient name can\'t be blank';
     }elseif (!has_length($this->getName(), array('min' => 2, 'max' => 30))) {
       $errors[PatientTable::COLUMN_NAME] = "Patient name must be between 2 and 30 characters.";
     }

     if(!hasPresence($this->getUserName())) {
       $errors[PatientTable::COLUMN_USERNAME] = "Username cannot be blank.";
     } elseif (!has_length($this->getUserName(), array('min' => 8, 'max' => 40))) {
       $errors[PatientTable::COLUMN_USERNAME] = "Username must be between 8 and 40 characters.";
     } elseif($this->isUsernameAlreadyExists($this->getUserName())){
       $errors[PatientTable::COLUMN_NAME] = "Username already exist, try another";
     }


     if(!isValidEmailFormat($this->getEmail())){$errors[PatientTable::COLUMN_EMAIL]="Please enter a valid Email address";}
     elseif($this->isEmailAlreadyExists($this->getEmail())){$errors[PatientTable::COLUMN_EMAIL]="Email is already existed, use new or <a href= '".urlFor('login.php')."'>Login Here</a>";}






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
         $encryptedPassword = password_hash($this->getPassword(),PASSWORD_BCRYPT);
         $this->setHashedPassword($encryptedPassword);
       }



     if(!hasPresence($this->getPhoneNumber())){$errors[PatientTable::COLUMN_PHONE]= 'Phone Number can\'t be blank';}
     elseif (!has_length($this->getPhoneNumber(), array('min' => 10))) {
       $errors[PatientTable::COLUMN_PHONE] = "Please Enter a valid phone number";
     }
     if(!hasPresence($this->getAddress())){$errors[PatientTable::COLUMN_ADDRESS]= 'Address can\'t be blank';}
     elseif (!has_length($this->getAddress(), array('min' => 20))) {
       $errors[PatientTable::COLUMN_ADDRESS] = "Please enter complete address";
     }

     if(!hasPresence($this->getCity())){$errors[PatientTable::COLUMN_CITY]= 'City can\'t be blank';}
     if(!hasPresence($this->getDOB())){$errors[PatientTable::COLUMN_DATE_OF_BITRH]= 'Date of birth can\'t be blank';}

     return $errors;
   }

}
?>
