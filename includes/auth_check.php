<?php
if (session_status() === PHP_SESSION_NONE) {
    
}

// Require user to be logged in
function require_login() {
    if (empty($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "login.php");
        exit;
    }
}

// Require specific role
function require_role($role) {
    require_login();
    if ($_SESSION['role'] !== $role) {
        die("Access denied. You do not have permission to view this page.");
    }
}
