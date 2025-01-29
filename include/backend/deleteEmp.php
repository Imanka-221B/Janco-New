<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['EmpID'])) {
    $empID = $_GET['EmpID'];
    $deleteSQL = "DELETE FROM employees WHERE EmpID = ?";
    $stmt = $conn->prepare($deleteSQL);
    $stmt->bind_param("i", $empID);

    if ($stmt->execute()) {
        header("Location:../Employee.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
