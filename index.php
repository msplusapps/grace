<?php
// Error logging configuration
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');

// Initialize the session
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Include the database connection file
require_once 'config/db.php';

// Include the functions file
require_once 'lib/functions.php';

// Get the current page from the URL, default to dashboard
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Whitelist of allowed pages
$allowed_pages = ['dashboard', 'students', 'add_student', 'edit_student', 'payments', 'add_payment', 'student_payments', 'settings', 'online_payment', '404', 'reports', 'school_info'];

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

<!-- Top bar -->
<nav class="ml-64 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <button class="md:hidden text-gray-500 dark:text-gray-400">
                <i data-feather="menu"></i>
            </button>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white"><?php echo ucfirst($page); ?></h2>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <i data-feather="bell" class="text-gray-500 dark:text-gray-400"></i>
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
            </div>
            <div class="relative">
                <button class="flex items-center focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <i data-feather="user" class="text-gray-600 dark:text-gray-300"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="ml-64 px-4 py-6">
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
