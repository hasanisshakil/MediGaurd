<?php
include_once('config.php');
include_once('client.php');

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
}

if (isset($_GET['med_id'])) {
    $med_id = $_GET['med_id'];

//Delete Medicine

    
        
        // Delete the medicine from the database
        $delete_sql = "DELETE FROM medicines WHERE med_id ='$med_id'";
        if (mysqli_query($conn, $delete_sql)) {
            $del_success = "Medicine deleted successfully.";
            echo "<script>window.location.href='medicine_list.php?del_success=". urlencode($del_success) ."'</script>";
        } else {
            $error = "Error deleting medicine.";
        }
}
?>