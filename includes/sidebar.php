<!-- Sidebar -->
<div class="fixed inset-y-0 left-0 w-64 flex flex-col bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 z-40">
    <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 rounded-lg bg-primary-500 flex items-center justify-center">
                <i data-feather="book" class="text-white"></i>
            </div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">EduPay Nexus</h1>
        </div>
    </div>
    <div class="flex-1 overflow-y-auto px-4 py-4">
        <nav class="space-y-1">
            <a href="index.php?page=dashboard" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($page == 'dashboard') ? 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
                <i data-feather="home" class="w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a href="index.php?page=students" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($page == 'students') ? 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
                <i data-feather="users" class="w-5 h-5 mr-3"></i>
                Students
            </a>
            <a href="index.php?page=payments" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($page == 'payments') ? 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
                <i data-feather="credit-card" class="w-5 h-5 mr-3"></i>
                Payments
            </a>
            <a href="index.php?page=reports" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($page == 'reports') ? 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
                <i data-feather="pie-chart" class="w-5 h-5 mr-3"></i>
                Reports
            </a>
            <a href="index.php?page=settings" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($page == 'settings') ? 'bg-primary-50 dark:bg-gray-700 text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
                <i data-feather="settings" class="w-5 h-5 mr-3"></i>
                Settings
            </a>
        </nav>
        <div class="mt-8">
            <h3 class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quick Actions</h3>
            <div class="mt-2 space-y-1">
                <a href="index.php?page=add_student" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i data-feather="plus" class="w-5 h-5 mr-3 text-green-500"></i>
                    New Student
                </a>
                <a href="index.php?page=add_payment" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i data-feather="dollar-sign" class="w-5 h-5 mr-3 text-blue-500"></i>
                    Record Payment
                </a>
            </div>
        </div>
    </div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <i data-feather="user" class="text-gray-600 dark:text-gray-300"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-200"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <a href="logout.php" class="text-xs text-gray-500 dark:text-gray-400 hover:underline">Logout</a>
            </div>
        </div>
    </div>
</div>
