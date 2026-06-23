@extends('layouts.app')

@section('title', 'Relatórios')

@section('breadcrumb')
    <li class="breadcrumb-item active">Relatórios</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Relatórios</h1>
        <p class="page-subtitle">Estatísticas e exportação de dados</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary">
            <i class="bi bi-file-earmark-excel me-2"></i>Exportar Excel
        </button>
        <button class="btn btn-outline-danger">
            <i class="bi bi-file-earmark-pdf me-2"></i>Exportar PDF
        </button>
    </div>
</div>

{{-- Totais --}}
<div class="row g-4 mb-4">
    @php
        $totais = [
            ['Pessoas Cadastradas', $totalPessoas ?? 248, 'bi-people-fill', 'stat-card--blue'],
            ['CPFs Registrados',    $totalCpfs ?? 1432,  'bi-credit-card-2-front-fill', 'stat-card--green'],
            ['CPFs Regulares',      $regulares ?? 1180,  'bi-check-circle-fill', 'stat-card--orange'],
            ['CPFs Suspensos',      $suspensos ?? 52,    'bi-x-circle-fill', 'stat-card--red'],
        ];
    @endphp
    @foreach($totais as $card)
    <div class="col-6 col-xl-3">
        <div class="stat-card {{ $card[3] }}">
            <div class="stat-icon"><i class="bi {{ $card[2] }}"></i></div>
            <div class="stat-value">{{ number_format($card[1], 0, ',', '.') }}</div>
            <div class="stat-label">{{ $card[0] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4">
    {{-- Cadastros por mês --}}
    <div class="col-lg-8">
        <div class="card portal-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Cadastros por Mês (2025)
                </h5>
            </div>
            <div class="card-body">
                @php
                    $meses = [
                        'Jan'=>32, 'Fev'=>28, 'Mar'=>45, 'Abr'=>38,
                        'Mai'=>52, 'Jun'=>61, 'Jul'=>0, 'Ago'=>0,
                        'Set'=>0, 'Out'=>0, 'Nov'=>0, 'Dez'=>0,
                    ];
                    $max = max($meses);
                @endphp
                <div class="chart-bars d-flex align-items-end gap-2" style="height:200px;">
                    @foreach($meses as $mes => $val)
                    <div class="d-flex flex-column align-items-center gap-1 flex-fill">
                        <span class="text-muted" style="font-size:0.7rem;font-weight:600;">
                            {{ $val > 0 ? $val : '' }}
                        </span>
                        <div class="chart-bar w-100 rounded-top"
                             style="height:{{ $max > 0 ? round(($val/$max)*160) : 4 }}px;
                                    background:{{ $val > 0 ? 'var(--portal-primary)' : '#e2e8f0' }};
                                    min-height:4px;transition:height .3s;">
                        </div>
                        <span class="text-muted" style="font-size:0.7rem;">{{ $mes }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Distribuição por situação --}}
    <div class="col-lg-4">
        <div class="card portal-card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pie-chart-fill me-2 text-primary"></i>Situação dos CPFs
                </h5>
            </div>
            <div class="card-body">
                @php
                    $situacoes = [
                        ['Regular',   82, 'bg-success'],
                        ['Pendente',  10, 'bg-warning'],
                        ['Suspenso',  4,  'bg-danger'],
                        ['Cancelado', 4,  'bg-secondary'],
                    ];
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach($situacoes as $sit)
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold" style="font-size:0.85rem;">{{ $sit[0] }}</span>
                            <span class="text-muted" style="font-size:0.85rem;">{{ $sit[1] }}%</span>
                        </div>
                        <div class="progress" style="height:8px;">
                            <div class="progress-bar {{ $sit[2] }}" style="width:{{ $sit[1] }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Últimas atividades --}}
    <div class="col-12">
        <div class="card portal-card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-activity me-2 text-primary"></i>Últimas Atividades
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ação</th>
                                <th>Registro</th>
                                <th>Usuário</th>
                                <th>Data/Hora</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $atividades = [
                                    ['Novo cadastro','Carlos Alberto Souza','admin','22/06/2025 14:32','Pessoa'],
                                    ['CPF atualizado','987.654.321-00','admin','22/06/2025 13:15','CPF'],
                                    ['Registro excluído','Teste Remoção','admin','22/06/2025 11:48','Pessoa'],
                                    ['Nova consulta','456.123.789-11','consultante','22/06/2025 10:22','Consulta'],
                                    ['CPF suspenso','654.321.098-33','admin','21/06/2025 16:55','CPF'],
                                ];
                            @endphp
                            @foreach($atividades as $a)
                            <tr>
                                <td class="fw-semibold">{{ $a[0] }}</td>
                                <td class="text-muted">{{ $a[1] }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">{{ $a[2] }}</span>
                                </td>
                                <td class="text-muted" style="font-size:0.85rem;">{{ $a[3] }}</td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary">{{ $a[4] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
