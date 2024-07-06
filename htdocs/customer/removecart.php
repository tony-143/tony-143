<?php 
include_once '../connection.php';
print($_GET['cartid']);

$qury="delete from cart where cartid=$_GET[cartid]";

$status=mysqli_query($conn,$qury);
if($status)
header("location:../customer/viewcart.php");
else{
    echo "there was was an error occured by technicol issue please try again";
}