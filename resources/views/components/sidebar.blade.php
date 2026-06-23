@php
$perfil = auth()->user()->perfil;
$currentRoute = Route::currentRouteName();

$isAdminPessoaIndex = in_array($currentRoute, [
'admin.pessoas.index',
'admin.pessoas.edit',
'admin.pessoas.delete',
]);

$isAdminPessoaCreate = $currentRoute === 'admin.pessoas.create';

$isAdminCpfIndex = in_array($currentRoute, [
'admin.cpfs.index',
'admin.cpfs.edit',
'admin.cpfs.delete',
]);

$isAdminCpfCreate = $currentRoute === 'admin.cpfs.create';
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

    <div class="sidebar-section-label">
        Menu Principal
    </div>

    @if($perfil === 'admin')

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <div class="sidebar-section-label mt-3">
            Pessoas
        </div>

        <a href="{{ route('admin.pessoas.index') }}"
            class="sidebar-link {{ $isAdminPessoaIndex ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Gerenciar Pessoas</span>
        </a>

        <a href="{{ route('admin.pessoas.create') }}"
            class="sidebar-link {{ $isAdminPessoaCreate ? 'active' : '' }}">
            <i class="bi bi-person-plus-fill"></i>
            <span>Cadastrar Pessoa</span>
        </a>

        <div class="sidebar-section-label mt-3">
            CPFs
        </div>

        <a href="{{ route('admin.cpfs.index') }}"
            class="sidebar-link {{ $isAdminCpfIndex ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front-fill"></i>
            <span>Gerenciar CPFs</span>
        </a>

        <a href="{{ route('admin.cpfs.create') }}"
            class="sidebar-link {{ $isAdminCpfCreate ? 'active' : '' }}">
            <i class="bi bi-plus-square-fill"></i>
            <span>Cadastrar CPF</span>
        </a>

        <div class="sidebar-section-label mt-3">
            Relatórios
        </div>

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

        <div class="sidebar-section-label mt-3">
            Consultas
        </div>

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
        <div class="d-flex align-items-center gap-2 mb-3">
            <div class="avatar-circle avatar-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="lh-sm">
                <div class="fw-semibold text-white" style="font-size:0.8rem;">
                    {{ auth()->user()->name }}
                </div>

                <div style="font-size:0.7rem;color:#94a3b8;">
                    {{ auth()->user()->perfil === 'admin'
                        ? 'Administrador'
                        : 'Consultante' }}
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                <i class="bi bi-box-arrow-right me-1"></i>
                <span>Sair</span>
            </button>
        </form>
    </div>
</aside>