<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan_user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is provided
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure it's an integer

    // Prepare the SQL statement
    $sql = "DELETE FROM loan_user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Listing deleted successfully.";
    } else {
        echo "Error deleting listing: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No ID provided.";
}

$conn->close();
?>
