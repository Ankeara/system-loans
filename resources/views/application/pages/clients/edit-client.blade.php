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
                    <span class="text-xl text-gray-600 hidden lg:block">ទំព័រដើម</span>
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-teal-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5" />
                            </svg>
                        </li>

                        <li>
                            <a href="{{ route('application.pages.clients.clients') }}" class="block transition-colors text-teal-600"> អតិថិជន </a>
                        </li>

                        <li class="rtl:rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-teal-600">
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
                            <a href="#" class="block transition-colors hover:text-teal-500"> {{ $client->full_Name }} </a>
                        </li>
                    </ol>
                </nav>
                <a class="flex items-center w-auto rounded-md bg-teal-600 px-4 h-10 drop-shadow-md text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                    href="{{ route('application.pages.clients.clients') }}">
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
                <span class="text-xl text-gray-600">ព៍ត័មានរបស់អតិថិជន</span>
            </div>
            <div class=" mt-10">
                <form method="POST" id="formUpdateClient" name="formUpdateClient" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
                        <div class="h-auto rounded bg-white">
                            <label for="full_Name">
                                <span class="text-sm font-medium text-gray-700"> ឈ្មោះពេញ * </span>
                                <div class="relative">
                                    <input type="text" id="full_Name" placeholder="បញ្ចូលឈ្មោះ" name="full_Name" value="{{ $client->full_Name }}"
                                        class=" bg-[#F9F9F9] mb-5 w-full rounded-[8px] border-gray-200 px-3 h-10 text-xs shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                                </div>
                                <p></p>
                            </label>
                            <label for="gender">
                                <span class="text-sm font-medium text-gray-700"> ភេទ * </span>
                                <div class="relative">
                                    <select id="gender" name="gender"
                                        class=" mb-5 bg-[#F9F9F9] w-full text-gray-700 rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2">
                                        <option value="" {{ $client->gender === null ? 'selected' : '' }}>ជ្រើសរើស</option>
                                        <option value="1" {{ $client->gender == '1' ? 'selected' : '' }}>ប្រុស</option>
                                        <option value="2" {{ $client->gender == '2' ? 'selected' : '' }}>ស្រី</option>
                                        <option value="0" {{ $client->gender == '0' ? 'selected' : '' }}>ផ្សេងៗ</option>
                                    </select>
                                </div>
                                <p></p>
                            </label>
                            <label for="phone_Number">
                                <span class="text-sm font-medium text-gray-700"> លេខទូរសព្ទ * </span>
                                <div class="relative">
                                    <input type="text" id="phone_Number" placeholder="បញ្ចូលលេខទូរសព្ទ" name="phone_Number" value="{{ $client->phone_Number }}"
                                        class=" mb-5 bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                                </div>
                                <p></p>
                            </label>
                        </div>
                        <div class="h-auto rounded bg-white lg:col-span-2">
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
                                <!-- Card ID -->
                                <div class="h-auto rounded">
                                    <label for="card_ID">
                                        <span class="text-sm font-medium text-gray-700"> អត្តសញ្ញាញបត្រ * </span>
                                        <div class="relative flex items-center justify-center">
                                            <input type="file" id="card_ID" accept="image/*" name="card_ID"
                                                class="mb-5 w-full h-[250px] rounded-[8px] text-gray-400 border-gray-200 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2 opacity-0 absolute z-10 cursor-pointer" />
                                            <div id="preview-container-card"
                                                class="w-full h-[225px] rounded-[8px] bg-[#F9F9F9] flex items-center justify-center shadow border border-gray-200">
                                                @if ($client->card_ID)
                                                    <img src="{{ asset('/src/assets/uploads/clients/card/' . $client->card_ID) }}" alt="Card ID Preview"
                                                        class="w-full h-[225px] object-cover rounded-[8px]">

                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                                        stroke-width="1.5">
                                                        <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!-- Profile Photo -->
                                <div class="h-auto rounded">
                                    <label for="profile">
                                        <span class="text-sm font-medium text-gray-700"> រូបថត * </span>
                                        <div class="relative flex items-center justify-center">
                                            <input type="file" id="profile" accept="image/*" name="profile"
                                                class="mb-5 w-full h-[250px] rounded-[8px] text-gray-400 border-gray-200 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2 opacity-0 absolute z-10 cursor-pointer" />
                                            <div id="preview-container-pic"
                                                class="w-full h-[225px] rounded-[8px] bg-[#F9F9F9] flex items-center justify-center shadow border border-gray-200">
                                                @if ($client->profile)
                                                    <img src="{{ asset('/src/assets/uploads/clients/profile/' . $client->profile) }}" alt="Profile Preview"
                                                        class="w-full h-[225px] object-cover rounded-[8px]">
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                                        stroke-width="1.5">
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
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols- lg:gap-8">
                        <div class="h-auto rounded">
                            <label for="address">
                                <span class="text-sm font-medium text-gray-700"> អាសាយដ្ឋាន * </span>
                                <div class="relative">
                                    <textarea id="" cols="30" rows="10" name="address"
                                        class=" mb-5 bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 py-3 px-3 text-xs shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2"
                                        id="" placeholder="បញ្ចូលអាសាយដ្ឋាន">{{ $client->address }}</textarea>
                                </div>
                                <p></p>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button class="flex items-center rounded-md bg-teal-600 mt-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                            type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20"
                                stroke-width="1.5">
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            កែសម្រួល
                        </button>
                        <a class="flex items-center rounded-md bg-red-500 mt-2 ml-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                            href="{{ route('application.pages.clients.clients') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"
                                stroke-width="2">
                                <path d="M18 6l-12 12"></path>
                                <path d="M6 6l12 12"></path>
                            </svg>
                            បោះបង់
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
@section('calculator')
    @include('application.components.calculator')
@endsection
@push('scripts_multiple')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            const inputPic = document.getElementById('card_ID');
                const previewContainerPic = document.getElementById('preview-container-card');

                inputPic.addEventListener('change', function (event) {
                    const file = event.target.files[0]; // Get the first selected file

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Clear the container
                            previewContainerPic.innerHTML = '';

                            // Create and configure the image
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-[225px] object-cover rounded-[8px]'; // Match container size
                            img.alt = 'Preview';

                            // Append the image
                            previewContainerPic.appendChild(img);
                        };

                        // Read the file
                        reader.readAsDataURL(file);
                    } else {
                        // If no file, reset to default SVG (optional)
                        previewContainerPic.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                stroke-width="1.5">
                                <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                            </svg>
                        `;
                    }
                });

            const inputCard = document.getElementById('profile');
                const previewContainerCard = document.getElementById('preview-container-pic');

                inputCard.addEventListener('change', function (event) {
                    const file = event.target.files[0]; // Get the first selected file

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Clear the container
                            previewContainerCard.innerHTML = '';

                            // Create and configure the image
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-[225px] object-cover rounded-[8px]'; // Match container size
                            img.alt = 'Preview';

                            // Append the image
                            previewContainerCard.appendChild(img);
                        };

                        // Read the file
                        reader.readAsDataURL(file);
                    } else {
                        // If no file, reset to default SVG (optional)
                        previewContainerCard.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                                stroke-width="1.5">
                                <path d="M4 11h5v4h6v-4h5v9h-16zm5 -7h6v4h-6z"></path>
                            </svg>
                        `;
                    }
                });
        $('#formUpdateClient').submit(function (e) {
                e.preventDefault();

                // Clear previous errors
                $('.is-invalid').removeClass("is-invalid border-red-400 focus:ring-red-400 focus:ring-2");
                $('.error-message').remove();

                let hasError = false;

                // Validate text inputs and textarea
                $('#formUpdateClient input[type="text"], #formUpdateClient textarea').each(function () {
                    let input = $(this);
                    let value = input.val().trim();
                    let errorMessage = '';

                    if (input.attr('name') === 'full_Name' && value === '') {
                        errorMessage = 'សូមបញ្ចូលឈ្មោះ។';
                    } else if (input.attr('name') === 'phone_Number' && value === '') {
                        errorMessage = 'សូមបញ្ចូលលេខទូរស័ព្ទ។';
                    } else if (input.attr('name') === 'address' && value === '') {
                        errorMessage = 'សូមបញ្ចូលអាសយដ្ឋាន។';
                    }

                    if (errorMessage !== '') {
                        input.addClass("border-red-400 focus:ring-red-400 focus:ring-2")
                            .after(`<p class="error-message text-red-400 mt-[-8px] mb-2">${errorMessage}</p>`);
                        hasError = true;
                    }
                });

                if (hasError) return;

                // Use FormData to include files
                let formData = new FormData(this);

                // Remove gender if it's the default empty value
                if ($('#gender').val() === '') {
                    formData.delete('gender');
                }

                $.ajax({
                    url: "{{ route('application.pages.clients.update-client', $client->id) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === false) {
                            let errors = response.errors;
                            $.each(errors, function (key, messages) {
                                let input = $(`[name="${key}"]`);
                                input.addClass("border-red-400 focus:ring-red-400 focus:ring-2")
                                    .after(`<p class="error-message text-red-400 mt-1">${messages[0]}</p>`);
                            });
                        } else {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr);
                    }
                });
            });
       </script>
@endpush

