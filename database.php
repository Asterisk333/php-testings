<?php
include "./controller/auth.php";

$login = readauth();

// Create connection
$conn = new mysqli('localhost', $login['kessis']['name'], $login['kessis']['pword'], $login['kessis']['database']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>