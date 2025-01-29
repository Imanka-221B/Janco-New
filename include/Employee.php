<?php
// Properly include the config.php file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "janco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $position = $_POST['position'];

    $stmt = $conn->prepare("INSERT INTO employees (Name, PhoneNumber, Position) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phoneNumber, $position);

    if ($stmt->execute()) {
        header('location: Employee.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janco Home & Construction Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .btn-register {
    background-color: #28a745;
    color: white;
    font-weight: bold;
    width: 100%;
    }

    .btn-register:hover {
    background-color: #218838;
    }

        body {
            font-family: 'Poppins', sans-serif;
        }
        .bsn-group {  
            padding-left: 150px; 
        }  

        .bsn {  
            font-size: 15px;  
            padding: 15px 15px;
            color: #47925b;
        }  

        .bsn-success {  
            background-color: #28a745; /* Green color for the active button */  
            border: none;  
            color:black;
        }  

        .bsn-success:hover {  
            background-color: #218838; /* Darker green on hover */ 
            color: #47925b;
        }  

        .bsn-secondary {  
            background-color: #f1f7f3; /* Grey for other buttons */  
            border: none; 
            color:black;
        }  

        .bsn-secondary:hover {  
            background-color: #e4ebf1; /* Darker grey on hover */ 
            color: #47925b; 
        }  

        .sidebar {
            background-color: #f1f7f3;
            height: 89vh;
            padding: 20px;
            padding-top: 50px;
            transition: margin-left 0.3s ease;
        }

        .sidebar a {
            display: block;
            color: #47925b;
            text-decoration: none;
            font-size: 12px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #e4ebf1;
            color: #86ec83;
        }

        .sidebar:hover {
            margin-left: 0;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        header {
            background-color: #e4ebf1;
            color: #468a51;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        header .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        header .title {
            font-size: 1.25rem;
            font-weight: 500;
            text-align: center;
            flex-grow: 1;
        }

        header .user {
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        h3 {
            margin: 20px 20px;
            font-size: 20px;
        }

        .table {
            font-size: 15px;
        }

        header .user i {
            margin-right: 10px;
        }

        header .user .notification {
            margin-left: 15px;
        }

        .labour-details {
            max-height: 400px; /* Fixed height for scrollbar */
            overflow-y: auto; /* Enable vertical scrollbar */
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .labour-details table {
            width: 100%;
        }
        .labour-details th, .labour-details td {
            padding: 10px;
            text-align: left;
        }
        .modal-content {
            padding: 20px;
        }
        .add-labour-btn {
            margin-top: 20px; /* Add space above the button */
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -220px;
            }

            .content {
                margin-left: 0;
            }

            .sidebar:hover {
                margin-left: 0;
            }
        }

        /*custom add*/
        .material-icons {
            color: rgb(13, 241, 24);
        }

        .material-icons1 {
            color: rgb(226, 10, 10);
        }

        .table-container::-webkit-scrollbar {
            width: 12px; /* Change scrollbar width */
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #47925b; /* Set thumb color */
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-track {
            background-color: #e4ebf1; /* Set track color */
        }

        .sidebar .active {
            background-color: #cce7d7;
            color: #86ec83;
        }




</style>

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
        <d class="row">
            <div class="col-md-2 sidebar">
                <a href="#"><i class="fas fa-home me-2"></i> Summary</a>
                <a href="#" id="constructionAreaLink"><i class="fas fa-building me-2"></i> Construction Area</a>
                <a href="Employee.php"class="active"><i class="fas fa-users me-2"></i> Employees Database</a>
                <a href="#"><i class="fas fa-boxes me-2"></i> Material Database</a>
                <a href="supply.php"><i class="fas fa-truck me-2"></i> Suppliers Details</a>
                <a href="customer_details.php"><i class="fas fa-address-card me-2"></i> Customers Details</a>
                <a href="#"><i class="fas fa-dollar-sign me-2"></i> Finance</a>
            </div>

           
            <div class="col-md-9 col-lg-10 main-content" id="mainContent">
           
        
            <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">All Employees</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModal">Add Employee</button>

    </div>
    <div class="table-container" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered">
            <thead class="table-success">
                <tr>
                    <th>EmpID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php 
            $sql = "SELECT EmpID, Name, PhoneNumber, Position FROM employees ORDER BY EmpID DESC";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)){
                    $id =$row['EmpID'];
                    $name =$row['Name'];
                    $pnumber=$row['PhoneNumber'];
                    $position=$row['Position'];
        echo "   
            <tbody>
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$pnumber</td>
                    <td>$position</td>
                    <td>
                        <button onclick='editEmployee($id)'>
                            <i class='material-icons'>&#9998;</i>
                        </button>
                        <button onclick='deleteEmployee($id)'>
                            <i class='material-icons1'>&#xe872;</i>
                        </button>
                    </td>
                </tr>
";
                }}
                ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-4">
    </div>
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="container">
    <div class="form-container">
      <h2 class="form-title text-center">Employee Registration</h2>
      <form id="employeeForm" action="" method="POST">
    
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
    </div>
    <div class="mb-3">
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number" required>
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" required>
    </div>
    <button type="submit" class="btn btn-register w-100">Register</button>
    </form>

    </div>
  </div>                </div>
            </div>
        </div>
    </div>
</div>

        </div>

            <div class="col-md-9 col-lg-10 main-content" id="labourerSalary"> 
            </div>


        </div>
        
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>   
   
    <script>

function deleteEmployee(empID) {
            // Confirm deletion
            if (confirm('Are you sure you want to delete this employee?')) {
                // Redirect to the delete.php page with the EmpID
                window.location.href = 'backend/deleteEmp.php?EmpID=' + empID;
            }
        }

        function editEmployee(empID) {
            // Redirect to update.php page with EmpID
            window.location.href = 'backend/updateEmp.php?EmpID=' + empID;
        }
 
        </script>
</body>

</html>