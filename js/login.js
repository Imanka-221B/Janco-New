const passwordField = document.getElementById('password');
const toggleButton = document.getElementById('pass-toggle-btn');

toggleButton.addEventListener('click', () => {
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;
    toggleButton.classList.toggle('fa-eye-slash');
});
