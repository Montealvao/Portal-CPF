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
                        <th>Nome Completo</th>
                        <th>CPF Principal</th>
                        <th>Data de Nascimento</th>
                        <th>Cidade</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pessoas ?? [] as $pessoa)
                    <tr>
                        <td class="text-muted">{{ $pessoa->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle avatar-sm">
                                    {{ strtoupper(substr($pessoa->nome, 0, 1)) }}
                                </div>
                                <span class="fw-semibold">{{ $pessoa->nome }}</span>
                            </div>
                        </td>
                        <td class="font-monospace text-muted">{{ $pessoa->cpf_principal }}</td>
                        <td class="text-muted">{{ $pessoa->nascimento?->format('d/m/Y') }}</td>
                        <td class="text-muted">{{ $pessoa->cidade }}</td>
                        <td><span class="badge bg-success-subtle text-success">Ativo</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.pessoas.edit', $pessoa->id) }}"
                                   class="btn btn-sm btn-ghost" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="{{ route('admin.pessoas.delete', $pessoa->id) }}"
                                   class="btn btn-sm btn-ghost text-danger" title="Excluir">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    {{-- Dados de demonstração --}}
                    @php
                        $demo = [
                            [1,'Carlos Alberto Souza','123.456.789-00','12/03/1985','São Paulo','Ativo'],
                            [2,'Maria Fernanda Lima','987.654.321-00','28/07/1992','Rio de Janeiro','Ativo'],
                            [3,'João Pedro Alves','456.123.789-11','05/11/1978','Belo Horizonte','Pendente'],
                            [4,'Ana Clara Mendes','321.654.987-22','19/02/1995','Curitiba','Ativo'],
                            [5,'Roberto Santos','654.321.098-33','30/09/1969','Salvador','Ativo'],
                            [6,'Luciana Ferreira','147.258.369-44','14/06/1988','Fortaleza','Ativo'],
                            [7,'Marcos Vinicius Rocha','258.369.147-55','22/01/2001','Recife','Ativo'],
                        ];
                    @endphp
                    @foreach($demo as $row)
                    <tr>
                        <td class="text-muted">{{ $row[0] }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle avatar-sm">{{ substr($row[1],0,1) }}</div>
                                <span class="fw-semibold">{{ $row[1] }}</span>
                            </div>
                        </td>
                        <td class="font-monospace text-muted">{{ $row[2] }}</td>
                        <td class="text-muted">{{ $row[3] }}</td>
                        <td class="text-muted">{{ $row[4] }}</td>
                        <td>
                            <span class="badge {{ $row[5]==='Ativo' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">
                                {{ $row[5] }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn btn-sm btn-ghost" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn btn-sm btn-ghost text-danger" title="Excluir">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size:0.85rem;">
            Exibindo {{ $pessoas?->count() ?? 7 }} de {{ $pessoas?->total() ?? 248 }} registros
        </span>
        @if(isset($pessoas))
            {{ $pessoas->links() }}
        @else
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                </ul>
            </nav>
        @endif
    </div>
</div>
@endsection
