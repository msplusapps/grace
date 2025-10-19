<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $school_name = trim($_POST['school_name']);
    $school_email = trim($_POST['school_email']);
    $school_phone = trim($_POST['school_phone']);
    $school_address = trim($_POST['school_address']);

    // Update the school settings in the database
    update_school_setting('school_name', $school_name);
    update_school_setting('school_email', $school_email);
    update_school_setting('school_phone', $school_phone);
    update_school_setting('school_address', $school_address);

    // Redirect to the school info page
    header('Location: index.php?page=school_info&success=1');
    exit;
}

// Get school settings from the database
$school_name = get_school_setting('school_name');
$school_email = get_school_setting('school_email');
$school_phone = get_school_setting('school_phone');
$school_address = get_school_setting('school_address');
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">School Information</h2>
</div>

<div class="glass-card p-6">
    <form action="/school_info" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">School Name</label>
                <input type="text" name="school_name" id="school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($school_name); ?>">
            </div>
            <div class="form-group">
                <label for="school_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">School Email</label>
                <input type="email" name="school_email" id="school_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($school_email); ?>">
            </div>
            <div class="form-group">
                <label for="school_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">School Phone</label>
                <input type="text" name="school_phone" id="school_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($school_phone); ?>">
            </div>
            <div class="form-group">
                <label for="school_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">School Address</label>
                <input type="text" name="school_address" id="school_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($school_address); ?>">
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg transition-colors flex items-center space-x-2">
                <i data-feather="save" class="w-4 h-4"></i>
                <span>Save Information</span>
            </button>
        </div>
    </form>
</div>
