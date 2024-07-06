<?php

include '../vendor/authentication.php';
include_once '../connection.php';

// Ensure the session is started
session_start();

// Validate and sanitize input
$price = (int)$_POST['price'];
$description = mysqli_real_escape_string($conn, $_POST['discription']);
$productid = (int)$_POST['productid'];

// Prepare the SQL query with placeholders for parameters
$qury = "UPDATE products SET price = ?, discription = ? WHERE productid = ?";

// Prepare the statement
$stmt = $conn->prepare($qury);

if ($stmt === false) {
    // Output the error if statement preparation failed
    echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    exit;
}

// Bind the parameters to the query
$stmt->bind_param("isi", $price, $description, $productid);

// Execute the statement
if ($stmt->execute()) {
    // Ensure no output before header redirection
    ob_start();
    echo json_encode(["message" => "successfully"]);
    header('Location: ../vendor/home.php');
    ob_end_flush();
    exit;
} else {
    echo json_encode(["error" => "Error executing query: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
