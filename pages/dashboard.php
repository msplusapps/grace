<?php
// Get dashboard statistics
$student_count = get_student_count();
$total_revenue = get_total_payments();
$pending_payments = get_pending_payments_count();
$overdue_payments = get_overdue_payments_count();
$recent_payments = get_recent_payments();
$recent_students = get_recent_students();
?>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Overview</h2>
    <div class="flex space-x-2">
        <a href="index.php?page=add_payment" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg transition-colors flex items-center space-x-2">
            <i data-feather="plus" class="w-4 h-4"></i>
            <span>New Payment</span>
        </a>
        <button class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center space-x-2">
            <i data-feather="filter" class="w-4 h-4"></i>
            <span>Filter</span>
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="glass-card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Students</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1"><?php echo $student_count; ?></h3>
            </div>
            <div class="p-3 rounded-lg bg-primary-100 dark:bg-primary-900/30">
                <i data-feather="users" class="text-primary-500 dark:text-primary-400"></i>
            </div>
        </div>
        <p class="text-sm text-green-500 mt-2 flex items-center">
            <i data-feather="arrow-up-right" class="w-4 h-4 mr-1"></i>
            <span>12.5% from last month</span>
        </p>
    </div>

    <div class="glass-card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">$<?php echo number_format($total_revenue, 2); ?></h3>
            </div>
            <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">
                <i data-feather="dollar-sign" class="text-purple-500 dark:text-purple-400"></i>
            </div>
        </div>
        <p class="text-sm text-green-500 mt-2 flex items-center">
            <i data-feather="arrow-up-right" class="w-4 h-4 mr-1"></i>
            <span>8.3% from last month</span>
        </p>
    </div>

    <div class="glass-card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Payments</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1"><?php echo $pending_payments; ?></h3>
            </div>
            <div class="p-3 rounded-lg bg-amber-100 dark:bg-amber-900/30">
                <i data-feather="clock" class="text-amber-500 dark:text-amber-400"></i>
            </div>
        </div>
    </div>

    <div class="glass-card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Overdue Payments</p>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1"><?php echo $overdue_payments; ?></h3>
            </div>
            <div class="p-3 rounded-lg bg-red-100 dark:bg-red-900/30">
                <i data-feather="alert-triangle" class="text-red-500 dark:text-red-400"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Chart and Recent Payments -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 glass-card p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Revenue Overview</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-primary-500 text-white rounded-md">Monthly</button>
                <button class="px-3 py-1 text-xs bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md">Quarterly</button>
                <button class="px-3 py-1 text-xs bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md">Yearly</button>
            </div>
        </div>
        <div class="h-80 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
            <canvas id="paymentsChart"></canvas>
        </div>
    </div>

    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Payments</h3>
        <div class="space-y-4">
            <?php foreach ($recent_payments as $payment): ?>
                <div class="flex items-start">
                    <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center mr-3">
                        <i data-feather="user" class="text-primary-500 dark:text-primary-400"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-800 dark:text-white"><?php echo htmlspecialchars($payment['first_name'] . ' ' . $payment['last_name']); ?></h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($payment['reference']); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800 dark:text-white">$<?php echo number_format($payment['amount'], 2); ?></p>
                        <p class="text-xs text-green-500"><?php echo htmlspecialchars($payment['payment_method']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="index.php?page=payments" class="w-full mt-4 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors flex items-center justify-center space-x-2">
            <span>View All Payments</span>
            <i data-feather="chevron-right" class="w-4 h-4"></i>
        </a>
    </div>
</div>

<!-- Recent Students -->
<div class="glass-card p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Students</h3>
<?php
$payment_chart_data = get_payment_data_for_chart();
$chart_labels = json_encode(array_column($payment_chart_data, 'date'));
$chart_values = json_encode(array_column($payment_chart_data, 'total'));
?>
<script>
    const chartLabels = <?php echo $chart_labels; ?>;
    const chartValues = <?php echo $chart_values; ?>;
</script>
        <a href="index.php?page=students" class="text-primary-500 dark:text-primary-400 text-sm font-medium flex items-center space-x-1">
            <span>View All</span>
            <i data-feather="chevron-right" class="w-4 h-4"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Student</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Grade</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($recent_students as $student): ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <i data-feather="user" class="text-blue-500 dark:text-blue-400"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($student['class']); ?></td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Active</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?page=edit_student&id=<?php echo $student['id']; ?>" class="text-primary-500 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
