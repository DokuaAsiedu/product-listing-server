<?php
header('Access-Control-Allow-Origin: https://dokua-product-listing.herokuapp.com');

require "database-connection.php";
require "initializations.php";

function cleanInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

if (isset($_POST)) {
	$productType = cleanInput($_POST["productType"]);
	$productSKU = cleanInput($_POST["productSKU"]);
	$productName = cleanInput($_POST["productName"]);
	$productPrice = cleanInput($_POST["productPrice"]);

	$type = new $_POST["productType"];
	$measurements = [];
	foreach ($_POST["measurements"] as $val) {
		array_push($measurements, $val);
	}
	$type->setMainDetails($productType, $productSKU, $productName,$productPrice);
	$type->setMeasurements($measurements);
	$type->addProduct($pdo, $productType, $measurements);
}
else { 
	echo "is not set";
}
?>