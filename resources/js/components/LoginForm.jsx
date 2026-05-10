import React, { useState, useEffect } from 'react';

/**
 * LoginForm – React component mounted into #login-form-root
 * Handles: password visibility toggle, form submission state
 */
function LoginForm() {
    const [showPassword, setShowPassword] = useState(false);
    const [isLoading, setIsLoading]       = useState(false);

    // Toggle password visibility
    useEffect(() => {
        const toggleBtns = document.querySelectorAll('.toggle-pw');
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.dataset.target;
                const input    = document.getElementById(targetId);
                if (!input) return;
                input.type = input.type === 'password' ? 'text' : 'password';
                btn.textContent = input.type === 'password' ? '👁' : '🙈';
            });
        });
    }, []);

    // Loading state on submit
    useEffect(() => {
        const form = document.querySelector('.auth-form');
        if (!form) return;
        form.addEventListener('submit', () => {
            const btn = form.querySelector('.btn-primary');
            if (btn) {
                btn.disabled = true;
                btn.querySelector('span:first-child').textContent = 'Connexion…';
            }
        });
    }, []);

    return null; // Enhancement only – UI is server-rendered via Blade
}

export default LoginForm;
