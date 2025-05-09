const canvas = document.getElementById('slice-canvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let score = 0;
let saldo = parseFloat(document.getElementById('saldo-value').textContent);
const frutas = [];
const slicePath = [];
const FRUIT_TYPES = ['🍉', '🍌', '🍎', '🍓'];

function criarFruta() {
    const x = Math.random() * canvas.width;
    const y = canvas.height + 50;
    const vx = (Math.random() - 0.5) * 8;
    const vy = - (Math.random() * 10 + 15);
    const emoji = FRUIT_TYPES[Math.floor(Math.random() * FRUIT_TYPES.length)];
    frutas.push({ x, y, vx, vy, emoji, cortada: false });
}

function desenharFrutas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    frutas.forEach(f => {
        ctx.font = '40px Arial';
        ctx.fillText(f.emoji, f.x, f.y);
    });
}

function atualizarFrutas() {
    frutas.forEach(f => {
        f.x += f.vx;
        f.y += f.vy;
        f.vy += 0.5;
    });
    frutas.filter(f => !f.cortada && f.y > canvas.height + 50).forEach(f => {
        // fruta perdida, não faz nada por enquanto
    });
}

function verificarColisoes() {
    frutas.forEach(f => {
        if (f.cortada) return;
        slicePath.forEach(p => {
            const dx = f.x - p.x;
            const dy = f.y - p.y;
            if (Math.sqrt(dx * dx + dy * dy) < 40) {
                f.cortada = true;
                score++;
                saldo += 1;
                document.getElementById('score').textContent = `Pontuação: ${score}`;
                document.getElementById('saldo-value').textContent = saldo.toFixed(2);
                atualizarSaldoNoServidor(1);
                // som opcional aqui
            }
        });
    });
}

function atualizarSaldoNoServidor(valor) {
    fetch('/api/atualizar-saldo', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ valor: valor })
    });
}

function loop() {
    desenharFrutas();
    atualizarFrutas();
    verificarColisoes();
    requestAnimationFrame(loop);
}

canvas.addEventListener('mousemove', (e) => {
    slicePath.push({ x: e.clientX, y: e.clientY });
    if (slicePath.length > 10) slicePath.shift();
});

setInterval(criarFruta, 1000);
loop();

document.getElementById('slice-sound').play();
