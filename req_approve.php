<?php
include_once('config.php');
//Approval Code
if(isset($_GET['c_id']) && isset($_GET['client_company'])){
    $c_id= $_GET['c_id'];
    $client_company= $_GET['client_company'];
}
    $sql= "UPDATE client_info SET client_approve='Yes' WHERE client_id='$c_id'";
    $run= mysqli_query($conn, $sql);

    $message= "Client $client_company Approved";
    header("location:client_req.php?approved=$message");
?>