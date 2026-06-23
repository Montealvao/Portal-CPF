@extends('layouts.app')

@section('title', 'Excluir Pessoa')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('admin.pessoas.index') }}">Pessoas</a>
</li>
<li class="breadcrumb-item active">Excluir</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Excluir Pessoa</h1>
        <p class="page-subtitle">Confirme a exclusão do registro</p>
    </div>

    <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Voltar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card portal-card border-danger">
            <div class="card-header bg-danger-subtle border-danger">
                <h5 class="card-title mb-0 text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirmar Exclusão
                </h5>
            </div>

            <div class="card-body">
                <div class="alert alert-warning mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Esta ação é <strong>irreversível</strong>.

                    @if($pessoa->cpf)
                    O CPF vinculado a esta pessoa também será removido.
                    @else
                    Esta pessoa não possui CPF vinculado.
                    @endif
                </div>

                <div class="delete-preview p-3 rounded mb-4" style="background:var(--bs-light);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-circle avatar-lg text-danger" style="background:#fee2e2;">
                            {{ strtoupper(substr($pessoa->nome, 0, 1)) }}
                        </div>

                        <div>
                            <p class="fw-bold fs-5 mb-0">
                                {{ $pessoa->nome }}
                            </p>

                            <p class="text-muted mb-0 font-monospace">
                                CPF:
                                {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                            </p>

                            <p class="text-muted mb-0" style="font-size:0.8rem;">
                                Nascimento:
                                {{ $pessoa->data_nascimento?->format('d/m/Y') ?? 'Não informado' }}
                            </p>

                            <p class="text-muted mb-0" style="font-size:0.8rem;">
                                Cadastrado em {{ $pessoa->created_at?->format('d/m/Y') }}
                            </p>
                        </div>

                    </div>
                </div>

                <form method="POST" action="{{ route('admin.pessoas.destroy', $pessoa->id) }}">
                    @csrf
                    @method('DELETE')

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="bi bi-trash3-fill me-2"></i>
                            Sim, excluir pessoa
                        </button>

                        <a href="{{ route('admin.pessoas.index') }}"
                            class="btn btn-outline-secondary">
                            Cancelar, manter registro
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection