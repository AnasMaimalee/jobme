<!-- resources/views/components/activate-deactivate-confirmation.blade.php -->

@props(['action', 'user', 'actionType'])

<div id="modal-{{ $user->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-xl font-semibold">Confirm Action</h3>
        <p class="mt-2">
            Are you sure you want to {{ $actionType === 'deactivate' ? 'deactivate' : 'activate' }} this user?
        </p>

        <form action="{{ $action }}" method="POST" class="mt-4">
            @csrf
            @method('PUT') <!-- PUT for activation/deactivation actions -->

            <div class="flex justify-end space-x-2">
                <button type="button" class="bg-gray-400 text-white py-2 px-4 rounded-lg" onclick="closeModal({{ $user->id }})">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">
                    {{ $actionType === 'deactivate' ? 'Deactivate' : 'Activate' }} User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open modal
    function openModal(userId) {
        document.getElementById('modal-' + userId).classList.remove('hidden');
    }

    // Close modal
    function closeModal(userId) {
        document.getElementById('modal-' + userId).classList.add('hidden');
    }
</script>
