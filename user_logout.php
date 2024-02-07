<?php

include_once('config.php'); 

session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the user login page after logging out
header("Location: index.php");
exit();

?>