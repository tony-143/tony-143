<?php
include_once "../connection.php";

session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
$password = $_POST['password'];
$conformPassword = $_POST['conformPassword'];

$qury = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($qury);

if ($stmt === false) {
    echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    header('Location: ../authPages/register.html?message=User already exists');
    exit;
}
$stmt->close();

if ($password === $conformPassword) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $qury = "INSERT INTO users (username, usertype, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($qury);

    if ($stmt === false) {
        echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("sss", $username, $usertype, $hashed_password);
    $status = $stmt->execute();

    if ($status) {
        header('Location: ../authPages/login.html');
        exit;
    } else {
        echo json_encode(["error" => "Error executing query: " . $stmt->error]);
    }

    $stmt->close();
} else {
    header('Location: ../authPages/register.html?message=Passwords do not match');
    exit;
}

$conn->close();
?>
