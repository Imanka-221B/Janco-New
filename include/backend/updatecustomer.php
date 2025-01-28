<?php
require_once '../../config/config.php';

if (isset($_POST['updatedetails'])) {
    $id = $_POST['customer_id'];
    $cname = $_POST['customer_name'];
    $sname = $_POST['site_name'];
    $nic = $_POST['NIC_number'];
    $slocation = $_POST['site_location'];
    $phonenumber = $_POST['mobile_number'];
    $startdate = $_POST['start_date'];

    $sql = "UPDATE customer_details 
            SET customer_name='$cname', site_name='$sname', NIC_number='$nic', 
                site_location='$slocation', mobile_number='$phonenumber', start_date='$startdate' 
            WHERE customer_id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../customer_details.php");
    } else {
        echo "<script>alert('Update failed: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
