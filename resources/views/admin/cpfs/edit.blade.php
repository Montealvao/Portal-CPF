@extends('layouts.app')

@section('title', 'Editar CPF')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.cpfs.index') }}">CPFs</a>
</li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Editar CPF</h1>
        <p class="page-subtitle">Atualize o número do CPF #{{ $cpf->id }}</p>
    </div>

    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.cpfs.update', $cpf->id) }}">
    @csrf
    @method('PUT')

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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="numero" class="form-label fw-semibold">
                                Número do CPF <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                class="form-control font-monospace @error('numero') is-invalid @enderror"
                                id="numero"
                                name="numero"
                                value="{{ old('numero', $cpf->numero) }}"
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
                            <label class="form-label fw-semibold">
                                Pessoa vinculada
                            </label>

                            <div class="form-control bg-light">
                                {{ $cpf->pessoa?->nome ?? 'Pessoa não vinculada' }}
                            </div>

                            <small class="text-muted">
                                O vínculo é definido no cadastro do CPF.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>
                        Salvar Alterações
                    </button>

                    <a href="{{ route('admin.cpfs.delete', $cpf->id) }}"
                        class="btn btn-outline-danger">
                        <i class="bi bi-trash3 me-2"></i>
                        Excluir
                    </a>

                    <a href="{{ route('admin.cpfs.index') }}"
                        class="btn btn-outline-secondary ms-auto">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection