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
                            <a href="#" class="block transition-colors text-teal-600"> អតិថិជន </a>
                        </li>
                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>
                        <li>
                            <a href="#" class="block transition-colors hover:text-teal-500"> {{ $endLoanView->loan->client->full_Name }} </a>
                        </li>
                    </ol>
                </nav>
                <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                    href="{{ route('application.pages.end-loans.end-loan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" class="mr-1" width="20" height="20" stroke-width="1.5">
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    ថយក្រោយ
                </a>
            </div>
            <div class="header__btn__search flex items-center justify-between mt-6">
                <span class="text-xl text-gray-600">ព៍ត័មានអតិថិជន</span>
            </div>
            <div class="grid grid-cols-1 gap-4 mt-5 lg:grid-cols-2 lg:gap-8">
                <div class=" rounded bg-white relative border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                    <span class="text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានអតិថិជន</span>
                    <div class="block">
                        <img src="{{ asset('/src/assets/uploads/clients/profile/' . $endLoanView->loan->client->profile) }}" alt="avatar" class=" size-40 shadow-md rounded-full object-cover" />
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
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->client->full_Name }}</span></div>
                            <div class="ml-1 mt-2">
                                <span class="text-sm md:text-xl">
                                    @if ($endLoanView->loan->client->gender == 1)
                                        ប្រុស
                                    @elseif ($endLoanView->loan->client->gender == 2)
                                        ស្រី
                                    @elseif ($endLoanView->loan->client->gender == 0)
                                        ផ្សេងៗ
                                    @else
                                        មិនមែនជាអ្វី
                                    @endif
                                </span>
                            </div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->client->phone_Number }}</span></div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->client->address }}</span></div>
                        </div>
                    </div>
                    <div class="block w-full h-72 mt-5 mb-5">
                        <img src="{{ asset('/src/assets/uploads/clients/card/' . $endLoanView->loan->client->card_ID) }}" alt="avatar"
                            class=" size-full shadow-md rounded object-contain" />
                    </div>
                    <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនទឹកប្រាក់</span>
                    <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                        <div class="big-label">
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនប្រាក់កម្ចីជារៀល</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនប្រាក់កម្ចីជាបាត</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនប្រាក់កម្ចីជាដុល្លារ</span></div>
                        </div>
                        <div class="dot">
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                        </div>
                        <div class="detail">
                            <div class="ml-1 mt-2">
                                <span class="text-sm md:text-xl">
                                    @if ($endLoanView->loan->loan_Amount_Riel == null)
                                    មិនមាន
                                    @elseif ($endLoanView->loan->loan_Amount_Riel != null)
                                        {{ $endLoanView->loan->loan_Amount_Riel }} រៀល
                                    @endif
                                </span>
                            </div>
                            <div class="ml-1 mt-2">
                                <span class="text-sm md:text-xl">
                                    @if ($endLoanView->loan->loan_Amount_Baht == null)
                                        មិនមាន
                                    @elseif ($endLoanView->loan->loan_Amount_Baht != null)
                                        {{ $endLoanView->loan->loan_Amount_Baht }} បាត
                                    @endif
                                </span>
                            </div>
                            <div class="ml-1 mt-2">
                                <span class="text-sm md:text-xl">
                                    @if ($endLoanView->loan->loan_Amount_Dollar == null)
                                        មិនមាន
                                    @elseif ($endLoanView->loan->loan_Amount_Dollar != null)
                                        {{ $endLoanView->loan->loan_Amount_Dollar }} ដុល្លារ
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <span class="mt-5 mb-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនត្រូវទូទាត់</span>
                    <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                        <div class="big-label">
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- អត្រាការប្រាក់</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ចំនួនដែលត្រួវទូទាត់</span></div>
                        </div>
                        <div class="dot">
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                        </div>
                        <div class="detail">
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->interest_Rate }}</span></div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->payment_Amount }}</span></div>
                        </div>
                    </div>
                    <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនរយៈពេល</span>
                    <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                        <div class="big-label">
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- រយៈពេលខ្ចី</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទចាប់ផ្តើម</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទបញ្ចប់</span></div>
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- កាលបរិច្ឆេទបង្កើត</span></div>
                        </div>
                        <div class="dot">
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                        </div>
                        <div class="detail">
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->loan_Term }} ថ្ងៃ</span></div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->start_Date }}</span></div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->end_Date }}</span></div>
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">{{ $endLoanView->loan->created_at }}</span></div>
                        </div>
                    </div>
                    <span class="mt-5 text-xl underline underline-offset-2 text-teal-600">ព័ត៍មានចំនួនរយៈពេល</span>
                    <div class="mt-5 mb-5 px-0 flex items-center md:px-3">
                        <div class="big-label">
                            <div class="mr-1 mt-2"><span class="text-sm md:text-xl">- ស្ថានភាព</span></div>
                        </div>
                        <div class="dot">
                            <div class="ml-1 mr-1 mt-2"><span class="text-sm md:text-xl">៖</span></div>
                        </div>
                        <div class="detail">
                            <div class="ml-1 mt-2"><span class="text-sm md:text-xl">
                                @if ($endLoanView->status == 'Paid')
                                    <span
                                        class="inline-flex items-center justify-center rounded-sm bg-emerald-100 px-4 py-2 text-emerald-700 dark:bg-emerald-700 dark:text-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm whitespace-nowrap">បង់រួច</p>
                                    </span>
                                @elseif ($endLoanView->status == 'Pending')
                                    <span
                                        class="inline-flex items-center justify-center rounded-sm bg-amber-100 px-4 py-2 text-amber-700 dark:bg-amber-700 dark:text-amber-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9.75h4.875a2.625 2.625 0 010 5.25H12M8.25 9.75L10.5 7.5M8.25 9.75L10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                                        </svg>

                                        <p class="text-sm whitespace-nowrap">បកប្រាក់កម្ចី</p>
                                    </span>
                                @endif
                            </span></div>
                        </div>
                    </div>
                </div>
                <div class=" rounded bg-white border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-8">
                        <div class="h-auto rounded">
                            <span class="mb-1">រូបថត</span>
                            <div class="block mt-1">
                                <img src="{{ asset('/src/assets/uploads/loans/pictures/' . $endLoanView->loan->picture) }}" alt="avatar" class=" size-full shadow-md rounded object-cover" />
                            </div>
                        </div>
                        <div class="h-auto rounded">
                            <span class="mb-1">វិដេអូ</span>
                            <div class="block mt-1">
                                <video src="{{ asset('/src/assets/uploads/loans/videos/' . $endLoanView->loan->video) }}" alt="avatar" class="w-[100%] h-[500px] shadow-md rounded object-cover" controls autoplay></video>
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
