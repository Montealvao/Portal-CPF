@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">
            Bem-vindo, {{ auth()->user()->name }}
        </p>
    </div>
</div>

<div class="alert alert-info d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-info-circle-fill fs-5"></i>

    <div>
        <strong>Perfil Consultante:</strong>
        você possui acesso somente para consulta.
        Cadastros, edições e exclusões são restritos ao Administrador.
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-card--blue">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-value">
                {{ $totalPessoas }}
            </div>

            <div class="stat-label">
                Pessoas Cadastradas
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-card--green">
            <div class="stat-icon">
                <i class="bi bi-credit-card-2-front-fill"></i>
            </div>

            <div class="stat-value">
                {{ $totalCpfs }}
            </div>

            <div class="stat-label">
                CPFs Registrados
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-card--orange">
            <div class="stat-icon">
                <i class="bi bi-person-x-fill"></i>
            </div>

            <div class="stat-value">
                {{ $pessoasSemCpf }}
            </div>

            <div class="stat-label">
                Pessoas sem CPF
            </div>
        </div>
    </div>

</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card portal-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Últimos Cadastros
                </h5>

                <a href="{{ route('consultante.pessoas') }}"
                    class="btn btn-sm btn-outline-primary">
                    Ver todos
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Cadastro</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($ultimosCadastros as $pessoa)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $pessoa->nome }}
                                </td>

                                <td class="font-monospace text-muted">
                                    {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                                </td>

                                <td class="text-muted">
                                    {{ $pessoa->created_at?->format('d/m/Y') }}
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('consultante.ficha', $pessoa->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Nenhuma pessoa cadastrada.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-fill me-2 text-warning"></i>
                    Acesso Rápido
                </h5>
            </div>

            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('consultante.pessoas') }}"
                    class="btn btn-primary w-100 text-start">
                    <i class="bi bi-people-fill me-2"></i>
                    Consultar Pessoas
                </a>

                <a href="{{ route('consultante.buscar-cpf') }}"
                    class="btn btn-success w-100 text-start">
                    <i class="bi bi-search me-2"></i>
                    Pesquisar CPF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection