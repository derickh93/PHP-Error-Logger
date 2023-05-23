# PHP-Error-Logger

PHP logger class called Logger that creates a log file each time the program is ran. 

## Usage

* This class creates a log file within the log subdirectory located in the root folder. The file name is the current timestamp formatted as 'Y-m-d Hi'. 
* The class also contains logic to check the amount of files in the log folder and deletes a file when necessary to keep it at a 30 file maximum.
* This class is instantiated once and then accessed in the rest of the application as a Global Variable.
*  To write to the log file the writeToLog function has to be used along with the message to be logged as the only parameter.

## Functions
constructor()
* The constructor first calls the method directoryFileCount to check that we have not reached the 30 file maxiumum. Then it pulls the current timestamp and uses that information to create a log file. To edit the name of the log file and the directory it is created in, make changes to the fopen function in the constructor, the directoryFileCount function, and the removeOldestFile function.

getDate()
* This function updates the date variable with the current timestamp.

writeToLog()
* This function writes to the current log file instantiated. First it updates the date variable and then it writes to the file by using the fwrite function. The message parameter and the current file variable is passed in to the fwrite function.

closeFile()
* This function closes the file stream. First the date variable is updated . Then it writes to the log file that the program is being terminated. Finally it closes the file with the fclose function.

directoryFileCount()
* This function counts the amount of files in the log directory. If the count is over 30 it removes the oldest file. To change the subdirectory name where the logs are stored change the directory variable. This must also be modified in the fopen function call in the constructor and in the files variable in the removeOldestFile function. To change the amount of log files stored change the max variable to the desired amount.

removeOldestFile()
* This function will remove the oldest file in the log directory. First we are declaring the directory of the log file. To change this directory we must change it in the files variable, also in the constructor, and the directory variable in the directoryFileCount function. Then we are sorting all the files in that directory in ascending order. Finally we are unlinking the file at index 0 which is the oldest file.
