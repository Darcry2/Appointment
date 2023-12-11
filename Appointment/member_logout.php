<?php
session_start(); // Start the session (if not already started)

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other desired page
header("Location: member_login.php");
exit();
?>
