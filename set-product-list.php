<?php
require "database-connection.php";
require_once("initializations.php");

$table = $pdo->query("SELECT * FROM combined_data")->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_CLASSTYPE);

foreach ($table as $row) {
	$row->product_type = strtolower(get_class($row));
	unset($row->dvd_size);
	unset($row->book_weight);
	unset($row->furniture_height);
	unset($row->furniture_width);
	unset($row->furniture_length);
}

?>