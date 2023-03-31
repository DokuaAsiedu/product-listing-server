<?php
header('Access-Control-Allow-Origin: https://dokua-product-listing.herokuapp.com');

if (isset($_POST) && count($_POST) === 1) {
	$sku = $_POST[0];
	require "database-connection.php";
	$existence = $pdo->prepare("SELECT * FROM main_info WHERE product_sku = ?");
	$existence->execute([$sku]);
	echo $existence->fetchColumn() ? true : false;
}

?>