<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan_user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default query to fetch all listings
$sql = "SELECT * FROM loan_user WHERE 1=1";

// Apply filters if set
if (!empty($_GET['options'])) {
    $governorat = $conn->real_escape_string($_GET['options']);
    $sql .= " AND governorat = '$governorat'";
}

if (!empty($_GET['type'])) {
    $type = $conn->real_escape_string($_GET['type']);
    $sql .= " AND type LIKE '%$type%'"; 
}

if (!empty($_GET['budget'])) {
    $budget = (int) $_GET['budget'];
    $sql .= " AND prix <= $budget";
}

// Order by 'id' descending (newest listings first)
$sql .= " ORDER BY id DESC";
$result = $conn->query($sql);

// Output listings
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $type = htmlspecialchars($row['type']);
        $governorat = htmlspecialchars($row['governorat']);
        $image = 'images/' . htmlspecialchars($row['image']);
        $prix = htmlspecialchars($row['prix']);
        $name = htmlspecialchars($row['name']); 
        $phone = htmlspecialchars($row['tel']); 
        $id = htmlspecialchars($row['id']);

        
        $type_text = substr($type, 0, -3); 
        $type_suffix = substr($type, -3); 

        echo '<div class="annonce">';
        echo '    <div class="content">';
        echo '        <div class="image">';
        echo '            <img src="' . $image . '" alt="Image">';
        echo '        </div>';
        echo '        <div class="info">';
        echo '            <div class="titre">';
        echo '                <div>';
        echo '                    <h3>' . $type_text . '</h3>';
        echo '                    <p>' . $type_suffix . '</p>';
        echo '                </div>';
        echo '                <i class="fa-solid fa-trash delete-btn" data-id="' . $id . '"></i>'; 
        echo '            </div>';
        echo '            <div class="description">';
        echo '                <p>Nom de propriétaire: ' . $name . '</p>';
        echo '                <p>Numéro de propriétaire: ' . $phone . '</p>';
        echo '            </div>';
        echo '            <div class="prix">' . $prix . 'dt/mois</div>';
        echo '        </div>';
        echo '    </div>';
        echo '    <div class="footer">';
        echo '        <div class="location">';
        echo '            <i class="fa-solid fa-location-dot"></i>';
        echo '            ' . $governorat;
        echo '        </div>';
        echo '        <button onclick="return false;" class="louer">Louer</button>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "<p>No listings found.</p>";
}

$conn->close();
?>
