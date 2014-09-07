<?php
	/*
		@author Yan Matheus
		@email  yansmts@gmail.com
	*/

	/*MySQL*/
	$USR = "root"; //Database user
	$PWD = ""; //Database password
	$DBS = "database" //Database
	$SVR = "localhost"; //Database IP
	$conn = mysql_connect($SVR, $USR, $PWD);
	mysql_select_db($DBS);

	function($RFID_CODE)
	{
		$query = "SELECT RFIDCODE WHERE RFIDCODE = " .$RFID_CODE;
		$return = mysql_query($query);
		if(mysql_num_rows($return) > 0)
			return fwrite($cp, "Ok");
		else
			return fwrite($cp, "No");
	}

	/*Arduino serial*/
	$com = "COM6"; //COM port of your Arduino

	$cp = fopen($com, "w+"); //Connect on port
	sleep(2);
	$received = fgets($port);
	if(strpos($received, "RFID=") !== false) //Get RFID
		fwrite($cp, SearchRFID(str_replace("RFID=", "", $received)))  //Search on MySQL database (return "Ok" or "No")
	else if($received == "Bye, PHP!") //Close connection
		fclose($cp);
?>