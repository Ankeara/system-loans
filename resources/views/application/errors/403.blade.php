<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 503</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body>
<!-- 403 Forbidden -->
<div class="min-h-screen bg-red-900 flex flex-col justify-center items-center px-4 relative overflow-hidden"
    id="error-403">
    <!-- Animated Warning Stripes -->
    <div class="absolute inset-0 bg-gradient-to-br from-red-900 to-red-800 opacity-75 overflow-hidden">
        <div class="w-full h-12 bg-red-700 transform -rotate-45 absolute animate-stripe" style="top: -20%; left: -50%;">
        </div>
        <div class="w-full h-12 bg-red-700 transform -rotate-45 absolute animate-stripe"
            style="top: 20%; left: -50%; animation-delay: 0.5s;"></div>
    </div>
    <svg class="w-32 h-32 text-red-300 mb-4 animate-spin-slow cursor-pointer" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" onclick="playSound('alert')">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
    </svg>
    <div class="relative">
        <h1 class="text-9xl font-extrabold text-white tracking-widest animate-pulse">403</h1>
        <div class="bg-red-500 px-2 text-sm rounded -rotate-12 absolute top-0 right-0 transform hover:scale-110 transition duration-300 cursor-pointer"
            onclick="playSound('denied')">
            <span class="text-white">Forbidden</span>
        </div>
    </div>
    <p class="text-2xl md:text-3xl text-red-200 mt-8 animate-bounce">Access Denied!</p>
    <p class="mt-4 text-red-300 max-w-md text-center">This zone is guarded by digital sentinels</p>
    <a href="/"
        class="mt-8 inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:rotate-2 hover:shadow-xl"
        onclick="playSound('click')">Flee to Safety</a>
</div>
</body>
</html>
