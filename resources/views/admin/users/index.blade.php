<x-layout-admin>
    <div class="container mx-auto p-3">
        <!-- Display Flash Success Message -->
        <x-flash-message type="success" /> <!-- Success Message -->
        <x-flash-message type="error" />

        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Users List</h2>
        </div>

        <!-- Floating Action Button (FAB) -->
        <div class="flex justify-end mb-5">
            <a href="{{ route('admin.user.create') }}" class="bg-gray-800 text-white rounded-md p-2 shadow-md hover:bg-blue-600">
                Create New User
            </a>
        </div>

        <div class="overflow-x-auto bg-white p-3 rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Created At</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-1 px-4">{{ $user->id }}</td>
                        <td class="py-1 px-4">{{ $user->name }}</td>
                        <td class="py-1 px-4">{{ $user->email }}</td>
                        <td class="py-1 px-4">
                            <x-badge :status="$user->status" />
                        </td>
                        <td class="py-1 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="py-1 px-4">
                            <!-- Dropdown button -->
                            <div class="relative inline-block text-left">
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu-{{ $user->id }}" aria-expanded="true" aria-haspopup="true">
                                    ....
                                </button>

                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-{{ $user->id }}">
                                    <div class="py-1">
                                        <a href="{{ route('admin.user.show', $user) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">View</a>
                                        <a href="{{ route('admin.user.edit', $user) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">Edit</a>
{{--                                        <div type="button" onclick="openDeleteModal({{ $user->id }})" class="text-red-600 block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer">Delete</div>--}}

                                        <!-- Add Activate/Deactivate Links -->
                                        @if ($user->status === 'active')
                                            <button type="button" onclick="openActivateDeactivateModal({{ $user->id }}, 'deactivate')" class="text-red-500 block px-4 py-2 text-sm hover:bg-gray-100">Deactivate</button>
                                        @else
                                            <button type="button" onclick="openActivateDeactivateModal({{ $user->id }}, 'activate')" class="text-green-500 block px-4 py-2 text-sm hover:bg-gray-100">Activate</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Add Activate/Deactivate Confirmation Modal -->
                    <!-- Inline Modal for Activation/Deactivation -->
                    <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="activate-deactivate-modal-{{ $user->id }}">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold mb-4">Confirm {{ $user->status === 'active' ? 'Deactivation' : 'Activation' }}</h3>
                            <p>Are you sure you want to {{ $user->status === 'active' ? 'deactivate' : 'activate' }} this user?</p>
                            <div class="mt-4 flex justify-end">
                                <form action="{{ $user->status === 'active' ? route('admin.user.deactivate', $user) : route('admin.user.activate', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Yes, {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                                </form>
                                <button type="button" onclick="closeActivateDeactivateModal({{ $user->id }})" class="ml-3 bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @foreach ($users as $user)
        <x-delete-confirmation
            :action="route('admin.user.destroy', $user)"
            message="Are you sure you want to delete this User?"
            title="Confirm Deletion"
            :id="$user->id"
        />
    @endforeach
</x-layout-admin>

<!-- JavaScript to handle dropdown toggle and modal show/hide -->
<script>
    // Function to toggle dropdown visibility
    document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
        button.addEventListener('click', function (event) {
            const userId = this.id.split('-').pop();
            const dropdown = document.getElementById('dropdown-' + userId);

            // Close all dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (drop !== dropdown) {
                    drop.classList.add('hidden');
                }
            });

            // Toggle the current dropdown
            dropdown.classList.toggle('hidden');

            // Prevent event propagation to avoid immediate closing after clicking the button
            event.stopPropagation();
        });
    });

    // Close dropdowns if clicked outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('[id^="options-menu-"]')) {
            // Close all dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Open the delete confirmation modal
    function openDeleteModal(userId) {
        document.getElementById('delete-modal-' + userId).classList.remove('hidden');
    }

    // Open the activate/deactivate confirmation modal
    function openActivateDeactivateModal(userId, actionType) {
        document.getElementById('activate-deactivate-modal-' + userId).classList.remove('hidden');
    }

    // Close the activate/deactivate modal
    function closeActivateDeactivateModal(userId) {
        document.getElementById('activate-deactivate-modal-' + userId).classList.add('hidden');
    }

    // Close the delete modal
    function closeDeleteModal(userId) {
        document.getElementById('delete-modal-' + userId).classList.add('hidden');
    }
</script>
