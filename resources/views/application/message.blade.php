<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".alert").forEach(alert => {
            let progressBar = alert.querySelector(".progress-bar");
            let timeout = 7000; // 5 seconds

            setTimeout(() => {
                alert.classList.add("opacity-0", "translate-x-10");
                setTimeout(() => alert.remove(), 500);
            }, timeout);

            setTimeout(() => progressBar.classList.add("progress-bar-full"), 100);
        });
    });
</script>

<style>
    .progress-bar {
        width: 100%;
        height: 4px;;
        position: absolute;
        bottom: 0;
        left: 0;
        transition: width 5s linear;
    }

    .progress-bar-full {
        width: 0;
    }

    .alert {
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }
</style>

@foreach (["success" => "green", "error" => "red", "warning" => "yellow", "info" => "blue"] as $type => $color)
    @if (session($type))
        <div class="khmer__font alert absolute top-2 right-2 z-50 w-auto bg-{{ $color }}-100 border-l-4 border-{{ $color }}-500 text-{{ $color }}-700 p-4 mb-4 shadow-md rounded-md opacity-100 translate-x-0"
            role="alert">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center mr-6">
                    @if ($type == 'success')
                        <svg class="size-6 text-{{ $color }}-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif ($type == 'error')
                        <svg class="size-6 text-{{ $color }}-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    @elseif ($type == 'warning')
                        <svg class="size-6 text-{{ $color }}-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    @elseif ($type == 'info')
                        <svg class="size-6 text-{{ $color }}-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    @endif
                    <p class="ml-2">{{ session($type) }}</p>
                </div>
                <button
                    class="rounded-full p-2 text-white bg-{{ $color }}-500 transition-colors hover:bg-gray-50 hover:text-gray-700"
                    type="button" aria-label="Dismiss alert" onclick="this.parentElement.parentElement.remove()">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="progress-bar bg-{{ $color }}-500"></div>
        </div>
    @endif
@endforeach
