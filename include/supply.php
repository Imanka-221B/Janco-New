<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $cname = $_POST['company_name'];
    $clocation = $_POST['location'];
    $cPhoneNumber = $_POST['phone_number'];
    $bName = $_POST['bank_name'];
    $blocation = $_POST['bank_location'];
    $AccNo = $_POST['acc_no'];

    $sql = "INSERT INTO supplier_details (supplier_Id, company_name, location, phone_number, Bank_name, Branch_location, Account_number)
            VALUES ('', '$cname', '$clocation', '$cPhoneNumber', '$bName', '$blocation', '$AccNo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: supply.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
   // echo "Form not submitted";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHqT94m8bMN1F+TyHqOw+Y9ev0Hz5xAB/l9EfuSh2MLpue2RRGR0q1UG8+MFGKjohP+iPluQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/mobilesupplystyles.css">
    <link rel="stylesheet" href="../css/supplystyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <img src="../img/jancoo.png" alt="Logo">
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
                    <a href="Employee.php"><i class="fas fa-users me-2"></i> <span class="texthidemob">Employees Database</span></a>
                    <a href="material.php"><i class="fas fa-boxes me-2"></i> <span class="texthidemob">Material Database</span></a>
                    <a href="supply.php"><i class="fas fa-truck me-2"></i> <span class="texthidemob">Suppliers Details</span></a>
                    <a href="customer_details.php"><i class="fas fa-address-card me-2"></i> <span class="texthidemob">Customers Details</span></a>
                    <a href="#"><i class="fas fa-dollar-sign me-2"></i> <span class="texthidemob">Finance</span></a>
                </div>
            </div>
        </div>
        <!-- Add Supplier Form Modal -->
        <div id="addSupplierModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Supplier Registration</h2>

                <form id="addSupplierForm" method="post">
                    <label for="companyName">Company Name</label>
                    <input type="text" id="companyName" name="company_name" placeholder="Enter Company Name" required>

                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter Location" required>

                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" id="phoneNumber" name="phone_number" placeholder="Enter Phone Number" required>

                    <label for="bankDetails">Bank Name</label>
                    <input type="text" id="bankDetails" name="bank_name" placeholder="Enter Bank Name" required>

                    <label for="branchLocation">Bank Location</label>
                    <input type="text" id="branchLocation" name="bank_location" placeholder="Enter Branch Location" required>

                    <label for="bankDetails">Account Number</label>
                    <input type="text" id="bankDetails" name="acc_no" placeholder="Enter Account Number" required>

                    <button type="submit" name="register">Register</button>
                </form>
            </div>
        </div>

        <div class="container">
            <header style="background-color: white;">
                <h1>All Suppliers</h1>
                <div class="search-bar">
                    <input type="text" id="search" placeholder="Search">
                    <button id="addSupplier">Add Supplier</button>
                   <!-- <button id="sort">Short by: Newest</button>-->
                </div>
            </header>
            <table>
                <thead>
                    <tr>
                        <th>Supplier Company</th>
                        <th>Location</th>
                        <th>Phone Number</th>
                        <th>Bank Name</th>
                        <th>Branch Location</th>
                        <th>Account Number</th>
                        <th>Payment Status</th>
                        <th>Supply Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
<?php
require_once '../config/config.php';
$sql = "SELECT supplier_Id, company_name, location, phone_number, Bank_name, Branch_location, Account_number FROM supplier_details ORDER BY supplier_Id DESC";

$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['supplier_Id'];
        $cname = $row['company_name'];
        $clocation = $row['location'];
        $phoneNo = $row['phone_number'];
        $bname = $row['Bank_name'];
        $blocation = $row['Branch_location'];
        $accNo = $row['Account_number'];

        echo "
                <tbody>
                    <tr><form method = 'post'>
                        <td style='display: none;'><input type='text' name = 'supplier_Id' value='$id'> </td>
                        <td name = 'cname'>$cname</td>
                        <td>$clocation</td>
                        <td>$phoneNo</td>
                        <td>$bname</td>
                        <td>$blocation</td>
                        <td>$accNo</td>
                        <td>Not Paid</td>
                        <td>Not Received</td>
                        <td class='actions'>
                            <button class='edit' type ='submit' name ='editdetails'  id = 'edit'><i class='fas fa-edit'></i></button>
                            <button class='delete' name='deletesupply' type='submit' formaction='backend/deletesupply.php' ><i class='fas fa-trash'></i></button>
                        </td>
                    
                    </form></tr>
                </tbody>
                
                <div id='addSupplierModal2' class='modal'>
                <div class='modal-content'>
                    <span class='close2' style='    color: #aaa; float: right; font-size: 24px; font-weight: bold; cursor: pointer;'>&times;</span>
                    <h2>Edit Supplier Details</h2>

                <form id='addSupplierForm' method='post' action = 'backend/updatesupply.php'>
                    <input type='text' name = 'supplier_Id' value='$id' style='display: none;'> 
                    <label for='companyName'>Company Name</label>
                    <input type='text' id='companyName' name='company_name' value='$cname' placeholder='Enter Company Name' >

                    <label for='location'>Location</label>
                    <input type='text' id='location' name='location' value='$clocation' placeholder='Enter Location' >

                    <label for='phoneNumber'>Phone Number</label>
                    <input type='tel' id='phoneNumber' name='phone_number' value='$phoneNo' placeholder='Enter Phone Number' >

                    <label for='bankDetails'>Bank Name</label>
                    <input type='text' id='bankDetails' name='bank_name' value='$bname' placeholder='Enter Bank Name' >

                    <label for='branchLocation'>Bank Location</label>
                    <input type='text' id='branchLocation' name='bank_location' value='$blocation' placeholder='Enter Branch Location' >

                    <label for='bankDetails'>Account Number</label>
                    <input type='text' id='bankDetails' name='acc_no' value='$accNo' placeholder='Enter Account Number' >

                    <button type='submit' name='updatedetails'>Update</button>
                </form>
            </div>
            </div>
            ";
    }
}
?>
            </table>
            

            <div class="actions">
             <!--   <div class="pagination">
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>10</button>
                    <button>&lt;</button>
                    <button>&gt;</button>
                </div>-->
            </div>
        </div>
    </div>


<script>
const edittt = document.getElementById("edit");
const modal = document.getElementById("addSupplierModal");
const modal2 = document.getElementById("addSupplierModal2");
const addSupplierBtn = document.getElementById("addSupplier");
const closeBtn = document.querySelector(".close");
const closeBtn2 = document.querySelector(".close2");

addSupplierBtn.addEventListener("click", () => {
modal.style.display = "flex";
});

edittt.addEventListener("click",()=>{
    event.preventDefault();
    modal2.style.display="flex";
})

closeBtn2.addEventListener("click", () => {
modal2.style.display = "none";
});

closeBtn.addEventListener("click", () => {
modal.style.display = "none";
});

window.addEventListener("click", (event) => {
if (event.target === modal) {
modal.style.display = "none";
}
});

// Handle form submission
/*document.getElementById("addSupplierFormm").addEventListener("submit", (event) => {
event.preventDefault(); // Prevent page reload
alert("Supplier added successfully!");
modal.style.display = "none"; // Close modal after submission
});

function toggleSidebar() {
const sidebar = document.getElementById('sidebar');
sidebar.classList.toggle('show');
}
*/
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!--
    <tr>
                        <td data-label="Supplier Company">Jane Cooper</td>
                        <td data-label="Location">Colombo</td>
                        <td data-label="Phone Number">(225) 555-0118</td>
                        <td data-label="Bank Name & Account Number">Alpha Bank - 1234567890</td>
                        <td data-label="Branch Location">Colombo</td>
                        <td data-label="Payment Status">Paid</td>
                        <td data-label="Supply Status">Received</td>
                        <td class="actions">
                            <button class="edit"><i class="fas fa-edit"></i></button>
                            <button class="delete"><i class="fas fa-trash"></i></button>
                        </td>
    </tr>
-->
</body>
</html>
