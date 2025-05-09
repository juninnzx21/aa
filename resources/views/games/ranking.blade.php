<h2 class="text-xl font-bold mb-4">Ranking dos Maiores Vencedores</h2>
<table class="min-w-full border">
    <thead>
        <tr><th>Usuário</th><th>Total Ganhado</th></tr>
    </thead>
    <tbody>
        @foreach ($ranking as $entry)
            <tr>
                <td>{{ $entry->user->name ?? 'Desconhecido' }}</td>
                <td>R$ {{ number_format($entry->total, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
