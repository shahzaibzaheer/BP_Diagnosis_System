<?php

class UploadFile
{

  protected $destinationFolder;
  protected $errorMessages = [];
  protected $maxSize = 1000 * 1024;  // 100 * 1024 = 102,400 == 100 kb
  protected $permittedTypes = array(
    'image/jpeg',
    'image/pjpeg',
    'image/gif',
    'image/png',
    'image/webp',
  );
  protected $newValidFileName;
  protected $fileTypeChecking = true;
  protected $notTrusted = array('bin','cgi','exe','js','py','php','sh');
  protected $suffix = '.upload';



  function __construct($destinationFolder){
    // validate destination folder
    if(!is_dir($destinationFolder) && !is_writable($destinationFolder))
    {
      throw new \Exception($destinationFolder." must be a valid, writable folder");
    }

    if($destinationFolder[strlen($destinationFolder)-1] != '/')
    {
      $destinationFolder .= '/';
    }

    $this->destinationFolder = $destinationFolder;
  }




  /****** Getter functions
  ***********************************/
  public function getErrorMessages()
  {
    return $this->errorMessages;
  }







  /****** Setter functions
  ***********************************/
  public function setMaxSize($sizeInBytes){
    // exit("Max server size: ".$this->getServerMaxUploadFileSize());
    if($sizeInBytes > $this->getServerMaxUploadFileSize())
    {
      throw new \Exception("Maximum size cannot exceeds the server limit for individual files.");
    }
    if($sizeInBytes <= 0){
      throw new \Exception("Set a valid maximum size.");
    }
    $this->maxSize = $sizeInBytes;
  }
  public function allowCheckingFileTypes($fileTypeChecking){
    $this->fileTypeChecking = $fileTypeChecking;
  }






  public function upload(){
    // $_FILES is a  super global array
    $file = current($_FILES);

    if(is_array($file['name'])){
      // handle multiple files upload
      foreach ($file['name'] as $key => $value) {
        $currentFile['name']  = $file['name'][$key];
        $currentFile['tmp_name']  = $file['tmp_name'][$key];
        $currentFile['type']  = $file['type'][$key];
        $currentFile['size']  = $file['size'][$key];
        $currentFile['error']  = $file['error'][$key];

        if($this->isValid($currentFile)){
          $this->moveFile($currentFile);
        }
      }
    }else {
      // exit("Single file is uploaded");
      if($this->isValid($file))
      {
        $this->moveFile($file);
        return true;
      }
      return false;
    }
  }

  protected function moveFile($file){
    $success = move_uploaded_file($file['tmp_name'],$this->destinationFolder.$this->newValidFileName);
    if(!$success){
      throw new \Exception($this->newValidFileName." failed to move to destination folder.");
    }
  }




  /******** validation functions
  *****************************************/

  protected function isValid($file){

      // checking file validation
      $this->validateFileName($file);
      if($this->haveError($file)) {
        return false;
      }

      if($this->fileTypeChecking === true){ // if file type checking is turned ON then check file type
        if(!$this->isValidFileType($file)){
          return false;
        }
      }

      if(!$this->isValidFileSize($file)){
        return false;
      }
      return true;
    }

  protected function haveError($file){
    switch($file['error'])
    {
      case 0:
        return false;

      case 1:
      case 2:
        $this->errorMessages[] = $file['name']. ' is toooo big';
        return true;

      case 3:
        $this->errorMessages[] = $file['name']. ' was only partially uploaded';
        return true;

      case 4:
        $this->errorMessages[] = $file['name']. ' No file submitted';
        return true;

      default:
        $this->errorMessages[] = 'Sorry, there was a problem while uploaded file';
        return true;
    }

  }

  protected function isValidFileSize($file)  {
    // echo "File size: ". $file['size'] ."\nMax size: ".$this->maxSize;
    if($file['size'] > $this->maxSize){
      $this->errorMessages[] = $file['name']." is too big, it exceeeds the maximum file size";
      return false;
    }
    return true;
  }

  protected function isValidFileType($file){
    if(in_array($file['type'],$this->permittedTypes)){
      return true;
    }else {
      $this->errorMessages[] = $file['name']. " is not permitted type of file.";
      return false;
    }
  }

  protected function validateFileName($file){
    // this function will validate the file name and save new valid name in a variable for later saving the file
    $this->newValidFileName = null;
    $uploadedFileName = $file['name'];
    $this->newValidFileName = str_replace(' ','_',$uploadedFileName);

    // neutralizing dangerous not trusted files
    $path_parts = pathinfo($this->newValidFileName);
    if(in_array($path_parts['extension'],$this->notTrusted)){
      $this->newValidFileName .= $this->suffix;
    }


    // checking dublicate file name
    $existingFiles = scandir($this->destinationFolder);
    if(in_array($this->newValidFileName,$existingFiles)) { // if name already exists
      // append number before name, we can also generate name
      $newName = '';
      $i = 1;
      do{
          $newName = $i."_".$this->newValidFileName;
          $i++;
      }while (in_array($newName,$existingFiles));
      $this->newValidFileName = $newName;
    }
  }













  /****** Helper functions
  **********************************/
  public function getUploadedFileName(){
    if(isset($this->newValidFileName)){
      return $this->newValidFileName;
    }else {
      return null;
    }
  }

  private function getServerMaxUploadFileSize() //return size in bytes
  {
      $serverMaxString = ini_get('upload_max_filesize'); // it will return size as 2M, 2g, 2k ....
      $serverMaxString = trim($serverMaxString);
      $last = strtolower($serverMaxString[strlen($serverMaxString)-1]);

      $serverMaxInNumber = substr($serverMaxString,0,strlen($serverMaxString)-1);
      // exit("Server max string: ".$serverMaxString . "\nServer String to int: ".$serverMaxInNumber);

      if (in_array($last, array('g', 'm', 'k'))){
          switch ($last) {
              case 'g':
                  $serverMaxInNumber *= 1024;
              case 'm':
                  $serverMaxInNumber *= 1024;
              case 'k':
                  $serverMaxInNumber *= 1024;
          }
      }
      return $serverMaxInNumber;

  }


  private static function convertToBytes($val)
  {
    // we will convert size into bytes from value that server will return as 2M, or 2K or 2g.
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    if (in_array($last, array('g', 'm', 'k'))){
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
    }
    return $val;
  }

}
 ?>
