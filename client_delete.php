<?php 
include_once('config.php');

    if(isset($_GET['c_id']) && isset($_GET['client_company'])){
        $c_id= $_GET['c_id'];
        $client_company= $_GET['client_company'];
    }
    //Collect Data for this ID
    $data_sql= "SELECT * FROM client_info WHERE client_id='$c_id'";
    $run_data_sql= mysqli_query($conn, $data_sql);
    $fetch_data= mysqli_fetch_assoc($run_data_sql);

    //Insert Data for this ID
    $insert_sql= "INSERT INTO client_trash(client_email, client_pass, client_phone, client_logo, client_company, client_validity, client_approve)
                VALUES('{$fetch_data['client_email']}', '{$fetch_data['client_pass']}',
                '{$fetch_data['client_phone']}', '{$fetch_data['client_logo']}', '{$fetch_data['client_company']}',
                '{$fetch_data['client_validity']}', '{$fetch_data['client_approve']}')";
    $run_insert_sql= mysqli_query($conn, $insert_sql);


    if($run_insert_sql){
        $delete_sql= "DELETE FROM client_info WHERE client_id='$c_id'";
        $run_delete_sql= mysqli_query($conn, $delete_sql);
        $message= "Client $client_company Deleted";
        header("location:client_list.php?delete=$message");
    }
?>