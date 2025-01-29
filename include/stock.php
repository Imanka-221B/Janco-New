<?php
$host = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "janco"; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $material_name = $_POST['material'];
    $supplier = $_POST['supplier'];
    $construction_area = $_POST['construction_area'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $received_date = $_POST['received_date'];

    // Insert data into the materials table
    $sql = "INSERT INTO materials (material_name, supplier, construction_area, quantity, unit, received_date) 
            VALUES ('$material_name', '$supplier', '$construction_area', '$quantity', '$unit', '$received_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Material stock added successfully!');</script>";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all data from the materials table
$result = $conn->query("SELECT * FROM materials");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Stock</title>
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
        <h3 class="text-center mb-4">Material Stock</h3>
        <!-- Form with method POST -->
        <form id="materialForm" method="POST">
            <div class="mb-3">
                <label for="material" class="form-label">Select a Material</label>
                <select name="material" id="material" class="form-select">
                    <option value="Cements">Cements</option>
                    <option value="Sands">Sands</option>
                    <option value="Concrete Stones">Concrete Stones</option>
                    <option value="Concrete Wire">Concrete Wire</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Select a Supplier</label>
                <select name="supplier" id="supplier" class="form-select">
                    <option value="Sadaruwan Hardware & Suppliers">Sadaruwan Hardware & Suppliers</option>
                    <option value="Amila Constructions">Amila Constructions</option>
                    <option value="Maliban Supplies">Maliban Supplies</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="constructionArea" class="form-label">Select the Construction Area</label>
                <select name="construction_area" id="constructionArea" class="form-select">
                    <option value="Rajagiriya Project">Rajagiriya Project</option>
                    <option value="Colombo Project">Colombo Project</option>
                    <option value="Kandy Project">Kandy Project</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <div class="input-group">
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity">
                    <select name="unit" id="unit" class="form-select">
                        <option value="Pack">Pack</option>
                        <option value="Kg">Kg</option>
                        <option value="Ton">Ton</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="receivedDate" class="form-label">Received Date</label>
                <input type="date" name="received_date" id="receivedDate" class="form-control">
            </div>
            <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>

       
         
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


