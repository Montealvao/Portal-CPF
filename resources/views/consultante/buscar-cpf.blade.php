@extends('layouts.app')

@section('title', 'Pesquisar CPF')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pesquisar CPF</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Pesquisar CPF</h1>
        <p class="page-subtitle">Consulte informações pelo número de CPF</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">

        {{-- Formulário de busca --}}
        <div class="card portal-card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('consultante.buscar-cpf') }}">
                    <label for="cpf" class="form-label fw-semibold fs-6">
                        <i class="bi bi-search me-2 text-primary"></i>Número do CPF
                    </label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text"><i class="bi bi-credit-card-2-front-fill"></i></span>
                        <input type="text" class="form-control font-monospace" id="cpf" name="cpf"
                               value="{{ request('cpf') }}"
                               placeholder="000.000.000-00" maxlength="14" autofocus>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-search me-2"></i>Consultar
                        </button>
                    </div>
                    <small class="text-muted mt-1 d-block">Digite apenas números ou no formato 000.000.000-00</small>
                </form>
            </div>
        </div>

        {{-- Resultado --}}
        @if(request('cpf'))
            @if(isset($resultado) && $resultado)
            <div class="card portal-card border-success">
                <div class="card-header bg-success-subtle border-success">
                    <h5 class="card-title mb-0 text-success">
                        <i class="bi bi-check-circle-fill me-2"></i>CPF Encontrado
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">CPF</label>
                            <p class="fw-bold font-monospace fs-5">{{ $resultado->numero }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Situação</label>
                            <p>
                                <span class="badge bg-success fs-6 px-3">{{ ucfirst($resultado->situacao) }}</span>
                            </p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Titular</label>
                            <p class="fw-semibold fs-5">{{ $resultado->pessoa->nome }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Data de Emissão</label>
                            <p>{{ $resultado->emissao?->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Órgão Emissor</label>
                            <p>{{ $resultado->orgao_emissor }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('consultante.ficha', $resultado->pessoa->id) }}"
                           class="btn btn-outline-primary">
                            <i class="bi bi-person-lines-fill me-2"></i>Ver Ficha Completa
                        </a>
                    </div>
                </div>
            </div>
            @else
            {{-- Demo: CPF encontrado --}}
            @if(request('cpf') === '123.456.789-00' || request('cpf') === '12345678900')
            <div class="card portal-card border-success">
                <div class="card-header bg-success-subtle border-success">
                    <h5 class="card-title mb-0 text-success">
                        <i class="bi bi-check-circle-fill me-2"></i>CPF Encontrado
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">CPF</label>
                            <p class="fw-bold font-monospace fs-5">123.456.789-00</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Situação</label>
                            <p><span class="badge bg-success fs-6 px-3">Regular</span></p>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Titular</label>
                            <p class="fw-semibold fs-5">Carlos Alberto Souza</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Data de Emissão</label>
                            <p>10/01/2010</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.75rem;text-transform:uppercase;">Órgão Emissor</label>
                            <p>Receita Federal do Brasil</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-person-lines-fill me-2"></i>Ver Ficha Completa
                        </button>
                    </div>
                </div>
            </div>
            @else
            <div class="card portal-card border-danger">
                <div class="card-header bg-danger-subtle border-danger">
                    <h5 class="card-title mb-0 text-danger">
                        <i class="bi bi-x-circle-fill me-2"></i>CPF Não Encontrado
                    </h5>
                </div>
                <div class="card-body text-center py-4">
                    <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted">Nenhum registro encontrado para o CPF
                        <strong class="font-monospace">{{ request('cpf') }}</strong>.
                    </p>
                    <p class="text-muted mb-0" style="font-size:0.85rem;">
                        Verifique se o número foi digitado corretamente.
                    </p>
                </div>
            </div>
            @endif
            @endif
        @endif

    </div>
</div>
@endsection
