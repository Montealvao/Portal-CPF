<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cpf;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CpfAdminController extends Controller
{
    public function index()
    {
        $cpfs = Cpf::with('pessoa')
            ->orderBy('numero')
            ->get();

        return view('admin.cpfs.index', compact('cpfs'));
    }

    public function create()
    {
        $pessoas = Pessoa::doesntHave('cpf')
            ->orderBy('nome')
            ->get();

        return view('admin.cpfs.create', compact('pessoas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:cpfs,numero',
            'pessoa_id' => 'required|unique:cpfs,pessoa_id'
        ]);

        Cpf::create([
            'numero' => $request->numero,
            'pessoa_id' => $request->pessoa_id,
        ]);

        return redirect()
            ->route('admin.cpfs.index')
            ->with('success', 'CPF cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $cpf = Cpf::findOrFail($id);

        return view('admin.cpfs.edit', compact('cpf'));
    }

    public function update(Request $request, $id)
    {
        $cpf = Cpf::findOrFail($id);

        $request->validate([
            'numero' => [
                'required',
                Rule::unique('cpfs', 'numero')->ignore($cpf->id)
            ]
        ]);

        $cpf->update([
            'numero' => $request->numero
        ]);

        return redirect()
            ->route('admin.cpfs.index')
            ->with('success', 'CPF atualizado com sucesso.');
    }

    public function delete($id)
    {
        $cpf = Cpf::with('pessoa')->findOrFail($id);

        return view('admin.cpfs.delete', compact('cpf'));
    }

    public function destroy($id)
    {
        $cpf = Cpf::findOrFail($id);

        $cpf->delete();

        return redirect()
            ->route('admin.cpfs.index')
            ->with('success', 'CPF removido com sucesso.');
    }
}