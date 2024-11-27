@props(['id'])
<div id="delete-modal-{{ $id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
        <p class="mt-2">{{ $message }}</p>

        <form action="{{ $action }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
                <button type="button" class="bg-gray-400 text-white py-2 px-4 rounded-lg" onclick="closeModal({{ $id }})">Cancel</button>
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open modal
    function openModal(jobId) {
        document.getElementById('delete-modal-' + jobId).classList.remove('hidden');
    }

    // Close modal
    function closeModal(jobId) {
        document.getElementById('delete-modal-' + jobId).classList.add('hidden');
    }
</script>