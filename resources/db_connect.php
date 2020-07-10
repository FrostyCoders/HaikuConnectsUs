<?php
	try
	{
		$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	catch(PDOException $e)
	{
		$_SESSION["login_error"] = "Critical error, try later!";
		header("Location: ../../index.php");
		exit();
	}
?>