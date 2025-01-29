<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['material_id'])) {
    $id = $_GET['material_id'];
    $sql = "DELETE FROM materials WHERE material_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: ../material.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided!";
}

$conn->close();
?>
