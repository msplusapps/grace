<?php
// Get the student ID from the URL
$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;

// Get the student's data
$student = get_student($student_id);

// If the student doesn't exist, redirect to the students page
if (!$student) {
    header('Location: index.php?page=students');
    exit;
}

// Get the payments for this student
$payments = get_student_payments($student_id);
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Payments for <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h2>
    <a href="/payments" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center space-x-2">
        <i data-feather="arrow-left" class="w-4 h-4"></i>
        <span>Back to Payments</span>
    </a>
</div>

<div class="glass-card p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Method</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reference</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">$<?php echo number_format($payment['amount'], 2); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['reference']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
