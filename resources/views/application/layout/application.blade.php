<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'ទំព័រដើម' }}</title>
    <link rel="stylesheet" href="{{ asset('src/styles/main.css') }}">
    <style>
        /* Existing styles unchanged for brevity */
        /* Submenu, form-container, and other styles remain as is */

        /* Popup styles */
        .popup {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }

        .popup.show {
            opacity: 1;
            visibility: visible;
        }

                .popup {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        .popup.show {
            opacity: 1;
            visibility: visible;
        }

        .popup-content {
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .popup-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: #374151;
        }

        /* Profile image container */
        .profile-image-container {
            display: inline-block;
        }
        .drag-handle {
        user-select: none; /* Prevents text selection while dragging */
        -webkit-user-drag: none; /* Prevents dragging the element itself in WebKit browsers */
    }
    </style>
    <style>
        /* Submenu styles */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .submenu:not(.hidden) {
            max-height: 500px;
            /* Adjust this value based on your content */
        }

        /* Ensure proper positioning */
        .relative {
            position: relative;
        }

        /* Basic styling to ensure visibility */
        .h-auto {
            height: auto;
        }

        .rounded {
            border-radius: 8px;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-700 {
            color: #374151;
        }

        .relative {
            position: relative;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .w-full {
            width: 100%;
        }

        .h-[225px] {
            height: 225px;
        }

        .bg-[#F9F9F9] {
            background-color: #F9F9F9;
        }

        .shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .border {
            border: 1px solid #e5e7eb;
        }

        .border-gray-200 {
            border-color: #e5e7eb;
        }

        .rounded-[8px] {
            border-radius: 8px;
        }

        .object-cover {
            object-fit: cover;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mb-5 {
            margin-bottom: 1.25rem;
        }

        .form-container {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: transform 0.3s ease-in-out;
        }

        .form-container.hidden {
            display: none;
        }

        .form-container.slide-in {
            opacity: 1;
        }

        .form-container.slide-out {
            opacity: 0;
        }
    </style>
</head>

<body class="min-h-screen bg-white">
    <div class="flex h-screen">
        <!-- Aside (Sidebar) -->
        @yield('asidebar')

        <!-- Main Content Area -->
        <main class="flex-1 overflow-auto">
            @yield('content')
        </main>

        <!-- Calculator Modal -->
        <div id="calculatorModal" class="fixed z-[100] inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="calculator relative bg-gray-800 p-4 rounded-lg w-[320px] sm:w-[350px] sm:h-auto">
                <div class="drag-handle cursor-move flex justify-between items-center">
                    <span class="text-white text-sm">ម៉ាសុីនគិតលេខ</span>
                    <button id="closeCalculator" class="text-white text-2xl">×</button>
                </div>
                <div class="display bg-gray-900 text-white p-4 rounded mt-2 mb-4">
                    <div class="history text-sm text-gray-400 min-h-[1.5rem]"></div>
                    <div class="result text-2xl text-right">0</div>
                </div>
                <div class="buttons grid grid-cols-4">
                    <button class="operator bg-gray-700 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]" style="color: #FF3B30;">C</button>
                    <button class="operator bg-gray-700 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">←</button>
                    <button class="operator bg-gray-700 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">%</button>
                    <button class="operator bg-orange-500 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">/</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">7</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">8</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">9</button>
                    <button class="operator bg-orange-500 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">×</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">4</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">5</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">6</button>
                    <button class="operator bg-orange-500 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">-</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">1</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">2</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">3</button>
                    <button class="operator bg-orange-500 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">+</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)] col-span-2">0</button>
                    <button class="number bg-gray-600 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">.</button>
                    <button class="operator bg-orange-500 text-white p-[20px] border border-[rgba(255, 255, 255, 0.1)]">=</button>
                </div>
            </div>
        </div>

        <!-- User Details Popup -->
        <div id="userPopup" class="popup">
            <div class="popup-content">
                <span id="closePopup" class="popup-close">&times;</span>
                <h2 class="text-xl font-semibold mb-4">User Details</h2>
                <div id="userDetails">
                    <p><strong>Name:</strong> {{ Auth::check() ? Auth::user()->name : 'Guest' }}</p>
                    <p><strong>Email:</strong> {{ Auth::check() ? (Auth::user()->email ?? 'Not provided') : 'N/A' }}</p>
                    <!-- Add more fields as available in Auth::user() -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('src/scripts/app.js') }}"></script>
    <script src="{{ asset('src/scripts/chart.js') }}"></script>
    @stack('scripts_multiple')
    @stack('scripts_chart_client')
    @stack('scripts_chart_loan')
    @stack('scripts_chart_profit')
    @stack('scripts_chart_return')
   <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Calculator Logic
        const calculatorModal = document.getElementById('calculatorModal');
        const openCalculator = document.getElementById('openCalculator');
        const closeCalculator = document.getElementById('closeCalculator');
        const displayResult = document.querySelector('.calculator .result');
        const displayHistory = document.querySelector('.calculator .history');
        const buttons = document.querySelectorAll('.calculator .buttons button');

        let currentInput = '';
        let history = '';
        let operator = null;
        let firstOperand = null;

        // Debug: Verify elements
        console.log('Open Calculator Button:', openCalculator);
        console.log('Calculator Modal:', calculatorModal);

        // Open calculator
        if (openCalculator) {
            openCalculator.addEventListener('click', () => {
                calculatorModal.classList.remove('hidden');
                console.log('Calculator opened');
            });
        } else {
            console.error('Open Calculator button not found');
        }

        // Close calculator
        if (closeCalculator) {
            closeCalculator.addEventListener('click', () => {
                calculatorModal.classList.add('hidden');
                resetCalculator();
                console.log('Calculator closed');
            });
        }

        // Calculator button handlers
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const value = button.textContent;

                if (button.classList.contains('number')) {
                    handleNumber(value);
                } else if (button.classList.contains('operator')) {
                    handleOperator(value);
                }

                console.log(`Button pressed: ${value}, Current Input: ${currentInput}, Operator: ${operator}, First Operand: ${firstOperand}, History: ${history}`);
            });
        });

        function handleNumber(value) {
            currentInput += value;
            displayResult.textContent = currentInput;
        }

        function handleOperator(value) {
            switch (value) {
                case 'C':
                    resetCalculator();
                    displayResult.textContent = '0';
                    displayHistory.textContent = '';
                    break;
                case '←':
                    currentInput = currentInput.slice(0, -1);
                    displayResult.textContent = currentInput || '0';
                    break;
                case '±':
                    if (currentInput) {
                        currentInput = (parseFloat(currentInput) * -1).toString();
                        displayResult.textContent = currentInput;
                    }
                    break;
                case '%':
                    if (currentInput) {
                        currentInput = (parseFloat(currentInput) / 100).toString();
                        displayResult.textContent = currentInput;
                    }
                    break;
                case '=':
                    if (firstOperand !== null && operator && currentInput) {
                        const secondOperand = parseFloat(currentInput);
                        const result = calculate(firstOperand, secondOperand, operator);
                        if (result === 'Error') {
                            displayResult.textContent = 'Error';
                            displayHistory.textContent = '';
                            resetCalculator();
                        } else {
                            displayResult.textContent = result;
                            history = `${firstOperand} ${operator} ${secondOperand} = ${result}`;
                            displayHistory.textContent = history;
                            currentInput = result.toString();
                            firstOperand = null;
                            operator = null;
                        }
                    }
                    break;
                default:
                    if (currentInput) {
                        if (firstOperand === null) {
                            firstOperand = parseFloat(currentInput);
                            operator = value;
                            history = `${firstOperand} ${operator}`;
                            displayHistory.textContent = history;
                            currentInput = '';
                        } else {
                            const secondOperand = parseFloat(currentInput);
                            const result = calculate(firstOperand, secondOperand, operator);
                            if (result === 'Error') {
                                displayResult.textContent = 'Error';
                                displayHistory.textContent = '';
                                resetCalculator();
                            } else {
                                firstOperand = result;
                                operator = value;
                                history = `${firstOperand} ${operator}`;
                                displayHistory.textContent = history;
                                displayResult.textContent = result;
                                currentInput = '';
                            }
                        }
                    }
                    break;
            }
        }

        function calculate(a, b, op) {
            let result;
            switch (op) {
                case '+':
                    result = a + b;
                    break;
                case '-':
                    result = a - b;
                    break;
                case '×':
                    result = a * b;
                    break;
                case '/':
                    if (b === 0) {
                        console.error('Division by zero');
                        return 'Error';
                    }
                    result = a / b;
                    break;
                case '%':
                    result = a % b;
                    break;
                default:
                    return a;
            }
            console.log(`Calculation: ${a} ${op} ${b} = ${result}`);
            return result;
        }

        function resetCalculator() {
            currentInput = '';
            history = '';
            operator = null;
            firstOperand = null;
        }

        // Profile Image Click Handler
        const profileImage = document.getElementById('profileImage');
        const newImageContainer = document.getElementById('newImageContainer');
        const userPopup = document.getElementById('userPopup');
        const closePopup = document.getElementById('closePopup');

        if (profileImage) {
            profileImage.addEventListener('click', () => {
                const newImageUrl = 'https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80';
                newImageContainer.innerHTML = `<img src="${newImageUrl}" alt="New profile image" class="w-20 h-20 rounded-full object-cover shadow-md" />`;
                console.log('Profile image changed to:', newImageUrl);

                userPopup.classList.add('show');
                console.log('User details popup opened');
            });
        }

        if (closePopup) {
            closePopup.addEventListener('click', () => {
                userPopup.classList.remove('show');
                console.log('User details popup closed');
            });
        }

        if (userPopup) {
            userPopup.addEventListener('click', (e) => {
                if (e.target === userPopup) {
                    userPopup.classList.remove('show');
                    console.log('User details popup closed (outside click)');
                }
            });
        }
    });
</script>
</body>

</html>
