<h2 class="text-xl font-bold mb-4">Histórico de Partidas</h2>
<table class="min-w-full border">
    <thead>
        <tr><th>Jogo</th><th>Resultado</th><th>Valor</th><th>Data</th></tr>
    </thead>
    <tbody>
        @foreach ($historico as $partida)
            <tr>
                <td>{{ $partida->game_name }}</td>
                <td>{{ ucfirst($partida->result) }}</td>
                <td>R$ {{ number_format($partida->amount, 2, ',', '.') }}</td>
                <td>{{ $partida->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
