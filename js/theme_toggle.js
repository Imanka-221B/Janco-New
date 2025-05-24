document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const bodyElement = document.body;
    const currentTheme = localStorage.getItem('theme');

    // Function to apply the saved theme or default to light
    function applyTheme(theme) {
        if (theme === 'black-theme') {
            bodyElement.classList.add('black-theme');
            if (themeToggleBtn) themeToggleBtn.textContent = 'Light Mode';
        } else {
            bodyElement.classList.remove('black-theme');
            if (themeToggleBtn) themeToggleBtn.textContent = 'Dark Mode';
        }
    }

    // Apply theme on initial load
    applyTheme(currentTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            if (bodyElement.classList.contains('black-theme')) {
                bodyElement.classList.remove('black-theme');
                localStorage.setItem('theme', 'light-theme'); // Or simply remove the item
                themeToggleBtn.textContent = 'Dark Mode';
            } else {
                bodyElement.classList.add('black-theme');
                localStorage.setItem('theme', 'black-theme');
                themeToggleBtn.textContent = 'Light Mode';
            }
        });
    } else {
        console.error("Theme toggle button with ID 'themeToggleBtn' not found.");
    }
});
