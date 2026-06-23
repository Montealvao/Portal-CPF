<?php

namespace App\Http\Controllers\Consultante;

use App\Http\Controllers\Controller;
use App\Models\Cpf;
use Illuminate\Http\Request;

class CpfConsultanteController extends Controller
{
    public function buscar(Request $request)
    {
        $resultado = null;

        if ($request->filled('cpf')) {
            $cpfBusca = preg_replace('/\D/', '', $request->cpf);

            $resultado = Cpf::with('pessoa')
                ->whereRaw(
                    "regexp_replace(numero, '\\D', '', 'g') = ?",
                    [$cpfBusca]
                )
                ->first();
        }

        return view('consultante.cpfs.buscar', compact('resultado'));
    }
}