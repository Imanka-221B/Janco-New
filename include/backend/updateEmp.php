<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employee = null;

// Fetch employee details for the given ID
if (isset($_GET['EmpID'])) {
    $empID = $_GET['EmpID'];
    $sql = "SELECT * FROM employees WHERE EmpID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empID);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();
}

// Update employee details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empID = $_POST['EmpID'];
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $position = $_POST['position'];

    $updateSQL = "UPDATE employees SET Name = ?, PhoneNumber = ?, Position = ? WHERE EmpID = ?";
    $stmt = $conn->prepare($updateSQL);
    $stmt->bind_param("sssi", $name, $phoneNumber, $position, $empID);

    if ($stmt->execute()) {
        header("Location:../Employee.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;  /* Adjusted max-width for responsiveness */
            margin: 20px auto;
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #154734;
            text-align: center;
        }
        .btn-update {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            width: 100%;
        }
        .btn-update:hover {
            background-color: #218838;
        }

        /* Media queries for responsiveness */
        @media (max-width: 576px) {
            .form-container {
                max-width: 90%;
                padding: 15px;
            }
            .form-title {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .form-container {
                max-width: 80%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Update Employee</h2>
            <?php if ($employee): ?>
                <form method="POST">
                    <input type="hidden" name="EmpID" value="<?php echo $employee['EmpID']; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($employee['Name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($employee['PhoneNumber']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($employee['Position']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-update">Update</button>
                </form>
            <?php else: ?>
                <p class="text-danger">Employee not found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
