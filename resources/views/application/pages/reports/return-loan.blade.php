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
                    <span class="text-xl text-gray-600 hidden lg:block">អតិថិជនដែលបានបកប្រាក់សរុប</span>
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
                            <a href="{{ route('application.pages.dashboard') }}" class="block transition-colors text-teal-600 "> ទំព័រដើម
                            </a>
                        </li>

                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>

                        <li>
                            <a href="#" class="block transition-colors text-teal-600"> អតិថិជនដែលបានបកប្រាក់ </a>
                        </li>

                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>

                        <li>
                            <a href="#" class="block transition-colors hover:text-teal-500">
                                អតិថិជនដែលបានបកប្រាក់សរុប </a>
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
                        <a href="{{ route('application.pages.return-loans.return-loan') }}"
                            class="flex items-center justify-center relative h-auto rounded bg-white border border-gray-100 shadow-sm hover:bg-slate-50">
                            <div
                                class="flex items-center justify-center absolute top-2 left-2 rounded-[5px] m-2 w-10 h-10 bg-red-400 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24"
                                    height="24" stroke-width="1.5">
                                    <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path>
                                    <path d="M3 10h18"></path>
                                    <path d="M7 15h.01"></path>
                                    <path d="M11 15h2"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16l-3 3l3 3"></path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-center justify-center mb-4 text-gray-600">
                                <span class="text-4xl mb-4">{{ $returnLoanCount }}</span>
                                <span class="text-xl text-center">អតិថិជនដែលបានបកប្រាក់សរុប</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="chart h-[400px] border border-gray-100 shadow-sm rounded lg:col-span-2">
                    <canvas id="chartReturn"></canvas>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts_chart_return')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('chartReturn').getContext('2d');

                const chartReturn = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            'ចំនួនការសងសរុប',
                            'ការសងសកម្ម',
                            'ការសងអសកម្ម',
                            'ប្រាក់នៅសល់ (រៀល)',
                            'ប្រាក់នៅសល់ (បាត)',
                            'ប្រាក់នៅសល់ (ដុល្លារ)',
                            'ប្រាក់បន្ថែម (រៀល)',
                            'ប្រាក់បន្ថែម (បាត)',
                            'ប្រាក់បន្ថែម (ដុល្លារ)'
                        ],
                        datasets: [{
                            label: 'ស្ថិតិការសងប្រាក់កម្ចី',
                            data: [
                        {{ $returnLoanCount }},
                        {{ $activeReturnLoans }},
                        {{ $inactiveReturnLoans }},
                        {{ $moneyLeftRiel }},
                        {{ $moneyLeftBaht }},
                        {{ $moneyLeftDollar }},
                        {{ $moreMoneyRiel }},
                        {{ $moreMoneyBaht }},
                                {{ $moreMoneyDollar }}
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',  // Total Returns
                                'rgba(54, 162, 235, 1)',  // Active Returns
                                'rgba(255, 99, 132, 1)',  // Inactive Returns
                                'rgba(46, 204, 113, 1)',  // Money Left Riel
                                'rgba(46, 204, 113, 0.8)', // Money Left Baht
                                'rgba(46, 204, 113, 0.6)', // Money Left Dollar
                                'rgba(52, 152, 219, 1)',   // More Money Riel
                                'rgba(52, 152, 219, 0.8)', // More Money Baht
                                'rgba(52, 152, 219, 0.6)'  // More Money Dollar
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(46, 204, 113, 1)',
                                'rgba(46, 204, 113, 0.8)',
                                'rgba(46, 204, 113, 0.6)',
                                'rgba(52, 152, 219, 1)',
                                'rgba(52, 152, 219, 0.8)',
                                'rgba(52, 152, 219, 0.6)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'តម្លៃ / ចំនួន'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'ប្រភេទការសង'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'ទិដ្ឋភាពទូទៅនៃស្ថិតិការសងប្រាក់កម្ចី'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.dataIndex >= 3) {
                                            label += new Intl.NumberFormat('km-KH', {
                                                style: 'decimal'
                                            }).format(context.parsed.y);
                                        } else {
                                            label += context.parsed.y;
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            });</script>
@endpush
