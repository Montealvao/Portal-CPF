<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaAdminController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::with('cpf')
            ->orderBy('nome')
            ->get();

        return view('admin.pessoas.index', compact('pessoas'));
    }

    public function create()
    {
        return view('admin.pessoas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'data_nascimento' => 'required|date',
        ]);

        Pessoa::create([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
        ]);

        return redirect()
            ->route('admin.pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        return view('admin.pessoas.edit', compact('pessoa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'data_nascimento' => 'required|date',
        ]);

        $pessoa = Pessoa::findOrFail($id);

        $pessoa->update([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
        ]);

        return redirect()
            ->route('admin.pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso.');
    }

    public function delete($id)
    {
        $pessoa = Pessoa::with('cpf')->findOrFail($id);

        return view('admin.pessoas.delete', compact('pessoa'));
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        $pessoa->delete();

        return redirect()
            ->route('admin.pessoas.index')
            ->with('success', 'Pessoa removida com sucesso.');
    }
}