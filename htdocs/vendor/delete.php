<?php 
include_once '../connection.php';

    print($_GET['pid']);

    $status=mysqli_query($conn,"delete from products where productid = $_GET[pid]");

    if($status){
        echo json_encode(["message"=>"successfully"]);
        header('location:../vendor/home.php');
    }
    else{
        echo json_encode(["error"=>"error product not deleted"]);
    }

