
<?php 
session_start();
include_once '../connection.php';

if (!isset($_SESSION['username']) || !isset($_GET['pid'])) {
    echo 'Invalid request.';
    exit;
}

$username = $_SESSION['username'];
$product_id = (int)$_GET['pid']; // Cast to integer to ensure it's a valid number

// Print the username and product ID for debugging purposes
print($username);
print($product_id);

// Prepare the SQL statement to prevent SQL injection
$sql = "INSERT INTO cart (username, productid) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters to the SQL query
    $stmt->bind_param("si", $username, $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: ../customer/viewcart.php');
        exit; // Ensure the script stops after redirection
    } else {
        echo 'Sorry, there was an error. Please try again.';
        // Log the error for debugging
        error_log('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Close the statement
    $stmt->close();
} else {
    echo 'Sorry, there was an error preparing the statement.';
    // Log the error for debugging
    error_log('Prepare failed: ' . htmlspecialchars($conn->error));
}

// Close the connection
$conn->close();
?>

