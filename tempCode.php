// exit("Now All the data is valid, it's time to Save Data to the database");
$queryString  =  "INSERT INTO ".UserTable::TABLE_NAME;
$queryString .=  " (".UserTable::COLUMN_FIRST_NAME.",";
$queryString .=  UserTable::COLUMN_LAST_NAME.",";
$queryString .=  UserTable::COLUMN_USERNAME.",";
$queryString .=  UserTable::COLUMN_EMAIL.",";
$queryString .=  UserTable::COLUMN_HASHED_PASSWORD.",";
$queryString .=  UserTable::COLUMN_PHONE.",";
$queryString .=  UserTable::COLUMN_ADDRESS.",";
$queryString .=  UserTable::COLUMN_VERIFYING_STRING.") VALUES (";

$queryString .=  $this->escapeString($this->getFirstName()).",";
$queryString .=  $this->escapeString($this->getLastName()).",";
$queryString .=  $this->escapeString($this->getUserName()).",";
$queryString .=  $this->escapeString($this->getEmail()).",";
$queryString .=  $this->escapeString($this->getHashedPassword()).",";
$queryString .=  $this->escapeString($this->getPhoneNumber()).",";
$queryString .=  $this->escapeString($this->getAddress()).",";
$queryString .=  $this->escapeString($this->getVerifyingString()).")";

$result = User::$db->query($queryString);
if($result)
{
  return true; // user successfully created
}
else {
  $errorMessage = "Database Insertion failed, Error: ".User::$db->error.", Error number: ".User::$db->errno;
  exit($errorMessage."\n Insertion Query : ".$queryString);
}
