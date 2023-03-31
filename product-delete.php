<?php
header('Access-Control-Allow-Origin: https://dokua-product-listing.herokuapp.com');

require "set-product-list.php";

if (isset($_POST)) {
	foreach ($_POST as $key => $value) {
		$type = new $value;
		$type->deleteProduct($pdo, $value, $key);
	}
}

require "product-list.php";
?>