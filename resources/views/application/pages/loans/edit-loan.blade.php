@extends('application.layout.application')

@section('asidebar')
    @include('application.components.asidebar')
@endsection

@section('content')
    <style>
        #loading-overlay-update-loan.opacity-80 {
            opacity: 0.8;
            pointer-events: auto;
        }

        /* Simple spinner style (customize as needed) */
        .loader {
            width: 40px;
            height: 40px;
            border: 4px solid #fff;
            border-top: 4px solid #teal-600;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
                        <span class="text-xl text-gray-600 hidden lg:block">អតិថិជនដែលចងការប្រាក់</span>
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
                        <ol class="flex items-center flex-wrap gap-1 text-sm text-gray-600">
                            <li>
                                <a href="{{ route('application.pages.dashboard') }}" class="block transition-colors text-teal-600 "> ទំព័រដើម </a>
                            </li>

                            <li class="rtl:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-teal-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                </svg>
                            </li>

                            <li>
                                <a href="{{ route('application.pages.loans.loan') }}" class="block transition-colors text-teal-600"> អតិថិជនដែលចងការប្រាក់ </a>
                            </li>

                            <li class="rtl:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-6 text-teal-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                </svg>
                            </li>

                            <li>
                                <a href="#" class="block transition-colors text-teal-600"> កែសម្រួលអតិថិជន </a>
                            </li>

                            <li class="rtl:rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-6 text-teal-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                                </svg>
                            </li>

                            <li>
                                <a href="#" class="block transition-colors hover:text-teal-500"> {{ $loans->client->full_Name }} </a>
                            </li>
                        </ol>
                    </nav>
                    <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                        href="{{ route('application.pages.loans.loan') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round"class="mr-1" width="20" height="20" stroke-width="1.5">
                            <path d="M9 14l-4 -4l4 -4"></path>
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                        </svg>
                        ថយក្រោយ
                    </a>
                </div>
                <div class="header__btn__search flex items-center justify-between mt-6">
                    <span class="text-xl text-gray-600">ព៍ត័មានការចងការប្រាក់</span>
                </div>
                <div class="mt-6">
                   <form method="POST" id="formUpdateLoan" name="formUpdateLoan" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
        <div class="h-auto rounded bg-white">
            <!-- Client Field -->
            <div class="h-auto rounded mb-4">
                <label for="client">
                    <span class="text-sm font-medium text-gray-700">ឈ្មោះពេញ *</span>
                    <div class="relative mt-1">
                        <input type="text" name="client" id="client" placeholder="បញ្ចូលឈ្មោះ"
                            class="bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-xs shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2"
                            oninput="filterClients()" onfocus="showAllClients()" onblur="hideDropdown()" autocomplete="off" value="{{ $loans->client->full_Name }}" disabled />
                        <input type="hidden" id="id_client" value="{{ $loans->id_client }}" name="id_client" />
                        <div id="dropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden">
                            <ul id="client-list" class="max-h-48 overflow-y-auto"></ul>
                        </div>
                    </div>
                </label>
            </div>

            <!-- Currency Selection Dropdown -->
            <div class="h-auto rounded mb-4">
                <label for="currency">
                    <span class="text-sm font-medium text-gray-700">ជ្រើសរើសរូបិយប័ណ្ណ *</span>
                    <div class="relative mt-1">
                        <select id="currency" name="currency"
                            class="bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2">
                            <option value="" disabled {{ !$loans->currency ? 'selected' : '' }}>ជ្រើសរើសរូបិយប័ណ្ណ</option>
                            <option value="riel" {{ $loans->currency === 'riel' ? 'selected' : '' }}>ប្រាក់រៀល</option>
                            <option value="baht" {{ $loans->currency === 'baht' ? 'selected' : '' }}>ប្រាក់បាត</option>
                            <option value="dollar" {{ $loans->currency === 'dollar' ? 'selected' : '' }}>ប្រាក់ដុល្លារ</option>
                        </select>
                    </div>
                </label>
            </div>

            <!-- Riel Fields (Hidden by Default) -->
            <div id="riel_Fields" class="h-auto rounded mb-4 currency-fields" style="display: {{ $loans->currency === 'riel' ? 'block' : 'none' }};">
                <label for="loan_Amount_Riel">
                    <span class="text-sm font-medium text-gray-700">ចំនួនកម្ចីប្រាក់រៀល *</span>
                    <input type="number" id="loan_Amount_Riel" name="loan_Amount_Riel" value="{{ $loans->loan_Amount_Riel }}" placeholder="បញ្ចូលចំនួនប្រាក់កម្ចី"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="interest_Rate_Riel">
                    <span class="text-sm font-medium text-gray-700">ចំនួនអត្រាការប្រាក់ *</span>
                    <input type="number" id="interest_Rate_Riel" name="interest_Rate_Riel" value="{{ $loans->interest_Rate_Riel }}" placeholder="បញ្ចូលចំនួនអត្រាការប្រាក់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="payment_Amount_Riel">
                    <span class="text-sm font-medium text-gray-700">ចំនួនទឹកប្រាក់ត្រូវទូទាត់ *</span>
                    <input type="number" id="payment_Amount_Riel" name="payment_Amount_Riel" value="{{ $loans->payment_Amount_Riel }}" placeholder="បញ្ចូលចំនួនទឹកប្រាក់ត្រូវទូទាត់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- Baht Fields (Hidden by Default) -->
            <div id="baht_Fields" class="h-auto rounded mb-4 currency-fields" style="display: {{ $loans->currency === 'baht' ? 'block' : 'none' }};">
                <label for="loan_Amount_Baht">
                    <span class="text-sm font-medium text-gray-700">ចំនួនកម្ចីប្រាក់បាត *</span>
                    <input type="number" id="loan_Amount_Baht" name="loan_Amount_Baht" value="{{ $loans->loan_Amount_Baht }}" placeholder="បញ្ចូលចំនួនប្រាក់កម្ចី"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="interest_Rate_Baht">
                    <span class="text-sm font-medium text-gray-700">ចំនួនអត្រាការប្រាក់ *</span>
                    <input type="number" id="interest_Rate_Baht" name="interest_Rate_Baht" value="{{ $loans->interest_Rate_Baht }}" placeholder="បញ្ចូលចំនួនអត្រាការប្រាក់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="payment_Amount_Baht">
                    <span class="text-sm font-medium text-gray-700">ចំនួនទឹកប្រាក់ត្រូវទូទាត់ *</span>
                    <input type="number" id="payment_Amount_Baht" name="payment_Amount_Baht" value="{{ $loans->payment_Amount_Baht }}" placeholder="បញ្ចូលចំនួនទឹកប្រាក់ត្រូវទូទាត់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- Dollar Fields (Hidden by Default) -->
            <div id="dollar_Fields" class="h-auto rounded mb-4 currency-fields" style="display: {{ $loans->currency === 'dollar' ? 'block' : 'none' }};">
                <label for="loan_Amount_Dollar">
                    <span class="text-sm font-medium text-gray-700">ចំនួនប្រាក់កម្ចីដុល្លារ *</span>
                    <input type="number" id="loan_Amount_Dollar" name="loan_Amount_Dollar" value="{{ $loans->loan_Amount_Dollar }}" placeholder="បញ្ចូលចំនួនប្រាក់កម្ចី"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="interest_Rate_Dollar">
                    <span class="text-sm font-medium text-gray-700">ចំនួនអត្រាការប្រាក់ *</span>
                    <input type="number" id="interest_Rate_Dollar" name="interest_Rate_Dollar" value="{{ $loans->interest_Rate_Dollar }}" placeholder="បញ្ចូលចំនួនអត្រាការប្រាក់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
                <label for="payment_Amount_Dollar">
                    <span class="text-sm font-medium text-gray-700">ចំនួនទឹកប្រាក់ត្រូវទូទាត់ *</span>
                    <input type="number" id="payment_Amount_Dollar" name="payment_Amount_Dollar" value="{{ $loans->payment_Amount_Dollar }}" placeholder="បញ្ចូលចំនួនទឹកប្រាក់ត្រូវទូទាត់"
                        class="bg-[#F9F9F9] mt-2 mb-2 w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- Loan Term -->
            <div class="h-auto rounded mb-4">
                <label for="loan_Term">
                    <span class="text-sm font-medium text-gray-700">រយៈពេលខ្ចី *</span>
                    <input type="number" id="loan_Term" name="loan_Term" value="{{ $loans->loan_Term }}" placeholder="បញ្ចូលរយៈពេលខ្ចី"
                        class="bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- Start Date -->
            <div class="h-auto rounded mb-4">
                <label for="start_Date">
                    <span class="text-sm font-medium text-gray-700">កាលបរិច្ឆេទចាប់ផ្តើម *</span>
                    <input type="date" id="start_Date" name="start_Date" value="{{ $loans->start_Date }}"
                        class="bg-[#F9F9F9] w-full text-gray-400 rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- End Date -->
            <div class="h-auto rounded mb-4">
                <label for="end_Date">
                    <span class="text-sm font-medium text-gray-700">កាលបរិច្ឆេទបញ្ចប់ *</span>
                    <input type="date" id="end_Date" name="end_Date" value="{{ $loans->end_Date }}"
                        class="bg-[#F9F9F9] w-full text-gray-400 rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                </label>
            </div>

            <!-- Status -->
            <div class="h-auto rounded mb-4">
                <label for="status">
                    <span class="text-sm font-medium text-gray-700">សកម្មភាព *</span>
                    <select id="status" name="status"
                        class="bg-[#F9F9F9] w-full text-gray-400 rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2">
                        <option value="" {{ $loans->status === null ? 'selected' : '' }}>ជ្រើសរើសស្ថានភាព</option>
                        <option value="0" {{ $loans->status == '0' ? 'selected' : '' }}>អនុម័ត</option>
                        <option value="1" {{ $loans->status == '1' ? 'selected' : '' }}>បកប្រាក់កម្ចី</option>
                        <option value="2" {{ $loans->status == '2' ? 'selected' : '' }}>បង់រួច</option>
                    </select>
                </label>
            </div>
        </div>

        <!-- Picture and Video Section -->
        <div class="h-auto rounded mb-4 bg-white lg:col-span-2">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-1 lg:gap-8">
                <div class="h-auto rounded">
                    <label for="picture">
                        <span class="text-sm font-medium text-gray-700">រូបថត *</span>
                        <div class="relative flex items-center justify-center">
                            <input type="file" id="picture" accept="image/*" name="picture"
                                class="w-full h-[350px] rounded-[8px] text-gray-400 border-gray-200 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2 opacity-0 absolute z-10 cursor-pointer" />
                            <div id="preview-container-pic"
                                class="w-full h-[330px] rounded-[8px] bg-[#F9F9F9] flex items-center justify-center shadow border border-gray-200">
                                @if ($loans->picture)
                                    <img src="{{ asset('/src/assets/uploads/loans/pictures/' . $loans->picture) }}" alt="picture Preview"
                                        class="w-full h-full object-cover rounded-[8px]">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                        <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </label>
                </div>
                <div class="h-auto rounded">
                    <label for="video">
                        <span class="text-sm font-medium text-gray-700">វិដេអូ *</span>
                        <div class="relative flex items-center justify-center">
                            <input type="file" id="video" accept="video/*" name="video"
                                class="w-full h-[350px] rounded-[8px] text-gray-400 border-gray-200 text-sm shadow border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2 opacity-0 absolute z-10 cursor-pointer" />
                            <div id="preview-container-video"
                                class="w-full h-[330px] rounded-[8px] bg-[#F9F9F9] flex items-center justify-center shadow border border-gray-200">
                                @if ($loans->video)
                                    <video src="{{ asset('/src/assets/uploads/loans/videos/' . $loans->video) }}" alt="video Preview" autoplay
                                        class="w-full h-full object-cover rounded-[8px]">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1.5">
                                        <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex items-center justify-end">
        <button class="flex items-center rounded-md bg-teal-600 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20" stroke-width="1.5">
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M14 4l0 4l-6 0l0 -4"></path>
            </svg>
            កែសម្រួល
        </button>
        <a href="{{ route('application.pages.loans.loan') }}" class="flex items-center rounded-md bg-red-500 ml-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="2">
                <path d="M18 6l-12 12"></path>
                <path d="M6 6l12 12"></path>
            </svg>
            បោះបង់
        </a>
    </div>
</form>

<!-- JavaScript for Currency Selection -->
<script>
    document.getElementById('currency').addEventListener('change', function() {
        document.querySelectorAll('.currency-fields').forEach(function(field) {
            field.style.display = 'none';
        });
        const selectedCurrency = this.value;
        if (selectedCurrency) {
            document.getElementById(selectedCurrency + '_Fields').style.display = 'block';
        }
    });
</script>
                    <div id="loading-overlay-update-loan"
                        class="fixed inset-0 bg-gray-500 opacity-0 pointer-events-none transition-opacity duration-300 z-[54] flex items-center justify-center">
                        <div class="loader"></div> <!-- You can customize the loader -->
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('scripts_multiple')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM fully loaded'); // Confirm DOM is ready

            // Picture preview
            const inputPic = document.getElementById('picture');
            const previewContainerPic = document.getElementById('preview-container-pic');

            console.log('Picture input:', inputPic);
            console.log('Picture preview container:', previewContainerPic);

            if (!inputPic || !previewContainerPic) {
                console.error('Picture input or preview container not found');
            } else {
                inputPic.addEventListener('change', function (event) {
                    console.log('Picture change event triggered');
                    const file = event.target.files[0];
                    console.log('Picture file selected:', file);

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            console.log('Picture reader result:', e.target.result);
                            previewContainerPic.innerHTML = '';
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-[330px] object-cover rounded-[8px]';
                            img.alt = 'Preview';
                            previewContainerPic.appendChild(img);
                        };
                        reader.onerror = function (e) {
                            console.error('Picture reader error:', e);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        console.log('No picture file selected, resetting to default');
                        previewContainerPic.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                    stroke-width="1.5">
                                    <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                                </svg>
                            `;
                    }
                });
            }

            // Video preview
            const inputVideo = document.getElementById('video');
            const previewContainerVideo = document.getElementById('preview-container-video');

            console.log('Video input:', inputVideo);
            console.log('Video preview container:', previewContainerVideo);

            if (!inputVideo || !previewContainerVideo) {
                console.error('Video input or preview container not found');
            } else {
                inputVideo.addEventListener('change', function (event) {
                    console.log('Video change event triggered');
                    const file = event.target.files[0];
                    console.log('Video file selected:', file);

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            console.log('Video reader result:', e.target.result);
                            previewContainerVideo.innerHTML = '';
                            const video = document.createElement('video');
                            video.src = e.target.result;
                            video.className = 'w-full h-[330px] object-cover rounded-[8px]';
                            video.controls = true;
                            video.alt = 'Video Preview';
                            previewContainerVideo.appendChild(video);
                        };
                        reader.onerror = function (e) {
                            console.error('Video reader error:', e);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        console.log('No video file selected, resetting to default');
                        previewContainerVideo.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                    stroke-width="1.5">
                                    <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                                </svg>
                            `;
                    }
                });
            }

            // Form submission (unchanged, but ensure it doesn’t interfere)
            $('#formUpdateLoan').submit(function (e) {
                e.preventDefault();
                $('.is-invalid').removeClass("is-invalid border-red-400 focus:ring-red-400 focus:ring-2");
                $('.error-message').remove();

                let hasError = false;

                $('#formUpdateLoan input[type="text"], #formUpdateLoan input[type="number"], #formUpdateLoan input[type="date"], #formUpdateLoan select').each(function () {
                    let input = $(this);
                    let value = input.val().trim();
                    let errorMessage = '';

                    // Remove previous error messages and styling
                    input.removeClass("border-red-400 focus:ring-red-400 focus:ring-2");
                    input.next(".error-message").remove();

                    // Validation for select elements
                    if (input.is("select")) {
                        if (value === '' || value === 'default' || value === '-1') {
                            if (input.attr('name') === 'currency') {
                                errorMessage = 'សូមជ្រើសរើសរូបិយប័ណ្ណ។';
                            } else if (input.attr('name') === 'status') {
                                errorMessage = 'សូមជ្រើសរើសសកម្មភាព។';
                            }
                        }
                    } else {
                        // Validation for text/number/date inputs
                        if (input.attr('name') === 'client' && value === '') {
                            errorMessage = 'សូមជ្រើសរើសឈ្មោះអតិថិជន។';
                        } else if (input.attr('name') === 'start_Date' && value === '') {
                            errorMessage = 'សូមបញ្ចូលកាលបរិច្ឆេទចាប់ផ្តើម។';
                        } else if (input.attr('name') === 'end_Date' && value === '') {
                            errorMessage = 'សូមបញ្ចូលកាលបរិច្ឆេទបញ្ចប់។';
                        } else if (input.attr('name') === 'loan_Term' && value === '') {
                            errorMessage = 'សូមបញ្ចូលរយៈពេលខ្ចី។';
                        }
                    }

                    // Currency-specific validation
                    let selectedCurrency = $('#currency').val();
                    if (selectedCurrency === 'riel') {
                        if (input.attr('name') === 'loan_Amount_Riel' && value === '') {
                            errorMessage = 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីរៀល។';
                        } else if (input.attr('name') === 'interest_Rate_Riel' && value === '') {
                            errorMessage = 'សូមបញ្ចូលអត្រាការប្រាក់រៀល។';
                        } else if (input.attr('name') === 'payment_Amount_Riel' && value === '') {
                            errorMessage = 'សូមបញ្ចូលទឹកប្រាក់ត្រូវទូទាត់រៀល។';
                        }
                    } else if (selectedCurrency === 'baht') {
                        if (input.attr('name') === 'loan_Amount_Baht' && value === '') {
                            errorMessage = 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីបាត។';
                        } else if (input.attr('name') === 'interest_Rate_Baht' && value === '') {
                            errorMessage = 'សូមបញ្ចូលអត្រាការប្រាក់បាត។';
                        } else if (input.attr('name') === 'payment_Amount_Baht' && value === '') {
                            errorMessage = 'សូមបញ្ចូលទឹកប្រាក់ត្រូវទូទាត់បាត។';
                        }
                    } else if (selectedCurrency === 'dollar') {
                        if (input.attr('name') === 'loan_Amount_Dollar' && value === '') {
                            errorMessage = 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីដុល្លារ។';
                        } else if (input.attr('name') === 'interest_Rate_Dollar' && value === '') {
                            errorMessage = 'សូមបញ្ចូលអត្រាការប្រាក់ដុល្លារ។';
                        } else if (input.attr('name') === 'payment_Amount_Dollar' && value === '') {
                            errorMessage = 'សូមបញ្ចូលទឹកប្រាក់ត្រូវទូទាត់ដុល្លារ។';
                        }
                    }

                    // Apply error styling and message if there's an error
                    if (errorMessage) {
                        input.addClass("border-red-400 focus:ring-red-400 focus:ring-2")
                            .after(`<p class="error-message text-red-400 mt-2 mb-4">${errorMessage}</p>`);
                        hasError = true;
                    }
                });

                if (hasError) return;

                let formData = new FormData(this);
                if ($('#status').val() === '') {
                    formData.delete('status');
                }

                $('#loading-overlay-update-loan').addClass('opacity-80');

                $.ajax({
                    url: "{{ route('application.pages.loans.update-loan', $loans->id) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        $('#loading-overlay-update-loan').removeClass('opacity-80');
                        if (response.status === false) {
                            let errors = response.errors;
                            $.each(errors, function (key, messages) {
                                let input = $(`[name="${key}"]`);
                                input.addClass("border-red-400 focus:ring-red-400 focus:ring-2")
                                    .after(`<p class="error-message text-red-400">${messages[0]}</p>`);
                            });
                        } else {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr) {
                        $('#loading-overlay-update-loan').removeClass('opacity-80');
                        console.log('AJAX Error:', xhr);
                    }
                });
            });
        });
    </script>
@endpush
