@extends('layouts.app')

@section('title', 'Ficha de Consulta')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('consultante.pessoas') }}">Pessoas</a>
</li>
<li class="breadcrumb-item active">Ficha</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Ficha de Consulta</h1>
        <p class="page-subtitle">Detalhes do registro selecionado</p>
    </div>

    <a href="{{ route('consultante.pessoas') }}"
        class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<div class="card portal-card mb-4" style="overflow:hidden;">
    <div class="ficha-header p-4"
        style="background:linear-gradient(135deg,var(--portal-primary) 0%,var(--portal-secondary) 100%);">

        <div class="d-flex align-items-center gap-4">
            <div class="avatar-circle avatar-xl"
                style="font-size:2rem;background:rgba(255,255,255,0.2);color:#fff;border:3px solid rgba(255,255,255,0.4);">
                {{ strtoupper(substr($pessoa->nome, 0, 1)) }}
            </div>

            <div class="text-white">
                <h2 class="mb-1 fw-bold">
                    {{ $pessoa->nome }}
                </h2>

                <div class="d-flex flex-wrap gap-3" style="opacity:0.85;font-size:0.9rem;">
                    <span>
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $pessoa->data_nascimento?->format('d/m/Y') }}
                    </span>

                    <span>
                        <i class="bi bi-credit-card-2-front-fill me-1"></i>
                        {{ $pessoa->cpf?->numero ?? 'CPF não informado' }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-fill me-2 text-primary"></i>
                    Dados da Pessoa
                </h5>
            </div>

            <div class="card-body">
                <dl class="row g-2 mb-0">
                    <dt class="col-5 text-muted fw-normal text-uppercase small">
                        Nome
                    </dt>
                    <dd class="col-7 fw-semibold">
                        {{ $pessoa->nome }}
                    </dd>

                    <dt class="col-5 text-muted fw-normal text-uppercase small">
                        Nascimento
                    </dt>
                    <dd class="col-7">
                        {{ $pessoa->data_nascimento?->format('d/m/Y') }}
                    </dd>

                    <dt class="col-5 text-muted fw-normal text-uppercase small">
                        Cadastrado em
                    </dt>
                    <dd class="col-7">
                        {{ $pessoa->created_at?->format('d/m/Y H:i') }}
                    </dd>

                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>
                    CPF Vinculado
                </h5>
            </div>

            <div class="card-body">
                @if($pessoa->cpf)
                <dl class="row g-2 mb-0">

                    <dt class="col-5 text-muted fw-normal text-uppercase small">
                        Número
                    </dt>
                    <dd class="col-7 fw-semibold font-monospace">
                        {{ $pessoa->cpf->numero }}
                    </dd>

                    <dt class="col-5 text-muted fw-normal text-uppercase small">
                        Cadastrado em
                    </dt>
                    <dd class="col-7">
                        {{ $pessoa->cpf->created_at?->format('d/m/Y H:i') }}
                    </dd>

                </dl>

                @else

                <div class="text-muted">
                    Esta pessoa ainda não possui CPF vinculado.
                </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection