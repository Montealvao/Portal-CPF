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
                    <button
                        class="btn btn-link text-muted p-0 sidebar-toggle"
                        id="sidebarToggle">

                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="portal-content">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')
        ?.addEventListener('click', function () {
            if (window.innerWidth <= 991) {
                document.querySelector('.portal-sidebar')
                    .classList.toggle('open');
            } else {
                document.querySelector('.portal-wrapper')
                    .classList.toggle('sidebar-collapsed');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>