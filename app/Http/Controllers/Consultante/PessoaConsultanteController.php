<?php

namespace App\Http\Controllers\Consultante;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaConsultanteController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;

        $pessoas = Pessoa::with('cpf')
            ->when($busca, function ($query) use ($busca) {
                $query->where('nome', 'like', "%{$busca}%")
                    ->orWhereHas('cpf', function ($cpf) use ($busca) {
                        $cpf->where('numero', 'like', "%{$busca}%");
                    });
            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('consultante.pessoas.index', compact('pessoas'));
    }

    public function ficha($id)
    {
        $pessoa = Pessoa::with('cpf')->findOrFail($id);

        return view('consultante.pessoas.ficha', compact('pessoa'));
    }
}