<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cpf;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $anoAtual = now()->year;

        $totalPessoas = Pessoa::count();

        $totalCpfs = Cpf::count();

        $pessoasComCpf = Pessoa::has('cpf')->count();

        $pessoasSemCpf = Pessoa::doesntHave('cpf')->count();

        $cadastrosPorMesBanco = Pessoa::selectRaw('EXTRACT(MONTH FROM created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', $anoAtual)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->pluck('total', 'mes');

        $nomesMeses = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez',
        ];

        $cadastrosPorMes = [];

        foreach ($nomesMeses as $numeroMes => $nomeMes) {
            $cadastrosPorMes[$nomeMes] = (int) ($cadastrosPorMesBanco[$numeroMes] ?? 0);
        }

        $ultimasPessoas = Pessoa::with('cpf')
            ->latest()
            ->take(5)
            ->get();

        $ultimosCpfs = Cpf::with('pessoa')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.relatorios.index', compact(
            'anoAtual',
            'totalPessoas',
            'totalCpfs',
            'pessoasComCpf',
            'pessoasSemCpf',
            'cadastrosPorMes',
            'ultimasPessoas',
            'ultimosCpfs'
        ));
    }
}