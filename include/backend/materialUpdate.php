<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Material Stock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3 class="text-center mb-4">Update Material Stock</h3>
        <?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure material_id is provided in the URL
$id = $_GET['material_id'] ?? null;
if (!$id) {
    // Redirect to a different page or show an error message
    die("Error: Material ID is missing.");
}

$material = '';
$supplier = '';
$construction_area = '';
$quantity = '';
$unit = '';
$received_date = '';

// Retrieve the material details if material_id exists
$sql = "SELECT * FROM materials WHERE material_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $material = $row['material_name'];
    $supplier = $row['supplier'];
    $construction_area = $row['construction_area'];
    $quantity = $row['quantity'];
    $unit = $row['unit'];
    $received_date = $row['received_date'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $material = $_POST['material'];
    $supplier = $_POST['supplier'];
    $construction_area = $_POST['construction_area'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $received_date = $_POST['received_date'];

    // Use prepared statements to avoid SQL injection
    $update_sql = $conn->prepare("UPDATE materials SET 
        material_name = ?, 
        supplier = ?, 
        construction_area = ?, 
        quantity = ?, 
        unit = ?, 
        received_date = ? 
        WHERE material_id = ?");
    
    $update_sql->bind_param("sssssss", $material, $supplier, $construction_area, $quantity, $unit, $received_date, $id);
    
    if ($update_sql->execute()) {
        header("Location: ../material.php");
        exit(); // Ensure the script stops after redirection
    } else {
        echo "<div class='alert alert-danger'>Error updating material: " . $conn->error . "</div>";
    }
}
?>

        <!-- Form with method POST -->
        <form id="materialForm" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="material" class="form-label">Select a Material</label>
                <select name="material" id="material" class="form-select">
                    <option value="Cements" <?php echo $material === 'Cements' ? 'selected' : ''; ?>>Cements</option>
                    <option value="Sands" <?php echo $material === 'Sands' ? 'selected' : ''; ?>>Sands</option>
                    <option value="Concrete Stones" <?php echo $material === 'Concrete Stones' ? 'selected' : ''; ?>>Concrete Stones</option>
                    <option value="Concrete Wire" <?php echo $material === 'Concrete Wire' ? 'selected' : ''; ?>>Concrete Wire</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Select a Supplier</label>
                <select name="supplier" id="supplier" class="form-select">
                    <option value="Sadaruwan Hardware & Suppliers" <?php echo $supplier === 'Sadaruwan Hardware & Suppliers' ? 'selected' : ''; ?>>Sadaruwan Hardware & Suppliers</option>
                    <option value="Amila Constructions" <?php echo $supplier === 'Amila Constructions' ? 'selected' : ''; ?>>Amila Constructions</option>
                    <option value="Maliban Supplies" <?php echo $supplier === 'Maliban Supplies' ? 'selected' : ''; ?>>Maliban Supplies</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="constructionArea" class="form-label">Select the Construction Area</label>
                <select name="construction_area" id="constructionArea" class="form-select">
                    <option value="Rajagiriya Project" <?php echo $construction_area === 'Rajagiriya Project' ? 'selected' : ''; ?>>Rajagiriya Project</option>
                    <option value="Colombo Project" <?php echo $construction_area === 'Colombo Project' ? 'selected' : ''; ?>>Colombo Project</option>
                    <option value="Kandy Project" <?php echo $construction_area === 'Kandy Project' ? 'selected' : ''; ?>>Kandy Project</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <div class="input-group">
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity" value="<?php echo $quantity; ?>">
                    <select name="unit" id="unit" class="form-select">
                        <option value="Pack" <?php echo $unit === 'Pack' ? 'selected' : ''; ?>>Pack</option>
                        <option value="Kg" <?php echo $unit === 'Kg' ? 'selected' : ''; ?>>Kg</option>
                        <option value="Ton" <?php echo $unit === 'Ton' ? 'selected' : ''; ?>>Ton</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="receivedDate" class="form-label">Received Date</label>
                <input type="date" name="received_date" id="receivedDate" class="form-control" value="<?php echo $received_date; ?>">
            </div>
            <button type="submit" class="btn btn-success w-100">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
