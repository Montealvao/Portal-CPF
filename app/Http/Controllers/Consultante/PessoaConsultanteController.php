<?php

namespace App\Http\Controllers\Consultante;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaConsultanteController extends Controller
{
    public function index(Request $request)
    {
        $query = Pessoa::with('cpf');

        if ($request->filled('nome')) {
            $query->where(
                'nome',
                'like',
                '%' . $request->nome . '%'
            );
        }

        $pessoas = $query
            ->orderBy('nome')
            ->get();

        return view(
            'consultante.pessoas.index',
            compact('pessoas')
        );
    }

    public function ficha($id)
    {
        $pessoa = Pessoa::with('cpf')
            ->findOrFail($id);

        return view(
            'consultante.pessoas.ficha',
            compact('pessoa')
        );
    }
}