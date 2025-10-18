        </main>
    </div>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const themePalette = document.getElementById('themePalette');
        const themeOptions = document.querySelectorAll('.theme-option');

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
    <script>
        feather.replace();
    </script>
    <script src="js/script.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
