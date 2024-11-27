@if ($message)
    <div id="flash-message" class="bg-{{ $type == 'error' ? 'red' : 'green' }}-500 text-white p-4 rounded-lg mb-6">
        <p class="font-semibold">{{ $message }}</p>
    </div>

    <!-- Auto-hide the flash message after 5 seconds -->
    <script>
        setTimeout(function() {
            let flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.display = 'none';
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endif
