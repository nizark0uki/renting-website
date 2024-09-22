<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = $conn->real_escape_string($_POST['name']);
    $type = $conn->real_escape_string($_POST['type']); // Ensure form input name="type"
    $phone = $conn->real_escape_string($_POST['phone']);
    $prix = $conn->real_escape_string($_POST['prix']); // Ensure form input name="prix"
    $governorate = $conn->real_escape_string($_POST['option']);

    // Handle image upload (check if image exists)
    $image = '';
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $image = $conn->real_escape_string($_FILES['img']['name']);
        $upload_dir = "uploads/"; // Directory to save images
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }
        move_uploaded_file($_FILES['img']['tmp_name'], $upload_dir . $image);
    }

    // Debug: Echo the values to check if they are correct
    echo "Type: $type<br>";
    echo "Prix: $prix<br>";
    echo "Image: $image<br>";

    // Insert data into the database
    $sql = "INSERT INTO loan_user(`name`, `type`, `prix`, `tel`, `governorat`, `image`) 
            VALUES ('$nom', '$type', '$prix', '$phone', '$governorate', '$image')";

    // Check if insertion is successful
    if ($conn->query($sql) === TRUE) {
        header("Location: /nizar_project/annonces/annonces.html?name=$nom&phone=$phone&governorate=$governorate");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
