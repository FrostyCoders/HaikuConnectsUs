<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "haiku";
try
{
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$_SESSION["login_warning"] = "Critical error, try later!";
	header("Location: ../index.php");
	exit();
}