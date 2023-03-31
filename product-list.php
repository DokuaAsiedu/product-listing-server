<?php
header('Access-Control-Allow-Origin: https://dokua-product-listing.herokuapp.com');

require "set-product-list.php";

echo json_encode($table);
?>