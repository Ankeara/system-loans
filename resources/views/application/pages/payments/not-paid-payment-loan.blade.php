@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
    <main class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="sticky top-0 z-10 flex items-center justify-between drop-shadow-md h-16 flex-shrink-0 border-b border-gray-200 bg-white">
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
                    <span class="text-xl text-gray-600 hidden lg:block">អ្នកមិនទាន់បង់ការប្រាក់សរុបថ្ងៃនេះ</span>
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
                            <a href="{{ route('application.pages.dashboard') }}"
                                class="block transition-colors text-teal-600 "> ទំព័រដើម </a>
                        </li>
                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>
                        <li>
                            <a href="{{ route('application.pages.payments.payment-loan') }}" class="block transition-colors text-teal-600 ">
                                ការបង់ការប្រាក់រាល់ថ្ងៃ </a>
                        </li>
                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>
                        <li>
                            <a href="#" class="block transition-colors hover:text-teal-500"> អ្នកមិនទាន់បង់ការប្រាក់សរុបថ្ងៃនេះ </a>
                        </li>
                    </ol>
                </nav>
                <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                    href="{{ route('application.pages.payments.payment-loan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20"
                        stroke-width="1.5">
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    ថយក្រោយ
                </a>
            </div>
            <div class="header__btn__search flex items-center justify-between mt-6">
                <span class="text-xl text-gray-600">អ្នកមិនទាន់បង់ការប្រាក់សរុបថ្ងៃនេះ</span>
                <!-- In your search-container section -->
                <div class="search-container flex items-center flex-wrap">
                    <label for="Search" class="flex items-center">
                        <div class="box__search relative w-[300px] mr-2">
                            <span class="absolute inset-y-0 left-2 grid w-8 place-content-center">
                                <button type="button" aria-label="Submit"
                                    class="rounded-full p-1.5 text-gray-700 transition-colors z-10 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="size-4 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                            </span>
                            <input type="text" placeholder="ឈ្មោះអតិថិជន" id="Search"
                                class="mt-0.5 mb-2 w-full rounded-lg border-gray-200 px-10 h-10 text-sm drop-shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                        </div>
                    </label>
                    <button id="searchButton"
                        class="flex items-center rounded-md bg-teal-600 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M20.2 20.2l1.8 1.8"></path>
                        </svg>
                        ស្វែងរក
                    </button>
                    <button id="clearButton"
                        class="flex items-center rounded-md bg-red-500 ml-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                            <path d="M18 6l-12 12"></path>
                            <path d="M6 6l12 12"></path>
                        </svg>
                        សម្អាត
                    </button>
                </div>
            </div>
            <div class="mt-10">
                <div class="flex items-center justify-between flex-wrap mb-6">
                    <p class="mt-1 line-clamp-1 text-sm text-[#bd5757]">អ្នកមិនទាន់បង់ការប្រាក់សរុបថ្ងៃនេះ <span
                            class="font-bold">({{ $loans->count() }} នាក់)</span></p>
                </div>
                <div class="grid grid-cols-2 gap-4 xl:grid-cols-6 2xl:gap-4 md:grid-cols-3 md:gap-4 lg:text-lg md:text-[18px] sm:text-[30px]">
                    @forelse ($loans as $loan)
                        <div class="client__payment h-full w-full rounded relative container-div">
                            <article class="h-full w-full overflow-hidden rounded-[8px] shadow transition hover:shadow-sm relative">
                                <img alt="Client profile"
                                    src="{{ url('/src/assets/uploads/clients/profile/' . $loan->client->profile) }}"
                                    class="w-full h-[70%] object-cover" />

                                <div class="bg-white p-4 relative sm:p-2 w-full h-[40%]">
                                    <div class="pt-2 pb-2">
                                        <h1 class="text-sm text-gray-600 xl:text-lg lg:text-lg md:text-[18px] sm:text-[30px]">
                                            {{ $loan->client->full_Name }}
                                        </h1>
                                    </div>
                                    <div class="flex items-center ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="mr-1 text-[#bd5757]" width="12" height="12">
                                            <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z"></path>
                                        </svg>
                                        <p class="mt-1 line-clamp-1 text-xs text-[#bd5757]">មិនទាន់បង់ការប្រាក់ថ្ងៃនេះ</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="flex items-center justify-center">
                            <p class="text-gray-600 text-center">គ្មានអតិថិជនមិនទាន់បង់ការប្រាក់ថ្ងៃនេះទេ (ទាំងអស់បានបង់រួចហើយ)</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts_multiple')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function searchClients() {
        const searchInput = document.getElementById('Search');
        const searchTerm = searchInput.value.trim().toLowerCase();
        const loanContainers = document.querySelectorAll('.client__payment');

        loanContainers.forEach(container => {
            // Use 'h1' instead of 'a' to match your HTML structure
            const fullNameElement = container.querySelector('h1');
            if (fullNameElement) {
                const fullName = fullNameElement.textContent.trim().toLowerCase();
                container.style.display = fullName.includes(searchTerm) ? 'block' : 'none';
            }
        });
    }

    function clearSearch() {
        const searchInput = document.getElementById('Search');
        const loanContainers = document.querySelectorAll('.client__payment');

        searchInput.value = '';
        loanContainers.forEach(container => {
            container.style.display = 'block';
        });
    }

    // Event listeners with specific IDs
    document.addEventListener('DOMContentLoaded', function () {
        const searchButton = document.getElementById('searchButton');
        const clearButton = document.getElementById('clearButton');
        const searchInput = document.getElementById('Search');

        if (searchButton) {
            searchButton.addEventListener('click', searchClients);
        } else {
            console.error("Search button not found!");
        }
        if (clearButton) {
            clearButton.addEventListener('click', clearSearch);
        } else {
            console.error("Clear button not found!");
        }
        if (searchInput) {
            searchInput.addEventListener('keyup', function (e) {
                if (e.key === 'Enter') {
                    searchClients();
                }
            });
        } else {
            console.error("Search input not found!");
        }
    });
</script>
@endpush
