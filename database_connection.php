<?php


	$dbhost = 'localhost';
   $dbuser = 'root';
	$db = 'service';
   try {
	   $conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser,'');
	  //$conn=mysqli_connect($dbhost,$dbuser,'pakfresh_dbteamtest','P@kFresh@2016');
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //createConnection();
    $_SESSION["databaseConnection"] = $conn;
	
	
    }
	catch(PDOException $e)
    {
		die('Could not connect: ' . mysql_error());
	
	
	}
	 
?>