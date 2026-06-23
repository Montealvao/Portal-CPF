<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;

class RelatorioController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::with('cpf')
            ->orderBy('nome')
            ->get();

        return view('admin.relatorios.index', compact('pessoas'));
    }
}