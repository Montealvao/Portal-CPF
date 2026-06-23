@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Visão geral do sistema</p>
    </div>
    <div class="text-muted" style="font-size:0.85rem;">
        <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d/m/Y') }}
    </div>
</div>

{{-- Cards de estatísticas --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
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

    <div class="col-md-4">
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

    <div class="col-md-4">
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
    {{-- Cadastros recentes --}}
    <div class="col-lg-8">
        <div class="card portal-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Cadastros Recentes
                </h5>
                <a href="{{ route('admin.pessoas.index') }}" class="btn btn-sm btn-outline-primary">
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
                                <th>Data</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentes as $pessoa)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $pessoa->nome }}
                                </td>

                                <td class="text-muted font-monospace">
                                    {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                                </td>

                                <td class="text-muted">
                                    {{ $pessoa->created_at->format('d/m/Y') }}
                                </td>

                                <td>
                                    <span class="badge bg-success-subtle text-success">
                                        Ativo
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.pessoas.edit', $pessoa->id) }}"
                                        class="btn btn-sm btn-ghost">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Nenhum cadastro encontrado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Ações rápidas --}}
    <div class="col-lg-4">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-fill me-2 text-warning"></i>Ações Rápidas
                </h5>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('admin.pessoas.create') }}" class="btn btn-primary w-100 text-start">
                    <i class="bi bi-person-plus-fill me-2"></i>Nova Pessoa
                </a>
                <a href="{{ route('admin.cpfs.create') }}" class="btn btn-success w-100 text-start">
                    <i class="bi bi-plus-square-fill me-2"></i>Novo CPF
                </a>
                <a href="{{ route('admin.relatorios') }}" class="btn btn-info w-100 text-start text-white">
                    <i class="bi bi-bar-chart-fill me-2"></i>Ver Relatórios
                </a>
                <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary w-100 text-start">
                    <i class="bi bi-people-fill me-2"></i>Listar Pessoas
                </a>
                <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary w-100 text-start">
                    <i class="bi bi-credit-card-2-front-fill me-2"></i>Listar CPFs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection