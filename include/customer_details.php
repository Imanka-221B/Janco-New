<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $cname = $_POST['customer_name'];
    $sname = $_POST['site_name'];
    $nic = $_POST['NIC_number'];
    $slocation= $_POST['site_location'];
    $phonenumber = $_POST['mobile_number'];
    $startdate = $_POST['start_date'];

    $sql = "INSERT INTO customer_details(customer_id, customer_name, site_name, NIC_number, site_location, mobile_number, start_date)
            VALUES ('', '$cname', '$sname', '$nic', '$slocation', '$phonenumber', '$startdate')";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer_details.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
 //  echo "Form not submitted";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/customerd_styles.css">
  <style>
    .col-md-2
        {
            width: 100% !important;
        }
    .container-fluid
        {
            margin-top: 0px !important;
            width: 25% !important;
            display: block;

        }
    .alldiv
        {
            padding: 0px !important;   
            margin: 0px !important;
            display: flex;
        }
    .sidebar {
            background-color: #f1f7f3;
            height: 91vh;
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
        }

    .sidebar a:hover {
            background-color: #e4ebf1;
            color: #86ec83;
        }

    .sidebar:hover {
            margin-left: 0;
        }

    .content {
            margin-left: 250px;
        padding: 20px;
        flex: 1;
        }

  
    header {
            background-color: #e4ebf1;
            color: #468a51;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0px !important;
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

    header .user i {
        margin-right: 10px;
    }

    header .user .notification {
        margin-left: 15px;
    }

    .toggle-btn {
    background-color: #333;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    position: fixed;
    top: 10px;
    left: 10px;
    z-index: 1000;
    }
  </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/jancoo.png" alt="Logo" >
        </div>
        <div class="title">Janco Home & Construction Dashboard</div>
        <!--<button class="toggle-btn" onclick="toggleSidebar()">☰</button>-->
        <div class="user">
            <i class="fas fa-user-circle"></i><span class="admintext">Admin</span> 
            <i class="fas fa-bell notification"></i>
        </div>
    </header>
    <div class="alldiv">
        <div class="container-fluid" id="sidebar">
            <div class="row">
                <div class="col-md-2 sidebar"  >
                    <a href="#"><i class="fas fa-home me-2"></i> <span class="texthidemob">Summary</span></a>
                    <a href="#"><i class="fas fa-building me-2"></i> <span class="texthidemob">Construction Area</span></a>
                    <a href="#"><i class="fas fa-users me-2"></i> <span class="texthidemob">Employees Database</span></a>
                    <a href="#"><i class="fas fa-boxes me-2"></i> <span class="texthidemob">Material Database</span></a>
                    <a href="supply.php"><i class="fas fa-truck me-2"></i> <span class="texthidemob">Suppliers Details</span></a>
                    <a href="#"><i class="fas fa-address-card me-2"></i> <span class="texthidemob">Customers Details</span></a>
                    <a href="#"><i class="fas fa-dollar-sign me-2"></i> <span class="texthidemob">Finance</span></a>
                </div>
            </div>
        </div>
        <div id="popupForm" class="modal">
            <div class="modal-content">
              <span class="close-btn" id="closeButton">&times;</span>
              <h2>Customer Registration</h2>

              <form method="post">
                <div style="display: flex;" >
                <div class="slideleft">
                    <div class="form-row">
                        <label for="customerName">Customer Name</label>
                        <input type="text" name="customer_name" id="customerName" placeholder="Enter Customer Name">
                    </div>
                    <div class="form-row">
                        <label for="nicNumber">NIC Number</label>
                        <input type="text" name="NIC_number" id="nicNumber" placeholder="Enter NIC Number">
                    </div>
                    <div class="form-row">
                        <label for="mobileNumber">Mobile Number</label>
                        <input type="text" name="mobile_number" id="mobileNumber" placeholder="Enter Mobile Number">
                    </div>
                    </div>
                    <div class="slideright">
                        <div class="form-row">
                            <label for="siteName">Site Name</label>
                            <input type="text" name="site_name" id="siteName" placeholder="Enter Site Name">
                        </div>
                        <div class="form-row">
                            <label for="location">Location</label>
                            <input type="text" name="site_location" id="location" placeholder="Enter Location">
                        </div>
                        <div class="form-row">
                            <label for="duration">Start Date</label>
                            <input type="date" name="start_date" id="duration" placeholder="From YYYY-MM-DD to YYYY-MM-DD">
                        </div>
                    </div>    
                </div>
                <button type="submit" class="register" name="register">Register</button>      
              </form>
              
            </div>
          </div>
          
        <div class="container">
        <header style="background-color: white;"> 
            <h1>Customer Details</h1>
            <div class="actions">
            <input type="text" id="searchBar" placeholder="Search...">
            <button id="addCustomer">Add Customer</button>
            </div>
        </header>
        
        <table>
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>NIC No</th>
                <th>Phone Number</th>
                <th>Site Location</th>
                <th>Start Date</th>
                <th>Actions</th>
            </tr>
            </thead>
 <?php
require_once '../config/config.php';
$sql = "SELECT customer_id, customer_name, site_name, NIC_number, site_location, mobile_number, start_date FROM customer_details ORDER BY customer_id DESC";

$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['customer_id'];
        $cname = $row['customer_name'];
        $sname = $row['site_name'];
        $nic = $row['NIC_number'];
        $slocation= $row['site_location'];
        $phonenumber = $row['mobile_number'];
        $startdate = $row['start_date'];

    echo "  <tbody>
            <tr><form method='post'>
                <td style='display: none;'><input type='text' name = 'customer_id' value='$id'></td>
                <td>$cname</td>
                <td>$nic</td>
                <td>$phonenumber</td>
                <td>$slocation</td>
                <td>$startdate</td>
                <td>
                <button class='edit-btn' type='button' onclick='openModal($id)'><i class='fas fa-edit'></i></button>
                <button class='delete-btn'type='submit' name='deletecustomer' formaction='backend/deletecustomer.php'><i class='fas fa-trash'></i></button>
                </td>
            </tr></form>
            <!-- Modal for Editing -->
        <div id='popupForm$id' class='modal'>
            <div class='modal-content' style='margin:8% auto;'> 
                <span class='close-btn' onclick='closeModal($id)'>&times;</span>
                <h2>Edit Customer Details</h2>

                <form method='post' action='backend/updatecustomer.php'>
                    <input type='hidden' name='customer_id' value='$id'>
                    <div style='display: flex;'>
                        <div class='slideleft'>
                            <div class='form-row'>
                                <label for='customerName$id'>Customer Name</label>
                                <input type='text' name='customer_name' id='customerName$id' value='$cname' placeholder='Enter Customer Name'>
                            </div>
                            <div class='form-row'>
                                <label for='nicNumber$id'>NIC Number</label>
                                <input type='text' name='NIC_number' id='nicNumber$id' value='$nic' placeholder='Enter NIC Number'>
                            </div>
                            <div class='form-row'>
                                <label for='mobileNumber$id'>Mobile Number</label>
                                <input type='text' name='mobile_number' id='mobileNumber$id' value='$phonenumber' placeholder='Enter Mobile Number'>
                            </div>
                        </div>
                        <div class='slideright'>
                            <div class='form-row'>
                                <label for='siteName$id'>Site Name</label>
                                <input type='text' name='site_name' id='siteName$id' value='$sname' placeholder='Enter Site Name'>
                            </div>
                            <div class='form-row'>
                                <label for='location$id'>Location</label>
                                <input type='text' name='site_location' id='location$id' value='$slocation' placeholder='Enter Location'>
                            </div>
                            <div class='form-row'>
                                <label for='duration$id'>Start Date</label>
                                <input type='date' name='start_date' id='duration$id' value='$startdate'>
                            </div>
                        </div>
                    </div>
                    <button type='submit' name='updatedetails' class='register'>Update</button>      
                </form>
            </div>
        </div>
          
            <!-- Add more rows dynamically -->
            </tbody>
            ";
        }
    }

?>
<script>

const popupForm = document.getElementById('popupForm');
const closeButton = document.getElementById('closeButton');


document.getElementById("addCustomer").addEventListener('click',
    function openForm() {
  popupForm.style.display = 'flex';
}
);


closeButton.addEventListener('click', () => {
  popupForm.style.display = 'none';
});

window.addEventListener('click', (e) => {
  if (e.target === popupForm) {
    popupForm.style.display = 'none';
  }
});
function openModal(id) {
    const modal = document.getElementById(`popupForm${id}`);
    modal.style.display = 'block';
}

function closeModal(id) {
    const modal = document.getElementById(`popupForm${id}`);
    modal.style.display = 'none';
}

// Close modal if user clicks outside the modal content
window.addEventListener('click', function (event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

  
    </script>
        </table>
        </div>
  </div>
  <script src="../js/customer_script.js"></script>
</body>
</html>
