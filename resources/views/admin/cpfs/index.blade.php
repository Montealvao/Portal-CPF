@extends('layouts.app')

@section('title', 'Gerenciar CPFs')

@section('breadcrumb')
<li class="breadcrumb-item active">CPFs</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Gerenciar CPFs</h1>
        <p class="page-subtitle">Registros de CPF e vínculos com pessoas</p>
    </div>

    <a href="{{ route('admin.cpfs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-square-fill me-2"></i>
        Novo CPF
    </a>
</div>

<div class="card portal-card">
    <div class="card-header">
        <form method="GET"
            action="{{ route('admin.cpfs.index') }}"
            class="d-flex gap-2 flex-wrap">

            <div class="input-group" style="max-width:360px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                    class="form-control"
                    name="busca"
                    value="{{ request('busca') }}"
                    placeholder="Buscar por CPF ou nome da pessoa...">
            </div>

            <button type="submit" class="btn btn-primary">
                Buscar
            </button>

            @if(request('busca'))
            <a href="{{ route('admin.cpfs.index') }}"
                class="btn btn-outline-secondary">
                Limpar
            </a>
            @endif

        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Número CPF</th>
                        <th>Pessoa Vinculada</th>
                        <th>Data de Cadastro</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cpfs as $cpf)

                    <tr>
                        <td class="text-muted">
                            {{ $cpf->id }}
                        </td>

                        <td class="font-monospace fw-semibold">
                            {{ $cpf->numero }}
                        </td>

                        <td>
                            @if($cpf->pessoa)
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle avatar-sm">
                                    {{ strtoupper(substr($cpf->pessoa->nome, 0, 1)) }}
                                </div>

                                <span class="fw-semibold">
                                    {{ $cpf->pessoa->nome }}
                                </span>
                            </div>
                            @else
                            <span class="text-muted">
                                Pessoa não vinculada
                            </span>
                            @endif
                        </td>

                        <td class="text-muted">
                            {{ $cpf->created_at?->format('d/m/Y') }}
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.cpfs.edit', $cpf->id) }}"
                                    class="btn btn-sm btn-ghost"
                                    title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                <a href="{{ route('admin.cpfs.delete', $cpf->id) }}"
                                    class="btn btn-sm btn-ghost text-danger"
                                    title="Excluir">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5"
                            class="text-center py-4 text-muted">
                            Nenhum CPF cadastrado.
                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="text-muted" style="font-size:0.85rem;">
            Exibindo {{ $cpfs->count() }} de {{ $cpfs->total() }} registros
        </span>

        <div>
            {{ $cpfs->links() }}
        </div>
    </div>
</div>
@endsection