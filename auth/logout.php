<?php
require_once __DIR__ . '/../config/config.php';

// End session
session_unset();
session_destroy();

// Redirect to homepage
header("Location: " . BASE_URL . "index.php");
exit;
