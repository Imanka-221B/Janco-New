<?php
require_once '../../config/config.php';

if(isset($_POST['updatedetails']) )
{
    $id = $_POST['supplier_Id'];
    $cname = $_POST['company_name'];
    $clocation = $_POST['location'];
    $cPhoneNumber = $_POST['phone_number'];
    $bName = $_POST['bank_name'];
    $blocation = $_POST['bank_location'];
    $AccNo = $_POST['acc_no'];

    $sql = "UPDATE supplier_details SET company_name='$cname', location='$clocation',phone_number='$cPhoneNumber', bank_name ='$bName' ,Branch_location='$blocation',Account_number='$AccNo' WHERE supplier_Id = '$id'";    

    $result = $conn->query($sql);

    if($result === TRUE)    
    {
        header("Location: ../supply.php");
    }
    else{
        echo "<script>
    alert('details not complete');
          </script>
        ";
    }

}else{ echo "<script>
    alert('details not completedasdasd');
          </script>
        ";}

?>