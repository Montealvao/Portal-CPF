<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cpf;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CpfAdminController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;

        $cpfs = Cpf::with('pessoa')
            ->when($busca, function ($query) use ($busca) {
                $query->where('numero', 'like', "%{$busca}%")
                    ->orWhereHas('pessoa', function ($pessoa) use ($busca) {
                        $pessoa->where('nome', 'like', "%{$busca}%");
                    });
            })
            ->orderBy('numero')
            ->paginate(10)
            ->withQueryString();

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
            'numero' => 'required|max:14|unique:cpfs,numero',
            'pessoa_id' => 'required|exists:pessoas,id|unique:cpfs,pessoa_id',
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
        $cpf = Cpf::with('pessoa')->findOrFail($id);

        return view('admin.cpfs.edit', compact('cpf'));
    }

    public function update(Request $request, $id)
    {
        $cpf = Cpf::findOrFail($id);

        $request->validate([
            'numero' => [
                'required',
                'max:14',
                Rule::unique('cpfs', 'numero')->ignore($cpf->id),
            ],
        ]);

        $cpf->update([
            'numero' => $request->numero,
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