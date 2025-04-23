<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ចុះឈ្មោះដើម្បីចូលក្នុងប្រព័ន្ធ</title>
    <link rel="stylesheet" href="{{ url('../src/styles/main.css') }}">
</head>

<body class="min-h-screen bg-white khmer__font">
    <div class=" grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
        <div class="flex items-center justify-center h-[100vh] rounded bg-white p-10">
            <div class="flex flex-col w-[400px]">
                <h1 class="text-4xl text-gray-600 mt-1 mb-3">ស្វាគមន៍</h1>
                <p class="text-gray-400 mb-3">សូមស្វាគមន៍ សូមបញ្ចូលព័ត៌មានលម្អិត</p>
                <form name="registrationForm" id="registrationForm">
                    @csrf
                    <label for="name" class="mb-5">
                        <span class="text-sm font-medium text-gray-700"> ឈ្មោះពេញ *</span>
                        <div class="relative">
                            <input type="text" id="name" name="name" placeholder="បញ្ចូលឈ្មោះពេញ"
                                class=" mb-5 bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                        </div>
                        <p></p>
                    </label>
                    <label for="email" class="mb-5">
                        <span class="text-sm font-medium text-gray-700"> អ៊ីម៉ែល * </span>
                        <div class="relative">
                            <input type="email" id="email" name="email" placeholder="បញ្ចូលអ៊ីម៉ែល"
                                class=" mb-5 bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                        </div>
                        <p></p>
                    </label>
                    <label for="password" class="mb-5">
                        <span class="text-sm font-medium text-gray-700"> លេខទូរសព្ទ * </span>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="បញ្ចូលលេខសម្ងាត់"
                                class=" mb-5 bg-[#F9F9F9] w-full rounded-[8px] border-gray-200 px-3 h-10 text-sm shadow mt-1 border-none sm:text-sm focus:outline-none focus:ring-teal-500 focus:ring-2" />
                        </div>
                        <p></p>
                    </label>
                    <button
                        class="flex items-center justify-center rounded-md w-full bg-teal-600 mt-2 px-4 h-10 text-sm drop-shadow font-medium text-white transition hover:scale-110 hover:shadow-xl focus:ring-3 focus:outline-hidden"
                        type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" class="mr-1" width="20" height="20"
                            stroke-width="1.5">
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                        </svg>
                        បង្កើត
                    </button>
                </form>
            </div>
        </div>
        <div class="flex items-center justify-center w-full h-full rounded bg-gray-100">
            <img src="{{ url('../src/assets/images/login.jpg') }}" class="object-cover w-full h-full" alt="">
        </div>
    </div>
</body>
<!-- Tailwind CDN link -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Chart CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Customer Js -->
<script src="{{ url('../src/scripts/app.js') }}"></script>
<script>
    $('#registrationForm').submit(function (e) {
            e.preventDefault();

            // Clear previous errors
            $('.is-invalid').removeClass("is-invalid border-red-400 focus:ring-red-400 focus:ring-2");
            $('.error-message').remove();

            let hasError = false;

            // Validation check for each field
            $('#registrationForm input').each(function () {
                let input = $(this);
                let value = input.val().trim();
                let errorMessage = '';

                if (input.attr('name') === 'name' && value === '') {
                    errorMessage = 'សូមបញ្ចូលឈ្មោះ។';
                } else if (input.attr('name') === 'email' && value === '') {
                    errorMessage = 'សូមបញ្ចូលអ៊ីម៉ែល។';
                } else if (input.attr('name') === 'password' && value === '') {
                    errorMessage = 'សូមបញ្ចូលលេខសម្ងាត់។';
                }

                if (errorMessage !== '') {
                    input.addClass("border-red-400 focus:ring-red-400 focus:ring-2")
                        .after(`<p class="error-message text-red-400 mt-[-8px] mb-2">${errorMessage}</p>`);
                    hasError = true;
                }
            });

            // Stop form submission if there are errors
            if (hasError) return;

            // Proceed with AJAX submission if no errors
            $.ajax({
                url: "{{ route('application.pages.auth.process-registration') }}",
                type: 'POST',
                data: $("#registrationForm").serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if (response.status === false) {
                        let errors = response.errors;

                        $.each(errors, function (key, messages) {
                            let input = $(`#${key}`);
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

</html>
