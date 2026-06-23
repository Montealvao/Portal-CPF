@extends('layouts.app')

@section('title', 'Cadastrar CPF')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cpfs.index') }}">CPFs</a>
    </li>
    <li class="breadcrumb-item active">Cadastrar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Cadastrar CPF</h1>
        <p class="page-subtitle">Vincule um CPF a uma pessoa cadastrada</p>
    </div>

    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.cpfs.store') }}">
    @csrf

    <div class="row g-4 justify-content-center">
        <div class="col-lg-7">
            <div class="card portal-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>
                        Dados do CPF
                    </h5>
                </div>

                <div class="card-body">
                    @if($pessoas->isEmpty())

                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Não há pessoas disponíveis para vincular um CPF.

                            <div class="mt-2">
                                <a href="{{ route('admin.pessoas.create') }}"
                                   class="btn btn-sm btn-warning">
                                    Cadastrar Pessoa
                                </a>
                            </div>
                        </div>

                    @else
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="numero" class="form-label fw-semibold">
                                    Número do CPF <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       class="form-control font-monospace @error('numero') is-invalid @enderror"
                                       id="numero"
                                       name="numero"
                                       value="{{ old('numero') }}"
                                       placeholder="000.000.000-00"
                                       maxlength="14"
                                       required>

                                @error('numero')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pessoa_id" class="form-label fw-semibold">
                                    Pessoa vinculada <span class="text-danger">*</span>
                                </label>

                                <select class="form-select @error('pessoa_id') is-invalid @enderror"
                                        id="pessoa_id"
                                        name="pessoa_id"
                                        required>

                                    <option value="">
                                        Selecione uma pessoa...
                                    </option>

                                    @foreach($pessoas as $pessoa)
                                        <option value="{{ $pessoa->id }}"
                                            {{ old('pessoa_id') == $pessoa->id ? 'selected' : '' }}>

                                            {{ $pessoa->nome }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('pessoa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer d-flex gap-2">
                    @if($pessoas->isNotEmpty())
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>
                            Salvar CPF
                        </button>
                    @endif

                    <a href="{{ route('admin.cpfs.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection