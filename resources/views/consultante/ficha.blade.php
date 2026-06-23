@extends('layouts.app')

@section('title', 'Ficha de Consulta')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('consultante.pessoas') }}">Pessoas</a></li>
    <li class="breadcrumb-item active">Ficha</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Ficha de Consulta</h1>
        <p class="page-subtitle">Detalhes completos do registro</p>
    </div>
    <a href="{{ route('consultante.pessoas') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

@php
    $p = $pessoa ?? (object)[
        'nome'        => 'Carlos Alberto Souza',
        'nascimento'  => '12/03/1985',
        'sexo'        => 'Masculino',
        'email'       => 'carlos.souza@email.com',
        'telefone'    => '(11) 98765-4321',
        'endereco'    => 'Rua das Flores, 123 — Centro',
        'cidade'      => 'São Paulo',
        'uf'          => 'SP',
        'cep'         => '01310-100',
        'status'      => 'Ativo',
    ];
    $cpfs = $pessoa->cpfs ?? [
        (object)['numero'=>'123.456.789-00','situacao'=>'regular','emissao'=>'10/01/2010','orgao_emissor'=>'Receita Federal'],
        (object)['numero'=>'987.654.321-00','situacao'=>'suspenso','emissao'=>'22/05/2018','orgao_emissor'=>'Receita Federal'],
    ];
@endphp

{{-- Cabeçalho da ficha --}}
<div class="card portal-card mb-4" style="overflow:hidden;">
    <div class="ficha-header p-4" style="background:linear-gradient(135deg,var(--portal-primary) 0%,var(--portal-secondary) 100%);">
        <div class="d-flex align-items-center gap-4">
            <div class="avatar-circle avatar-xl" style="font-size:2rem;background:rgba(255,255,255,0.2);color:#fff;border:3px solid rgba(255,255,255,0.4);">
                {{ strtoupper(substr($p->nome ?? 'C', 0, 1)) }}
            </div>
            <div class="text-white">
                <h2 class="mb-1 fw-bold">{{ $p->nome }}</h2>
                <div class="d-flex flex-wrap gap-3" style="opacity:0.85;font-size:0.9rem;">
                    @if(isset($p->nascimento))
                    <span><i class="bi bi-calendar3 me-1"></i>
                        {{ is_string($p->nascimento) ? $p->nascimento : $p->nascimento->format('d/m/Y') }}
                    </span>
                    @endif
                    @if(isset($p->cidade))
                    <span><i class="bi bi-geo-alt-fill me-1"></i>{{ $p->cidade }}/{{ $p->uf }}</span>
                    @endif
                    <span>
                        <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;vertical-align:middle;color:#4ade80;"></i>
                        {{ $p->status ?? 'Ativo' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Dados pessoais --}}
    <div class="col-lg-6">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-fill me-2 text-primary"></i>Dados Pessoais
                </h5>
            </div>
            <div class="card-body">
                <dl class="row g-2 mb-0">
                    <dt class="col-5 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Nome</dt>
                    <dd class="col-7 fw-semibold">{{ $p->nome }}</dd>

                    <dt class="col-5 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Nascimento</dt>
                    <dd class="col-7">{{ is_string($p->nascimento ?? '') ? $p->nascimento : ($p->nascimento?->format('d/m/Y') ?? '—') }}</dd>

                    <dt class="col-5 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Sexo</dt>
                    <dd class="col-7">{{ $p->sexo ?? '—' }}</dd>

                    <dt class="col-5 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">E-mail</dt>
                    <dd class="col-7">{{ $p->email ?? '—' }}</dd>

                    <dt class="col-5 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Telefone</dt>
                    <dd class="col-7">{{ $p->telefone ?? '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>

    {{-- Endereço --}}
    <div class="col-lg-6">
        <div class="card portal-card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Endereço
                </h5>
            </div>
            <div class="card-body">
                <dl class="row g-2 mb-0">
                    <dt class="col-4 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Endereço</dt>
                    <dd class="col-8">{{ $p->endereco ?? '—' }}</dd>

                    <dt class="col-4 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">Cidade</dt>
                    <dd class="col-8">{{ $p->cidade ?? '—' }}</dd>

                    <dt class="col-4 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">UF</dt>
                    <dd class="col-8">{{ $p->uf ?? '—' }}</dd>

                    <dt class="col-4 text-muted fw-normal" style="font-size:0.8rem;text-transform:uppercase;">CEP</dt>
                    <dd class="col-8">{{ $p->cep ?? '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>

    {{-- CPFs vinculados --}}
    <div class="col-12">
        <div class="card portal-card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>CPFs Vinculados
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Número</th>
                                <th>Situação</th>
                                <th>Data de Emissão</th>
                                <th>Órgão Emissor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cpfs as $cpf)
                            <tr>
                                <td class="font-monospace fw-semibold">{{ $cpf->numero }}</td>
                                <td>
                                    @php $s = $cpf->situacao; @endphp
                                    <span class="badge {{ $s==='regular'?'bg-success-subtle text-success':($s==='pendente'?'bg-warning-subtle text-warning':'bg-danger-subtle text-danger') }}">
                                        {{ ucfirst($s) }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ is_string($cpf->emissao ?? '') ? $cpf->emissao : ($cpf->emissao?->format('d/m/Y') ?? '—') }}</td>
                                <td class="text-muted">{{ $cpf->orgao_emissor }}</td>
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
