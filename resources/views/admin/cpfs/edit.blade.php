@extends('layouts.app')

@section('title', 'Editar CPF')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.cpfs.index') }}">CPFs</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Editar CPF</h1>
        <p class="page-subtitle">Atualize os dados do registro #{{ $cpf->id }}</p>
    </div>
    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
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
                        <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>Dados do CPF
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label for="numero" class="form-label fw-semibold">Número do CPF</label>
                            <input type="text" class="form-control font-monospace"
                                   id="numero" name="numero"
                                   value="{{ old('numero', $cpf->numero) }}" maxlength="14">
                        </div>

                        <div class="col-md-5">
                            <label for="situacao" class="form-label fw-semibold">Situação</label>
                            <select class="form-select" id="situacao" name="situacao">
                                <option value="regular" {{ old('situacao',$cpf->situacao)==='regular'?'selected':'' }}>Regular</option>
                                <option value="pendente" {{ old('situacao',$cpf->situacao)==='pendente'?'selected':'' }}>Pendente</option>
                                <option value="suspenso" {{ old('situacao',$cpf->situacao)==='suspenso'?'selected':'' }}>Suspenso</option>
                                <option value="cancelado" {{ old('situacao',$cpf->situacao)==='cancelado'?'selected':'' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="pessoa_id" class="form-label fw-semibold">Titular</label>
                            <select class="form-select" id="pessoa_id" name="pessoa_id">
                                @foreach($pessoas ?? [] as $p)
                                    <option value="{{ $p->id }}" {{ old('pessoa_id',$cpf->pessoa_id)==$p->id?'selected':'' }}>
                                        {{ $p->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="emissao" class="form-label fw-semibold">Data de Emissão</label>
                            <input type="date" class="form-control" id="emissao" name="emissao"
                                   value="{{ old('emissao', $cpf->emissao?->format('Y-m-d')) }}">
                        </div>

                        <div class="col-12">
                            <label for="orgao_emissor" class="form-label fw-semibold">Órgão Emissor</label>
                            <input type="text" class="form-control" id="orgao_emissor" name="orgao_emissor"
                                   value="{{ old('orgao_emissor', $cpf->orgao_emissor) }}">
                        </div>

                        <div class="col-12">
                            <label for="observacoes" class="form-label fw-semibold">Observações</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $cpf->observacoes) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>Salvar Alterações
                    </button>
                    <a href="{{ route('admin.cpfs.delete', $cpf->id) }}"
                       class="btn btn-outline-danger">
                        <i class="bi bi-trash3 me-2"></i>Excluir
                    </a>
                    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary ms-auto">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
