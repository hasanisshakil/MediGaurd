<?php
include_once('config.php');
if(isset($_GET['c_id']) && isset($_GET['client_company'])){
    $c_id= $_GET['c_id'];
    $client_company= $_GET['client_company'];
}
    //Collect Data for this ID
    $sql= "SELECT * from client_info WHERE client_id='$c_id'";
    $run=mysqli_query($conn, $sql);
    $clientdata=mysqli_fetch_assoc($run);
    $c_name= $clientdata['client_company'];

    //Unapprove
    $unapprove_sql= "UPDATE client_info SET client_approve='No' WHERE client_id='$c_id'";
    $run_unapprove_sql= mysqli_query($conn, $unapprove_sql);


    if($run_unapprove_sql){
        $message= "Client $client_company Has Been Unapproved";
        header("location:client_list.php?unapprove=$message");
    }
?>