<?php




date_default_timezone_set('America/New_York');




class Logger {

  public $date;

  public $myfile;

  public $echoLog = false;

  function __construct($echoLog = false) {
    $this->echoLog = $echoLog;
    if (!file_exists('./logs/')) {
      mkdir('./logs/', 0777, true);
    }
    $this->date = date('Y-m-d_H-i-s');
    $this->myfile = fopen("./logs/" . $this->date . "_log.tsv", "w") or die("Unable to create log file!");
    $this->writeToLog("Program execution started");
    $this->directoryFileCount();

  }

  function getDate() {
    $this->date = date('Y-m-d H:i:s');
  }

  function writeToLog($message) {
    $this->getDate();
    fwrite($this->myfile, $this->date . "\t$message\n");
    if ($this->echoLog) {
      echo ($this->myfile . $this->date . "\t$message\n");
    }
    return $message;
  }

  function closeFile() {
    $this->getDate();
    $this->writeToLog("Program successfully terminated");
    fclose($this->myfile);
  }

  function directoryFileCount() {
    $directory = "./logs/";
    $filecount = 0;
    $max = 30;
    $files = glob($directory . "*");
    if ($files) {
      $filecount = count($files);
    }
    if ($filecount > $max) {
      $this->removeOldestFile();
    }
    return $filecount;
  }

  function removeOldestFile() {
    $files = glob('./logs/*.*');
    sort($files);

    if (!unlink($files[0])) {
      $this->writeToLog("$files[0] cannot be deleted due to an error");
    } else {
      $this->writeToLog("$files[0] has been deleted");
    }
  }
}