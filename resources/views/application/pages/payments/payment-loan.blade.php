@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
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
                    <span class="text-xl text-gray-600 hidden lg:block">ការបង់ការប្រាក់រាល់ថ្ងៃ</span>
                </div>
            </div>
            <div class="flex items-center justify-center px-5">
                <span class="text-xl text-gray-600">{{ Auth::user()->name }}</span>
                <img alt=""
                    src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80"
                    class="size-10 ml-4 shadow-md rounded-full object-cover" />
            </div>
        </header>

        <!-- Content -->
        @include('application.message')
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
                            <a href="#" class="block transition-colors hover:text-teal-500"> ការបង់ការប្រាក់រាល់ថ្ងៃ </a>
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
            <div class="header__btn__search flex items-center justify-between mt-6">
                <span class="text-xl text-gray-600">អតិថិជនឡើងការប្រាក់ទាំងអស់</span>
                <!-- In your search-container section -->
                <div class="search-container flex items-center flex-wrap justify-center">
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
                <div class="flex items-center flex-wrap mb-6">
                    <a href="{{ route('paid.payment.loans') }}" class="flex items-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-1 text-teal-600" width="12" height="12">
                            <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z">
                            </path>
                        </svg>
                        <p class="mt-1 line-clamp-1 text-sm text-teal-600">អ្នកបានបង់ការប្រាក់សរុបថ្ងៃនេះ <span
                                class="font-bold">({{ $paidTodayCount }} នាក់)</span></p>
                    </a>
                    <a href="{{ route('not.paid.payment.loans') }}" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-1 text-[#bd5757]" width="12" height="12">
                            <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z">
                            </path>
                        </svg>
                        <p class="mt-1 line-clamp-1 text-sm text-[#bd5757]">អ្នកមិនទាន់បង់ការប្រាក់សរុបថ្ងៃនេះ <span
                                class="font-bold">({{ $notPaidTodayCount }} នាក់)</span></p>
                    </a>
                </div>
                <div
                    class="grid grid-cols-2 gap-4 xl:grid-cols-6 2xl:gap-4 md:grid-cols-3 md:gap-4 lg:text-lg md:text-[18px] sm:text-[30px]">
                    @if ($loans->isEmpty())
                        <p>មិនមានអតិថិជនបានបង់ការប្រាក់</p>
                    @else
                        @foreach ($loans as $loan)
                            <div class="client__payment h-full w-full rounded relative container-div"
                                id="loan_container_{{ $loan->id }}" onclick="toggleForm(event)">
                                <form method="POST" id="paymentForm_{{ $loan->id }}" name="paymentForm"
                                    class="h-full w-full overflow-hidden rounded-[8px] shadow transition hover:shadow-sm relative">
                                    @csrf
                                    <div class="w-full h-full p-4 bg-white absolute top-0 left-0 hidden form-container z-10">
                                        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                                            onclick="closeForm(event)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <input type="hidden" name="id_loan" value="{{ $loan->id }}">
                                        <input type="hidden" name="payment_Status" value="1">
                                        <div class="mb-[8px] mt-2">
                                            <label for="payment_amount_{{ $loan->id }}"
                                                class="block text-[16px] font-medium text-gray-800">បញ្ចូលប្រាក់ត្រូវទូទាត់</label>
                                            <input type="number" id="payment_amount_{{ $loan->id }}" name="payment_amount"
                                                class="w-full h-8 rounded-sm border-gray-200 px-2 mt-1 text-[16px] placeholder:text-[13px] drop-shadow border-none sm:text-[16px] focus:outline-none focus:ring-teal-500 focus:ring-2"
                                                placeholder="សូមបញ្ចូលប្រាក់ត្រូវទូទាត់" required>
                                        </div>
                                        <div class="mb-[8px]">
                                            <label for="not_paid_{{ $loan->id }}"
                                                class="block text-[16px] font-medium text-gray-800">ជំពាក់</label>
                                            <input type="number" id="not_paid_{{ $loan->id }}" name="not_paid"
                                                class="w-full h-8 rounded-sm border-gray-200 px-2 mt-1 text-[16px] placeholder:text-[13px] drop-shadow border-none sm:text-[16px] focus:outline-none focus:ring-teal-500 focus:ring-2"
                                                placeholder="សូមបញ្ចូលចំនួនដែលជំពាក់"
                                                value="{{ $loan->payments()->sum('not_paid') }}">
                                        </div>
                                        <button type="button" onclick="submitPayment('{{ $loan->id }}')"
                                            class="mt-2 bg-teal-600 text-white text-sm h-8 w-full rounded hover:bg-teal-700">
                                            រក្សាទុក
                                        </button>
                                    </div>

                                    <img alt="Sample image"
                                        src="{{ url('/src/assets/uploads/clients/profile/' . $loan->client->profile) }}"
                                        class="w-full h-[70%] object-cover" />

                                    <div class="bg-white p-4 relative sm:p-2 w-full h-[40%]">
                                        <div class="pt-2 pb-2">
                                            <a href="{{ route('application.pages.payments.loan-detail', $loan->id) }}"
                                                class="text-sm text-gray-600 xl:text-lg lg:text-lg md:text-[18px] sm:text-[24px] hover:text-teal-600">
                                                {{ $loan->client->full_Name }}
                                            </a>
                                        </div>
                                        <div class="flex items-center justify-between" id="status_display_{{ $loan->id }}">
                                            <p class="mt-1 line-clamp-1 text-sm text-gray-600">
                                                បង់បាន: <span class="text-red-600">{{ $loan->payments()->count() }}</span> / <span
                                                    class="text-teal-600">{{ $loan->loan_Term }}</span>
                                            </p>
                                            <p class="mt-1 line-clamp-1 text-sm text-gray-600">
                                                ជំពាក់: <span
                                                    class="text-orange-600">{{ $loan->payments()->sum('not_paid') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts_multiple')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleForm(event) {
            event.preventDefault();
            const formContainer = event.currentTarget.querySelector('.form-container');
            formContainer.classList.toggle('hidden');
        }

        function closeForm(event) {
            event.preventDefault();
            event.stopPropagation();
            const formContainer = event.currentTarget.closest('.form-container');
            formContainer.classList.add('hidden');
        }

        function submitPayment(loanId) {
                const form = document.getElementById(`paymentForm_${loanId}`);
                const formData = new FormData(form);

                $.ajax({
                    url: "{{ route('application.pages.payments.save-payment') }}", // Adjust route name if different
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (data) {
                        if (data.status) {
                            const statusDisplay = $(`#status_display_${loanId}`);
                            statusDisplay.html(`
                    <p class="mt-1 line-clamp-1 text-sm text-gray-600">
                        បង់បាន: <span class="text-red-600">${data.payment_count}</span> / <span class="text-teal-600">${data.total_terms}</span>
                    </p>
                    <p class="mt-1 line-clamp-1 text-sm text-gray-600">
                        ជំពាក់: <span class="text-orange-600">${data.not_paid}</span>
                    </p>
                `);
                            form.querySelector('.form-container').classList.add('hidden');

                            if (data.is_completed) {
                                $(`#loan_container_${loanId}`).hide();
                            }
                            location.reload();
                        }
                    }
                });
            }
            //search client
    function searchClients() {
            const searchInput = document.getElementById('Search');
            const searchTerm = searchInput.value.trim().toLowerCase();
            const loanContainers = document.querySelectorAll('.client__payment');

            loanContainers.forEach(container => {
                const fullNameElement = container.querySelector('a');
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
            }
            if (clearButton) {
                clearButton.addEventListener('click', clearSearch);
            }
            if (searchInput) {
                searchInput.addEventListener('keyup', function (e) {
                    if (e.key === 'Enter') {
                        searchClients();
                    }
                });
            }
        });
    </script>
    <script>
        function toggleForm(event) {
            if (event.target.tagName === 'INPUT' && event.target.type !== 'checkbox') return;

            const container = event.currentTarget;
            const form = container.querySelector('.form-container');
            form.classList.toggle('hidden');
            form.classList.toggle('slide-in');
        }

        function handleInput(event) {
            event.stopPropagation();
            if (event.key === 'Enter') {
                closeForm(event);
            }
        }

        function closeForm(event) {
            event.stopPropagation();
            const form = event.target.closest('.form-container');
            form.classList.remove('slide-in');
            form.classList.add('slide-out');
            setTimeout(() => {
                form.classList.add('hidden');
                form.classList.remove('slide-out');
            }, 300);
        }
    </script>
@endpush
