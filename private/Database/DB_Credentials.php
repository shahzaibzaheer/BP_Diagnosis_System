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
  class AdminTable{
    public const   TABLE_NAME = "admins";
    public const   COLUMN_ID = "id";
    public const   COLUMN_USERNAME = "username";
    public const   COLUMN_NAME = "name";
    public const   COLUMN_EMAIL = "email";
    public const   COLUMN_GENDER = "gender"; // 1 male , 0 female
    public const   COLUMN_HASHED_PASSWORD = "hashedPassword";
    public const   COLUMN_CREATED_ON = "created_on";
  }
  class DoctorTable{
    public const   TABLE_NAME = "doctors";
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
    public const   COLUMN_ABOUT = "about";
    public const   COLUMN_SPECIALIZATION = "specialization";
    public const   COLUMN_QUALIFICATION = "qualification";
    public const   COLUMN_FEES = "fees";
    public const   COLUMN_CREATED_ON = "created_on";
  }
  class PrescriptionTable{
    public const   TABLE_NAME = "prescription_table";
    public const   COLUMN_PRESCRIPTION_ID = "prescription_id";
    public const   COLUMN_DOCTOR_ID = "doctor_id";
    public const   COLUMN_PATIENT_ID = "patient_id";
    public const   COLUMN_STATUS = "status";
    public const   COLUMN_SUBJECT = "subject"; // 1 male , 0 female
    public const   COLUMN_BP_LOW = "bp_low";
    public const   COLUMN_BP_HIGH = "bp_high";
    public const   COLUMN_HEADACHE = "headache";
    public const   COLUMN_DIZZINESS = "dizziness";
    public const   COLUMN_VISUAL_CHANGES = "visual_changes";
    public const   COLUMN_MEDICATION = "medication";
    public const   COLUMN_FOOD_DETAIL = "food_detail";
    public const   COLUMN_EXERCISE_DETAIL = "exercise_detail";
    public const   COLUMN_OTHER_INFO = "other_info";
    public const   COLUMN_CREATED_ON = "created_on";
  }
  class ReplayTable{
    public const  TABLE_NAME = "replies";
    public const COLUMN_PRESCRIPTION_ID ="prescription_id";
    public const COLUMN_IS_DOCTOR_REPLAY ="is_doctor_reply";
    public const COLUMN_REPLAY_MESSAGE ="replay_message";
    public const COLUMN_TIMESTAMP ="timestamp";
  }
  class AppointmentTable{
    public const  TABLE_NAME = "appointments";
    public const COLUMN_APPOINTMENT_ID ="id";
    public const COLUMN_PATIENT_PROBLEM ="patient_problem";
    public const COLUMN_PATIENT_ID ="patient_id";
    public const COLUMN_DOCTOR_ID ="doctor_id";
    public const COLUMN_APPOINTMENT_DATE ="date";
    public const COLUMN_APPOINTMENT_TIME ="time";
    public const COLUMN_STATUS ="status";
    public const COLUMN_CREATED_ON ="created_on";
  }
  class ReviewTable{
    public const  TABLE_NAME = "reviews";
    public const COLUMN_ID ="id";
    public const COLUMN_RATING ="rating";
    public const COLUMN_PATIENT_ID ="patient_id";
    public const COLUMN_DOCTOR_ID ="doctor_id";
    public const COLUMN_SUBJECT ="subject";
    public const COLUMN_MESSAGE ="message";
    public const COLUMN_CREATED_ON ="created_on";

    public const COLUMN_TOTAL_RATINGS ="total_ratings";
    public const COLUMN_SUM_OF_RATINGS ="sum_of_ratings";
  }
?>
