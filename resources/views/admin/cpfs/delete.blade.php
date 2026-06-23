@extends('layouts.app')

@section('title', 'Excluir CPF')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.cpfs.index') }}">CPFs</a></li>
    <li class="breadcrumb-item active">Excluir</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Excluir CPF</h1>
        <p class="page-subtitle">Confirme a exclusão do registro</p>
    </div>
    <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Voltar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card portal-card border-danger">
            <div class="card-header bg-danger-subtle border-danger">
                <h5 class="card-title mb-0 text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar Exclusão
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Esta ação é <strong>irreversível</strong>. O número de CPF será removido permanentemente.
                </div>

                <div class="delete-preview p-3 rounded mb-4" style="background:var(--bs-light);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded"
                             style="width:48px;height:48px;background:#fee2e2;color:#dc3545;font-size:1.4rem;">
                            <i class="bi bi-credit-card-2-front-fill"></i>
                        </div>
                        <div>
                            <p class="fw-bold fs-5 mb-0 font-monospace">{{ $cpf->numero }}</p>
                            <p class="text-muted mb-0">{{ $cpf->pessoa->nome ?? '—' }}</p>
                            <p class="text-muted mb-0" style="font-size:0.8rem;">
                                Emitido em {{ $cpf->emissao?->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.cpfs.destroy', $cpf->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="bi bi-trash3-fill me-2"></i>Sim, excluir permanentemente
                        </button>
                        <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">
                            Cancelar, manter registro
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
