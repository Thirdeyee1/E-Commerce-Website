<?php

include('connection.php');

$stmt = $conn ->prepare("SELECT * FROM products WHERE product_category ='Nuts' LIMIT 4");
$stmt -> execute();

$nuts_products = $stmt -> get_result();

