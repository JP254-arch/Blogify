<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Not logged in → redirect to login page
    header("Location: ../auth/login.php?error=unauthorized");
    exit;
}
