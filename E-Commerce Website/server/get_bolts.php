<?php

include('connection.php');

$stmt = $conn ->prepare("SELECT * FROM products WHERE product_category ='Bolts' LIMIT 4");
$stmt -> execute();

$bolts_products = $stmt -> get_result();

