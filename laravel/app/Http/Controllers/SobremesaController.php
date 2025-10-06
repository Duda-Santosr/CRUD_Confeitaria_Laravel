<?php

namespace App\Http\Controllers;

use App\Models\Sobremesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SobremesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuarios');
    }

    public function index(Request $request)
    {
        $sobremesas = Sobremesa::orderBy('nome')->paginate(15);
        $debug = (bool) $request->query('debug');

        if ($debug) {
            Log::info('Debug Sobremesas', [
                'post' => $request->all(),
                'session' => session()->all()
            ]);
        }

        return view('sobremesas.index', compact('sobremesas', 'debug'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'ingredientes' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'tamanho' => 'required|in:Pequena,Media,Grande',
            'categoria' => 'required|string|max:50',
            'estoque_minimo' => 'required|integer|min:0',
            'ativo' => 'nullable|boolean',
        ]);

        $data['preco'] = str_replace(',', '.', $data['preco']);
        $data['ativo'] = (bool)($data['ativo'] ?? true);

        try {
            Sobremesa::create($data);
            Log::info('Sobremesa cadastrada', ['sobremesa' => $data['nome']]);
            return redirect()->route('sobremesas.index')->with('success', 'Sobremesa cadastrada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar sobremesa', ['erro' => $e->getMessage()]);
            return redirect()->route('sobremesas.index')->with('error', 'Erro ao cadastrar sobremesa: ' . $e->getMessage());
        }
    }

    public function edit(Sobremesa $sobremesa)
    {
        return view('sobremesas.edit', compact('sobremesa'));
    }

    public function update(Request $request, Sobremesa $sobremesa)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:100',
            'ingredientes' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'tamanho' => 'required|in:Pequena,Media,Grande',
            'categoria' => 'required|string|max:50',
            'estoque_minimo' => 'required|integer|min:0',
            'ativo' => 'nullable|boolean',
        ]);

        $data['preco'] = str_replace(',', '.', $data['preco']);
        $data['ativo'] = (bool)($data['ativo'] ?? true);

        try {
            $sobremesa->update($data);
            Log::info('Sobremesa atualizada', ['sobremesa' => $sobremesa->nome]);
            return redirect()->route('sobremesas.index')->with('success', 'Sobremesa atualizada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar sobremesa', ['erro' => $e->getMessage()]);
            return redirect()->route('sobremesas.index')->with('error', 'Erro ao atualizar sobremesa: ' . $e->getMessage());
        }
    }

    public function destroy(Sobremesa $sobremesa)
    {
        try {
            $nome = $sobremesa->nome;
            $sobremesa->delete();
            Log::info('Sobremesa excluída', ['sobremesa' => $nome]);
            return redirect()->route('sobremesas.index')->with('success', 'Sobremesa excluída com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir sobremesa', ['erro' => $e->getMessage()]);
            return redirect()->route('sobremesas.index')->with('error', 'Erro ao excluir sobremesa: ' . $e->getMessage());
        }
    }
}
