<?php
// Start or resume the existing session
session_start();

// Clear all session variables
session_unset();

// Destroy the session, removing all session data
session_destroy();

// Redirect the user to the sign-in page after logging out
header("Location: ../pages/signin.html");
exit;
?>
