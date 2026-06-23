@php
    $perfil = Session::get('perfil', 'admin');
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="portal-sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-shield-check"></i>
        </div>
        <div>
            <div class="brand-title">Portal CPF</div>
            <div class="brand-subtitle">Sistema de Consulta</div>
        </div>
    </div>

    <div class="sidebar-section-label">Menu Principal</div>

    @if($perfil === 'admin')
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-label mt-3">Pessoas</div>

            <a href="{{ route('admin.pessoas.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute, 'admin.pessoas') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Gerenciar Pessoas</span>
            </a>
            <a href="{{ route('admin.pessoas.create') }}"
               class="sidebar-link {{ $currentRoute === 'admin.pessoas.create' ? 'active' : '' }}">
                <i class="bi bi-person-plus-fill"></i>
                <span>Cadastrar Pessoa</span>
            </a>

            <div class="sidebar-section-label mt-3">CPFs</div>

            <a href="{{ route('admin.cpfs.index') }}"
               class="sidebar-link {{ str_starts_with($currentRoute, 'admin.cpfs') ? 'active' : '' }}">
                <i class="bi bi-credit-card-2-front-fill"></i>
                <span>Gerenciar CPFs</span>
            </a>
            <a href="{{ route('admin.cpfs.create') }}"
               class="sidebar-link {{ $currentRoute === 'admin.cpfs.create' ? 'active' : '' }}">
                <i class="bi bi-plus-square-fill"></i>
                <span>Cadastrar CPF</span>
            </a>

            <div class="sidebar-section-label mt-3">Análises</div>

            <a href="{{ route('admin.relatorios') }}"
               class="sidebar-link {{ $currentRoute === 'admin.relatorios' ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Relatórios</span>
            </a>
        </nav>
    @else
        <nav class="sidebar-nav">
            <a href="{{ route('consultante.dashboard') }}"
               class="sidebar-link {{ $currentRoute === 'consultante.dashboard' ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-label mt-3">Consultas</div>

            <a href="{{ route('consultante.pessoas') }}"
               class="sidebar-link {{ $currentRoute === 'consultante.pessoas' ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Consultar Pessoas</span>
            </a>
            <a href="{{ route('consultante.buscar-cpf') }}"
               class="sidebar-link {{ $currentRoute === 'consultante.buscar-cpf' ? 'active' : '' }}">
                <i class="bi bi-search"></i>
                <span>Pesquisar CPF</span>
            </a>
        </nav>
    @endif

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2">
            <div class="avatar-circle avatar-sm">
                {{ strtoupper(substr(Session::get('nome', 'U'), 0, 1)) }}
            </div>
            <div class="lh-sm">
                <div class="fw-semibold text-white" style="font-size:0.8rem;">{{ Session::get('nome', 'Usuário') }}</div>
                <div style="font-size:0.7rem;color:#94a3b8;">
                    {{ $perfil === 'admin' ? 'Administrador' : 'Consultante' }}
                </div>
            </div>
        </div>
    </div>
</aside>
