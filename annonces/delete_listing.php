<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan_user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);  // Get ID from the POST request
    $email = $conn->real_escape_string($_POST['email']);  // Get the email from the POST request and prevent SQL injection

    // Verify the email associated with the listing before deletion
    $verifySql = "SELECT email FROM loan_user WHERE id = $id";
    $result = $conn->query($verifySql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['email'] === $email) {
            // If the email matches, proceed with deletion
            $deleteSql = "DELETE FROM loan_user WHERE id = $id";
            if ($conn->query($deleteSql) === TRUE) {
                echo "Listing deleted successfully";
            } else {
                echo "Error deleting listing: " . $conn->error;
            }
        } else {
            echo "Error: Incorrect email for listing ID $id";
        }
    } else {
        echo "No listing found with ID $id";
    }
}

$conn->close();
?>
