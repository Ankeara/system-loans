@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
    @include('application.message')
    <!-- Header -->
    <header
        class="sticky top-0 z-10 flex items-center justify-between drop-shadow-md h-16 flex-shrink-0 border-b border-gray-200 bg-white">
        <div class="flex items-center">
            <button id="toggleSidebar" type="button"
                class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500">
                <span class="sr-only">Toggle sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </button>
            <div class="flex items-center px-5">
                <span class="text-xl text-gray-600 hidden lg:block">ទំព័រដើម</span>
            </div>
        </div>
        <div class="flex items-center justify-center px-5">
            <span class="text-xl text-gray-600">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
            <div class="profile-image-container ml-4">
                <img id="profileImage" alt="User avatar"
                    src="{{ Auth::check() ? (Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80') : 'https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80' }}"
                    class="size-10 shadow-md rounded-full object-cover cursor-pointer" />
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="p-6 ">
        <div class="kh_calendar_time flex items-center justify-center text-2xl flex-col text-gray-600">
            <div id="greetingDisplay" class="mt-2"></div>
            <div id="dateDisplay" class="mt-2"></div>
            <div id="timeDisplay" class="mt-2"></div>
        </div>

        <!-- Grid showing data -->
        <div class="grid grid-cols-1 gap-4 mt-10 lg:grid-cols-1 lg:gap-8">
            <div class="showing__data h-auto rounded transition-all">
                <div class=" grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-4 md:grid-cols-2 md:gap-4 sm:grid-cols-2 sm:gap-4">
                    <a href="{{ route('application.pages.reports.clients') }}" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-teal-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $clientCount }}</span>
                            <span class="text-md text-center">អតិថិជនសរុប</span>
                        </div>
                    </a>
                    <a href="{{ route("application.pages.reports.loans") }}" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-sky-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3"></path>
                                <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                <path d="M19 21v1m0 -8v1"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $loanCount }}</span>
                            <span class="text-md text-center">អតិថិជនដែលបានចងការប្រាក់សរុប</span>
                        </div>
                    </a>

                    <!-- Clients with High Loans in Riel -->
                    <a href="{{ route("application.pages.reports.loan-high-riel") }}" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-blue-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M5 10h3v10h-3z"></path>
                                <path d="M14.5 4h-9.5v3h9.4a1.5 1.5 0 0 1 0 3h-3.4v4l4 6h4l-5 -7h.5a4.5 4.5 0 1 0 0 -9z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $highLoanRielCount }}</span>
                            <span class="text-md text-center">អតិថិជនដែលចងការប្រាក់ខ្មែរខ្ពស់បំផុត</span>
                            <!-- Clients with Highest Loans in Riel -->
                        </div>
                    </a>

                    <!-- Clients with High Loans in Baht -->
                    <a href="{{ route("application.pages.reports.loan-high-baht") }}" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-orange-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M8 6h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                <path d="M8 12h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                <path d="M8 6v12"></path>
                                <path d="M11 4v2"></path>
                                <path d="M11 18v2"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $highLoanBahtCount }}</span>
                            <span class="text-md text-center">អតិថិជនដែលចងការប្រាក់បាតខ្ពស់បំផុត</span>
                            <!-- Clients with Highest Loans in Baht -->
                        </div>
                    </a>

                    <!-- Clients with High Loans in Dollar -->
                    <a href="{{ route("application.pages.reports.loan-high-dollar") }}" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-violet-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path
                                    d="M11.453 8.056c0 -.623 .518 -.979 1.442 -.979c1.69 0 3.41 .343 4.605 .923l.5 -4c-.948 -.449 -2.82 -1 -5.5 -1c-1.895 0 -3.373 .087 -4.5 1c-1.172 .956 -2 2.33 -2 4c0 3.03 1.958 4.906 5 6c1.961 .69 3 .743 3 1.5c0 .735 -.851 1.5 -2 1.5c-1.423 0 -3.963 -.609 -5.5 -1.5l-.5 4c1.321 .734 3.474 1.5 6 1.5c2 0 3.957 -.468 5.084 -1.36c1.263 -.979 1.916 -2.268 1.916 -4.14c0 -3.096 -1.915 -4.547 -5 -5.637c-1.646 -.605 -2.544 -1.07 -2.544 -1.807z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $highLoanDollarCount }}</span>
                            <span class="text-md text-center">អតិថិជនដែលចងការប្រាក់ដុល្លារខ្ពស់បំផុត</span>
                            <!-- Clients with Highest Loans in Dollar -->
                        </div>
                    </a>
                    <a href="{{ route('application.pages.reports.return-loan') }}"
                        class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-red-400 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5">
                                </path>
                                <path d="M3 10h18"></path>
                                <path d="M7 15h.01"></path>
                                <path d="M11 15h2"></path>
                                <path d="M16 19h6"></path>
                                <path d="M19 16l-3 3l3 3"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $returnLoans }}</span>
                            <span class="text-md text-center">អតិថិជនដែលបានបកប្រាក់សរុប</span>
                        </div>
                    </a>
                    <a href="./reports/return-loan.html" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-red-700 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">{{ $endLoans }}</span>
                            <span class="text-md text-center">អតិថិជនបញ្ចប់ការបង់ប្រាក់សរុប</span>
                        </div>
                    </a>
                    <a href="#" class="h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                        <div class="flex items-center justify-center rounded-[5px] m-2 w-10 h-10 bg-pink-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M7 3v4h4"></path>
                                <path d="M9 17l0 4"></path>
                                <path d="M17 14l0 7"></path>
                                <path d="M13 13l0 8"></path>
                                <path d="M21 12l0 9"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                            <span class="text-2xl mb-2">8</span>
                            <span class="text-md text-center">របាយការណ៍សរុប</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="chart h-3/4 mt-5 border border-gray-100 shadow-sm rounded lg:col-span-2">
            <canvas id="chartProfit" class="w-[100%]"></canvas>
        </div>
    </div>
@endsection
@push('scripts_multiple')
    <script>

        // Existing Chart.js code unchanged
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('chartProfit').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['ប្រាក់បង់ត្រឡប់ (រៀល)', 'ប្រាក់បង់ត្រឡប់ (បាត)', 'ប្រាក់បង់ត្រឡប់ (ដុល្លារ)'],
                    datasets: [{
                        label: 'ចំនួនទឹកប្រាក់សរុប',
                        data: [
                                    {{ $loanPaymentAmountRiel }},
                                    {{ $loanPaymentAmountBaht }},
                            {{ $loanPaymentAmountDollar }}
                        ],
                        backgroundColor: ['#3498db', '#e74c3c', '#2ecc71'],
                        borderColor: ['#2980b9', '#c0392b', '#27ae60'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: 'តារាងប្រាក់បង់ត្រឡប់តាមរូបិយប័ណ្ណ'
                        }
                    }
                }
            });
        });
    </script>
@endpush
