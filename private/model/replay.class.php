<?php

class Replay{
  private $prescriptionId;
  private $isDoctorReplay;  // false means , patient replay
  private $replayMessage;
  private $createdOn;

  static private $db;


  /***** Database Related
  ********************************/
  static public function setDatabase($pdo){
    if($pdo){
      Replay::$db = $pdo;
    }
    else{
      throw new \Exception("Please pass valid database in Replay class ");
    }
  }

  public function save(){
    $queryString  =  "INSERT INTO ".ReplayTable::TABLE_NAME;
    $queryString .=  " (";
    $queryString .=  ReplayTable::COLUMN_PRESCRIPTION_ID.",";
    $queryString .=  ReplayTable::COLUMN_REPLAY_MESSAGE.",";
    $queryString .=  ReplayTable::COLUMN_TIMESTAMP.",";
    $queryString .=  ReplayTable::COLUMN_IS_DOCTOR_REPLAY;
    $queryString .=  " ) VALUES (";
    $queryString .=  ":".ReplayTable::COLUMN_PRESCRIPTION_ID.",";
    $queryString .=  ":".ReplayTable::COLUMN_REPLAY_MESSAGE.",";
    $queryString .=  ":".ReplayTable::COLUMN_TIMESTAMP.",";
    $queryString .=  ":".ReplayTable::COLUMN_IS_DOCTOR_REPLAY.")";
    try{
      $stmt = Replay::$db->prepare($queryString);
      $stmt->execute([
        ReplayTable::COLUMN_PRESCRIPTION_ID  => $this->getPrescriptionId(),
        ReplayTable::COLUMN_REPLAY_MESSAGE  => $this->getReplayMessage(),
        ReplayTable::COLUMN_TIMESTAMP  => $this->getCreatedOn(),
        ReplayTable::COLUMN_IS_DOCTOR_REPLAY  => $this->isDoctorReplay()
      ]);
      return true;
    }catch(Exception $e){
      exit($e->getMessage());
    }
  }

  public static function find_replies_by_prescription_id($prescriptionId){
    // $queryString =   "SELECT * FROM `replies` WHERE `prescription_id` = '12'";
    $queryString =   "SELECT * FROM ".ReplayTable::TABLE_NAME." WHERE `prescription_id` = ?";

    // $queryString  = "SELECT * FROM ".ReplayTable::TABLE_NAME." WHERE ";
    // $queryString  = ReplayTable::COLUMN_PRESCRIPTION_ID." = ?";
    $stmt = Replay::$db->prepare($queryString);
    $stmt->execute([$prescriptionId]);
    $replies = [];
    // we want to return prescription objects
    while($repliesAssoc = $stmt->fetch(PDO::FETCH_ASSOC)){
      $replies[]  = new self($repliesAssoc);
    }
    if(!empty($replies)){
      return $replies;
    }else{
      return false;
    }
  }













  function __construct($args = []){
      $this->setPrescriptionId($args[ReplayTable::COLUMN_PRESCRIPTION_ID] ?? '');
      $this->setDoctorReplay($args[ReplayTable::COLUMN_IS_DOCTOR_REPLAY] ?? '');
      $this->setReplayMessage($args[ReplayTable::COLUMN_REPLAY_MESSAGE] ?? '');
      $this->setCreatedOn($args[ReplayTable::COLUMN_TIMESTAMP] ?? '');
  }

  public function getPrescriptionId(){
    return $this->prescriptionId;
  }
  public function setPrescriptionId($prescriptionId){
    $this->prescriptionId = $prescriptionId;
  }
  public function isDoctorReplay(){
    return $this->isDoctorReplay;
  }
  public function setDoctorReplay($isDoctorReplay){
    $this->isDoctorReplay = $isDoctorReplay;
  }
  public function getReplayMessage(){
    return $this->replayMessage;
  }
  public function setReplayMessage($replayMessage){
    $this->replayMessage = $replayMessage;
  }
  public function getCreatedOn(){
    return $this->createdOn;
  }
  public function setCreatedOn($createdOn){
    $this->createdOn = $createdOn;
  }

}


?>
