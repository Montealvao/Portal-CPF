<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal CPF') — Sistema de Consulta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('portal.css') }}">
    @stack('styles')
</head>
<body class="portal-body">

    @if(isset($hideSidebar) && $hideSidebar)
        @yield('content')
    @else
        <div class="portal-wrapper">
            @include('components.sidebar')
            <main class="portal-main">
                <div class="portal-topbar">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-link text-muted p-0 sidebar-toggle d-lg-none" id="sidebarToggle">
                            <i class="bi bi-list fs-4"></i>
                        </button>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge-perfil badge {{ Session::get('perfil') === 'admin' ? 'badge-admin' : 'badge-consultante' }}">
                            <i class="bi {{ Session::get('perfil') === 'admin' ? 'bi-shield-fill' : 'bi-person-fill' }} me-1"></i>
                            {{ Session::get('perfil') === 'admin' ? 'Administrador' : 'Consultante' }}
                        </span>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-circle">
                                {{ strtoupper(substr(Session::get('nome', 'U'), 0, 1)) }}
                            </div>
                            <span class="fw-semibold text-sm d-none d-md-inline">{{ Session::get('nome', 'Usuário') }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-box-arrow-right me-1"></i> Sair
                            </button>
                        </form>
                    </div>
                </div>

                <div class="portal-content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.querySelector('.portal-sidebar').classList.toggle('open');
        });
    </script>
    @stack('scripts')
</body>
</html>
