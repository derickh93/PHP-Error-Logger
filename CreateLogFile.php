<?php

date_default_timezone_set('America/New_York');

class CreateLogFile {
	public $date;
	public $myfile;
	function __construct() {
		$this->directoryFileCount();

		$this->date = date('Y-m-d Hi');
		$this->myfile = fopen("./logs/".$this->date."_log.txt", "w") or die("Unable to create log file!");
		$this->writeToLog("Program execution started");
	}
	
	function getDate(){
		$this->date = date('Y-m-d H:i:s');
	}

	function writeToLog($message){
		$this->getDate();
		fwrite($this->myfile,$this->date."\t\t$message\n");
		return $message;
	}
	
	function closeFile(){
		$this->getDate();
		$this->writeToLog("Program successfully terminated");
		fclose($this->myfile);
	}

	function directoryFileCount(){
		$directory = "./logs/";
		$filecount = 0;
		$max = 20;
		$files = glob($directory . "*");
		if ($files){
			$filecount = count($files);
		}
		//echo "There were $filecount files";

		if($filecount == $max) {
			$this->removeOldestFile();
		}
		return $filecount;
	}

	function removeOldestFile(){
		$files = glob( './logs/*.*' );
		array_multisort(array_map( 'filemtime', $files),SORT_NUMERIC,SORT_ASC,$files);
		if (!unlink($files[0])) { 
			echo ("$files[0] cannot be deleted due to an error"); 
		} 
		else { 
			echo ("$files[0] has been deleted"); 
		} 
	}
}
?>