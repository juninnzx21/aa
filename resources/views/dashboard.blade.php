<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games/Pong') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnAdicionar = document.getElementById('btnAdicionarSaldo');

        btnAdicionar.addEventListener('click', () => {
            Swal.fire({
                title: 'Adicionar saldo',
                input: 'number',
                inputLabel: 'Digite o valor em reais (R$)',
                inputPlaceholder: 'Ex: 20',
                showCancelButton: true,
                confirmButtonText: 'Adicionar',
                cancelButtonText: 'Cancelar',
                inputAttributes: {
                    min: 1,
                    step: 1
                }
            }).then((result) => {
                if (result.isConfirmed && result.value > 0) {
                    fetch('/atualizar-saldo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ valor: parseFloat(result.value) })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            const saldo = parseFloat(data.novo_saldo).toFixed(2).replace('.', ',');
                            document.getElementById('saldoAtual').textContent = saldo;
                            Swal.fire('Sucesso', 'Saldo adicionado com sucesso!', 'success');
                        } else {
                            Swal.fire('Erro', 'Não foi possível adicionar saldo.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>  
</x-app-layout>
