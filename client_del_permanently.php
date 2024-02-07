<?php
include_once('config.php');
//Unapproval Or Delete Code
if(isset($_GET['c_id']) && isset($_GET['client_company'])){
    $c_id= $_GET['c_id'];
    $client_company= $_GET['client_company'];
}
    //Delete Data for this ID
    $delete_sql= "DELETE FROM client_trash WHERE client_id='$c_id'";
    $run_delete_sql= mysqli_query($conn, $delete_sql);

    $deleted= "Client ID $client_company Deleted Permanently";
    echo "<script>window.location.href='client_trash.php?deleted_per=". urlencode($deleted) ."'</script>";

?>