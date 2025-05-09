<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    // Método para atualizar o saldo
    public function atualizarSaldo(Request $request)
    {
        $valor = $request->input('valor');
        $user = auth()->user();

        if (!$user) {
            return response()->json(['status' => 'error', 'mensagem' => 'Não autenticado'], 401);
        }

        if ($user->saldo + $valor < 0) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Saldo insuficiente']);
        }

        $user->saldo += $valor;
        $user->save();

        return response()->json(['status' => 'ok', 'novo_saldo' => $user->saldo]);
    }

    // Método para exibir o jogo Pong
    public function pong()
    {
        return view('games.pong');
    }

    // Método para exibir o histórico de jogos
    public function historico()
    {
        $historico = auth()->user()->gameHistories()->latest()->take(20)->get();
        return view('games.historico', compact('historico'));
    }
}
