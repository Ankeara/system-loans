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
                            <span class="text-xl text-gray-600 hidden lg:block">អតិថិជន</span>
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
            @include('application.message')
                <div class="p-6 khmer__font">
                    <div class="flex items-center justify-between">
                        <nav aria-label="Breadcrumb" class="">
                            <ol class="flex items-center gap-1 text-sm text-gray-600">
                                <li>
                                    <a href="{{ route('application.pages.dashboard') }}"
                                        class="block transition-colors text-teal-600"> ទំព័រដើម </a>
                                </li>
                                <li class="rtl:rotate-180">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4 text-teal-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                    </svg>
                                </li>
                                <li>
                                    <a href="#" class="block transition-colors text-teal-600"> អតិថិជនបកការប្រាក់សរុប </a>
                                </li>
                                <li class="rtl:rotate-180">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-4 text-teal-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                    </svg>
                                </li>
                                <li>
                                    <a href="#" class="block transition-colors hover:text-teal-500"> {{ $returnLoanView->loan->client->full_Name }} </a>
                                </li>
                            </ol>
                        </nav>
                        <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.return-loans.return-loan') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-1" width="20" height="20" stroke-width="1.5">
                                <path d="M9 14l-4 -4l4 -4"></path>
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                            </svg>
                            ថយក្រោយ
                        </a>
                    </div>
                    <div class="header__btn__search flex items-center justify-between mt-6">
                        <span class="text-xl text-gray-600">ព៍ត័មានអតិថិជនបកការប្រាក់</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-5 lg:grid-cols-2 lg:gap-8">
                        <div
                            class="rounded bg-white relative border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                            <span class="text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានអតិថិជន</span>
                            <div class="block">
                                <img src="{{ asset('/src/assets/uploads/clients/profile/' . $returnLoanView->loan->client->profile) }}"
                                    alt="avatar" class="size-40 shadow-md rounded-full object-cover" />
                            </div>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ឈ្មោះអតិថិជន</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ភេទ</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- លេខទូរស័ព្ទ</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- អសាយដ្ឋាន</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    <div class="ml-1 mt-2"><span
                                            class="text-sm md:text-xl">{{ $returnLoanView->loan->client->full_Name }}</span></div>
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            @if ($returnLoanView->loan->client->gender == 1)
                                                ប្រុស
                                            @elseif ($returnLoanView->loan->client->gender == 2)
                                                ស្រី
                                            @elseif ($returnLoanView->loan->client->gender == 0)
                                                ផ្សេងៗ
                                            @else
                                                មិនមែនជាអ្វី
                                            @endif
                                        </span>
                                    </div>
                                    <div class="ml-1 mt-2"><span
                                            class="text-sm md:text-xl">{{ $returnLoanView->loan->client->phone_Number }}</span></div>
                                    <div class="ml-1 mt-2"><span
                                            class="text-sm md:text-xl">{{ $returnLoanView->loan->client->address }}</span></div>
                                </div>
                            </div>
                            <div class="block w-full h-72 mt-5 mb-5">
                                <img src="{{ asset('/src/assets/uploads/clients/card/' . $returnLoanView->loan->client->card_ID) }}"
                                    alt="ID Card" class="size-full shadow-md rounded object-contain" />
                            </div>

                            <!-- Loan Amount Section -->
                            <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនទឹកប្រាក់</span>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនប្រាក់កម្ចី</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    @php
    $currency = $returnLoanView->loan->currency;
    $loanAmount = $currency === 'riel' ? $returnLoanView->loan->loan_Amount_Riel :
        ($currency === 'baht' ? $returnLoanView->loan->loan_Amount_Baht :
            ($currency === 'dollar' ? $returnLoanView->loan->loan_Amount_Dollar : null));
    $symbol = $currency === 'riel' ? 'រៀល' : ($currency === 'baht' ? 'បាត' : 'ដុល្លារ');
                                    @endphp
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            {{ $loanAmount ? $loanAmount . ' ' . $symbol : 'មិនមាន' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Repayment Info Section -->
                            <span class="mt-5 mb-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនត្រូវទូទាត់</span>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- អត្រាការប្រាក់</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនដែលត្រូវទូទាត់</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    @php
    $interestRate = $currency === 'riel' ? $returnLoanView->loan->interest_Rate_Riel :
        ($currency === 'baht' ? $returnLoanView->loan->interest_Rate_Baht :
            ($currency === 'dollar' ? $returnLoanView->loan->interest_Rate_Dollar : null));
    $paymentAmount = $currency === 'riel' ? $returnLoanView->loan->payment_Amount_Riel :
        ($currency === 'baht' ? $returnLoanView->loan->payment_Amount_Baht :
            ($currency === 'dollar' ? $returnLoanView->loan->payment_Amount_Dollar : null));
                                    @endphp
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            {{ $interestRate ? $interestRate . '%' : 'មិនមាន' }}
                                        </span>
                                    </div>
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            {{ $paymentAmount ? $paymentAmount . ' ' . $symbol : 'មិនមាន' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Term Info Section -->
                            <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនរយៈពេល</span>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- រយៈពេលខ្ចី</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទចាប់ផ្តើម</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទបញ្ចប់</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទបង្កើត</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- រយៈពេលសល់</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $returnLoanView->loan->loan_Term }}
                                            ថ្ងៃ</span></div>
                                    <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $returnLoanView->loan->start_Date }}</span>
                                    </div>
                                    <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $returnLoanView->loan->end_Date }}</span>
                                    </div>
                                    <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $returnLoanView->loan->created_at }}</span>
                                    </div>
                                    <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $returnLoanView->day_left }} ថ្ងៃ</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Amount Info Section -->
                            <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនទឹកប្រាក់បន្ថែម</span>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ទឹកប្រាក់សល់</span></div>
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- បង្គុប់ទឹកប្រាក់</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    @php
    $moneyLeft = $currency === 'riel' ? $returnLoanView->money_left_Riel :
        ($currency === 'baht' ? $returnLoanView->money_left_Baht :
            ($currency === 'dollar' ? $returnLoanView->money_left_Dollar : null));
    $moreMoney = $currency === 'riel' ? $returnLoanView->more_money_Riel :
        ($currency === 'baht' ? $returnLoanView->more_money_Baht :
            ($currency === 'dollar' ? $returnLoanView->more_money_Dollar : null));
                                    @endphp
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            {{ $moneyLeft ? $moneyLeft . ' ' . $symbol : 'មិនមាន' }}
                                        </span>
                                    </div>
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            {{ $moreMoney ? $moreMoney . ' ' . $symbol : 'មិនមាន' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Section -->
                            <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ស្ថានភាព</span>
                            <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                                <div class="big-label">
                                    <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ស្ថានភាព</span></div>
                                </div>
                                <div class="dot">
                                    <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                                </div>
                                <div class="detail">
                                    <div class="ml-1 mt-2">
                                        <span class="text-sm md:text-xl">
                                            @if ($returnLoanView->status_return == '0')
                                                <span
                                                    class="inline-flex items-center justify-center rounded-sm bg-amber-100 px-4 py-2 text-amber-700 dark:bg-amber-700 dark:text-amber-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="-ms-1 me-1.5 size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 9.75h4.875a2.625 2.625 0 010 5.25H12M8.25 9.75L10.5 7.5M8.25 9.75L10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                                                    </svg>

                                                    <p class="text-sm whitespace-nowrap">បកប្រាក់កម្ចី</p>
                                                </span>
                                            @elseif ($returnLoanView->status_return == '1')
                                                <span
                                                    class="inline-flex items-center justify-center rounded-sm bg-amber-100 px-4 py-2 text-amber-700 dark:bg-amber-700 dark:text-amber-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 9.75h4.875a2.625 2.625 0 010 5.25H12M8.25 9.75L10.5 7.5M8.25 9.75L10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                                                    </svg>
                                                    <p class="text-sm whitespace-nowrap">បញ្ចប់</p>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Section -->
                        <div
                            class="rounded bg-white border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-8">
                                <div class="h-auto rounded">
                                    <span class="mb-1">រូបថត</span>
                                    <div class="block mt-1">
                                        <img src="{{ asset('/src/assets/uploads/loans/pictures/' . $returnLoanView->loan->picture) }}"
                                            alt="Loan Picture" class="size-full shadow-md rounded object-cover" />
                                    </div>
                                </div>
                                <div class="h-auto rounded">
                                    <span class="mb-1">វីដេអូ</span>
                                    <div class="block mt-1">
                                        <video src="{{ asset('/src/assets/uploads/loans/videos/' . $returnLoanView->loan->video) }}"
                                            alt="Loan Video" class="w-full h-full shadow-md rounded object-cover" controls autoplay></video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
@endsection

@push('scripts_multiple')

@endpush
