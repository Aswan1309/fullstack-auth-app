@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')
<div class="dashboard-page">
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>

    {{-- Mobile Top Bar --}}
    <div class="mobile-topbar">
        <div class="mobile-topbar-logo">
            <span style="animation:spin-slow 8s linear infinite;display:inline-block">✦</span>
            Nexora
        </div>
        <button class="hamburger" onclick="openSidebar()">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Sidebar --}}
    <aside class="sidebar" id="main-sidebar">
        <div class="sidebar-logo">
            <span style="animation:spin-slow 8s linear infinite;display:inline-block">✦</span>
            Nexora
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" onclick="closeSidebar()"><span class="nav-ico">⊞</span> Tableau de bord</a>
            <a href="#" class="nav-item" onclick="closeSidebar()"><span class="nav-ico">♟</span> Projets</a>
            <a href="#" class="nav-item" onclick="closeSidebar()"><span class="nav-ico">✉</span> Messages</a>
            <a href="#" class="nav-item" onclick="closeSidebar()"><span class="nav-ico">◎</span> Analyses</a>
            <a href="#" class="nav-item" onclick="closeSidebar()"><span class="nav-ico">⚙</span> Paramètres</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="sidebar-user">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" class="user-avatar" alt="{{ $user->name }}" />
                @else
                    <div class="user-avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
                <div class="user-info">
                    <p class="user-name">{{ $user->name }}</p>
                    <p class="user-email">{{ $user->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <main class="dash-main">
        <div class="welcome-banner">
            <div class="welcome-text">
                @if($authAction === 'register' || $authAction === 'google')
                    <p class="welcome-eyebrow">🎉 Nouveau membre</p>
                    <h1 class="welcome-title">Bienvenue, <span class="welcome-name">{{ $user->first_name }}</span> !</h1>
                    <p class="welcome-sub">Votre compte est prêt. Découvrez tout ce que Nexora a à offrir.</p>
                @else
                    <p class="welcome-eyebrow">👋 Bon retour</p>
                    <h1 class="welcome-title">Welcome back, <span class="welcome-name">{{ $user->first_name }}</span> !</h1>
                    <p class="welcome-sub">Vous nous avez manqué. Voici où vous en étiez.</p>
                @endif
            </div>
            <div class="w-orb w1"></div>
            <div class="w-orb w2"></div>
        </div>

        <section class="stats-grid">
            <div class="stat-card"><p class="stat-label">Projets actifs</p><p class="stat-value">12</p><p class="stat-delta up">+2 ce mois</p></div>
            <div class="stat-card"><p class="stat-label">Messages</p><p class="stat-value">48</p><p class="stat-delta up">+7 non lus</p></div>
            <div class="stat-card"><p class="stat-label">Tâches</p><p class="stat-value">89%</p><p class="stat-delta up">+5% semaine</p></div>
            <div class="stat-card"><p class="stat-label">Collaborateurs</p><p class="stat-value">24</p><p class="stat-delta">Équipe active</p></div>
        </section>

        <section class="activity-section">
            <h2 class="section-title">Activité récente</h2>
            <div class="activity-list">
                @foreach([['🚀','Projet Alpha lancé','Il y a 2 heures'],['✅','Tâche #42 complétée','Il y a 5 heures'],['💬','Nouveau commentaire sur Dashboard v2','Hier'],['📊','Rapport mensuel généré','Il y a 2 jours']] as [$icon,$label,$time])
                <div class="activity-item">
                    <span class="activity-icon">{{ $icon }}</span>
                    <div><p class="activity-label">{{ $label }}</p><p class="activity-time">{{ $time }}</p></div>
                </div>
                @endforeach
            </div>
        </section>
    </main>
</div>
@endsection