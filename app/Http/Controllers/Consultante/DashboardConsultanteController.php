<?php

namespace App\Http\Controllers\Consultante;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;

class DashboardConsultanteController extends Controller
{
    public function index()
    {
        $ultimosCadastros = Pessoa::with('cpf')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'consultante.dashboard',
            compact('ultimosCadastros')
        );
    }
}