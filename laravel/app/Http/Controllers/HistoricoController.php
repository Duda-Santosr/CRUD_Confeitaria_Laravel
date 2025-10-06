<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Sobremesa;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuarios');
    }

    public function index(Request $request)
    {
        $query = Movimentacao::with(['sobremesa', 'usuario'])->orderByDesc('data_hora');

        if ($request->filled('sobremesa_id')) {
            $query->where('sobremesa_id', $request->sobremesa_id);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('de')) {
            $query->where('data_hora', '>=', $request->de . ' 00:00:00');
        }

        if ($request->filled('ate')) {
            $query->where('data_hora', '<=', $request->ate . ' 23:59:59');
        }

        $movimentacoes = $query->paginate(50);
        $sobremesas = Sobremesa::orderBy('nome')->get();

        return view('historico.index', compact('movimentacoes', 'sobremesas'));
    }
}
