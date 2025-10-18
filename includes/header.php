<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPay Nexus | Fee Management System</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .theme-selector {
            transition: all 0.3s ease;
        }
        .theme-selector:hover {
            transform: scale(1.05);
        }
        .glass-card {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.75);
            border-radius: 12px;
            border: 1px solid rgba(209, 213, 219, 0.3);
        }
        .dark .glass-card {
            background-color: rgba(17, 24, 39, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <div class="relative">
        <!-- Theme selector floating button -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-2">
            <button id="themeToggle" class="p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg theme-selector">
                <i data-feather="moon" class="hidden dark:block text-gray-700"></i>
                <i data-feather="sun" class="block dark:hidden text-yellow-500"></i>
            </button>
            <div id="themePalette" class="hidden p-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="grid grid-cols-3 gap-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 theme-option" data-theme="blue"></div>
                    <div class="w-8 h-8 rounded-full bg-emerald-500 theme-option" data-theme="emerald"></div>
                    <div class="w-8 h-8 rounded-full bg-indigo-500 theme-option" data-theme="indigo"></div>
                    <div class="w-8 h-8 rounded-full bg-purple-500 theme-option" data-theme="purple"></div>
                    <div class="w-8 h-8 rounded-full bg-pink-500 theme-option" data-theme="pink"></div>
                    <div class="w-8 h-8 rounded-full bg-orange-500 theme-option" data-theme="orange"></div>
                </div>
            </div>
        </div>
