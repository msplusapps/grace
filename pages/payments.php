<?php
// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Get the list of payments
$payments = get_payments($search);
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Manage Payments</h2>
    <a href="index.php?page=add_payment" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg transition-colors flex items-center space-x-2">
        <i data-feather="plus" class="w-4 h-4"></i>
        <span>Add New Payment</span>
    </a>
</div>

<div class="glass-card p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Student Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Method</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reference</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <a href="index.php?page=student_payments&student_id=<?php echo $payment['student_id']; ?>" class="text-sm font-medium text-primary-500 dark:text-primary-400 hover:underline"><?php echo htmlspecialchars($payment['student_name']); ?></a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">$<?php echo number_format($payment['amount'], 2); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['reference']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?page=payments&delete=<?php echo $payment['id']; ?>" class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this payment?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
