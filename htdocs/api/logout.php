<?php 

session_start();
session_destroy();
header('location:../authPages/login.html');