
<?php 

session_start();
$_SESSION['login_status'] = false;

include_once '../connection.php';

// Sanitize and validate input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

// Prepare the SQL query
$qury = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($qury);

if ($stmt === false) {
    echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dbrow = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $dbrow['password'])) {
        echo "<h1>Login success</h1>";
        
        $_SESSION['login_status'] = true;
        $_SESSION['usertype'] = $dbrow['usertype'];
        $_SESSION['username'] = $dbrow['username'];

        // Redirect based on user type
        if ($dbrow['usertype'] == 'vendor') {
            header('Location: ../vendor/home.php');
            exit;
        } else if ($dbrow['usertype'] == 'customer') {
            header('Location: ../customer/home.php');
            exit;
        }
    } else {
        echo '<h1>Login Failed: Incorrect password</h1>';
    }
} else {
    echo '<h1>Login Failed: User not found</h1>';
}

$stmt->close();
$conn->close();
?>
