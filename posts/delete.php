<?php
require "../config/db.php";
require "../includes/auth_check.php";

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
    $stmt->execute([$id]);
}
header("Location: dashboard.php?success=deleted");
exit;
