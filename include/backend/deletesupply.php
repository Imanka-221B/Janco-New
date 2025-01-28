<?php
require_once '../../config/config.php';

if (isset($_POST['deletesupply'])) {
    if (isset($_POST['supplier_Id']) && !empty($_POST['supplier_Id'])) {
        $deleteId = $_POST['supplier_Id'];

        $stmt = $conn->prepare("DELETE FROM supplier_details WHERE supplier_Id = ?");
        $stmt->bind_param("i", $deleteId);

        if ($stmt->execute()) {
            header("Location: ../supply.php");
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: supplier_Id is missing.";
    }
} else {
    echo "Error: Invalid request.";
}

$conn->close();
?>
