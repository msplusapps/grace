        </main>
    </div>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const themePalette = document.getElementById('themePalette');
        const themeOptions = document.querySelectorAll('.theme-option');

        // Toggle theme palette visibility
        themeToggle.addEventListener('click', () => {
            themePalette.classList.toggle('hidden');
        });

        // Change theme color
        themeOptions.forEach(option => {
            option.addEventListener('click', () => {
                const theme = option.getAttribute('data-theme');
                // This is a placeholder for theme switching logic.
                // In a real application, you would load a different CSS file or update CSS variables.
                console.log('Selected theme:', theme);
            });
        });

        // Dark mode toggle
        const htmlElement = document.querySelector('html');

        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            localStorage.setItem('darkMode', htmlElement.classList.contains('dark'));
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            htmlElement.classList.add('dark');
        } else if (localStorage.getItem('darkMode') === 'false') {
            htmlElement.classList.remove('dark');
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            htmlElement.classList.add('dark');
        }
    </script>
    <script src="app/vendor/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="app/js/script.js"></script>
    <script src="app/js/dashboard.js"></script>
</body>
</html>
