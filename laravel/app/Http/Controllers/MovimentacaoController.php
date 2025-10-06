<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Sobremesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovimentacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuarios');
    }

    public function index(Request $request)
    {
        $sobremesas = Sobremesa::orderBy('nome')->get();
        $movimentacoes = Movimentacao::with(['sobremesa', 'usuario'])
            ->latest('data_hora')
            ->paginate(20);

        $debug = (bool) $request->query('debug');

        if ($debug) {
            Log::info('Debug Movimentações', [
                'post' => $request->all(),
                'session' => session()->all()
            ]);
        }

        return view('movimentacoes.index', compact('sobremesas', 'movimentacoes', 'debug'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sobremesa_id' => 'required|exists:sobremesas,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1',
            'observacoes' => 'nullable|string',
        ]);

        $sobremesa = Sobremesa::findOrFail($data['sobremesa_id']);

        if ($data['tipo'] === 'saida') {
            $estoqueAtual = $sobremesa->estoque_atual;
            if ($data['quantidade'] > $estoqueAtual) {
                return back()
                    ->withErrors(['quantidade' => "Quantidade maior que o estoque atual ({$estoqueAtual})."])
                    ->withInput();
            }
        }

        try {
            Movimentacao::create([
                'sobremesa_id' => $sobremesa->id,
                'usuario_id' => auth('usuarios')->id(),
                'data_hora' => now(),
                'tipo' => $data['tipo'],
                'quantidade' => $data['quantidade'],
                'observacoes' => $data['observacoes'] ?? null,
            ]);

            Log::info('Movimentação registrada', [
                'sobremesa' => $sobremesa->nome,
                'tipo' => $data['tipo'],
                'quantidade' => $data['quantidade']
            ]);

            return redirect()->route('movimentacoes.index')->with('success', 'Movimentação registrada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao registrar movimentação', ['erro' => $e->getMessage()]);
            return redirect()->route('movimentacoes.index')->with('error', 'Erro ao registrar movimentação: ' . $e->getMessage());
        }
    }
}
