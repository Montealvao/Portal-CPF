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
            $resultado = Cpf::with('pessoa')
                ->where('numero', $request->cpf)
                ->first();
        }

        return view(
            'consultante.cpfs.buscar',
            compact('resultado')
        );
    }
}