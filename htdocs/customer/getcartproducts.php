
<?php
include_once '../customer/authenticate.php';
include '../connection.php';

// Ensure session is started and username is available
if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "You need to log in first."]);
    exit;
}

$username = $_SESSION['username'];

// Prepare the SQL query with placeholders for parameters
$qury = "SELECT * FROM cart 
         JOIN products ON cart.productid = products.productid 
         WHERE cart.username = ?";

// Prepare the statement
$stmt = $conn->prepare($qury);

if ($stmt === false) {
    // Output the error if statement preparation failed
    echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    exit;
}

// Bind the session username parameter to the query
$stmt->bind_param("s", $username);

// Execute the statement
if ($stmt->execute()) {
    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch all rows as an associative array
        $dbrows = $result->fetch_all(MYSQLI_ASSOC);

        // Prepare the products array
        $products = array();

        foreach ($dbrows as $row) {
            $products[] = $row;
        }

        // Output the products array as JSON
        echo json_encode($products);
    } else {
        echo json_encode(["message" => "No products found in the cart."]);
    }

    // Free the result
    $result->free();
} else {
    echo json_encode(["error" => "Error executing query: " . $stmt->error]);
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
