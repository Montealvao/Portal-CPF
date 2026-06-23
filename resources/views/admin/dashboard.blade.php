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
    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--blue">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value">{{ $totalPessoas ?? 248 }}</div>
            <div class="stat-label">Pessoas Cadastradas</div>
            <div class="stat-change text-success">
                <i class="bi bi-arrow-up-short"></i>+12 este mês
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--green">
            <div class="stat-icon"><i class="bi bi-credit-card-2-front-fill"></i></div>
            <div class="stat-value">{{ $totalCpfs ?? 1.432 }}</div>
            <div class="stat-label">CPFs Registrados</div>
            <div class="stat-change text-success">
                <i class="bi bi-arrow-up-short"></i>+38 este mês
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--orange">
            <div class="stat-icon"><i class="bi bi-search"></i></div>
            <div class="stat-value">{{ $consultasHoje ?? 57 }}</div>
            <div class="stat-label">Consultas Hoje</div>
            <div class="stat-change text-muted">
                <i class="bi bi-dash"></i>igual a ontem
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--red">
            <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
            <div class="stat-value">{{ $pendentes ?? 3 }}</div>
            <div class="stat-label">Registros Pendentes</div>
            <div class="stat-change text-danger">
                <i class="bi bi-arrow-up-short"></i>+1 hoje
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
                            @forelse($recentes ?? [] as $pessoa)
                            <tr>
                                <td class="fw-semibold">{{ $pessoa->nome }}</td>
                                <td class="text-muted font-monospace">{{ $pessoa->cpf }}</td>
                                <td class="text-muted">{{ $pessoa->created_at->format('d/m/Y') }}</td>
                                <td><span class="badge bg-success-subtle text-success">Ativo</span></td>
                                <td>
                                    <a href="{{ route('admin.pessoas.edit', $pessoa->id) }}"
                                       class="btn btn-sm btn-ghost">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            {{-- Dados de demonstração --}}
                            @foreach([
                                ['Carlos Alberto Souza','123.456.789-00','15/06/2025','Ativo'],
                                ['Maria Fernanda Lima','987.654.321-00','14/06/2025','Ativo'],
                                ['João Pedro Alves','456.123.789-11','14/06/2025','Pendente'],
                                ['Ana Clara Mendes','321.654.987-22','13/06/2025','Ativo'],
                                ['Roberto Santos','654.321.098-33','12/06/2025','Ativo'],
                            ] as $row)
                            <tr>
                                <td class="fw-semibold">{{ $row[0] }}</td>
                                <td class="text-muted font-monospace">{{ $row[1] }}</td>
                                <td class="text-muted">{{ $row[2] }}</td>
                                <td>
                                    <span class="badge {{ $row[3] === 'Ativo' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">
                                        {{ $row[3] }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-ghost">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
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
