@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection


@section('content')
                <main class="flex-1 overflow-auto">
                    <header class="sticky top-0 z-10 flex items-center justify-between drop-shadow-md h-16 border-b border-gray-200 bg-white">
                        <div class="flex items-center px-5">
                            <span class="text-xl text-gray-600">លម្អិតកម្ចីរបស់អតិថិជន</span>
                        </div>
                        <div class="flex items-center justify-center px-5">
                            <span class="text-xl text-gray-600">{{ Auth::user()->name }}</span>
                            <img alt=""
                                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80"
                                class="size-10 ml-4 shadow-md rounded-full object-cover" />
                        </div>
                    </header>

                @include('application.message')
                    <div class="p-6 khmer__font">
                        <!-- Breadcrumb -->
                        <div class="flex items-center justify-between">
                            <nav aria-label="Breadcrumb" class="mb-6">
                                <ol class="flex items-center gap-1 text-sm text-gray-600">
                                    <li><a href="{{ route('application.pages.dashboard') }}" class="text-teal-600">ទំព័រដើម</a></li>
                                    <li class="rtl:rotate-180">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-teal-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                        </svg>
                                    </li>
                                    <li><a href="{{ route('application.pages.payments.payment-loan') }}"
                                            class="hover:text-teal-500">ការបង់ការប្រាក់</a></li>
                                    <li class="rtl:rotate-180">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-teal-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                        </svg>
                                    </li>
                                    <li><span class="text-gray-500">លម្អិតកម្ចី</span></li>
                                </ol>
                            </nav>
                            <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                                href="{{ route('application.pages.payments.payment-loan') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1" width="20" height="20" stroke-width="1.5">
                                    <path d="M9 14l-4 -4l4 -4"></path>
                                    <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                                </svg>
                                ថយក្រោយ
                            </a>
                        </div>

                        <!-- Client Info -->
                        <div class="bg-white p-4 rounded-lg shadow mb-6">
                            <div class="flex items-center">
                                <img src="{{ url('/src/assets/uploads/clients/profile/' . $client->profile) }}"
                                     class="w-16 h-16 rounded-full object-cover mr-4">
                                <div>
                                    <h2 class="text-xl font-medium">{{ $client->full_Name }}</h2>
                                    <p class="text-gray-600 mt-1">រយៈពេលកម្ចី: {{ $loan->loan_Term }} ថ្ងៃ</p>
                                    <p class="text-gray-600 mt-1">ស្ថានភាព:
                                        <span class="{{ $loan->endPaid ? 'text-teal-600' : 'text-orange-600' }}">
                                            {{ $loan->endPaid ? 'បានបង់រួច' : 'កំពុងបង់' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Payment Schedule -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-medium mb-4">កាលវិភាគបង់ប្រាក់</h3>
                            <form id="paymentScheduleForm" method="POST" action="{{ route('application.pages.payments.update-schedule', $loan->id) }}">
                                @csrf
                                @method('POST')
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    @foreach ($dailyStatus as $day => $status)
                                        <div class="flex items-center p-2 border rounded {{ $status['paid'] ? 'bg-teal-50' : 'bg-gray-50' }}">
                                            <input type="checkbox"
                                                name="payments[{{ $day }}][status]"
                                                id="day_{{ $day }}"
                                                class="mr-4 h-4 w-4 text-teal-600 focus:ring-teal-500"
                                                {{ $status['paid'] ? 'checked disabled' : '' }}
                                                onchange="showPaymentModal(this, {{ $day }}, {{ $loan->id }})">
                                            <label for="day_{{ $day }}" class="flex-1">
                                                ថ្ងៃទី {{ $day }} ({{ \Carbon\Carbon::parse($status['scheduled_date'])->format('d/m/Y') }})
                                                @if ($status['date'])
                                                    <span class="block mt-1 text-sm text-gray-600">
                                                        បានបង់: {{ $status['amount'] }}
                                                        @if ($status['not_paid'] > 0)
                                                            (ជំពាក់: {{ $status['not_paid'] }})
                                                        @endif
                                                        - {{ \Carbon\Carbon::parse($status['date'])->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="block mt-1 text-sm text-gray-600">
                                                        កំណត់បង់: {{ \Carbon\Carbon::parse($status['scheduled_date'])->format('d/m/Y') }}
                                                    </span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>

                        <!-- Payment Modal -->
                        <div id="paymentModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
                            <form method="POST" id="paymentForm" name="paymentForm" class="w-full max-w-md bg-white rounded-lg shadow-lg p-6 relative">
                                @csrf
                                <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closePaymentModal()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <input type="hidden" name="id_loan" id="id_loan">
                                <input type="hidden" name="payment_day" id="payment_day">
                                <input type="hidden" name="payment_Status" value="1">
                                <div class="mb-4">
                                    <label for="payment_amount" class="block text-[16px] font-medium text-gray-800">បញ្ចូលប្រាក់ត្រូវទូទាត់</label>
                                    <input type="number" id="payment_amount" name="payment_amount"
                                        class="w-full h-8 rounded-sm border-gray-200 px-2 mt-1 text-[16px] placeholder:text-[13px] drop-shadow border-none sm:text-[16px] focus:outline-none focus:ring-teal-500 focus:ring-2"
                                        placeholder="សូមបញ្ចូលប្រាក់ត្រូវទូទាត់" required>
                                </div>
                                <div class="mb-4">
                                    <label for="not_paid" class="block text-[16px] font-medium text-gray-800">ជំពាក់</label>
                                    <input type="number" id="not_paid" name="not_paid"
                                        class="w-full h-8 rounded-sm border-gray-200 px-2 mt-1 text-[16px] placeholder:text-[13px] drop-shadow border-none sm:text-[16px] focus:outline-none focus:ring-teal-500 focus:ring-2"
                                        placeholder="សូមបញ្ចូលចំនួនដែលជំពាក់" value="0">
                                </div>
                                <button type="button" onclick="submitPayment()"
                                    class="mt-2 bg-teal-600 text-white text-sm h-8 w-full rounded hover:bg-teal-700">
                                    រក្សាទុក
                                </button>
                            </form>
                        </div>
                    </div>
                </main>
@endsection

@push('scripts_multiple')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @push('scripts_multiple')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function showPaymentModal(checkbox, day, loanId) {
                if (!checkbox.checked) return; // Only show modal if checkbox is checked

                // Populate modal fields
                $('#id_loan').val(loanId);
                $('#payment_day').val(day);
                $('#payment_amount').val(''); // Clear previous value
                $('#not_paid').val('0'); // Default to 0 or fetch from server if needed

                // Show modal
                $('#paymentModal').removeClass('hidden');
            }

            function closePaymentModal() {
                $('#paymentModal').addClass('hidden');
                // Optionally uncheck the checkbox if the user cancels
                const day = $('#payment_day').val();
                $(`#day_${day}`).prop('checked', false);
            }

            function submitPayment() {
                    const form = $('#paymentForm');
                    const loanId = $('#id_loan').val();
                    const day = $('#payment_day').val();

                    $.ajax({
                        url: "{{ route('application.pages.payments.update-schedule', $loan->id) }}",
                        method: "POST",
                        data: form.serialize(),
                        success: function (response) {
                            if (response.status) {
                                const $checkbox = $(`#day_${day}`);
                                $checkbox.parent().addClass('bg-teal-50').removeClass('bg-gray-50');
                                $checkbox.prop('disabled', true); // Disable checkbox
                                closePaymentModal();
                                location.reload(); // Reload the page on every successful update
                            }
                        },
                        error: function (xhr) {
                            alert('មានបញ្ហាក្នុងការធ្វើបច្ចុប្បន្នភាព!');
                            closePaymentModal();
                        }
                    });
                }
        </script>
    @endpush
@endpush
