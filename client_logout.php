<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the client login page after logging out
header("Location: client_login.php");
exit();

?>
