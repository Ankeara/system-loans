<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 503</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<!-- 503 Service Unavailable -->
<div class="min-h-screen bg-yellow-900 flex flex-col justify-center items-center px-4 relative overflow-hidden"
    id="error-503">
    <!-- Animated Gears -->
    <div class="absolute inset-0 opacity-30">
        <svg class="w-24 h-24 text-yellow-500 absolute animate-spin-slow" style="top: 10%; left: 10%;" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        </svg>
        <svg class="w-16 h-16 text-yellow-400 absolute animate-spin" style="bottom: 15%; right: 15%;" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
        </svg>
    </div>
    <svg class="w-32 h-32 text-yellow-300 mb-4 animate-spin cursor-pointer" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" onclick="playSound('gear')">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
    </svg>
    <div class="relative">
        <h1 class="text-9xl font-extrabold text-white tracking-widest animate-pulse">503</h1>
        <div class="bg-yellow-500 px-2 text-sm rounded rotate-6 absolute bottom-0 right-0 transform hover:-rotate-6 transition duration-300 cursor-pointer"
            onclick="playSound('hammer')">
            <span class="text-white">Service Unavailable</span>
        </div>
    </div>
    <p class="text-2xl md:text-3xl text-yellow-200 mt-8">Under Heavy Maintenance</p>
    <p class="mt-4 text-yellow-300 max-w-md text-center">Our tech wizards are casting upgrade spells</p>
    <div class="mt-8 flex flex-col items-center space-y-4">
        <div class="w-64 h-2 bg-yellow-800 rounded-full overflow-hidden">
            <div class="h-full bg-yellow-500 animate-progress"></div>
        </div>
        <a href="/"
            class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105 hover:shadow-xl"
            onclick="playSound('click')">Portal Home</a>
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
