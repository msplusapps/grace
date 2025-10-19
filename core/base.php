<?php
// Error logging configuration
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Initialize the session
session_start();

// Security Headers
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

// Include the database connection file
require_once __DIR__ . '/config/db.php';

// Include the functions file
require_once __DIR__ . '/lib/functions.php';
