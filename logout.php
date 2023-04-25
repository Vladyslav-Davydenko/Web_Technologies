<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["id"])) {
    // User is logged in, so unset the session variable(s) and destroy the session
    unset($_SESSION["id"]);
    session_destroy();
}
?>