<?php

class Admin {
    public $id; //String
    public $username; //String
    public $name; //String
    public $email; //String
    public $gender; //String
    public $hashedPassword; //String
    public $created_on; //String
    private $password;
    private $confirmPassword;

    static private $db;
    private $errors;

    function __construct($args=[]){
      $this->setId($args[AdminTable::COLUMN_ID] ?? '');
      $this->setUserName($args[AdminTable::COLUMN_USERNAME] ?? '');
      $this->setName($args[AdminTable::COLUMN_NAME] ?? '');
      $this->setEmail($args[AdminTable::COLUMN_EMAIL] ?? '');
      $this->setGender($args[AdminTable::COLUMN_GENDER] ?? '');
      $this->setHashedPassword($args[AdminTable::COLUMN_HASHED_PASSWORD] ?? '');
      $this->setCreated_on($args[AdminTable::COLUMN_CREATED_ON] ?? '');
      $this->setPassword($args['password'] ?? '');
      $this->setConfirmPassword($args['confirmPassword'] ?? '');
    }
    function bind_admin_data($args=[]){
      $this->setId($args[AdminTable::COLUMN_ID] ?? '');
      $this->setUserName($args[AdminTable::COLUMN_USERNAME] ?? '');
      $this->setName($args[AdminTable::COLUMN_NAME] ?? '');
      $this->setEmail($args[AdminTable::COLUMN_EMAIL] ?? '');
      $this->setGender($args[AdminTable::COLUMN_GENDER] ?? '');
      $this->setHashedPassword($args[AdminTable::COLUMN_HASHED_PASSWORD] ?? '');
      $this->setCreated_on($args[AdminTable::COLUMN_CREATED_ON] ?? '');
      $this->setPassword($args['password'] ?? '');
      $this->setConfirmPassword($args['confirmPassword'] ?? '');
    }




/*** Database Related
*************************************/

      static public function setDatabase($pdo){
        if($pdo){
          Admin::$db = $pdo;
        }
        else{
          throw new \Exception("Please pass valid database in Admin ");
        }
      }



      public function save(){
        if(!hasPresence($this->getId()))
        {
          // exit("Yes id has no presence");
          return $this->create();
        }else {
          // update the data
          exit("update the Admin data");
        }
      }

      static public function find_admin_by_username($username){
        $queryString  = "SELECT * FROM ".AdminTable::TABLE_NAME." ";
        $queryString .= "WHERE ".AdminTable::COLUMN_USERNAME." = ?";
        $stmt = Admin::$db->prepare($queryString);
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($admin)){
            return $admin;
        }
        else {
          // echo "Patient Not found"
          return false;
        }
      }
      static public function find_admin_by_email($email){
        $queryString  = "SELECT * FROM ".AdminTable::TABLE_NAME." ";
        $queryString .= "WHERE ".AdminTable::COLUMN_EMAIL." = ?";
        $stmt = Admin::$db->prepare($queryString);
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($admin)){
            return $admin;
        }
        else {
          // echo "Patient Not found"
          return false;
        }
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
           $errors[AdminTable::COLUMN_EMAIL]="Please enter a valid Email address";
         }
         if(!hasPresence($this->getPassword())) {
           $errors['password'] = "Password cannot be blank.";
         }
         if(!isset($errors[AdminTable::COLUMN_EMAIL]) && !isset($errors['password']))
         {
           // check email & password
           if(!$this->isEmailAlreadyExists($this->getEmail()))
           {
             $errors['invalidCredantials'] = 'Email or Password is incorrect!';
           }else{
             // email exits, validate password
             $admin = Admin::find_admin_by_email($this->getEmail());
             if($admin)
             {
                 $isSuccess = password_verify($this->getPassword(), $admin[AdminTable::COLUMN_HASHED_PASSWORD]);
                 if(!$isSuccess){
                     $errors['invalidCredantials'] = 'Email or Password is incorrect!';
                 }else {
                   // patient login successfull , bind patient data
                   $this->bind_admin_data($admin);
                 }
             }
           }
         }
         return $errors;
       }







/******** Getters & Setters
*********************************/
    public function getId() {
         return $this->id;
    }
    public function setId($id) {
         $this->id = $id;
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

    public function getCreated_on() {
         return $this->created_on;
    }
    public function setCreated_on($created_on) {
         $this->created_on = $created_on;
    }
    private function getPassword(){
      return $this->password;
    }
    private function getConfirmedPassword()
    {
      return $this->confirmPassword;
    }
    public function setPassword($password='')
    {
      $this->password = $password;
    }
    public function setConfirmPassword($confirmPassword='')
    {
      $this->confirmPassword = $confirmPassword;
    }


/******* Helper Functions
************************************/

  public function getErrors(){
    return $this->errors;
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

          $queryString  =  "INSERT INTO ".AdminTable::TABLE_NAME;
          $queryString .=  " (";
          $queryString .= AdminTable::COLUMN_ID.",";
          $queryString .= AdminTable::COLUMN_USERNAME.",";
          $queryString .= AdminTable::COLUMN_NAME.",";
          $queryString .= AdminTable::COLUMN_EMAIL.",";
          $queryString .= AdminTable::COLUMN_GENDER.",";
          $queryString .= AdminTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .= AdminTable::COLUMN_CREATED_ON;
          $queryString .=  " ) VALUES (";
          $queryString .= ":".AdminTable::COLUMN_ID.",";
          $queryString .= ":".AdminTable::COLUMN_USERNAME.",";
          $queryString .= ":".AdminTable::COLUMN_NAME.",";
          $queryString .= ":".AdminTable::COLUMN_EMAIL.",";
          $queryString .= ":".AdminTable::COLUMN_GENDER.",";
          $queryString .= ":".AdminTable::COLUMN_HASHED_PASSWORD.",";
          $queryString .= ":".AdminTable::COLUMN_CREATED_ON.")";



          try{
            $stmt = Admin::$db->prepare($queryString);
            $stmt->execute([
              AdminTable::COLUMN_ID => $this->getId(),
              AdminTable::COLUMN_USERNAME => $this->getUserName(),
              AdminTable::COLUMN_NAME => $this->getName(),
              AdminTable::COLUMN_EMAIL => $this->getEmail(),
              AdminTable::COLUMN_GENDER => $this->getGender(),
              AdminTable::COLUMN_HASHED_PASSWORD => $this->getHashedPassword(),
              AdminTable::COLUMN_CREATED_ON => $this->getCreated_on()
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
       $errors[AdminTable::COLUMN_NAME]='Admin name can\'t be blank';
     }elseif (!has_length($this->getName(), array('min' => 2, 'max' => 30))) {
       $errors[AdminTable::COLUMN_NAME] = "Admin name must be between 2 and 30 characters.";
     }

     if(!hasPresence($this->getUserName())) {
       $errors[AdminTable::COLUMN_USERNAME] = "Username cannot be blank.";
     } elseif (!has_length($this->getUserName(), array('min' => 8, 'max' => 40))) {
       $errors[AdminTable::COLUMN_USERNAME] = "Username must be between 8 and 40 characters.";
     } elseif($this->isUsernameAlreadyExists($this->getUserName())){
       $errors[AdminTable::COLUMN_NAME] = "Username already exist, try another";
     }


     if(!isValidEmailFormat($this->getEmail())){$errors[AdminTable::COLUMN_EMAIL]="Please enter a valid Email address";}
     elseif($this->isEmailAlreadyExists($this->getEmail())){$errors[AdminTable::COLUMN_EMAIL]="Email is already existed, use new or Login</a>";}






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

     $this->errors = $errors;
     return $errors;
   }

   public function isUsernameAlreadyExists($userName){
     $admin = Admin::find_admin_by_username($userName);
     if($admin === false){
       // admin not exists
       return false;
     }
     else {
       return true;
     }
   }
   public function isEmailAlreadyExists($email){
     $admin = Admin::find_admin_by_email($email);

     if($admin === false){
       // patient not exists
       return false;
     }
     else {
       return true;
     }
   }
}
?>
