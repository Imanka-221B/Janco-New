<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve POST data
    $material_name = $_POST['material'];
    $supplier = $_POST['supplier'];
    $construction_area = $_POST['construction_area'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $received_date = $_POST['received_date'];

    // Prepare the SQL statement
    $sql = "INSERT INTO materials (material_name, supplier, construction_area, quantity, unit, received_date) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Use a prepared statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssiss", $material_name, $supplier, $construction_area, $quantity, $unit, $received_date);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to prevent form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janco Home & Construction Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/material.css"/>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../img/jancoo.png" alt="Logo">
        </div>
        <div class="title">Janco Home & Construction Dashboard</div>
        <div class="user">
            <i class="fas fa-user-circle"></i> Admin
            <i class="fas fa-bell notification"></i>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <a href="#"><i class="fas fa-home me-2"></i> Summary</a>
                <a href="#"><i class="fas fa-building me-2"></i> Construction Area</a>
                <a href="Employee.php"><i class="fas fa-users me-2"></i> Employees Database</a>
                <a href="material.php"><i class="fas fa-boxes me-2"></i> Material Database</a>
                <a href="supply.php"><i class="fas fa-truck me-2"></i> Suppliers Details</a>
                <a href="customer_details.php"><i class="fas fa-address-card me-2"></i> Customers Details</a>
                <a href="#"><i class="fas fa-dollar-sign me-2"></i> Finance</a>
            </div>
            <div class="content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Material Stock</h1>
                    <a href="stock.php" class="btn btn-success">Add Material</a>
                </div>
                <div class="table-container">
                    <table class="table table-striped table-bordered">
                        <thead class="table-success">   
                            <tr>
                                <th>Material Name</th>
                                <th>Supplier</th>
                                <th>Construction Area</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Received Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
<?php 
            $sql = "SELECT material_id, material_name, supplier, construction_area, quantity ,unit ,received_date FROM materials ORDER BY material_id DESC";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)){
                    $id =$row['material_id'];
                    $mname =$row['material_name'];
                    $supplier=$row['supplier'];
                    $carea=$row['construction_area'];
                    $qly = $row['quantity'];
                    $unit =$row['unit'];
                    $receiveddate =$row['received_date'];


                    echo "
                        <tbody>
                            <tr>
                                <td>$mname</td>
                                <td>$supplier</td>
                                <td>$carea</td>
                                <td>$qly</td>
                                <td>$unit</td>
                                <td>$receiveddate</td>
                               <td>
                               <button onclick='editMaterials($id)'>
                                <i class='material-icons'>&#9998;</i>
                                </button>
                                <button onclick='deleteMaterials($id)'>
                                <i class='material-icons'>&#xe872;</i>
                                </button>
                            </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        ";
                            }}
?>
                    </table>
                </div>



                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModal">Add Material</button>
                </div>
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="text-center mb-4">Material Stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
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
        </form>                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

   
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
function deleteMaterials(id) {
    if (confirm('Are you sure you want to delete this list?')) {
        window.location.href = 'backend/materialDelete.php?material_id=' + id;
    }
}

function editMaterials(id) {
    window.location.href = 'backend/materialUpdate.php?material_id=' + id;
}

    </script>

</body>

</html>
