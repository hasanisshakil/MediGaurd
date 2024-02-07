<?php
include_once('config.php');
//Unapproval Or Delete Code
if(isset($_GET['c_id']) && isset($_GET['client_company'])){
    $c_id= $_GET['c_id'];
    $client_company= $_GET['client_company'];
}
    //Insert Data for this ID
    $sql = "SELECT * FROM client_info WHERE client_id= '$c_id'";
    $run = mysqli_query($conn, $sql);
    $fetch_data = mysqli_fetch_assoc($run);
    $insert_sql= "INSERT INTO client_trash(client_email, client_pass, client_phone, client_logo, client_company, client_validity, client_approve)
                VALUES('{$fetch_data['client_email']}', '{$fetch_data['client_pass']}',
                '{$fetch_data['client_phone']}', '{$fetch_data['client_logo']}', '{$fetch_data['client_company']}',
                '{$fetch_data['client_validity']}', '{$fetch_data['client_approve']}')";

    $run_insert_sql= mysqli_query($conn, $insert_sql);


    //Delete Data for this ID
    $delete_sql= "DELETE FROM client_info WHERE client_id='$c_id'";
    $run_delete_sql= mysqli_query($conn, $delete_sql);


    $message= "Client $client_company Deleted";
    echo "<script>window.location.href='client_req.php?delete=$message'</script>";
?>