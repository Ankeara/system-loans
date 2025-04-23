<aside class="aside w-64 flex-shrink-0 bg-gray-50 drop-shadow-md overflow-scroll">
    <div class="flex h-full w-full flex-col justify-between">
        <div class="px-4 py-6">
            <span
                class="sticky top-0 left-0 bg-gray-50 border-b z-[20] border-gray-100 flex items-center justify-center py-2 text-gray-600 font-bold text-3xl">
                ប្រាក់កម្ចី
            </span>

            <ul class="mt-6 space-y-1">
                <!-- Home Item -->
                <li class="relative mt-4">
                    <span class="absolute top-0 left-[-20px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.dashboard' ? '' : 'hidden' }}"></span>
                    <a href="{{ route('application.pages.dashboard') }}"
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium shadow-sm {{ Route::currentRouteName() === 'application.pages.dashboard' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24" fill="none"
                            width="20" height="20" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"
                            stroke="currentColor">
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M10 12h4v4h-4z"></path>
                        </svg>
                        ទំព័រដើម <!-- Dashboard -->
                    </a>
                </li>

                <!-- Clients Item with Submenu -->
                <li class="relative mt-4 menu-item">
                    <a href="#"
                        class="flex items-center justify-between rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-600 shadow-sm toggle-btn hover:bg-slate-100"
                        onclick="toggleSubmenu(event)">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20"
                                height="20" stroke-width="1.5">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.267 0 .529 .026 .781 .076"></path>
                                <path d="M19 16l-2 3h4l-2 3"></path>
                            </svg>
                            អតិថិជន <!-- Clients -->
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor" id="chevron">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu hidden transition-all duration-300 ease-in-out overflow-hidden ml-4">
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.clients.clients' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.clients.clients') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.clients.clients' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    <path d="M15 19l2 2l4 -4"></path>
                                </svg>
                                បញ្ជីអតិថិជន <!-- Client List -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.clients.add-client' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.clients.add-client') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.clients.add-client' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                </svg>
                                បន្ថែមអតិថិជន <!-- Add Client -->
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Loans Item with Submenu -->
                <li class="relative mt-4 menu-item">
                    <a href="#"
                        class="flex items-center justify-between rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-600 shadow-sm toggle-btn hover:bg-slate-100"
                        onclick="toggleSubmenu(event)">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" class="mr-1"
                                width="20" height="20" stroke-width="1.5">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3"></path>
                                <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                <path d="M19 21v1m0 -8v1"></path>
                            </svg>
                            អតិថិជនចងការប្រាក់ <!-- Loan Clients -->
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor" id="chevron">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu hidden transition-all duration-300 ease-in-out overflow-hidden ml-4">
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.loans.loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.loans.loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.loans.loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    <path d="M15 19l2 2l4 -4"></path>
                                </svg>
                                បញ្ជីអតិថិជនចងការប្រាក់ <!-- Loan Client List -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.loans.add-loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.loans.add-loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.loans.add-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                </svg>
                                បន្ថែមអតិថិជនចងការប្រាក់ <!-- Add Loan Client -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.loans.loan-riel' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.loans.loan-riel') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.loans.loan-riel' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M5 10h3v10h-3z"></path>
                                    <path d="M14.5 4h-9.5v3h9.4a1.5 1.5 0 0 1 0 3h-3.4v4l4 6h4l-5 -7h.5a4.5 4.5 0 1 0 0 -9z"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយរៀល <!-- Loan Clients in Riel -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.loans.loan-baht' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.loans.loan-baht') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.loans.loan-baht' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M8 6h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 12h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 6v12"></path>
                                    <path d="M11 4v2"></path>
                                    <path d="M11 18v2"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយបាត <!-- Loan Clients in Baht -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.loans.loan-dollar' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.loans.loan-dollar') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.loans.loan-dollar' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                    <path d="M12 3v3m0 12v3"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយដុល្លា <!-- Loan Clients in Dollar -->
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Payment Loan Item -->
                <li class="relative mt-4">
                    <span class="absolute top-0 left-[-20px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.payments.payment-loan' ? '' : 'hidden' }}"></span>
                    <a href="{{ route('application.pages.payments.payment-loan') }}"
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium {{ Route::currentRouteName() === 'application.pages.payments.payment-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"
                            stroke-width="1.5">
                            <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M19 22v-6"></path>
                            <path d="M22 19l-3 -3l-3 3"></path>
                        </svg>
                        ការឡើងការប្រាក់ប្រចាំ <!-- Payment Loan -->
                    </a>
                </li>

                <!-- Return Loans Item with Submenu -->
                <li class="relative mt-4 menu-item">
                    <a href="#"
                        class="flex items-center justify-between rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-600 shadow-sm toggle-btn hover:bg-slate-100"
                        onclick="toggleSubmenu(event)">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                width="20" height="20" stroke-width="1.5">
                                <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path>
                                <path d="M3 10h18"></path>
                                <path d="M7 15h.01"></path>
                                <path d="M11 15h2"></path>
                                <path d="M16 19h6"></path>
                                <path d="M19 16l-3 3l3 3"></path>
                            </svg>
                            ការបកទឹកប្រាក់ <!-- Return Loans -->
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor" id="chevron">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu hidden transition-all duration-300 ease-in-out overflow-hidden ml-4">
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.return-loans.return-loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    <path d="M15 19l2 2l4 -4"></path>
                                </svg>
                                បញ្ជីអតិថិជនបកទឹកប្រាក់ <!-- Return Loan List -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.return-loans.add-return-loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.return-loans.add-return-loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.return-loans.add-return-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                </svg>
                                បន្ថែមអតិថិជនបកទឹកប្រាក់ <!-- Add Return Loan -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-riel' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.return-loans.return-loan-riel') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-riel' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M5 10h3v10h-3z"></path>
                                    <path d="M14.5 4h-9.5v3h9.4a1.5 1.5 0 0 1 0 3h-3.4v4l4 6h4l-5 -7h.5a4.5 4.5 0 1 0 0 -9z"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយរៀល <!-- Return Loans in Riel -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-baht' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.return-loans.return-loan-baht') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-baht' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M8 6h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 12h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 6v12"></path>
                                    <path d="M11 4v2"></path>
                                    <path d="M11 18v2"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយបាត <!-- Return Loans in Baht -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-dollar' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.return-loans.return-loan-dollar') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.return-loans.return-loan-dollar' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                    <path d="M12 3v3m0 12v3"></path>
                                </svg>
                                បញ្ជីអតិថិជនជាលុយដុល្លា <!-- Return Loans in Dollar -->
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- End Loans Item with Submenu -->
                <li class="relative mt-4 menu-item">
                    <a href="#"
                        class="flex items-center justify-between rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-600 shadow-sm toggle-btn hover:bg-slate-100"
                        onclick="toggleSubmenu(event)">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                            ការចងការប្រាក់បានបញ្ចប់ <!-- End Loans -->
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-transform duration-300" viewBox="0 0 20 20"
                            fill="currentColor" id="chevron">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu hidden transition-all duration-300 ease-in-out overflow-hidden ml-4">
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.end-loans.end-loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    <path d="M15 19l2 2l4 -4"></path>
                                </svg>
                                បញ្ជីអតិថិជនទាំងអស់ <!-- All End Loans -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan-paid' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.end-loans.end-loan-paid') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan-paid' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6"></path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h16"></path>
                                    <path d="M15 19l2 2l4 -4"></path>
                                </svg>
                                បញ្ជីអតិថិជនបានបញ្ចប់ដោយបង់ប្រាក់ <!-- End Loans Paid -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan-pending' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.end-loans.end-loan-pending') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.end-loans.end-loan-pending' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3"></path>
                                    <path d="M16 3v4"></path>
                                    <path d="M8 3v4"></path>
                                    <path d="M4 11h12"></path>
                                    <path d="M20 14l2 2h-3"></path>
                                    <path d="M20 18l2 -2"></path>
                                    <path d="M19 16a3 3 0 1 0 2 5.236"></path>
                                </svg>
                                បញ្ជីអតិថិជនបានបញ្ចប់ដោយបកទឹកប្រាក់ <!-- End Loans Pending -->
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports Item with Submenu -->
                <li class="relative mt-4 menu-item">
                    <a href="#"
                        class="flex items-center justify-between rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-600 shadow-sm toggle-btn hover:bg-slate-100"
                        onclick="toggleSubmenu(event)">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                width="20" height="20" stroke-width="1.5">
                                <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M7 3v4h4"></path>
                                <path d="M9 17l0 4"></path>
                                <path d="M17 14l0 7"></path>
                                <path d="M13 13l0 8"></path>
                                <path d="M21 12l0 9"></path>
                            </svg>
                            គ្រប់គ្រងរបាយការណ៍ <!-- Manage Reports -->
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 transition-transform duration-300"
                            viewBox="0 0 20 20" fill="currentColor" id="chevron">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <ul class="submenu hidden transition-all duration-300 ease-in-out overflow-hidden ml-4">
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.profits' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.profits') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.profits' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>
                                </svg>
                                បញ្ជីប្រាក់ចំណេញសរុប <!-- Total Profits -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.clients' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.clients') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.clients' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                                បញ្ជីអតិថិជនសរុប <!-- Total Clients -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.loans' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.loans') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.loans' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3"></path>
                                    <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                    <path d="M19 21v1m0 -8v1"></path>
                                </svg>
                                បញ្ជីអតិថិជនចងការទឹកប្រាក់សរុប <!-- Total Loan Clients -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.return-loan' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.return-loan') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.return-loan' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    class="mr-1 mt-[-3px]" width="20" height="20" stroke-width="1.5">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    <path d="M19 22v-6"></path>
                                    <path d="M22 19l-3 -3l-3 3"></path>
                                </svg>
                                បញ្ជីអតិថិជនបកទឹកប្រាក់សរុប <!-- Total Return Loans -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.loan-high-riel' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.loan-high-riel') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.loan-high-riel' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M5 10h3v10h-3z"></path>
                                    <path d="M14.5 4h-9.5v3h9.4a1.5 1.5 0 0 1 0 3h-3.4v4l4 6h4l-5 -7h.5a4.5 4.5 0 1 0 0 -9z"></path>
                                </svg>
                                បញ្ជីអតិថិជនដែលចងការប្រាក់ខ្ពស់បំផុតជាលុយរៀល <!-- Highest Loans in Riel -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.loan-high-baht' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.loan-high-baht') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.loan-high-baht' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M8 6h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 12h5a3 3 0 0 1 3 3v.143a2.857 2.857 0 0 1 -2.857 2.857h-5.143"></path>
                                    <path d="M8 6v12"></path>
                                    <path d="M11 4v2"></path>
                                    <path d="M11 18v2"></path>
                                </svg>
                                បញ្ជីអតិថិជនដែលចងការប្រាក់ខ្ពស់បំផុតជាលុយបាត <!-- Highest Loans in Baht -->
                            </a>
                        </li>
                        <li class="relative mt-1">
                            <span class="absolute top-0 left-[-24px] w-3 h-full bg-teal-600 rounded {{ Route::currentRouteName() === 'application.pages.reports.loan-high-dollar' ? '' : 'hidden' }}"></span>
                            <a href="{{ route('application.pages.reports.loan-high-dollar') }}"
                                class="flex items-center px-3 py-2 rounded text-xs {{ Route::currentRouteName() === 'application.pages.reports.loan-high-dollar' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                                    stroke-width="1.5">
                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                    <path d="M12 3v3m0 12v3"></path>
                                </svg>
                                បញ្ជីអតិថិជនដែលចងការប្រាក់ខ្ពស់បំផុតជាលុយដុល្លា <!-- Highest Loans in Dollar -->
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="relative mt-4">
                    <button id="openCalculator" type="button"
                        class="flex items-center rounded-md w-full px-3 py-2 text-sm font-medium shadow-sm bg-white text-gray-600 hover:bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" class="mr-1 mt-[-3px]" width="20" height="20"
                            stroke-width="1.5">
                            <path d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                            <path d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z"></path>
                            <path d="M8 14l0 .01"></path>
                            <path d="M12 14l0 .01"></path>
                            <path d="M16 14l0 .01"></path>
                            <path d="M8 17l0 .01"></path>
                            <path d="M12 17l0 .01"></path>
                            <path d="M16 17l0 .01"></path>
                        </svg>
                        ម៉ាសុីនគិតលេខ
                    </button>
                </li>
            </ul>
        </div>
        <div class="sticky z-50 inset-x-0 bottom-0 bg-gray-50 border-t border-gray-100">
            <div class="px-4 py-2">
                <a href="{{ route('application.admin.logout') }}"
                    class="flex items-center rounded-md bg-red-500 px-3 py-2 text-sm font-medium text-white drop-shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 mt-[-3px]" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"
                        stroke-width="1.5">
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M17 21l4 -4"></path>
                        <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5"></path>
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.58 0 1.103 .247 1.468 .642"></path>
                    </svg>
                    បិទកម្មវិធី <!-- Logout -->
                </a>
            </div>
        </div>
    </div>
</aside>
