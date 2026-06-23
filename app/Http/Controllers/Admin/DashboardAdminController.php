<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Cpf;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalPessoas = Pessoa::count();
        $totalCpfs = Cpf::count();

        $pessoasSemCpf = Pessoa::doesntHave('cpf')->count();

        return view('admin.dashboard', compact(
            'totalPessoas',
            'totalCpfs',
            'pessoasSemCpf'
        ));
    }
}