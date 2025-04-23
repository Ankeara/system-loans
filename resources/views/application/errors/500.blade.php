<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- 500 Internal Server Error -->
    <div class="min-h-screen bg-gray-800 flex flex-col justify-center items-center px-4 relative overflow-hidden"
        id="error-500">
        <!-- Matrix Rain Effect -->
        <canvas class="absolute inset-0 pointer-events-none" id="matrix"></canvas>
        <svg class="w-32 h-32 text-gray-300 mb-4 animate-wiggle cursor-pointer" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" onclick="playSound('error')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <h1 class="text-9xl font-extrabold text-white tracking-widest animate-glitch">500</h1>
        <p class="text-2xl md:text-3xl text-gray-300 mt-8">Server Apocalypse!</p>
        <p class="mt-4 text-gray-400 max-w-md text-center">Our digital realm has collapsed. Reboot in progress!</p>
        <div class="mt-8 flex space-x-4">
            <a href="/"
                class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                onclick="playSound('click')">Abandon Ship</a>
            <button onclick="location.reload(); playSound('reload')"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">Reboot</button>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    // Starfield for 404
    const canvas404 = document.getElementById('starfield');
    if (canvas404) {
        const ctx404 = canvas404.getContext('2d');
        canvas404.width = window.innerWidth;
        canvas404.height = window.innerHeight;
        const stars = Array(100).fill().map(() => ({
            x: Math.random() * canvas404.width,
            y: Math.random() * canvas404.height,
            size: Math.random() * 2,
            speed: Math.random() * 0.5
        }));
        function animateStars() {
            ctx404.clearRect(0, 0, canvas404.width, canvas404.height);
            stars.forEach(star => {
                ctx404.fillStyle = 'white';
                ctx404.beginPath();
                ctx404.arc(star.x, star.y, star.size, 0, Math.PI * 2);
                ctx404.fill();
                star.y += star.speed;
                if (star.y > canvas404.height) star.y = 0;
            });
            requestAnimationFrame(animateStars);
        }
        animateStars();
    }

    // Matrix Rain for 500
    const canvas500 = document.getElementById('matrix');
    if (canvas500) {
        const ctx500 = canvas500.getContext('2d');
        canvas500.width = window.innerWidth;
        canvas500.height = window.innerHeight;
        const chars = '01'.split('');
        const fontSize = 16;
        const columns = canvas500.width / fontSize;
        const drops = Array(Math.floor(columns)).fill(0);
        function drawMatrix() {
            ctx500.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx500.fillRect(0, 0, canvas500.width, canvas500.height);
            ctx500.fillStyle = '#0F0';
            ctx500.font = fontSize + 'px monospace';
            drops.forEach((y, i) => {
                const text = chars[Math.floor(Math.random() * chars.length)];
                ctx500.fillText(text, i * fontSize, y * fontSize);
                if (y * fontSize > canvas500.height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            });
            requestAnimationFrame(drawMatrix);
        }
        drawMatrix();
    }

    // Sound Effects
    const sounds = {
        whoosh: new Audio('https://www.myinstants.com/media/sounds/swoosh.mp3'),
        click: new Audio('https://www.myinstants.com/media/sounds/click.mp3'),
        alert: new Audio('https://www.myinstants.com/media/sounds/alert.mp3'),
        denied: new Audio('https://www.myinstants.com/media/sounds/access-denied.mp3'),
        error: new Audio('https://www.myinstants.com/media/sounds/error.mp3'),
        reload: new Audio('https://www.myinstants.com/media/sounds/reload.mp3'),
        gear: new Audio('https://www.myinstants.com/media/sounds/gear.mp3'),
        hammer: new Audio('https://www.myinstants.com/media/sounds/hammer.mp3')
    };
    function playSound(sound) {
        sounds[sound]?.play();
    }

    // Confetti for 404
    function triggerConfetti() {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: ['#4F46E5', '#818CF8', '#C7D2FE']
        });
    }
</script>

<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes spin-slow {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 4s linear infinite;
    }

    @keyframes wiggle {

        0%,
        100% {
            transform: rotate(-3deg);
        }

        50% {
            transform: rotate(3deg);
        }
    }

    .animate-wiggle {
        animation: wiggle 0.5s ease-in-out infinite;
    }

    @keyframes glitch {
        0% {
            transform: translate(0);
        }

        20% {
            transform: translate(-2px, 2px);
        }

        40% {
            transform: translate(-2px, -2px);
        }

        60% {
            transform: translate(2px, 2px);
        }

        80% {
            transform: translate(2px, -2px);
        }

        100% {
            transform: translate(0);
        }
    }

    .animate-glitch {
        animation: glitch 0.3s linear infinite;
    }

    @keyframes stripe {
        0% {
            transform: translateX(-100%) rotate(-45deg);
        }

        100% {
            transform: translateX(200%) rotate(-45deg);
        }
    }

    .animate-stripe {
        animation: stripe 2s linear infinite;
    }

    @keyframes progress {
        0% {
            width: 0%;
        }

        100% {
            width: 100%;
        }
    }

    .animate-progress {
        animation: progress 5s linear infinite;
    }
</style>
</html>
