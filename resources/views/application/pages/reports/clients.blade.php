@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
    <!-- Content -->
    <main class="flex-1 overflow-auto">
        <!-- Header -->
        <header
            class="sticky top-0 z-10 flex items-center justify-between drop-shadow-md h-16 flex-shrink-0 border-b border-gray-200 bg-white">
            <div class="block">
                <button id="toggleSidebar" type="button"
                    class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500">
                    <span class="sr-only">Toggle sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                <div class="flex items-center justify-between px-5">
                    <span class="text-xl text-gray-600 hidden lg:block">អតិថិជនសរុប</span>
                </div>
            </div>
            <div class="flex items-center justify-center px-5">
                <span class="text-xl text-gray-600">{{ Auth::user()->name }}</span>
                <img alt=""
                    src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                    class="size-10 ml-4 shadow-md rounded-full object-cover" />
            </div>
        </header>

        <!-- Content -->
        <div class="p-6 khmer__font">
            <div class="flex items-center justify-between">
                <nav aria-label="Breadcrumb" class="">
                    <ol class="flex items-center gap-1 text-sm text-gray-600">
                        <li>
                            <a href="{{ route('application.pages.dashboard') }}" class="block transition-colors text-teal-600 "> ទំព័រដើម </a>
                        </li>

                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>

                        <li>
                            <a href="../clients/clients.html" class="block transition-colors text-teal-600"> អតិថិជន </a>
                        </li>

                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>

                        <li>
                            <a href="#" class="block transition-colors hover:text-teal-500"> អតិថិជនសរុប </a>
                        </li>
                    </ol>
                </nav>
                <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                    href="{{ route('application.pages.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20"
                        stroke-width="1.5">
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    ថយក្រោយ
                </a>
            </div>

            <!-- Grid showing data -->
            <div class="grid grid-cols-1 gap-4 mt-10 lg:grid-cols-3 lg:gap-8">
                <div class="showing__data h-auto rounded transition-all">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-4 h-full">
                        <a href="{{ route("application.pages.clients.clients") }}"
                            class="flex items-center justify-center relative h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                            <div
                                class="flex items-center justify-center absolute top-2 left-2 rounded-[5px] m-2 w-10 h-10 bg-teal-400 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24"
                                    height="24" stroke-width="1.5">
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                                <span class="text-4xl mb-4">{{ $clientCount }}</span>
                                <span class="text-xl text-center">អតិថិជនសរុប</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chart h-[400px] border border-gray-100 shadow-sm rounded lg:col-span-2">
                    <canvas id="chartClient"></canvas>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts_chart_client')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('chartClient').getContext('2d');

            const clientData = {
                labels: ['សរុប', 'សកម្ម', 'អសកម្ម'], // Total, Active, Inactive in Khmer
                datasets: [{
                    label: 'ស្ថិតិអតិថិជន', // Client Statistics in Khmer
                    data: [{{ $clientCount }}, {{ $activeClients }}, {{ $inactiveClients }}],
                    backgroundColor: [
                        'rgba(13, 148, 136, 1)',  // Teal for Total
                        'rgba(34, 197, 94, 1)',   // Green for Active
                        'rgba(239, 68, 68, 1)'    // Red for Inactive
                    ],
                    borderColor: [
                        'rgba(13, 148, 136, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            const clientChart = new Chart(ctx, {
                type: 'bar',
                data: clientData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'ចំនួនអតិថិជន' // Number of Clients in Khmer
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'ប្រភេទ' // Categories in Khmer
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'ទិដ្ឋភាពអតិថិជន' // Client Overview in Khmer
                        }
                    }
                }
            });
        });
    </script>
@endpush
