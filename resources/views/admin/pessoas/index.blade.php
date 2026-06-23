@extends('layouts.app')

@section('title', 'Gerenciar Pessoas')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pessoas</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Gerenciar Pessoas</h1>
        <p class="page-subtitle">Cadastre, edite ou remova registros</p>
    </div>
    <a href="{{ route('admin.pessoas.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-2"></i>Nova Pessoa
    </a>
</div>

<div class="card portal-card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.pessoas.index') }}" class="d-flex gap-2 flex-wrap">
            <div class="input-group" style="max-width:320px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="busca"
                       value="{{ request('busca') }}" placeholder="Buscar por nome ou CPF...">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            @if(request('busca'))
                <a href="{{ route('admin.pessoas.index') }}" class="btn btn-outline-secondary">Limpar</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->id }}</td>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle avatar-sm">
                                        {{ strtoupper(substr($pessoa->nome, 0, 1)) }}
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $pessoa->nome }}
                                    </span>
                                </div>
                            </td>

                            <td class="font-monospace">
                                {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                            </td>

                            <td>
                                {{ $pessoa->data_nascimento?->format('d/m/Y') }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.pessoas.edit', $pessoa->id) }}"
                                    class="btn btn-sm btn-ghost"
                                    title="Editar">

                                        <i class="bi bi-pencil-fill"></i>

                                    </a>

                                    <a href="{{ route('admin.pessoas.delete', $pessoa->id) }}"
                                    class="btn btn-sm btn-ghost text-danger"
                                    title="Excluir">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Nenhuma pessoa cadastrada.
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="text-muted small">
            Exibindo {{ $pessoas->count() }} de {{ $pessoas->total() }} registros
        </span>
        {{ $pessoas->links() }}
    </div>
</div>
@endsection
