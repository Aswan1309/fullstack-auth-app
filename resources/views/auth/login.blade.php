@extends('layouts.app')
@section('title', 'Connexion')

@section('content')
<div class="auth-page" id="login-page">

    {{-- ── Left panel – branding ─────────────────────── --}}
    <aside class="auth-panel">
        <div class="panel-inner">
            <div class="logo">
                <div class="logo-icon">✦</div>
                <span class="logo-text">Nexora</span>
            </div>
            <div class="panel-quote">
                <blockquote>"L'accès à l'excellence commence par un simple geste."</blockquote>
            </div>
            <div class="panel-orb orb-1"></div>
            <div class="panel-orb orb-2"></div>
            <div class="panel-orb orb-3"></div>
        </div>
    </aside>

    {{-- ── Right panel – form ────────────────────────── --}}
    <main class="auth-form-wrapper">
        <div class="auth-card" id="login-form-root">

            <div class="form-header">
                <p class="form-eyebrow">Bon retour</p>
                <h1 class="form-title">Connectez-vous</h1>
                <p class="form-subtitle">Ravi de vous revoir. Entrez vos identifiants ci-dessous.</p>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <span class="alert-icon">⚠</span>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Google button --}}
            <a href="{{ route('auth.google') }}" class="btn-google">
                <svg width="20" height="20" viewBox="0 0 48 48" fill="none">
                    <path d="M44.5 20H24v8.5h11.8C34.7 33.9 29.8 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 5.1 29.6 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.5 0 20-7.5 20-21 0-1.4-.2-2.7-.5-4z" fill="#FFC107"/>
                    <path d="M6.3 14.7l7 5.1C15.2 17.2 19.4 14 24 14c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 5.1 29.6 3 24 3c-7.6 0-14.2 4.2-17.7 10.7z" fill="#FF3D00"/>
                    <path d="M24 45c5.5 0 10.5-2 14.2-5.3l-6.6-5.5C29.7 35.9 27 37 24 37c-5.8 0-10.6-3.9-12.3-9.2l-7 5.4C8 39.6 15.4 45 24 45z" fill="#4CAF50"/>
                    <path d="M44.5 20H24v8.5h11.8c-.9 2.7-2.6 4.9-4.9 6.5l6.6 5.5C42 36.7 45 31.1 45 24c0-1.4-.2-2.7-.5-4z" fill="#1976D2"/>
                </svg>
                <span>Continuer avec Google</span>
            </a>

            <div class="divider"><span>ou</span></div>

            {{-- Login form --}}
            <form method="POST" action="{{ route('login.post') }}" class="auth-form" novalidate>
                @csrf

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
                    <label for="password" class="field-label">
                        Mot de passe
                        <a href="#" class="forgot-link">Oublié ?</a>
                    </label>
                    <div class="field-input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input {{ $errors->has('password') ? 'is-error' : '' }}"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        />
                        <span class="field-icon toggle-pw" data-target="password">👁</span>
                    </div>
                </div>

                <div class="field-check">
                    <label class="check-label">
                        <input type="checkbox" name="remember" />
                        <span class="check-box"></span>
                        Se souvenir de moi
                    </label>
                </div>

                <button type="submit" class="btn-primary">
                    <span>Se connecter</span>
                    <span class="btn-arrow">→</span>
                </button>
            </form>

            <p class="switch-auth">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Créer un compte</a>
            </p>
        </div>
    </main>
</div>
@endsection
