@extends('layouts.app')

@section('title', 'Editar Pessoa')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.pessoas.index') }}">Pessoas</a>
</li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Editar Pessoa</h1>
        <p class="page-subtitle">Atualize os dados do registro #{{ $pessoa->id }}</p>
    </div>

    <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.pessoas.update', $pessoa->id) }}">
    @csrf
    @method('PUT')

    <div class="row g-4 justify-content-center">
        <div class="col-lg-7">
            <div class="card portal-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-fill me-2 text-primary"></i>
                        Dados da Pessoa
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nome" class="form-label fw-semibold">
                                Nome Completo <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control @error('nome') is-invalid @enderror"
                                id="nome"
                                name="nome"
                                value="{{ old('nome', $pessoa->nome) }}"
                                maxlength="255"
                                required>

                            @error('nome')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="data_nascimento" class="form-label fw-semibold">
                                Data de Nascimento <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                class="form-control @error('data_nascimento') is-invalid @enderror"
                                id="data_nascimento"
                                name="data_nascimento"
                                value="{{ old('data_nascimento', optional($pessoa->data_nascimento)->format('Y-m-d')) }}"
                                required>

                            @error('data_nascimento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                CPF vinculado
                            </label>

                            <div class="form-control bg-light font-monospace">
                                {{ $pessoa->cpf?->numero ?? 'Nenhum CPF vinculado' }}
                            </div>

                            <small class="text-muted">
                                O CPF é gerenciado na tela de CPFs.
                            </small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted" style="font-size:0.8rem;">
                                Cadastrado em
                            </label>

                            <p class="mb-0">
                                {{ $pessoa->created_at?->format('d/m/Y H:i') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>
                        Salvar Alterações
                    </button>

                    <a href="{{ route('admin.pessoas.delete', $pessoa->id) }}"
                        class="btn btn-outline-danger">
                        <i class="bi bi-trash3 me-2"></i>
                        Excluir
                    </a>

                    <a href="{{ route('admin.pessoas.index') }}"
                        class="btn btn-outline-secondary ms-auto">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection