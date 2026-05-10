@extends('layouts.app')
@section('title', 'Créer un compte')

@section('content')
<div class="auth-page" id="register-page">

    {{-- ── Left panel ────────────────────────────────── --}}
    <aside class="auth-panel auth-panel--register">
        <div class="panel-inner">
            <div class="logo">
                <div class="logo-icon">✦</div>
                <span class="logo-text">Nexora</span>
            </div>
            <div class="panel-steps">
                <p class="steps-label">Rejoignez des milliers d'utilisateurs</p>
                <div class="step-item active"><span class="step-num">1.</span><span>Créez votre compte</span></div>
                <div class="step-item"><span class="step-num">2.</span><span>Personnalisez votre profil</span></div>
                <div class="step-item"><span class="step-num">3.</span><span>Explorez la plateforme</span></div>
            </div>
            <div class="panel-orb orb-1"></div>
            <div class="panel-orb orb-2"></div>
            <div class="panel-orb orb-3"></div>
        </div>
    </aside>

    {{-- ── Right panel – form ────────────────────────── --}}
    <main class="auth-form-wrapper">
        <div class="auth-card">

            <div class="form-header">
                <p class="form-eyebrow">Bienvenue</p>
                <h1 class="form-title">Créer un compte</h1>
                <p class="form-subtitle">Rejoignez Nexora en quelques secondes.</p>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <span class="alert-icon">⚠</span>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Google --}}
            <a href="{{ route('auth.google') }}" class="btn-google">
                <svg width="20" height="20" viewBox="0 0 48 48" fill="none">
                    <path d="M44.5 20H24v8.5h11.8C34.7 33.9 29.8 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 5.1 29.6 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.5 0 20-7.5 20-21 0-1.4-.2-2.7-.5-4z" fill="#FFC107"/>
                    <path d="M6.3 14.7l7 5.1C15.2 17.2 19.4 14 24 14c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 5.1 29.6 3 24 3c-7.6 0-14.2 4.2-17.7 10.7z" fill="#FF3D00"/>
                    <path d="M24 45c5.5 0 10.5-2 14.2-5.3l-6.6-5.5C29.7 35.9 27 37 24 37c-5.8 0-10.6-3.9-12.3-9.2l-7 5.4C8 39.6 15.4 45 24 45z" fill="#4CAF50"/>
                    <path d="M44.5 20H24v8.5h11.8c-.9 2.7-2.6 4.9-4.9 6.5l6.6 5.5C42 36.7 45 31.1 45 24c0-1.4-.2-2.7-.5-4z" fill="#1976D2"/>
                </svg>
                <span>S'inscrire avec Google</span>
            </a>

            <div class="divider"><span>ou</span></div>

            <form method="POST" action="{{ route('register.post') }}" class="auth-form" novalidate>
                @csrf

                <div class="field-group">
                    <label for="name" class="field-label">Nom complet</label>
                    <div class="field-input-wrap">
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="field-input {{ $errors->has('name') ? 'is-error' : '' }}"
                            placeholder="Jean Dupont"
                            autocomplete="name"
                            required
                        />
                        <span class="field-icon">✦</span>
                    </div>
                </div>

                <div class="field-group">
                    <label for="email" class="field-label">Adresse e-mail</label>
                    <div class="field-input-wrap">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="field-input {{ $errors->has('email') ? 'is-error' : '' }}"
                            placeholder="vous@exemple.com"
                            autocomplete="email"
                            required
                        />
                        <span class="field-icon">✉</span>
                    </div>
                </div>

                <div class="field-group">
                    <label for="password" class="field-label">Mot de passe</label>
                    <div class="field-input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input {{ $errors->has('password') ? 'is-error' : '' }}"
                            placeholder="8 caractères minimum"
                            autocomplete="new-password"
                            required
                        />
                        <span class="field-icon toggle-pw" data-target="password">👁</span>
                    </div>
                    {{-- Password strength bar --}}
                    <div class="pw-strength" id="pw-strength">
                        <div class="pw-bar" id="pw-bar"></div>
                    </div>
                    <p class="pw-hint" id="pw-hint"></p>
                </div>

                <div class="field-group">
                    <label for="password_confirmation" class="field-label">Confirmer le mot de passe</label>
                    <div class="field-input-wrap">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="field-input"
                            placeholder="••••••••"
                            autocomplete="new-password"
                            required
                        />
                        <span class="field-icon">✓</span>
                    </div>
                </div>

                <div class="field-check">
                    <label class="check-label">
                        <input type="checkbox" name="terms" required />
                        <span class="check-box"></span>
                        J'accepte les <a href="#">conditions d'utilisation</a>
                    </label>
                </div>

                <button type="submit" class="btn-primary">
                    <span>Créer mon compte</span>
                    <span class="btn-arrow">→</span>
                </button>
            </form>

            <p class="switch-auth">
                Déjà un compte ?
                <a href="{{ route('login') }}">Se connecter</a>
            </p>
        </div>
    </main>
</div>

@push('scripts')
<script>
    const pwInput = document.getElementById('password');
    const pwBar   = document.getElementById('pw-bar');
    const pwHint  = document.getElementById('pw-hint');
    const levels  = [
        { min: 0,  cls: '',          label: '',                    color: '' },
        { min: 1,  cls: 'pw-weak',   label: 'Trop faible',        color: '#ef4444' },
        { min: 5,  cls: 'pw-fair',   label: 'Acceptable',         color: '#f97316' },
        { min: 8,  cls: 'pw-good',   label: 'Bon',                color: '#eab308' },
        { min: 12, cls: 'pw-strong', label: 'Excellent',          color: '#22c55e' },
    ];

    function scorePassword(pw) {
        let score = 0;
        if (!pw) return 0;
        if (pw.length >= 8)  score += 2;
        if (pw.length >= 12) score += 2;
        if (/[A-Z]/.test(pw)) score += 2;
        if (/[0-9]/.test(pw)) score += 2;
        if (/[^A-Za-z0-9]/.test(pw)) score += 2;
        return Math.min(score, 10);
    }

    pwInput?.addEventListener('input', () => {
        const score = scorePassword(pwInput.value);
        const pct   = score * 10;
        const level = levels.filter(l => score >= l.min).pop();
        pwBar.style.width  = pct + '%';
        pwBar.style.background = level.color;
        pwHint.textContent = level.label;
        pwHint.style.color = level.color;
    });
</script>
@endpush
@endsection
