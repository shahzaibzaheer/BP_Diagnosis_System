<?php

class Prescription
{
  public const STATUS_NOT_ANSWERED = 'NOT Answered';
  public const STATUS_ANSWERED = 'Answered';
  public const STATUS_CANCELED = 'Canceled';

  private $otherInfo; //String
  private $exerciseDetail; //String
  private $foodDetail; //String
  private $medication; //String
  private $visualChanges; //String
  private $dizziness; //boolean
  private $headache; //boolean
  private $bpHigh; //int
  private $bpLow; //int
  private $subject; //String
  private $status; //String
  private $patientId; //int
  private $doctorId; //int
  private $prescriptionId; //int
  private $createdOn; //timestamp


  static private $db;
  private $errors;



  /***** Database Related
  **************************************/
  static public function setDatabase($pdo){
    if($pdo){
      Prescription::$db = $pdo;
    }
    else{
      throw new \Exception("Please pass valid database in Patient ");
    }
  }
  public function save(){
    if(!hasPresence($this->getPrescriptionId()))
    {
      // exit("Yes id has no presence, so create the record");
      return $this->create();
    }else {
      // update the data
      exit("update the Patient data");
    }
  }


  static public function findPrescriptionsByPatientId($patientId){
    $queryString  = "SELECT * FROM ".PrescriptionTable::TABLE_NAME." ";
    $queryString .= "WHERE ".PrescriptionTable::COLUMN_PATIENT_ID." = ?";
    $stmt = Prescription::$db->prepare($queryString);
    $stmt->execute([$patientId]);
    // return the array of prescriptions object not associative arrays.
    $prescriptions = [];
    while($prescriptionAssoc = $stmt->fetch(PDO::FETCH_ASSOC)){
      $prescriptionObj = new self($prescriptionAssoc);
      $prescriptions[] = $prescriptionObj;
    }
    if(!empty($prescriptions)){
      return $prescriptions;
    }else{
      return false;
    }
  }
  static public function findPrescriptionById($id){
    $queryString  = "SELECT * FROM ".PrescriptionTable::TABLE_NAME." ";
    $queryString .= "WHERE ".PrescriptionTable::COLUMN_PRESCRIPTION_ID." = ?";
    $stmt = Prescription::$db->prepare($queryString);
    $stmt->execute([$id]);
    $prescription = $stmt->fetch(PDO::FETCH_ASSOC);
    if($prescription){
      // return patient object, not associative array
      return new Prescription($prescription);
    }
    else {
      // echo "Patient Not found";
      return false;
    }
  }










    function __construct($args){
        $this->setPrescriptionId($args[PrescriptionTable::COLUMN_PRESCRIPTION_ID] ?? '');
        $this->setDoctorId($args[PrescriptionTable::COLUMN_DOCTOR_ID] ?? '');
        $this->setPatientId($args[PrescriptionTable::COLUMN_PATIENT_ID] ?? '');
        $this->setStatus($args[PrescriptionTable::COLUMN_STATUS] ?? Prescription::STATUS_NOT_ANSWERED);
        $this->setSubject($args[PrescriptionTable::COLUMN_SUBJECT] ?? '');
        $this->setBpLow($args[PrescriptionTable::COLUMN_BP_LOW] ?? '');
        $this->setBpHigh($args[PrescriptionTable::COLUMN_BP_HIGH] ?? '');
        $this->setHeadache($args[PrescriptionTable::COLUMN_HEADACHE] ?? false);
        $this->setDizziness($args[PrescriptionTable::COLUMN_DIZZINESS] ?? false);
        $this->setVisualChanges($args[PrescriptionTable::COLUMN_VISUAL_CHANGES] ?? '');
        $this->setMedication($args[PrescriptionTable::COLUMN_MEDICATION] ?? '');
        $this->setFoodDetail($args[PrescriptionTable::COLUMN_FOOD_DETAIL] ?? '');
        $this->setExerciseDetail($args[PrescriptionTable::COLUMN_EXERCISE_DETAIL] ?? '');
        $this->setOtherInfo($args[PrescriptionTable::COLUMN_OTHER_INFO] ?? '');
        $this->setCreatedOn($args[PrescriptionTable::COLUMN_CREATED_ON] ?? '');
    }



    public function getPrescriptionId() {
         return $this->prescriptionId;
    }
    public function setPrescriptionId($prescriptionId) {
         $this->prescriptionId = $prescriptionId;
    }


    public function getDoctorId() {
         return $this->doctorId;
    }
    public function setDoctorId($doctorId) {
         $this->doctorId = $doctorId;
    }


    public function getPatientId() {
         return $this->patientId;
    }
    public function setPatientId($patientId) {
         $this->patientId = $patientId;
    }


    public function getStatus() {
         return $this->status;
    }
    public function setStatus($status) {
         $this->status = $status;
    }

    public function getSubject() {
         return $this->subject;
    }
    public function setSubject($subject) {
         $this->subject = $subject;
    }


    public function getBpLow() {
         return $this->bpLow;
    }
    public function setBpLow($bpLow) {
         $this->bpLow = $bpLow;
    }


    public function getBpHigh() {
         return $this->bpHigh;
    }
    public function setBpHigh($bpHigh) {
         $this->bpHigh = $bpHigh;
    }


    public function getHeadache() {
         return $this->headache ;
    }
    public function setHeadache($headache) {
         $this->headache = $headache;
    }


    public function getDizziness() {
         return $this->dizziness ;
    }
    public function setDizziness($dizziness) {
         $this->dizziness = $dizziness;
    }


    public function getVisualChanges() {
         return $this->visualChanges;
    }
    public function setVisualChanges($visualChanges) {
         $this->visualChanges = $visualChanges;
    }


    public function getMedication() {
         return $this->medication;
    }
    public function setMedication($medication) {
         $this->medication = $medication;
    }


    public function getFoodDetail() {
         return $this->foodDetail;
    }
    public function setFoodDetail($foodDetail) {
         $this->foodDetail = $foodDetail;
    }


    public function getExerciseDetail() {
         return $this->exerciseDetail;
    }
    public function setExerciseDetail($exerciseDetail) {
         $this->exerciseDetail = $exerciseDetail;
    }


    public function getOtherInfo() {
         return $this->otherInfo;
    }
    public function setOtherInfo($otherInfo) {
         $this->otherInfo = $otherInfo;
    }
    public function getCreatedOn() {
         return $this->createdOn;
    }
    public function setCreatedOn($createdOn) {
         $this->createdOn = $createdOn;
    }
    public function getErrors(){
      return $this->errors;
    }


/*****  Helper functions
*******************************/
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
        $queryString  =  "INSERT INTO ".PrescriptionTable::TABLE_NAME;
        $queryString .=  " (";
        $queryString .=  PrescriptionTable::COLUMN_PATIENT_ID.",";
        $queryString .=  PrescriptionTable::COLUMN_STATUS.",";
        $queryString .=  PrescriptionTable::COLUMN_SUBJECT.",";
        $queryString .=  PrescriptionTable::COLUMN_BP_LOW.",";
        $queryString .=  PrescriptionTable::COLUMN_BP_HIGH.",";
        $queryString .=  PrescriptionTable::COLUMN_HEADACHE.",";
        $queryString .=  PrescriptionTable::COLUMN_DIZZINESS.",";
        $queryString .=  PrescriptionTable::COLUMN_VISUAL_CHANGES.",";
        $queryString .=  PrescriptionTable::COLUMN_FOOD_DETAIL.",";
        $queryString .=  PrescriptionTable::COLUMN_EXERCISE_DETAIL.",";
        $queryString .=  PrescriptionTable::COLUMN_OTHER_INFO.",";
        $queryString .=  PrescriptionTable::COLUMN_MEDICATION;
        $queryString .=  " ) VALUES (";

          $queryString .= ":".PrescriptionTable::COLUMN_PATIENT_ID.",";
          $queryString .= ":".PrescriptionTable::COLUMN_STATUS.",";
          $queryString .= ":".PrescriptionTable::COLUMN_SUBJECT.",";
          $queryString .= ":".PrescriptionTable::COLUMN_BP_LOW.",";
          $queryString .= ":".PrescriptionTable::COLUMN_BP_HIGH.",";
          $queryString .= ":".PrescriptionTable::COLUMN_HEADACHE.",";
          $queryString .= ":".PrescriptionTable::COLUMN_DIZZINESS.",";
          $queryString .= ":".PrescriptionTable::COLUMN_VISUAL_CHANGES.",";
          $queryString .= ":".PrescriptionTable::COLUMN_FOOD_DETAIL.",";
          $queryString .= ":".PrescriptionTable::COLUMN_EXERCISE_DETAIL.",";
          $queryString .= ":".PrescriptionTable::COLUMN_OTHER_INFO.",";
          $queryString .= ":".PrescriptionTable::COLUMN_MEDICATION.")";

        try{
          $stmt = Prescription::$db->prepare($queryString);
          $stmt->execute([
            PrescriptionTable::COLUMN_PATIENT_ID => $this->getPatientId() ,
            PrescriptionTable::COLUMN_STATUS => $this->getStatus(),
            PrescriptionTable::COLUMN_SUBJECT => $this->getSubject(),
            PrescriptionTable::COLUMN_BP_LOW => $this->getBpLow(),
            PrescriptionTable::COLUMN_BP_HIGH => $this->getBpHigh(),
            PrescriptionTable::COLUMN_HEADACHE => $this->getHeadache(),
            PrescriptionTable::COLUMN_DIZZINESS => $this->getDizziness(),
            PrescriptionTable::COLUMN_VISUAL_CHANGES => $this->getVisualChanges(),
            PrescriptionTable::COLUMN_FOOD_DETAIL => $this->getFoodDetail(),
            PrescriptionTable::COLUMN_EXERCISE_DETAIL => $this->getExerciseDetail(),
            PrescriptionTable::COLUMN_OTHER_INFO => $this->getOtherInfo(),
            PrescriptionTable::COLUMN_MEDICATION => $this->getMedication()
          ]);
          return true;
        }catch(Exception $e){
          exit($e->getMessage());
        }
      }

  }


  private function validate(){
   $errors = [];

   if(!hasPresence($this->getSubject())){
     $errors[PrescriptionTable::COLUMN_SUBJECT]='Subject can\'t be blank';
   }
   if(!hasPresence($this->getBpLow())){
     $errors[PrescriptionTable::COLUMN_BP_LOW]='BP Low can\'t be blank';
   }
   if(!hasPresence($this->getBpHigh())){
     $errors[PrescriptionTable::COLUMN_BP_HIGH]='BP High can\'t be blank';
   }
   if(!hasPresence($this->getMedication())){
     $errors[PrescriptionTable::COLUMN_MEDICATION]='Medication can\'t be blank';
   }
   if(!hasPresence($this->getFoodDetail())){
     $errors[PrescriptionTable::COLUMN_FOOD_DETAIL]='Food Detail can\'t be blank';
   }
   if(!hasPresence($this->getExerciseDetail())){
     $errors[PrescriptionTable::COLUMN_EXERCISE_DETAIL]='Exercise Detail can\'t be blank';
   }



   $this->errors = $errors;
   return $errors;
  }





}


















?>
