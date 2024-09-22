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
    $id = intval($_POST['id']); // Get the listing ID from the POST request

    // Delete the listing from the database 
    $sql = "DELETE FROM loan_user WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Listing deleted successfully";
    } else {
        echo "Error deleting listing: " . $conn->error;
    }
}

$conn->close();
?>
