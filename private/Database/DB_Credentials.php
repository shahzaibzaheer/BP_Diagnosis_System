<?php
  define('DB_SERVER','localhost');
  define('DB_USER','root');
  define('DB_PASS','');
  define('DB_NAME','BP_Diagnosis_System');

  function dbConnect(){
    try{
        $dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME;
        $pdo = new PDO($dsn,DB_USER,DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    }catch(Exception $e){
      // echo $e->getMessage();
      return false;
    }
  }

  class PatientTable{
    public const   TABLE_NAME = "patients";
    public const   COLUMN_ID = "id";
    public const   COLUMN_USERNAME = "username";
    public const   COLUMN_NAME = "name";
    public const   COLUMN_EMAIL = "email";
    public const   COLUMN_GENDER = "gender"; // 1 male , 0 female
    public const   COLUMN_HASHED_PASSWORD = "hashedPassword";
    public const   COLUMN_PHONE = "phone";
    public const   COLUMN_ADDRESS = "address";
    public const   COLUMN_CITY = "city";
    public const   COLUMN_DATE_OF_BITRH = "dob";
    public const   COLUMN_CREATED_ON = "created_on";
  }

?>
