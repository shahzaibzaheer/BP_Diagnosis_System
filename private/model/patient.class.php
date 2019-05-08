<?php
    // TODO: impletemnt function user already existed or not
    // TODO: impletemnt function email already existed or not
 ?>
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
    private $currentPassword;
    private $phoneNumber;
    private $address;
    private $city;
    private $date_of_birth;
    private $createdOn;

    static private $db;
    private $errors;


    function __construct($args = []){
      $this->setId($args[PatientTable::COLUMN_ID] ?? '');
      $this->setName($args[PatientTable::COLUMN_NAME] ?? '');
      $this->setUserName($args[PatientTable::COLUMN_USERNAME] ?? '');
      $this->setEmail($args[PatientTable::COLUMN_EMAIL] ?? '');
      $this->setGender($args[PatientTable::COLUMN_GENDER] ?? '');
      $this->setHashedPassword($args[PatientTable::COLUMN_HASHED_PASSWORD] ?? '');
      $this->setPhoneNumber($args[PatientTable::COLUMN_PHONE] ?? '');
      $this->setAddress($args[PatientTable::COLUMN_ADDRESS] ?? '');
      $this->setCity($args[PatientTable::COLUMN_CITY] ?? '');
      $this->setDOB($args[PatientTable::COLUMN_DATE_OF_BITRH] ?? '');
      $this->setCreatedOn($args[PatientTable::COLUMN_CREATED_ON] ?? '');
      $this->setPassword($args['password'] ?? '');
      $this->setCurrentPassword($args['currentPassword'] ?? '');
      $this->setConfirmPassword($args['confirmPassword'] ?? '');
    }
    private function bind_patient_data($args){
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
      $this->setCurrentPassword($args['currentPassword'] ?? '');
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
      return $this->update();
    }
  }

  public function delete(){
    if(hasPresence($this->getId()))
    {  // means , patient exit in db and this object is successfull binded with db data
      // "DELETE FROM `patients` WHERE `patients`.`id` = 49"
      $queryString =  "DELETE FROM ".PatientTable::TABLE_NAME." WHERE ".PatientTable::COLUMN_ID." = ?";
      $stmt = Patient::$db->prepare($queryString);
      $stmt->execute([$this->getId()]);
      return true;
    }
    else {
      return false;
    }
  }

  static public function find_patient_by_id($id){
    $queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME." ";
    $queryString .= "WHERE ".PatientTable::COLUMN_ID." = ?";
    $stmt = Patient::$db->prepare($queryString);
    $stmt->execute([$id]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    if($patient){
      // return patient object, not associative array
      return new Patient($patient);
    }
    else {
      // echo "Patient Not found";
      return false;
    }
  }
  static public function find_patient_by_username($username){
    $queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME." ";
    $queryString .= "WHERE ".PatientTable::COLUMN_USERNAME." = ?";
    $stmt = Patient::$db->prepare($queryString);
    $stmt->execute([$username]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($patient)){
        return new self($patient);
    }
    else {
      // echo "Patient Not found"
      return false;
    }
  }
    static public function find_patient_by_username_assoc($username){
        $queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME." ";
        $queryString .= "WHERE ".PatientTable::COLUMN_USERNAME." = ?";
        $stmt = Patient::$db->prepare($queryString);
        $stmt->execute([$username]);
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($patient)){
            return $patient;
        }
        else {
            // echo "Patient Not found"
            return false;
        }
    }
  static public function find_patient_by_email($email){
    $queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME." ";
    $queryString .= "WHERE ".PatientTable::COLUMN_EMAIL." = ?";
    $stmt = Patient::$db->prepare($queryString);
    $stmt->execute([$email]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($patient)){
        return $patient;
    }
    else {
      // echo "Patient Not found"
      return false;
    }
  }
  static public function find_all_patients(){
   $queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME;
   $stmt = Patient::$db->prepare($queryString);
   $stmt->execute();
   $patients = [];
   // we want to return prescription objects
   while($patientAssoc = $stmt->fetch(PDO::FETCH_ASSOC)){
     $patients[]= new self($patientAssoc);
   }
   if(!empty($patients)){
     return $patients;
   }else{
     return false;
   }
  }

  public function updatePassword(){

    $errorsArray = $this->validatePasswordUpdateCredentials();
    if(isContainErrors($errorsArray))
    {
      return false;
    }else {

      $queryString  =  "UPDATE ".PatientTable::TABLE_NAME;
      $queryString .=  " SET ".PatientTable::COLUMN_HASHED_PASSWORD." = :".PatientTable::COLUMN_HASHED_PASSWORD." ";
      $queryString .=  " WHERE ".PatientTable::COLUMN_ID." = ".$this->getId()." ";

      try{
        $stmt = Patient::$db->prepare($queryString);
        $stmt->execute([
          PatientTable::COLUMN_HASHED_PASSWORD => $this->getHashedPassword()
        ]);
        return true;
      }catch(Exception $e){
        exit($e->getMessage());
      }

    }
  }

  public function resetPassword(){
    $errorsArray = $this->validateResetPasswordCredentials();
    // var_dump($errorsArray); exit;
    if(isContainErrors($errorsArray))
    {
      return false;
    }else {
      $queryString  =  "UPDATE ".PatientTable::TABLE_NAME;
      $queryString .=  " SET ".PatientTable::COLUMN_HASHED_PASSWORD." = :".PatientTable::COLUMN_HASHED_PASSWORD." ";
      $queryString .=  " WHERE ".PatientTable::COLUMN_ID." = ".$this->getId()." ";

      try{
        $stmt = Patient::$db->prepare($queryString);
        $stmt->execute([
          PatientTable::COLUMN_HASHED_PASSWORD => $this->getHashedPassword()
        ]);
        return true;
      }catch(Exception $e){
        exit($e->getMessage());
      }
    }
  }









  /******** Setters
  **************************/
  public function setId($id)
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
  public function setCurrentPassword($currentPassword='')
  {
    $this->currentPassword = $currentPassword;
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
  public function getCurrentPassword()
  {
    return $this->currentPassword ;
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

  public function getErrors(){
    return $this->errors;
  }



  /******* Helper Functions
  ************************************/
  public function onForgetPassword(){
      // valid forgetPasword credentials
      $this->errors = $this->validateForgetPassCredentials();
      // var_dump($this->errors); exit;
      if(isContainErrors($this->errors))
      {
        return false;
      }else {
        // all the information are passed,  and user is also existes
        // return ture.
        return true;
      }
  }


  private function validateForgetPassCredentials(){
      // invalidCredentials
       $errors = [];
       $forgetPatient = Patient::find_patient_by_username($this->getUserName());
       if($forgetPatient == false){
         $errors['invalidCredentials'] = "Invalid Credentials";
         return $errors;
       }else{
         if($forgetPatient->getPhoneNumber() == $this->getPhoneNumber() && $forgetPatient->getDOB() == $this->getDOB()){
               // patient exits, return empty errors
               // bind id, for passing to the reset password page
               $this->setId($forgetPatient->getId());
               return $errors =  [];
         }
         else {
           $errors['invalidCredentials'] = "Invalid Credentials";
           return $errors;
         }
       }
  }

/*
$queryString  = "SELECT * FROM ".PatientTable::TABLE_NAME." ";
$queryString .= "WHERE ".PatientTable::COLUMN_USERNAME." = ?";
$stmt = Patient::$db->prepare($queryString);
$stmt->execute([$username]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);
if(isset($patient)){
    return $patient;
}
else {
  // echo "Patient Not found"
  return false;
}
*/



  public function isUsernameAlreadyExists($userName){
    $patient = Patient::find_patient_by_username_assoc($userName);

    if($patient === false){
      // patient not exists
      return false;
    }
    else {
      return true;
    }
  }
  public function isEmailAlreadyExists($email){
    $patient = Patient::find_patient_by_email($email);

    if($patient === false){
      // patient not exists
      return false;
    }
    else {
      return true;
    }
  }



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
          $queryString  =  "INSERT INTO ".PatientTable::TABLE_NAME;
          $queryString .=  " (";
          $queryString .=  PatientTable::COLUMN_USERNAME.",";
          $queryString .=  PatientTable::COLUMN_NAME.",";
          $queryString .=  PatientTable::COLUMN_EMAIL.",";
          $queryString .=  PatientTable::COLUMN_GENDER.",";
          $queryString .=  PatientTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .=  PatientTable::COLUMN_PHONE.",";
          $queryString .=  PatientTable::COLUMN_ADDRESS.",";
          $queryString .=  PatientTable::COLUMN_CITY.",";
          $queryString .=  PatientTable::COLUMN_DATE_OF_BITRH;
          $queryString .=  " ) VALUES (";

          $queryString .=  ":".PatientTable::COLUMN_USERNAME.",";
          $queryString .=  ":".PatientTable::COLUMN_NAME.",";
          $queryString .=  ":".PatientTable::COLUMN_EMAIL.",";
          $queryString .=  ":".PatientTable::COLUMN_GENDER.",";
          $queryString .=  ":".PatientTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .=  ":".PatientTable::COLUMN_PHONE.",";
          $queryString .=  ":".PatientTable::COLUMN_ADDRESS.",";
          $queryString .=  ":".PatientTable::COLUMN_CITY.",";
          $queryString .=  ":".PatientTable::COLUMN_DATE_OF_BITRH.")";

          try{
            $stmt = Patient::$db->prepare($queryString);
            $stmt->execute([
              PatientTable::COLUMN_USERNAME => $this->getUserName(),
              PatientTable::COLUMN_NAME => $this->getName(),
              PatientTable::COLUMN_EMAIL => $this->getEmail(),
              PatientTable::COLUMN_GENDER => $this->getGender(),
              PatientTable::COLUMN_HASHED_PASSWORD => $this->getHashedPassword(),
              PatientTable::COLUMN_PHONE => $this->getPhoneNumber(),
              PatientTable::COLUMN_ADDRESS => $this->getAddress(),
              PatientTable::COLUMN_CITY => $this->getCity(),
              PatientTable::COLUMN_DATE_OF_BITRH => $this->getDOB()
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
          $errorsArray = $this->validateUpdation();
          if(isContainErrors($errorsArray))
          {
            return false;
          }else {
            // build query string & update the data.
            // exit("Now All the data is valid, it's time to Save Data to the database");
            //  UPDATE `patients` SET `id` = NULL, `username` = '', `hashedPassword` = '', `dob` = '' WHERE `patients`.`id` = 1
            $queryString  =  "UPDATE ".PatientTable::TABLE_NAME;
            $queryString .=  " SET ".PatientTable::COLUMN_NAME." = :".PatientTable::COLUMN_NAME.", ";
            $queryString .=  PatientTable::COLUMN_GENDER." = :".PatientTable::COLUMN_GENDER.", ";
            $queryString .=  PatientTable::COLUMN_PHONE." = :".PatientTable::COLUMN_PHONE.", ";
            $queryString .=  PatientTable::COLUMN_ADDRESS." = :".PatientTable::COLUMN_ADDRESS.", ";
            $queryString .=  PatientTable::COLUMN_CITY." = :".PatientTable::COLUMN_CITY." ";
            $queryString .=  " WHERE ".PatientTable::COLUMN_ID." = ".$this->getId()." ";

            try{
              $stmt = Patient::$db->prepare($queryString);
              $stmt->execute([
                PatientTable::COLUMN_NAME => $this->getName(),
                PatientTable::COLUMN_GENDER => $this->getGender(),
                PatientTable::COLUMN_PHONE => $this->getPhoneNumber(),
                PatientTable::COLUMN_ADDRESS => $this->getAddress(),
                PatientTable::COLUMN_CITY => $this->getCity()
              ]);
              return true;
            }catch(Exception $e){
              exit($e->getMessage());
            }

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
       $errors[PatientTable::COLUMN_USERNAME] = "Username already exist, try another";
     }


     if(!isValidEmailFormat($this->getEmail())){$errors[PatientTable::COLUMN_EMAIL]="Please enter a valid Email address";}
     elseif($this->isEmailAlreadyExists($this->getEmail())){$errors[PatientTable::COLUMN_EMAIL]="Email is already existed, use new or Login</a>";}






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

     $this->errors = $errors;
     return $errors;
   }

   private function validateUpdation(){
      $errors = [];

      if(!hasPresence($this->getName())){
        $errors[PatientTable::COLUMN_NAME]='Patient name can\'t be blank';
      }elseif (!has_length($this->getName(), array('min' => 2, 'max' => 30))) {
        $errors[PatientTable::COLUMN_NAME] = "Patient name must be between 2 and 30 characters.";
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

      $this->errors = $errors;
      return $errors;
    }
  public function login(){
     $errors = $this->validateLoginCredentials();
     if(!isContainErrors($errors))
     {
       // jb success full login ho jao to all pateirn informaiton ko fetch kr k patient ka object bana lo
       return true; // login successfull
     }
     else {
       $this->errors = $errors;
       return false;
     }
   }

  public function validateLoginCredentials(){
    $errors = [];
    if(!isValidEmailFormat($this->getEmail()))
    {
      $errors[PatientTable::COLUMN_EMAIL]="Please enter a valid Email address";
    }
    if(!hasPresence($this->getPassword())) {
      $errors['password'] = "Password cannot be blank.";
    }
    if(!isset($errors[PatientTable::COLUMN_EMAIL]) && !isset($errors['password']))
    {
      // check email & password
      if(!$this->isEmailAlreadyExists($this->getEmail()))
      {
        $errors['invalidCredantials'] = 'Email or Password is incorrect!';
      }else{
        // email exits, validate password
        $patient = Patient::find_patient_by_email($this->getEmail());
        if($patient)
        {
            $isSuccess = password_verify($this->getPassword(), $patient[PatientTable::COLUMN_HASHED_PASSWORD]);
            if(!$isSuccess){
                $errors['invalidCredantials'] = 'Email or Password is incorrect!';
            }else {
              // patient login successfull , bind patient data
              $this->bind_patient_data($patient);
            }
        }
      }
    }
    return $errors;
  }

  private function validateResetPasswordCredentials(){
        $errors = [];
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


        if(!isContainErrors($errors)){
          $encryptedPassword = password_hash($this->getPassword(),PASSWORD_BCRYPT);
          $this->setHashedPassword($encryptedPassword);
        }

        $this->errors = $errors;
        return $errors;

  }

  private function validatePasswordUpdateCredentials(){
    $errors = [];


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




    // now match current password, with password in database, if not match then output error
    // email exits, validate password
    $patient = Patient::find_patient_by_id($this->getId());
    if($patient)
    {
        $isSuccess = password_verify($this->getCurrentPassword(), $patient->getHashedPassword());
        if(!$isSuccess){
            $errors['currentPassword'] = 'Please enter the correct current password';
        }else{
          // encrypt the password & initailize to store inte database
          $encryptedPassword = password_hash($this->getPassword(),PASSWORD_BCRYPT);
          $this->setHashedPassword($encryptedPassword);
        }
    }
    if(!hasPresence($this->getCurrentPassword())) {
      $errors['currentPassword'] = "Current password cannot be blank.";
    }


    $this->errors = $errors;
    return $errors;
  }

}
?>
