<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- 404 Page Not Found -->
    <div class="min-h-screen bg-gray-900 flex flex-col justify-center items-center px-4 relative overflow-hidden"
        id="error-404">
        <!-- Dynamic Starfield Background -->
        <canvas class="absolute inset-0 pointer-events-none" id="starfield"></canvas>
        <svg class="w-32 h-32 text-indigo-300 mb-4 transform hover:scale-110 transition duration-300 cursor-pointer"
            fill="none" stroke="currentColor" viewBox="0 0 24 24" onclick="playSound('whoosh')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-9xl font-extrabold text-white tracking-widest animate-bounce">404</h1>
        <div class="bg-indigo-500 px-2 text-sm rounded rotate-12 absolute transform hover:-rotate-12 transition duration-300 cursor-pointer"
            onclick="triggerConfetti()">
            <span class="text-white">Page Not Found</span>
        </div>
        <p class="text-2xl md:text-3xl text-gray-300 mt-8 animate-pulse">Lost in the Digital Galaxy?</p>
        <p class="mt-4 text-gray-400 max-w-md text-center">This page has been abducted by aliens or never existed</p>
        <div class="mt-8 flex space-x-4">
            <a href="{{ route('application.pages.dashboard') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">Warp
                Home</a>
            <button onclick="history.back(); playSound('click')"
                class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">Reverse
                Time</button>
        </div>
    </div>
</body>
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
</script>
</html>
