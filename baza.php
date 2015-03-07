<?php
// Pobrane z http://www.plus2net.com/php_tutorial/pdo-connection.php
	$host_name = "localhost";
	$database = "kinzerski"; // Change your database name
	$username = "kinzerski"; // Your database user id 
	$password = "kinzerski"; // Your password

	//////// Do not Edit below /////////
	try {
		$baza = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>