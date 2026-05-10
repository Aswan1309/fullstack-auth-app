import React from 'react';
import { createRoot } from 'react-dom/client';
import LoginForm from './components/LoginForm';

// Mount React enhancements if the login page is present
const loginRoot = document.getElementById('login-form-root');
if (loginRoot) {
    createRoot(loginRoot).render(<LoginForm />);
}

// Global: toggle password visibility for all .toggle-pw elements
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.style.cursor = 'pointer';
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target;
            const input    = document.getElementById(targetId);
            if (!input) return;
            input.type      = input.type === 'password' ? 'text' : 'password';
            btn.textContent = input.type === 'password' ? '👁' : '🙈';
        });
    });
});
