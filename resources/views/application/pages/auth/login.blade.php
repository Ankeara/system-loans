<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>សូមបញ្ចូលព័ត៌មានលម្អិតដើម្បីចូលក្នុងប្រព័ន្ធ</title>
    <link rel="stylesheet" href="{{ url('../src/styles/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-white khmer__font">
    @include('application.message')
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
        <div class="flex items-center justify-center h-screen rounded bg-white p-10">
            <div class="flex flex-col w-[400px]">
                <h1 class="text-4xl text-gray-600 mt-1 mb-3">ស្វាគមន៍</h1>
                <p class="text-gray-400 mb-3">សូមស្វាគមន៍ សូមបញ្ចូលព័ត៌មានលម្អិត</p>
                <form method="POST" action="{{ route('application.pages.auth.authenticate') }}">
                    @csrf
                    <label for="email" class="mb-5">
                        <span class="text-sm font-medium text-gray-700">អ៊ីម៉ែល *</span>
                        <div class="relative">
                            <input type="text" name="email" id="email" placeholder="បញ្ចូលអ៊ីម៉ែល"
                                class="mb-5 bg-[#F9F9F9] w-full rounded-[8px] px-3 h-10 text-sm shadow mt-1 border @error('email') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-teal-500" />
                            @error('email')
                                <p class="text-red-400 text-sm mt-[-8px]">{{ $message }}</p>
                            @enderror
                        </div>
                    </label>

                    <label for="password" class="mb-5">
                        <span class="text-sm font-medium text-gray-700">លេខសម្ងាត់ *</span>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="បញ្ចូលលេខសម្ងាត់"
                                class="mb-5 bg-[#F9F9F9] w-full rounded-[8px] px-3 h-10 text-sm shadow mt-1 border @error('password') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-teal-500" />
                            @error('password')
                                <p class="text-red-400 text-sm mt-[-8px]">{{ $message }}</p>
                            @enderror
                        </div>
                    </label>

                    <button
                        class="flex items-center justify-center rounded-md w-full bg-teal-600 mt-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                        type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20"
                            stroke-width="1.5">
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                        </svg>
                        ចូល
                    </button>
                </form>
            </div>
        </div>
        <div class="flex items-center justify-center w-full h-full rounded bg-gray-100">
            <img src="{{ url('../src/assets/images/login.jpg') }}" class="object-cover w-full h-full" alt="">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ url('../src/scripts/app.js') }}"></script>
</body>

</html>
