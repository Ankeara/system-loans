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
                            <a href="#" class="block transition-colors hover:text-teal-500"> {{ $client->full_Name }} </a>
                        </li>
                    </ol>
                </nav>
                <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                    href="{{ route('application.pages.clients.clients') }}">
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
                <div class="h-auto rounded bg-white relative border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                    <div class="block">
                        <img src="{{ asset('/src/assets/uploads/clients/profile/' . $client->profile) }}" alt="avatar" class=" size-40 shadow-md rounded-full object-cover" />
                    </div>
                    <div class="mt-5 flex items-center">
                        <div class="big-label">
                            <div class="mr-1 mt-2"><span class="text-xl">ឈ្មោះអតិថិជន</span></div>
                            <div class="mr-1 mt-2"><span class="text-xl">ភេទ</span></div>
                            <div class="mr-1 mt-2"><span class="text-xl">លេខទូរស័ព្ទ</span></div>
                            <div class="mr-1 mt-2"><span class="text-xl">អសាយដ្ឋាន</span></div>
                        </div>
                        <div class="dot">
                            <div class="ml-1 mr-1 mt-2"><span class="text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-xl">៖</span></div>
                            <div class="ml-1 mr-1 mt-2"><span class="text-xl">៖</span></div>
                        </div>
                        <div class="detail">
                            <div class="ml-1 mt-2"><span class="text-xl">{{ $client->full_Name }}</span></div>
                            <div class="ml-1 mt-2">
                                <span class="text-xl">
                                    @if ($client->gender == 1)
                                        ប្រុស
                                    @elseif ($client->gender == 2)
                                        ស្រី
                                    @elseif ($client->gender == 0)
                                        ផ្សេងៗ
                                    @else
                                        មិនមែនជាអ្វី
                                    @endif
                                </span>
                            </div>
                            <div class="ml-1 mt-2"><span class="text-xl">{{ $client->phone_Number }}</span></div>
                            <div class="ml-1 mt-2"><span class="text-xl">{{ $client->address }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="h-auto rounded bg-white border border-gray-200 px-5 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
                        <div class="h-auto rounded">
                            <span class="mb-1">អត្តសញ្ញាញបត្រ</span>
                            <div class="block mt-1">
                                <img src="{{ asset('/src/assets/uploads/clients/profile/' . $client->profile) }}" alt="avatar" class=" size-full shadow-md rounded object-cover" />
                            </div>
                        </div>
                        <div class="h-auto rounded">
                            <span class="mb-1">រូបថត</span>
                            <div class="block mt-1">
                                <img src="{{ asset('/src/assets/uploads/clients/card/' . $client->card_ID) }}" alt="avatar" class=" size-full shadow-md rounded object-cover" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
@section('calculator')
    @include('application.components.calculator')
@endsection
@push('scripts_multiple')

@endpush
