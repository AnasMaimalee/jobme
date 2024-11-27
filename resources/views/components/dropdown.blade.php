@props(['actions', 'userId'])

<div class="relative inline-block text-left">
    <!-- Dropdown button -->
    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu-{{ $userId }}" aria-expanded="true" aria-haspopup="true">
        ...
    </button>

    <!-- Dropdown Menu -->
    <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-{{ $userId }}">
        <div class="py-1">
            @foreach ($actions as $action)
                <a href="{{ $action['url'] }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">{{ $action['label'] }}</a>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Dropdown toggle functionality
    document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.id.split('-').pop();
            const dropdown = document.getElementById('dropdown-' + userId);
            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        if (!e.target.closest('[id^="options-menu-"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
</script>
