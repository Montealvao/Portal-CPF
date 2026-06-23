@extends('layouts.app')

@section('title', 'Cadastrar Pessoa')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.pessoas.index') }}">Pessoas</a>
</li>
<li class="breadcrumb-item active">Cadastrar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Cadastrar Pessoa</h1>
        <p class="page-subtitle">Preencha os dados da nova pessoa</p>
    </div>

    <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.pessoas.store') }}">
    @csrf

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
                                value="{{ old('nome') }}"
                                placeholder="Ex: Carlos Alberto Souza"
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
                                value="{{ old('data_nascimento') }}"
                                required>

                            @error('data_nascimento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>
                        Salvar Pessoa
                    </button>

                    <a href="{{ route('admin.pessoas.index') }}"
                        class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection