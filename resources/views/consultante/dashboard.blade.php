@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Bem-vindo, {{ Session::get('nome', 'Consultante') }}</p>
    </div>
</div>

<div class="alert alert-info d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-info-circle-fill fs-5"></i>
    <div>
        <strong>Perfil Consultante:</strong> você possui acesso somente leitura.
        Para cadastrar ou editar registros, entre em contato com um Administrador.
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-card--blue">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value">248</div>
            <div class="stat-label">Pessoas Disponíveis</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-card--green">
            <div class="stat-icon"><i class="bi bi-credit-card-2-front-fill"></i></div>
            <div class="stat-value">1.432</div>
            <div class="stat-label">CPFs Registrados</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-card--orange">
            <div class="stat-icon"><i class="bi bi-search"></i></div>
            <div class="stat-value">{{ $minhasConsultas ?? 12 }}</div>
            <div class="stat-label">Minhas Consultas</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-card--green">
            <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
            <div class="stat-value">{{ $consultasHoje ?? 3 }}</div>
            <div class="stat-label">Consultas Hoje</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card portal-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Consultas Recentes
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>CPF Consultado</th>
                                <th>Titular</th>
                                <th>Data/Hora</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentes = [
                                    ['123.456.789-00','Carlos Alberto Souza','22/06/2025 14:20','Regular'],
                                    ['987.654.321-00','Maria Fernanda Lima','22/06/2025 11:05','Regular'],
                                    ['456.123.789-11','João Pedro Alves','21/06/2025 16:30','Pendente'],
                                ];
                            @endphp
                            @foreach($recentes as $r)
                            <tr>
                                <td class="font-monospace fw-semibold">{{ $r[0] }}</td>
                                <td>{{ $r[1] }}</td>
                                <td class="text-muted" style="font-size:0.85rem;">{{ $r[2] }}</td>
                                <td>
                                    <span class="badge {{ $r[3]==='Regular'?'bg-success-subtle text-success':'bg-warning-subtle text-warning' }}">
                                        {{ $r[3] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card portal-card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-fill me-2 text-warning"></i>Acesso Rápido
                </h5>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('consultante.pessoas') }}" class="btn btn-primary w-100 text-start">
                    <i class="bi bi-people-fill me-2"></i>Consultar Pessoas
                </a>
                <a href="{{ route('consultante.buscar-cpf') }}" class="btn btn-success w-100 text-start">
                    <i class="bi bi-search me-2"></i>Pesquisar CPF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
