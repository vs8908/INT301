<?php
function CreateConnection()
 {
	 $connect = new mysqli("localhost", "root", "", "php-registration-validation") 
	 or 
	 die("Connection failed: %s\n". $connect -> error);
	 
	 return $connect;
 }
 
?>