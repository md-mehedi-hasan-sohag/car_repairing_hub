// Password visibility toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add toggle buttons to all password fields
    const passwordFields = document.querySelectorAll('input[type="password"]');

    passwordFields.forEach(function(field) {
        // Create wrapper for password field
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'flex';
        wrapper.style.alignItems = 'center';

        // Wrap the password field
        field.parentNode.insertBefore(wrapper, field);
        wrapper.appendChild(field);

        // Create toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle-btn';
        toggleBtn.innerHTML = '👁️';
        toggleBtn.setAttribute('aria-label', 'Toggle password visibility');

        // Add toggle button after the field
        wrapper.appendChild(toggleBtn);

        // Add click event to toggle visibility
        toggleBtn.addEventListener('click', function() {
            if (field.type === 'password') {
                field.type = 'text';
                field.classList.add('password-field');
                toggleBtn.innerHTML = '🔒';
                toggleBtn.setAttribute('aria-label', 'Hide password');
            } else {
                field.type = 'password';
                field.classList.remove('password-field');
                toggleBtn.innerHTML = '👁️';
                toggleBtn.setAttribute('aria-label', 'Show password');
            }
        });
    });
});
