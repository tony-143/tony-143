<?php

include_once '../customer/authenticate.php';

include '../connection.php';

$qury = "select * from products";

$qury_result = mysqli_query($conn, $qury);
$dbrows = mysqli_fetch_all($qury_result, 1);


$products = array();

foreach($dbrows as $row){
    $products[]=$row;
}


echo json_encode($products);
