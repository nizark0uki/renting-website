<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan_user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the last 3 listings
$sql = "SELECT * FROM loan_user ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $type = htmlspecialchars($row['type']);
        $governorat = htmlspecialchars($row['governorat']);
        $image = !empty($row['image']) ? 'annonces/images/' . htmlspecialchars($row['image']) : 'annonces/images/home.png';
        $prix = htmlspecialchars($row['prix']);
        $name = htmlspecialchars($row['name']);
        $phone = htmlspecialchars($row['tel']);
        $id = htmlspecialchars($row['id']);

        $type_text = substr($type, 0, -3);
        $type_suffix = substr($type, -3);

        echo '<div class="annonce" data-id="' . $id . '">';
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
        echo '                <p><b>Nom de propriétaire:</b> ' . $name . '</p>';
        echo '                <p><b>Numéro de propriétaire:</b> ' . $phone . '</p>';
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
    echo "<p>Aucune annonce trouvée.</p>";
}

$conn->close();
?>
