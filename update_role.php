<?php
require_once "config/db.php";
require_once "helpers/auth.php";
checkRole('admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int) $_POST['user_id'];
    $newRole = $_POST['role'];

    $validRoles = ['admin', 'editor', 'author', 'reader'];
    if (!in_array($newRole, $validRoles)) {
        die("Invalid role selected");
    }

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->execute([$newRole, $userId]);

    header("Location: manage_users.php?success=1");
    exit;
}
