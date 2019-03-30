
<?php

/**
 *
 */
class Appointment
{
  private const STATUS_NOT_CONFIRMED_BY_DOCTOR = 'NOT CONFIRMED BY DOCTOR';
  private const STATUS_CONFIRMED_BY_DOCTOR = 'CONFIRMED BY DOCTOR';
  private const STATUS_NOT_CONFIRMED_BY_PATIENT = 'NOT CONFIRMED BY PATIENT';
  private const STATUS_CONFIRMED_BY_PATIENT = 'CONFIRMED BY PATIENT';
  private const STATUS_CANCEL_BY_DOCTOR = 'CANCELED_BY_DOCTOR';
  private const STATUS_CANCEL_BY_PATIENT = 'CANCELED_BY_PATIENT';

    private $id; //String
    private $patient_problem; //String
    private $patient_id; //String
    private $doctor_id; //String
    private $date; //String
    private $time; //String
    private $status; //String
    private $created_on; //String

    private $patient; // initialize, when patient id collected
    private $doctor; // initialize, when doctor id collected
    static private $db;
    private $errors;




  /***** Database Related
 **************************************/
   static public function setDatabase($pdo){
   if($pdo){
     Appointment::$db = $pdo;
   }
   else{
     throw new \Exception("Please pass valid database in Appointment table ");
   }
 }
   public function save(){
     if(!hasPresence($this->getId()))
     {
       // exit("Yes id has no presence, so create the record");
       return $this->create();
     }else {
       // update the data
       // exit("update the Patient data");
       return $this->update();
     }
   }

   static public function find_all_appointments(){
    $queryString  = "SELECT * FROM ".AppointmentTable::TABLE_NAME;
    $stmt = Appointment::$db->prepare($queryString);
    $stmt->execute();
    $appointments = [];
    // we want to return prescription objects
    while($appointmentAssoc = $stmt->fetch(PDO::FETCH_ASSOC)){
      $appointments[]= new self($appointmentAssoc);
    }
    if(!empty($appointments)){
      return $appointments;
    }else{
      return false;
    }
   }

   static public function findAppointmentById($id){
    $queryString  = "SELECT * FROM ".AppointmentTable::TABLE_NAME." ";
    $queryString .= "WHERE ".AppointmentTable::COLUMN_APPOINTMENT_ID." = ?";
    $stmt = Appointment::$db->prepare($queryString);
    $stmt->execute([$id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    if($appointment){
      // return apointment object, not associative array
      return new Appointment($appointment);
    }
    else {
      // echo "Patient Not found";
      return false;
    }
   }
   static public function findAppointmentByPatientId($patientId){
    $queryString  = "SELECT * FROM ".AppointmentTable::TABLE_NAME." ";
    $queryString .= "WHERE ".AppointmentTable::COLUMN_PATIENT_ID." = ?";
    $stmt = Appointment::$db->prepare($queryString);
    $stmt->execute([$patientId]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    if($appointment){
      // return apointment object, not associative array
      return new Appointment($appointment);
    }
    else {
      // echo "Patient Not found";
      return false;
    }
   }
   static public function findAppointmentByDoctorId($doctorId){
   $queryString  = "SELECT * FROM ".AppointmentTable::TABLE_NAME." ";
   $queryString .= "WHERE ".AppointmentTable::COLUMN_DOCTOR_ID." = ?";
   $stmt = Appointment::$db->prepare($queryString);
   $stmt->execute([$doctorId]);
   $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
   if($appointment){
     // return apointment object, not associative array
     return new Appointment($appointment);
   }
   else {
     // echo "Patient Not found";
     return false;
   }
   }


   public function getPatient(){
     return $this->patient;
   }
   public function getPatientName(){
     return $this->patient->getName();
   }
   public function getPatientEmail(){
     return $this->patient->getEmail();
   }
   public function getDoctor(){
     return $this->doctor;
   }
   public function getDoctorName(){
     if(!$this->doctor){
       return "No Doctor Linked with the post";
     }
     return $this->doctor->getName();
   }



  function __construct($args)
  {
      $this->setId($args[AppointmentTable::COLUMN_APPOINTMENT_ID] ?? '');
      $this->setPatient_problem($args[AppointmentTable::COLUMN_PATIENT_PROBLEM] ?? '');
      $this->setPatient_id($args[AppointmentTable::COLUMN_PATIENT_ID] ?? '');
      $this->setDoctor_id($args[AppointmentTable::COLUMN_DOCTOR_ID] ?? '');
      $this->setDate($args[AppointmentTable::COLUMN_APPOINTMENT_DATE] ?? '');
      $this->setTime($args[AppointmentTable::COLUMN_APPOINTMENT_TIME] ?? '');
      $this->setStatus($args[AppointmentTable::COLUMN_STATUS] ??  Appointment::STATUS_NOT_CONFIRMED_BY_DOCTOR);
      $this->setCreated_on($args[AppointmentTable::COLUMN_CREATED_ON] ?? '');
  }











  /******** Getters  & Setters
  **********************************/
  public function getId() {
        return $this->id ;
   }
   public function setId($id) {
        $this->id = $id ;
   }

   public function getPatient_problem() {
        return $this->patient_problem ;
   }
   public function setPatient_problem($patient_problem) {
        $this->patient_problem = $patient_problem ;
   }

   public function getPatient_id() {
        return $this->patient_id ;
   }
   public function setPatient_id($patient_id) {
        $this->patient_id = $patient_id ;
        $this->patient = Patient::find_patient_by_id($patient_id);
   }

   public function getDoctor_id() {
        return $this->doctor_id ;
   }
   public function setDoctor_id($doctor_id) {
        $this->doctor_id = $doctor_id ;
        $this->doctor = Doctor::find_doctor_by_id($doctor_id);
         // if(!$this->doctor){ exit("doctor not linked");}
   }

   public function getDate() {
        return $this->date ;
   }
   public function setDate($date) {
        $this->date = $date ;
   }

   public function getTime() {
        return $this->time ;
   }
   public function setTime($time) {
        $this->time = $time ;
   }

   public function getStatus() {
        return $this->status ;
   }
   public function setStatus($status) {
        $this->status = $status ;
   }

   public function getCreated_on() {
        return $this->created_on ;
   }
   public function setCreated_on($created_on) {
        $this->created_on = $created_on ;
   }

    public function getErrors(){
      return $this->errors;
    }






/*****  Helper functions
*******************************/
  private function create(){
    // if want, perform validation here
    // after validatio build query string & save data.
        $queryString  =  "INSERT INTO ".AppointmentTables::TABLE_NAME;
        $queryString .=  " (";
        $queryString .=  AppointmentTable::COLUMN_APPOINTMENT_ID.",";
        $queryString .=  AppointmentTable::COLUMN_PATIENT_PROBLEM.",";
        $queryString .=  AppointmentTable::COLUMN_PATIENT_ID.",";
        $queryString .=  AppointmentTable::COLUMN_DOCTOR_ID.",";
        $queryString .=  AppointmentTable::COLUMN_APPOINTMENT_DATE.",";
        $queryString .=  AppointmentTable::COLUMN_APPOINTMENT_TIME.",";
        $queryString .=  AppointmentTable::COLUMN_STATUS.",";
        $queryString .=  AppointmentTable::COLUMN_CREATED_ON;
        $queryString .=  " ) VALUES (";

        $queryString .= ":".AppointmentTable::COLUMN_APPOINTMENT_ID.",";
        $queryString .= ":".AppointmentTable::COLUMN_PATIENT_PROBLEM.",";
        $queryString .= ":".AppointmentTable::COLUMN_PATIENT_ID.",";
        $queryString .= ":".AppointmentTable::COLUMN_DOCTOR_ID.",";
        $queryString .= ":".AppointmentTable::COLUMN_APPOINTMENT_DATE.",";
        $queryString .= ":".AppointmentTable::COLUMN_APPOINTMENT_TIME.",";
        $queryString .= ":".AppointmentTable::COLUMN_STATUS.",";
        $queryString .= ":".AppointmentTable::COLUMN_CREATED_ON.")";

        try{
          $stmt = Appointment::$db->prepare($queryString);
          $stmt->execute([
            AppointmentTable::COLUMN_APPOINTMENT_ID => $this->getId() ,
            AppointmentTable::COLUMN_PATIENT_PROBLEM => $this->getPatient_problem(),
            AppointmentTable::COLUMN_PATIENT_ID => $this->getPatient_id(),
            AppointmentTable::COLUMN_DOCTOR_ID => $this->getDoctor_id(),
            AppointmentTable::COLUMN_APPOINTMENT_DATE => $this->getDate(),
            AppointmentTable::COLUMN_APPOINTMENT_TIME => $this->getTime(),
            AppointmentTable::COLUMN_STATUS => $this->getStatus(),
            AppointmentTable::COLUMN_CREATED_ON => $this->getCreated_on()
          ]);
          return true;
        }catch(Exception $e){
          exit($e->getMessage());
        }
      }
  private function update(){
    // exit("update the data")
    // first validate the data, if validation successfull then save data and return true

    // build query string & save data.
    // UPDATE table_name SET column1 = value1, column2 = value2,... WHERE condition;

        $queryString  =  "UPDATE ".AppointmentTable::TABLE_NAME." SET ";
        // $queryString .= AppointmentTable::COLUMN_PATIENT_PROBLEM ." = :".AppointmentTable::COLUMN_PATIENT_PROBLEM.",";
        // $queryString .= AppointmentTable::COLUMN_PATIENT_ID ." = :".AppointmentTable::COLUMN_PATIENT_ID.",";
        // $queryString .= AppointmentTable::COLUMN_DOCTOR_ID ." = :".AppointmentTable::COLUMN_DOCTOR_ID.",";
        $queryString .= AppointmentTable::COLUMN_APPOINTMENT_DATE ." = :".AppointmentTable::COLUMN_APPOINTMENT_DATE.",";
        $queryString .= AppointmentTable::COLUMN_APPOINTMENT_TIME ." = :".AppointmentTable::COLUMN_APPOINTMENT_TIME.",";
        $queryString .= AppointmentTable::COLUMN_STATUS ." = :".AppointmentTable::COLUMN_STATUS." ";
        // $queryString .= AppointmentTable::COLUMN_CREATED_ON ." = :".AppointmentTable::COLUMN_CREATED_ON." ";

        $queryString .= " WHERE ".AppointmentTable::COLUMN_APPOINTMENT_ID." = ".$this->getId();
        // exit($queryString);

        try{
          $stmt = Appointment::$db->prepare($queryString);
          $stmt->execute([
            AppointmentTable::COLUMN_APPOINTMENT_DATE => $this->getDate(),
            AppointmentTable::COLUMN_APPOINTMENT_TIME => $this->getTime(),
            AppointmentTable::COLUMN_STATUS => $this->getStatus()
          ]);
          return true;
        }catch(Exception $e){
          exit($e->getMessage());
        }
     }


}


 ?>
