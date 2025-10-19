<?php
// Handle delete request
if (isset($_GET['delete'])) {
    $student_id = (int)$_GET['delete'];
    delete_student($student_id);
    header('Location: /students');
    exit;
}

// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Get the list of students
$students = get_students($search);
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Manage Students</h2>
    <a href="/add_student" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg transition-colors flex items-center space-x-2">
        <i data-feather="plus" class="w-4 h-4"></i>
        <span>Add New Student</span>
    </a>
</div>

<div class="glass-card p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Class</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Parent's Phone</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($student['class']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($student['parent_phone']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="/edit_student?id=<?php echo $student['id']; ?>" class="text-primary-500 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">Edit</a>
                            <a href="/students?delete=<?php echo $student['id']; ?>" class="ml-4 text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
