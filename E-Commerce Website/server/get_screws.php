<?php

include('connection.php');

$stmt = $conn ->prepare("SELECT * FROM products WHERE product_category ='Screws' LIMIT 4");
$stmt -> execute();

$screws_products = $stmt -> get_result();

