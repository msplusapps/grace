<?php
// Error logging configuration
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');

// Initialize the session
session_start();

// Include the database connection file
require_once 'config/db.php';

// Include the functions file
require_once 'lib/functions.php';

// Get the current page from the URL, default to dashboard
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Whitelist of allowed pages
$allowed_pages = ['dashboard', 'students', 'add_student', 'edit_student', 'payments', 'add_payment', 'student_payments', 'settings', 'online_payment', '404'];

// If the requested page is not in the whitelist, show a 404 error
if (!in_array($page, $allowed_pages)) {
    http_response_code(404);
    $page = '404';
}

// Include the header
include 'includes/header.php';

// Include the sidebar
include 'includes/sidebar.php';
?>

<div class="main-content">
    <?php
    // Include the page content
    $page_path = "pages/{$page}.php";
    if (file_exists($page_path)) {
        include $page_path;
    } else {
        // Fallback to a default page or show an error
        include 'pages/dashboard.php';
    }
    ?>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
