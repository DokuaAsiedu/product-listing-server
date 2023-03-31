<?php
require "config.php";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
	$pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo "PDO not created!";
	echo $e->getMessage();
}
?>