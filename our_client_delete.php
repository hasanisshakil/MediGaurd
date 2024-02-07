<?php
include_once('config.php');

if (isset($_SESSION['admin_id'])) {
    $client_id = $_SESSION['admin_id'];
}

if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];


        
    // Delete the client from the database
    $delete_sql = "DELETE FROM our_clients WHERE company_id ='$company_id'";
    if (mysqli_query($conn, $delete_sql)) {
        $del_success = "Deleted successfully.";
        header("Location: admin_dashboard.php?del_success=$del_success");
    } else {
        $error = "Error deleting.";
    }
}



if (isset($_GET['article_id'])) {
    $article_id = $_GET['article_id'];


        
    // Delete the Article from the database
    $delete_sql = "DELETE FROM articles WHERE article_id ='$article_id'";
    if (mysqli_query($conn, $delete_sql)) {
        $del_success = "Deleted successfully.";
        header("Location: admin_dashboard.php?del_success=$del_success");
    } else {
        $error = "Error deleting.";
    }
}
?>