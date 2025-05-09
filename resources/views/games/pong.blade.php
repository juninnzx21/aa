    @php
        $usuarioLogado = Auth::check();
        $usuarioId = Auth::id();
        $usuario = Auth::user(); // Carrega usuário completo
    @endphp

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container text-center">
        <h2>Pong</h2>

        @if($usuario)
            <div class="mb-4 text-lg font-bold text-green-600">
                Saldo atual: R$ <span id="saldoAtual">{{ number_format($usuario->saldo, 2, ',', '.') }}</span>
            </div>
        @endif

        <canvas id="pongCanvas" width="800" height="400" style="border:1px solid #000;"></canvas>
        <button id="startBtn" class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Iniciar Jogo (R$5,00)</button>
        <audio id="winSound" src="/sounds/win.mp3"></audio>
        <audio id="loseSound" src="/sounds/lose.mp3"></audio>
        <audio id="hitSound" src="/sounds/hit.mp3"></audio>
    </div>

    <script>
        const winSound = document.getElementById('winSound');
        const loseSound = document.getElementById('loseSound');
        const hitSound = document.getElementById('hitSound');
        // Ao colidir
        hitSound.play();

        // Vitória
        winSound.play();

        // Derrota
        loseSound.play();

        const canvas = document.getElementById('pongCanvas');
        const ctx = canvas.getContext('2d');
        const startBtn = document.getElementById('startBtn');

        let isLoggedIn = @json($usuarioLogado);
        let userId = @json($usuarioId);
        let jogoAtivo = false;
        let pontos = 0;

        // Paddles
        const paddleWidth = 10, paddleHeight = 100;
        let playerY = canvas.height / 2 - paddleHeight / 2;
        let aiY = playerY;
        const paddleSpeed = 6;

        // Ball
        let ballX = canvas.width / 2;
        let ballY = canvas.height / 2;
        let ballRadius = 10;
        let ballSpeedX = 5;
        let ballSpeedY = 5;

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowUp') playerY -= paddleSpeed;
            if (e.key === 'ArrowDown') playerY += paddleSpeed;
        });

        startBtn.addEventListener('click', () => {
            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ops!',
                    text: 'Para jogar você precisa estar logado. Caso não tenha uma conta, cadastre-se e venha se divertir conosco!',
                });
                return;
            }

            fetch('/atualizar-saldo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ valor: -5 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    atualizarSaldo(data.novo_saldo);
                    jogoAtivo = true;
                    pontos = 0;
                    resetarBola();
                    desenhar();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Saldo insuficiente',
                        text: 'Você precisa de pelo menos R$5 para jogar.',
                    });
                }
            });
        });

        function atualizarSaldo(valor) {
            const saldoFormatado = parseFloat(valor).toFixed(2).replace('.', ',');
            document.getElementById('saldoAtual').textContent = saldoFormatado;
        }

        function resetarBola() {
            ballX = canvas.width / 2;
            ballY = canvas.height / 2;
            ballSpeedX = 5;
            ballSpeedY = 5;
        }

        function desenhar() {
            if (!jogoAtivo) return;

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            ctx.fillRect(0, playerY, paddleWidth, paddleHeight);
            aiY += ((ballY - (aiY + paddleHeight / 2))) * 0.1;
            ctx.fillRect(canvas.width - paddleWidth, aiY, paddleWidth, paddleHeight);

            ctx.beginPath();
            ctx.arc(ballX, ballY, ballRadius, 0, Math.PI * 2);
            ctx.fill();
            ctx.closePath();

            ballX += ballSpeedX;
            ballY += ballSpeedY;

            if (ballY + ballRadius > canvas.height || ballY - ballRadius < 0)
                ballSpeedY *= -1;

            if (
                (ballX - ballRadius < paddleWidth && ballY > playerY && ballY < playerY + paddleHeight) ||
                (ballX + ballRadius > canvas.width - paddleWidth && ballY > aiY && ballY < aiY + paddleHeight)
            ) {
                ballSpeedX *= -1;
                pontos++;

                if (pontos >= 10) {
                    jogoAtivo = false;

                    fetch('/atualizar-saldo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ valor: 10 })
                    })
                    .then(res => res.json())
                    .then(data => {
                        atualizarSaldo(data.novo_saldo);
                    });

                    Swal.fire({
                        icon: 'success',
                        title: 'Você venceu!',
                        text: 'Parabéns! Você ganhou R$10.',
                    });
                }
            }

            if (ballX < 0 || ballX > canvas.width) {
                jogoAtivo = false;
                Swal.fire({
                    icon: 'error',
                    title: 'Derrota!',
                    text: 'Você perdeu o jogo!',
                });
            }

            if (jogoAtivo) requestAnimationFrame(desenhar);
        }
    </script>