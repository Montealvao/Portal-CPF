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
        <form method="GET" action="{{ route('consultante.pessoas') }}" class="d-flex gap-2 flex-wrap">
            <div class="input-group" style="max-width:320px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="busca"
                       value="{{ request('busca') }}" placeholder="Buscar por nome...">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            @if(request('busca'))
                <a href="{{ route('consultante.pessoas') }}" class="btn btn-outline-secondary">Limpar</a>
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
                        <th>Cidade / UF</th>
                        <th>CPFs Vinculados</th>
                        <th class="text-center">Ação</th>
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
                        <td class="text-muted">{{ $pessoa->cidade }}/{{ $pessoa->uf }}</td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary">
                                {{ $pessoa->cpfs_count ?? 0 }} CPF(s)
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('consultante.ficha', $pessoa->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Ver Ficha
                            </a>
                        </td>
                    </tr>
                    @empty
                    @php
                        $demo = [
                            [1,'Carlos Alberto Souza','São Paulo/SP',2],
                            [2,'Maria Fernanda Lima','Rio de Janeiro/RJ',1],
                            [3,'João Pedro Alves','Belo Horizonte/MG',3],
                            [4,'Ana Clara Mendes','Curitiba/PR',1],
                            [5,'Roberto Santos','Salvador/BA',2],
                            [6,'Luciana Ferreira','Fortaleza/CE',1],
                            [7,'Marcos Vinicius Rocha','Recife/PE',1],
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
                        <td class="text-muted">{{ $row[2] }}</td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary">{{ $row[3] }} CPF(s)</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Ver Ficha
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size:0.85rem;">248 registros encontrados</span>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
