// Toggle open and close sidebar
const toggleButton = document.getElementById('toggleSidebar');
        const aside = document.querySelector('.aside');

        // Toggle sidebar on button click
        toggleButton.addEventListener('click', () => {
            aside.classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768 &&
                !aside.contains(e.target) &&
                !toggleButton.contains(e.target) &&
                aside.classList.contains('open')) {
                aside.classList.remove('open');
            }
        });

        // Ensure sidebar state on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                aside.classList.remove('open'); // Reset 'open' class on desktop
            }
        });

        // Set initial state based on screen size
        window.addEventListener('load', () => {
            if (window.innerWidth >= 768) {
                aside.classList.remove('open'); // Ensure sidebar is visible on desktop
            }
        });

// Toggle aside sub menu
function toggleSubmenu(event) {
    event.preventDefault();
    const submenu = event.currentTarget.nextElementSibling;
    const chevron = event.currentTarget.querySelector('#chevron');

    // Toggle submenu visibility
    if (submenu.classList.contains('hidden')) {
        submenu.classList.remove('hidden');
        submenu.style.maxHeight = submenu.scrollHeight + 'px';
        chevron.classList.add('rotate-180');
    } else {
        submenu.style.maxHeight = '0'; // Start the transition to 0
        chevron.classList.remove('rotate-180');
        // Wait for the transition to complete before adding the hidden class
        setTimeout(() => {
            submenu.classList.add('hidden');
        }, 300); // Match the duration of the CSS transition (0.3s = 300ms)
    }
}

// Initialize submenu state on page load
document.addEventListener('DOMContentLoaded', () => {
    const submenus = document.querySelectorAll('.submenu');
    submenus.forEach(submenu => {
        // Check if any submenu item has the active class (bg-teal-600)
        const hasActiveItem = Array.from(submenu.querySelectorAll('a')).some(link =>
            link.classList.contains('bg-teal-600')
        );
        const chevron = submenu.previousElementSibling.querySelector('#chevron');

        if (hasActiveItem) {
            submenu.classList.remove('hidden');
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
            chevron.classList.add('rotate-180');
        } else {
            submenu.classList.add('hidden');
            submenu.style.maxHeight = '0';
            chevron.classList.remove('rotate-180');
        }
    });
});

// Calendar khmer
const khmerDays = [
            "អាទិត្យ", // Sunday
            "ចន្ទ",     // Monday
            "អង្គារ",   // Tuesday
            "ពុធ",      // Wednesday
            "ព្រហស្បតិ៍", // Thursday
            "សុក្រ",    // Friday
            "សៅរ៍"     // Saturday
        ];

        const khmerMonths = [
            "មករា",    // January
            "កុម្ភៈ",   // February
            "មីនា",    // March
            "មេសា",    // April
            "ឧសភា",   // May
            "មិថុនា",  // June
            "កក្កដា",  // July
            "សីហា",    // August
            "កញ្ញា",   // September
            "តុលា",    // October
            "វិច្ឆិកា", // November
            "ធ្នូ"      // December
        ];

        // Khmer greetings based on time of day
        const khmerGreetings = {
            morning: "អរុណសួស្តី",    // Good Morning
            afternoon: "ទិវាសួស្តី",  // Good Afternoon
            evening: "សាយ័ណ្ហសួស្តី", // Good Evening
            night: "រាត្រីសួស្តី"      // Good Night
        };

        // Function to convert number to Khmer numerals
        function toKhmerNumerals(num) {
            const khmerDigits = ["០", "១", "២", "៣", "៤", "៥", "៦", "៧", "៨", "៩"];
            return num.toString().split('').map(digit => khmerDigits[digit]).join('');
        }

        // Function to update date, time, and greeting
        function updateDisplay() {
            const now = new Date();

            // Date
            const dayOfWeek = khmerDays[now.getDay()];
            const month = khmerMonths[now.getMonth()];
            const year = toKhmerNumerals(now.getFullYear());
            const dateString = `ថ្ងៃ ${dayOfWeek} ខែ ${month} ឆ្នាំ ${year}`;
            document.getElementById("dateDisplay").innerText = dateString;

            // Time
            const hours = toKhmerNumerals(now.getHours().toString().padStart(2, '0'));
            const minutes = toKhmerNumerals(now.getMinutes().toString().padStart(2, '0'));
            const seconds = toKhmerNumerals(now.getSeconds().toString().padStart(2, '0'));
            const timeString = `ម៉ោង ${hours}:${minutes}:${seconds}`;
            document.getElementById("timeDisplay").innerText = timeString;

            // Greeting based on hour
            const hour = now.getHours();
            let greeting;
            if (hour >= 5 && hour < 12) {
                greeting = khmerGreetings.morning;    // 5:00 AM - 11:59 AM
            } else if (hour >= 12 && hour < 17) {
                greeting = khmerGreetings.afternoon;  // 12:00 PM - 4:59 PM
            } else if (hour >= 17 && hour < 20) {
                greeting = khmerGreetings.evening;    // 5:00 PM - 7:59 PM
            } else {
                greeting = khmerGreetings.night;      // 8:00 PM - 4:59 AM
            }
            document.getElementById("greetingDisplay").innerText = greeting;
        }

        // Initial call and update every second
        updateDisplay();
setInterval(updateDisplay, 1000);

