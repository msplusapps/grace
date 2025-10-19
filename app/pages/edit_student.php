<?php
// Get the student ID from the URL
$student_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get the student's data
$student = get_student($student_id);

// If the student doesn't exist, redirect to the students page
if (!$student) {
    header('Location: index.php?page=students');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $class = trim($_POST['class']);
    $date_of_birth = trim($_POST['date_of_birth']);
    $address = trim($_POST['address']);
    $parent_phone = trim($_POST['parent_phone']);

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($class)) {
        $error = "Please fill in all required fields.";
    } else {
        // Update the student's information
        update_student($student_id, $first_name, $last_name, $class, $date_of_birth, $address, $parent_phone);
        // Redirect to the students page
        header('Location: index.php?page=students&updated=1');
        exit;
    }
}
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Student</h2>
    <a href="/students" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center space-x-2">
        <i data-feather="arrow-left" class="w-4 h-4"></i>
        <span>Back to Students</span>
    </a>
</div>

<div class="glass-card p-6">
    <form action="/edit_student?id=<?php echo $student_id; ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                <input type="text" name="first_name" id="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Class</label>
                <input type="text" name="class" id="class" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($student['class']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($student['date_of_birth']); ?>">
            </div>
            <div class="form-group md:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo htmlspecialchars($student['address']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="parent_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parent's Phone</label>
                <input type="text" name="parent_phone" id="parent_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo htmlspecialchars($student['parent_phone']); ?>">
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg transition-colors flex items-center space-x-2">
                <i data-feather="save" class="w-4 h-4"></i>
                <span>Update Student</span>
            </button>
        </div>
    </form>
</div>
