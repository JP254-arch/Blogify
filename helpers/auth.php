<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkRole($requiredRole) {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }

    $userRole = $_SESSION['user']['role'];

    $rolesHierarchy = [
        'admin'  => 4,
        'editor' => 3,
        'author' => 2,
        'reader' => 1
    ];

    if ($rolesHierarchy[$userRole] < $rolesHierarchy[$requiredRole]) {
        die("Access Denied! Insufficient role.");
    }
}
