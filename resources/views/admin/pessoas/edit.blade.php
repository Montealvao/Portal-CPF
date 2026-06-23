@extends('layouts.app')

@section('title', 'Editar Pessoa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.pessoas.index') }}">Pessoas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Editar Pessoa</h1>
        <p class="page-subtitle">Atualize os dados do registro #{{ $pessoa->id }}</p>
    </div>
    <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.pessoas.update', $pessoa->id) }}">
    @csrf
    @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card portal-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-fill me-2 text-primary"></i>Dados Pessoais
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nome" class="form-label fw-semibold">Nome Completo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                   id="nome" name="nome"
                                   value="{{ old('nome', $pessoa->nome) }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nascimento" class="form-label fw-semibold">Data de Nascimento</label>
                            <input type="date" class="form-control"
                                   id="nascimento" name="nascimento"
                                   value="{{ old('nascimento', $pessoa->nascimento?->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="sexo" class="form-label fw-semibold">Sexo</label>
                            <select class="form-select" id="sexo" name="sexo">
                                <option value="">Selecione...</option>
                                <option value="M" {{ old('sexo',$pessoa->sexo) === 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo',$pessoa->sexo) === 'F' ? 'selected' : '' }}>Feminino</option>
                                <option value="O" {{ old('sexo',$pessoa->sexo) === 'O' ? 'selected' : '' }}>Outro</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" class="form-control"
                                   id="email" name="email"
                                   value="{{ old('email', $pessoa->email) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label fw-semibold">Telefone</label>
                            <input type="text" class="form-control"
                                   id="telefone" name="telefone"
                                   value="{{ old('telefone', $pessoa->telefone) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card portal-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Endereço
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="cep" class="form-label fw-semibold">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep"
                                   value="{{ old('cep', $pessoa->cep) }}">
                        </div>
                        <div class="col-md-8">
                            <label for="endereco" class="form-label fw-semibold">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco"
                                   value="{{ old('endereco', $pessoa->endereco) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="cidade" class="form-label fw-semibold">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade"
                                   value="{{ old('cidade', $pessoa->cidade) }}">
                        </div>
                        <div class="col-md-2">
                            <label for="uf" class="form-label fw-semibold">UF</label>
                            <select class="form-select" id="uf" name="uf">
                                <option value="">—</option>
                                @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf)
                                    <option value="{{ $uf }}" {{ old('uf',$pessoa->uf) === $uf ? 'selected' : '' }}>{{ $uf }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card portal-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle-fill me-2 text-primary"></i>Informações
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted" style="font-size:0.8rem;">ID</label>
                        <p class="fw-bold mb-0">#{{ $pessoa->id }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted" style="font-size:0.8rem;">Cadastrado em</label>
                        <p class="mb-0">{{ $pessoa->created_at?->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="ativo" {{ old('status',$pessoa->status) === 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="pendente" {{ old('status',$pessoa->status) === 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="inativo" {{ old('status',$pessoa->status) === 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label for="observacoes" class="form-label fw-semibold">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $pessoa->observacoes) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-lg me-2"></i>Salvar Alterações
                </button>
                <a href="{{ route('admin.pessoas.delete', $pessoa->id) }}"
                   class="btn btn-outline-danger">
                    <i class="bi bi-trash3 me-2"></i>Excluir Registro
                </a>
                <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
