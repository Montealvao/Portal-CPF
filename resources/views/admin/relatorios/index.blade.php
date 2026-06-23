@extends('layouts.app')

@section('title', 'Relatórios')

@section('breadcrumb')
<li class="breadcrumb-item active">Relatórios</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Relatórios</h1>
        <p class="page-subtitle">
            Estatísticas gerais de Pessoas e CPFs
        </p>
    </div>
</div>

{{-- Cards de totais --}}
<div class="row g-4 mb-4">

    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--blue">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-value">
                {{ number_format($totalPessoas, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Pessoas Cadastradas
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--green">
            <div class="stat-icon">
                <i class="bi bi-credit-card-2-front-fill"></i>
            </div>

            <div class="stat-value">
                {{ number_format($totalCpfs, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                CPFs Registrados
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--orange">
            <div class="stat-icon">
                <i class="bi bi-person-check-fill"></i>
            </div>

            <div class="stat-value">
                {{ number_format($pessoasComCpf, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Pessoas com CPF
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card stat-card--red">
            <div class="stat-icon">
                <i class="bi bi-person-x-fill"></i>
            </div>

            <div class="stat-value">
                {{ number_format($pessoasSemCpf, 0, ',', '.') }}
            </div>

            <div class="stat-label">
                Pessoas sem CPF
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    {{-- Cadastros por mês --}}
    <div class="col-lg-8">
        <div class="card portal-card h-100">

            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart-fill me-2 text-primary"></i>
                    Cadastros de Pessoas por Mês - {{ $anoAtual }}
                </h5>
            </div>

            <div class="card-body">

                @php
                $maximo = max($cadastrosPorMes);
                @endphp

                <div class="chart-bars d-flex align-items-end gap-2">
                    @foreach($cadastrosPorMes as $mes => $total)

                    @php
                    $alturaBarra = $maximo > 0
                    ? round(($total / $maximo) * 160)
                    : 4;

                    $classeBarra = $total > 0
                    ? 'chart-bar--active'
                    : 'chart-bar--empty';
                    @endphp

                    <div class="d-flex flex-column align-items-center gap-1 flex-fill">

                        <span class="text-muted" style="font-size:0.7rem;font-weight:600;">
                            {{ $total > 0 ? $total : '' }}
                        </span>

                        <div
                            class="chart-bar w-100 rounded-top {{ $classeBarra }}"
                            @style([ 'height: ' . $alturaBarra . 'px' ,
                            ])>
                        </div>

                        <span class="text-muted" style="font-size:0.7rem;">
                            {{ $mes }}
                        </span>

                    </div>

                    @endforeach

                </div>

                @if(array_sum($cadastrosPorMes) === 0)
                <p class="text-center text-muted mt-3 mb-0">
                    Nenhum cadastro registrado em {{ $anoAtual }}.
                </p>
                @endif

            </div>

        </div>
    </div>

    {{-- Vínculo de CPFs --}}
    <div class="col-lg-4">
        <div class="card portal-card h-100">

            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pie-chart-fill me-2 text-primary"></i>
                    Vínculo de CPFs
                </h5>
            </div>

            <div class="card-body">

                @php
                $percentualComCpf = $totalPessoas > 0
                ? round(($pessoasComCpf / $totalPessoas) * 100)
                : 0;

                $percentualSemCpf = $totalPessoas > 0
                ? round(($pessoasSemCpf / $totalPessoas) * 100)
                : 0;
                @endphp

                <div class="d-flex flex-column gap-4">

                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold" style="font-size:0.85rem;">
                                Pessoas com CPF
                            </span>

                            <span class="text-muted" style="font-size:0.85rem;">
                                {{ $percentualComCpf }}%
                            </span>
                        </div>

                        <div class="progress  progress-thin">
                            <div
                                class="progress-bar bg-success"
                                @style([ 'width: ' . $percentualComCpf . '%' ,
                                ])>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold" style="font-size:0.85rem;">
                                Pessoas sem CPF
                            </span>

                            <span class="text-muted" style="font-size:0.85rem;">
                                {{ $percentualSemCpf }}%
                            </span>
                        </div>

                        <div class="progress  progress-thin">
                            <div
                                class="progress-bar bg-danger"
                                @style([ 'width: ' . $percentualSemCpf . '%' ,
                                ])>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- Últimas pessoas --}}
    <div class="col-lg-6">
        <div class="card portal-card h-100">

            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Últimas Pessoas Cadastradas
                </h5>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Cadastro</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($ultimasPessoas as $pessoa)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $pessoa->nome }}
                                </td>

                                <td class="font-monospace text-muted">
                                    {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                                </td>

                                <td class="text-muted" style="font-size:0.85rem;">
                                    {{ $pessoa->created_at?->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
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

    {{-- Últimos CPFs --}}
    <div class="col-lg-6">
        <div class="card portal-card h-100">

            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>
                    Últimos CPFs Cadastrados
                </h5>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>CPF</th>
                                <th>Pessoa</th>
                                <th>Cadastro</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($ultimosCpfs as $cpf)
                            <tr>
                                <td class="font-monospace fw-semibold">
                                    {{ $cpf->numero }}
                                </td>

                                <td>
                                    {{ $cpf->pessoa?->nome ?? 'Pessoa não vinculada' }}
                                </td>

                                <td class="text-muted" style="font-size:0.85rem;">
                                    {{ $cpf->created_at?->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    Nenhum CPF cadastrado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection