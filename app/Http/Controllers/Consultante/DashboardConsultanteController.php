<?php

namespace App\Http\Controllers\Consultante;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Cpf;

class DashboardConsultanteController extends Controller
{
    public function index()
    {
        $totalPessoas = Pessoa::count();

        $totalCpfs = Cpf::count();

        $pessoasSemCpf = Pessoa::doesntHave('cpf')->count();

        $ultimosCadastros = Pessoa::with('cpf')
            ->latest()
            ->take(5)
            ->get();

        return view('consultante.dashboard', compact(
            'totalPessoas',
            'totalCpfs',
            'pessoasSemCpf',
            'ultimosCadastros'
        ));
    }
}