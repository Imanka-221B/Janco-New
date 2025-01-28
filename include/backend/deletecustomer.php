<?php
require_once '../../config/config.php';

if (isset($_POST['deletecustomer'])) {
    if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {
        $deleteId = $_POST['customer_id'];

        $stmt = $conn->prepare("DELETE FROM customer_details WHERE customer_id = ?");
        $stmt->bind_param("i", $deleteId);

        if ($stmt->execute()) {
            header("Location: ../customer_details.php");
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
