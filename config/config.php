<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL (adjust if folder name changes)
define("BASE_URL", "/blogify/");

// Error reporting (dev only)
ini_set('display_errors', '1');
error_reporting(E_ALL);
