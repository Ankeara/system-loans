@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
    <style>
        th {
            position: relative;
            cursor: pointer;
        }

        /* Tooltip Styling */
        .tooltip {
            position: absolute;
            background-color: black;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 10;
        }
    </style>
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
                            <span class="text-xl text-gray-600 hidden lg:block">អតិថិជនដែលបកការប្រាក់</span>
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
                                    <a href="{{ route('application.pages.dashboard') }}" class="block transition-colors text-teal-600 "> ទំព័រដើម </a>
                                </li>

                                <li class="rtl:rotate-180">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4 text-teal-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                    </svg>
                                </li>

                                <li>
                                    <a href="#" class="block transition-colors hover:text-teal-500"> អតិថិជនដែលបកការប្រាក់ </a>
                                </li>
                            </ol>
                        </nav>
                        <a class="flex items-center rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.return-loans.add-return-loan') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="20" height="20" stroke-width="2">
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                <path d="M10 14h4"></path>
                                <path d="M12 12v4"></path>
                            </svg>
                            ចុះឈ្មោះបកការប្រាក់ថ្មី
                        </a>
                    </div>
                    <div class="header__btn__search flex items-center justify-between mt-6">
                        <span class="text-xl text-gray-600">អតិថិជនដែលបកការប្រាក់ទាំងអស់</span>
                        <div class="search__header flex items-center">
                            <label for="Search">
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
                                    <input type="text" placeholder="ឈ្មោះអតិថិជន" id="ReturnLoanInput" class="mt-0.5 w-full rounded-lg border-gray-200 px-10 h-10 text-sm drop-shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                                </div>
                            </label>
                            <button class="flex items-center rounded-md bg-teal-600 mt-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                            type="button" id="search">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" width="20" height="20" stroke-width="2">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                                    <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                    <path d="M20.2 20.2l1.8 1.8"></path>
                                </svg>
                                ស្វែងរក
                            </button>
                            <button class="flex items-center rounded-md bg-red-500 mt-2 ml-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                                type="button" id="clear">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" width="20" height="20" stroke-width="2">
                                    <path d="M18 6l-12 12"></path>
                                    <path d="M6 6l12 12"></path>
                                </svg>
                                សម្អាត
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-center flex-wrap gap-4 mt-6">
                        <!-- Base - Right -->
                        <a class="inline-block rounded-sm bg-teal-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:rotate-2 focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.return-loans.return-loan-riel') }}">
                            បកការប្រាក់កម្ចីសាច់ប្រាក់ជាលុយរៀល
                        </a>

                        <!-- Base - Left -->
                        <a class="inline-block rounded-sm bg-teal-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:-rotate-2 focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.return-loans.return-loan-baht') }}">
                            បកការប្រាក់កម្ចីសាច់ប្រាក់ជាលុយបាត
                        </a>

                        <!-- Border - Right -->
                        <a class="inline-block rounded-sm bg-teal-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:rotate-2 focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.return-loans.return-loan-dollar') }}">
                            បកការប្រាក់កម្ចីសាច់ប្រាក់ជាលុយដុល្លា
                        </a>
                    </div>
                    <div class="table__loan mt-10">
                        <div class="rounded-lg overflow-x-auto">
                            <table class="w-full bg-white  overflow-hidden shadow-md">
                                <thead class="sticky khmer__font top-0 text-gray-600 text-sm">
                                    <tr id="table-header">
                                        <th class="p-4 text-left">ល.រ</th>
                                        <th class="p-4 text-left">ឈ្មោះអតិថិជន</th>
                                        <th class="p-4 text-left">ចំនួនប្រាក់កម្ចី</th>
                                        <th class="p-4 text-left">អត្រាការប្រាក់</th>
                                        <th class="p-4 text-left">រយៈពេលខ្ចី</th>
                                        <th class="p-4 text-left">ទឹកប្រាក់ត្រូវទូទាត់</th>
                                        <th class="p-4 text-left">កាលបរិច្ឆេទចាប់ផ្តើម</th>
                                        <th class="p-4 text-left">កាលបរិច្ឆេទបញ្ចប់</th>
                                        <th class="p-4 text-left">ថ្ងៃនៅសល់</th>
                                        <th class="p-4 text-left">លុយនៅសល់</th>
                                        <th class="p-4 text-left">បង្កុបលុយ</th>
                                        <th class="p-4 text-left">កាលបរិច្ឆេទបង្កើត</th>
                                        <th class="p-4 text-left">សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700" id="ReturnLoansTable">

                                </tbody>
                            </table>
                        </div>
                        <div class="pagination__container flex items-center justify-between mt-5">
                            <div class="flex items-center space-x-2">
                                <label for="rowsPerPage" class="text-sm text-gray-700">បង្ហាញក្នុងមួយទំព័រ</label>
                                <select id="rowsPerPage"
                                    class="rounded-sm border-gray-200 px-2 text-sm drop-shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2">
                                    <option value="5">៥</option>
                                    <option value="10" selected>១០</option>
                                    <option value="20">២០</option>
                                </select>
                                <p></p>
                                <div class="text-sm text-gray-700">
                                    បង្ហាញ <span id="showing-range">1-5</span> នៃ <span id="total-items">0</span> អតិថិជន
                                </div>
                            </div>
                            <div class="pagination__num flex justify-center gap-1 text-gray-900">
                                <button onclick="goToPage(currentPage - 1)" disabled id="prev-button"
                                    class="flex items-center justify-center w-24 h-8 rounded border border-gray-200 transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                                    aria-label="Previous page">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    ថយក្រោយ
                                </button>
                                <div id="pagination-ReturnLoan-num" style="margin-top: -1px;"></div>
                                <button onclick="goToPage(currentPage + 1)" disabled id="next-button"
                                    class="flex items-center justify-center w-20 h-8 rounded border border-gray-200 transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                                    aria-label="Next page">
                                    ទៅមុខ
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
@endsection

@push('scripts_multiple')
    <script>

        // Function to hover show full header table
        function truncateText(text, maxLength = 6) {
                return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
            }
            // Create tooltip element
            const tooltip = document.createElement("div");
            tooltip.className = "tooltip";
            document.body.appendChild(tooltip);

            // Apply truncation and tooltip
            document.querySelectorAll("#table-header th").forEach(th => {
                const fullText = th.textContent.trim();

                // Store full text for tooltip
                th.dataset.fulltext = fullText;

                // Truncate text if needed
                th.textContent = truncateText(fullText);

                // Show tooltip on hover
                th.addEventListener("mouseenter", (e) => {
                    tooltip.textContent = fullText;
                    tooltip.style.visibility = "visible";
                    tooltip.style.opacity = "1";
                    tooltip.style.left = e.pageX + "px";
                    tooltip.style.top = (e.pageY - 30) + "px"; // Position slightly above
                });

                // Hide tooltip on mouse leave
                th.addEventListener("mouseleave", () => {
                    tooltip.style.visibility = "hidden";
                    tooltip.style.opacity = "0";
                });
            });

        // Simple JavaScript for modal handling
        function showModal(ReturnLoanId) {
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');

            // Set the form action with the ReturnLoan ID
            deleteForm.action = `/application/admin/ReturnLoan/delete/${ReturnLoanId}`;
            deleteModal.classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Function fetch data from backend to display in frontend ReturnLoans
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM is fully loaded');

            let currentPage = 1;
            let rowsPerPage = 10;
            let ReturnLoans = [];
            let filteredReturnLoans = [];

            try {
                ReturnLoans = @json($ReturnLoans);
                console.log('ReturnLoans data:', ReturnLoans);
                filteredReturnLoans = [...ReturnLoans];
                console.log('Filtered ReturnLoans:', filteredReturnLoans);
                displayPage(1);
            } catch (error) {
                console.error('Error initializing data:', error);
            }

            document.getElementById('rowsPerPage').addEventListener('change', (e) => {
                rowsPerPage = parseInt(e.target.value);
                console.log('Rows per page:', rowsPerPage);
                displayPage(1);
            });

            const ReturnLoanInput = document.getElementById('ReturnLoanInput');
            const searchButton = document.getElementById('search');
            const clearButton = document.getElementById('clear');

            ReturnLoanInput.addEventListener('input', () => {
                if (ReturnLoanInput.value.length >= 2) {
                    filterTable();
                } else {
                    resetTable();
                }
            });

            searchButton.addEventListener('click', filterTable);
            clearButton.addEventListener('click', () => {
                ReturnLoanInput.value = '';
                resetTable();
            });

            function displayPage(page) {
                console.log('Displaying page:', page);
                currentPage = page;
                const totalItems = filteredReturnLoans.length;
                const totalPages = Math.ceil(totalItems / rowsPerPage);
                console.log('Total items:', totalItems, 'Total pages:', totalPages);

                const start = (page - 1) * rowsPerPage;
                const end = Math.min(start + rowsPerPage, totalItems);
                const paginatedData = filteredReturnLoans.slice(start, end);
                console.log('Paginated data:', paginatedData);

                const tableBody = document.getElementById('ReturnLoansTable');
                if (!tableBody) {
                    console.error('Table body not found!');
                    return;
                }
                tableBody.innerHTML = '';

                if (totalItems === 0) {
                    tableBody.innerHTML = '<tr><td colspan="14" class="p-4 text-center">មិនមានអតិថិជនបកការប្រាក់ទេ</td></tr>';
                } else {
                    paginatedData.forEach((ReturnLoan, index) => {
                        console.log(`Rendering ReturnLoan ${index}:`, ReturnLoan);
                        const row = document.createElement('tr');
                        row.className = "odd:bg-gray-50 even:bg-white hover:bg-gray-100";

                        // Determine the active currency and corresponding fields
                        let loanAmount = "មិនមាន";
                        let interestRate = "មិនមាន";
                        let paymentAmount = "មិនមាន";
                        let moneyLeft = "មិនមាន";
                        let moreMoney = "មិនមាន";
                        let currencySymbol = "";

                        switch (ReturnLoan.loan.currency) {
                            case "riel":
                                loanAmount = ReturnLoan.loan.loan_Amount_Riel ? ReturnLoan.loan.loan_Amount_Riel : "មិនមាន";
                                interestRate = ReturnLoan.loan.interest_Rate_Riel ? ReturnLoan.loan.interest_Rate_Riel : "មិនមាន";
                                paymentAmount = ReturnLoan.loan.payment_Amount_Riel ? ReturnLoan.loan.payment_Amount_Riel : "មិនមាន";
                                moneyLeft = ReturnLoan.money_left_Riel ? ReturnLoan.money_left_Riel : "មិនមាន";
                                moreMoney = ReturnLoan.more_money_Riel ? ReturnLoan.more_money_Riel : "មិនមាន";
                                currencySymbol = "រៀល";
                                break;
                            case "baht":
                                loanAmount = ReturnLoan.loan.loan_Amount_Baht ? ReturnLoan.loan.loan_Amount_Baht : "មិនមាន";
                                interestRate = ReturnLoan.loan.interest_Rate_Baht ? ReturnLoan.loan.interest_Rate_Baht : "មិនមាន";
                                paymentAmount = ReturnLoan.loan.payment_Amount_Baht ? ReturnLoan.loan.payment_Amount_Baht : "មិនមាន";
                                moneyLeft = ReturnLoan.money_left_Baht ? ReturnLoan.money_left_Baht : "មិនមាន";
                                moreMoney = ReturnLoan.more_money_Baht ? ReturnLoan.more_money_Baht : "មិនមាន";
                                currencySymbol = "បាត";
                                break;
                            case "dollar":
                                loanAmount = ReturnLoan.loan.loan_Amount_Dollar ? ReturnLoan.loan.loan_Amount_Dollar : "មិនមាន";
                                interestRate = ReturnLoan.loan.interest_Rate_Dollar ? ReturnLoan.loan.interest_Rate_Dollar : "មិនមាន";
                                paymentAmount = ReturnLoan.loan.payment_Amount_Dollar ? ReturnLoan.loan.payment_Amount_Dollar : "មិនមាន";
                                moneyLeft = ReturnLoan.money_left_Dollar ? ReturnLoan.money_left_Dollar : "មិនមាន";
                                moreMoney = ReturnLoan.more_money_Dollar ? ReturnLoan.more_money_Dollar : "មិនមាន";
                                currencySymbol = "ដុល្លារ";
                                break;
                            default:
                                loanAmount = "មិនមាន";
                                interestRate = "មិនមាន";
                                paymentAmount = "មិនមាន";
                                moneyLeft = "មិនមាន";
                                moreMoney = "មិនមាន";
                                currencySymbol = "";
                        }

                        row.innerHTML = `
        <td class="p-4 text-left text-sm">${convertToKhmerNumbers(start + index + 1)}</td>
        <td class="p-4 text-left text-sm">${ReturnLoan.loan.client.full_Name}</td>
        <td class="p-4 text-left text-sm">${loanAmount} ${currencySymbol}</td>
        <td class="p-4 text-left text-sm">${interestRate}${interestRate !== "មិនមាន" ? "%" : ""}</td>
        <td class="p-4 text-left text-sm">${ReturnLoan.loan.loan_Term} ថ្ងៃ</td>
        <td class="p-4 text-left text-sm">${paymentAmount} ${currencySymbol}</td>
        <td class="p-4 text-left text-sm">${convertToKhmerNumbers(new Date(ReturnLoan.loan.start_Date).toLocaleDateString())}</td>
        <td class="p-4 text-left text-sm">${convertToKhmerNumbers(new Date(ReturnLoan.loan.end_Date).toLocaleDateString())}</td>
        <td class="p-4 text-left text-sm">${ReturnLoan.day_left}</td>
        <td class="p-4 text-left text-sm">${moneyLeft} ${currencySymbol}</td>
        <td class="p-4 text-left text-sm">${moreMoney} ${currencySymbol}</td>
        <td class="p-4 text-left text-sm">${convertToKhmerNumbers(new Date(ReturnLoan.loan.created_at).toLocaleDateString())}</td>
        <td class="p-4 text-left text-sm">
            <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded border border-gray-300 bg-white shadow-sm">
                <a href="/application/admin/return/view-return-loan/${ReturnLoan.id}" class="px-3 py-1.5 text-sm font-medium text-sky-600 transition-colors hover:bg-gray-50 hover:text-sky-600 focus:relative" aria-label="View">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </a>
                <!-- Delete button -->
                <a href="#" onclick="showModal('${ReturnLoan.id}')" class="px-3 py-1.5 text-sm font-medium text-red-600 transition-colors hover:bg-gray-50 hover:text-red-600 focus:relative" aria-label="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                </a>

                <!-- Modal -->
                <div id="deleteModal" class="khmer__font fixed z-[51] inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                        <h2 class="text-lg font-semibold text-gray-800">តើអ្នកប្រាកដទេ?</h2>
                        <p class="text-gray-600 mt-2">តើអ្នកពិតជាបក់លុបអតិថិជននេះមែនទេ? សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។</p>
                        <p class="text-red-600 mt-2">ការលុបនឹងលុបទិន្នន័យទាំងអស់ដែលទាក់ទងនឹងអតិថិជននេះ។</p>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('POST')
                            <div class="mt-4 flex justify-end space-x-3">
                                <button type="button" onclick="hideModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">បោះបង់</button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">លុប</button>
                            </div>
                        </form>
                    </div>
                </div>
            </span>
        </td>
    `;
                        tableBody.appendChild(row);
                    });
                }

                // Update "Showing X-Y of Z items"
                const showingRange = document.getElementById('showing-range');
                const totalItemsSpan = document.getElementById('total-items');
                if (totalItems === 0) {
                    showingRange.textContent = '0-0';
                } else {
                    const startItem = start + 1; // Add 1 because we want to show 1-based index
                    showingRange.textContent = `${convertToKhmerNumbers(startItem)}-${convertToKhmerNumbers(end)}`;
                }
                totalItemsSpan.textContent = convertToKhmerNumbers(totalItems);

                updatePaginationControls(totalPages);
            }

            function updatePaginationControls(totalPages) {
                const paginationContainer = document.getElementById('pagination-ReturnLoan-num');
                if (!paginationContainer) {
                    console.error('Pagination container not found!');
                    return;
                }
                paginationContainer.innerHTML = '';

                const pageNumbers = generatePageNumbers(currentPage, totalPages);
                pageNumbers.forEach(page => {
                    let button = document.createElement('button');
                    button.textContent = convertToKhmerNumbers(page.toString());
                    button.className = `border rounded h-8 w-12 ml-1 mr-1 ${page === currentPage ? 'bg-teal-600 text-white' : 'border-gray-100 bg-white text-xs text-gray-900'}`;

                    if (page === "...") {
                        button.disabled = true;
                        button.classList.add("text-gray-500");
                    } else {
                        button.classList.add("hover:bg-teal-500", "hover:text-white");
                        button.onclick = () => goToPage(page);
                    }

                    paginationContainer.appendChild(button);
                });

                document.getElementById('prev-button').disabled = currentPage <= 1;
                document.getElementById('next-button').disabled = currentPage >= totalPages;
            }

            function generatePageNumbers(current, total) {
                const pageNumbers = [1];
                if (current > 3) pageNumbers.push("...");
                const start = Math.max(2, current - 1);
                const end = Math.min(total - 1, current + 1);
                for (let i = start; i <= end; i++) pageNumbers.push(i);
                if (current < total - 2) pageNumbers.push("...");
                if (total > 1) pageNumbers.push(total);
                return pageNumbers;
            }

            function goToPage(page) {
                const totalPages = Math.ceil(filteredReturnLoans.length / rowsPerPage);
                if (page >= 1 && page <= totalPages) displayPage(page);
            }

            // Add Event Listeners for Prev & Next buttons
            document.getElementById('prev-button').addEventListener('click', () => {
                if (currentPage > 1) goToPage(currentPage - 1);
            });

            document.getElementById('next-button').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredReturnLoans.length / rowsPerPage);
                if (currentPage < totalPages) goToPage(currentPage + 1);
            });

            function filterTable() {
                const searchText = document.getElementById('ReturnLoanInput').value.toLowerCase();
                if (searchText.length < 2) return;

                filteredReturnLoans = ReturnLoans.filter(ReturnLoan =>
                    ReturnLoan.loan.client.full_Name.toLowerCase().includes(searchText)
                );
                displayPage(1);
            }

            function resetTable() {
                filteredReturnLoans = [...ReturnLoans];
                displayPage(1);
            }

            function convertToKhmerNumbers(input) {
                const khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
                return input.toString().replace(/\d/g, (digit) => khmerDigits[digit]);
            }
        });
    </script>
@endpush
