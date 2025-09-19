<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Change this if your project folder name changes
define("BASE_URL", "/blogify/");

// Environment (show errors while developing)
ini_set('display_errors', '1');
error_reporting(E_ALL);
