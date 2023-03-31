<?php
class Product {
	public $product_type, $product_sku, $product_name, $product_price;

	public $dvd_size;
	public $book_weight;
	public $furniture_height, $furniture_width, $furniture_length;
	public $measurement;

	function setMainDetails($product_type, $product_sku, $product_name, $product_price) {
		$this->product_type = $product_type;
		$this->product_sku = $product_sku;
		$this->product_name = $product_name;
		$this->product_price = $product_price;
	}

	function addProduct($db , $sub_table, $type_values) {
		$placeholder = [];
		for ($i = 0; $i < count($type_values); $i++) {
			array_push($placeholder, '?');
		}
		$placeholder = join(",", $placeholder);

		$db->prepare("INSERT INTO main_info VALUES (?,?,?,?)")->execute([$this->product_type, $this->product_sku, $this->product_name, $this->product_price]);

		$db->prepare("INSERT INTO {$sub_table}_details VALUES (?,{$placeholder})")->execute([$this->product_sku, ...$type_values]);
	}

	function deleteProduct($db, $sub_table, $sku) {
		$db->prepare("DELETE FROM {$sub_table}_details WHERE product_sku = '$sku'")->execute();
		$db->prepare("DELETE FROM main_info WHERE product_sku = '$sku'")->execute();
	}
}

class DVD extends Product {
	public $dvd_size;

	function __construct() {
		$this->measurement = "Size: $this->dvd_size MB";
	}

	function setMeasurements($arr) {
		[$this->dvd_size] = $arr;
	}
}

class Book extends Product {
	public $book_weight;

	function __construct() {
		$this->measurement = "Weight: {$this->book_weight}KG";
	}

	function setMeasurements($arr) {
		[$this->book_weight] = $arr;
	}
}

class Furniture extends Product {
	public $furniture_height, $furniture_width, $furniture_length;

	function __construct() {
		$this->measurement = "Dimensions: {$this->furniture_height}x{$this->furniture_width}x{$this->furniture_length}";
	}

	function setMeasurements($arr) {
		[$this->furniture_height, $this->furniture_width, $this->furniture_length] = $arr;
	}
}

?>