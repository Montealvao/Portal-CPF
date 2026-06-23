@extends('layouts.app')

@section('title', 'Cadastrar CPF')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.cpfs.index') }}">CPFs</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Cadastrar CPF</h1>
        <p class="page-subtitle">Registre um novo número de CPF</p>
    </div>
    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

<form method="POST" action="{{ route('admin.cpfs.store') }}">
    @csrf
    <div class="row g-4 justify-content-center">
        <div class="col-lg-7">
            <div class="card portal-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>Dados do CPF
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label for="numero" class="form-label fw-semibold">
                                Número do CPF <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control font-monospace @error('numero') is-invalid @enderror"
                                   id="numero" name="numero" value="{{ old('numero') }}"
                                   placeholder="000.000.000-00" maxlength="14" required>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="situacao" class="form-label fw-semibold">Situação</label>
                            <select class="form-select @error('situacao') is-invalid @enderror"
                                    id="situacao" name="situacao">
                                <option value="regular" {{ old('situacao','regular')==='regular'?'selected':'' }}>Regular</option>
                                <option value="pendente" {{ old('situacao')==='pendente'?'selected':'' }}>Pendente</option>
                                <option value="suspenso" {{ old('situacao')==='suspenso'?'selected':'' }}>Suspenso</option>
                                <option value="cancelado" {{ old('situacao')==='cancelado'?'selected':'' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="pessoa_id" class="form-label fw-semibold">
                                Titular <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('pessoa_id') is-invalid @enderror"
                                    id="pessoa_id" name="pessoa_id" required>
                                <option value="">Selecione o titular...</option>
                                @foreach($pessoas ?? [] as $p)
                                    <option value="{{ $p->id }}" {{ old('pessoa_id')==$p->id?'selected':'' }}>
                                        {{ $p->nome }}
                                    </option>
                                @endforeach
                                @if(empty($pessoas))
                                    <option value="1">Carlos Alberto Souza</option>
                                    <option value="2">Maria Fernanda Lima</option>
                                    <option value="3">João Pedro Alves</option>
                                @endif
                            </select>
                            @error('pessoa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="emissao" class="form-label fw-semibold">Data de Emissão</label>
                            <input type="date" class="form-control" id="emissao" name="emissao"
                                   value="{{ old('emissao') }}">
                        </div>

                        <div class="col-12">
                            <label for="orgao_emissor" class="form-label fw-semibold">Órgão Emissor</label>
                            <input type="text" class="form-control" id="orgao_emissor" name="orgao_emissor"
                                   value="{{ old('orgao_emissor', 'Receita Federal do Brasil') }}">
                        </div>

                        <div class="col-12">
                            <label for="observacoes" class="form-label fw-semibold">Observações</label>
                            <textarea class="form-control" id="observacoes" name="observacoes"
                                      rows="3" placeholder="Informações adicionais...">{{ old('observacoes') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>Salvar CPF
                    </button>
                    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
