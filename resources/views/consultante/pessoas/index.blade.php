@extends('layouts.app')

@section('title', 'Consultar Pessoas')

@section('breadcrumb')
<li class="breadcrumb-item active">Consultar Pessoas</li>
@endsection

@section('content')
<div class="page-header mb-4">
    <div>
        <h1 class="page-title">Consultar Pessoas</h1>
        <p class="page-subtitle">Visualize os registros cadastrados</p>
    </div>
</div>

<div class="card portal-card">
    <div class="card-header">
        <form method="GET"
            action="{{ route('consultante.pessoas') }}"
            class="d-flex gap-2 flex-wrap">

            <div class="input-group" style="max-width:360px;">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                    class="form-control"
                    name="busca"
                    value="{{ request('busca') }}"
                    placeholder="Buscar por nome ou CPF...">
            </div>

            <button type="submit" class="btn btn-primary">
                Buscar
            </button>

            @if(request('busca'))
            <a href="{{ route('consultante.pessoas') }}"
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
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pessoas as $pessoa)
                    <tr>
                        <td class="text-muted">
                            {{ $pessoa->id }}
                        </td>

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

                        <td class="text-muted">
                            {{ $pessoa->data_nascimento?->format('d/m/Y') }}
                        </td>

                        <td class="font-monospace text-muted">
                            {{ $pessoa->cpf?->numero ?? 'Não informado' }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('consultante.ficha', $pessoa->id) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>
                                Ver Ficha
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Nenhuma pessoa encontrada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="text-muted" style="font-size:0.85rem;">
            Exibindo {{ $pessoas->count() }} de {{ $pessoas->total() }} registros
        </span>

        <div>
            {{ $pessoas->links() }}
        </div>

    </div>
</div>
@endsection