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
        <i class="bi bi-plus-square-fill me-2"></i>Novo CPF
    </a>
</div>

<div class="card portal-card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.cpfs.index') }}" class="d-flex gap-2 flex-wrap">
            <div class="input-group" style="max-width:320px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="busca"
                       value="{{ request('busca') }}" placeholder="Buscar CPF ou titular...">
            </div>
            <select class="form-select" name="situacao" style="max-width:160px;">
                <option value="">Todos os status</option>
                <option value="regular" {{ request('situacao')==='regular'?'selected':'' }}>Regular</option>
                <option value="pendente" {{ request('situacao')==='pendente'?'selected':'' }}>Pendente</option>
                <option value="suspenso" {{ request('situacao')==='suspenso'?'selected':'' }}>Suspenso</option>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            @if(request()->hasAny(['busca','situacao']))
                <a href="{{ route('admin.cpfs.index') }}" class="btn btn-outline-secondary">Limpar</a>
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
                        <th>Titular</th>
                        <th>Data de Emissão</th>
                        <th>Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cpfs ?? [] as $cpf)
                    <tr>
                        <td class="text-muted">{{ $cpf->id }}</td>
                        <td class="font-monospace fw-semibold">{{ $cpf->numero }}</td>
                        <td>{{ $cpf->pessoa->nome ?? '—' }}</td>
                        <td class="text-muted">{{ $cpf->emissao?->format('d/m/Y') }}</td>
                        <td>
                            @php $s = $cpf->situacao; @endphp
                            <span class="badge {{ $s==='regular'?'bg-success-subtle text-success':($s==='pendente'?'bg-warning-subtle text-warning':'bg-danger-subtle text-danger') }}">
                                {{ ucfirst($s) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.cpfs.edit', $cpf->id) }}"
                                   class="btn btn-sm btn-ghost" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="{{ route('admin.cpfs.delete', $cpf->id) }}"
                                   class="btn btn-sm btn-ghost text-danger" title="Excluir">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    @php
                        $demo = [
                            [1,'123.456.789-00','Carlos Alberto Souza','10/01/2010','regular'],
                            [2,'987.654.321-00','Maria Fernanda Lima','22/03/2015','regular'],
                            [3,'456.123.789-11','João Pedro Alves','05/07/2008','pendente'],
                            [4,'321.654.987-22','Ana Clara Mendes','18/11/2019','regular'],
                            [5,'654.321.098-33','Roberto Santos','30/04/2002','suspenso'],
                            [6,'147.258.369-44','Luciana Ferreira','14/09/2017','regular'],
                            [7,'258.369.147-55','Marcos Vinicius Rocha','01/02/2021','regular'],
                        ];
                    @endphp
                    @foreach($demo as $row)
                    <tr>
                        <td class="text-muted">{{ $row[0] }}</td>
                        <td class="font-monospace fw-semibold">{{ $row[1] }}</td>
                        <td>{{ $row[2] }}</td>
                        <td class="text-muted">{{ $row[3] }}</td>
                        <td>
                            <span class="badge {{ $row[4]==='regular'?'bg-success-subtle text-success':($row[4]==='pendente'?'bg-warning-subtle text-warning':'bg-danger-subtle text-danger') }}">
                                {{ ucfirst($row[4]) }}
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
            Exibindo {{ $cpfs?->count() ?? 7 }} de {{ $cpfs?->total() ?? 1432 }} registros
        </span>
        @if(isset($cpfs))
            {{ $cpfs->links() }}
        @else
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                </ul>
            </nav>
        @endif
    </div>
</div>
@endsection
