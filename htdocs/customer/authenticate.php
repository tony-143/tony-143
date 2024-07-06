
<?php 

session_start();
if(!isset($_SESSION['login_status'])){
    echo "please login";
    header('location:../authPages/login.html');
    die;
}

if($_SESSION['login_status']==false){
    echo 'Unautherised Attempt 403';
    die;
}

if($_SESSION['usertype']!='customer'){
    echo "forbidden access! 403";
    die;
}

?>