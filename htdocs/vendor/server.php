<?php

session_start();
include_once '../connection.php';


$source = $_FILES['image']['tmp_name'];
$target = "../shared/images/" . $_FILES['image']['name'];
$file_name=$_FILES['image']['name'];
$uploaded=move_uploaded_file($source, $target);


if ($uploaded) {
    
    $qury = "Insert into products(username, productName, price, img, discription) values('$_SESSION[username]','$_POST[productName]' , '$_POST[price]', '$file_name', '$_POST[description]')";

    print($qury);

    $status = mysqli_query($conn, $qury);

    print($status);
    if ($status) {
        header('location:../vendor/home.php');
    }else{
        echo '  product not uploaded ';
    }
} else {
    echo 'sorry there was an error uploading your product';
}
